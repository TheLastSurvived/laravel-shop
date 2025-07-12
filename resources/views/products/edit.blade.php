@extends('layouts.index')

@section('title', 'Редактировать велосипед')

@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
      <li class="breadcrumb-item"><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></li>
      <li class="breadcrumb-item active" aria-current="page">Редактировать</li>
    </ol>
  </nav>

  <div class="card">
    <div class="card-header">
      <h3 class="mb-0">Редактировать велосипед</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Основная информация -->
        <div class="row mb-4">
          <div class="col-md-6">
            <div class="mb-3">
              <label for="name" class="form-label">Название*</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" 
                     id="name" name="name" value="{{ old('name', $product->name) }}" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Категория*</label>
              <select class="form-select @error('category') is-invalid @enderror" 
                      id="category" name="category" required>
                @foreach(App\Models\Product::CATEGORIES as $key => $name)
                  <option value="{{ $key }}" {{ old('category', $product->category) == $key ? 'selected' : '' }}>
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
                     id="price" name="price" min="0" step="0.01" 
                     value="{{ old('price', $product->price) }}" required>
              @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="col-md-6">
            <!-- Текущее изображение -->
            <div class="mb-3">
              <label class="form-label">Текущее изображение</label>
              @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" 
                     class="img-fluid rounded mb-2 d-block" 
                     alt="Текущее изображение"
                     style="max-height: 200px;">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" 
                         id="remove_image" name="remove_image" value="1">
                  <label class="form-check-label" for="remove_image">
                    Удалить текущее изображение
                  </label>
                </div>
              @else
                <div class="text-muted">Изображение отсутствует</div>
              @endif
            </div>

            <!-- Новое изображение -->
            <div class="mb-3">
              <label for="image" class="form-label">Новое изображение</label>
              <input type="file" class="form-control @error('image') is-invalid @enderror" 
                     id="image" name="image" accept="image/*">
              @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
              <div class="form-text">Оставьте пустым, чтобы сохранить текущее</div>
            </div>
          </div>
        </div>

        <!-- Описание -->
        <div class="mb-4">
          <label for="description" class="form-label">Описание</label>
          <textarea class="form-control @error('description') is-invalid @enderror" 
                    id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
          @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <!-- Кнопки -->
        <div class="d-flex justify-content-between">
          <a href="{{ route('products.show', $product) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Отменить
          </a>
          <div>
            <button type="submit" class="btn btn-primary me-2">
              <i class="bi bi-save"></i> Сохранить изменения
            </button>
            <a href="{{ route('products.show', $product) }}" class="btn btn-outline-danger">
              <i class="bi bi-x-circle"></i> Вернуть оригинал
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('styles')
<style>
  .form-check-input:checked {
    background-color: #dc3545;
    border-color: #dc3545;
  }
</style>
@endpush

@push('scripts')
<script>
  // Предпросмотр нового изображения перед загрузкой
  document.getElementById('image').addEventListener('change', function(event) {
    const [file] = event.target.files;
    const preview = document.getElementById('image-preview');
    
    if (file) {
      if (!preview) {
        const imgContainer = document.querySelector('.col-md-6');
        const newPreview = document.createElement('img');
        newPreview.id = 'image-preview';
        newPreview.src = URL.createObjectURL(file);
        newPreview.className = 'img-fluid rounded mb-2 d-block';
        newPreview.style.maxHeight = '200px';
        newPreview.alt = 'Предпросмотр нового изображения';
        this.parentNode.insertBefore(newPreview, this.nextSibling);
      } else {
        preview.src = URL.createObjectURL(file);
      }
    }
  });

  // Блокировка удаления изображения при выборе нового
  document.getElementById('image').addEventListener('change', function() {
    if (this.files.length > 0) {
      document.getElementById('remove_image').checked = false;
    }
  });

  // Блокировка загрузки нового изображения при удалении текущего
  document.getElementById('remove_image')?.addEventListener('change', function() {
    if (this.checked) {
      document.getElementById('image').value = '';
      const preview = document.getElementById('image-preview');
      if (preview) preview.remove();
    }
  });
</script>
@endpush