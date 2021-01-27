<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Hash;

class StaffController extends Controller
{
    public function top()
  {
      return view('admin');
  }
  
    public function add()
  {
      return view('admin.staff.create');
  }
  
  public function create(Request $request)
  {
      $form = $request->all();
      
      $user = User::create([
            'name' => $form['name'],
            'email' => $form['email'],
            'password' => Hash::make($form['password']),
            'role' => $form['role']
        ]);
      return redirect('admin/staff');
  }
  
  public function index(Request $request)
  {
      $posts = User::all();
      
      return view('admin.staff', ['posts' => $posts]);
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
      $user = User::find($request->id);
      $user->delete();
      return redirect('admin/staff');
  }  
}