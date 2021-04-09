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
                            
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->name }}</th>
                                    <td>{{ $user->timestamp->sortByDesc('created_at')->first()->punchIn }}</td>
                                    <td>{{ $user->timestamp->sortByDesc('created_at')->first()->punchOut }}</td>
                                    <td><div><a href="">表示する</a></div></td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
@endsection