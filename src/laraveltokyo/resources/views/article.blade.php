@extends('layouts.app')
@section('title', '万物ランキング')
@section('content')


<div class="container mt-4">
    <h2 class="mb-4 text-center">万物新規作成</h2>
    <form action="{{ route('article.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="things" class="h4">登録する万物</label>
            <input class="form-control {{ $errors->has('things') ? 'is-invalid' : '' }}" type="text" name="things" maxlength="20" value="{{ old('things') }}">
            @if($errors->has('things'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('things') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-4">
            <label for="tags" class="mb-0 h4">タグ</label>
            <p class="mb-2" id="topic">万物の特徴をカンマ区切りで端的に表してください（例：アーティスト,歌手,バンド）。タグページでは同じタグだけが集められたランキングが作成されます。<span class="fw-bold">※最初と最後にカンマは必要ないです</span></p>
            <input type="text" name="tags" placeholder="タグを入力（カンマ区切り）" value="{{ old('tags') }}" maxlength="200" class="w-100 form-control {{ $errors->has('tags') ? 'is-invalid' : '' }}">
            @if($errors->has('tags'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('tags') }}</strong>
            </span>
            @endif
        </div>
        <div class="mb-4">
            <label for="overview" class="h4">概要</label>
            <p class="mb-2" id="topic">この万物について説明してください。空欄でも大丈夫です。</p>
            <textarea class="form-control {{ $errors->has('overview') ? 'is-invalid' : '' }}" maxlength="4000" type="text" name="overview" style="height: 240px;">{{ old('overview') }}</textarea>
            @if($errors->has('overview'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('overview') }}</strong>
            </span>
            @endif
        </div>
        <div class="d-grid gap-2 col-4 mx-auto">
            <button type="submit" class="btn" id="gold-button-color">保存する</button>
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
