@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

<!-- 投票成功通知 -->
@if(session('success'))
<div class="container">
    <div class="alert alert-success alert-dismissible fade show mb-5" role="alert">
        <strong>投票が完了しました。</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<div class="container mb-4">
    <h3><span class="text-primary h2">#{{ $tag->name }}</span> ランキング</h3>
</div>

<div class="d-flex justify-content-center">
    <div class="container mb-5">
        <div class="mx-auto table-responsive">
            <table class="table table-bordered fs-6">
                <thead class="table-info">
                    <tr class="text-center">
                        <th>順位</th>
                        <th>名前</th>
                        <th>票数</th>
                        <th>投票</th>
                    </tr>
                </thead>
                @foreach($posts as $post)
                <tbody>
                    <tr class="text-center text-nowrap">
                        <th scope="row">{{ $loop->iteration }}位</th>
                        <td><a class="text-decoration-none fw-bold" href="/details/{{ $post->things }}">{{ $post->things }}</a></td>
                        <td>{{ number_format($post->votes->sum('vote')) }}票</td>
                        <td>
                            <button type="button" id="vote_button" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $post->id }}">
                                投票
                            </button>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</div>


<!-- モーダル -->
@foreach($posts as $post)
<!-- モーダルに一意のIDを割り当て -->
<div class="modal fade" id="staticBackdrop-{{ $post->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel-{{ $post->id }}">{{ $post->things }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vote.store', ['id' => $post->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <p>現在{{ $post->votes->sum('vote') }}票</p>
                    <label class="form-label" for="vote">1人10票まで!</label>
                    <input type="range" name="vote" class="form-range" min="1" max="10" id="voteRange-{{ $post->id }}" oninput="updateValue(this.value, '{{ $post->id }}')">
                    <span id="rangeValue-{{ $post->id }}"></span>

                    <!-- originフィールドを追加 -->
                    <input type="hidden" name="origin" value="tag">
                    <!-- tag_nameフィールドを追加 -->
                    <input type="hidden" name="tag_name" value="{{ $tag->name }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">投票する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('style')
<style>
    #vote_button {
        background-color: #f0f8ff;
        cursor: pointer;
    }
</style>
@endpush
