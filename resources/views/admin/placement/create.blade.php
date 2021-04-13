{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '人員配置')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>人員配置（一括登録）</h2>
            </div>
        </div>
        
        <div>-</div>
        
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">案件名</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">期間（開始）</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">期間（終了）</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">メンバー</label>
            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>
        
    </div>
@endsection