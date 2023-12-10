<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Vote;

class HelloController extends Controller
{

    // トップページに並び替えて変数を
    public function index()
    {
        $posts = Post::with('votes')->get()->sortByDesc(function ($post) {
            return $post->votes->sum('vote');
        });

        return view('top', ['posts' => $posts]);
    }

    // 詳細ページに変数を
    public function show($things)
    {
        $posts = Post::where('things', $things)->firstOrFail();
        $votes = Vote::where('post_id', $posts->id)->get();

        return view('details', ['posts' => $posts, 'votes' => $votes]);
    }

    //投票と更新
    public function storeOrUpdate(Request $request, $id)
    {
        $post = Post::find($id);
        $vote = $post->votes()->firstOrNew([]);
        $vote->vote += $request->vote;
        $vote->save();

        return redirect()->route('top')->with('success', '投票が完了しました');
    }

    // 検索
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('things', 'LIKE', "%{$query}%")->first();

        if ($posts) {
            return redirect()->route('details', ['things' => $posts->things]);
        } else {
            return back()->with('error', '検索結果がないよ');
        }
    }
}
