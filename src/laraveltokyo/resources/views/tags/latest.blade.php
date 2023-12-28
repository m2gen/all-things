@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

<div class="container">

    <div class="dropdown-center text-end">
        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            並び替え
        </button>
        <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="{{ route('popTag.show') }}">人気順</a></li>
            <li><a class="dropdown-item" href="{{ route('latestTag.show') }}">新しい順</a></li>
        </ul>
    </div>

    <div class="mb-4">
        <h2>全てのタグ(新しい順)</h2>
        <p>最近追加されたばかりのタグです</p>
    </div>

    @foreach($latestTags as $latestTag)
    <a class="text-decoration-none fw-bold btn btn-sm btn-dark mb-1" href="/tags/{{ str_replace(array(" ", "　"), "", $latestTag->name) }}">#{{ str_replace(array(" ", "　"), "", $latestTag->name) }}
    </a>
    @endforeach

</div>


<div class="container mt-5">
    <div class="text-center">
        {{ $latestTags->links('layouts.vendor.pagination.bootstrap-4') }}
    </div>
</div>

@endsection
