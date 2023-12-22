<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class explainController extends Controller
{
    public function show_terms()
    {
        return view('explanation.term');
    }
}
