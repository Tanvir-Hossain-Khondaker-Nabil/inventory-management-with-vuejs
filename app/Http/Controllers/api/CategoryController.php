<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::get();
        return response()->json($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required|min:3|max:255',
        ]);

        Category::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Category $category)
    {
        $this->validate($request, [
            'category_name' => 'required|min:3|max:255',
        ]);

        $category->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Category $category)
    {
         $category->delete();
    }
}