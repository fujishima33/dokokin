{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')

{{-- admin.blade.phpの@yield('title')にページ名を埋め込む --}}
@section('title', '社員情報一覧')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto p-0 mb-1 staff-info">
                <div class="staff-info-left">
                    <h3>社員一覧</h3>
                </div>
                <div class="staff-info-right">
                    <button type="submit" class="btn btn-primary">
                        <a href="{{ action('Admin\StaffController@add') }}">社員を新規登録</a>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="row table-responsive-sm">
                    <table class="table table-bordered profile">
                        <thead>
                            <tr>
                                <th width="20%">アイコン画像</th>
                                <th width="20%">氏名</th>
                                <th width="30%">メールアドレス</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th class="avatar">
                                        @if ($user->image_path)
                                            <img src="{{ $user->image_path }}">
                                        @endif
                                    </th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><div><a href="{{ action('Admin\StaffController@edit', ['id' => $user->id]) }}">編集</a></div></td>
                                </tr>
                            @endforeach
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