@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12 clearfix">
        <h1 class="d-inline-block">Nuovo post</h1>
        {{-- <a class="btn btn-success float-right" href="{{ route('admin.posts.index')}}">Home</a> --}}
      </div>
      <div class="col-sm-12">
        <form method="post" action="{{route('admin.posts.store')}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="title">Titolo</label>
            <input type="tetx" class="form-control" id="title" name="title" placeholder="titolo">
          </div>
          <div class="form-group">
            <label for="author">Autore</label>
            <input type="tetx" class="form-control" id="author" name="author" placeholder="autore">
          </div>
          <div class="form-group">
            <label for="content">Articolo</label>
            <textarea class="form-control" name="content" placeholder="Scrivi il tuo articolo" rows="8"></textarea>
          </div>
          <div class="form-group">
            <label for="cover_image_file">Immagine</label>
            <input type="file" class="form-control-file" id="cover_image_file" name="cover_image_file">
          </div>

          <button class="btn btn-primary" type="submit" name="button">Crea</button>
        </form>
      </div>
    </div>
  </div>
@endsection
