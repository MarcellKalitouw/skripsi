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
use App\Models\{Produk, SatuanProduk, Pelanggan};


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

    public function createPelanggan(){
        $pelanggan = Pelanggan::all();
        // $pelanggan = [];
        return view('adminView.transaksi.create-pelanggan', compact('pelanggan'));
    }

    // public function pilihProdukTransaksi
    public function createIdTransaksi(Request $request){
        try {
            // dd($request->all());
            if($request->id_pelanggan == null){
                $inputPelanggan = $this->validate($request, [
                    'nama' => 'required',
                    'gender' => 'required',
                    'no_telp' => 'required',
                    'email' => 'required',
                ]);
                $inputPelanggan['password'] = '12345678';
                $pelanggan = Pelanggan::create($inputPelanggan);
            }else{
                $pelanggan = new \stdClass();
                $pelanggan->id = $request->id_pelanggan;
            }
                // dd($pelanggan->id);
            

            // dd($pelanggan);

            $idPengusaha = session()->get('id');

            // Make Random Code Transaction
            $random_number = intval(rand(1,9) . rand(0,9)); 
            $date = date('ds');
            $inputTransaksi['tgl'] = date('Y-m-d');
            $inputTransaksi['kode_transaksi'] = "#yunit_MAN_".$random_number.$date;
            $inputTransaksi['id_pengusaha'] = $idPengusaha;
            $inputTransaksi['id_pelanggan'] = $pelanggan->id;

            // dd($inputTransaksi);

            $transaksi = Transaksi::create($inputTransaksi);

            return redirect()->route('transaksi.create-normal', $transaksi->id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function deleteDetailTransaksi($id){
        // dd($id);
        $deleteDetailTransaksi = DB::table('detail_transaksi')->where('id',$id)->delete();

        return response()->json($deleteDetailTransaksi);
    }

    public function createNormalTransaksi($idTransaksi)
    {
        DB::beginTransaction();
        try {
            $idPengusaha = session()->get('id');
            

            // dd($idTransaksi);

            $getProdukPengusaha = Produk::where('id_pengusaha', $idPengusaha)->get();
            // $detailTransaksi = DetailTransaksi::where('id_pengusaha', $idPengusaha)
            //                     ->where('id_transaksi', $idTransaksi)
            //                     ->get();
            $detailTransaksi = DB::table('detail_transaksi')
                                ->leftJoin('transaksi', 'detail_transaksi.id_transaksi', 'transaksi.id')
                                ->leftJoin('produk', 'detail_transaksi.id_produk', 'produk.id')
                                ->whereNull('detail_transaksi.deleted_at')
                                ->where('detail_transaksi.id_transaksi', $idTransaksi)
                                ->select(
                                    'detail_transaksi.*',
                                    'produk.nama as nama_produk',
                                    'transaksi.kode_transaksi as kode_transaksi'
                                )
                                ->orderBy('created_at', 'desc')
                                ->get();
            // $totalQty = DB::table('detail_transaksi')
            //             ->where('id_transaksi', $idTransaksi)
            //             ->sum('qty');
                            
            $totalDetailTransaksi = $this->SumDetailTransaksi($idTransaksi);
            // dd($totalDetailTransaksi);
                            

            $this->getGambarProdukById($getProdukPengusaha);
            DB::commit();


            // dd($getProdukPengusaha);
            return view('adminView.transaksi.create-normal-transaksi', [
                'produk' => $getProdukPengusaha,
                'idTransaksi' => $idTransaksi,
                'detailTransaksi' => $detailTransaksi,
                'totalDetailTransaksi' => $totalDetailTransaksi,
                'pageTitle'=>$this->pageTitle
            ]);
        } catch (\Throwable $th) {
            
            throw $th;
        }
        
    }
    public function SumDetailTransaksi($idTransaksi){
        $sumDetailTransaksi = new \stdClass();
        $sumDetailTransaksi->total_qty = DB::table('detail_transaksi')
                                        ->where('id_transaksi', $idTransaksi)
                                        ->sum('qty');
        $sumDetailTransaksi->total_harga = DB::table('detail_transaksi')
                                        ->where('id_transaksi', $idTransaksi)
                                        ->sum('harga');
        $sumDetailTransaksi->total_diskon = DB::table('detail_transaksi')
                                        ->where('id_transaksi', $idTransaksi)
                                        ->sum('diskon');
        $sumDetailTransaksi->grand_total = DB::table('detail_transaksi')
                                        ->where('id_transaksi', $idTransaksi)
                                        ->sum('total');
        return $sumDetailTransaksi;
        // dd($sumDetailTransaksi);

    }
    public function getDetailSelectedProduct($id){
        $detailProduk = Produk::find($id);
        $satuanProduk = SatuanProduk::where('id_pengusaha', session()->get('id'))->first('nama');

        $detailProduk['satuan_produk'] = $satuanProduk;
        // dd($detailProduk);
        return response()->json($detailProduk);
    }

    public function getGambarProdukById($data){
        foreach ($data as $key) {
            $gambarProduk = DB::table('gambar_produk')->where('id_produk', $key->id)->get();
            
            $fileProduk = $gambarProduk;
            $key->gambar_produk = $fileProduk;
            // dd($gambarProduk->file);
        }
    }

    public function storeDetailTransaksi(Request $request, $idTransaksi){
        // dd($request, $idTransaksi);
        $idPengusaha = session()->get('id');

        $input = $request->validate([
            'id_produk' => 'required',
            'harga' => 'required',
            'qty' => 'required',
            'diskon' => 'required',
            'total' => 'required'
        ]);
        $input['id_pengusaha'] = $idPengusaha;
        $input['id_transaksi'] = $idTransaksi;

        $detailTransaksi = DetailTransaksi::create($input);
        // dd($input);
        return redirect()->route('transaksi.create-normal', $idTransaksi);
    }
    public function storeNormalTransaks(Request $request){

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