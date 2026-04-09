<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('resources/css/bootstrap.css')}}">
    <script src="{{asset('resources/js/bootstrap.js')}}"></script>
    <title>@yield('title', 'Панель администратора')</title>
</head>
<body>
@include('layouts.header')

<div class="container">
    <div class="row mt-5">
        <div class="col">
            <a href="{{route('admin.category')}}" class="btn btn-primary me-2">Категории</a>
            <a href="{{route('admin.product')}}" class="btn btn-primary me-2">Товары</a>
            <a href="{{route('admin.order')}}" class="btn btn-primary">Заказы</a>
        </div>
    </div>
</div>

@yield('content')
</body>
</html>
