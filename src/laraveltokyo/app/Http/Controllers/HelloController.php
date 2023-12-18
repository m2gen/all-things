<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Tag;
use App\Models\Come;


class HelloController extends Controller
{

    // トップページに並び替えて変数を
    public function index()
    {
        $posts = Post::with('votes')->take(500)->get()->sortByDesc(function ($post) {
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

    //投票とIPアドレス制限
    public function voteStore(Request $request, $id)
    {
        $post = Post::find($id);
        $ipAddress = $request->ip();

        // 同じIPアドレスからの既存の投票を検索
        $votes = $post->votes()->where('ip_address', $ipAddress)->get();
        $voteCount = $votes->count();
        // 3回越えたら上限いったよ通知
        if ($voteCount >= 3) {
            return redirect()->back()->with('flashMessage', '1つの万物に付き投票回数は3回までです。しばらく時間を置いてから再度お試しください。');
        } else {
            $vote = new Vote;
            $vote->vote = $request->vote;
            $vote->ip_address = $ipAddress;
            $vote->post_id = $id;
            $vote->save();
        }

        // 元のページ情報を取得
        $origin = $request->input('origin');

        // リダイレクト先を決定
        if ($origin == 'top') {
            return redirect()->route('top')->with('flashMessage', '投票できました！');
        } elseif ($origin == 'tag') {
            $tagName = $request->input('tag_name');
            return redirect()->route('tags.show', ['name' => $tagName])->with('flashMessage', '投票できました！');
        } elseif ($origin == 'details') {
            $postThings = $request->input('post_things');
            return redirect()->route('details', ['things' => $postThings])->with('flashMessage', '投票できました！');
        }
    }

    // 検索
    public function search(Request $request)
    {
        $query = $request->input('query');
        $posts = Post::where('things', 'LIKE', "%{$query}%")->orderBy('updated_at', 'desc')->take(100)->get();
        $tagCounts = Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(200)->get();


        if (!empty($posts)) {
            return view('search_results', ['posts' => $posts, 'tagCounts' => $tagCounts]);
        }
    }

    // タグランキングページの表示
    public function showTag($name)
    {
        $tag = Tag::where('name', $name)->first();
        $posts = $tag->posts;

        $posts = $posts->sortByDesc(function ($post) {
            return $post->votes->sum('vote');
        })->take(500);

        return view('tag', ['posts' => $posts, 'tag' => $tag]);
    }

    // 人気タグ
    public function popTagShow()
    {
        $tagCounts = Tag::withCount('posts')->orderBy('posts_count', 'desc')->paginate(200);

        return view('popTag', ['tagCounts' => $tagCounts]);
    }

    // コメント
    public function commentStore(CommentRequest $request, $things)
    {
        $request->validate($request->rules());

        $post = Post::where('things', $things)->first();

        $comes = new Come;
        $comes->user_name = $request->user_name ?: '匿名さん';
        $comes->content = $request->content;
        $comes->save();

        $post->comes()->attach($comes->id);

        return redirect()->route('details', ['things' => $post->things])->with('flashMessage', 'コメント完了！');
    }
}
