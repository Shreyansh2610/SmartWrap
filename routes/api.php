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

    Route::resource('banks',BankController::class)->only(['index','store']);

    Route::resource('products',ProductsController::class)->only(['index','store','update','destroy']);

    Route::resource('sizes',SizeController::class)->only(['index','store','update','destroy']);

    Route::resource('company-raw-material',CompanyRawMaterialsController::class)->only(['index','store','update','destroy']);

    Route::resource('finish-goods',FinishGoodsController::class)->only(['index','store','update','destroy']);
    Route::get('/company-raw-material-calculation',[CompanyRawMaterialsController::class,'calculation'])->name('company-raw-material.calculation');
    Route::get('/finish-goods-calculation',[CompanyRawMaterialsController::class,'calculation'])->name('finish-goods.calculation');

});
