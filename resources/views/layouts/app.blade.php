<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- 左側のナビゲーション -->
                        <ul class="navbar-nav me-auto">
                        <!-- 必要ならリンクをここに追加 -->
                        </ul>

                        <!-- 右側のナビゲーション -->
                        <ul class="navbar-nav ms-auto">
                            @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            
                            @else
                                <li class="nav-item">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                        <button type="submit" class="btn btn-logout" style="text-decoration: none;">
                                            ログアウト
                                        </button>
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>


            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>
