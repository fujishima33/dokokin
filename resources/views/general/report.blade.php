{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                
                <h2>日報（一般）</h2>
                
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>
                            @if($timestamp == NULL)
                            出勤状況
                            @else
                            {{ $timestamp->punchIn->format('m月d日 ') }}の出勤状況
                            @endif
                        </h3>
                    </div>
                    
                    
                    
                    @if (session('my_status'))
                        <div class="container mt-2">
                            <div class="alert alert-success">
                                {{ session('my_status') }}
                            </div>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                            <div class="m-2 pl-4 h4 d-inline-block">出勤時間</div>
                            <div class="m-2 pl-4 h4 d-inline-block">
                                @if($timestamp == NULL)
                                    初回の打刻をして下さい
                                @else
                                    {{ $timestamp->punchIn->format('H:i:s') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                            <div class="m-2 pl-4 h4 d-inline-block">退勤時間</div>
                            <div class="m-2 pl-4 h4 d-inline-block">
                                @if($timestamp == NULL)
                                    初回の打刻をして下さい
                                @elseif($timestamp->punchOut == NULL)
                                    未入力です
                                @else
                                    {{ $timestamp->punchOut->format('H:i:s') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border p-3">
                    <div class="">
                        <h3>出勤状況一覧</h3>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            <div class="row">
                                <table class="table table-gray">
                                    <thead>
                                        <tr>
                                            <th width="12%">日付</th>
                                            <th width="12%">出勤時刻</th>
                                            <th width="12%">退勤時刻</th>
                                            <th width="20%">案件名</th>
                                            <th width="34%">業務内容</th>
                                            <th width="10%">編集</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($reports != NULL)
                                            @foreach($reports as $report)
                                                <tr>
                                                    <th>{{ $report->punchIn->format('m月d日') }}</th>
                                                    <td>{{ $report->punchIn->format('H:i:s') }}</td>
                                                    <td>
                                                        @if($report->punchOut == null)
                                                        未入力です
                                                        @else
                                                        {{ $report->punchOut->format('H:i:s') }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $report->work_id }}</td>
                                                    <td>{{ \Str::limit($report->detail, 20) }}</td>
                                                    <td>
                                                        <div>
                                                            <a href="{{ action('General\ReportController@edit', ['id' => $report->id]) }}">編集</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection