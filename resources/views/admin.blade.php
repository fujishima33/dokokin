{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '管理者トップページ')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>管理者トップページ</h2>
            </div>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@show') }}">社員情報</a>
            </div>
        </div>
    </div>
@endsection