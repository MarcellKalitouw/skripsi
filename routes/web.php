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
    DashboardWebController,
    KurirWebController
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



//Produk
Route::middleware(['checkStatus'])->group(function () {
    Route::get('/', function () {
        return view('adminView.layout');
    })->name('dashboard.admin');
    Route::resource('kategori_produk', KategoriProdukWebController::class);

    Route::resource('satuan_produk', SatuanProdukWebController::class);
    Route::resource('paket', PaketWebController::class);
    Route::resource('produk', ProdukWebController::class);
    Route::resource('pengusaha', PengusahaWebController::class);

    //Transaksi
    Route::resource('shipping', ShippingWebController::class);
    Route::resource('transaksi', TransaksiWebController::class);
    Route::get('chooseProdukTransaksi/', [TransaksiWebController::class, 'pilihProdukTransaksi'])->name('transaksi.pilih-produk');
    
    Route::get('getDetailProduk/{id}', [TransaksiWebController::class, 'getDetailSelectedProduct'])->name('transaksi.detail-produk');
    Route::get('createPelanggan/', [TransaksiWebController::class, 'createPelanggan'])->name('transaksi.create-pelanggan');
    Route::post('createTransaski/', [TransaksiWebController::class, 'createIdTransaksi'])->name('transaksi.create-transaksi');
    Route::get('createTransaksiNormal/{idTransaksi}', [TransaksiWebController::class, 'createNormalTransaksi'])->name('transaksi.create-normal');
    Route::post('storeDetailTransaksi/{idTransaksi}', [TransaksiWebController::class, 'storeDetailTransaksi'])->name('transaksi.store-detailTransaksi');
    Route::delete('detailTransaksi/{id}', [TransaksiWebController::class, 'deleteDetailTransaksi'])->name('transaksi.delete-detailTransaksi');


    //Status
    Route::resource('status', StatusWebController::class);
    Route::resource('status_transaksi', StatusTransaksiWebController::class);

    //Pelanggan
    Route::resource('pelanggan', PelangganWebController::class);

    Route::resource('kurir', KurirWebController::class);

    //Dashboard
    Route::get('dashboard_pengusaha', [DashboardWebController::class, 'DashboardPengusaha'])->name('dashboard.pengusaha');

    //User : Pengusaha
    Route::get('edit-profile/pengusaha/{id}',[PengusahaWebController::class,'EditProfile'] )->name('pengusaha.edit-profil');
});

//Register
Route::get('list-transaksi', [TransaksiWebController::class, 'listTransaksi'])->name('transaksi.get-transaksi');
Route::get('detail-transaksi/{id}', [TransaksiWebController::class, 'detailTransaksi'])->name('transaksi.detail-transaksi');
Route::get('update-transaksi/{id}/{status}/{tipe}', [TransaksiWebController::class, 'updateStatusTransaksi'])->name('transaksi.update-status');
Route::resource('register', RegisterControllerWeb::class);
Route::resource('login', LoginControllerWeb::class);
Route::get('logout',[LoginControllerWeb::class,'logout'])->name('logout');