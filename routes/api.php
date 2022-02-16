<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    KategoriProdukController,
    PaketController,
    PelangganController,
    PengusahaController,
    ProdukController,
    ShippingController,
    StatusController,
    TransaksiController,
    StatusTransaksiController,
    SatuanProdukController,
    AuthController
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });






Route::group(['middleware' => 'auth:sanctum'], function(){
//Kategori produk
    Route::GET("kategori_produk/{id?}", [KategoriProdukController::class, 'getData']); 
    Route::GET("kategori_produk/{page?}/{limit?}", [KategoriProdukController::class, 'getDataPageLimit']);
    Route::POST("kategori_produk/", [KategoriProdukController::class, 'store']);
    Route::PUT("kategori_produk/", [KategoriProdukController::class, 'update']);
    Route::DELETE("kategori_produk/{id}", [KategoriProdukController::class, 'destroy']);

    //Paket
    Route::GET("paket/{id?}", [PaketController::class, 'getData']); 
    Route::GET("paket/{page?}/{limit?}", [PaketController::class, 'getDataPageLimit']);
    Route::POST("paket/", [PaketController::class, 'store']);
    Route::PUT("paket/", [PaketController::class, 'update']);
    Route::DELETE("paket/{id}", [PaketController::class, 'destroy']);

//Pelanggan
    Route::GET("pelanggan/{id?}", [PelangganController::class, 'getData']); 
    Route::GET("pelanggan/{page?}/{limit?}", [PelangganController::class, 'getDataPageLimit']);
    Route::POST("pelanggan/", [PelangganController::class, 'store']);
    Route::POST('pelanggan/updateProfilePic/{id}', [PelangganController::class, 'storeGambar']);
    Route::PUT("pelanggan/", [PelangganController::class, 'update']);
    Route::DELETE("pelanggan/{id}", [PelangganController::class, 'destroy']);


//Pengusaha
    Route::GET("pengusaha/{id?}", [PengusahaController::class, 'getData']); 
    Route::GET("pengusaha/{page?}/{limit?}", [PengusahaController::class, 'getDataPageLimit']);
    Route::POST("pengusaha/", [PengusahaController::class, 'store']);
    Route::PUT("pengusaha/", [PengusahaController::class, 'update']);
    Route::DELETE("pengusaha/{id}", [PengusahaController::class, 'destroy']);

//Produk
    Route::GET("produk/{id?}", [ProdukController::class, 'getData']); 
    Route::GET("produk/{page?}/{limit?}", [ProdukController::class, 'getDataPageLimit']);
    Route::POST("produk/", [ProdukController::class, 'store']);
    Route::PUT("produk/", [ProdukController::class, 'update']);
    Route::DELETE("produk/{id}", [ProdukController::class, 'destroy']);

//Shipping
    Route::GET("shipping/{id?}", [ShippingController::class, 'getData']); 
    Route::GET("shipping/{page?}/{limit?}", [ShippingController::class, 'getDataPageLimit']);
    Route::POST("shipping/", [ShippingController::class, 'store']);
    Route::PUT("shipping/", [ShippingController::class, 'update']);
    Route::DELETE("shipping/{id}", [ShippingController::class, 'destroy']);

//Status
    Route::GET("status/{id?}", [StatusController::class, 'getData']); 
    Route::GET("status/{page?}/{limit?}", [StatusController::class, 'getDataPageLimit']);
    Route::POST("status/", [StatusController::class, 'store']);
    Route::PUT("status/", [StatusController::class, 'update']);
    Route::DELETE("status/{id}", [StatusController::class, 'destroy']);

//TransaksiController
    Route::GET("transaksi_controller/{id?}", [TransaksiController::class, 'getData']); 
    Route::GET("transaksi_controller/{page?}/{limit?}", [TransaksiController::class, 'getDataPageLimit']);
    Route::POST("transaksi_controller/", [TransaksiController::class, 'store']);
    Route::PUT("transaksi_controller/", [TransaksiController::class, 'update']);
    Route::DELETE("transaksi_controller/{id}", [TransaksiController::class, 'destroy']);

//SatuanProduk
    Route::GET("status_produk/{id?}", [SatuanProdukController::class, 'getData']); 
    Route::GET("status_produk/{page?}/{limit?}", [SatuanProdukController::class, 'getDataPageLimit']);
    Route::POST("status_produk/", [SatuanProdukController::class, 'store']);
    Route::PUT("status_produk/", [SatuanProdukController::class, 'update']);
    Route::DELETE("status_produk/{id}", [SatuanProdukController::class, 'destroy']);
});

    
//Login
Route::post('login', [AuthController::class, 'login']);

    