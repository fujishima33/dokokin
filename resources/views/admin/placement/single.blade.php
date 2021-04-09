{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', 'シフト一覧（日別）')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0">
                <h3>{{ $md }}の予定</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="20%">氏名</th>
                                <th width="60%">案件名</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th>{{ $user->name }}</th>
                                    @if($regist->where('user_id', $user->id)->first() == NULL)
                                        <td>未登録</td>
                                    @else
                                        <td>{{ $work->where('id', $regist->where('user_id', $user->id)->first()->work_id)->first()->work_title }}</td>
                                    @endif
                                    <td>
                                        <div>
                                            <a href="{{ action('Admin\PlacementController@edit', ['id' => $user->id, 'timestamp' => $timestamp]) }}">
                                            登録
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection