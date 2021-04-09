<?php

namespace App\Services;

use App\User;
use App\Work;
use App\Timestamp;
use Goodby\CSV\Export\Standard\Exporter;
use Goodby\CSV\Export\Standard\ExporterConfig;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Http\Request;

final class CsvDownloader
{
    /**
     * @return StreamedResponse
     */
    public function download(): StreamedResponse
    {
        $callback = function () {
            $config = new ExporterConfig();
            $config
                ->setDelimiter(',') // 区切り文字
                ->setEnclosure('"') // 囲み文字
                ->setEscape('\\') // エスケープ文字
                ->setToCharset(null) // 出力ファイルの文字コード
                ->setFromCharset('auto') // 読み込み元の文字コード
                ->setColumnHeaders($this->makeCsvHeader()); // CSVの1列目のヘッダー行
            $exporter = new Exporter($config);
            $exporter->export('php://output', $this->makeCsvBody());
        };

        return response()->streamDownload($callback, $this->makeFilename(), $this->makeResponseHeader());
    }

    /**
     * @return array
     */
    private function makeCsvHeader(): array
    {
        return ['名前', '日付', '出勤時刻', '退勤時刻', '案件名', '業務内容'];
    }

    /**
     * @return array
     */
    private function makeCsvBody(): array
    {
        $timestamps = $this->getTimestamps();

        $data = [];
        foreach ($timestamps as $timestamp) {
            $data[] = $this->toCsvFromTimestamp($timestamp);
            // $work = Work::where('id', $timestamp->work_id)->first()->work_title;
            // $data[4] = $work;
            // array_push($data, "aaa");
        }
        
        return $data;
    }

    /**
     * @param Timestamp $timestamp
     * @return array
     */
    private function toCsvFromTimestamp(Timestamp $timestamp): array
    {
        return [
            $timestamp->user_id,
            $timestamp->punchIn->format('Y年n月j日'),
            $timestamp->punchIn->format('G:i'),
            $timestamp->punchOut->format('G:i'),
            $timestamp->work_id,
            $timestamp->detail,
        ];
    }

    /**
     * @return Collection
     */
    private function getTimestamps(): Collection
    {
        // requestのユーザーのidを使って、Timestampテーブルから日報のデータを取得（日付の昇順）
        $user_id = request('id');
        return Timestamp::where('user_id', $user_id)->orderBy('punchIn', 'asc')->get();
    }

    /**
     * @return array
     */
    private function makeResponseHeader(): array
    {
        return [
            'Content-type' => 'text/csv',
            'Cache-Control' => 'must-revalidate, no-cache',
            'Expires' => '0',
        ];
    }

    /**
     * @return string
     */
    private function makeFilename(): string
    {
        // requestのidからユーザーの名前を取得し、ファイル名に設定
        $user_id = request('id');
        $user = User::where('id', $user_id)->first()->name;
        return '日報_' . $user . '.csv';
    }
}
