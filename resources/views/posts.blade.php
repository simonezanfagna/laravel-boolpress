@extends('layouts.public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="mt-3">lista tutti post</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        @forelse ($posts as $post)
          <div class="card mt-4" style="width: 100%;">
            <div class="card-header">
              {{$post->title}}
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Autore: {{$post->author}}</li>
            </ul>
            <div class="card-body">
              <a href="{{route('blogShow',['slug' => $post->slug])}}" class="card-link">Dettagli</a>
            </div>
          </div>
        @empty
          <p>Non ci sono post</p>
        @endforelse
      </div>
    </div>
  </div>

@endsection
