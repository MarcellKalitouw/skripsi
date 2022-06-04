<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use File;

class PelangganController extends Controller
{
    public function getData($id=null){
        try{
            $id?$data = Pelanggan::firstWhere('id', $id) : $data = Pelanggan::all();

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
        $data = Pelanggan::skip($page*$limit)->take($limit)->get();
        $totalRow = Pelanggan::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }
    public function store(Request $req){
        $data = Pelanggan::create([
            'nama'=>$req->nama,
            'no_telp' => $req->no_telp,
            'email' => $req->email,
            'status' => $req->status,
            'password' => $req->password
        ]);
        $data['password'] = bcrypt($req->password);

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
    public function storeGambar(Request $request, $id){
        $input = $request->except(['_token']);
        $oldData = Pelanggan::find($id);
        // dd($oldData['gambar']);
        
        if($oldData->gambar){
            if($request->hasFile('gambar')){
                $fileName = time().'_'.$request->gambar->getClientOriginalName();
                $request->gambar->move(public_path('gambar_pelanggan'), $fileName);
                $input['gambar'] = $fileName;
                File::delete(public_path('gambar_pelanggan/'.$oldData->gambar));

            }else{
                $input['gambar'] = $check->gambar;
            }
        }else{
            $fileName = time().'_'.$request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('gambar_pelanggan'), $fileName);
            $input['gambar'] = $fileName;
        }

        $data = Pelanggan::find($id)->update($input);
        
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
    }

    public function update(Request $r){
        $data = Pelanggan::where("id", $r->id)->update([
            'nama'=>$req->nama,
            'no_telp' => $req->no_telp,
            'email' => $req->email,
            'status' => $req->status,
        ]);
        
        if($data){
            return response()->json(['Result'=>"Data has been Updated"], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = Pelanggan::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }

    public function updatePasswordPelanggan (Request $req, $id){
        try{
            // dd($req);
            $validate = $this->validate($req, [
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_new_password' => 'required'
            ]);

            $cekOldPassword = Pelanggan::where('id', $id)
                                ->first('password');
            if(\Hash::check($req->old_password, $cekOldPassword->password)){
                if($cekOldPassword){
                    if($req->new_password === $req->confirm_new_password){
                        // dd('test');
                        $renewPassword = bcrypt($req->confirm_new_password);
                        $updatePassword = Pelanggan::where('id', $id)->update([
                            'password' => $renewPassword
                        ]);
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
}