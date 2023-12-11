@extends('layouts.app')
@section('title', '人間ランキング')
@section('content')
@push('style')
<style>
    #edit {
        margin-left: 45px;
    }

    #overView {
        white-space: pre-wrap;
    }
</style>
@endpush



<div class="container">
    <nav id="navbar-example2" class="navbar bg-body-light px-3 mb-3">
        <div class="align-items-center mb-4">
            <div class="row mb-4">
                @foreach($votes as $vote)
                <div class="col">
                    <p class="h4">{{ number_format($vote->vote) }}票</p>
                </div>
                @endforeach
                <div class="col">
                    <a href="/edit/{{ $posts->things }}" id="edit">
                        <button class="btn btn-outline-info">編集</button>
                    </a>
                </div>
            </div>
            <div class="w-100">
                <p class="display-2 fw-bold">{{ $posts->things }}</p>
            </div>
        </div>
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link" href="#scrollspyHeading1">タグ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#scrollspyHeading2">概要</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
                <ul class="dropdown-menu p-0">
                    <li><a class="dropdown-item" href="#scrollspyHeading3">Third</a></li>
                    <li><a class="dropdown-item" href="#scrollspyHeading4">Fourth</a></li>
                    <li><a class="dropdown-item" href="#scrollspyHeading5">Third</a></li>
                    <li><a class="dropdown-item" href="#scrollspyHeading6">Fourth</a></li>
                </ul>
            </li>
        </ul>
    </nav>

    <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example bg-body-tertiary p-3 rounded-2" tabindex="0">
        <h4 id="scrollspyHeading1">タグ</h4>
        <div class="mb-3">
            @foreach ($posts->tags as $tag)
            <a class="text-decoration-none" href="/tags/{{ trim($tag->name) }}">#{{ trim($tag->name) }}</a>
            @endforeach
        </div>
        <h4 id="scrollspyHeading2">概要</h4>
        <p id="overView">{{ $posts->overview }}</p>
        <h4 id="scrollspyHeading3">Third heading</h4>
        <p>うううううううううううううううううううううううううううううううう宇うううううううううううううう宇うううううう宇うううううう宇うううううう宇うううううう宇ううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううううう</p>
        <h4 id="scrollspyHeading4">Fourth heading</h4>
        <p>えええええええええええええええええええええええええええええええええええええええええええええええええええええええ</p>
        <h4 id="scrollspyHeading5">Fifth heading</h4>
        <p>おおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおお</p>
    </div>
</div>

@endsection
