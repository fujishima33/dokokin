<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Timestamp;
use Auth;

class ReportController extends Controller
{
    public function report()
    {
        $user = Auth::user();
        $timestamp = Timestamp::where('user_id', $user->id)->latest()->first();
        $reports = Timestamp::where('user_id', $user->id)->latest()->get();
        
        return view('general.report', ['timestamp' => $timestamp, 'reports' => $reports ]);
    }
    
    public function edit(Request $request)
    {
        $report = Timestamp::find($request->id);
        if (empty($report)) {
        abort(404);    
        }
        return view('general.report.edit', ['report_form' => $report]);
    }
    
    public function update(Request $request)
    {
        $report = Timestamp::find($request->id);
        $report_form = $request->all();
        unset($report_form['_token']);
        
        $report->fill($report_form)->save();
        
        return redirect('general/report');
        
    }
}
