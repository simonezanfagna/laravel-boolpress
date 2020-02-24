@extends('layouts.public')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="mt-3">Contattaci</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <form class="" action="{{ route('contattiStore') }}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="tetx" class="form-control" id="name" name="name" placeholder="Nome">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="email">
          </div>
          <div class="form-group">
            <label for="subject">Oggetto</label>
            <input type="tetx" class="form-control" id="subject" name="subject" placeholder="titolo">
          </div>
          <div class="form-group">
            <label for="message">Messaggio</label>
            <textarea class="form-control" name="message" placeholder="Scrivi il tuo messaggio" rows="8"></textarea>
          </div>

          <button class="btn btn-primary" type="submit" name="button">Invia</button>
        </form>
      </div>
    </div>
  </div>

@endsection
