<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('resources/css/bootstrap.css')}}">
    <script src="{{asset('resources/js/bootstrap.js')}}"></script>
    <title>@yield('title', 'Главная страница')</title>
</head>
<body>

@include('layouts.header')

@yield('content')

</body>
</html>
