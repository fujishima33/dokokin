<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Timestamp;
use Hash;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $users = Auth::user()->general_users;
        
        return view('admin.report', ['users' => $users]);
    }
}