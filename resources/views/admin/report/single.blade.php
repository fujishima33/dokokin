{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.admin')


{{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報')

{{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                
                <h2>日報（管理用・詳細）</h2>
                
                <div class="p-3">
                    <div class="">
                        <h4>{{ $user->name}} の出勤状況一覧</h4>
                        <div></div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                            <div class="row">
                                <table class="table table-gray">
                                    <thead>
                                        <tr>
                                            <th width="10%">日付</th>
                                            <th width="10%">出勤時刻</th>
                                            <th width="10%">退勤時刻</th>
                                            <th width="20%">案件名</th>
                                            <th width="40%">業務内容</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($reports != NULL)
                                            @foreach($reports as $report)
                                                <tr>
                                                    <th>{{ $report->punchIn->format('m月d日') }}</th>
                                                    <td>{{ $report->punchIn->format('H:i:s') }}
                                                    
                                                    
                                                    </td>
                                                    <td>
                                                        @if($report->punchOut == null)
                                                            未入力です
                                                        @else
                                                            {{ $report->punchOut->format('H:i:s') }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $report->work_id }}</td>
                                                    <td>{{ $report->detail }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection