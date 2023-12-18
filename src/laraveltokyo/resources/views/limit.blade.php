@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')
<div class="container">
    <div class="card shadow text-center">
        <div class="card-body">
            <h5 class="my-2">投票回数の上限を超えました。しばらく時間を置いてから再度お試しください。</h5>
            <a href="{{ route('top') }}" class="mt-4 btn btn-dark">トップページへ</a>
        </div>
    </div>
</div>
@endsection
