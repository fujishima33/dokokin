{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '連絡事項')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0">
                <h3>連絡事項一覧（このページは未作成です）</h3>
            </div>
        </div>
        
    </div>
@endsection