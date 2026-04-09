<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status_id');

        $orders = Order::when($status, function ($query, $status){
            return $query->where('status_id', $status);
        })
            ->with('user')
            ->get();
        return view('admins.adminorder', compact('orders'));
    }

    public function changeStatusOrder(Request $request, $orderId, $action)
    {
        $order = Order::findOrFail($orderId);
        if ($order->status_id == 1){
            if ($action == 'cancel'){
                $order->status_id = 3;
                $order->order_comment = $request->input('order_comment');
            }
            elseif($action == 'confirm'){
                $order->status_id = 2;
            }
            $order->save();
            $message = ($action == 'cancel') ? 'отменен' : 'подтвержден';
            return redirect()->route('admin.order')->with('success', "Заказ успешно $message");
        }
    }
}
