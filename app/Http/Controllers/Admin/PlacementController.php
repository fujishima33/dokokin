<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Work;
use App\Placement;
use Auth;

class PlacementController extends Controller
{
    public function index()
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
        
        // 第１週目に空のセルを追加
        // 例）１日が水曜日だった場合、日曜日から火曜日の３つ分の空セルを追加する
        $week .= str_repeat('<td></td>', $youbi);
        
        for ($day = 1; $day <= $day_count; $day++, $youbi++) {
            $date = $ym . '-' . $day;
            
            if ($today == $date) {
                // 今日の日付の場合は、class="today"をつける
                $week .= '<td class="today"><a href="placement/single?id=' . $date . '"><p>';
            } else {
                $week .= '<td><a href="placement/single?id=' . $date . '"><p>';
            }
            $week .= $day . '</p></a></td>';
            
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
        return view('admin.placement', ['prev' => $prev, 'next' => $next, 'html_title' => $html_title, 'weeks' => $weeks, 'date' => $date ]);
    }
    
    public function single(Request $request)
    {
        $date = $request->id;
        $timestamp = strtotime($date);
        $md = date('n月j日', $timestamp);
        $date = date('Y-m-d 00:00:00', $timestamp);
        
        $users = Auth::user()->general_users;
        $regist = Placement::where('regist_date', $date)->get();
        $work = Work::get();
        
        return view('admin.placement.single', ['timestamp' => $timestamp, 'md' => $md, 'users' => $users, 'regist' => $regist, 'work' => $work]);
    }
    
    public function edit(Request $request)
    {
        $timestamp = $request->timestamp;
        $ymd = date('Y.n.j', $timestamp);
        $user = User::find($request->id);
        
        return view('admin.placement.edit', ['timestamp' => $timestamp, 'ymd' => $ymd, 'user' => $user]);
    }
    
    public function regist(Request $request)
    {
        // Varidationを行う
        $this->validate($request, Placement::$rules);
        
        // 日付とユーザーに一致するデータを探す
        $timestamp = $request->timestamp;
        $date = date("Y-m-d 00:00:00", $timestamp);
        $find = Placement::where('regist_date', $date)
            ->where('user_id', $request->id)
            ->first();
            
        // 登録データの有無を確認
        if (!isset($find)) {
            // データが無い時は新しく作成
            $placement = new Placement;
            $form = $request->all();
            
            // フォームから送信されてきた_tokenを削除する
            unset($form['_token']);
            unset($form['id']);
            unset($form['timestamp']);
            
            // 送信されてきたuser_idはユーザー名なので、idの値を上書きする
            $user = User::where('name', $request->user_id)->first();
            $form['user_id'] = $user->id;
            
            // 登録されている案件のidの値を上書きする
            $work = Work::where('work_title', $request->work_id)->first();
            $form['work_id'] = $work->id;
            
            // 該当するデータを上書きして保存する
            $placement->fill($form)->save();
        } else {
            // データが有る時は上書き
            $form = $request->all();
            unset($form['_token']);
            unset($form['id']);
            unset($form['timestamp']);
            
            // 送信されてきたuser_idはユーザー名なので、idの値を上書きする
            $user = User::where('name', $request->user_id)->first();
            $form['user_id'] = $user->id;
            
            // 登録されている案件のidの値を上書きする
            $work = Work::where('work_title', $request->work_id)->first();
            $form['work_id'] = $work->id;
            
            // 該当するデータを上書きして保存する
            $placement = $find->fill($form)->save();
        }
        
        // viewファイルで表示する内容
        $md = date('n月j日', $timestamp);
        $users = Auth::user()->general_users;
        
        $regist = Placement::where('regist_date', $date)->get();
        $work = Work::get();
        return view('admin.placement.single', ['timestamp' => $timestamp, 'md' => $md, 'users' => $users, 'regist' => $regist, 'work' => $work]);
    }
    
    
    // 案件一括登録（保留）
    public function create()
    {
        return view('admin.placement.create');
    }
}
