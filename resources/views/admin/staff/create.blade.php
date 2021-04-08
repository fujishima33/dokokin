{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '社員新規登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h3>社員新規登録</h3>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 create-form">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ action('Admin\StaffController@create') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">氏名</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @if ($errors->has('name'))
                                        <div class="text-danger">{{$errors->first('name')}}</div>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @if ($errors->has('email'))
                                        <div class="text-danger">{{$errors->first('email')}}</div>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
                                
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @if ($errors->has('password'))
                                        <div class="text-danger">{{$errors->first('password')}}</div>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワードの確認</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="image" class="col-md-4 col-form-label text-md-right">アイコン画像</label>
                                
                                <div class="col-md-6">
                                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                                    @if ($errors->has('image'))
                                        <div class="text-danger">{{$errors->first('image')}}</div>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden" name="role" value="10" checked>
                                    <input type="hidden" name="author_id" value="{{Auth::id()}}">
                                    <button type="submit" class="btn btn-primary">
                                        登録
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection