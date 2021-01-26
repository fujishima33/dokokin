{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '社員情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>社員情報</h2>
            </div>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@add') }}">新規登録</a>
            </div>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@edit') }}">社員情報編集</a>
            </div>
            <br>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@top') }}">管理者ページへ戻る</a>
            </div>
        </div>
        <div class="row">
            <div class="list-news col-md-8 mx-auto">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">氏名</th>
                                <th width="30%">メールアドレス</th>
                                <th width="20%">権限<br> 管理者は5<br> 一般ユーザは10</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $user)
                                <tr>
                                    <th>{{ $user->name }}</th>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td><div><a href="">編集</a></div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection