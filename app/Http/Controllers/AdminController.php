<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function top()
    {
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

        for ($day = 1; $day <= $day_count; $day++, $youbi++) {
            $date = $ym . '-' . $day;
          
            if ($today == $date) {
                // 今日の日付の場合は、class="today"をつける
                $week .= '<td class="today"><a href="{{ action(' . 'Admin\PlacementController@single' . ') }}"><p>' . $day;
            } else {
                $week .= '<td><a href="{{ action(' . 'Admin\PlacementController@single' . ') }}"><p>' . $day;
            }
            $week .= '</p></a></td>';
      
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
        // dd($weeks);
        return view('admin', ['prev' => $prev, 'next' => $next, 'html_title' => $html_title, 'weeks' => $weeks ]);
    }
    
    
    public function report()
    {
        return view('admin.report');
    }
    
    public function info()
    {
        return view('admin.info');
    }
    
    public function apply()
    {
        return view('admin.apply');
    }
    
    public function work()
    {
        return view('admin.work');
    }
}
