<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('/js/top.js') }}"></script>

    @hasSection('title')
    <title>@yield('title')</title>
    @else
    <title>{{ config('app.name', '日本人ランキング') }}</title>
    @endif
    <script src="https://kit.fontawesome.com/ddbfae1daa.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    @stack('style')

</head>

<body>

    <header class="d-flex align-items-center justify-content-center">
        <a class="h1 text-decoration-none" href="{{ url('/') }}">万物ランキング</a>
    </header>

    <div class="container-fluid bg-dark">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center">
                <ul class="list-unstyled my-2">
                    <li>
                        <a class="text-white text-decoration-none" href="{{ url('/') }}">トップ</a>
                    </li>
                </ul>
                <ul class="list-unstyled my-2 mx-5">
                    <li>
                        <a class="text-white text-decoration-none" href="{{ route('article.show') }}">新しい万物</a>
                    </li>
                </ul>
                <ul class="list-unstyled my-2">
                    <li>
                        @guest
                        @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('top') }}">
                                {{ __('トップ') }}
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('ログアウト') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest </li>
                </ul>
            </div>
        </div>
    </div>

    <main class=" min-vh-100 mt-4">
        @yield('content')
    </main>

    <footer class="footer" style=" background-color: aqua;">
        <div class="container-fluid text-center">
            <p class="mb-0">2023 万物ランキング</p>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
