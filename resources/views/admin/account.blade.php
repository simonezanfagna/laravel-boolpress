@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ciao {{Auth::user()->name}}</div>

                <div class="card-body">
                  <h3>I tuoi dettagli:</h3>
                  <ul>
                    <li>Nome: {{$user_details->firstname}}</li>
                    <li>Cognome: {{$user_details->lastname}}</li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
