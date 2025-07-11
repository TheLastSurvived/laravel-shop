@extends('layouts.index')

@section('title', 'Вход')

@section('content')

    <h1 class="text-center">Вход</h1>
    <form action="{{ route('login') }}" method="POST" class="w-50 mx-auto">
        @csrf
        <div class="mb-3">
            <label for="InputEmail1" class="form-label">Email адрес</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail1" placeholder="Введите электронную почту" name="email"
                required value="{{ old('email') }}" autofocus autocomplete="email">
        </div>
        <div class="mb-3">
            <label for="InputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="InputPassword1" placeholder="Введите пароль"
                aria-describedby="passwordHelp" name="password">
        </div>
        @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
        <button type="submit" class="btn btn-primary">Войти</button>
    </form>


@endsection