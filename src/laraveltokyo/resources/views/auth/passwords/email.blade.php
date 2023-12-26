@extends('layouts.app')

@section('content')

<!-- 投票成功通知 -->
@if(Session::has('status'))
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script>
    $(window).on('load', function() {
        $('#modal_box').modal('show');
    });
</script>

<div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="label1">通知</h5>
            </div>
            <div class="modal-body h6">
                {{ session('status') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="main-button-color" data-bs-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">{{ __('パスワードをリセット') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn" id="main-button-color">
                                    {{ __('リセットリンクを送る') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
