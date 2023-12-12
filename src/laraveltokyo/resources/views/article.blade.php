@extends('layouts.app')
@section('title', '万物ランキング')
@section('content')

<div class="container mt-4">
    <form action="{{ route('article.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="things" class="mb-3 h4">登録する万物</label>
            <input class="form-control" type="text" name="things" maxlength="20">
        </div>
        <div class="mb-3">
            <label for="tags" class="mb-3 h4">タグ</label>
            <input type="text" name="tags" placeholder="タグを入力（カンマ区切り）" class="w-100 form-control">
        </div>
        <div class="mb-3">
            <label for="overview" class="mb-3 h4">概要</label>
            <textarea class="form-control" type="text" name="overview" style="height: 240px;"></textarea>
        </div>
        <div class="d-grid gap-2 col-4 mx-auto">
            <button type="submit" class="btn btn-outline-info fw-bold">保存する</button>
        </div>
    </form>
</div>

@endsection
