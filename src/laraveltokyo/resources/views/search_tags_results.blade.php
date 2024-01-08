@extends('layouts.app')
@section('content')


<div class="container mb-5">
    <div class="row">
        <div class="col-lg-5 mx-auto card py-5">
            <div class="card-body">
                @if ($tags->isEmpty())
                <div class="text-center">
                    <h1>検索結果が0件です</h1>
                </div>
                @else

                <h2 class="text-center mb-2">タグ検索結果</h2>
                <p class="text-center h5 mb-4">{{ $tags->count() }}件ヒットしました。</p>
                @foreach ($tags as $tag)
                <div class="border-radius-50">
                    <ul>
                        <li class="h4">
                            <a href="{{ route('tags.show', ['name' => $tag->name]) }}">{{ $tag->name }}</a>
                        </li>
                    </ul>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>


@include('layouts.popTag2')

@endsection
