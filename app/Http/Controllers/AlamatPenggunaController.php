<?php

namespace App\Http\Controllers;

use App\Models\AlamatPengguna;
use Illuminate\Http\Request;

class AlamatPenggunaController extends Controller
{
    public function getData($id=null){
        try{
            $id?$data =  $data = AlamatPengguna::all() : AlamatPengguna::firstWhere('id', $id);
            // dd($data);
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
        $limit = intval($limit);
        $data = AlamatPengguna::skip($page*$limit)->take($limit)->get();
        $totalRow = AlamatPengguna::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }
    public function store(Request $req){
        // dd($req);
        $data = AlamatPengguna::create([
            'id_pelanggan'=>$req->id_pelanggan,
            'alamat' => $req->alamat,
            'long' => $req->long,
            'lat' => $req->lat
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
        $data = AlamatPengguna::where("id", $req->id)->update([
            'id_pelanggan'=>$req->id_pelanggan,
            'alamat' => $req->alamat,
            'long' => $req->long,
            'lat' => $req->lat
        ]);
        // dd($data);
        if($data){
            $data = AlamatPengguna::where('id',$req->id)->first();
            return response()->json(['Result'=>"Data has been Updated",'data'=>$data], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = AlamatPengguna::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }
}