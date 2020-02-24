<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewLead;
use App\Mail\UserConfirmation;

class HomeController extends Controller
{
  public function index(){
    return view('home');
  }

  public function contatti(){
    return view('contatti');
  }

  public function contattiStore(Request $request){

    $newMessage = new Lead();
    $newMessage->fill($request->all());
    $newMessage->save();

    //invio email all' admin
    Mail::to('admin@sito.com')->send(new NewLead($newMessage));

    //invio mail di conferma all' utente con la copia del messaggio
    Mail::to($newMessage->email)->send(new UserConfirmation($newMessage));

    return redirect()->route('contattiGrazie');
  }

  public function grazie(){
    return view('thank-you');
  }

}
