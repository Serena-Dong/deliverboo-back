@extends('layouts.app')

@section('title', 'Crea nuovo ristorante')

@section('content')
  <header class="my-5">
    <h1 class="ms-2">Crea</h1>
  </header>
  <hr>

  <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row p-0 m-0">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="name" class="form-label">Nome del ristorante</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" value="{{ old('name', $restaurant->name) }}" required minlength="5" maxlength="40">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <small class=" text-muted">Inserisci il nome</small>
                @enderror
            </div>
        </div> 
        <div class="col-md-4">
            <div class="mb-3">
                <label for="address" class="form-label">Via del ristorante</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                    name="address" value="{{ old('address', $restaurant->address) }}" required minlength="5" maxlength="40">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <small class=" text-muted">Inserisci l'indirizzo</small>
                @enderror
            </div>
        </div>     
        <div class="col-md-4">
            <div class="mb-3">
                <label for="phone_number" class="form-label">Numero di telefono</label>
                <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    name="phone_number" value="{{ old('phone_number', $restaurant->phone_number) }}" minlength="12" maxlength="13">
                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <small class=" text-muted">Inserisci il numero</small>
                @enderror
            </div>
        </div>  
        <div class="col-md-4">
            <div class="mb-3">
                <label for="min_order" class="form-label">ordine minimo</label>
                <input type="number" class="form-control @error('min_order') is-invalid @enderror" id="min_order"
                    name="min_order" value="{{ old('min_order', $restaurant->min_order) }}"  minlength="10">
                @error('min_order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <small class=" text-muted">Inserisci il numero</small>
                @enderror
            </div>
        </div>  
    
        <div class="col-md-4">
            <div class="mb-3">
                <label for="shipment_price" class="form-label">spedizione</label>
                <input type="number" class="form-control @error('shipment_price') is-invalid @enderror" id="shipment_price"
                    name="shipment_price" value="{{ old('shipment_price', $restaurant->shipment_price) }}"  minlength="1">
                @error('shipment_price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @else
                    <small class=" text-muted">Inserisci il numero</small>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="logo" class="form-label">Immagine</label>
                <input type="file" class="form-control @if ($restaurant->logo) d-none @endif" id="logo"
                    name="logo">
    
    
                {{-- Finto upload --}}
                <div class="input-group mb-3 @if (!$restaurant->logo) d-none @endif" id="previous-image">
                    <button class="btn btn-outline-secondary" type="button" id="change-image-button">Cambia
                        immagine</button>
                    <input type="text" class="form-control" value="{{ $restaurant->logo }}" disabled>
                </div>
    
            </div>
        </div>
        <div class="col-md-3">
            <img class="img-fluid" id="img-preview"
                src="{{ $restaurant->logo ? asset('storage/' . $restaurant->logo) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
                alt="">
        </div>
        <div class="row p-0 m-0">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description', $restaurant->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <div class="d-flex justify-content-end py-3">
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-secondary me-2"></i>Indietro</a>
                <button type="submit" class="btn btn-success">Salva</button>
            </div>
        </div>
    
    </div>
    
    

    
   
    </form>
  

@endsection

@section('scripts')
<script>
    const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

    const imageInput = document.getElementById('logo');
    const imagePreview = document.getElementById('img-preview');

    imageInput.addEventListener('change', () => {
      if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        reader.readAsDataURL(imageInput.files[0]);

        reader.onload = e => {
          imagePreview.src = e.target.result;
        }

      } else imagePreview.src = placeholder;
    });
  </script>

@endsection