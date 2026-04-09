@extends('welcome')

@section('title', "$product->name")

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card">
                    <img src="{{asset('public/storage/' . $product->image)}}" height="400px" width="500px" style="object-fit: cover; object-position: center" class="card-img-top" alt="фото товара">

                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">Описание: {{$product->description}}</p>
                        <p class="card-text">Страна: {{$product->country}}</p>
                        <p class="card-text">Категория: {{$product->category->name}}</p>
                        <p class="card-text">Количество: {{$product->count}}</p>
                        <h6 class="card-text">Цена: {{$product->price}} руб.</h6>
                        @if(session('user_id'))
                            <form action="{{route('basket.add', $product)}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary mt-2">В корзину</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
