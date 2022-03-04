<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
    
use Illuminate\Http\Request;
use DB;
use App\Models\SatuanProduk;
use App\Models\Pengusaha;

class SatuanProdukWebController extends Controller
{
    protected $pageTitle = 'Satuan Produk';
    public function index()
    {
        // $data = DB::table('satuan_produk')->get();
        $data = SatuanProduk::withTrashed()->get();
        return view('adminView.satuan_produk.index', compact('data'));
    }

    
    public function create()
    {
        $pageTitle = $this->pageTitle;
        $getPengusaha = DB::table('pengusaha')->get();

        return view('adminView.satuan_produk.create', compact('pageTitle','getPengusaha'));
    }

    
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'id_pengusaha' => 'required'
        ]);
        $input = $request->except(['_token']);
        // dd($input);
        $satuan_produk = SatuanProduk::create($input);
        
        return redirect()->route('satuan_produk.index');
    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $getData = DB::table('satuan_produk')->where('id', $id)->first();
        $pageTitle = $this->pageTitle;
        // dd($pageTitle);

        return view('adminView.satuan_produk.edit', compact('getData','pageTitle'));
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'id_pengusaha' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        // dd($input);
        $satuan_produk = SatuanProduk::where('id',$id)->update($input);
        
        return redirect()->route('satuan_produk.index');
    }

    
    public function destroy($id)
    {
        SatuanProduk::where('id',$id)->delete();
        return redirect()->route('satuan_produk.index');
    }
}