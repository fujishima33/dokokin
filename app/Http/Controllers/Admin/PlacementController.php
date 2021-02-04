<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacementController extends Controller
{
    public function staff()
  {
      return view('admin.placement.staff');
  }
  
  public function work()
  {
      return view('admin.placement.work');
  }
}