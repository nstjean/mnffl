<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Intervention\Image\ImageManagerStatic as Image;

class PostsController extends Controller
{
    /**
     * Enforce middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        //Debugbar::error('Error!');
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
        // validation
        $validatedData = $request->validate([
            'content' => 'required_without:post_image',
            'post_image' => 'sometimes|image'
        ]);

        // file upload
        $fileNameToStore = '';
        if($request->hasFile('post_image')) {
            $allowedfileExtension=['jpg','gif'];
            $image = $request->file('post_image');
            $fileNameWithExt = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            if(in_array($extension,$allowedfileExtension)) {
                $fileNameToStore = "img_".time().'.'.$extension;
                $path = public_path('storage/uploaded_images/' . $fileNameToStore);
                Image::make($image->getRealPath())
                    ->resize(800, 500, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($path);
            }
        }
        
        // Create post
        $post = new Post;
        if($request->input('content')) {
            $post->content = $request->input('content');
        } else {
            $post->content = "";
        }
        $post->user_id = auth()->user()->id;
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

        // check the PostPolicy
        $this->authorize('edit', $post);

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
        // validation
        $validatedData = $request->validate([
            'content' => 'required_without:post_image|required_if:post_image,false',
        ]);

        $post = Post::find($id);

        // check the PostPolicy
        $this->authorize('update', $post);

        // Delete image
        if($request->input('delete_image') == 'true' && $post->image_name != '') {
            $deleted = "image delete";
            Storage::delete('public/uploaded_images/'.$post->image_name);
            $post->image_name = '';
        }

        // Update post
        if($request->input('content')) {
            $post->content = $request->input('content');
        } else {
            $post->content = '';
        }
        $post->save();

        return redirect('/posts')->with('success', 'Post Saved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // check the PostPolicy
        $this->authorize('delete', $post);

        // Delete photo
        if($post->image_name) {
            Storage::delete('public/uploaded_images/'.$post->image_name);
        }
        // Delete post
        $post->delete();

        // Returns back to page where delete was submitted from - could be index or dashboard
        return redirect()->back()->with('success', 'Post Deleted');
    }
}
