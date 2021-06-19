<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
class TransaksiController extends Controller
{
    public function getData($id=null){
        try{
            $id?$data = Transaksi::firstWhere('id', $id) : $data = Transaksi::all();

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
        $data = Transaksi::skip($page*$limit)->take($limit)->get();
        $totalRow = Transaksi::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }
    public function store(Request $req){
        $data = Transaksi::create([
            'id_status'=>$req->id_status,
            'id_pelanggan'=>$req->id_pelanggan,
            'id_pengusaha'=>$req->id_pengusaha,
            'id_shipping'=>$req->id_shipping,
            'tgl'=>$req->tgl,
            'total_qty'=>$req->total_qty,
            'subtotal_qty'=>$req->subtotal_qty,
            'pajak'=>$req->pajak,
            'diskon'=>$req->diskon,
            'biaya_tambahan'=>$req->biaya_tambahan,
            'biaya_pengiriman'=>$req->biaya_pengiriman,
            'total'=>$req->total,
            'keterangan'=>$req->keterangan
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

    public function update(Request $r){
        $data = Transaksi::where("id", $r->id)->update([
            'id_status'=>$req->id_status,
            'id_pelanggan'=>$req->id_pelanggan,
            'id_pengusaha'=>$req->id_pengusaha,
            'id_shipping'=>$req->id_shipping,
            'tgl'=>$req->tgl,
            'total_qty'=>$req->total_qty,
            'subtotal_qty'=>$req->subtotal_qty,
            'pajak'=>$req->pajak,
            'diskon'=>$req->diskon,
            'biaya_tambahan'=>$req->biaya_tambahan,
            'biaya_pengiriman'=>$req->biaya_pengiriman,
            'total'=>$req->total,
            'keterangan'=>$req->keterangan
        ]);
        if($data){
            return response()->json(['Result'=>"Data has been Updated"], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = Transaksi::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }
}