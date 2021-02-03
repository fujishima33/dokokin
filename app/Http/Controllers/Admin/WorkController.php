<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function add()
  {
      return view('admin.work.create');
  }
  
  public function edit()
  {
      return view('admin.work.edit');
  }
  
}
