<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $product = new Product();

        $products = $product->lastProducts();

        if (!empty($products)){
            return view('about', compact('products'));
        }
    }
}
