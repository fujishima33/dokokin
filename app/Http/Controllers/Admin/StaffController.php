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
  
    public function show()
  {
      return view('admin.staff');
  }
  
    public function add()
  {
      return view('admin.staff.create');
  }
  
  public function edit(Request $request)
  {
      // News Modelからデータを取得する
      //$news = News::find($request->id);
      //return view('admin.news.edit', ['news_form' => $news]);
      return view('admin.staff.edit');
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
  
}