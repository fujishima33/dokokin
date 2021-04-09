<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Work;
use App\User;
use App\Placement;
use Auth;

class WorkController extends Controller
{
    public function add()
    {
        return view('admin.work.create');
    }
  
    public function index()
    {
        $user = Auth::user();
        $works = Work::where('author_id', $user->id)->latest()->get();
      
        return view('admin.work', ['works' => $works]);
    }
  
    public function create(Request $request)
    {
        // Varidationを行う
        $request->validate([
            'work_title' => 'required',
            'body' => 'required',
        ]);
      
        $work = new Work;
        $form = $request->all();
        unset($form['_token']);

        $work->fill($form)->save();
      
        //今までに作成した案件を取得
        $user = Auth::user();
        $works = Work::where('author_id', $user->id)->latest()->get();
      
        return view('admin.work', ['works' => $works]);
    }
  
    public function edit(Request $request)
    {
        $work = Work::find($request->id);
        if (empty($work)) {
            abort(404);
        }
        return view('admin.work.edit', ['work_form' => $work]);
    }
  
    public function update(Request $request)
    {
        // Varidationを行う
        $request->validate([
            'work_title' => 'required',
            'body' => 'required',
        ]);
        
        //Work Modelからデータを取得
        $work = Work::find($request->id);
        //   dd($work);
        // 送信されてきたフォームデータを格納する
        $work_form = $request->all();
        unset($work_form['_token']);
        // 該当するデータを上書きして保存する
        $work->fill($work_form)->save();
      
        return redirect('admin/work');
    }
  
    public function delete(Request $request)
    {
        $placements = Placement::where('work_id', $request->id)->get();
        $work = Work::find($request->id);
        
        foreach ($placements as $p) {
            $p->delete();
        }
        
        $work->delete();
        return redirect('admin/work');
    }
}
