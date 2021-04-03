<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Work;
use App\Timestamp;
use Hash;
use Auth;
use App\Services\CsvDownloader;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $author = Auth::user()->id;
        $users = User::where('author_id', $author)->paginate(20);
        
        $timestamp = Timestamp::get();
        
        return view('admin.report', ['users' => $users, 'timestamp' => $timestamp]);
    }
    
    public function single(Request $request)
    {
        $user = User::find($request->id);
        
        $reports = Timestamp::where('user_id', $request->id)->latest()->paginate(20);
        if (empty($reports)) {
            abort(404);
        }
        
        $works = Work::where('author_id', $user->author_id)->get();
        return view('admin.report.single', ['reports' => $reports, 'user' => $user, 'works' => $works]);
    }
    
    public function download(): StreamedResponse
    {
        return (new CsvDownloader())->download();
    }
}
