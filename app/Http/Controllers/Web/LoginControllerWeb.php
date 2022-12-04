<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pengusaha;

class LoginControllerWeb extends Controller
{
    
    public function index()
    {
        $getToken = session()->get('email');
        if($getToken){
            return back();
        }else{

        return view('login.index');
        }
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $r)
    {
        $validate = $this->validate($r, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);
        if($validate){
            $user = User::where('email', $r->email)->first();
            $pengusaha = Pengusaha::where('email', $r->email)->first();
            // dd($pengusaha);
            if($user && \Hash::check($r->password, $user->password)) {
            
                session([
                    'email' => $user->email,
                    'nama' => $user->name,
                    'tipe' => "Admin"
                ]);
                // dd(session()->all());
                return redirect()->route('dashboard.admin')->with('success', '<b>Login Admin Berhasil</b>');
            
            }
            elseif ($pengusaha && \Hash::check($r->password, $pengusaha->password)) {
                session([
                    'id' => $pengusaha->id,
                    'email' => $pengusaha->email,
                    'nama' => $pengusaha->nama,
                    'tipe' => "Pengusaha"
                ]);
                return redirect()->route('dashboard.pengusaha')->with('success', '<b>Login Pengusaha Berhasil</b>');
            }
            else{
                session()->flush();
                return redirect()->route('login.index')->with('error', 'Email atau Password anda Salah!!');
            }
        }
    }
    public function logout(){
        session()->flush();
        return redirect()->route('login.index');
    }
   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}