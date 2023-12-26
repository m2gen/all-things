<?php

namespace App\Http\Controllers;

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
}
