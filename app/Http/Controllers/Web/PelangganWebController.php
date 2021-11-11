<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use DB;

class PelangganWebController extends Controller
{
    protected $pageTitle = 'Pelanggan';
    public function index()
    {
        $data = Pelanggan::withTrashed()->get();

        return view('adminView.pelanggan.index', compact('data'));
    }

    public function create()
    {
        return view('adminView.pelanggan.create',['pageTitle'=>$this->pageTitle]);
    }
    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'gambar' => 'required',
            'status' => 'required',
            'password' => 'required',
            
        ]);
        $input = $request->except(['_token']);
        $input['no_telp'] = "+62".$request->no_telp;
        // dd($input);
        $pelanggan = Pelanggan::create($input);
        
        return redirect()->route('pelanggan.index');
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $getData = Pelanggan::findOrFail($id);
        return view('adminView.pelanggan.edit',
                [
                    'pageTitle'=>$this->pageTitle,
                    'getData' => $getData
                ]
            );
        
    }

    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required',
            'gambar' => 'required',
            'status' => 'required',
            // 'password' => 'required',
            
        ]);
        $input = $request->except(['_token','_method']);
        // $input['no_telp'] = "+62".$request->no_telp;
        // dd($input);
        $pelanggan = Pelanggan::where('id',$id)->update($input);
        
        return redirect()->route('pelanggan.index');
    }
    public function destroy($id)
    {
        Pelanggan::where('id', $id)->delete();
        return redirect()->route('pelanggan.index');
    }
}