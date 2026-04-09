@extends('admins.admin')

@section('title', 'Товары')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="{{route('admin.product.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-center">Добавить товар</h2>
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        @error('name')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Страна поставщик</label>
                        <input type="text" class="form-control" name="country" value="{{old('country')}}">
                        @error('country')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Количество товаров</label>
                        <input type="number" class="form-control" name="count" value="{{old('count')}}">
                        @error('count')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Категория товаров</label>
                        <select name="category_id" class="form-select">
                            <option selected disabled>Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Цена</label>
                        <input type="number" class="form-control" name="price" value="{{old('price')}}">
                        @error('price')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Описание</label>
                        <textarea type="text" class="form-control" name="description" value="{{old('description')}}"></textarea>
                        @error('description')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Фото</label>
                        <input type="file" class="form-control" name="image" value="{{old('image')}}">
                        @error('image')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <button class="btn btn-primary">Создать товар</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col">

                @if(session()->has('store_product'))
                    <div class="alert alert-success">Вы успешно добавили товар {{session()->get('store_product')}}</div>
                @endif

                @if(session()->has('edit_product'))
                    <div class="alert alert-success">Вы успешно изменили товар {{session()->get('edit_product')}} на {{session()->get('old_edit_product')}}</div>
                @endif

                @if(session()->has('delete_product'))
                    <div class="alert alert-success">Вы успешно удалили товар {{session()->get('delete_product')}}</div>
                @endif

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Страна</th>
                        <th scope="col">Количество</th>
                        <th scope="col">Категория</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Фото</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Изменене</th>
                        <th scope="col">Удаление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->country}}</td>
                            <td>{{$product->count}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->price}}</td>
                            <td><img style="max-width: 100px; max-height: 100px" src="{{asset('public/storage/' . $product->image)}}"></td>
                            <td>{{$product->description}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$product->id}}">Изменить</button>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение товара {{$product->name}}</h1>
                                                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.product.edit', $product->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <h2 class="text-center">Добавить товар</h2>
                                                    <div class="mb-3">
                                                        <label class="form-label">Название</label>
                                                        <input type="text" class="form-control" name="name" value="{{$product->name}}">
                                                        @error('name')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Страна поставщик</label>
                                                        <input type="text" class="form-control" name="country" value="{{$product->country}}">
                                                        @error('country')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Количество товаров</label>
                                                        <input type="number" class="form-control" name="count" value="{{$product->count}}">
                                                        @error('count')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Категория товаров</label>
                                                        <select name="category_id" class="form-select">
                                                            <option selected value="{{$product->category_id}}">{{$product->category->name}}</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Цена</label>
                                                        <input type="text" class="form-control" name="price" value="{{$product->price}}">
                                                        @error('price')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Описание</label>
                                                        <textarea type="text" class="form-control" name="description">{{$product->description}}</textarea>
                                                        @error('description')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <p class="form-label">Активное фото</p>
                                                       <div class="text-center">
                                                           <img style="max-width: 300px" src="{{asset('public/storage/' . $product->image)}}" alt="активное фото товара">
                                                       </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Фото</label>
                                                        <input type="file" class="form-control" name="image" value="{{old('image')}}">
                                                        @error('image')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <button class="btn btn-primary">Изменить товар</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$product->id}}">Удалить</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Удаление товара {{$product->name}}</h1>
                                                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Удаление товара {{$product->name}} приведёт к удалению всех связанных с ним заказов
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                                                <form action="{{route('admin.product.delete', $product->id)}}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>
@endsection
