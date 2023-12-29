<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\UserRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Favorite;
use App\Models\User;
use Exception;

class HomeController extends Controller
{
    // ログインしてるかどうか
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 万物新規登録
    public function show()
    {
        return view('article');
    }

    // 新規万物を保存
    public function store(PostRequest $request)
    {
        try {
            $request->validate($request->rules());

            $post = new Post;
            $post->things = $request->things;
            $post->overview = $request->overview;
            $post->save();

            $tagNames = explode(',', $request->tags);
            $tagNames = array_map('trim', $tagNames);
            $tagNames = array_filter($tagNames);
            $tagNames = array_unique($tagNames);
            foreach ($tagNames as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $tagName]);
                }
                $post->tags()->attach($tag->id);
            }

            return redirect()->route('details', ['things' => $post->things]);
        } catch (Exception $e) {
            echo "保存に失敗しました。", $e->getMessage();
        }
    }

    // 新規万物表示
    public function showForm($things)
    {
        $posts = Post::where('things', $things)->first();

        return view('edit', ['posts' => $posts]);
    }

    // 万物更新
    public function update(UpdateRequest $request, $things)
    {
        try {
            $request->validate($request->rules());

            $newThings = $request->input('things');
            $post = Post::where('things', $things)->firstOrFail();

            $post->update([
                'things' => $newThings,
                'overview' => $request->input('overview')
            ]);

            $post->tags()->detach();

            $tagNames = explode(',', $request->tags);
            $tagNames = array_map('trim', $tagNames);
            $tagNames = array_filter($tagNames);
            $tagNames = array_unique($tagNames);
            foreach ($tagNames as $tagName) {
                $tag = Tag::where('name', $tagName)->first();
                if (!$tag) {
                    $tag = Tag::create(['name' => $tagName]);
                }
                $post->tags()->attach($tag->id);
            }

            return redirect()->route('details', ['things' => $newThings]);
        } catch (Exception $e) {
            echo "更新に失敗しました。", $e->getMessage();
        }
    }

    // ユーザー万物お気に入り登録
    public function myPage()
    {
        $user = auth()->user();
        $favorite_posts = $user->favorite_posts->take(200)->paginate(50);

        return view('myPage', compact('favorite_posts'));
    }

    public function name_update(UserRequest $request)
    {
        try {
            $request->validate($request->rules());

            $user = auth()->user();
            $inputs = $request->all();

            User::where('id', $user->id)->update([
                'name' => $inputs['name']
            ]);

            return back()->with('flashMessage', 'ユーザーネームを変更しました');
        } catch (Exception $e) {
            echo "名前変更に失敗しました。", $e->getMessage();
        }
    }

    public function favorites_store(Request $request)
    {
        try {
            $user = auth()->user();
            $favoritesCount = $user->favorite_posts->count();

            if ($favoritesCount >= 100) {
                return back()->with('flashMessage', 'お気に入り登録は100個までです');
            }

            $favorites = new Favorite;
            $favorites->post_id = $request->post_id;
            $favorites->user_id = auth()->user()->id;
            $favorites->save();

            return back()->with('flashMessage', 'お気に入り登録しました。マイページより確認可能です。');
        } catch (Exception $e) {
            echo "お気に入り登録に失敗しました。", $e->getMessage();
        }
    }

    public function favorites_delete($id)
    {
        try {
            $user = auth()->user();
            Favorite::where('post_id', $id)->where('user_id', $user->id)->delete();

            return back()->with('flashMessage', 'お気に入りを解除しました');
        } catch (Exception $e) {
            echo "お気に入り登録解除に失敗しました。", $e->getMessage();
        }
    }
}
