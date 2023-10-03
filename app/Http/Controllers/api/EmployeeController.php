<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::get();
        return response()->json($employee);
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
            'salary' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
            'photo' => 'required',
            'nid' => 'required|numeric',
            'joining_date' => 'required',
        ]);
        $employee = $request->except(['photo']);

            $file = " ";

            if($file = $request->file('photo')){
                $imageName = time().'-employee'.'.'.$file->getClientOriginalExtension();
                $employee['photo'] = $file->move('upload/employee/',$imageName);
            }

        Employee::create($employee);
    }

    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $employee = Employee::find($id);
        return response()->json($employee);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'address' => 'required|min:3|max:255',
            'salary' => 'required|min:3|max:255',
            'phone' => 'required|numeric',
            'nid' => 'required|numeric',
            'joining_date' => 'required',
        ]);

        $employee_data = $request->except(['photo']);

        $file = " ";
        $deleteOldImage = $employee->photo;

        if($file = $request->file('photo')){
            if(file_exists($deleteOldImage)){
                unlink($deleteOldImage);
            }
            $imageName = time().'-employee'.'.'.$file->getClientOriginalExtension();
            $employee['photo'] = $file->move('upload/employee/',$imageName);
        }
        else{
            $employee_data['photo'] = $employee->photo;
        }

        $employee->update($employee_data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $deleteOldImage = $employee->photo;
        if(file_exists($deleteOldImage)){
            unlink($deleteOldImage);
        }

        $employee->delete();
    }
}