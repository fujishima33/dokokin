<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\AlphaNumHalf;
use App\User;
use App\Placement;
use App\Timestamp;
use Hash;
use Auth;
use Storage;

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
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'max:255', 'unique:users', 'email'],
            'password'   => ['required', 'min:8', 'confirmed', new AlphaNumHalf],
            'image'      => ['mimes:jpeg,png,jpg']
        ]);
        
        $user = new User;
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request['password']);
        $user->role = $request->role;
        $user->author_id = $request->author_id;
        
        if (isset($request['image'])) {
            $path = Storage::disk('s3')->putFile('/', $request['image'], 'public');
            $user->image_path = Storage::disk('s3')->url($path);
        } else {
            $user->image_path = null;
        }
        
        $user->save();
        
        return redirect('admin/staff');
    }
  
    public function index(Request $request)
    {
        $author = Auth::user()->id;
        $users = User::where('author_id', $author)->orderBy('created_at', 'asc')->paginate(10);
        
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
        if ($request->remove == 'true') {
            $user_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = Storage::disk('s3')->putFile('/', $user_form['image'], 'public');
            $user_form['image_path'] = Storage::disk('s3')->url($path);
        } else {
            $user_form['image_path'] = $user->image_path;
        }
      
        unset($user_form['image']);
        unset($user_form['remove']);
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
