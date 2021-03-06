<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Work;
use App\Timestamp;
use App\Placement;
use Auth;

class GeneralController extends Controller
{
    public function top()
    {
        // カレンダー表示
        // 表示するユーザー
        $user = Auth::user();
        
        // 前月・次月リンクが押された場合は、GETパラメーターから年月を取得
        if (isset($_GET['ym'])) {
            $ym = $_GET['ym'];
        } else {
            // 今月の年月を表示
            $ym = date('Y-m');
        }
      
        // タイムスタンプを作成し、フォーマットをチェックする
        $timestamp = strtotime($ym . '-01');
        if ($timestamp === false) {
            $ym = date('Y-m');
            $timestamp = strtotime($ym . '-01');
        }
      
        // 今日の日付 フォーマット
        $today = date('Y-m-j');
      
        // カレンダーのタイトルを作成
        $html_title = date('Y年n月', $timestamp);
      
        // 前月・次月の年月を取得
        $prev = date('Y-m', strtotime('-1 month', $timestamp));
        $next = date('Y-m', strtotime('+1 month', $timestamp));
      
        // 該当月の日数を取得
        $day_count = date('t', $timestamp);
      
        // １日が何曜日か　0:日 1:月 2:火 ... 6:土
        $youbi = date('w', $timestamp);
      
      
        // カレンダー作成の準備
        $weeks = [];
        $week = '';
      
        // 第１週目：空のセルを追加
        // 例）１日が水曜日だった場合、日曜日から火曜日の３つ分の空セルを追加する
        $week .= str_repeat('<td></td>', $youbi);
        
        // 現在ログインしているユーザーの管理者の全案件情報を取得
        $work_all = Work::where('author_id', Auth::user()->author_id)->get();
        
        // 現在ログインしているユーザーに指定された全ての人員配置情報を取得
        $registed_all = Placement::where('user_id', Auth::user()->id)->get();

        for ($day = 1; $day <= $day_count; $day++, $youbi++) {
            $date = $ym . '-' . $day;
            if ($today == $date) {
                // 今日の日付の場合は、class="today"をつける
                $week .= '<td class="today"><a><p>';
            } else {
                $week .= '<td><a><p>';
            }
            $week .= $day . '</p><div>';
            
            // 日付のフォーマット
            $formed_date = strtotime($date);
            $corrected_date = date('Y-m-d 00:00:00', $formed_date);
            
            // placementテーブルにあるデータから該当の日付のデータを取得し、配列を作成
            $registed = $registed_all->where('regist_date', $corrected_date)->all();
            $registed_list = array_unique(array_column($registed, 'work_id'));
            
            // workテーブルからデータを取得し、案件名の入った配列を作成
            $work_list = [];
            foreach ($registed_list as $rl) {
                $wl = $work_all->where('id', $rl)->first()->work_title;
                $work_list[] = $wl;
            }
            
            // spanタグと案件名を追加
            if (empty($work_list)) {
                '';
            } else {
                foreach ($work_list as $job) {
                    $week .= '<span class="badge badge-warning">' . $job . '</span>';
                }
            }
            // タグを閉じる
            $week .= '</div></a></td>';
            
            // 週終わり、または、月終わりの場合
            if ($youbi % 7 == 6 || $day == $day_count) {
                if ($day == $day_count) {
                    // 月の最終日の場合、空セルを追加
                    // 例）最終日が木曜日の場合、金・土曜日の空セルを追加
                    $week .= str_repeat('<td></td>', 6 - ($youbi % 7));
                }
              
                // weeks配列にtrと$weekを追加する
                $weeks[] = '<tr>' . $week . '</tr>';
              
                // weekをリセット
                $week = '';
            }
        }
        
        // 打刻ボタン関連
        $punch_today = date('Y-m-d');
        $punch_latest = Timestamp::where('user_id', $user->id)->latest()->first();
        if ($punch_latest == null) {
            $punch_latest_in = null;
            $punch_latest_out = null;
        } else {
            $punch_latest_in = date('Y-m-d', strtotime($punch_latest->punchIn));
            $punch_latest_out = date('Y-m-d', strtotime($punch_latest->punchOut));
        }
        
        return view('general', [
            'user' => $user,
            'prev' => $prev,
            'next' => $next,
            'html_title' => $html_title,
            'weeks' => $weeks,
            'date' => $date,
            'punch_today' => $punch_today,
            'punch_latest_in' => $punch_latest_in,
            'punch_latest_out' => $punch_latest_out,
            ]);
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
