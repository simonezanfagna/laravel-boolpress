<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

      $posts = Post::all();

      return view('admin.posts.index',[
        'posts' => $posts
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

      return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $datiForm = $request->all();

      $post = new Post();
      $post->fill($datiForm);

      if (!empty($datiForm['cover_image_file'])) {
        $cover_image = $datiForm['cover_image_file'];
        $cover_image_path = Storage::put('uploads', $cover_image);
        $post->cover_image = $cover_image_path;
      }

      $slugOriginale = Str::slug($datiForm['title'],'-');
      $slug = $slugOriginale;
      //verifico se lo slug esiste
      $postStessoSlug = Post::where('slug',$slug)->first();
      $n = 1;
      while (!empty($postStessoSlug)) {
        $slug = $slugOriginale . '-' . $n;
        $postStessoSlug = Post::where('slug',$slug)->first();
        $n++;
      }
      $post->slug = $slug;

      $post->save();

      return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post){

      return view('admin.posts.show',[
        'post' => $post
      ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){


      return view('admin.posts.edit',[
        'post' => $post
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post){

      $datiForm = $request->all();

      if (!empty($datiForm['cover_image_file'])) {
        $cover_image = $datiForm['cover_image_file'];
        $cover_image_path = Storage::put('uploads', $cover_image);
        $datiForm['cover_image'] = $cover_image_path;
      }

      $post->update($datiForm);

      return redirect()->route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $post_image = $post->cover_image;
      Storage::delete($post_image);

      $post->delete();
      return redirect()->route('admin.posts.index');
    }
}
