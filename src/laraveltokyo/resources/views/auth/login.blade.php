@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">{{ __('ログイン') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('メールアドレス') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('パスワード') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('保存する') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn me-2" id="main-button-color">
                                    {{ __('ログイン') }}
                                </button>
                                <a class="btn" id="main-button-color" href="{{ route('register') }}">
                                    {{ __('新規登録') }}
                                </a>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('パスワード忘れた場合') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <a href="{{ route('login.google') }}" class="btn border border-dark p-2 text-decoration-none bg-warning fw-bold">
                                <span>
                                    <i class="fa-brands fa-google me-3"></i>Googleでログインする
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
