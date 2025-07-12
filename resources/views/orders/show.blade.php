@extends('layouts.index')

@section('title', 'Детали заказа #' . $order->id)

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{ route('profile.edit') }}">Профиль</a></li>
                <li class="breadcrumb-item active" aria-current="page">Заказ #{{ $order->id }}</li>
            </ol>
        </nav>

        <div class="card mb-4">
            <div class="card-header">
                <h4>Детали заказа #{{ $order->id }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Информация о заказе</h5>
                        <p><strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}</p>
                      
                           
                        </p>
                        <p><strong>Сумма:</strong> {{ number_format($order->total_amount, 0, ',', ' ') }} ₽</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Доставка</h5>
                        <p><strong>Адрес:</strong> {{ $order->shipping_address }}</p>
                        <p><strong>Телефон:</strong> {{ $order->phone }}</p>
                        <p><strong>Комментарий:</strong> {{ $order->notes ?? 'Нет комментария' }}</p>
                    </div>
                </div>

                <h5 class="mb-3">Товары</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Итого</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($item->product->image)
                                                <img src="{{ asset('storage/' . $item->product->image) }}"
                                                    class="img-thumbnail me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('images/notfound.jpg') }}" alt="{{ $item->product->name }}"
                                                    class="img-thumbnail me-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @endif

                                            <div>
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                <small class="text-muted">Артикул: {{ $item->product->sku }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ number_format($item->price, 0, ',', ' ') }} ₽</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} ₽</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

             
            </div>
        </div>
    </div>
@endsection