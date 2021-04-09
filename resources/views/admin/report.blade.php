{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0">
                <h3>日報一覧</h3>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="20%">氏名</th>
                                <th width="30%">出勤時間</th>
                                <th width="30%">退勤時間</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($users != NULL)
                                @foreach($users as $user)
                                    <tr>
                                        <th>{{ $user->name }}</th>
                                        <td>
                                            @if( $timestamp->where('user_id', $user->id)->first() == NULL)
                                                データなし
                                            @else
                                                {{ $user->timestamp->sortByDesc('updated_at')->first()->punchIn->format('H:i') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if( $timestamp->where('user_id', $user->id)->first() == NULL)
                                                データなし
                                            @elseif($user->timestamp->sortByDesc('updated_at')->first()->punchOut == NULL)
                                                勤務中です
                                            @else
                                                {{ $user->timestamp->sortByDesc('updated_at')->first()->punchOut->format('H:i') }}
                                            @endif
                                        </td>
                                        <td><div><a class="link-ope" href="{{ action('Admin\ReportController@single', ['id' => $user->id]) }}">表示する</a></div></td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection