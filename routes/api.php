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
    AuthController,
    AlamatPenggunaController,
    RatingController,
    KurirController
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

//Kurir

    Route::PUT('kurir/updatePasswordKurir/{id}', [KurirController::class, 'updatePasswordKurir']);
    Route::POST('kurir/updateProfilePic/{id}', [KurirController::class, 'updateKurirProfilePicture']);



//Pelanggan Profile
    Route::GET("pelanggan/{id?}", [PelangganController::class, 'getData']); 
    Route::GET("pelanggan/{page?}/{limit?}", [PelangganController::class, 'getDataPageLimit']);
    Route::POST("pelanggan/", [PelangganController::class, 'store']);
    Route::POST('pelanggan/updateProfilePic/{id}', [PelangganController::class, 'storeGambar']);
    Route::PUT("pelanggan/", [PelangganController::class, 'update']);
    Route::DELETE("pelanggan/{id}", [PelangganController::class, 'destroy']);
    Route::PUT('pelanggan/updatePasswordPelanggan/{id}', [PelangganController::class, 'updatePasswordPelanggan']);


//Pengusaha
    Route::GET("pengusaha/{id?}", [PengusahaController::class, 'getData']); 
    Route::GET("pengusaha/{page?}/{limit?}", [PengusahaController::class, 'getDataPageLimit']);
    Route::POST("pengusaha/", [PengusahaController::class, 'store']);
    Route::PUT("pengusaha/", [PengusahaController::class, 'update']);
    Route::DELETE("pengusaha/{id}", [PengusahaController::class, 'destroy']);
    Route::GET("search-tenant/{page}/{limit}/{key}", [PengusahaController::class, 'searchPengusaha']);

//Produk
    Route::GET("produk/{id?}", [ProdukController::class, 'getData']); 
    Route::GET("produk/{page?}/{limit?}", [ProdukController::class, 'getDataPageLimit']);
    Route::POST("produk/", [ProdukController::class, 'store']);
    Route::PUT("produk/", [ProdukController::class, 'update']);
    Route::DELETE("produk/{id}", [ProdukController::class, 'destroy']);
    Route::get('produk_pengusaha/{idPengusaha}', [ProdukController::class, 'getProdukPengusaha']);

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
    Route::GET("transaksi/{id?}", [TransaksiController::class, 'getData']); 
    Route::GET("transaksi/{page?}/{limit?}", [TransaksiController::class, 'getDataPageLimit']);
    Route::POST("transaksi/", [TransaksiController::class, 'store']);
    Route::PUT("transaksi/", [TransaksiController::class, 'update']);
    Route::DELETE("transaksi/{id}", [TransaksiController::class, 'destroy']);

    Route::POST("transaksi/create/", [TransaksiController::class, 'createTransaksi']);
    
    Route::GET("history_transaksi/{page}/{limit}/{idPelanggan}", [TransaksiController::class, 'getRiwayatTransaksi']);
    Route::GET("current_transaksi/{idTransaksi}", [TransaksiController::class, 'getCurentTransaction']);
    Route::GET("qrcode_transaksi/{idTransaksi}", [TransaksiController::class, 'getQrCode']);

    Route::POST("update_transaksi/{id}",[TransaksiController::class, 'updateTransaksiByPelanggan']);

    //All Product Detail Transaksi
    Route::get('detail_transaksi/{idTransaksi}', [TransaksiController::class, 'detailTransaksi'])->name('detailTransaksi');
    Route::get('filter_transaksi/{page}/{limit}/{idPelanggan}/{filter}', [TransaksiController::class, 'filterTransaksiByStatus'])->name('filterTransaksi');


//Transaksi Kurir
    Route::GET("history_transaksi_kurir/{page}/{limit}/{idKurir}", [TransaksiController::class, 'getRiwayatTransaksiKurir']);
    Route::PUT("update_transaksi_kurir/{id}",[TransaksiController::class, 'updateTransaksiByKurir']);

//SatuanProduk
    Route::GET("status_produk/{id?}", [SatuanProdukController::class, 'getData']); 
    Route::GET("status_produk/{page?}/{limit?}", [SatuanProdukController::class, 'getDataPageLimit']);
    Route::POST("status_produk/", [SatuanProdukController::class, 'store']);
    Route::PUT("status_produk/", [SatuanProdukController::class, 'update']);
    Route::DELETE("status_produk/{id}", [SatuanProdukController::class, 'destroy']);

//Rating 
    Route::GET("rating/{id?}", [RatingController::class, 'getData']); 
    Route::GET("rating/{page?}/{limit?}", [RatingController::class, 'getDataPageLimit']);
    Route::POST("rating/", [RatingController::class, 'store']);
    Route::PUT("rating/", [RatingController::class, 'update']);
    Route::DELETE("rating/{id}", [RatingController::class, 'destroy']);

//Alamat
    Route::GET("alamat_pengguna/{id}", [AlamatPenggunaController::class, 'getData']); 
    Route::GET("alamat_pengguna/{id}/{page?}/{limit?}", [AlamatPenggunaController::class, 'getDataPageLimit']);
    Route::POST("alamat_pengguna/", [AlamatPenggunaController::class, 'store']);
    Route::PUT("alamat_pengguna/", [AlamatPenggunaController::class, 'update']);
    Route::DELETE("alamat_pengguna/{id}", [AlamatPenggunaController::class, 'destroy']);

    Route::post('logout_pelanggan', [AuthController::class, 'logout_pelanggan']);
    Route::post('logout_kurir', [AuthController::class, 'logout_kurir']);

});

    
//Login
Route::post('login', [AuthController::class, 'login']);
Route::post('login_kurir', [AuthController::class, 'login_kurir']);

//Register
Route::post('register',[PelangganController::class,'store']);

    