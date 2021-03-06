{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '案件登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h3>案件登録</h3>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 create-form">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ action('Admin\WorkController@create') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">案件名</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control @error('work_title') is-invalid @enderror" name="work_title" value="{{ old('work_title') }}">
                                    @if ($errors->has('work_title'))
                                        <div class="text-danger">{{$errors->first('work_title')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">内容</label>
                                <div class="col-md-9">
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" rows="5">{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <div class="text-danger">{{$errors->first('body')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">進行状況</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="status">
                                        <option value="入力なし"></option>
                                        <option value="未着手">未着手</option>
                                        <option value="進行中">進行中</option>
                                        <option value="完了">完了</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="author_id" value="{{Auth::id()}}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-9 offset-md-3">
                                    <input type="submit" class="btn btn-primary" value="登録">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection