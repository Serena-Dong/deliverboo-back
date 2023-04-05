@extends('layouts.app')

@section('title', 'Foods')

@section('content')
  <header class="d-flex align-items-center justify-content-between">
    <h1 class="my-5">Menu</h1>
    <div class="d-flex flex-grow-1 align-items-center justify-content-center">
      
    </div>
    <a href="{{ route('admin.foods.create') }}" class="btn btn-success ms-3">
      <i class="fas fa-plus me-2"></i> Crea nuovo
    </a>
  </header>

  <table class="table table-light table-striped mb-0">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Image</th>
        <th scope="col">Price</th>
        <th scope="col" class=" d-none d-md-table-cell">Description</th>
        <th class="d-none d-md-table-cell" scope="col">Stato</th>
        <th class=" d-none d-lg-table-cell" scope="col">Creato il</th>
        <th class=" d-none d-lg-table-cell" scope="col">Aggiornato il</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      @forelse($foods as $food)
        <tr>
          <th scope="row">{{ $food->id }}</th>
          <td>{{ $food->name }}</td>
          <td>
            <figure>
                <img src="{{ $food->image ? asset('storage/' . $food->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}" alt="" width="150"> 
            </figure>
          </td>
          <td>{{ $food->price }}</td>
          <td class=" d-none d-md-table-cell">{{ $food->description }}</td>
          <td class=" d-none d-md-table-cell">
              <form action="{{ route('admin.foods.toggle', $food->id) }}" method="POST">
                @method('PATCH')
                @csrf

                <button type="submit" class="btn btn-outline">
                  <i class="fas fa-2x fa-toggle-{{ $food->is_public ? 'on' : 'off' }}   {{ $food->is_public ? 'text-success' : 'text-danger' }}"></i>
                </button>
              </form>
              {{-- <i class="fas fa-2x fa-{{ $food->is_public ? 'check' : 'x' }} text-{{ $food->is_public ? 'success' : 'danger' }}"></i> --}}
          </td>
          <td class=" d-none d-lg-table-cell">{{ $food->getDateDiff('created_at') }}</td>
          <td class=" d-none d-lg-table-cell">{{ $food->getDate('updated_at', 'd-m-Y H:i:s') }}</td>
          <td>
            <div class="d-flex justify-md-content-end flex-column flex-md-row align-items-center">

                <a href="{{ route('admin.foods.show', $food->id) }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i>
                </a>

                <a href="{{ route('admin.foods.edit', $food->id) }}" class="btn btn-sm btn-warning ms-md-2 my-2 text-white">
                  <i class="fas fa-pencil"></i>
                </a>

                <form method="POST" action="{{ route('admin.foods.destroy', $food->id) }}" class="delete-form"
                  data-entity="food">
                  @csrf
                  @method('DELETE')
                  <button class="ms-md-2 btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                </form>
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <th scope="row" colspan="9" class="text-center">Non ci sono Cibi</th>
        </tr>
      @endforelse

    </tbody>
  </table>
@endsection
