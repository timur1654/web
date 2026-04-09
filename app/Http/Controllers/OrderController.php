<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    public function orderCreate(Request $request)
    {
        $user = User::find(session('user_id'));

        $totalCount = 0;

        $basket = Basket::where('user_id', $user->id)->first();

        foreach ($basket->basketItems as $item){
            $totalCount += $item->count;
        }

        Order::create([
           'order_count' => $totalCount,
           'status_id' => 1,
           'user_id' => $user->id,
           'order_comment' => '',
        ]);

        return redirect()->route('orders')->with(['orderCreateSuccess' => true]);

    }

    public function index()
    {
        $user = User::find(session('user_id'));

        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return view('users.order', compact('orders'));
    }

    public function orderRemove(Order $order)
    {
        if ($order->status_id == 1){
            $order->delete();
            return redirect()->route('orders')->with('orderDeleteSuccess', 'Вы успешно удалили заказ');
        }
    }
}
