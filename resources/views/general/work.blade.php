{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '案件一覧')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0 mb-1 staff-info">
                <div>
                    <h3>案件一覧</h3>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered work-index">
                        <thead>
                            <tr>
                                <th width="20%">案件名</th>
                                <th width="30%">内容</th>
                                <th width="10%">進行状況</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($works as $work)
                                <tr>
                                    <th><div class="work-index-column">{{ $work->work_title }}</div></th>
                                    <td><div class="work-index-column">{{ $work->body }}</div></td>
                                    <td><div class="work-index-column">{{ $work->status }}</div></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination">
                        @if ( $works->hasPages() )
                            {{ $works->links() }}
                        @else
                            <div class="pager">
                                <div class="prev">&lt;</div>
                                <div class="current">1</div>
                                <div class="next">&gt;</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection