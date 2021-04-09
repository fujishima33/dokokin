{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報一覧')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto container-all">
                <div class="border mb-3 p-3">
                    <div>
                        <h3>
                            @if($timestamp == NULL)
                            出勤状況
                            @else
                            {{ $timestamp->punchIn->format('n月j日 ') }}の出勤状況
                            @endif
                        </h3>
                    </div>
                    
                    @if (session('my_status'))
                        <div class="container mt-2">
                            <div class="alert alert-success text-center">
                                {{ session('my_status') }}
                            </div>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-1 punch-newest">
                            <div class="m-2 pl-4 d-inline-block">出勤時刻</div>
                            <div class="m-2 pl-4 d-inline-block">
                                @if($timestamp == NULL)
                                    初回の打刻をして下さい
                                @else
                                    {{ $timestamp->punchIn->format('G:i') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 offset-md-1 punch-newest">
                            <div class="m-2 pl-4 d-inline-block">退勤時刻</div>
                            <div class="m-2 pl-4 d-inline-block">
                                @if($timestamp == NULL)
                                    初回の打刻をして下さい
                                @elseif($timestamp->punchOut == NULL)
                                    未入力です
                                @else
                                    {{ $timestamp->punchOut->format('G:i') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border mb-3 p-3">
                    <div>
                        <h3>日報一覧</h3>
                    </div>
                    
                    <table class="table table-bordered gen-report">
                        <thead>
                            <tr>
                                <th width="12%">日付</th>
                                <th width="12%">出勤時刻</th>
                                <th width="12%">退勤時刻</th>
                                <th width="20%">案件名</th>
                                <th width="34%">業務内容</th>
                                <th width="10%"></th>
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
                                            未入力です
                                            @else
                                            {{ $report->punchOut->format('G:i') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($report->work_id == null)
                                                未入力です
                                            @else
                                                <a href="work">{{ $works->where('id', $report->work_id)->first()->work_title }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($report->detail == null)
                                                未入力です
                                            @else
                                                {{ \Str::limit($report->detail, 30) }}
                                            @endif
                                        </td>
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
                    <div class="pagination">
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection