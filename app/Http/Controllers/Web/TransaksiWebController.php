<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Transaksi;

class TransaksiWebController extends Controller
{
    protected $pageTitle = 'Transaksi';
    public function index()
    {
        $data = Transaksi::get();

        return view('adminView.transaksi.index', compact('data'));
    }

    
    public function create()
    {
        $status = DB::table('status')->get();
        $pengguna = DB::table('users')->get();
        $pengusaha = DB::table('pengusaha')->get();
        $shipping = DB::table('shipping')->get();
        
        return view('adminView.transaksi.create', [
            'getStatus'=>$status,
            'getPengguna'=>$pengguna,
            'getPengusaha'=>$pengusaha,
            'getShipping'=>$shipping,
            'pageTitle'=>$this->pageTitle
        ]);
    }

    
    public function store(Request $request)
    {
        $request['id_status'] = 1;
        $request['tgl'] = now();
        // dd($request); 
        $validate = $this->validate($request, [
            'id_status' => 'required',
            'id_pelanggan' => 'required',
            'id_pengusaha' => 'required',
            'id_shipping' => 'required',
            'total_qty' => 'required',
            'subtotal_qty' => 'required',
            'pajak' => 'required',
            'diskon' => 'required',
            'biaya_tambahan' => 'required',
            'biaya_pengiriman' => 'required',
            'total' => 'required',
            'keterangan' => 'required'
        ]);

        $input = $request->except(['_token']);
        $transaksi = Transaksi::create($input);
        return redirect()->route('transaksi.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $status = DB::table('status')->get();
        $pengguna = DB::table('users')->get();
        $pengusaha = DB::table('pengusaha')->get();
        $shipping = DB::table('shipping')->get();
        $getData = DB::table('transaksi')->where('id', $id)->first();
        return view('adminView.transaksi.edit', [
            'getData'=>$getData,
            'getStatus'=>$status,
            'getPengguna'=>$pengguna,
            'getPengusaha'=>$pengusaha,
            'getShipping'=>$shipping,
            'pageTitle'=>$this->pageTitle
        ]);
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'id_status' => 'required',
            'id_pelanggan' => 'required',
            'id_pengusaha' => 'required',
            'id_shipping' => 'required',
            'total_qty' => 'required',
            'subtotal_qty' => 'required',
            'pajak' => 'required',
            'diskon' => 'required',
            'biaya_tambahan' => 'required',
            'biaya_pengiriman' => 'required',
            'total' => 'required',
            'keterangan' => 'required'
        ]);

        $input = $request->except(['_token','_method']);
        $transaksi = Transaksi::where('id',$id)->update($input);
        return redirect()->route('transaksi.index');
    }

    
    public function destroy($id)
    {
        Transaksi::where('id', $id)->delete();
        return redirect()->route('transaksi.index');
    }
}