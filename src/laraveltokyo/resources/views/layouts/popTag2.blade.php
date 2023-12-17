<div class="container py-5">

    <h1>人気のタグ</h1>

    @foreach($tagCounts as $tagCount)
    <a class="btn btn-sm btn-dark text-decoration-none fw-bold mb-1" href="/tags/{{ str_replace(array(" ", "　"), "", $tagCount->name) }}">#{{ str_replace(array(" ", "　"), "", $tagCount->name) }}
        <span>({{ $tagCount->posts_count }})</span>
    </a>
    @endforeach

</div>
