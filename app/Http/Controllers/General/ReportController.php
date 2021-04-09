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
        $reports = Timestamp::where('user_id', $user->id)->orderBy('punchIn', 'desc')->paginate(20);
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
        $before = $request->all();
        
        // 入力された時刻はstring型のため、datetime型に変換
        $datetime_in = date("Y-m-d H:i:s", strtotime($request->punchIn));
        $datetime_out = date("Y-m-d H:i:s", strtotime($request->punchOut));
        // 配列を置き換える
        $replace = array(
            'punchIn' => $datetime_in,
            'punchOut' => $datetime_out
        );
        $report_form = array_replace($before, $replace);
        
        unset($report_form['_token']);
        $report->fill($report_form)->save();
        return redirect('general/report');
    }
}
