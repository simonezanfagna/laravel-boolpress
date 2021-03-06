@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12 clearfix">
        <h1 class="d-inline-block">Modifica post</h1>
        {{-- <a class="btn btn-success float-right" href="{{ route('admin.posts.index')}}">Home</a> --}}
      </div>
      <div class="col-sm-12">
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <form method="post" action="{{route('admin.posts.update',['post' => $post->id])}}" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="title">Titolo</label>
            <input type="tetx" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
          </div>
          <div class="form-group">
            <label for="author">Autore</label>
            <input type="tetx" class="form-control" id="author" name="author" value="{{old('author', $post->author)}}">
          </div>
          <div class="form-group">
            <label for="content">Articolo</label>
            <textarea class="form-control" name="content" rows="8">{{old('content', $post->content)}}</textarea>
          </div>
          <div class="form-group">
            <label for="cover_image_file">Immagine</label>
            @if ($post->cover_image)
              <img class="card-img-top" src="{{asset('storage/' . $post->cover_image)}}">
            @endif
            <input type="file" class="form-control-file" id="cover_image_file" name="cover_image_file">
          </div>
          <div class="form-group">
            <select class="form-group" name="category_id" required>
              <option value="">Seleziona categoria</option>
              @foreach ($categories as $category)
                <option value="{{$category->id}}"
                  @if (!empty(old('category_id')))
                    {{old('category_id') == $category->id ? 'selected' : ''}}
                  @else
                    {{$post->category && ($post->category->id == $category->id) ? 'selected' : ''}}
                  @endif
                  >{{$category->name}}</option>
              @endforeach
            </select>
          </div>
          @if ($tags->count() > 0)
            <div class="from-group">
              <p>Seleziona i tag per il post:</p>
              @foreach ($tags as $tag)
                <label class="mr-3">
                  <input type="checkbox" name="tag_id[]" value="{{$tag->id}}"
                  @if ($errors->any())
                    {{in_array($tag->id, old('tag_id', array())) ? 'checked' : ''}}
                  @else
                    {{$post->tags->contains($tag) ? 'checked' : ''}}
                  @endif
                  >
                  {{$tag->name}}
                </label>
              @endforeach
            </div>
          @endif

          <button class="btn btn-primary" type="submit" name="button">Modifica</button>
        </form>
      </div>
    </div>
  </div>
@endsection
