<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\{
    KategoriProdukWebController,
    SatuanProdukWebController,
    PaketWebController,
    ProdukWebController,
    PengusahaWebController,
    ShippingWebController,
    TransaksiWebController,
    StatusWebController,
    PelangganWebController,
    StatusTransaksiWebController,
    RegisterControllerWeb,
    LoginControllerWeb,
    DashboardWebController
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
})->name('dashboard.admin');

//Produk
Route::middleware(['checkStatus'])->group(function () {
    
    Route::resource('kategori_produk', KategoriProdukWebController::class);

    Route::resource('satuan_produk', SatuanProdukWebController::class);
    Route::resource('paket', PaketWebController::class);
    Route::resource('produk', ProdukWebController::class);
    Route::resource('pengusaha', PengusahaWebController::class);

    //Transaksi
    Route::resource('shipping', ShippingWebController::class);
    Route::resource('transaksi', TransaksiWebController::class);

    //Status
    Route::resource('status', StatusWebController::class);
    Route::resource('status_transaksi', StatusTransaksiWebController::class);

    //Pelanggan
    Route::resource('pelanggan', PelangganWebController::class);

    //Dashboard
    Route::get('dashboard_pengusaha', [DashboardWebController::class, 'DashboardPengusaha'])->name('dashboard.pengusaha');

    //User : Pengusaha
    Route::get('edit-profile/pengusaha/{id}',[PengusahaWebController::class,'EditProfile'] )->name('pengusaha.edit-profil');
});

//Register
Route::resource('register', RegisterControllerWeb::class);
Route::resource('login', LoginControllerWeb::class);
Route::get('logout',[LoginControllerWeb::class,'logout'])->name('logout');