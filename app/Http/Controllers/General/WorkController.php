<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Work;
use App\User;
use Auth;

class WorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $works = Work::where('author_id', $user->author_id)->orderBy('created_at', 'desc')->paginate(20);
      
        return view('general.work', ['works' => $works]);
    }
}
