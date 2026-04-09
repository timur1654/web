@extends('welcome')

@section('title', 'Каталог')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                @if(session('basket_add_success'))
                    <div class="alert alert-success alert-dismissible" role="alert" id="basket_add_success">
                        {{session('basket_add_success')}}
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                @endif

                <form action="" method="get" class="d-flex gap-4">
                    <select class="form-select" name="sort_price" id="">
                        <option value="asc" {{request('sort_price') == 'asc' ? 'selected' : '' }}>По возрастанию цены</option>
                        <option value="desc" {{request('sort_price') == 'desc' ? 'selected' : '' }}>По убыванию цены</option>
                    </select>

                    <select class="form-select" name="sort_name" id="">
                        <option value="asc" {{request('sort_name') == 'asc' ? 'selected' : '' }}>По названию(А-Я)</option>
                        <option value="desc" {{request('sort_name') == 'desc' ? 'selected' : '' }}>По названию(Я-А)</option>
                    </select>

                    <select class="form-select" name="sort_country" id="">
                        <option value="asc" {{request('sort_country') == 'asc' ? 'selected' : '' }}>По стране(А-Я)</option>
                        <option value="desc" {{request('sort_country') == 'desc' ? 'selected' : '' }}>По стране(Я-А)</option>
                    </select>

                    <select class="form-select" name="category" id="">
                        <option value="">Все категории</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{request('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-primary">Применить</button>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-12 d-flex flex-wrap justify-content-center gap-4">

                @foreach($products as $product)
                    <div class="card" style="width: 18rem;">
                        <a href="{{route('catalog.product.show', $product->id)}}">
                            <img src="{{asset('public/storage/' . $product->image)}}" height="200px" style="object-fit: cover; object-position: center" class="card-img-top" alt="фото товара">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">{{$product->description}}</p>
                            <h6 class="card-text">{{$product->price}}</h6>
                            @if(session('user_id'))
                                <form action="{{route('basket.add', $product)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">В корзину</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col"></div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function (){
            setTimeout(function (){
                const alert = document.getElementById('basket_add_success');
                if(alert){
                    const btnClose = new bootstrap.Alert(alert);
                    btnClose.close();
                }
            }, 5000)
        })
    </script>

@endsection
