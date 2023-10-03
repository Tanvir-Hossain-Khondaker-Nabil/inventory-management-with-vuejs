<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::get();
        return response()->json($customer);
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
            'phone' => 'required|numeric',
            'photo' => 'required',
        ]);
        $customer = $request->except(['photo']);

            $file = " ";

            if($file = $request->file('photo')){
                $imageName = time().'-customer'.'.'.$file->getClientOriginalExtension();
                $customer['photo'] = $file->move('upload/customer/',$imageName);
            }

        Customer::create($customer);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $customer = Customer::find($id);
        return response()->json($customer);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
        ]);

        $customer_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $customer->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName = time().'-customer'.'.'.$file->getClientOriginalExtension();
            $customer['photo'] = $file->move('upload/customer/',$imageName);
        }
        else{
            $customer_data['photo'] = $customer->photo;
        }

        $customer->update($customer_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $deleteOldImage = $customer->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $customer->delete();
    }
}