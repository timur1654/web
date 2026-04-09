<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-success" href="/">Copy Star</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{route('home')}}">Главная</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{route('catalog')}}">Каталог</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{route('about')}}">О нас</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="{{route('find')}}">Где нас найти?</a>
                </li>
            </ul>
            <div class="d-flex">
                @if(session('user_id'))
                    @php
                        $user = \App\Models\User::find(session('user_id'))
                    @endphp
                    @if($user->isAdmin === 1)
                        <a href="{{route('admin')}}" class="btn btn-outline-primary me-2">Панель админа</a>
                        <a href="{{route('logout')}}" class="btn btn-danger">Выйти</a>
                    @else
                    <a href="{{route('basket')}}" class="btn btn-outline-primary me-2">Корзина</a>
                    <a href="{{route('orders')}}" class="btn btn-outline-primary me-2">Заказы</a>
                    <a href="{{route('logout')}}" class="btn btn-danger">Выйти</a>
                    @endif
                @else
                    <a href="{{route('login')}}" class="btn btn-outline-success me-2">Войти</a>
                    <a href="{{route('register')}}" class="btn btn-success">Регистрация</a>
                @endif
            </div>
        </div>
    </div>
</nav>

@yield('header')
