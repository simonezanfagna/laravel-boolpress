@extends('layouts.public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12 mt-5">
        <h1>Errore 404: pagina non trovata</h1>
        <p>La pagina che stavi cercando non esiste!</p>
        <a href="{{route('public.home')}}" class="btn btn-primary">Torna in homepage</a>
      </div>
    </div>
  </div>
@endsection
