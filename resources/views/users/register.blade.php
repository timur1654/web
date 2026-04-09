@extends('welcome')

@section('title', 'Регистрация')

@section('content')

    <div class="container mt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form method="post" action="{{route('register.post')}}">
                    @csrf
                    <h2 class="text-center">Регистрация</h2>
                    <div class="mb-3">
                        <label class="form-label">Имя</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        @error('name')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Фамилия</label>
                        <input type="text" class="form-control" name="surname" value="{{old('surname')}}">
                        @error('surname')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Отчество (необязательно)</label>
                        <input type="text" class="form-control" name="patronymic" value="{{old('patronymic')}}">
                        @error('patronymic')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" class="form-control" name="login" value="{{old('login')}}">
                        @error('login')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Почта</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        @error('email')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Подтверждение пароля</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Согласие с правилами</label>
                        <input type="checkbox" class="form-check" name="rules" required>
                        @error('rules')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    <p>Уже зарегистрированы? <a href="{{route('login')}}">Войти</a></p>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
