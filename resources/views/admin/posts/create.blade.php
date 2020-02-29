@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12 clearfix">
        <h1 class="d-inline-block">Nuovo post</h1>
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
        <form method="post" action="{{route('admin.posts.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Titolo</label>
            <input type="tetx" class="form-control" id="title" name="title" placeholder="titolo" value="{{old('title')}}">
          </div>
          <div class="form-group">
            <label for="author">Autore</label>
            <input type="tetx" class="form-control" id="author" name="author" placeholder="autore" value="{{old('author')}}">
          </div>
          <div class="form-group">
            <label for="content">Articolo</label>
            <textarea class="form-control" name="content" placeholder="Scrivi il tuo articolo" rows="8">{{old('content')}}</textarea>
          </div>
          <div class="form-group">
            <label for="cover_image_file">Immagine</label>
            <input type="file" class="form-control-file" id="cover_image_file" name="cover_image_file">
          </div>
          @if ($categories->count() > 0)
            <div class="form-group">
              <select class="form-group" name="category_id" required>
                <option value="">Seleziona categoria</option>
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                @endforeach
              </select>
            </div>
          @endif
          @if ($tags->count() > 0)
            <div class="from-group">
              <p>Seleziona i tag per il post:</p>
              @foreach ($tags as $tag)
                <label class="mr-3">
                  <input type="checkbox" name="tag_id[]" value="{{$tag->id}}" {{in_array($tag->id, old('tag_id', array())) ? 'checked' : ''}}>
                  {{$tag->name}}
                </label>
              @endforeach
            </div>
          @endif

          <button class="btn btn-primary mt-4" type="submit" name="button">Crea</button>
        </form>
      </div>
    </div>
  </div>
@endsection
