{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '案件一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0 mb-1 staff-info">
                <div class="staff-info-left">
                    <h3>案件一覧</h3>
                </div>
                <div class="staff-info-right">
                    <button type="submit" class="btn btn-primary">
                        <a href="{{ action('Admin\WorkController@create') }}">新規登録</a>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mx-auto p-0 table-responsive-lg">
                <table class="table table-bordered work-index">
                    <thead>
                        <tr>
                            <th width="20%" class="th-aw-1">案件名</th>
                            <th width="50%" class="th-aw-2">内容</th>
                            <th width="20%" class="th-aw-3">進行状況</th>
                            <th width="10%" class="th-aw-4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($works as $work)
                            <tr>
                                <th><div class="work-index-column">{{ $work->work_title }}</div></th>
                                <td><div class="work-index-column">{{ $work->body }}</div></td>
                                <td><div class="work-index-column">{{ $work->status }}</div></td>
                                <td>
                                    <div class="work-index-column">
                                        <a href="{{ action('Admin\WorkController@edit', ['id' => $work->id]) }}">編集</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $works->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection