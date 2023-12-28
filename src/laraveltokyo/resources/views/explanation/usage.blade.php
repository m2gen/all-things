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
                    <li>今、目の前にあるもの</li>
                </ul>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">ランキングの基準はなに？</h4>
                <p>トップページのランキングに関しては何も基準はありません。投票数が多いものほど順位が高くなります。基準、絞り込みをするならタグで限定することにより可能です。</p>
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
                <h4 id="main-blue-color">万物登録について</h4>
                <h5>万物</h5>
                <ul>
                    <li>登録万物の文字数は現在20文字以内に制限しております。文字数が足りない場合は略称で記述したうえ概要で補足してください。</li>
                    <li>万物名は被らないよう設定しておりますが、万が一名前が被ってしまうような状況があった場合、もしくは削除要請があった場合、こちらの判断で削除する場合がございます。</li>
                    <li>個人情報や差別的な用語、その他過激なものを登録した場合こちらの判断で削除する場合がございます。</li>
                </ul>
                <h5>タグ</h5>
                <ul>
                    <p>その万物の特徴を短い言葉で説明してください。タグリンクをクリックすると、同じタグだけが登録されたランキングに参加できます。つまり、ランキングの条件を絞り込みできます。</p>
                    <p>例）登録された万物：りんご</p>
                    <p>タブ：<span class="text-primary">#食べ物 #フルーツ</span></p>
                    <p>このようにタグを設定することで<span class="text-primary">#食べ物ランキング #フルーツランキング</span>にりんごが参加できます</p>
                    <h6 class="text-danger">※タグの書き方に注意</h6>
                    <li>タグは空欄を含めず、[ , ] カンマで区切ってください。最後にカンマは必要ありません。</li>
                    <p class="ps-2">例：動物,哺乳類,最強</p>
                </ul>
                <h5>概要</h5>
                <ul>
                    <li>概要はその万物について4000字以内で説明してください。</li>
                    <li>空欄を許容しています。</li>
                    <li>参考文献等あれば概要内に記述してください。</li>
                </ul>
            </div>
            <div class="mb-5">
                <h4 id="main-blue-color">各機能について詳細</h4>
                <h5>投票</h5>
                <ul>
                    <li>投票は1つの万物に付き1日1回30票まで投票できます。</li>
                    <li>投票は個人による過剰な投票を防ぐため、IPアドレスで制限しています。</li>
                    <li>一度に投票できる票数は場合により変更します。</li>
                    <li>票数が増えすぎた場合、レイアウトの都合上数字の表示方法を変更する可能性があります。</li>
                </ul>
                <h5>順位について</h5>
                <ul>
                    <li>票数が多い順に並べています。</li>
                    <li>同数の場合は作成日が早い方の順位が上になるよう設定しています。</li>
                </ul>
                <h5>コメント</h5>
                <ul>
                    <li>誰でも自由に任意の万物ページで匿名のコメントが可能です。</li>
                    <li>名前は自由に設定できます。設定しない場合はデフォルトの名前が表示されます。</li>
                    <li>節度あるコメントを心がけてください。</li>
                    <li>荒らしや特別な事情がある場合以外はコメントの削除を行いませんので、書き込むボタンを押す前に今一度内容を確認したうえ送信するようよろしくお願いいたします。</li>
                </ul>
                <h5>お気に入り登録</h5>
                <ul>
                    <li>ログイン限定機能</li>
                    <li>好きな万物をお気に入り登録することで、いつでもマイページから確認可能です。</li>
                    <li>登録は詳細ページからスターを押すと登録削除できます。</li>
                </ul>
                <h5>検索</h5>
                <ul>
                    <li class="text-danger fw-bold">ヘッダーにある検索フォームは「万物」の検索ができます</li>
                    <li class="text-danger fw-bold">メニューにある検索フォームは「タグ」の検索ができます。。</li>
                    <li>検索で出てくる数を制限しているためヒット件数が多すぎる場合結果が表示されないことがあります。</li>
                </ul>
            </div>
            <div class="mb-5">
                <h5>アカウント設定</h5>
                <ul>
                    <li>名前は自由に設定できます</li>
                    <li>Googleからログインした場合、Googleアカウントの名前が設定されます。個人情報の場合名前を編集することをおすすめします。</li>
                    <li>パスワードを忘れた場合リセットできます。ログイン画面より手続きください。</li>
                    <li>メールアドレスを変更したい場合はもう一度新規登録をよろしくお願いいたします。</li>
                </ul>
            </div>
            <h6>その他、ご不明点等ございましたら<a href="{{ route('contact.index') }}">お問い合わせ</a>よりご連絡ください。</h6>
        </div>
    </div>
</div>
@endsection
