{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '管理者トップページ')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div>
                    <h2>管理者トップページ</h2>
                </div>
                
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>連絡事項</h3>
                    </div>
                    
                    <table class="table table-hover">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col"  style="width:30%">投稿時間</th>
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
                        <a href="{{ action('AdminController@info') }}">連絡事項一覧へ</a>
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