{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報 編集')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>日報 編集</h2>
                
                <form action="{{ action('General\ReportController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2" for="date">月日</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="date" value="{{ $report_form->punchIn }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="punchIn">出勤時間</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="punchIn" value="{{ $report_form->punchIn }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="punchOut">退勤時間</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="punchOut" value="{{ $report_form->punchOut }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="work_id">案件名</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="work_id" value="{{ $report_form->work_id }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-2" for="detail">本文</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="detail" rows="5">{{ $report_form->detail }}</textarea>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-6">
                            <input type="hidden" name="id" value="{{ $report_form->id }}">
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-primary" value="更新">
                        </div>
                    </div>
                </form>
                
            </div>
        </div>
        
    </div>
@endsection