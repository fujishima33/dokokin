<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
  public function edit()
  {
      return view('general.report.edit');
  }
  
}
