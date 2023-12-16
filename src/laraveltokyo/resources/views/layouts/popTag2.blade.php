<div class="container py-5">

    <h1>人気のタグ</h1>

    @foreach($tagCounts as $tagCount)
    <a class="text-decoration-none fw-bold" href="/tags/{{ str_replace(array(" ", "　"), "", $tagCount->name) }}">#{{ str_replace(array(" ", "　"), "", $tagCount->name) }}</a>
    <span>({{ $tagCount->posts_count }}) /</span>
    @endforeach

</div>
