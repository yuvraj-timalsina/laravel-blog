<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->get();
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create($request->validated());
        toastr()->success('Category Created Successfully!');
        return to_route('categories.index');
    }
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        toastr()->success('Category Updated Successfully!');
        return to_route('categories.index');
    }

    public function destroy(Category $category)
    {
        if ($category->posts->count()) {
            toastr()->warning('Category has ' . $category->posts->count() . ' posts!', 'Cannot Delete Category!');
            return back();
        }
        $category->delete();
        toastr()->error('Category Deleted Successfully!');
        return to_route('categories.index');
    }
}
