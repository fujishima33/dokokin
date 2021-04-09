{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報 編集')


{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h3>日報の編集</h3>
            </div>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-md-12 create-form">
                <div class="card">
                    <div class="card-body">
                        <form  method="POST" action="{{ action('General\ReportController@update') }}" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf
                            
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            <div class="form-group row">
                                <label for="punchIn" class="col-md-4 col-form-label text-md-right">出勤時間</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" class="form-control" name="punchIn" value="{{ str_replace(" ", "T", $report_form->punchIn) }}">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="punchOut" class="col-md-4 col-form-label text-md-right">退勤時間</label>
                                <div class="col-md-6">
                                    <input type="datetime-local" class="form-control" name="punchOut" value="{{ str_replace(" ", "T", $report_form->punchOut) }}">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="work_id" class="col-md-4 col-form-label text-md-right">案件名</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="work_id" value="{{ $report_form->work_id }}">
                                        @if($works->isEmpty())
                                            <option value="">案件が未登録です</option>
                                        @else
                                            <option value=""></option>
                                            @foreach($works as $work)
                                                @if($work->id == $report_form->work_id)
                                                    <option value="{{ $work->id }}" selected>{{ $work->work_title }}</option>
                                                @else
                                                    <option value="{{ $work->id }}">{{ $work->work_title }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="detail" class="col-md-4 col-form-label text-md-right">本文</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" name="detail" rows="5">{{ $report_form->detail }}</textarea>
                                </div>
                            </div>
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <input type="hidden" name="id" value="{{ $report_form->id }}">
                                    {{ csrf_field() }}
                                    <input type="submit" class="btn btn-primary" value="更新">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection