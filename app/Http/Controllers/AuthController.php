<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Kurir;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        try{
            $user = Pelanggan::where('email', $request->email)->first(['id','nama','email','status','password']);
            // dd($request);
            // dd($user);
            // dd(\Hash::check($request->password, $user->password));
            if(!$user || !\Hash::check($request->password, $user->password)){
                
                unset($user['password']);
                return response()->json([
                    'message' => 'UNAUTHORIZED','data'=>$user,'request'=>$request->email
                ], 401);
            }

            // dd($request);
            unset($user['password']);
            $token = $user->createToken('token-name')->plainTextToken;

            return response()->json([
                    'message' => 'success',
                    'user' => $user,
                    'token' => $token
                ], 200);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
        }
        
    }
    
    public function login_kurir(Request $request){
        try{
            $kurir = Kurir::where('nama_kurir', $request->nama_kurir)->first();
            // dd(\Hash::check($request->password, $kurir->password));
            if(!$kurir || !\Hash::check($request->password, $kurir->password)){
                unset($kurir['password']);

                return response()->json([
                    'message'=>'UNAUTHORIZED'
                ], 401);
                
            }
            $token = $kurir->createToken('token-name')->plainTextToken;
            unset($kurir['password']);

            return response()->json([
                    'message' => 'success',
                    'user' => $kurir,
                    'token' => $token
                ], 200);

        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
        }
        
    }

    public function logout_pelanggan(){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out '
        ];
    }

    public function logout_kurir(){
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out '
        ];
    }
}