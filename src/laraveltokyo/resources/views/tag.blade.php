@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

@include('layouts.notification')

<div class="container mb-4">
    <h3><span class="text-primary h2">#{{ $tag->name }}</span> ランキング</h3>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <h4 class="mb-2">登録万物数：{{ number_format($posts->total()) }}</h4>
            <div class="table-responsive">
                <table class="table table-sm table-bordered fs-6" id="table-fs">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th id="main-gold-back">順位</th>
                            <th id="main-gold-back">名前</th>
                            <th id="main-gold-back">票数</th>
                            <th id="main-gold-back">投票</th>
                        </tr>
                    </thead>
                    @foreach($posts as $post)
                    <tbody>
                        <tr class="text-center text-nowrap">
                            <th scope="row" id="table-color">{{ ($posts->currentPage()-1)*$posts->perPage()+$loop->iteration }}位</th>
                            <td id="table-color"><a class="text-decoration-none fw-bold" href="/details/{{ $post->things }}">{{ $post->things }}</a></td>
                            <td id="table-color">{{ number_format($post->votes->sum('vote')) }}票</td>
                            <td id="table-color">
                                <button type="button" id="thin-blue-color" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{ $post->id }}">
                                    投票
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="mt-5">
                {{ $posts->links('layouts.vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
</div>


<!-- モーダル -->
@foreach($posts as $post)
<!-- モーダルに一意のIDを割り当て -->
<div class="modal fade" id="staticBackdrop-{{ $post->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-{{ $post->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel-{{ $post->id }}">{{ $post->things }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('vote.store', ['id' => $post->id]) }}" method="post">
                @csrf
                <div class="modal-body">
                    <p class="h6">現在{{ $post->votes->sum('vote') }}票</p>
                    <label class="form-label" for="vote">1回30票まで!</label>
                    <input type="range" name="vote" class="form-range" min="1" max="30" value="15" id="voteRange-{{ $post->id }}" oninput="updateValue(this.value, '{{ $post->id }}')">
                    <span id="rangeValue-{{ $post->id }}"></span>

                    <!-- originフィールドを追加 -->
                    <input type="hidden" name="origin" value="tag">
                    <!-- tag_nameフィールドを追加 -->
                    <input type="hidden" name="tag_name" value="{{ $tag->name }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" id="main-button-color">投票する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('style')
<style>
    input[type="range"]::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 25px;
        width: 25px;
        background: #007C8A;
    }

    @media (max-width: 576px) {
        #table-fs {
            font-size: 0.8rem !important;
        }
    }
</style>
@endpush
