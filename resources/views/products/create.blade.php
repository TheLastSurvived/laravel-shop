@extends('layouts.index')

@section('title', 'Добавить новый велосипед')

@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
      <li class="breadcrumb-item active" aria-current="page">Добавить велосипед</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-header">
      <h3 class="mb-0">Добавить новый велосипед</h3>
    </div>
    <div class="card-body">
      
      <form action="{{ url('/products') }}" method="POST" enctype="multipart/form-data">
        @csrf
     
        <!-- Основная информация -->
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="name" class="form-label">Название*</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name') }}" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Категория*</label>
              <select class="form-select @error('category') is-invalid @enderror" 
                      id="category" name="category" required>
                <option value="">Выберите категорию</option>
                @foreach(App\Models\Product::CATEGORIES as $key => $name)
                  <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>
                    {{ $name }}
                  </option>
                @endforeach
              </select>
              @error('category')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Цена ($)*</label>
              <input type="number" class="form-control @error('price') is-invalid @enderror" 
                     id="price" name="price" min="0" step="0.01" value="{{ old('price') }}" required>
              @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="col-md-6">
            <div class="mb-3">
              <label for="image" class="form-label">Изображение</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror" 
                     id="image" name="image" accept="image/*">
              @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-text">Рекомендуемый размер: 800x600px</div>
            </div>
            
            <div class="border p-3 text-center">
              <img id="image-preview" src="#" alt="Предпросмотр изображения" 
                   class="img-fluid d-none" style="max-height: 200px;">
              <p id="no-image-text" class="text-muted mb-0">Изображение не выбрано</p>
            </div>
          </div>
        </div>

        <!-- Описание -->
        <div class="mb-4">
          <label for="description" class="form-label">Описание</label>
          <textarea class="form-control @error('description') is-invalid @enderror" 
                    id="description" name="description" rows="4">{{ old('description') }}</textarea>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Кнопки -->
        <div class="d-flex justify-content-between">
          <a href="{{ route('home') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Назад
          </a>
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-save"></i> Сохранить велосипед
          </button>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  // Предпросмотр изображения перед загрузкой
  document.getElementById('image').addEventListener('change', function(event) {
    const [file] = event.target.files;
    const preview = document.getElementById('image-preview');
    const noImageText = document.getElementById('no-image-text');
    
    if (file) {
      preview.src = URL.createObjectURL(file);
      preview.classList.remove('d-none');
      noImageText.classList.add('d-none');
    } else {
      preview.classList.add('d-none');
      noImageText.classList.remove('d-none');
    }
  });
</script>
@endpush