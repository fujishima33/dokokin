{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <h2>日報（管理用）</h2>
            </div>
        </div>
        
        <div class="row">
            <div class="list-news col-md-10">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="20%">氏名</th>
                                <th width="20%">出勤時間</th>
                                <th width="20%">退勤時間</th>
                                <th width="10%">表示</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users != NULL)
                                @foreach($users as $user)
                                    <tr>
                                        <th>{{ $user->name }}</th>
                                        <td>{{ $user->timestamp->sortByDesc('updated_at')->first()->punchIn->format('H:i:s') }}</td>
                                        <td>{{ $user->timestamp->sortByDesc('updated_at')->first()->punchOut->format('H:i:s') }}</td>
                                        <td><div><a href="{{ action('Admin\ReportController@single', ['id' => $user->id]) }}">表示する</a></div></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection