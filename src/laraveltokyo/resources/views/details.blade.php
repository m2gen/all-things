@extends('layouts.app')
@section('title', '万物ランキング')
@section('content')

@include('layouts.notification')

<div class="container mb-5">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="mb-3">
                <div class="align-items-center">
                    <div class="row mb-4">
                        <div class="col text-start">
                            <p class="h5">全体：{{ number_format($rank) }}位</p>
                            <p class="h5">合計：{{ number_format($votes->sum('vote')) }}票</p>
                        </div>
                        <div class="col text-end">
                            <a class="text-decoration-none" href="/edit/{{ $posts->things }}">
                                <button class="btn" id="btn-edit">編集</button>
                            </a>
                            <button class="btn btn-outline-dark fw-bold" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $posts->id }}">
                                投票
                            </button>
                        </div>
                    </div>
                    <div class="w-100">
                        <p class="display-2 fw-bold">{{ $posts->things }}</p>
                    </div>
                </div>
            </div>
            <ul class="small text-end list-unstyled">
                <li>
                    作成日：{{ $posts->created_at->format('Y-m-d') }}
                </li>
                <li>
                    更新日：{{ $posts->updated_at->format('Y-m-d') }}
                </li>
            </ul>
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
                                <p class="h6">現在{{ $posts->votes->sum('vote') }}票</p>
                                <label class="form-label" for="vote">1回30票まで!</label>
                                <input type="range" name="vote" class="form-range" min="1" max="30" value="15" id="voteRange-{{ $posts->id }}" oninput="updateValue(this.value, '{{ $posts->id }}')">
                                <span id="rangeValue-{{ $posts->id }}"></span>
                                <input type="hidden" name="origin" value="details">
                                <input type="hidden" name="post_things" value="{{ $posts->things }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn" id="gold-button-color">投票する</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="text-end h5">
                <a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="#scrollspyHeading1">コメント</a>
            </div>

            @if ($favorites)
            <form action="{{ route('favorites.delete', ['id' => $posts->id]) }}" method="POST" class="mb-4">
                <input type="hidden" name="post_id" value="{{$posts->id}}">
                @csrf
                @method('DELETE')
                <button type="submit">
                    <i class="fa-solid fa-star" style="color: #d6cf0a;"></i>
                </button>
            </form>
            @else
            <form action="{{ route('favorites.store', ['id' => $posts->id]) }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="post_id" value="{{$posts->id}}">
                <button type="submit">
                    <i class="fa-regular fa-star"></i>
                </button>
            </form>
            @endif

            {{-- タグ概要 --}}
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example p-3 rounded-2" tabindex="1">
                <div class="mb-5">
                    <div class="mb-3">
                        <h4>タグ</h4>
                        @foreach ($posts->tags as $tag)
                        <a class="text-decoration-none fw-bold" href="/tags/{{ str_replace(array(" ", "　"), "", $tag->name) }}">#{{ str_replace(array(" ", "　"), "", $tag->name) }}</a>
                        @endforeach
                    </div>
                    <div class="mb-3">
                        <h4>概要</h4>
                        <p>{!! nl2br(e($posts->overview)) !!}</p>
                    </div>
                </div>
                {{-- コメント --}}
                <div class="row mb-3">
                    <div class="col-lg-9 mx-auto">
                        <p class="h5" id="scrollspyHeading1">コメント（{{ number_format($comes->count()) }}件）</p>
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
                                <button type="submit" class="btn" id="main-button-color">書き込む</button>
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
                            <p class="fs-6 1h-1 pt-2" id="space" style="font-size: 22px;">{!! nl2br(e($come->content)) !!}</p>
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
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 25px;
        width: 25px;
        background: #e6b422;
    }

    #btn-edit {
        color: #e6b422;
        font-weight: bold;
        border-color: #e6b422;
    }

    #btn-edit:hover {
        color: #000000;
        background-color: #e6b422;
        border-color: #e6b422;
        font-weight: bold;
    }
</style>
@endpush
