@extends('layouts.index')

@section('title', 'Главная страница')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Каталог велосипедов</h3>
                    <div>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('products.create') }}" class="btn btn-sm btn-success">
                                    Добавить велосипед
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="album py-5">
                        <div class="container">
                            @if($products->isEmpty())
                                <div class="alert alert-info">
                                    Товары не найдены. Попробуйте изменить параметры фильтрации.
                                </div>
                            @else
                                <div class="row row-cols-1 row-cols-sm-2 g-3">
                                    @foreach($products as $product)
                                        <div class="col">
                                            <div class="card shadow-sm h-100">
                                                @if($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="card-img-top" 
                                                         style="height: 250px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('images/notfound.jpg') }}" 
                                                         alt="Изображение товара" 
                                                         class="card-img-top"
                                                         style="height: 250px; object-fit: cover;">
                                                @endif
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $product->name }}</h5>
                                                    <p class="text-muted mb-2">
                                                        {{ $product->category_name }}
                                                    </p>
                                                    <p class="fw-bold mb-3">
                                                        {{ number_format($product->price, 0, '', ' ') }} $
                                                    </p>
                                                    
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div class="btn-group">
                                                            <a href="{{ route('products.show', $product) }}"
                                                                class="btn btn-sm btn-outline-primary">
                                                                Подробнее
                                                            </a>
                                                            @auth
                                                                @if(auth()->user()->isAdmin())
                                                                    <a href="{{ route('products.edit', $product) }}" 
                                                                       class="btn btn-sm btn-outline-secondary">
                                                                        Редактировать
                                                                    </a>
                                                                @endif
                                                            @endauth
                                                        </div>
                                                        @auth
                                                            @if(auth()->user()->isAdmin())
                                                                <form action="{{ route('products.destroy', $product) }}" 
                                                                      method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" 
                                                                            class="btn btn-sm btn-outline-danger"
                                                                            onclick="return confirm('Удалить товар?')">
                                                                        Удалить
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                            <div class="mt-4 d-flex justify-content-center gap-3">
    {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Блок фильтров -->
        <div class="col-md-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Фильтры</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('home') }}" method="GET">
                        <!-- Категории -->
                        <div class="mb-4">
                            <h6 class="mb-3">Категории</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" 
                                       id="category-all" value="" 
                                       {{ empty(request('category')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="category-all">
                                    Все категории
                                </label>
                            </div>
                            @foreach(App\Models\Product::CATEGORIES as $category => $name)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" 
                                           id="category-{{ $category }}" value="{{ $category }}"
                                           {{ request('category') == $category ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category-{{ $category }}">
                                        {{ $name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Цена -->
                        <div class="mb-4">
                            <h6 class="mb-3">Цена ($)</h6>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" class="form-control" name="price_from" 
                                           placeholder="От" value="{{ request('price_from') }}"
                                           min="0">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="price_to" 
                                           placeholder="До" value="{{ request('price_to') }}"
                                           min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Сортировка -->
                        <div class="mb-4">
                            <h6 class="mb-3">Сортировка</h6>
                            <select class="form-select" name="sort">
                                <option value="">По умолчанию (новые)</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    Цена по возрастанию
                                </option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Цена по убыванию
                                </option>
                            </select>
                        </div>

                        <!-- Кнопки -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Применить фильтры
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                                Сбросить фильтры
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection