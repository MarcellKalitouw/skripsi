<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Pengusaha;

class PengusahaWebController extends Controller
{
    protected $pageTitle = 'Pengusaha';


    public function index()
    {
        $data = Pengusaha::withTrashed()->get();

        return view('adminView.pengusaha.index', compact('data'));
    }

    
    public function create()
    {
        $pageTitle = $this->pageTitle;
        return view('adminView.pengusaha.create', compact('pageTitle'));
        
    }

   
    public function store(Request $request)
    {
        // dd($request);
        $validate = $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'gambar' => 'required',
            'password' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token']);
        $paket = Pengusaha::create($input);
        
        return redirect()->route('pengusaha.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $pageTitle = $this->pageTitle;
        $getData = Pengusaha::where('id', $id)->first();
        
        return view('adminView.pengusaha.edit', compact('pageTitle', 'getData'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        $validate = $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'password' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token', '_method']);
        $pengusaha = Pengusaha::where('id', $id)->update($input);
        return redirect()->route('pengusaha.index');
    }

    public function destroy($id)
    {
        //
    }
}