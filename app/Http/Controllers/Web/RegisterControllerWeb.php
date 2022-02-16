<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengusaha;

class RegisterControllerWeb extends Controller
{
    
    public function index()
    {
        $s = session()->get('email');
        if($s){
            return redirect('/dashboard_pengusaha');
        }
        return view('register.index');
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        // dd($request);
        $validate = $this->validate($request, [
            'nama' => 'required|unique:pengusaha,nama',
            'no_telp' => 'required',
            'email' => 'required|unique:pengusaha,email',
            'gambar' => 'required',
            'password' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token']);

        if($request->hasfile('gambar')){
            $fileName = time().'_'.$request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('gambar_pengusaha'), $fileName);
            $input['gambar'] = $fileName;
            // dd($input);
        }
        $input['password'] = bcrypt($input['password']);

        $paket = Pengusaha::create($input);
        
        return redirect()->route('dashboard.pengusaha')->with('success','Data pengusaha <strong> "'.$input['nama'].'" </strong> has been saved!!');
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