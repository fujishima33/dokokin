{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '案件編集')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>案件編集</h2>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">案件登録</div>
                    <div class="card-body">
                        <form action="{{ action('Admin\WorkController@update') }}" method="post" enctype="multipart/form-data">

                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="form-group row">
                                <label class="col-md-2">案件名</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="work_title" value="{{ $work_form->work_title }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">内容</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" name="body" rows="5">{{ $work_form->body }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2">進行状況</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="status">
                                        <option value="入力なし"></option>
                                        <option value="未着手">未着手</option>
                                        <option value="進行中">進行中</option>
                                        <option value="完了">完了</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $work_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection