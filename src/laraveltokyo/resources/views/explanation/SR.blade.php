@extends('layouts.app')
@section('title', '検索結果ない')
@section('content')

@include('layouts.notification')

<div class="container mb-5">
    <!-- 万物見出しなど -->
    <div class="row">
        <div class="col-lg-9 mx-auto">
            <div class="mb-3">
                <div class="align-items-center">
                    <div class="row mb-4">
                        <div class="col text-start">
                            <p class="h5">全体：n位</p>
                            <p class="h5">合計：n票</p>
                        </div>
                        <div class="col text-end">
                            <button class="btn" id="btn-edit">編集</button>
                            <button class="btn btn-outline-dark fw-bold">
                                投票
                            </button>
                        </div>
                    </div>
                    <div class="w-100">
                        <p class="display-2 fw-bold">検索結果</p>
                    </div>
                </div>
            </div>
            <ul class="small text-end list-unstyled">
                <li>
                    作成日：2339-6-7
                </li>
                <li>
                    更新日：1902-8-8
                </li>
            </ul>
            <!-- タグ・概要 -->
            <div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" class="scrollspy-example p-3 rounded-2" tabindex="1">
                <div class="mb-5">
                    <div class="mb-3">
                        <h4>タグ</h4>
                        <p class="text-primary fw-bold">#検索結果</p>
                    </div>
                    <div class="mb-3">
                        <h4>概要</h4>
                        <p>検索結果がありません。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    #btn-edit {
        color: #e6b422;
        font-weight: bold;
        border-color: #e6b422;
    }

    #btn-edit:hover {
        color: #000000;
        background-color: #e6b422;
        border-color: #e6b422;
        font-weight: bold;
    }
</style>
@endpush
