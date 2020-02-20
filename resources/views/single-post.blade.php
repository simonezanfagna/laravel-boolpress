@extends('layouts.public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mt-4" style="width: 100%;">
          <div class="card-header">
            Titolo: {{ $post->title }}
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Autore: {{$post->author}}</li>
            <li class="list-group-item">Testo: {{$post->content}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
