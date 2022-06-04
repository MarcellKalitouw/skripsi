<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurir;
use File;
class KurirController extends Controller
{
    public function getData($id=null){
        try{
            $id?$data = Kurir::firstWhere('id', $id) : $data = Kurir::all();

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
        $data = Kurir::skip($page*$limit)->take($limit)->get();
        $totalRow = Kurir::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }
    public function store(Request $req){
        $data = Kurir::create([
            'id_pengusaha'=>$req->id_pengusaha,
            'nama_kurir' => $req->nama_kurir,
            'password' => $req->password,
            'foto_kurir' => $req->foto_kurir
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
        $data = Kurir::where("id", $req->id)->update([
            'id_pengusaha'=>$req->id_pengusaha,
            'nama_kurir' => $req->nama_kurir,
            'password' => $req->password,
            'foto_kurir' => $req->foto_kurir
        ]);
        // dd($data);
        if($data){
            return response()->json(['Result'=>"Data has been Updated"], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = Kurir::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }

    
    public function updatePasswordKurir (Request $req, $id){
        try{
            // dd($req);
            $validate = $this->validate($req, [
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_new_password' => 'required'
            ]);

            $cekOldPassword = Kurir::where('id', $id)
                                ->first('password');
            if(\Hash::check($req->old_password, $cekOldPassword->password)){
                if($cekOldPassword){
                    if($req->new_password === $req->confirm_new_password){
                        // dd('test');
                        $renewPassword = bcrypt($req->confirm_new_password);
                        $updatePassword = Kurir::where('id', $id)->update([
                            'password' => $renewPassword
                        ]);
                        // dd($updatePassword);
                        return response()->json(['Result'=>"Password has been Updated"], 200);
                    }else{
                        return response()->json(['Result'=>'Password failed to be updated. new password not match with confirm new password'], 401);
                    }
                }
            }else{
                return response()->json(['Result'=>'Password failed to be updated. Wrong old password'], 401);

            };
            // dd($cekOldPassword);
            
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
        }
    }


    public function updateKurirProfilePicture(Request $request, $id){
        try{
            $input = $request->except(['_token']);
            $oldData = Kurir::find($id);
            // dd($oldData['gambar']);
            
            // dd($request->hasFile('foto_kurir'));
            if($oldData->foto_kurir){
                if($request->hasFile('foto_kurir')){
                    $fileName = time().'_'.$request->foto_kurir->getClientOriginalName();
                    $request->foto_kurir->move(public_path('gambar_kurir'), $fileName);
                    $input['foto_kurir'] = $fileName;
                    File::delete(public_path('gambar_kurir/'.$oldData->foto_kurir));

                }else{
                    // dd('eror');
                    $input['foto_kurir'] = $oldData->foto_kurir;
                }
            }else{
                $fileName = time().'_'.$request->foto_kurir->getClientOriginalName();
                $request->foto_kurir->move(public_path('gambar_kurir'), $fileName);
                $input['foto_kurir'] = $fileName;
            }

            $data = Kurir::find($id)->update($input);
            // dd($input);
            
            if($data){
                return response()->json([
                    'data'=>$data,
                    'Result'=>'Image has been updated'
                ], 200);
            }else{
                return response()->json([
                    'Result'=> "Image failed to be updated"
                ], 401);
            }
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
        }
        
    }
}