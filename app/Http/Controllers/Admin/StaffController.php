<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Placement;
use App\Timestamp;
use Hash;
use Auth;

class StaffController extends Controller
{
    public function add()
    {
        return view('admin.staff.create');
    }
  
    public function create(Request $request)
    {
        // Varidationを行う
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $form = $request->all();
      
        $user = User::create([
            'name' => $form['name'],
            'email' => $form['email'],
            'password' => Hash::make($form['password']),
            'role' => $form['role'],
            'author_id' => $form['author_id']
        ]);
        
        return redirect('admin/staff');
    }
  
    public function index(Request $request)
    {
        $users = Auth::user()->general_users;
      
        return view('admin.staff', ['users' => $users]);
    }
  
    public function edit(Request $request)
    {
        $user = User::find($request->id);
        if (empty($user)) {
            abort(404);
        }
        return view('admin.staff.edit', ['user_form' => $user]);
    }
  
    public function update(Request $request)
    {
        // Varidationを行う
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id.',id',
        ]);
        
        //User Modelからデータを取得
        $user = User::find($request->id);
      
        // 送信されてきたフォームデータを格納する
        $user_form = $request->all();
      
        unset($user_form['_token']);

        // 該当するデータを上書きして保存する
        $user->fill($user_form)->save();
      
        return redirect('admin/staff');
    }
  
    public function delete(Request $request)
    {
        $timestamps = Timestamp::where('user_id', $request->id)->get();
        $placements = Placement::where('user_id', $request->id)->get();
        $user = User::find($request->id);
        
        foreach ($timestamps as $t) {
            $t->delete();
        }
        foreach ($placements as $p) {
            $p->delete();
        }
        $user->delete();
        
        return redirect('admin/staff');
    }
}
