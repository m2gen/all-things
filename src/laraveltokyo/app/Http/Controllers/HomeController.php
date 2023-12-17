<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function show()
    {
        return view('article');
    }

    public function store(PostRequest $request)
    {
        $request->validate($request->rules());

        $post = new Post;
        $post->things = str_replace(array(" ", "　"), "", $request->things);
        $post->overview = $request->overview;
        $post->save();

        $tagNames = explode(',', $request->tags);
        foreach ($tagNames as $tagName) {
            $tagName = str_replace(array(" ", "　"), "", $tagName);
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag->id);
        }

        return redirect()->route('details', ['things' => $post->things]);
    }

    public function showForm($things)
    {
        $posts = Post::where('things', $things)->first();

        return view('edit', ['posts' => $posts]);
    }

    public function update(UpdateRequest $request, $things)
    {

        $request->validate($request->rules());

        $newThings = $request->input('things');
        $post = Post::where('things', $things)->firstOrFail();

        $post->update([
            'things' => $newThings,
            'overview' => $request->input('overview')
        ]);

        $post->tags()->detach();

        $tagNames = explode(',', $request->tags);
        foreach ($tagNames as $tagName) {
            $tagName = str_replace(array(" ", "　"), "", $tagName);
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag->id);
        }

        return redirect()->route('details', ['things' => $newThings]);
    }
}
