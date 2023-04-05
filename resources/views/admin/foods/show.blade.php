@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="card m-5">
        <div class="row g-0 align-items-center">
            <div class="col-md-4 p-3">
                <img src="{{ asset( $food->image) }}" class="img-fluid rounded-3" alt="{{$food->name}}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{$food->name}}</h5>
                    <address class="card-text"> {{$food->address}} </address>
                    <p class="card-text"><b>Ingredienti:</b> {{$food->description}}</p>
                    <div class="d-flex d-lg-block justify-content-between">
                        <p class="card-text"><small class="text-body-secondary">Prezzo: {{$food->price}}€</small></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="d-flex align-items-center justify-content-end me-3 gap-2">
            <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" class="delete-form text-center my-3">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i> Elimina</button>
            </form>
            <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i>Indietro</a>
        </div>

    </div>
</div>
@endsection