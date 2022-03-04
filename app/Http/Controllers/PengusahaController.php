<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengusaha;

class PengusahaController extends Controller
{
    public function getData($id=null){
        try{
            $id?$data = Pengusaha::firstWhere('id', $id) : $data = Pengusaha::all();

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

    public function searchPengusaha($page, $limit, $key){
        try{
            $page = $page?intVal($page):0;
            $limit = $limit?intval($limit): 0;
            
            if($key){
                $data = Pengusaha::where('nama', 'LIKE', '%'.$key.'%')
                        ->skip($page*$limit)->take($limit)->get();
                $totalRow = $data->count();
                if(count($data)> 0){
                    return response()->json([
                        'message'=>'success',
                        'data'=>$data,
                        'total_row'=>$totalRow,
                        'page'=>$page,
                        'limit'=> $limit
                    ],200);
                }else{
                    return response()->json(['message'=>'empty'], 401);
                }
            }

            dd($page);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
            
        }
    }
    public function getDataPageLimit($page, $limit){
        $page = $page?$page:0;
        $limit = $limit?$limit:0;
        $page = intval($page);
        $limit = intval($limit);
        $data = Pengusaha::skip($page*$limit)->take($limit)->get();
        $totalRow = Pengusaha::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }
    public function store(Request $req){
        $data = Pengusaha::create([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'latitude'=>$req->latitude,
            'longitude'=>$req->longitude,
            'no_telp'=>$req->no_telp,
            'email'=>$req->email,
            'gambar'=>$req->gambar,
            'deskripsi'=>$req->deskripsi,
            'password'=>$req->password
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
        $data = Pengusaha::where("id", $r->id)->update([
            'nama'=>$req->nama,
            'alamat'=>$req->alamat,
            'latitude'=>$req->latitude,
            'longitude'=>$req->longitude,
            'no_telp'=>$req->no_telp,
            'email'=>$req->email,
            'gambar'=>$req->gambar,
            'deskripsi'=>$req->deskripsi,
            'password'=>$req->password
        ]);
        if($data){
            return response()->json(['Result'=>"Data has been Updated"], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = Pengusaha::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }
}