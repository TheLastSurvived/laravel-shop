@extends('layouts.index')

@section('title', 'Корзина')

@section('content')
    <h1>Корзина</h1>
   

   


        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center mb-3">
                            <div class="col-md-2">
                                <img src="{{ asset('images/velo.jpg') }}" alt="Товар" class="img-fluid">
                            </div>
                            <div class="col-md-4">
                                <h5>Название товара 1</h5>

                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="1">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <h5>2 500 ₽</h5>
                            </div>
                            <div class="col-md-1 text-end">
                                <button class="btn btn-outline-danger">×</button>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-2">
                                <img src="{{ asset('images/velo.jpg') }}" alt="Товар" class="img-fluid">
                            </div>
                            <div class="col-md-4">
                                <h5>Название товара 2</h5>

                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <button class="btn btn-outline-secondary" type="button">-</button>
                                    <input type="text" class="form-control text-center" value="2">
                                    <button class="btn btn-outline-secondary" type="button">+</button>
                                </div>
                            </div>
                            <div class="col-md-2 text-end">
                                <h5>1 800 ₽</h5>
                            </div>
                            <div class="col-md-1 text-end">
                                <button class="btn btn-outline-danger">×</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Итого</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Товары (3)</span>
                            <span>4 300 ₽</span>
                        </div>
                        
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>К оплате</span>
                            <span>4 300 ₽</span>
                        </div>
                        <button class="btn btn-primary w-100 mt-3 py-2">Оформить заказ</button>
                    </div>
                </div>
            </div>
        </div>
    
@endsection