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
        $user = Pelanggan::where('email', $request->email)->first();
        if(!$user || $request->password != $user->password){
            return response()->json([
                'message' => 'UNAUTHORIZED'
            ], 401);
        }
        $token = $user->createToken('token-name')->plainTextToken;

        return response()->json([
                'message' => 'success',
                'user' => $user,
                'token' => $token
            ], 200);
    }
    
    public function login_kurir(Request $request){
        $kurir = Kurir::where('nama_kurir', $request->nama_kurir)->first();
        // dd($kurir);
        if(!$kurir && \Hash::check($request->password, $kurir->password)){
            return response()->json([
                'message'=>'UNAUTHORIZED'
            ], 401);
            
        }
        $token = $kurir->createToken('token-name')->plainTextToken;
        return response()->json([
                'message' => 'success',
                'user' => $kurir,
                'token' => $token
            ], 200);
    }
}