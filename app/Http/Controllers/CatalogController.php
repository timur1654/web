<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $orderByPrice = $request->query('sort_price', 'asc');

        $orderByName = $request->query('sort_name', 'asc');

        $orderByCountry = $request->query('sort_country', 'asc');

        $categoryId = $request->query('category', '');

        $productQuery = Product::where('count', '>', 0);

        if ($categoryId){
            $productQuery->where('category_id', $categoryId);
        }
        $productQuery->orderBy('price', $orderByPrice)
            ->orderBy('name', $orderByName)
            ->orderBy('country', $orderByCountry);

        $products = $productQuery->get();

        $categories = Category::all();
        return view('catalog', compact('categories', 'products'));
    }

    public function show(Product $product)
    {
        return view('product_item', compact('product'));
    }
}
