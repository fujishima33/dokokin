{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '日報詳細')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0">
                <h3>日報詳細</h3>
            </div>
        </div>    
        <div class="row">
            <div class="col-md-12 mx-auto p-0 mb-1 staff-info row">
                <div class="col-xs-12 my-2 staff-info-left">
                    <h4 class="my-auto"> {{ $user->name }}の出勤状況一覧</h4>
                </div>
                <div class="col-xs-12 my-2 staff-info-right">
                    <button type="submit" class="btn btn-primary">
                        <a href="{{ action('Admin\ReportController@download', ['id' => $user->id]) }}">CSVダウンロード</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mx-auto p-0 table-responsive-xl">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="15%" class="th-ars-1">日付</th>
                            <th width="15%" class="th-ars-2">出勤時刻</th>
                            <th width="15%" class="th-ars-3">退勤時刻</th>
                            <th width="20%" class="th-ars-4">案件名</th>
                            <th width="35%" class="th-ars-5">業務内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($reports != NULL)
                            @foreach($reports as $report)
                                <tr>
                                    <th>{{ $report->punchIn->format('n月j日') }}</th>
                                    <td>{{ $report->punchIn->format('G:i') }}</td>
                                    <td>
                                        @if($report->punchOut == null)
                                            未入力
                                        @else
                                            {{ $report->punchOut->format('G:i') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($report->work_id != NULL)
                                            {{ $works->where('id', $report->work_id)->first()->work_title }}
                                        @endif
                                    </td>
                                    <td>{{ $report->detail }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $reports->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection