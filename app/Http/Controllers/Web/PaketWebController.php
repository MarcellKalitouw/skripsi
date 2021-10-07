<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paket;
use DB;
class PaketWebController extends Controller
{

    protected $pageTitle = 'Paket';
    public function index()
    {
        $data = Paket::withTrashed()->get();
        // dd($data);
        // $a = Paket::where('id_pengusaha', '4123123')->first();
        // setlocale(LC_MONETARY,"en_US");

        // $money = money_format('Rp. %n', $a->harga);
        // dd($money);
        return view('adminView.paket.index', compact('data'));
    }

    
    public function create()
    {
        $pageTitle = $this->pageTitle;
        return view('adminView.paket.create', compact('pageTitle'));
    }

    
    public function store(Request $request)
    {
        // dd($request);
        $validate = $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token']);
        $input['id_pengusaha'] = '1';
        // dd($input);
        $paket = Paket::create($input);
        
        return redirect()->route('paket.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $pageTitle = $this->pageTitle;
        $getData = DB::table('paket')->where('id',$id)->first();
        return view('adminView.paket.edit', compact('pageTitle', 'getData'));
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required'
        ]);
        $input = $request->except(['_token','_method']);
        $input['id_pengusaha'] = '1';
        // dd($input);
        $paket = Paket::where('id',$id)->update($input);
        
        return redirect()->route('paket.index');
    }

    
    public function destroy($id)
    {
        Paket::where('id', $id)->delete();
        return redirect()->route('paket.index');
    }
}