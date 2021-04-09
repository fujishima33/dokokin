{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
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
            <div class="col-md-12 mx-auto p-0 mb-1 staff-info">
                <div class="staff-info-left">
                    <h4 class="my-auto"> {{ $user->name }}の出勤状況一覧</h4>
                </div>
                <div class="staff-info-right">
                    <button type="submit" class="btn btn-primary">
                        <a href="{{ action('Admin\ReportController@download', ['id' => $user->id]) }}">CSVダウンロード</a>
                    </button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mx-auto p-0">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="15%">日付</th>
                            <th width="15%">出勤時刻</th>
                            <th width="15%">退勤時刻</th>
                            <th width="20%">案件名</th>
                            <th width="40%">業務内容</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($reports != NULL)
                            @foreach($reports as $report)
                                <tr>
                                    <th>{{ $report->punchIn->format('n月j日') }}</th>
                                    <td>{{ $report->punchIn->format('H:i') }}
                                    
                                    
                                    </td>
                                    <td>
                                        @if($report->punchOut == null)
                                            未入力
                                        @else
                                            {{ $report->punchOut->format('H:i') }}
                                        @endif
                                    </td>
                                    <td>{{ $report->work_id }}</td>
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