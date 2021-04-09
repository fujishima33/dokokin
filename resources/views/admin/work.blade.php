{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '案件情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>案件情報</h2>
            </div>
            <div class="col-md-12 mx-auto">
                <a href="{{ action('Admin\WorkController@add') }}">新規登録</a>
            </div>
        </div>
        
        
    </div>
@endsection