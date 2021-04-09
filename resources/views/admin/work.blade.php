{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '案件情報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>案件情報</h2>
            </div>
        </div>
        
        <div class="row">
            
            <div class="col-md-12">
                <a href="{{ action('Admin\WorkController@create') }}">新規登録</a>
            </div>
            
            <div class="list-news col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">案件名</th>
                                <th width="30%">内容</th>
                                <th width="10%">進行状況</th>
                                <th width="5%"></th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($works as $work)
                                <tr>
                                    <th>{{ $work->work_title }}</th>
                                    <td>{{ $work->body }}</td>
                                    <td>{{ $work->status }}</td>
                                    <td><div><a href="{{ action('Admin\WorkController@edit', ['id' => $work->id]) }}">編集</a></div></td>
                                    <td><div><a href="{{ action('Admin\WorkController@delete', ['id' => $work->id]) }}">削除</a></div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection