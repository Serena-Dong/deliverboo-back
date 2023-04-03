@if ($post->exists)
  <form action="{{ route('admin.foods.update', $food->id) }}" method="POST" enctype="multipart/form-data" novalidate>
    @method('PUT')
  @else
    <form action="{{ route('admin.foods.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif

@csrf
<div class="row">

  {{-- NAME  --}}
  <div class="col-md-6">
    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
        value="{{ old('name', $food->name) }}" required minlength="1">
      @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <small class=" text-muted">Inserisci il Nome del Cibo</small>
      @enderror
    </div>
  </div>

  {{-- SLUG  --}}
  <div class="col-md-6">
    <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" class="form-control" id="slug" value="{{ Str::slug(old('name', $food->name), '-') }}"
        disabled>
    </div>
  </div>

  {{-- PRICE --}}
  <div class="col-md-6">
    <div class="mb-3">
      <label for="price" class="form-label">Price</label>
      <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
        value="{{ old('price', $food->price) }}" required step="0.01" min="1">
      @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
      @else
        <small class=" text-muted">Inserisci il prezzo del cibo</small>
      @enderror
    </div>
  </div>

  {{-- Image --}}
  <div class="col-md-7">
    <div class="mb-3">
      <label for="image" class="form-label">Immagine</label>
      <input type="file" class="form-control" id="image"
        name="image">
    </div>
  </div>
  <div class="col-md-1">
    <img class="img-fluid" id="img-preview"
      src="{{ $food->image ? asset('storage/' . $food->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
      alt="">
  </div>

  {{-- DESCRIPTION  --}}
  <div class="col">
    <div class="mb-3">
      <label for="description" class="form-label">Descrizione Ricetta</label>
      <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="6">{{ old('description', $recipe->description) }}</textarea>
      @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>

  {{-- IS PUBLIC --}}
  <div class="col-2 d-flex justify-content-end">
    <div class="form-check form-switch">
      <input class="form-check-input" type="checkbox" role="switch" id="is_public" name="is_public"
        @if (old('is_public', $food->is_public)) checked @endif>
      <label class="form-check-label" for="is_published">Pubblicato</label>
    </div>
  </div>

  
<hr>
<div class="d-flex justify-content-between bg-white">
  <a href="{{ route('admin.foods.index') }}" class="btn btn-secondary me-2"><i class="fas fa-arrow-left me-2"></i>
    Indietro</a>
  <button type="submit" class="btn btn-success"><i class="fas fa-floppy-disk me-2"></i> Salva</button>
</div>
</form>


@section('scripts')

  {{-- SLUG  --}}
  <script>
    const slugInput = document.getElementById('slug');
    const titleInput = document.getElementById('name');

    titleInput.addEventListener('blur', () => {
      slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');
    });
  </script>

  {{-- IMAGE  --}}
  <script>
    const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('img-preview');

    imageInput.addEventListener('change', () => {
      if (imageInput.files && imageInput.files[0]) {
        const reader = new FileReader();
        reader.readAsDataURL(imageInput.files[0]);

        reader.onload = e => {
          imagePreview.src = e.target.result;
        }

      } else imagePreview.setAttribute('src', placeholder);
    });
  </script>
@endsection
