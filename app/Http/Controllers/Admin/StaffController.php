<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffController extends Controller
{
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
  
  
}
