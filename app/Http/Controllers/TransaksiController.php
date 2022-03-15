<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\StatusTransaksi;
use App\Models\Status;
use App\Models\Kurir;
use App\Models\Pelanggan;
use DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Validator;
use Auth;

class TransaksiController extends Controller
{
    /** @OA\Info(title="My First API", version="0.1") */
     /**
     * Create Transaksi
     * @OA\Post (
     *     path="/api/transaksi_controller/create/",
     *     tags={"Transaksi"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="title",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="content",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                      "transaksi":{
     *                                   "id_status": 1,
     *                                   "id_pelanggan": "a2495e9a-84f4-4841-9e46-dc05b3ffd1fe",
     *                                   "id_pengusaha":"342a526e-f0e5-4d9e-9665-337b5b0d3693",
     *                                   "id_shipping":4,
     *                                   "tgl":"2020-01-01",
     *                                   "total_qty":10,
     *                                   "subtotal_qty": 20,
     *                                   "pajak": 10,
     *                                   "diskon": 10,
     *                                   "biaya_tambahan": 1000,
     *                                   "total" : 2000,
     *                                   "keterangan": "testing 12345"
     *                               },
     *                               "detail_transaksi": 
     *                                      
     *                                   {
     *                                       "id_transaksi":2,
     *                                       "id_user": "a2495e9a-84f4-4841-9e46-dc05b3ffd1fe",
     *                                       "id_pengusaha": "342a526e-f0e5-4d9e-9665-337b5b0d3693",
     *                                      "id_produk":"7d492461-46bd-4b93-8b95-21dcaa9d8c40",
     *                                       "harga": 10000,
     *                                       "qty": 5,
     *                                       "diskon":0,
     *                                       "total":50000
     *                                       
     *                                   }
     *                               
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="title", type="string", example="title"),
     *              @OA\Property(property="content", type="string", example="content"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     */
    
    public function getData($id=null){
        try{
            $id?$data = Transaksi::firstWhere('id', $id) : $data = Transaksi::orderBy('created_at', 'DESC')->get();

            dd($data);

            if($id){
                if(is_null($data)){
                    return response()->json(['message'=>'Data is not avaible', 'data'=>$data], 404);
                }else{
                    return response()->json(['data'=>$data], 200);
                }
            }else{
                if($data->isEmpty()){
                    return response()->json(['message'=>'Data is not avaible', 'data'=>$data], 404);
                }else{
                    return response()->json(['data'=>$data], 200);
                }
            }
            
        }
        catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage()], 406);
        }
    }
    //Get history Transaksi by user

    public function getCurentTransaction(Request $request, $id){
        // dd($request->header('tipe'));
        // dd($id);
        // 17|dWtBkvP5KaLpkW94B9lW3Uq3L4rouroQUHrtN7Ul user
        // 19|Fi9V7SONzDiPTgkQhks7sVto8vDgJumu87uGYklg kurir
        $tipe_user = $request->header('tipe');
        $idPengguna = Auth::user()->id;
        // dd($idPengguna);
        if($tipe_user == 'kurir'){
            $cekKurir = Kurir::find($idPengguna);
            if($cekKurir){
                $transaksi = Transaksi::find($id);
                $detail_transaksi = DetailTransaksi::where('id_transaksi',$id)->get();
                return response()->json(
                [
                    'transaksi'=>$transaksi,
                    'detail_transaksi' => $detail_transaksi,
                    'message'=>'success',
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Error not kurir'
                ], 401);
            }
        }else{
            $cekPelanggan = Pelanggan::find($idPengguna);
            $cekPelanggan ? $cekTransaksi = Transaksi::where('id_pelanggan', $cekPelanggan->id)->where('id', $id)->first() : null;
            if($cekPelanggan && $cekTransaksi){
                $transaksi = Transaksi::find($id);
                $detail_transaksi = DetailTransaksi::where('id_transaksi',$id)->get();
                return response()->json(
                [
                    'transaksi'=>$transaksi,
                    'detail_transaksi' => $detail_transaksi,
                    'message'=>'success',
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Error not pelanggan'
                ], 401);
            }
        }
        
    }
    public function getRiwayatTransaksi( $page=null, $limit = null, $idPelanggan){
        
        // dd()
        $page = $page?$page:0;
        $limit = $limit?$limit:0;
        $page = intval($page);
        $limit = intval($limit);
        $data = Transaksi::skip($page*$limit)
                ->take($limit)
                ->where('id_pelanggan', $idPelanggan)
                ->whereNull('deleted_at')
                ->orderBy('created_at','desc')
                ->get();
        
        $totalRow = Transaksi::count();
        if(count($data)>0)
            return response()->json(
                [
                    'data'=>$data,
                    'message'=>'success', 
                    'page'=>$page, 
                    'limit'=>$limit, 
                    'total_row'=>$totalRow
                ], 200);
        return response()->json(['message'=>'empty'], 401);
    }

    public function getQrCode($idTransaksi){
        $kode_transaksi = Transaksi::where('id',$idTransaksi)->first('kode_transaksi');
        // dd($kode_transaksi);
        // $image = \QrCode::format('png')
        //                  ->merge('qrcode/laravel.png', 0.5, true)
        //                  ->size(500)->errorCorrection('H')
        //                  ->generate('A simple example of QR code!');
        // return response($image)->header('Content-type','image/png');
        return \QrCode::size(300)->generate($kode_transaksi); 
    }

    public function getDataPageLimit($page=null, $limit = null){
        $page = $page?$page:0;
        $limit = $limit?$limit:0;
        $page = intval($page);
        $limit = intval($limit);
        $data = Transaksi::skip($page*$limit)->take($limit)->get();
        $totalRow = Transaksi::count();
        if(count($data)>0)
            return response()->json(['data'=>$data, 'message'=>'success', 'page'=>$page, 'limit'=>$limit, 'total_row'=>$totalRow], 200);
        return response()->json(['message'=>'empty'], 401);
    }

    

    public function store(Request $req){
        $data = Transaksi::create([
            'id_status'=>$req->id_status,
            'id_pelanggan'=>$req->id_pelanggan,
            'id_pengusaha'=>$req->id_pengusaha,
            // 'id_shipping'=>$req->id_shipping,
            'tgl'=>$req->tgl,
            'total_qty'=>$req->total_qty,
            'subtotal_qty'=>$req->subtotal_qty,
            'pajak'=>$req->pajak,
            'diskon'=>$req->diskon,
            'biaya_tambahan'=>$req->biaya_tambahan,
            'biaya_pengiriman'=>$req->biaya_pengiriman,
            'total'=>$req->total,
            'keterangan'=>$req->keterangan
        ]);
        if($data){
            return response()->json([
                'data'=>$data,
                'Result'=>'Data has been stored'
            ], 200);
        }else{
            return response()->json([
                'Result'=> "Data failed to be stored"
            ], 401);
        }
    }
    public function validateTransaksi($request)
    {
        
        $validate = $request->validate( [
            'transaksi.id_status'=>'required',
            'transaksi.id_pelanggan'=> 'required',
            'transaksi.id_pengusaha' => 'required',
            // 'transaksi.id_shipping' => 'required',
            'transaksi.id_alamat' => 'required',
            'transaksi.tgl' => 'required',
            'transaksi.total_qty' => 'required',
            'transaksi.subtotal_qty' => 'required',
            'transaksi.pajak' => 'required',
            'transaksi.diskon' => 'required',
            'transaksi.biaya_tambahan' => 'required',
            'transaksi.total' => 'required',
            'transaksi.keterangan' => 'required',
        ]);
        return $validate;
    }
    public function validateDetailTransaksi($request){
        $validate = $request->validate([
            'detail_transaksi.*.id_user'=>'required',
            'detail_transaksi.*.id_pengusaha'=> 'required',
            'detail_transaksi.*.id_produk' => 'required',
            'detail_transaksi.*.harga' => 'required',
            'detail_transaksi.*.qty' => 'required',
            'detail_transaksi.*.diskon' => 'required',
            'detail_transaksi.*.total' => 'required'
        ]);
        return $validate;
        
        
    }
    //Create Transaksi By Pelanggan
    public function createTransaksi(Request $req){
        // dd($req->detail_transaksi);
        DB::beginTransaction();
        try {
            
            
            //Transaksi
            $inputTransaksi = $this->validateTransaksi($req)['transaksi'];
            // dd($remakeIdPelanggan);
            //Make Random Code Transaction
            $remakeIdPelanggan = explode('-', $inputTransaksi['id_pelanggan'])[3];
            $random_number = intval(rand(1,9) . rand(0,9)); 
            $date = date('ds');
            $inputTransaksi['kode_transaksi'] = "#yunit_".$random_number.$remakeIdPelanggan.$date;
            

            //Create Transaksi
            $transaksi = Transaksi::create($inputTransaksi);
            // dd($transaksi->id_status);
            

            //Create Detail Transaksi
            $inputDetailTransaksi = $this->validateDetailTransaksi($req)['detail_transaksi'];
            // dd($inputDetailTransaksi);
            foreach ($inputDetailTransaksi as $item ) { 
                $item['id_transaksi'] = $transaksi->id;
                // dd($item);
                $detail_transaksi = DetailTransaksi::create($item);
            }

            //Create New Status Transaksi
            $status_transaksi = Status::where('id', $transaksi->id_status)->first(['id','nama']);
            $updateStatusTransaksi = StatusTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'nama' => $status_transaksi->nama,
                'keterangan' => $transaksi->keterangan,
                'tipe' => 'transaksi',
                'id_user' => $transaksi->id_pengusaha,
                'updated_by' => 'Pelanggan'
            ]);
            // dd($updateStatusTransaksi);



            //Comit DB
            DB::commit();

            return response()->json([
                'data'=> $transaksi,
                
                'Result'=>'Transaksi has been created!'
            ], 200);
            
        } catch (HttpResponseException $e) {
            // dd($e->getResponse());
            // report($e);
            
            // return $e->getResponse();


            if($e){
                throw new HttpResponseException(response()->json($e, 422));
            }else{
                throw $e;
            }
        }

    }

    public function updateTransaksiByKurir(Request $req){
        DB::beginTransaction();
        try{
            //Send by mobile id_transaksi
            //sequence 


            // update Transaksi

            // update Status Transaksi


        }catch(\Exception $e){
            throw new HttpResponseException(response()->json($e->errors(), 422));
        }


    } 
    public function updateTransaksiByPelanggan(Request $req){
        DB::beginTransaction();
        try{
            
        }catch(\Exception $e){
            throw new HttpResponseException(response()->json($e->errors(), 422));
        }

        
    }

    public function update(Request $r){
        $data = Transaksi::where("id", $r->id)->update([
            'id_status'=>$req->id_status,
            'id_pelanggan'=>$req->id_pelanggan,
            'id_pengusaha'=>$req->id_pengusaha,
            'id_shipping'=>$req->id_shipping,
            'tgl'=>$req->tgl,
            'total_qty'=>$req->total_qty,
            'subtotal_qty'=>$req->subtotal_qty,
            'pajak'=>$req->pajak,
            'diskon'=>$req->diskon,
            'biaya_tambahan'=>$req->biaya_tambahan,
            'biaya_pengiriman'=>$req->biaya_pengiriman,
            'total'=>$req->total,
            'keterangan'=>$req->keterangan
        ]);
        if($data){
            return response()->json(['Result'=>"Data has been Updated"], 200);
        }else{
            return response()->json(['Result'=>'Data failed to be updated'], 401);
        }
    }
    public function destroy ($id){
        $data = Transaksi::where('id', $id)->delete();
        if($data){
            return response()->json(['Result'=>"Data has been deleted"], 200);
        }else{
            return response()->json(['Result'=>"Data failed to be deleted"], 401);
        }
    }
}