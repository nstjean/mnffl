<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
    	$posts = auth()->user()->posts()->orderBy('created_at', 'desc')->paginate(20);
        return view('pages.dashboard')->with('posts', $posts);
    }

}
