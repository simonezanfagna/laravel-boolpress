@extends('layouts.admin')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12 clearfix">
        <h1 class="d-inline-block">Gestione post admin</h1>
        <a class="btn btn-success float-right" href="{{ route('admin.posts.create')}}">Nuovo post</a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Titolo</th>
              <th scope="col">Categoria</th>
              <th scope="col">Tag</th>
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
                <td>{{$post->category_id ? $post->category->name : '-'}}</td>
                <td>
                  @forelse ($post->tags as $tag)
                    {{$tag->name}}{{$loop->last ? '' : ','}}
                  @empty
                    <span>-</span>
                  @endforelse
                </td>
                <td>{{$post->author}}</td>
                <td>{{$post->slug}}</td>
                <td>
                  <a class="btn btn-info" href="{{ route('admin.posts.show', ['post' => $post->id]) }}">Visualizza</a>
                  <a class="btn btn-warning" href="{{ route('admin.posts.edit', ['post' => $post->id]) }}">Modifica</a>
                  <form class="d-inline block" action="{{route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger" value="Cancella">
                  </form>
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
