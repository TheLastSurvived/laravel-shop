<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">BikeShop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">О нас</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center justify-content-between">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Профиль</a>
                        <a href="{{ route('cart') }}" class="btn btn-warning mx-2">Корзина</a>
                        <form action="{{ route('logout') }}" method="post" class="d-inline-flex">
                            @csrf
                            <button class="btn btn-danger" type="submit">Выйти</button>
                        </form>

                    @endauth

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-primary mx-2">Вход</a>
                        <a href="{{ route('registration') }}" class="btn btn-warning">Регистрация</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-body-secondary">Главная</a>
                </li>
                <li class="nav-item"><a href="{{ route('about') }}" class="nav-link px-2 text-body-secondary">О нас</a>
                </li>
            </ul>
            <p class="text-center text-body-secondary">© 2025 BikeShop, Inc</p>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>