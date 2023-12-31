@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

@include('layouts.notification')

{{-- テーブル--}}
<div class="container">
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/アイコン.png') }}" class="me-2 mb-2" alt="アイコン" style="height: 19px; width: 19px;">
                <h4>登録万物数：{{ number_format($posts->total()) }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered fs-6" id="table-fs">
                    <thead>
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
                                <button type="button" data-bs-toggle="modal" id="light-gold-back" data-bs-target="#staticBackdrop-{{ $post->id }}">
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
            <p>{{ $posts->count() }}/{{ number_format($posts->total()) }}</p>
        </div>
    </div>
</div>



{{-- モーダル --}}
@foreach($posts as $post)
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
                    <p class="h6">現在{{ number_format($post->votes->sum('vote')) }}票</p>
                    <label class="form-label" for="vote">1回30票まで!</label>
                    <input type="range" name="vote" class="form-range" min="1" max="30" value="15" id="voteRange-{{ $post->id }}" oninput="updateValue(this.value, '{{ $post->id }}')">
                    <span id="rangeValue-{{ $post->id }}"></span>

                    <input type="hidden" name="origin" value="top">
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
