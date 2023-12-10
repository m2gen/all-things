@extends('layouts.app')
@section('title', '万物ランキング | 編集フォーム')
@section('content')

<div class="container mt-5">
    <form action="{{ route('update', ['things' => $posts->things]) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="things" class="mb-3 h4">登録する万物</label>
            <input class="form-control" type="text" name="things" value="{{ $posts->things }}" maxlength="20">
        </div>
        <div class="mb-4">
            <p>ああああああああああ</p>
        </div>
        <div class="mb-5">
            <label for="overview" class="mb-3 h4">概要</label>
            <textarea class="form-control" type="text" name="overview" style="height: 200px;">{{ $posts->overview }}</textarea>
        </div>
        <div class="d-grid gap-2 col-4 mx-auto">
            <button type="submit" class="btn btn-outline-info fw-bold">保存する</button>
        </div>
    </form>
</div>



@endsection
