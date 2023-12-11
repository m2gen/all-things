<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        $post = new Post;
        $post->things = $request->things;
        $post->overview = $request->overview;
        $post->save();

        $tagNames = explode(',', $request->tags);
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag->id);
        }

        return redirect()->route('details', ['things' => $post->things]);
    }

    public function showForm($things)
    {
        $posts = Post::where('things', $things)->firstOrFail();

        return view('edit', ['posts' => $posts]);
    }

    public function update(Request $request, $things)
    {
        $newThings = $request->input('things');
        $post = Post::where('things', $things)->firstOrFail();

        $post->update([
            'things' => $newThings,
            'overview' => $request->input('overview')
        ]);

        $post->tags()->detach();

        $tagNames = explode(',', $request->tags);
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $post->tags()->attach($tag->id);
        }

        return redirect()->route('details', ['things' => $newThings]);
    }
}
