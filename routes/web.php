<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    KategoriProdukWebController,
    SatuanProdukWebController,
    PaketWebController,
    ProdukWebController,
    PengusahaWebController,
    ShippingWebController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('adminView.layout');
});

//Produk
Route::resource('kategori_produk', KategoriProdukWebController::class);
Route::resource('satuan_produk', SatuanProdukWebController::class);
Route::resource('paket', PaketWebController::class);
Route::resource('produk', ProdukWebController::class);
Route::resource('pengusaha', PengusahaWebController::class);

//Transaksi
Route::resource('shipping', ShippingWebController::class);