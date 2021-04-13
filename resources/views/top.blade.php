{{-- layouts/top.blade.phpを読み込む --}}
@extends('layouts.top')

{{-- top.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', 'どこ勤')

{{-- top.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container first">
        <div class="section-1 row">
            
            <div class="left col-md-6">
                <div class="row">
                    <div class="col-md-12 mx-auto mb-3">
                        <p>勤怠管理システム</p>
                    </div>
                    <div class="col-md-12 mx-auto my-2">
                        <h1>どこ勤</h1>
                    </div>
                    <div class="col-md-12 mx-auto my-3">
                        <p>スマホ・PCでどこにいても勤怠管理ができる</p>
                    </div>
                    <div class="col-md-12 mx-auto my-2">
                        <button type="submit" class="btn btn-primary new-account">
                            <a href="/register">新しくアカウントを登録</a>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="right col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="login-box card">
                            <div class="login-header card-header mx-auto" id="li">ログイン</div>
        
                            <div class="login-body card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
        
                                    <div class="form-group row">
                                        <label for="email" class="col-md-5 col-form-label text-md-right">メールアドレス</label>
        
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="password" class="col-md-5 col-form-label text-md-right">パスワード</label>
        
                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <div class="col-md-12 text-center">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> パスワードを記憶する
                                                </label>
                                            </div>
                                        </div>
                                    </div>
        
                                    <div class="form-group row mb-0">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">
                                                ログイン
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

{{-- top.blade.phpの@yield('content-second')に以下のタグを埋め込む --}}
@section('content-second')
    <div class="container second">
        <div class="section-2 row">
            <div class="col-md-12 explain">
                <div class="mt-5 mb-3">
                    <h5 class="font-weight-bold">※本アプリについて※</h5>
                    <p>このアプリは管理者と一般ユーザーで表示される内容が異なります。</p>
                    <p>以下のアドレスとパスワードを使用して頂ければすぐに閲覧が可能です。</p>
                </div>
                <div class="my-3">
                    <p class="font-weight-bold">管理者アカウント</p>
                    <p>メールアドレス：admin@test.com</p>
                    <p>パスワード：1111aaaa</p>
                </div>
                <div class="my-3">
                    <p class="font-weight-bold">一般ユーザーアカウント</p>
                    <p>メールアドレス：user@test.com</p>
                    <p>パスワード：1111aaaa</p>
                </div>
                
            </div>
            
        </div>
    </div>
@endsection