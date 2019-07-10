<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // file upload
        if($request->hasFile('post_image')) {
            // get filename.ext
            $fileNameWithExt = $request->file('post_image')->getClientOriginalName();
            // get filename
            $extention = $request->file('post_image')->getClientOriginalExtension();
            // new filename
            $fileNameToStore = "img_".time().'.'.$extention;
            // upload
            $path = $request->file('post_image')->storeAs('public/uploaded_images', $fileNameToStore);
        } else {
            $fileNameToStore = '';
        }
        
        // Create post
        $post = new Post;
        $post->content = $request->input('body');
        $post->user_id = 1; // auth()->user()->id;
        $post->image_name = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // file upload
        if($request->hasFile('post_image')) {
            // get filename.ext
            $fileNameWithExt = $request->file('post_image')->getClientOriginalName();
            // get filename
            $extention = $request->file('post_image')->getClientOriginalExtension();
            // new filename
            $fileNameToStore = "img_".time().'.'.$extention;
            // upload
            $path = $request->file('post_image')->storeAs('public/uploaded_images', $fileNameToStore);
        }
        
        // Create post
        $post = Post::find($id);
        $post->content = $request->input('body');
        if($request->hasFile('cover_image')) {
            $post->image_name = $fileNameToStore;
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete post
        $post = Post::find($id);
        // delete photo
        if($post->post_image != "") {
            Storage::delete('public/cover_images/'.$post->post_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');
    }
}
