@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card shadow">
                <div class="card-title mt-3 text-center">
                    <span class="h4"> {{ Auth::user()->name }}</span>
                    <span class="fs-6">のお気に入り万物</span>
                </div>
                <div class="card-body">
                    <p>万物</p>
                    <p>削除ボタン</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
