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
        
        $timestamp = Timestamp::get();
        // $timestamp = Timestamp::where('user_id', 2)->first();
        // dd($timestamp);
        
        return view('admin.report', ['users' => $users, 'timestamp' => $timestamp]);
    }
    
    public function single(Request $request)
    {
        $user = User::find($request->id);
        
        $reports = Timestamp::where('user_id', $request->id)->latest()->get();
        if (empty($reports)) {
            abort(404);
        }
        return view('admin.report.single', ['reports' => $reports, 'user' => $user]);
    }
}
