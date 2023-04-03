@extends('layouts.app')

@section('title', 'Modifica cibo')


@section('content')
  <header class="my-5">
    <h1>Modifica</h1>
  </header>
  <hr>

  @include('includes.foods.form')

@endsection
