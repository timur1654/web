@extends('welcome')

@section('title', 'О нас')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div id="carouselExampleCaptions" class="carousel slide">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        @if($products)
                            @foreach($products as $key => $product)
                                <div class="carousel-item @if($key === 0) active @endif">
                                    <img src="{{asset('public/storage/' . $product->image)}}" class="d-block w-100" alt="фото товара">
                                    <div class="carousel-caption d-none d-md-block m-auto">
                                        <h5 style="background: #5c636a">{{$product->name}}</h5>
                                        <p style="background: #5c636a">{{$product->price}}</p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
