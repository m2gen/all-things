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
    <title>{{ config('app.name', '万物ランキング') }}</title>
    @endif
    <script src="https://kit.fontawesome.com/ddbfae1daa.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/top.css') }}">
    @stack('style')

</head>

<body>

    <header class="py-3">
        <div class="container">
            <div class="text-start mb-3">
                <a class="h1 text-decoration-none" href="{{ url('/') }}">万物ランキング</a>
            </div>
            <div class="text-end">
                <form class="d-flex mb-3 w-100" action="/search" method="GET">
                    <input class="form-control me-2 border border-dark flex-grow-1" type="search" placeholder="検索" aria-label="Search" name="query" required>
                    <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <button class="btn btn-dark text-nowrap w-25" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">メニュー</button>
            </div>
        </div>
    </header>


    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">メニュー</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="d-flex mb-3" action="/search" method="GET">
                <input class="form-control me-2 border border-dark flex-grow-1" type="search" placeholder="検索" aria-label="Search" name="query" required>
                <button class="btn btn-dark" type="submit"><i class="fas fa-search"></i></button>
            </form>
            <ul class="h5">
                <li class="mb-2">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ url('/') }}">トップ</a>
                </li>
                <li class="mb-2">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('article.show') }}">万物新規作成</a>
                </li>
                <li class="mb-2">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('popTag.show') }}">人気のタグ一覧</a>
                </li>
                @guest
                @if (Route::has('login'))
                <li class="mb-2">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('login') }}">{{ __('ログイン') }}</a>
                </li>
                <li class="mb-2">
                    <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="{{ route('register') }}">{{ __('新規登録') }}</a>
                </li>
                @endif
                @else
                <li class="mb-2 nav-item dropdown">
                    <a class="nav-link dropdown-toggle link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item fw-bold" href="{{ route('myPage') }}">{{ __('マイページ') }}</a>
                        <a class="dropdown-item fw-bold" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('ログアウト') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>

    <main class="min-vh-100 mt-5">
        @yield('content')
    </main>

    <footer>
        <div class="container-fluid bg-dark text-white py-4">
            <div class="container text-center">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="mb-3">フォローする</h6>
                        <p>私たちの最新の更新を見逃さないでください。</p>
                        <a href="#" class="btn btn-light w-25 my-3"><i class="fa-brands fa-x-twitter"></i></a>
                    </div>
                    <div class="col-md-4">
                        <h6 class="mb-3">リンク</h6>
                        <a href="{{ route('contact.index') }}" class="text-white">お問い合わせ</a><br>
                        <a href="{{ route('show.terms') }}" class="text-white">利用規約</a><br>
                    </div>
                    <div class="col-md-4">
                        <h6 class="mb-3">2023 万物ランキング</h6>
                        <p>最新のランキング情報をチェックしましょう。</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>
