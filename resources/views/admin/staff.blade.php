{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '社員一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>社員一覧</h2>
            </div>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@add') }}">新規登録</a>
            </div>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@edit') }}">社員情報編集</a>
            </div>
        </div>
    </div>
@endsection