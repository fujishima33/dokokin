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
use Illuminate\Support\Facades\DB;

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
    
    public function download(Request $request)
    {
        $user_name = User::where('id', $request->id)->first()->name;
        $timestamps = Timestamp::where('user_id', $request->id)->get()->toArray();
        
        // StreamedResponseの第1引数（コールバック関数）
        $response = new StreamedResponse(
            function () use ($timestamps) {
        
                // ファイルの書き出し
                $stream = fopen('php://output', 'w');
                // ヘッダの設定
                $head = [
                    '日付',
                    '出勤時刻',
                    '退勤時刻',
                    '案件名',
                    '業務内容'
                ];
                // 宣言したストリームに対してヘッダを書き出し
                fputcsv($stream, $head);
    
                if ($timestamps) {
                    foreach ($timestamps as $time) {
                        // ストリームに対して1行ごと書き出し
                        fputcsv($stream, [
                            date('Y年n月d日', strtotime($time["punchIn"])),
                            date('G:i', strtotime($time["punchIn"])),
                            date('G:i', strtotime($time["punchOut"])),
                            isset($time["work_id"]) ? Work::where('id', $time["work_id"])->first()->work_title : null,
                            $time["detail"],
                        ]);
                    }
                }
                mb_convert_variables('SJIS-win', 'UTF-8', $stream);
                fclose($stream);
            },
            // StreamedResponseの第2引数（レスポンス）
             \Illuminate\Http\Response::HTTP_OK,
            // StreamedResponseの第3引数（レスポンスヘッダ）
            [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="日報"' . $user_name . '.csv',
            ]
        );
        return $response;
    }
}
