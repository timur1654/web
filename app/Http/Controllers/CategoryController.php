<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admins.categories.create', compact('categories'));
    }

    public function categoryCreate(StoreRequest $request)
    {
        Category::create($request->validated());

        return back();
    }

    public function edit(Category $category, UpdateRequest $request)
    {
        $data = $request->validated();

        $name = $category->name;

        $category->name = $request->input('name');

        $category->save();

        return back()->with(['edit_category' => $name, 'old_edit_category' => $category->name]);
    }

    public function delete(Category $category)
    {
        $name = $category->name;
        $category->delete();
        return back()->with(['delete_category' => $name]);
    }
}
