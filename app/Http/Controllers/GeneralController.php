<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    public function top()
    {
        return view('general');
    }

    public function info()
    {
      return view('general.info');
    }
    
    public function apply()
    {
      return view('general.apply');
    }
}
