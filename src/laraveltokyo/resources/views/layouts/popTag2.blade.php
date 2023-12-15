<div class="container pt-5">

    <h1>人気のタグ</h1>

    @foreach($tagCounts as $tagCount)
    <a class="text-decoration-none fw-bold" href="/tags/{{ trim($tagCount->name) }}">#{{ trim($tagCount->name) }}</a>
    <span>({{ $tagCount->posts_count }}) /</span>
    @endforeach

</div>
