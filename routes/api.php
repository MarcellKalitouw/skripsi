<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    KategoriProdukController
};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//KategoriProduk
    Route::GET("kategori_produk/{id?}", [KategoriProdukController::class, 'getData']); 
    Route::GET("kategori_produk/{page?}/{limit?}", [KategoriProdukController::class, 'getDataPageLimit']);
    Route::POST("kategori_produk/", [KategoriProdukController::class, 'store']);
    Route::PUT("kategori_produk/", [KategoriProdukController::class, 'update']);
    Route::DELETE("kategori_produk/{id}", [KategoriProdukController::class, 'destroy']);