<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Basket_item;
use App\Models\Product;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index()
    {
        $basket = Basket::where('user_id', session('user_id'))->first();

        $products = [];

        $basketSum = 0;

        if ($basket){
            $basketItems = Basket_item::where('basket_id', $basket->id)->get();
            foreach ($basketItems as $basketItem){
                $product = Product::find($basketItem->product_id);
                if ($product){
                    $product->count = $basketItem->count;
                    $product->sumPrice = $product->price * $product->count;
                    $basketSum+=$product->sumPrice;
                    $products[]=$product;
                }
            }
        }

        return view('users.basket', compact('products', 'basketSum'));
    }

    public function basketAdd()
    {
        $basket = new Basket();
        $basket->user_id = session('user_id');
        $basket->save();

        return $basket;
    }

    public function itemAdd(Product $product, Request $request)
    {
        $basket = Basket::where('user_id', session('user_id'))->first();

        if (!$basket){
            $basket = $this->basketAdd();
        }

        $basketItem = Basket_item::firstOrNew([
            'basket_id' => $basket->id,
            'product_id' => $product->id
        ]);

        if (!$basketItem->exists){
           $basketItem->save();
        }
        else{
            if ($basketItem->count >= $product->count){
                return back()->with(['errorCount' => true]);
            } else{
                $basketItem->count++;
                $basketItem->save();
            }
        }
        $referer = $request->header('referer');
        if ($referer == route('catalog')){
            return back()->with(['basket_add_success' => 'Вы успешно добавили товар в корзину']);
        }
        elseif($referer == route('catalog.product.show', $product)){
            return redirect()->route('basket')->with(['basket_add_success' => 'Вы успешно добавили товар в корзину']);
        }
        elseif ($referer == route('basket')){
            return redirect()->route('basket')->with(['basket_add_success' => 'Вы успешно добавили товар в корзину']);
        }

    }

    public function itemRemove(Product $product)
    {
        $basket = Basket::where('user_id', session('user_id'))->first();

        $basketItem = Basket_item::where('basket_id', $basket->id)
            ->where('product_id', $product->id)
            ->first();

        if ($basketItem){
            if($basketItem->count > 1){
                $basketItem->count--;
                $basketItem->save();
            }else{
                $basketItem->delete();
            }
        }

        return back();
    }


}
