<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::get();
        return response()->json($supplier);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255',
            'shopname' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
            'photo' => 'required',
        ]);
        $supplier = $request->except(['photo']);

            $file = " ";

            if($file = $request->file('photo')){
                $imageName = time().'-supplier'.'.'.$file->getClientOriginalExtension();
                $supplier['photo'] = $file->move('upload/supplier/',$imageName);
            }

        Supplier::create($supplier);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $supplier = Supplier::find($id);
        return response()->json($supplier);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255',
            'shopname' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
        ]);

        $supplier_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $supplier->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName = time().'-supplier'.'.'.$file->getClientOriginalExtension();
            $supplier['photo'] = $file->move('upload/supplier/',$imageName);
        }
        else{
            $supplier_data['photo'] = $supplier->photo;
        }

        $supplier->update($supplier_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $deleteOldImage = $supplier->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $supplier->delete();
    }
}