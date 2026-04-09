@extends('admins.admin')

@section('title', 'Категории')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <form action="{{route('admin.category.create')}}" method="post">
                    @csrf
                    <h2 class="text-center">Добавить категорию</h2>
                    <div class="mb-3">
                        <label class="form-label">Название</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                        @error('name')<p class="text-danger">{{$message}}</p>@enderror
                    </div>
                    <button class="btn btn-primary">Создать категорию</button>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <div class="row mt-5">
            <div class="col"></div>
            <div class="col">

                @if(session()->has('edit_category'))
                    <div class="alert alert-success">Вы успешно изменили категорию {{session()->get('edit_category')}} на {{session()->get('old_edit_category')}}</div>
                @endif

                @if(session()->has('delete_category'))
                    <div class="alert alert-success">Вы успешно удалили категорию {{session()->get('delete_category')}}</div>
                @endif

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Изменение</th>
                        <th scope="col">Удаление</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{$category->id}}">Изменить</button>

                                <!-- Modal -->
                                <div class="modal fade" id="editModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение категории {{$category->name}}</h1>
                                                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('admin.category.edit', $category->id)}}" method="post">
                                                    @csrf
                                                    <h2 class="text-center">Изменить категорию</h2>
                                                    <div class="mb-3">
                                                        <label class="form-label">Название</label>
                                                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                                                        @error('name')<p class="text-danger">{{$message}}</p>@enderror
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Изменить</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$category->id}}">Удалить</button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Удаление категории {{$category->name}}</h1>
                                                <button type="submit" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                               Удаление категории {{$category->name}} приведёт к удалению всех связанных с ней товарами, заказами
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                                                <form action="{{route('admin.category.delete', $category->id)}}" method="post">
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
