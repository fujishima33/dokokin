{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '連絡事項 編集')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>連絡事項 編集</h2>
            </div>
        </div>
        
    </div>
@endsection