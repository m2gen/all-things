@extends('layouts.app')
@section('content')


<div class="container mb-5">
    <div class="row">
        <div class="col-lg-5 mx-auto card py-5">
            <div class="card-body">
                @if ($posts->isEmpty())
                <div class="text-center">
                    <h1>
                        <a href="/details/検索結果">検索結果</a>は無いです。
                    </h1>
                </div>
                @else

                <h1 class="text-center mb-5">検索結果</h1>
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
