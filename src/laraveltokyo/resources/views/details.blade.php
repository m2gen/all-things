@extends('layouts.app')
@section('title', '万物ランキング')
@section('content')

<!-- 投票成功通知 -->
@if(session('voteSuccess'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        <strong>投票が完了しました。</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@if(session('success'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        <strong>コメントしました。</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif


<div class="container">
    <!-- 万物見出しなど -->
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="bg-light px-3 mb-3">
                <div class="align-items-center">
                    <div class="row mb-4 w-100">
                        @foreach($votes as $vote)
                        <div class="col text-start">
                            <p class="h4">{{ number_format($vote->vote) }}票</p>
                        </div>
                        @endforeach
                        <div class="col text-end">
                            <a href="/edit/{{ $posts->things }}">
                                <button class="btn btn-outline-info fw-bold">編集</button>
                            </a>
                            <button class="btn btn-outline-dark fw-bold" id="vote_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $posts->id }}">
                                投票
                            </button>
                        </div>
                    </div>
                    <div class="w-100">
                        <p class="display-2 fw-bold">{{ trim($posts->things) }}</p>
                    </div>
                </div>
            </div>
            <!-- モーダル -->
            <div class="modal fade" id="staticBackdrop-{{ $posts->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-{{ $posts->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel-{{ $posts->id }}">{{ $posts->things }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('vote.store', ['id' => $posts->id]) }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <p>現在{{ $posts->votes->sum('vote') }}票</p>
                                <label class="form-label" for="vote">1人10票まで!</label>
                                <input type="range" name="vote" class="form-range" min="1" max="10" value="5" id="voteRange-{{ $posts->id }}" oninput="updateValue(this.value, '{{ $posts->id }}')">
                                <span id="rangeValue-{{ $posts->id }}"></span>
                                <input type="hidden" name="origin" value="details">
                                <input type="hidden" name="post_things" value="{{ $posts->things }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">投票する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- 概要・コメント遷移ボタン -->
            <nav id="navbar-example2" class="navbar bg-body-tertiary px-3">
                <ul class="nav nav-pills ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#scrollspyHeading1">概要</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#scrollspyHeading2">コメント</a>
                    </li>
                </ul>
            </nav>
            <!-- タグ・概要 -->
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="1">
                <div class="mb-5">
                    <div class="mb-3">
                        <h4>タグ</h4>
                        @foreach ($posts->tags as $tag)
                        <a class="text-decoration-none fw-bold" href="/tags/{{ str_replace(array(" ", "　"), "", $tag->name) }}">#{{ str_replace(array(" ", "　"), "", $tag->name) }}</a>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <h4 id="scrollspyHeading1">概要</h4>
                        <p id="space">{{ $posts->overview }}</p>
                    </div>
                </div>
                <!-- コメント -->
                <div class="row mb-3">
                    <div class="col-lg-9 mx-auto">
                        <p class="h4" id="scrollspyHeading2">コメント</p>
                        <form action="{{ route('comment', ['things' => $posts->things]) }}" method="post" class="mb-5">
                            @csrf
                            <div class="mt-1">
                                <input class="w-25 {{ $errors->has('user_name') ? 'is-invalid' : '' }}" type="text" name="user_name" placeholder="名前(任意)">
                                @if($errors->has('user_name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('user_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-1">
                                <textarea class="w-100 {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="4">{{ old('content') }}</textarea>
                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-dark fw-bold">書き込む</button>
                            </div>
                        </form>
                        @foreach($comes as $come)
                        <div class="pt-2" style="border-top: solid 1px #007C8A;">
                            <div class="row" style="font-size: 13px;">
                                <div class="col">
                                    <span>{{ $loop->count - $loop->iteration + 1 }}.</span>
                                    <span>{{ $come->user_name }}</span>
                                </div>
                                <span class="col text-end">{{ $come->created_at }}</span>
                            </div>
                            <p class="fs-6 1h-1 pt-2" id="space" style="font-size: 22px;">{{ $come->content }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    #space {
        white-space: pre-wrap;
    }
</style>
@endpush
