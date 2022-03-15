<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Shipping;
use App\Models\StatusTransaksi;
use App\Models\AlamatPengguna;
use App\Models\Status;

class TransaksiWebController extends Controller
{
    protected $pageTitle = 'Transaksi';
    
    public function index()
    {
        $data = Transaksi::get();

        return view('adminView.transaksi.index', compact('data'));
    }

    public function getId(){
        $id = session()->get('id');
        return $id;
    }

    public function listTransaksi (){
        $id = session()->get('id');
        $data = DB::table('transaksi')
                ->leftJoin('pelanggan', 'transaksi.id_pelanggan', 'pelanggan.id')
                ->leftJoin('status', 'transaksi.id_status', 'status.id')
                ->whereNull('transaksi.deleted_at')
                ->where('id_pengusaha', $this->getId())
                ->select(
                    'transaksi.*',
                    'pelanggan.nama as nama_pelanggan',
                    'status.nama as nama_status'
                
                )
                ->orderBy('created_at','desc')
                ->get();
        // dd($data);
        return view('adminView.transaksi.list-transaksi', compact('data'));
    }

    public function detailTransaksi($id){
        // dd($id);
        $item = DB::table('transaksi')
                ->leftJoin('pelanggan', 'transaksi.id_pelanggan', 'pelanggan.id')
                ->leftJoin('status', 'transaksi.id_status', 'status.id')
                ->whereNull('transaksi.deleted_at')
                ->where('transaksi.id', $id)
                ->select(
                    'transaksi.*',
                    'pelanggan.nama as nama_pelanggan',
                    'status.nama as nama_status'
                
                )
                ->orderBy('created_at','desc')
                ->first();;
        $detail_transaksi = DetailTransaksi::where('id_transaksi',$id )->get();
        $shipping = Shipping::where('id_transaksi', $id)->get();
        $status_transaksi = StatusTransaksi::where('id_transaksi', $id)->get();
        $alamat_transaksi = AlamatPengguna::where('id', $item->id_alamat)->first();
        // dd($alamat_transaksi);
        return view('adminView.transaksi.detail-transaksi', compact(
            'item',
            'detail_transaksi',
            'shipping',
            'status_transaksi',
            'alamat_transaksi'
        ));

        
    }

    public function updateStatusTransaksi($id, $status, $tipe){
        DB::beginTransaction();
        $getUser = session()->all();
        // dd($id);
        // dd($getUser);
        $transaksi = Transaksi::findOrFail($id);
        $status_transaksi = Status::where('nama', $status)->first(['id','nama']);
        // dd($status_transaksi->id);
        try{
            //update Transaksi pe status
            $updateTransaksi = Transaksi::find($id)->update(['id_status'=>$status_transaksi->id]);
            // dd($updateTransaksi);
            //update tabel status transaksi
            
            $updateStatusTransaksi = StatusTransaksi::create([
                'id_transaksi' => $id,
                'nama' => $status_transaksi->nama,
                'keterangan' => '',
                'tipe' => $tipe,
                'id_user' => $getUser['id'],
                'updated_by' => $getUser['tipe']
            ]);
            DB::commit();
            return redirect()->route('transaksi.detail-transaksi', $id)->with('success', 'Status Transaksi Berhasil di perbaharui');

        }catch(\Exception $e){
            dd($e);
            DB::rollback();
            return redirect()->route('transaksi.detail-transaksi')->with('error', 'Status Transaksi Gagal di perbaharui');
        }

        
    }

    public function create()
    {
        $status = DB::table('status')->get();
        $pengguna = DB::table('pelanggan')->get();
        $pengusaha = DB::table('pengusaha')->get();
        $shipping = DB::table('shipping')->get();
        // dd($pengguna);
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
        // $request['id_status'] = 1;
        $request['tgl'] = now();
        // dd($request); 
        $validate = $this->validate($request, [
            'id_status' => 'required',
            'id_pelanggan' => 'required',
            'id_pengusaha' => 'required',
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