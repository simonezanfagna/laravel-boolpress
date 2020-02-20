@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1>Gestione post admin</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Titolo</th>
              <th scope="col">Autore</th>
              <th scope="col">Slug</th>
              <th scope="col">Azioni</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($posts as $post)
              <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->author}}</td>
                <td>{{$post->slug}}</td>
                <td>
                  <a class="btn btn-info" href="{{ route('admin.posts.show', ['post' => $post->id]) }}">Visualizza</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5">Non ci sono post</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>


@endsection
