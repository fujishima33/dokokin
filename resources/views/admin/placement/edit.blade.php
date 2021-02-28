{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '人員配置')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>予定の編集</h2>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">氏名</label>
            <div class="col-md-6">{{ $user->name }}</div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">日付</label>
            <div class="col-md-6">{{ $md }}</div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">案件名</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    登録
                </button>
            </div>
        </div>
        
    </div>
@endsection