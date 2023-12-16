@extends('layouts.app')
@section('title', '万物ランキング | 編集フォーム')
@section('content')


<div class="container mt-4">
    <form action="{{ route('update', ['things' => $posts->things]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="things" class="mb-3 h4">登録する万物</label>
            <input class="form-control {{ $errors->has('things') ? 'is-invalid' : '' }}" type="text" name="things" value="{{ old('things', $posts->things) }}" maxlength="20">
            @if($errors->has('things'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('things') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="tags" class="mb-3 h4">タグ</label>
            <input type="text" name="tags" placeholder="タグを入力（カンマ区切り）" class="w-100 form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" value="{{ old('tags', trim($posts->tags->pluck('name')->join(', '))) }}">
            @if($errors->has('tags'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tags') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="overview" class="mb-3 h4">概要</label>
            <textarea class="form-control {{ $errors->has('overview') ? 'is-invalid' : '' }}" type="text" name="overview" style="height: 240px;">{{ old('overview', $posts->overview) }}</textarea>
            @if($errors->has('overview'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('overview') }}</strong>
            </span>
            @endif
        </div>
        <div class="d-grid gap-2 col-4 mx-auto">
            <button type="submit" class="btn btn-outline-info fw-bold">保存する</button>
        </div>
    </form>
</div>



@endsection
