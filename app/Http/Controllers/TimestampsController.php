<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Work;
use App\Timestamp;
use Auth;
use Carbon\Carbon;
use Session;

class TimestampsController extends Controller
{
    public function punchIn()
    {
        $user = Auth::user();
        
        // 打刻は1日一回
        $oldTimestamp = Timestamp::where('user_id', $user->id)->latest()->first();
        
        if ($oldTimestamp) {
            $oldTimestampPunchIn = new Carbon($oldTimestamp->punchIn);
            $oldTimestampDay = $oldTimestampPunchIn->startOfDay();
        } else {
            $timestamp = Timestamp::create([
                'user_id' => $user->id,
                'punchIn' => Carbon::now(),
            ]);
            
            Session::flash('my_status', '出勤が完了しました');
            return redirect('general/report');
        }
        
        $newTimestampDay = Carbon::today();
        
        // 日付を比較する。同日付の出勤打刻か、直前のTimestampの退勤打刻がされていない場合エラーを吐き出す。
        if (($oldTimestampDay == $newTimestampDay) || (empty($oldTimestamp->punchOut))) {
            return redirect()->back()->with('error', 'すでに出勤打刻がされています');
        }

        $timestamp = Timestamp::create([
            'user_id' => $user->id,
            'punchIn' => Carbon::now(),
        ]);
        
        Session::flash('my_status', '出勤が完了しました');
        return redirect('general/report');
    }

    public function punchOut()
    {
        $user = Auth::user();
        // 打刻の時間表示用
        $timestamp = Timestamp::where('user_id', $user->id)->latest()->first();
        
        if (empty($timestamp)) {
            return redirect()->back()->with('error', '出勤打刻されていません');
        }

        if (!empty($timestamp->punchOut)) {
            return redirect()->back()->with('error', '既に退勤の打刻がされているか、出勤打刻されていません');
        }
        $timestamp->update([
            'punchOut' => Carbon::now()
        ]);
        
        Session::flash('my_status', '退勤が完了しました');
        return redirect('general/report');
    }
}
