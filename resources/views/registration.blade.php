@extends('layouts.index')

@section('title', 'Регистрация')

@section('content')

    <h1 class="text-center">{{ __('Регистрация') }}</h1>
    <form action="{{ route('registration') }}" method="POST" class="w-50 mx-auto">
        @csrf
        <div class="mb-3">
            <label for="InputName1" class="form-label">{{ __('Имя') }}</label>
            <input type="text" class="form-control" id="InputName1" placeholder="Введите ваше имя" name="name"
                value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="InputSurname1" class="form-label">{{ __('Фамилия') }}</label>
            <input type="text" class="form-control" id="InputSurname1" placeholder="Введите вашу фамилию" name="surname"
                required value="{{ old('surname') }}" autocomplete="surname">
            @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="InputEmail1" class="form-label">{{ __('E-Mail') }} адрес</label>
            <input type="email" class="form-control" id="InputEmail1" placeholder="Введите электронную почту" name="email"
                required value="{{ old('email') }}" autocomplete="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="InputPassword1" class="form-label">{{ __('Пароль') }}</label>
            <input type="password" class="form-control" id="InputPassword1" placeholder="Введите пароль"
                aria-describedby="passwordHelp" name="password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm" class="form-label">{{ __('Подтвердите пароль') }}</label>
            <input type="password" class="form-control" id="password-confirm" placeholder="Введите пароль"
                aria-describedby="passwordHelp" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Зарегистрироваться') }}</button>
    </form>
@endsection