<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\SalaryController;
use App\Http\Controllers\api\ExpenseController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\CustomerController;
use App\Http\Controllers\api\EmployeeController;
use App\Http\Controllers\api\SupplierController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::apiResource('supplier',SupplierController::class);
Route::apiResource('category',CategoryController::class);
Route::apiResource('customer',CustomerController::class);
Route::apiResource('expense',ExpenseController::class);
Route::apiResource('employee',EmployeeController::class);
Route::apiResource('product',ProductController::class);
Route::post('/salary/paid/{id}',[SalaryController::class,'paid']);
Route::get('/salary/view/{id}',[SalaryController::class,'view']);
Route::get('/salary/edit/{id}',[SalaryController::class,'edit']);
Route::put('/salary/update/{id}',[SalaryController::class,'update']);
Route::get('/salary',[SalaryController::class,'index']);