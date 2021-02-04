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
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

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
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                            
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

            <main class="py-4">
                <div class="row">
                    <div class="col-md-2">
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('AdminController@top') }}">トップページ</a>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('AdminController@report') }}">日報</a>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('AdminController@info') }}">連絡事項</a>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('AdminController@apply') }}">休暇申請</a>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('Admin\StaffController@index') }}">社員情報</a>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('AdminController@work') }}">案件情報</a>
                        </div>
                        <div class="col-md-10 mx-auto">
                            <a href="{{ action('AdminController@placement') }}">人員配置</a>
                        </div>
                    </div>
                    <div class="col-md-8">
                        @yield('content')
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>