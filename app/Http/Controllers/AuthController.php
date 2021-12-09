<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;

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
    
}