@extends('layouts.index')

@section('title', 'Корзина')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Корзина</h1>

        @if(count($products) > 0)
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            @foreach($products as $item)
                                @php
                                    $product = $item['product'];
                                    $quantity = $item['quantity'];
                                @endphp
                                <div class="row align-items-center mb-3 pb-3 border-bottom">
                                    <div class="col-4 col-md-2">
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                                class="img-fluid rounded">
                                        @else
                                            <img src="{{ asset('images/notfound.jpg') }}" alt="{{ $product->name }}"
                                                class="img-fluid rounded">
                                        @endif
                                    </div>
                                    <div class="col-8 col-md-4">
                                        <h5 class="mb-1">{{ $product->name }}</h5>

                                    </div>
                                    <div class="col-6 col-md-3 mt-2 mt-md-0">
                                        <form method="POST" action="{{ route('cart.update', $product) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group">
                                                <button class="btn btn-outline-secondary btn-sm" type="submit" name="change"
                                                    value="decrease">-</button>
                                                <input type="text" class="form-control text-center" name="quantity"
                                                    value="{{ $quantity }}" readonly>
                                                <button class="btn btn-outline-secondary btn-sm" type="submit" name="change"
                                                    value="increase">+</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-4 col-md-2 text-md-end mt-2 mt-md-0">
                                        <h5 class="mb-0">{{ number_format($product->price * $quantity, 0, ',', ' ') }} ₽</h5>
                                        @if($quantity > 1)
                                            <small class="text-muted">{{ number_format($product->price, 0, ',', ' ') }} ₽/шт</small>
                                        @endif
                                    </div>
                                    <div class="col-2 col-md-1 text-end mt-2 mt-md-0">
                                        <form method="POST" action="{{ route('cart.remove', $product) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" type="submit">×</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Итого</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Товары ({{ array_sum(array_column($products, 'quantity')) }})</span>
                                <span>{{ number_format($total, 0, ',', ' ') }} ₽</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                                <span>К оплате</span>
                                <span>{{ number_format($total, 0, ',', ' ') }} ₽</span>
                            </div>
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">Данные для заказа</h5>
                                    <form id="checkout-form" method="POST" action="{{ route('checkout') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="shipping_address" class="form-label">Адрес доставки</label>
                                            <input type="text" class="form-control" id="shipping_address"
                                                name="shipping_address" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Телефон</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="notes" class="form-label">Комментарий к заказу</label>
                                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2" id="checkout-btn">
                                Подтвердить заказ
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-2 py-2">Продолжить
                                покупки</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-cart-x" style="font-size: 3rem; color: #6c757d;"></i>
                </div>
                <h3 class="mb-3">Ваша корзина пуста</h3>
                <p class="text-muted mb-4">Добавьте товары из каталога, чтобы продолжить</p>
                <a href="{{ route('home') }}" class="btn btn-primary px-4">Перейти в каталог</a>
            </div>
        @endif
    </div>
@endsection