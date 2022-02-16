<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Pengusaha;
use File;
class PengusahaWebController extends Controller
{
    protected $pageTitle = 'Pengusaha';


    public function index()
    {
        $data = Pengusaha::withTrashed()
                ->orderBy('created_at', 'desc')
                ->get();
        // dd($data);
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
        if($request->hasfile('gambar')){
            $fileName = time().'_'.$request->gambar->getClientOriginalName();
            $request->gambar->move(public_path('gambar_pengusaha'), $fileName);
            $input['gambar'] = $fileName;
        }

        $input = $request->except(['_token']);
        $paket = Pengusaha::create($input);
        
        return redirect()->route('pengusaha.index')->with('success','Data pengusaha <strong> "'.$input['nama'].'" </strong> has been saved!!');
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
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token', '_method']);
        $check = DB::table('pengusaha')->where('id', $id)->first();

        if(is_file($request->gambar)){
            $fileName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('gambar_produk'), $fileName);
            $input['gambar'] = $fileName;
            File::delete(public_path('gambar_pengusaha/'.$oldData->gambar));
        }else{
            // dd('File does not exists.');
            $input['gambar'] = $check->gambar;
        }
        // dd($check); 
        if($check){
            if($input['password'] != null){
                $input['password'] = bcrypt($input['password']);
            }
            else{
                $input['password'] = $check->password;
            }
        }
        //  dd($input);
        
        $pengusaha = Pengusaha::where('id', $id)->update($input);

        //redirect
        $s = session()->get('tipe');
        if($s == 'Pengusaha'){
            return redirect('/dashboard_pengusaha')->with('success','Data pengusaha <strong> "'.$input['nama'].'" </strong> has been updated!!');;
        }else{
            return redirect()->route('pengusaha.index')->with('success','Data pengusaha <strong> "'.$input['nama'].'" </strong> has been updated!!');
        }

    }

    public function destroy($id)
    {
        //   
        $oldData = Pengusaha::where('id', $id)->first();
        File::delete(public_path('gambar_produk/'.$oldData->gambar));
        Pengusaha::where('id',$id)->delete();
        return redirect()->route('pengusaha.index')->with('success','Data pengusaha <strong> "'.$oldData['nama'].'" </strong> has been deleted!!');;

    }

    //User Pengusaha

    public function EditProfile($id) {
        // dd($id);
        $pageTitle = $this->pageTitle;
        $getData = Pengusaha::where('id', $id)->first();
        // dd($getData);
        return view('adminView.profile-pengusaha.edit', compact('pageTitle', 'getData'));
        
    }

}