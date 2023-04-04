@extends('layouts.app')

@section('content')
<section>
    <div class="container py-5 mt-5">
        
        <div class="text-center my-1 @if(count($restaurants) == 1) d-none @endif">
            <a href="{{ route('admin.restaurants.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i> Aggiungi il tuo ristorante
            </a>
        </div>
        
        <div class="row d-flex g-5 flex-wrap justify-content-center">
            @foreach ($restaurants as $restaurant)
                <div class="col-6 my-5 " style="height: 350px; min-width:450px">
                    <a href="{{ route('admin.restaurants.show', $restaurant['id']) }}" style="text-decoration: none; color:black;">
                        <div class="card d-flex flex-column-reverse align-items-center h-100 justify-content-between">
                            <figure class="text-center h-50 w-100 mb-5">
                                <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{$restaurant->name}}" class="img-fluid h-100 rounded-3">
                            </figure>
                            <div class="info text-center m-3">
                                <h1>Ristorante {{$restaurant->name}}</h1>
                            </div>
                        </div>
                    </a>
                    <div class="d-flex justify-content-center align-items-center mt-4 mb-5 gap-3">
                        <a href="{{ route('admin.restaurants.show', $restaurant->id) }}" class="btn btn-primary text-white"><i class="fa-solid fa-eye"></i> Visualizza</a>
                        <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit"><i class="fa-solid fa-trash"></i> Elimina</button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endsection