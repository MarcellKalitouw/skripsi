<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function getData($id=null){
        try{
            $id?$data = Produk::firstWhere('id', $id) : $data = Produk::all();

            // dd(is_null($data));

            if($id){
                if(is_null($data)){
                    return response()->json(['message'=>'Data is not avaible', 'data'=>$data], 404);
                }else{
                    return response()->json(['data'=>$data], 200);
                }
            }else{
                if($data->isEmpty()){
                    return response()->json(['message'=>'Data is not avaible', 'data'=>$data], 404);
                }else{
                    return response()->json(['data'=>$data], 200);
                }
            }
            
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
        }
    }
    public function getDataPageLimit($page=null, $limit = null){
        $page = $page?$page:0;
        $limit = $limit?$limit:0;
        $page = intval($page);
        $limit = intval($page);
        $data = Produk::skip($page*$limit)->take($limit)->get();
        $totalRow = Produk::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }
    public function store(Request $req){
        $data = Produk::create([
            'id_pengusaha'=>$req->id_pengusaha,
            'nama'=>$req->nama,
            'harga'=>$req->harga,
            'id_satuan'=>$req->id_satuan,
            'id_kategori'=>$req->id_kategori,
            'gambar'=>$req->gambar,
            'deskripsi'=>$req->deskripsi
        ]);
        if($data){
            return response()->json([
                'data'=>$data,
                'Result'=>'Data has been stored'
            ], 200);
        }else{
            return response()->json([
                'Result'=> "Data failed to be stored"
            ], 401);
        }
    }

    public function update(Request $req){
        $data = Produk::where("id", $req->id)->update([
            'id_pengusaha'=>$req->id_pengusaha,
            'nama'=>$req->nama,
            'harga'=>$req->harga,
            'id_satuan'=>$req->id_satuan,
            'id_kategori'=>$req->id_kategori,
            'gambar'=>$req->gambar,
            'deskripsi'=>$req->deskripsi
        ]);
        
        if($data){
            return response()->json(['Result'=>"Data has been Updated"], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = Produk::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }
}