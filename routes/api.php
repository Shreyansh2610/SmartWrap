<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CompanyRawMaterialsController;
use App\Http\Controllers\FinishGoodsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SizeController;
use App\Models\CompanyRawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;

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
Route::get('/login',function() {
    return response()->json(['type'=>'Unauthenticated'],404);
})->name('login');

Route::post('/login',[LoginRegisterController::class, 'login']);
Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);

    Route::get('/company-profile-get', [CompanyProfileController::class,'show']);

    Route::put('/company-profile', [CompanyProfileController::class,'update']);

    // Route::apiResource('banks',BankController::class)->except(['destroy','show','update']);
    Route::get('/banks-get',[BankController::class,'index']);
    Route::post('/banks',[BankController::class,'store']);

    // Route::apiResource('products',ProductsController::class)->except(['show']);
    Route::get('/products-get',[ProductsController::class,'index']);
    Route::post('/products',[ProductsController::class,'store']);
    Route::put('/products/{id}',[ProductsController::class,'update']);
    Route::delete('/products/{id}',[ProductsController::class,'destroy']);


    // Route::apiResource('sizes',SizeController::class)->except(['show']);
    Route::get('/sizes-get',[SizeController::class,'index']);
    Route::post('/sizes',[SizeController::class,'store']);
    Route::put('/sizes/{id}',[SizeController::class,'update']);
    Route::delete('/sizes/{id}',[SizeController::class,'destroy']);

    // Route::apiResource('company-raw-material',CompanyRawMaterialsController::class)->except(['show']);
    Route::get('/company-raw-material-get',[CompanyRawMaterialsController::class,'index']);
    Route::post('/company-raw-material',[CompanyRawMaterialsController::class,'store']);
    Route::put('/company-raw-material/{id}',[CompanyRawMaterialsController::class,'update']);
    Route::delete('/company-raw-material/{id}',[CompanyRawMaterialsController::class,'destroy']);

    Route::apiResource('finish-goods',FinishGoodsController::class)->except(['show']);
    Route::get('/finish-goods-get',[FinishGoodsController::class,'index']);
    Route::post('/finish-goods',[FinishGoodsController::class,'store']);
    Route::put('/finish-goods/{id}',[FinishGoodsController::class,'update']);
    Route::delete('/finish-goods/{id}',[FinishGoodsController::class,'destroy']);

    Route::get('/company-raw-material-calculation',[CompanyRawMaterialsController::class,'calculation'])->name('company-raw-material.calculation');
    Route::get('/finish-goods-calculation',[CompanyRawMaterialsController::class,'calculation'])->name('finish-goods.calculation');

});
