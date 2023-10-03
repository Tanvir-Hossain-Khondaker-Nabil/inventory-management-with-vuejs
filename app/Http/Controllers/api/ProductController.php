<?php

namespace App\Http\Controllers\api;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('category','supplier')->get();
        return response()->json($product);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|min:3|max:255',
            'root' => 'required',
            'product_code' => 'required|numeric',
            'buying_price' => 'required|max:255',
            'selling_price' => 'required|max:255',
            'product_quantity' => 'required|max:255',
            'buying_date' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);
        $product = $request->except(['photo']);

            $file = " ";

            if($file = $request->file('photo')){
                $imageName = time().'-product'.'.'.$file->getClientOriginalExtension();
                $product['photo'] = $file->move('upload/product/',$imageName);
            }

        Product::create($product);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       $product->load(['category','supplier']);
       return response()->json($product);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'product_name' => 'required|min:3|max:255',
            'root' => 'required',
            'product_code' => 'required|numeric',
            'buying_price' => 'required|max:255',
            'selling_price' => 'required|max:255',
            'product_quantity' => 'required|max:255',
            'buying_date' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
        ]);

        $product_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $product->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName = time().'-product'.'.'.$file->getClientOriginalExtension();
            $product['photo'] = $file->move('upload/product/',$imageName);
        }
        else{
            $product_data['photo'] = $product->photo;
        }

        $product->update($product_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $deleteOldImage = $product->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $product->delete();
    }
}