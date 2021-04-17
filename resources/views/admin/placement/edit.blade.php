{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', 'シフト登録')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h3>シフト登録</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 create-form">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ action('Admin\PlacementController@regist') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="form-group row">
                                <label for="user_id" class="col-md-3 col-form-label text-md-right">氏名</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="user_id" value="{{ $user->name }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="regist_date" class="col-md-3 col-form-label text-md-right">日付</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="regist_date" value="{{ $ymd }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="work_id" class="col-md-3 col-form-label text-md-right">案件名</label>
                                <div class="col-md-9">
                                    <select class="form-control" name="work_id">
                                        @if($works->isEmpty())
                                            <option value="">案件が未登録です</option>
                                        @else
                                            <option value=""></option>
                                            @foreach($works as $work)
                                                @if($placement != NULL && $work->id == $placement->work_id)
                                                    <option value="{{ $work->id }}" selected>{{ $work->work_title }}</option>
                                                @else
                                                    <option value="{{ $work->id }}">{{ $work->work_title }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="author_id" value="{{Auth::id()}}">
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="timestamp" value="{{ $timestamp }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-9 offset-md-3">
                                    <input type="submit" class="btn btn-primary mr-4 mt-2" value="登録">
                                    @if($placement)
                                    <button type="submit" class="btn btn-danger mt-2">
                                        <a href="{{ action('Admin\PlacementController@delete', ['id' => $user->id, 'timestamp' => $timestamp]) }}" class="delete">予定を削除</a>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection