<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
         {{-- Laravel標準Javascriptを読み込み --}}
        <script src="{{ secure_asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p:wght@300;400;700&display=swap" rel="stylesheet" type="text/css">

        <!-- Styles -->
        {{-- Laravel標準CSSを読み込み --}}
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        {{-- このファイル用のCSSを読み込み --}}
        <link href="{{ secure_asset('css/admin.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            {{-- 画面上部ナビゲーションバー。 --}}
            <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/admin') }}">
                        {{ config('app.name', 'どこ勤') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            <p class="link ml-0 my-2"><a href="{{ action('Admin\ReportController@index') }}">日報</a></p>
                            <p class="link ml-0 my-2"><a href="{{ action('AdminController@info') }}">連絡事項</a></p>
                            <p class="link ml-0 my-2"><a href="{{ action('AdminController@apply') }}">休暇申請</a></p>
                            <p class="link ml-0 my-2"><a href="{{ action('Admin\StaffController@index') }}">社員情報</a></p>
                            <p class="link ml-0 my-2"><a href="{{ action('Admin\WorkController@index') }}">案件情報</a></p>
                            <p class="link ml-0 my-2"><a href="{{ action('Admin\PlacementController@index') }}">シフト管理</a></p>
                        </ul>
                        
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                        @guest
                            <li><a class="nav-link" href="/">ログイン</a></li>
                        {{-- ログインしていたらユーザー名とログアウトボタンを表示 --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            {{-- ここまでナビゲーションバー --}}

            <main>
                <div class="row justify-content-center main-all">
                    <div class="col-md-8 main-content">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
        
          <!-- jQueryの読み込み -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
          <!-- 自作JavaScriptの読み込み -->
        <script src=""></script>
        
    </body>
</html>