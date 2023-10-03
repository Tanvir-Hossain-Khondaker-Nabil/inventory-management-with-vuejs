<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense = Expense::get();
        return response()->json($expense);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'details' => 'required|min:3|max:900',
            'amount' => 'required|numeric',
            'expense_date' => 'required',
        ]);

        Expense::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expense = Expense::find($id);
        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Expense $expense)
    {
        $this->validate($request, [
            'details' => 'required|min:3|max:900',
            'amount' => 'required|numeric',
            'expense_date' => 'required',
        ]);

        $expense->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Expense $expense)
    {
         $expense->delete();
    }
}