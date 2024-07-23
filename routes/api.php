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

    Route::apiResource('banks',BankController::class)->except(['destroy','show','update']);

    Route::apiResource('products',ProductsController::class)->except(['show']);

    Route::apiResource('sizes',SizeController::class)->except(['show']);

    Route::apiResource('company-raw-material',CompanyRawMaterialsController::class)->except(['show']);

    Route::apiResource('finish-goods',FinishGoodsController::class)->except(['show']);
    Route::get('/company-raw-material-calculation',[CompanyRawMaterialsController::class,'calculation'])->name('company-raw-material.calculation');
    Route::get('/finish-goods-calculation',[CompanyRawMaterialsController::class,'calculation'])->name('finish-goods.calculation');

});
