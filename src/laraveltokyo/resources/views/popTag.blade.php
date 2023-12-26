@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

<div class="container">

    <h1 class="mb-4">全てのタグ(人気順)</h1>

    @foreach($tagCounts as $tagCount)
    <a class="text-decoration-none fw-bold btn btn-sm btn-dark mb-1" href="/tags/{{ str_replace(array(" ", "　"), "", $tagCount->name) }}">#{{ str_replace(array(" ", "　"), "", $tagCount->name) }}
        <span>({{ $tagCount->posts_count }})</span>
    </a>
    @endforeach

</div>


<div class="container mt-5">
    <div class="text-center">
        {{ $tagCounts->links('layouts.vendor.pagination.bootstrap-4') }}
    </div>
</div>

@endsection
