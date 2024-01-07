<?php

namespace App\Http\Controllers;

use App\Models\Post;


class explainController extends Controller
{
    public function show_terms()
    {
        return view('explanation.term');
    }

    public function show_policy()
    {
        return view('explanation.policy');
    }

    public function show_usage()
    {
        return view('explanation.usage');
    }

    public function show_sr()
    {
        return view('explanation.SR');
    }
}
