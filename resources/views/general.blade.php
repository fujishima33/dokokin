{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '一般ユーザーページ')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto container-all">
                <div class="border mb-3 p-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 mx-auto gen-avatar">
                            @if($user->image_path == null)
                                <img class="no-image">
                            @else
                                <img src="{{ $user->image_path }}">
                            @endif
                            <h5>{{ $user->name }}</h5>
                        </div>
                        
                        <div class="row col-sm-12 col-md-8 m-auto punch">
                            
                            <div  class="col-sm-12 col-xl-6 m-auto p-0">
                                <div class="time">
                                    <p id="toda"></p>
                                    <p id="realtime"></p>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-xl-6 mx-auto p-0">
                                <div class='d-inline-block punch-button'>
                                    <form method="POST" action="{{ route('timestamp/punchin') }}">
                                        @csrf
                                        @method('POST')
                                        @if($punch_today == $punch_latest_in)
                                            <button type="submit" class="btn btn-primary btn-lg m-3" disabled>出勤</button>
                                        @else
                                            <button type="submit" class="btn btn-primary btn-lg m-3">出勤</button>
                                        @endif
                                    </form>
                                </div>
                                <div class='d-inline-block punch-button'>
                                    <form method="POST" action="{{ route('timestamp/punchout') }}">
                                        @csrf
                                        @method('POST')
                                        @if($punch_today == $punch_latest_out)
                                            <button type="submit" class="btn btn-danger btn-lg m-3" disabled>退勤</button>
                                        @else
                                            <button type="submit" class="btn btn-danger btn-lg m-3">退勤</button>
                                        @endif
                                    </form>
                                </div>
                                <div>
                                    <a class="m-3" href="{{ action('General\ReportController@report') }}">日報を確認する</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mx-auto w-100">
                        @if (session('error'))
                            <div class="container mt-2 mx-auto">
                              <div class="alert alert-danger text-center">
                                  {{ session('error') }}
                              </div>
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="border mb-3 p-3 top-info">
                    <div>
                        <h3>連絡事項</h3>
                    </div>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"  style="width:40%">投稿時間</th>
                                <th scope="col" style="width:60%">タイトル</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2021.2.5 18:00</td>
                                <td>おしらせ１</td>
                            </tr>
                            <tr>
                                <td>2021.2.5 17:00</td>
                                <td>おしらせ２</td>
                            </tr>
                            <tr>
                                <td>2021.2.5 16:00</td>
                                <td>おしらせ３</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="border p-3">
                    <div>
                        <h3>予定一覧</h3>
                    </div>
                    <div class="calendar">
                        <h4>
                            <a href="?ym={{ $prev }}">&lt;</a>
                            {{ $html_title }}
                            <a href="?ym={{ $next }}">&gt;</a>
                        </h4>
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