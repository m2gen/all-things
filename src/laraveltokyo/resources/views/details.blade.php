@extends('layouts.app')
@section('title', '万物ランキング')
@section('content')

<!-- 投票成功通知 -->
@if(session('success'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        <strong>書き込みました。</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type=" button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container">

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
                        </div>
                    </div>
                    <div class="w-100">
                        <p class="display-2 fw-bold">{{ $posts->things }}</p>
                    </div>
                </div>
            </div>

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

            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="1">
                <div class="mb-5">
                    <div class="mb-3">
                        <h4>タグ</h4>
                        @foreach ($posts->tags as $tag)
                        <a class="text-decoration-none fw-bold" href="/tags/{{ trim($tag->name) }}">#{{ trim($tag->name) }}</a>
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
                                <input class="w-25" type="text" name="user_name" placeholder="名前(任意)">
                            </div>
                            <div class="mt-1">
                                <textarea class="w-100" name="content" rows="4"></textarea>
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
