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
        
        <div>
            <form action="{{ action('Admin\PlacementController@regist') }}" method="post" enctype="multipart/form-data">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="form-group row">
                    <label for="user_id" class="col-md-2 col-form-label text-md-right">氏名</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="user_id" value="{{ $user->name }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regist_date" class="col-md-2 col-form-label text-md-right">日付</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="regist_date" value="{{ $ymd }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="work_id" class="col-md-2 col-form-label text-md-right">案件名</label>
                    <div class="col-md-6">
                        <select class="form-control" name="work_id">
                            @if($works->isEmpty())
                                <option value="">案件が未登録です</option>
                            @else
                                @foreach($works as $work)
                                        <option value="{{ $work->id }}">{{ $work->work_title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <input type="hidden" name="author_id" value="{{Auth::id()}}">
                <input type="hidden" name="id" value="{{ $user->id }}">
                <input type="hidden" name="timestamp" value="{{ $timestamp }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="更新">
            </form>
        </div>
        
    </div>
@endsection