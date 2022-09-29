<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\GambarProduk;
use DB;
use File;
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
        
        $this->getGambarProdukById($data);
        // dd($data);

        return view('adminView.produk.index', compact('data'));
    }
    public function getGambarProdukById($data){
        foreach ($data as $key) {
            $gambarProduk = DB::table('gambar_produk')->where('id_produk', $key->id)->get();
            
            $fileProduk = $gambarProduk;
            $key->gambar_produk = $fileProduk;
            // dd($gambarProduk->file);
        }
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
        // dd($request);
        $validate = $this->validate($request, [
            'id_pengusaha' => 'required',
            'id_satuan' => 'required',
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'gambar.*' => 'file|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token','gambar']);
        $produk = Produk::create($input);
        
        $files = [];
        if($request->hasfile('gambar')){
            foreach ($request->file('gambar') as $key => $file ) {
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('gambar_produk'), $fileName);

                $files['file'] = $fileName;
                $files['id_produk'] = $produk->id;
 
                // $files[$key]['file'] = $fileName;
                // $files[$key]['id_produk'] = $produk->id;
                // $fileName = time().'.'.$item->extension();  
                // $item->move(public_path('gambar_produk'), $fileName);
                // $files[] = array(
                //         'file' => $fileName,
                //         'id_produk' => $paket->id
                // );
                
                // $files[$item]['file'] = $fileName;
                // $files[$item]['id_produk'] = $paket->id;
                // dd($files);
                $gambarProduk = GambarProduk::create($files);
            }
            
        }
        
        
        return redirect()->route('produk.index')->with('success','Data product <strong> "'.$input['nama'].'" </strong> has been saved!!');
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
        $getData = DB::table('produk')->leftJoin('gambar_produk','gambar_produk.id_produk','produk.id')
                ->select('produk.*','gambar_produk.file as gambar')
                ->where('produk.id',$id)->first();

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
        $oldData = DB::table('produk')->where('id',$id)->first();
        $input = $request->except(['_token','_method']);

        if($request->gambar == null){
            $this->validate($request, [
                'id_pengusaha' => 'required',
                'id_satuan' => 'required',
                'nama' => 'required',
                'harga' => 'required',
                'deskripsi' => 'required'
            ]);            
        }else{
            $this->validate($request, [
            'id_pengusaha' => 'required',
            'id_satuan' => 'required',
            'id_kategori' => 'required',
            'nama' => 'required',            
            'gambar' => 'required',
            'gambar' => 'file|mimes:jpg,jpeg,png|max:2048',
            'harga' => 'required',
            'deskripsi' => 'required'
        ]);
            if(is_file($request->gambar)){
                $fileName = time().'.'.$request->gambar->extension();  
                $request->gambar->move(public_path('gambar_produk'), $fileName);
                $input['gambar'] = $fileName;
                File::delete(public_path('gambar_produk/'.$oldData->gambar));
            }else{
                dd('File does not exists.');
            }
        }
        $paket = Produk::where('id', $id)->update($input);
        
        return redirect()->route('produk.index');   
    }

    
    public function destroy($id)
    {
        $oldData = DB::table('produk')->where('id',$id)->first();
        $fileGambar = DB::table('gambar_produk')->where('id_produk',$id)->get();
        foreach ($fileGambar as $key) {
            DB::table('gambar_produk')->where('id_produk',$id)->delete();
            File::delete(public_path('gambar_produk/'.$key->file));
        }
        Produk::where('id', $id)->delete();
        return redirect()->route('produk.index');
    }
}