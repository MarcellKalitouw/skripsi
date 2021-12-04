<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriProduk extends Model
{
    
    protected $table = 'kategori_produk';
    use HasFactory, SoftDeletes, Uuids;
    public $timestamps = true;
    protected $fillable = [
        'nama'
    ];
    
}
// $fileGambar = [];
        // dd($request->gambar);


        // if($request->hasfile('gambar')){
        //     foreach ($request->gambar as $key => $gambar) {
        //         $fileName = time().'.'.$gambar->extension();  
        //         $gambar->move(public_path('gambar_produk'), $fileName);
        //         $fileGambar['file'] = $fileName;
        //         $fileGambar['id_produk'] = $paket->id;
        //         dd($fileGambar);  
        //         $gambarProduk = GambarProduk::create($fileGambar);
                
        //     }
            
        // }