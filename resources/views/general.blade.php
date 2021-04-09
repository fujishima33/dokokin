{{-- layouts/user.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- user.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '一般ユーザトップページ')

{{-- user.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div>
                    <h2>一般ユーザトップページ</h2>    
                </div>
                
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>{{ $user->name }}</h3>
                        <img src="{{ asset('storage/image/' . $user->image_path) }}">
                    </div>
                    
                    <div class="">
                        <h3>出勤状況</h3>
                    </div>
                    <div class='d-inline-block'>
                        <form method="POST" action="{{ route('timestamp/punchin') }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-primary btn-lg m-3">出勤</button>
                        </form>
                    </div>
                    <div class='d-inline-block'>
                        <form method="POST" action="{{ route('timestamp/punchout') }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger btn-lg m-3">退勤</button>
                        </form>
                    </div>
                    <div class='d-inline-block'>
                        <a class="m-3" href="{{ action('General\ReportController@report') }}">日報を確認する</a>
                    </div>
                    @if (session('error'))
                        <div class="container mt-2">
                          <div class="alert alert-danger">
                              {{ session('error') }}
                          </div>
                        </div>
                    @endif
                    
                </div>
                
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>連絡事項</h3>
                    </div>
                    
                    <table class="table table-hover">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col"  style="width:30%">投稿日時</th>
                          <th scope="col" style="width:70%">タイトル</th>
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
                    <div>
                        <a href="{{ action('GeneralController@info') }}">連絡事項一覧へ</a>
                    </div>
                </div>
                
                <div class="border p-3">
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