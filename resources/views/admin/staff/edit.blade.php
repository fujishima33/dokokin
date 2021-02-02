{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '社員情報編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>社員情報編集</h2>
            </div>
            <div class="col-md-8 mx-auto">
                <a href="{{ action('Admin\StaffController@index') }}">一覧へ戻る</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">アカウント登録</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ action('Admin\StaffController@update') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">氏名</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user_form->name }}" required autocomplete="name" autofocus>
    
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user_form->email }}" required autocomplete="email">
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <!--<div class="form-group row">-->
                            <!--    <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>-->
    
                            <!--    <div class="col-md-6">-->
                            <!--        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user_form->password }}" required autocomplete="new-password">-->
    
                            <!--        @error('password')-->
                            <!--            <span class="invalid-feedback" role="alert">-->
                            <!--                <strong>{{ $message }}</strong>-->
                            <!--            </span>-->
                            <!--        @enderror-->
                            <!--    </div>-->
                            <!--</div>-->
    
                            <!--<div class="form-group row">-->
                            <!--    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワードの確認</label>-->
    
                            <!--    <div class="col-md-6">-->
                            <!--        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ $user_form->password_confirmation }}" required autocomplete="new-password">-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">権限</label>
    
                                <div class="col-md-6">
                                    <input id="role" type="number" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $user_form->role }}" placeholder="管理者は5、一般ユーザは10を入力" required autocomplete="role">
    
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden" name="id" value="{{ $user_form->id }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        更新
                                    </button>
                                    <div>
                                        <a href="{{ action('Admin\StaffController@delete', [ 'id' => $user_form->id]) }}">削除</a>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection