@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">お問い合わせ内容確認</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('send') }}">
                        @csrf
                        <input type="hidden" name="name" value="{{ $contact['name'] }}">
                        <input type="hidden" name="email" value="{{ $contact['email'] }}">
                        <input type="hidden" name="contact" value="{{ $contact['contact'] }}">
                        <div class="row mb-3">
                            <label for="name" class="col-md-3 text-md-end">氏名:</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $contact['name'] }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-3 text-md-end">メールアドレス:</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $contact['email'] }}</p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="contact" class="col-md-3 text-md-end">お問い合わせ内容:</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{!! nl2br(e($contact['contact'])) !!}</p>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('contact.index') }}" class="btn btn-info">
                                戻る
                            </a>
                            <button type="submit" class="btn btn-primary">
                                送信
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
