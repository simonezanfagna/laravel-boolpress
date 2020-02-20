@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12 clearfix">
        <h1 class="d-inline-block">Nuova ricetta</h1>
        {{-- <a class="btn btn-success float-right" href="{{ route('admin.posts.index')}}">Home</a> --}}
      </div>
      <div class="col-sm-12">
        <form method="post" action="{{route('admin.posts.update',['post' => $post->id])}}">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Titolo</label>
            <input type="tetx" class="form-control" id="title" name="title" value="{{$post->title}}">
          </div>
          <div class="form-group">
            <label for="author">Autore</label>
            <input type="tetx" class="form-control" id="author" name="author" value="{{$post->author}}">
          </div>
          <div class="form-group">
            <label for="content">Articolo</label>
            <textarea class="form-control" name="content" rows="8">{{$post->content}}</textarea>
          </div>

          <button class="btn btn-primary" type="submit" name="button">Modifica</button>
        </form>
      </div>
    </div>
  </div>
@endsection
