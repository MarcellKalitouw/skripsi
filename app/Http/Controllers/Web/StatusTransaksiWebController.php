<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\StatusTransaksi;
use DB;

class StatusTransaksiWebController extends Controller
{
    protected $pageTitle = 'Status Transaksi';
    public function index()
    {
        $data = DB::table('status_transaksi')
                ->leftJoin('transaksi', 'status_transaksi.id_transaksi', 'transaksi.id')
                ->whereNull('status_transaksi.deleted_at')
                ->select('status_transaksi.*',
                        'transaksi.id AS ID_TRANSAKSI',
                        'transaksi.id_pelanggan AS PELANGGAN',
                        'transaksi.id_pengusaha AS PENGUSAHA'
                )
                ->orderBy('created_at', 'desc')
                ->get();
        // $pelanggan = array();
        
        $this->getIterasiPelanggan($data);
        $this->getIterasiPengusaha($data);
        // foreach ($data as $key ) {
        //     $newPelanggan = DB::table('pelanggan')->where('id', $key->PELANGGAN)->first();
             // return $pelanggan->nama;
             // array_push($pelanggan, $newPelanggan);
        //     $key->NAMA_PELANGGAN = $newPelanggan->nama;
        // }
        // dd($data);

        return view('adminView.status_transaksi.index', compact('data'));
    }

    public function getIterasiPelanggan($data){
        foreach ($data as $key ) {
            $newPelanggan = DB::table('pelanggan')->where('id', $key->PELANGGAN)->first();
            $key->NAMA_PELANGGAN = $newPelanggan->nama;
        }
        // dd($data);
    }
    public function getIterasiPengusaha($data){
        foreach ($data as $key ) {
            $newPengusaha = DB::table('pengusaha')->where('id', $key->PENGUSAHA)->first();
            $key->NAMA_PENGUSAHA = $newPengusaha->nama;
        }
        // dd($data);
    }

    public function create()
    {
        
        $transaksi = DB::table('transaksi')->get();
        return view('adminView.status_transaksi.create',['pageTitle'=>$this->pageTitle, 'transaksi'=>$transaksi]);
    }

    public function store(Request $request)
    {
        $validate = $this->validate($request, [
            'id_transaksi' => 'required',
            'nama' => 'required',
            'tipe' => 'required'
        ]);
        $input = $request->except(['_token']);  
        $status_transaksi = StatusTransaksi::create($input);
        return redirect()->route('status_transaksi.index');
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $transaksi = DB::table('transaksi')->get();
        $getData = DB::table('status_transaksi')->where('id',$id)->first();
        return view('adminView.status_transaksi.edit',['pageTitle'=>$this->pageTitle, 'transaksi'=>$transaksi,'getData'=>$getData]);
    }

    public function update(Request $request, $id)
    {
        $validate = $this->validate($request, [
            'id_transaksi' => 'required',
            'nama' => 'required',
            'tipe' => 'required'
        ]);
        $input = $request->except(['_token', '_method']);
        $status_transaksi = StatusTransaksi::where('id', $id)->update($input);

        return redirect()->route('status_transaksi.index');
    }

    public function destroy($id)
    {
        StatusTransaksi::where('id', $id)->delete();
        return redirect()->route('status_transaksi.index');
    }
}