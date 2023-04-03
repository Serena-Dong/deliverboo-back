
@extends('layouts.app')
@section('content')
<div class="container d-flex justify-content-center">
    <div class="card mb-3" style="max-width: 80%;">
        <div class="row g-0">
        <div class="col-md-4 p-3">
            <img src="{{ asset('storage/' . $restaurant->logo) }}" class="img-fluid rounded-3" alt="{{$restaurant->name}}">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$restaurant->name}}</h5>
                <address class="card-text"> {{$restaurant->address}} </address>
                <p class="card-text">{{$restaurant->description}}</p>
                <div class="d-flex d-lg-block justify-content-between">
                    <p class="card-text"><small class="text-body-secondary">Ordine Minimo: {{$restaurant->min_order}}€</small></p>
                    <p class="card-text mb-3"><small class="text-body-secondary">Costi di consegna: {{$restaurant->shipment_price}}€</small></p>
                </div>
                <a href="{{ route('admin.foods.index')}}">Visualizza Menu</a>
            </div>
        </div>
        </div>
    </div>    
</div>
@endsection