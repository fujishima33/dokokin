{{-- layouts/user.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- user.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '一般ユーザトップページ')

{{-- user.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>一般ユーザトップページ</h2>
            </div>
        </div>
    </div>
@endsection