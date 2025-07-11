@extends('layouts.index')

@section('title', 'Товар')

@section('content')
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
    <li class="breadcrumb-item active" aria-current="page">Товар</li>
    </ol>
  </nav>
  <div class="row">
    <div class="col-6 bg-light d-flex justify-content-center">
    <img src="{{ asset('images/velo.jpg') }}" class="p-3" alt="Изображение товара">
    </div>
    <div class="col-6 p-3">
    <h1>Товар</h1>
    <h2>Категория: </h2>
    <p>Стоимость: <span><b>500</b></span> $</p>
    <form action="" method="post">
      <div class="mb-3">
        <label for="countInput" class="form-label">Количество</label>
        <input type="number" class="form-control" min="1" value="1" max="100" id="countInput">
      </div>
    </form>
    <a href="#" class="btn btn-success w-100">Добавить в корзину</a>
    </div>
    <div class="my-3">
    <p>Краткое описание</p>
    </div>
  </div>
@endsection