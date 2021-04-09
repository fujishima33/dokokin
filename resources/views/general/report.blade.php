{{-- layouts/general.blade.phpを読み込む --}}
@extends('layouts.general')

{{-- general.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
@section('title', '日報')

{{-- general.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                
                <h2>日報（一般）</h2>
                
                <div class="border mb-3 p-3">
                    <div class="">
                        <h3>出勤状況</h3>
                    </div>
                    
                    
                    
                    @if (session('my_status'))
                        <div class="container mt-2">
                            <div class="alert alert-success">
                                {{ session('my_status') }}
                            </div>
                        </div>
                    @endif
                    
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                            <div class="m-2 pl-4 h4 d-inline-block">出勤時間</div>
                            <div class="m-2 pl-4 h4 d-inline-block">
                                {{ $timestamp->punchIn }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                            <div class="m-2 pl-4 h4 d-inline-block">退勤時間</div>
                            <div class="m-2 pl-4 h4 d-inline-block">
                                {{ $timestamp->punchOut }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">
                            <a href="{{ action('General\ReportController@edit') }}">日報を書く</a>
                        </div>
                    </div>
                    <!--<div class="row">-->
                    <!--    <div class="col-md-1"></div>-->
                    <!--    <div class="col-md-11">-->
                    <!--        <div class="m-2 pl-4 h4 d-inline-block">案件名　</div>-->
                    <!--        <div class="m-2 pl-4 h4 d-inline-block"><input type="text" class="" name="title"></div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <!--<div class="row">-->
                    <!--    <div class="col-md-1"></div>-->
                    <!--    <div class="col-md-11">-->
                    <!--        <div class="m-2 pl-4 h4 d-inline-block">業務内容</div>-->
                    <!--        <div class="m-2 pl-4 h4 d-inline-block"><textarea class="" name="body" rows="3"></textarea></div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
                
                <div class="border p-3">
                    <div class="">
                        <h3>過去の出勤状況</h3>
                    </div>
                    <div class="calendar">
                        <h3>
                            <a>&lt;</a>
                            &nbsp;&nbsp;2021年 2月&nbsp;&nbsp;
                            <a>&gt;</a>
                        </h3>
                        <table class="table table-bordered">
                            <tr>
                                <th>日</th>
                                <th>月</th>
                                <th>火</th>
                                <th>水</th>
                                <th>木</th>
                                <th>金</th>
                                <th>土</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>5</td>
                                <td>6</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>8</td>
                                <td>9</td>
                                <td>10</td>
                                <td>11</td>
                                <td class="today">12</td>
                                <td>13</td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>15</td>
                                <td>16</td>
                                <td>17</td>
                                <td>18</td>
                                <td>19</td>
                                <td>20</td>
                            </tr>
                            <tr>
                                <td>21</td>
                                <td>22</td>
                                <td>23</td>
                                <td>24</td>
                                <td>25</td>
                                <td>26</td>
                                <td>27</td>
                            </tr>
                            <tr>
                                <td>28</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection