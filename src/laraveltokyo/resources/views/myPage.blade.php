@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

@include('layouts.notification')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mb-3">
            <div class="card shadow">
                <div class="card-title mt-3 text-center">
                    <h5>アカウント設定</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('name.update') }}" method="POST" id="settings-form">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="user_name" class="form-label h6">ユーザーネーム</label>
                                <p id="user_name_text" class="form-control-static">{{ Auth::user()->name }}</p>
                                <input type="text" class="form-control d-none  {{ $errors->has('name') ? 'is-invalid' : '' }}" id="user_name" name="name" value="{{ Auth::user()->name }}">
                                @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="text-end mt-1 mb-0 col">
                                <button type="button" class="btn btn-sm btn-dark" id="edit-button">名前編集</button>
                                <button type="submit" class="btn btn-sm btn-dark d-none" id="save-button">変更を保存</button>
                            </div>
                        </div>
                        <div class="mb-5">
                            <label for="mail_address" class="h6">メールアドレス</label>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </form>
                    <p>メールアドレス、パスワードを変更したい場合は一度ログアウトした後、再度新規登録をよろしくお願いいたします。</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5">
            <div class="card shadow">
                <div class="card-title mt-3 text-center">
                    <span class="fs-6">お気に入り登録した万物</span>
                </div>
                <div class="card-body">
                    @foreach ($favorite_posts as $post)
                    <ul>
                        <li class="lh-sm">
                            <a class="h6" id="menu-border" href="/details/{{ $post->things }}">{{ $post->things }}</a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('edit-button').addEventListener('click', function() {
        document.getElementById('user_name_text').classList.add('d-none');
        document.getElementById('user_name').classList.remove('d-none');
        document.getElementById('edit-button').classList.add('d-none');
        document.getElementById('save-button').classList.remove('d-none');
    });
</script>
@endsection
