@extends('welcome')

@section('title', 'Авторизация')

@section('content')

    <div class="container mt-3">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form method="post" action="{{route('login.post')}}">
                    @csrf
                    <h2 class="text-center">Авторизация</h2>
                    <div class="mb-3">
                        <label class="form-label">Логин</label>
                        <input type="text" class="form-control" name="login" value="{{old('login')}}">
                        @error('login')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Пароль</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                    <p>Ещё не зарегистрированы? <a href="{{route('register')}}">Зарегистрироваться</a></p>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
