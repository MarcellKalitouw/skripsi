<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use DB;
class ProdukWebController extends Controller
{
    protected $pageTitle = 'Produk';
    
    public function index()
    {
        // $data = Produk::withTrashed()->get();
        $data = Db::table('produk')
                ->leftJoin('pengusaha','produk.id_pengusaha','pengusaha.id')
                ->leftJoin('kategori_produk','produk.id_kategori','kategori_produk.id')
                ->leftJoin('satuan_produk','produk.id_satuan','satuan_produk.id')
                ->whereNull('produk.deleted_at')
                ->select('produk.*', 
                            'kategori_produk.nama AS kategoriProduk',
                            'satuan_produk.nama AS satuanProduk',
                            'pengusaha.nama AS pengusaha'
                        )
                ->orderBy('created_at','desc')
                ->get();
        // dd($data);
        return view('adminView.produk.index', compact('data'));
    }

    
    public function create()
    {
        $pageTitle = $this->pageTitle;
        $getSatuanProduk = DB::table('satuan_produk')->get();
        $getKategoriProduk = DB::table('kategori_produk')->get();
        $getData = DB::table('produk')->get();
        $getPengusaha = DB::table('pengusaha')->get();

        return view('adminView.produk.create', compact('getPengusaha','getSatuanProduk', 'getKategoriProduk', 'getData', 'pageTitle'));

    }

    
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'id_pengusaha' => 'required',
            'id_satuan' => 'required',
            'id_kategori' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token']);
        // dd($input);
        $paket = Produk::create($input);
        
        return redirect()->route('produk.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        
        $getSatuanProduk = DB::table('satuan_produk')->get();
        $getKategoriProduk = DB::table('kategori_produk')->get();
        $getPengusaha = DB::table('pengusaha')->get();
        $getData = DB::table('produk')->where('id',$id)->first();

        return view('adminView.produk.edit', [
            'getPengusaha'=>$getPengusaha,
            'getKategoriProduk'=>$getKategoriProduk,
            'getSatuanProduk'=>$getSatuanProduk,
            'getData' =>$getData,
            'pageTitle' => $this->pageTitle
            ]);

    }

    
    public function update(Request $request, $id)
    {
       
        $validate = $this->validate($request, [
            'id_pengusaha' => 'required',
            'id_satuan' => 'required',
            'id_kategori' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        // dd($input);
        $paket = Produk::where('id', $id)->update($input);
        
        return redirect()->route('produk.index');   
    }

    
    public function destroy($id)
    {
        Produk::where('id', $id)->delete();
        return redirect()->route('produk.index');
    }
}