@extends('welcome')

@section('title', 'Заказы')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col"></div>
            <div class="col">

                @if(session('orderDeleteSuccess'))
                    <div class="alert alert-success alert-dismissible fade show mb-3 mt-3" role="alert" id="orderDeleteSuccess">
                        {{{session('orderDeleteSuccess')}}}
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                @endif

                <div class="accordion" id="accordionExample">
                    @foreach($orders as $order)
                        <div class="accordion-item mt-3">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapseOne">
                                    Заказ №{{$order->id}} (Статус: {{$order->status()}})
                                </button>
                            </h2>
                            <div id="collapse{{$order->id}}" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if($order->status_id == 3)
                                        <div class="alert alert-danger">
                                            {{$order->order_comment}}
                                        </div>
                                    @endif
                                    <table class="table mb-3">
                                        <thead class="text-center">
                                        <tr>
                                            <th>Количество</th>
                                            <th>Статус</th>
                                        </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            <tr>
                                                <td>{{$order->order_count}}</td>
                                                <td>{{$order->status()}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if($order->status_id == 1)
                                        <form action="{{route('order.remove', $order)}}" method="post">
                                            @csrf
                                            <button class="btn btn-danger mt-3" type="submit">Удалить заказ</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function (){
            setTimeout(function (){
                const alert = document.getElementById('orderDeleteSuccess');
                if(alert){
                    const btnClose = new bootstrap.Alert(alert);
                    btnClose.close();
                }
            }, 5000);
        })
    </script>

@endsection
