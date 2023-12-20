@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-title mt-3 text-center">
                    <span class="h5"> {{ Auth::user()->name }}</span>
                    <span class="fs-6">のお気に入り万物</span>
                </div>
                <div class="card-body">
                    @foreach ($favorite_posts as $post)
                    <ul>
                        <li>
                            <a class="h5 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="/details/{{ $post->things }}">{{ $post->things }}</a>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
