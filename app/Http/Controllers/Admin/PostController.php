<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Category;
use App\Tag;
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

      $categories = Category::all();
      $tags = Tag::all();

      return view('admin.posts.create', [
        'categories' => $categories,
        'tags' => $tags
      ]);
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
      // dd($datiForm);
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

      if(!empty($datiForm['tag_id'])) {
        // sono stati selezionati dei tag => li assegno al post
        // sincronizzo il post creato con i tag scelti
        $post->tags()->sync($datiForm['tag_id']);
      }
      
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

      $categories = Category::all();
      $tags = Tag::all();

      return view('admin.posts.edit',[
        'post' => $post,
        'categories' => $categories,
        'tags' => $tags
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

      if (!empty($datiForm['tag_id'])) {
        $post->tags()->sync($datiForm['tag_id']);
      }
      else {
        $post->tags()->sync([]);
      }

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

      if (!empty($post_image)) {
        Storage::delete($post_image);
      }

      if (!empty($post->tags->isNotEmpty())) {
        $post->tags()->sync([]);
      }

      $post->delete();
      return redirect()->route('admin.posts.index');
    }
}
