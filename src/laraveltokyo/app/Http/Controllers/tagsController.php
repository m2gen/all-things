<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class tagsController extends Controller
{
    // 人気タグ
    public function popTagShow()
    {
        $tagCounts = Tag::withCount('posts')->orderBy('posts_count', 'desc')->paginate(200);

        return view('tags.popTag', ['tagCounts' => $tagCounts]);
    }

    public function latestTagShow()
    {
        $latestTags = Tag::orderBy('created_at', 'desc')->paginate(200);

        return view('tags.latest', ['latestTags' => $latestTags]);
    }
}
