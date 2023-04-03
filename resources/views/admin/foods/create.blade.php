@extends('layouts.app')

@section('title', 'Crea un nuovo cibo')

@section('content')
  <header class="my-5">
    <h1>Crea</h1>
  </header>
  <hr>

  @include('includes.foods.form')

@endsection
