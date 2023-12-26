@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white text-center">お問い合わせ</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('confirm') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-end">氏名</label>
                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="email" class="col-md-3 col-form-label text-md-end">メールアドレス</label>

                            <div class="col-md-9">
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <label for="contact" class="col-md-3 col-form-label text-md-end">お問い合わせ内容</label>
                            <div class="col-md-9">
                                <textarea id="contact" class="form-control  @error('contact') is-invalid @enderror" name="contact" cols="30" rows="10"></textarea>

                                @error('contact')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-2">
                            <div class="col-md-9 offset-md-3">
                                <button type="submit" class="btn" id="main-button-color">
                                    内容の確認へ
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
