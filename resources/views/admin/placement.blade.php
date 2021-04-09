{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '人員配置')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                
                <div class="">
                    <h2>人員配置</h2>
                </div>
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>今日の予定</h3>
                    </div>
                    <div>
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">氏名</th>
                                <th width="30%">案件名</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->name }}</th>
                                    @if($regist->where('user_id', $user->id)->first() == NULL)
                                        <td>未登録</td>
                                    @else
                                        <td>{{ $works->where('id', $regist->where('user_id', $user->id)->first()->work_id)->first()->work_title }}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>予定一覧</h3>
                    </div>
                    
                    <div class="calendar">
                        <h3>
                            <a href="?ym={{ $prev }}">&lt;</a>
                            {{ $html_title }}
                            <a href="?ym={{ $next }}">&gt;</a>
                        </h3>
                        
                        <table class="table table-bordered">
                            <tr>
                                <th>日</th>
                                <th>月</th>
                                <th>火</th>
                                <th>水</th>
                                <th>木</th>
                                <th>金</th>
                                <th>土</th>
                            </tr>
                            @foreach($weeks as $week)
                                {!! $week !!}
                            @endforeach
                        </table>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>
@endsection