@extends('layouts.app')
@section('title', '万物ランキング | 編集フォーム')
@section('content')


<div class="container mt-4">
    <form action="{{ route('update', ['things' => $posts->things]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="things" class="h4">登録する万物</label>
            <input class="form-control {{ $errors->has('things') ? 'is-invalid' : '' }}" type="text" name="things" value="{{ old('things', $posts->things) }}" maxlength="20">
            @if($errors->has('things'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('things') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-4">
            <label for="tags" class="mb-0 h4">タグ</label>
            <p class="mb-2" id="topic">万物の特徴をカンマ区切りで端的に表してください（例：アーティスト,歌手）。タグページでは同じタグだけが集められたランキングが作成されます。</p>
            <input type="text" name="tags" placeholder="タグを入力（カンマ区切り）" class="w-100 form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}" value="{{ old('tags', trim($posts->tags->pluck('name')->join(', '))) }}">
            @if($errors->has('tags'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tags') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-4">
            <label for="overview" class="h4">概要</label>
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


@push('style')
<style>
    #topic {
        font-size: 0.9rem;
    }

    @media (max-width: 576px) {
        #topic {
            font-size: 0.75rem;
        }
    }
</style>
@endpush
