@extends('layouts.app')
@section('title', '万物ランキング')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="mb-5">
                <h1 class="mb-5 text-center">このサイトについて</h1>
                <p class="h4" id="main-blue-color">万物ランキングとは、この世の全てのものをランキングに登録でき、誰でも投票できるサイトです。ジャンルは問いません。例えば、以下のようなものを登録してみましょう。</p>
                <ul class="mt-4">
                    <li>食べ物</li>
                    <li>芸能人</li>
                    <li>動物</li>
                    <li>偉人</li>
                    <li>概念</li>
                    <li>言葉</li>
                    <li>無形物</li>
                    <li>今、目の前にあるもの</li>
                </ul>
                <p>本当に何を登録してもらっても大丈夫です。</p>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">ランキングの基準はなに？</h4>
                <p>トップページのランキングに関しては何も基準はありません。投票数が多いものほど順位が高くなります。基準、絞り込みをするならタブで限定することにより可能です。</p>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">タブとは</h4>
                <p>その万物の特徴を短い言葉で説明してください。タブリンクをクリックすると、同じタブだけが登録されたランキングに参加できます。つまり、ランキングの条件を絞り込みできます。</p>
                <p>例）登録された万物：りんご</p>
                <p>タブ：<span class="text-primary">#食べ物 #フルーツ</span></p>
                <p>このようにタブを設定することで<span class="text-primary">#食べ物ランキング #フルーツランキング</span>にりんごが参加できます</p>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">お気に入り登録とは</h4>
                <p>好きな万物をお気に入り登録することで、いつでもマイページから確認可能です。登録は詳細ページからスターを押すと登録削除できます。この機能はログインしたユーザーのみ利用できます。</p>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">ログイン無しで利用できる機能</h4>
                <ul>
                    <li>投票</li>
                    <li>コメント</li>
                    <li>検索</li>
                </ul>
                <h4 id="main-blue-color">ログイン必須な機能</h4>
                <p>※ログイン・新規登録は無料です</p>
                <ul>
                    <li>万物の新規作成</li>
                    <li>万物の編集</li>
                    <li>お気に入り登録</li>
                </ul>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">機能について詳細</h4>
                <ul>
                    <li>投票は1つの万物に付き1日1回30票まで投票できます</li>
                    <li>投票は個人による過剰な投票を防ぐため、IPアドレスで制限しています。</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
