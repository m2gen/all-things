<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Tag;
use App\Models\Come;


class HelloController extends Controller
{

    // トップページに並び替えて変数を
    public function index()
    {
        $posts = Post::with('votes')->get()->take(1000)->sortByDesc(function ($post) {
            return $post->votes->sum('vote');
        });

        return view('top', ['posts' => $posts]);
    }

    // 詳細ページに変数を
    public function show($things)
    {
        $posts = Post::where('things', $things)->firstOrFail();
        $votes = Vote::where('post_id', $posts->id)->get();
        $comes = $posts->comes()->orderBy('created_at', 'desc')->take(500)->get();

        return view('details', ['posts' => $posts, 'votes' => $votes, 'comes' => $comes]);
    }

    //投票と更新
    public function storeOrUpdate(Request $request, $id)
    {
        $post = Post::find($id);
        $vote = $post->votes()->firstOrNew([]);
        $vote->vote += $request->vote;
        $vote->save();

        // 元のページ情報を取得
        $origin = $request->input('origin');

        // リダイレクト先を決定
        if ($origin == 'top') {
            return redirect()->route('top')->with('success', '投票が完了しました');
        } elseif ($origin == 'tag') {
            $tagName = $request->input('tag_name');
            return redirect()->route('tags.show', ['name' => $tagName])->with('success', '投票が完了しました');
        }
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

    // タグページの表示
    public function showTag($name)
    {
        $tag = Tag::where('name', $name)->first();
        $posts = $tag->posts;

        $posts = $posts->sortByDesc(function ($post) {
            return $post->votes->sum('vote');
        });

        return view('tag', ['posts' => $posts, 'tag' => $tag]);
    }

    // コメント
    public function commentStore(Request $request, $things)
    {
        $post = Post::where('things', $things)->first();

        $comes = new Come;
        $comes->user_name = $request->user_name ?: '匿名さん';
        $comes->content = $request->content;
        $comes->save();

        $post->comes()->attach($comes->id);

        return redirect()->route('details', ['things' => $post->things])->with('success', '書き込みました。');
    }
}
