<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\StoreRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admins.products.create', compact('products', 'categories'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $photo = $request->file('image')->store('public');

        $data['photo'] = explode('/', $photo)[1];

        $requests = [
            'name' => $data['name'],
            'country' => $data['country'],
            'category_id' => $data['category_id'],
            'image' => $data['photo'],
            'count' => $data['count'],
            'price' => $data['price'],
            'description' => $data['description'],
        ];

        Product::create($requests);

        return back()->with(['store_product' => $data['name']]);
    }

    public function edit(UpdateRequest $request, Product $product)
    {
        $request->validated();

        $old_edit_product = $product->name;

        if ($request->image){
            $product->name = explode('/', $request->file('image')->store('public'))[1];
        }

        $product->name = $request->input('name');
        $product->country = $request->input('country');
        $product->category_id = $request->input('category_id');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->count = $request->input('count');
        $product->save();

        return back()->with(['edit_product' => $product->name, 'old_edit_product' => $old_edit_product]);
    }

    public function delete(Product $product)
    {
        $name = $product->name;
        $product->delete();
        return back()->with(['delete_product' => $name]);
    }
}
