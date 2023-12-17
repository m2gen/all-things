@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')

<!-- 投票成功通知 -->
@if(Session::has('flashMessage'))
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(window).on('load', function() {
        $('#modal_box').modal('show');
    });
</script>

<div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="label1">通知</h5>
            </div>
            <div class="modal-body">
                {{ session('flashMessage') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>
@endif

<!-- テーブル -->
<div class="container mb-5">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <div class="table-responsive">
                <table class="table table-sm table-bordered fs-6" id="table-fs">
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
                    <p>現在{{ number_format($post->votes->sum('vote')) }}票</p>
                    <label class="form-label" for="vote">1人最大10票まで!</label>
                    <input type="range" name="vote" class="form-range" min="1" max="10" value="5" id="voteRange-{{ $post->id }}" oninput="updateValue(this.value, '{{ $post->id }}')">
                    <span id="rangeValue-{{ $post->id }}"></span>

                    <!-- originフィールドを追加 -->
                    <input type="hidden" name="origin" value="top">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary fw-bold">投票する</button>
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

    @media (max-width: 576px) {
        #table-fs {
            font-size: 0.77rem !important;
        }
    }
</style>
@endpush
