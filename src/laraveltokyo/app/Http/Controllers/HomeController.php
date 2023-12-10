<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

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
        $posts = new Post();
        $posts->things = $request->things;
        $posts->overview = $request->overview;
        $posts->save();

        return redirect()->route('details', ['things' => $posts->things]);
    }

    public function showForm($things)
    {
        $posts = Post::where('things', $things)->firstOrFail();

        return view('edit', ['posts' => $posts]);
    }

    public function update(Request $request, $things)
    {
        $newThings = $request->input('things');

        Post::where('things', $things)->update([
            'things' => $newThings,
            'overview' => $request->input('overview')
        ]);

        return redirect()->route('details', ['things' => $newThings])->with('success', '良い更新だ。');
    }
}
