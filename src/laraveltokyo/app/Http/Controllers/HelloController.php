<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Models\Post;
use App\Models\Vote;
use App\Models\Tag;
use App\Models\Come;
use App\Models\Favorite;
use Exception;

class HelloController extends Controller
{

    // トップページに並び替えて変数を
    public function index()
    {
        session(['currentPage' => request('page')]);

        $posts = Post::with('votes')
            ->select('posts.*')
            ->leftJoin('votes', 'votes.post_id', '=', 'posts.id')
            ->groupBy('posts.id')
            ->orderByRaw('SUM(votes.vote) DESC')
            ->orderBy('created_at', 'asc')
            ->paginate(100);

        return view('top', ['posts' => $posts]);
    }

    // 詳細ページに変数を
    public function show($things)
    {
        $posts = Post::where('things', $things)->firstOrFail();
        $votes = Vote::where('post_id', $posts->id)->get();
        $comes = $posts->comes()->orderBy('created_at', 'desc')->take(500)->get();
        $user = auth()->user();
        $favorites = null;

        if ($user) {
            $favorites = Favorite::where('post_id', $posts->id)->where('user_id', $user->id)->first();
        }

        // 全体の順位情報を取得
        $rankedPosts = Post::with('votes')
            ->select('posts.*')
            ->leftJoin('votes', 'votes.post_id', '=', 'posts.id')
            ->groupBy('posts.id')
            ->orderByRaw('SUM(votes.vote) DESC')
            ->get();

        // 特定の投稿の順位を計算
        $rank = $rankedPosts->search(function ($item) use ($posts) {
            return $item->id == $posts->id;
        }) + 1;

        return view('details', ['posts' => $posts, 'votes' => $votes, 'comes' => $comes, 'favorites' => $favorites, 'rank' => $rank]);
    }

    //投票とIPアドレス制限
    public function voteStore(Request $request, $id)
    {

        try {

            $currentPage = session('currentPage') ?? 1;
            $post = Post::find($id);
            $ipAddress = $request->ip();

            // 同じIPアドレスからの既存の投票を検索
            $votes = $post->votes()->where('ip_address', $ipAddress)->where('created_at', '>=', now()->subDay())->get();
            $voteCount = $votes->count();
            // 3回越えたら上限いったよ通知
            if ($voteCount >= 1) {
                return redirect()->back()->with('flashMessage', '1つの万物に付き投票回数は1回までです。しばらく時間を置いてから再度お試しください。');
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
                return redirect()->route('top', ['page' => $currentPage])->with('flashMessage', '投票できました！');
            } elseif ($origin == 'tag') {
                $tagName = $request->input('tag_name');
                return redirect()->route('tags.show', ['name' => $tagName])->with('flashMessage', '投票できました！');
            } elseif ($origin == 'details') {
                $postThings = $request->input('post_things');
                return redirect()->route('details', ['things' => $postThings])->with('flashMessage', '投票できました！');
            }
        } catch (Exception $e) {
            echo "投票に失敗しました。", $e->getMessage();
        }
    }

    // 万物検索
    public function things_search(Request $request)
    {
        try {
            $query = $request->input('query');
            $posts = Post::where('things', 'LIKE', "%{$query}%")->orderBy('updated_at', 'desc')->take(100)->get();
            $tagCounts = Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(200)->get();


            if (!empty($posts)) {
                return view('search_results', ['posts' => $posts, 'tagCounts' => $tagCounts]);
            }
        } catch (Exception $e) {
            echo "検索に失敗しました。", $e->getMessage();
        }
    }
    // タグ検索
    public function tags_search(Request $request)
    {
        try {
            $query = $request->input('query');
            $tags = Tag::where('name', 'LIKE', "%{$query}%")->orderBy('updated_at', 'desc')->take(100)->get();
            $tagCounts = Tag::withCount('posts')->orderBy('posts_count', 'desc')->take(200)->get();


            if (!empty($tags)) {
                return view('search_tags_results', ['tags' => $tags, 'tagCounts' => $tagCounts]);
            }
        } catch (Exception $e) {
            echo "検索に失敗しました。", $e->getMessage();
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

        $posts = $posts->paginate(100);

        return view('tag', ['posts' => $posts, 'tag' => $tag]);
    }

    // コメント
    public function commentStore(CommentRequest $request, $things)
    {
        try {
            $request->validate($request->rules());

            $post = Post::where('things', $things)->first();
            $ipAddress = $request->ip();

            $comments = $post->comes()->where('comes.ip_address', $ipAddress)->where('comes.created_at', '>=', now()->subDay())->get();
            $commentCount = $comments->count();
            // 50回越えたら上限いったよ通知
            if ($commentCount >= 50) {
                return redirect()->back()->with('flashMessage', 'コメント上限を越えました。しばらく時間を置いてから再度お試しください。');
            } else {
                $comes = new Come;
                $comes->user_name = $request->user_name ?: '匿名さん';
                $comes->content = $request->content;
                $comes->ip_address = $ipAddress;
                $comes->save();

                $post->comes()->attach($comes->id);

                return redirect()->route('details', ['things' => $post->things])->with('flashMessage', 'コメント完了！');
            }
        } catch (Exception $e) {
            echo "コメントに失敗しました。", $e->getMessage();
        }
    }
}
