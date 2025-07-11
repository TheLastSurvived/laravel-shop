@extends('layouts.index')

@section('title', 'Профиль')

@section('content')
    <h1>Профиль</h1>
    <div class="row">
        <div class="col-6">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="InputName1" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="InputName1" placeholder="Введите ваше имя" name="name"
                        required value="{{Auth::user()->name}}">
                </div>
                <div class="mb-3">
                    <label for="InputSurname1" class="form-label">Фамилия</label>
                    <input type="text" class="form-control" id="InputSurname1" placeholder="Введите вашу фамилию"
                        name="surname" required value="{{Auth::user()->surname}}">
                </div>
                <div class="mb-3">
                    <label for="InputEmail1" class="form-label">Email адрес</label>
                    <input type="email" class="form-control" id="InputEmail1" placeholder="Введите электронную почту"
                        name="email" required value="{{Auth::user()->email}}">
                </div>
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Введите пароль"
                        aria-describedby="passwordHelp" name="password">
                    <div id="passwordHelp" class="form-text">Не вводите пароль, если не хотите его менять</div>
                </div>
                <div class="mb-3">
                    <label for="floatingTextarea" class="form-label">Адрес доставки</label>
                    <textarea class="form-control" placeholder="Введите адрес доставки" id="floatingTextarea"
                        name="address">{{Auth::user()->address}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Изменить</button>
                @if(session('success'))
                    <div class="alert alert-success my-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger my-3">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>

        <div class="col-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Последние заказы</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>№ Заказа</th>

                                    <th>Дата</th>
                                    <th>Сумма</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>

                                    <td>10.07.2023</td>
                                    <td>2 500 ₽</td>

                                </tr>
                                <tr>
                                    <td>#12344</td>

                                    <td>08.07.2023</td>
                                    <td>1 800 ₽</td>
                                </tr>
                                <tr>
                                    <td>#12343</td>

                                    <td>05.07.2023</td>
                                    <td>3 200 ₽</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection