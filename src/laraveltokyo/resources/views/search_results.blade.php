@extends('layouts.app')
@section('content')


<div class="container mb-5">
    <div class="row">
        <div class="col-lg-5 mx-auto card py-5">
            <div class="card-body">
                @if ($posts->isEmpty())
                <div class="text-center">
                    <h1>
                        <a href="{{ route('sr.show')}}">検索結果</a>がありません。
                    </h1>
                </div>
                @else

                <h2 class="text-center mb-2">万物検索結果</h2>
                <p class="text-center h5 mb-4">{{ $posts->count() }}件ヒットしました。</p>
                @foreach ($posts as $post)
                <div class="border-radius-50">
                    <ul>
                        <li class="h4">
                            <a href="{{ route('details', ['things' => $post->things]) }}">{{ $post->things }}</a>
                        </li>
                    </ul>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>


<!-- 人気タグ読み込み -->
@include('layouts.popTag2')

@endsection
