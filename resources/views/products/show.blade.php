@extends('layouts.index')

@section('title', $product->name)

@section('content')
  <!-- Хлебные крошки -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
    <li class="breadcrumb-item"><a
      href="{{ route('home', ['category' => $product->category]) }}">{{ $product->category_name }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
    </ol>
  </nav>

  <div class="row">
    <!-- Блок с изображением -->
    <div class="col-md-6 bg-light d-flex justify-content-center align-items-center p-4">
    @if($product->image)
    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="{{ $product->name }}"
      style="max-height: 500px;">
    @else
    <img src="{{ asset('images/notfound.jpg') }}" class="img-fluid rounded" alt="Изображение товара"
      style="max-height: 500px;">
    @endif
    </div>

    <!-- Блок с информацией -->
    <div class="col-md-6 p-4">
    <h1 class="mb-3">{{ $product->name }}</h1>
    <h5 class="text-muted mb-4">Категория: {{ $product->category_name }}</h5>


    <form action="{{ route('cart.add', $product) }}" method="POST">
      @csrf
      <div class="mb-4 w-50">
      <label for="countInput" class="form-label">Количество</label>
      <input type="number" name="quantity" class="form-control" min="1" value="1" max="100" id="countInput">
      </div>
      @auth
      <button type="submit" class="btn btn-success btn-lg w-100 mb-4">
      <i class="bi bi-cart-plus"></i> Добавить в корзину
      </button>
    @endauth

      @guest
      <button type="submit" class="btn btn-success btn-lg w-100 mb-4 disabled">
      <i class="bi bi-cart-plus" ></i> Добавить в корзину
      </button>
      <p class="text-muted">Для добавления в корзину необходимо <a href="{{route('login')}}">авторизоваться</a>!</p>
    @endguest
    </form>

    <!-- Кнопки управления для админа -->
    @auth
      @if(auth()->user()->isAdmin())
      <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-4">
      <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary me-md-2">
      <i class="bi bi-pencil"></i> Редактировать
      </a>
      <form action="{{ route('products.destroy', $product) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Удалить этот товар?')">
      <i class="bi bi-trash"></i> Удалить
      </button>
      </form>
      </div>
      @endif
    @endauth
    </div>
  </div>

  <!-- Блок с описанием -->
  <div class="row mt-4">
    <div class="col-12">
    <div class="card">
      <div class="card-header">
      <h3 class="mb-0">Описание</h3>
      </div>
      <div class="card-body">
      @if($product->description)
      <p class="card-text">{{ $product->description }}</p>
    @else
      <p class="text-muted">Описание отсутствует</p>
    @endif
      </div>
    </div>
    </div>
  </div>


@endsection