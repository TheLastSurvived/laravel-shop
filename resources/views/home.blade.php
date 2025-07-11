@extends('layouts.index')

@section('title', 'Главная страница')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Каталог</h3>
                </div>
                <div class="card-body">
                    <div class="album py-5">
                        <div class="container">
                            <div class="row row-cols-1 row-cols-sm-2 g-3">
                                <div class="col">
                                    <div class="card shadow-sm">
                                        <img src="{{ asset('images/velo.jpg') }}" alt="Изображение товара" style="max-height: 500px; object-fit: cover;">
                                        <div class="card-body">
                                            <p class="card-text">Велосипед</p>
                                            
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="btn-group">
                                                    <a href="{{ route('product') }}"
                                                        class="btn btn-sm btn-outline-secondary">Просмотреть</a>
                                                </div>
                                                <small class="text-body-secondary">Категория | 500 $</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Фильтры</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('home') }}" method="GET">
                        <!-- Категории -->
                        <div class="mb-4">
                            <h6 class="mb-3">Категории</h6>
                            @foreach(['Все', 'Дорожный', 'Детский', 'BMX', 'Гибрид'] as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" 
                                           id="category-{{ $loop->index }}" value="{{ $category }}"
                                           {{ request('category') == $category ? 'checked' : '' }}>
                                    <label class="form-check-label" for="category-{{ $loop->index }}">
                                        {{ $category }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Сортировка -->
                        <div class="mb-4">
                            <h6 class="mb-3">Сортировка</h6>
                            <select class="form-select" name="sort">
                                <option value="">По умолчанию</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Цена по возрастанию</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Цена по убыванию</option>
                                
                            </select>
                        </div>

                        <!-- Цена -->
                        <div class="mb-4">
                            <h6 class="mb-3">Цена</h6>
                            <div class="row g-2">
                                <div class="col">
                                    <input type="number" class="form-control" name="min_price" 
                                           placeholder="От" value="{{ request('min_price') }}">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="max_price" 
                                           placeholder="До" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Кнопки -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Применить</button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Сбросить фильтры</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection