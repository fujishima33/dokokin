<?php

namespace App\Http\Controllers\General;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Work;
use App\Timestamp;
use Auth;

class ReportController extends Controller
{
    public function report()
    {
        $user = Auth::user();
        // 打刻の時間表示用
        $timestamp = Timestamp::where('user_id', $user->id)->latest()->first();
        // 打刻の履歴表示
        $reports = Timestamp::where('user_id', $user->id)->latest()->paginate(20);
        // dd($reports);
        // ログインしているユーザーの管理者が作成した案件を取得
        $author = Auth::user()->author_id;
        $works = Work::where('author_id', $author)->get();
        return view('general.report', ['timestamp' => $timestamp, 'reports' => $reports, 'works' => $works ]);
    }
    
    public function edit(Request $request)
    {
        // ログインしているユーザーの管理者が作成した案件を取得
        $author = Auth::user()->author_id;
        $works = Work::where('author_id', $author)->get();
        // 要求されたTimestamp（日報情報）を取得
        $report = Timestamp::find($request->id);
        if (empty($report)) {
            abort(404);
        }
        return view('general.report.edit', ['works' => $works, 'report_form' => $report]);
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
