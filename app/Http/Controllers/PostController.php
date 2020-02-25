<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PostController extends Controller
{
    public function index(){
      $posts = Post::paginate(5);

      return view('posts',[
        'posts' => $posts
      ]);
    }

    public function show($slug){
      
      $post = Post::where('slug', $slug)->first();

      if (!empty($post)) {
        return view('single-post',[
          'post' => $post
        ]);
      }
      else {
        return abort(404);
      }

    }

    public function postCategoria($slug){

      $categoria = Category::where('slug',$slug)->first();

      if (!empty($categoria)) {
        $postCategoria = $categoria->posts;
        return view('single-category', [
          'category' => $categoria,
          'posts' => $postCategoria
        ]);
      }
      else {
        return abort(404);
      }
    }
}
