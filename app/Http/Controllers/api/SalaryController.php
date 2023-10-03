<?php

namespace App\Http\Controllers\api;

use App\Models\Salary;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function paid(Request $request,string $id)
    {
        $this->validate($request, [
            'salary_month' => 'required',
        ]);        
        
        $month = $request->salary_month;
        $check = Salary::where('employee_id',$id)->where('salary_month',$month)->first();

        if ($check) {
            return response()->json('Salary Already Created');
        }else{  
            $salary = array();
            $salary['employee_id'] = $id;
            $salary['amount'] =$request->salary;          
            $salary['salary_date'] = date('d/m/y');
            $salary['salary_month'] = $request->salary_month;
            $salary['salary_year'] = date('Y');

            Salary::create($salary);
        }        
        
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $view = Salary::with('employee')->where('salary_month',$id)->get();
        return response()->json($view);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $edit = Salary::with('employee')->where('salary_month',$id)->find($id);
        $edit = Salary::with('employee')->find($id);
        return response()->json($edit);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'salary_month' => 'required',
        ]);        
          
            $salary = array();
            $salary['employee_id'] = $request->employee_id;
            $salary['amount'] =$request->salary;
            $salary['salary_month'] = $request->salary_month;

            Salary::where('id',$id)->update($salary);
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}