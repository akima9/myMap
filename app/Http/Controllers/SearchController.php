<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function show(Request $request)
    {
        $searchKeyword = $request->input('searchKeyword');

        return view('index', ['searchKeyword' => $searchKeyword]);
    }
}
