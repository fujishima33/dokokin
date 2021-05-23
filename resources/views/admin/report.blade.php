{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
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
            <div class="col-md-12 mx-auto p-0 table-responsive-xl">
                <table class="table table-bordered">
                    <thead>
                        <tr class="thead">
                            <th width="25%" class="th-ar-1">氏名</th>
                            <th width="25%" class="th-ar-2">最終打刻日</th>
                            <th width="25%" class="th-ar-3">出勤時刻</th>
                            <th width="25%" class="th-ar-3">退勤時刻</th>
                            <th width="25%" class="th-ar-4"></th>
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
                                            {{ $user->timestamp->sortByDesc('punchIn')->first()->punchIn->format('n月j日') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( $timestamp->where('user_id', $user->id)->first() == NULL)
                                            データなし
                                        @else
                                            {{ $user->timestamp->sortByDesc('punchIn')->first()->punchIn->format('G:i') }}
                                        @endif
                                    </td>
                                    <td>
                                        @if( $timestamp->where('user_id', $user->id)->first() == NULL)
                                            データなし
                                        @elseif($user->timestamp->sortByDesc('punchIn')->first()->punchOut == NULL)
                                            勤務中です
                                        @else
                                            {{ $user->timestamp->sortByDesc('punchIn')->first()->punchOut->format('G:i') }}
                                        @endif
                                    </td>
                                    <td><div><a class="link-ope" href="{{ action('Admin\ReportController@single', ['id' => $user->id]) }}">一覧を表示</a></div></td>
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
@endsection