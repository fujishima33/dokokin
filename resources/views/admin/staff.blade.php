{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '社員情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>社員情報</h2>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-md-8">
                <a href="{{ action('Admin\StaffController@add') }}">新規登録</a>
            </div>
            
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">氏名</th>
                                <th width="30%">メールアドレス</th>
                                <th width="20%">権限</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->name }}</th>
                                    <td>{{ $user->email }}</td>
                                    @if($user->role == 5)
                                        <td>管理者</td>
                                    @elseif($user->role == 10)
                                        <td>一般ユーザー</td>
                                    @endif
                                    <td><div><a href="{{ action('Admin\StaffController@edit', ['id' => $user->id]) }}">編集</a></div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection