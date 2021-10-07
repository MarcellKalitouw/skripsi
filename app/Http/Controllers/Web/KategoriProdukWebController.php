<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\KategoriProduk;

class KategoriProdukWebController extends Controller
{
    
    public function index()
    {
        $data = DB::table('kategori_produk')->whereNull('deleted_at')->get();
        // $data = KategoriProduk::withTrashed()->get();
        // dd($data); 
        return view('adminView.kategori_produk.index', compact('data'));
    }

   
    public function create()
    {
        $pageTitle = 'Kategori Produk';

        return view('adminView.kategori_produk.create', compact('pageTitle'));
        // return view('adminView.kategori_produk.create', compact('pageTitle'));
        
    }

    
    public function store(Request $request)
    {
        // dd($request);
        $validate = $this->validate($request, [
            'nama' => 'required'
        ]);
        $input = $request->except(['_token']);
        // dd($input);
        $kategori_produk = KategoriProduk::create($input);
        
        return redirect()->route('kategori_produk.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $pageTitle = 'Kategori Produk';
        $getData = DB::table('kategori_produk')->where('id', $id)->first();
        return view('adminView.kategori_produk.edit', compact('getData','pageTitle'));
    }
    
    
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'nama' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        // dd($input);
        $kategori_produk = KategoriProduk::where('id',$id)->update($input);
        
        return redirect()->route('kategori_produk.index');
    }

    
    public function destroy($id)
    {
        // $old = DB::table('kategori_produk')->where('id', $id)->first();
        KategoriProduk::where('id',$id)->delete();

        return redirect()->route('kategori_produk.index');
    }
}