@extends('layouts.app')

@section('content')

@if ($posts->isEmpty())
<div class="container">
    <div class="text-center">
        <h1>
            <a href="/details/検索結果">検索結果</a>は無いです。
        </h1>
    </div>
</div>
@else


<h1 class="text-center mb-4">検索結果</h1>
@foreach ($posts as $post)
<div class="border-radius-50">
    <div class="row container">
        <div class="col-md-4 mx-auto">
            <ul>
                <li class="h4">
                    <a href="{{ route('details', ['things' => $post->things]) }}">{{ $post->things }}</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endforeach
@endif
@endsection
