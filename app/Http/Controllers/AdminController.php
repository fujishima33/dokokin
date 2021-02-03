<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function top()
    {
      return view('admin');
    }
    
    public function report()
    {
      return view('admin.report');
    }
    
    public function info()
    {
      return view('admin.info');
    }
    
    public function apply()
    {
      return view('admin.apply');
    }
    
    public function work()
    {
      return view('admin.work');
    }
    
    public function placement()
    {
      return view('admin.placement');
    }
    
    

}
