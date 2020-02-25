@extends('layouts.public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mt-4" style="width: 18rem;">
          <img class="card-img-top" src="{{$post->cover_image ? asset('storage/' . $post->cover_image) : asset('storage/uploads/unnamed.jpg')}}">
          <div class="card-body">
            <h5 class="card-title">Titolo: {{$post->title}}</h5>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Autore: {{$post->author}}</li>
              <li class="list-group-item">Testo: {{$post->content}}</li>
              <li class="list-group-item">
                Categoria:
                @if ($post->category_id)
                  <a href="{{route('blogCategory', ['slug' => $post->category->slug ])}}">{{$post->category->name}}</a>
                @else
                  <span>-</span>
                @endif
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
