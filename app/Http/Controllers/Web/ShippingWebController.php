<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Shipping;

class ShippingWebController extends Controller
{
    
    public function index()
    {
        // $data = DB::table('shipping')->whereNull('deleted_at')->get();
        $data = DB::table('shipping')
                ->leftJoin('users', 'users.id','shipping.id_user')
                ->leftJoin('pengusaha', 'pengusaha.id','shipping.id_pengusaha')
                ->select('shipping.*', 'users.name as nama_pengguna', 'pengusaha.nama as nama_pengusaha')
                ->whereNull('shipping.deleted_at')
                ->get();
        // dd($data);
        return view('adminView.shipping.index', compact('data'));
    }

    
    public function create()
    {
        $pageTitle= 'Shipping';
        $getTransaksi = DB::table('transaksi')->get();
        $getUser = DB::table('users')->get();
        $getPengusaha = DB::table('pengusaha')->get();
        return view('adminView.shipping.create', compact('pageTitle', 'getTransaksi','getUser','getPengusaha'));
    }

    
    public function store(Request $request)
    {
        $request['id_transaksi'] = 1;
        // dd($request);
        $validate = $this->validate($request, [
            'id_transaksi' => 'required',
            'id_user' => 'required',
            'id_pengusaha' => 'required',
            'nama_kurir' => 'required',
            'alamat_jemput' => 'required',
            'geocoding_jemput' => 'required',
            'alamat_antar' => 'required',
            'geocoding_antar' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required',
        ]);

        $input = $request->except(['_token']);
        // dd($input);
        // $input['id_transaksi'] = '1';
        $shipping = Shipping::create($input);
        return redirect()->route('shipping.index');

    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $pageTitle= 'Shipping';
        $getTransaksi = DB::table('transaksi')->get();
        $getUser = DB::table('users')->get();
        $getPengusaha = DB::table('pengusaha')->get();
        $getData = Shipping::findOrFail($id);
        return view('adminView.shipping.edit', compact('getData','pageTitle', 'getTransaksi','getUser','getPengusaha'));
    }

   
    public function update(Request $request, $id)
    {
        $request['id_transaksi'] = 2;
        // dd($request);
        $validate = $this->validate($request, [
            'id_transaksi' => 'required',
            'id_user' => 'required',
            'id_pengusaha' => 'required',
            'nama_kurir' => 'required',
            'alamat_jemput' => 'required',
            'geocoding_jemput' => 'required',
            'alamat_antar' => 'required',
            'geocoding_antar' => 'required',
            'gambar' => 'required',
            'deskripsi' => 'required',
        ]);

        $input = $request->except(['_token', '_method']);
        // dd($input);
        // $input['id_transaksi'] = '1';
        $shipping = Shipping::where('id',$id)->update($input);
        return redirect()->route('shipping.index');
    }

    
    public function destroy($id)
    {
        //
        Shipping::where('id', $id)->delete();
        return redirect()->route('shipping.index');
    }
}