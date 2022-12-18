<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\CustomFunction\StatusLaundry;

use DB;

use App\Models\{Transaksi};

class DashboardWebController extends Controller
{
    public function testSoal(){
        $pageTitle = "Test";
        return view('testSoal.index', compact('pageTitle'));
    }
    
    public function requestStatusTransaksiByMonth(Request $req){
        

        $idPengusaha = session()->get('id');

        $totalByStatusTransaksi =   DB::table('transaksi')
                                    ->leftJoin('status','transaksi.id_status', 'status.id')
                                    ->where('transaksi.tgl','LIKE',$req->month."%")
                                    ->where('transaksi.id_pengusaha', $idPengusaha)
                                    ->whereNull('transaksi.deleted_at')
                                    // ->where('transaksi.created_at', 'LIKE 2020-04%')
                                    ->select('status.nama', DB::raw('count(status.nama) as total_status'))
                                    ->groupBy('transaksi.id_status')
                                    ->get();
        
        
        return response()->json(['success' => true, 'data' => $totalByStatusTransaksi]);
        
    }
    public function requestTransaksiSelesaiByYear(Request $req){
        // dd($req);
        $idPengusaha = session()->get('id');
        $groupByMonth = "YEAR(created_at),MONTH(created_at)";
        $year = $req->year;
        $finish = DB::table('status')->orderBy('sequence','desc')->first(['id', 'nama']);
        // dd($finish);
        $getByMonth = DB::table('transaksi')
                      ->where('id_pengusaha', $idPengusaha)
                      ->where('id_status', $finish->id)
                      ->where('created_at','LIKE',$year."%")
                      ->selectRaw("YEAR(created_at) as Year, MONTH(created_at) as month, count(id) as value")
                      ->groupByRaw($groupByMonth)
                      ->get();
        $getByMonth = $this->convertDateArray($getByMonth);

        return response()->json(['success' => true, 'data' => $getByMonth]);
    }
    public function requestAdminTransaksiSelesaiByYear(Request $req){
        // dd($req);
        // $idPengusaha = session()->get('id');
        $groupByMonth = "YEAR(created_at),MONTH(created_at)";
        $year = $req->year;
        $finish = DB::table('status')->orderBy('sequence','desc')->first(['id', 'nama']);
        // dd($finish);
        $getByMonth = DB::table('transaksi')
                    //   ->where('id_pengusaha', $idPengusaha)
                      ->where('id_status', $finish->id)
                      ->where('created_at','LIKE',$year."%")
                      ->selectRaw("YEAR(created_at) as Year, MONTH(created_at) as month, count(id) as value")
                      ->groupByRaw($groupByMonth)
                      ->get();
        $getByMonth = $this->convertDateArray($getByMonth);

        return response()->json(['success' => true, 'data' => $getByMonth]);
    }
    public function dashboardAdmin(){
        
        $totalPelanggan = DB::table('transaksi')
                    ->select(DB::raw('count(distinct(id_pelanggan)) as total_pelanggan'))
                    ->whereNull('deleted_at')
                    ->groupBy('id_pelanggan')    
                    ->get()
                    ->sum('total_pelanggan'); 
        // dd($totalPelanggan);
                    
        $totalPendapatan = DB::table('transaksi')
                           ->whereNull('deleted_at')
                           ->sum('total');
        $totalTransaksi = DB::table('transaksi')
                          ->whereNull('deleted_at')
                          ->get()
                          ->count();

        $totalByStatusTransaksi =   DB::table('transaksi')
                                    ->leftJoin('status','transaksi.id_status', 'status.id')
                                    ->whereNull('transaksi.deleted_at')
                                    // ->where('transaksi.created_at', 'LIKE 2020-04%')
                                    ->select('status.nama', DB::raw('count(status.nama) as total_status'))
                                    ->groupBy('transaksi.id_status')
                                    ->get();

        $averageRating = DB::table('rating')
                         ->avg('nilai');
        $totalRating = DB::table('rating')
                        ->count();

        $groupByMonth = "YEAR(created_at),MONTH(created_at)";
        $year = "2022";
        $finish = DB::table('status')->orderBy('sequence','desc')->first(['id', 'nama']);
        // dd($finish);
        $getByMonth = DB::table('transaksi')
                      ->where('id_status', $finish->id)
                      ->where('created_at','LIKE',$year."%")
                      ->selectRaw("YEAR(created_at) as Year, MONTH(created_at) as month, count(id) as value")
                      ->groupByRaw($groupByMonth)
                      ->get();
        $totalTransaksiByMonth = DB::table('transaksi')
                                 ->where('id_status', $finish->id)
                                 ->where('created_at', 'LIKE', $year."%")
                                 ->selectRaw("YEAR(created_at) as Year, MONTH(created_at) as month, sum(total) as value, count(total) as jlh_transaksi")
                                 ->groupBy('transaksi.total')
                                 ->get()
                                //  ->dd()
                                 ;
        

        $getByMonth = $this->convertDateArray($getByMonth);
        $totalTransaksiByMonth = $this->convertDateArray($totalTransaksiByMonth);
        // dd($totalTransaksiByMonth);

        $getAllPengusaha = DB::table('pengusaha')
                            ->whereNull('deleted_at')
                            ->get(['nama','alamat','latitude','longitude']);
        // dd($getAllPengusaha);
        
        
        return view('adminView.dashboard.admin', compact(
            'getByMonth',
            'getAllPengusaha',
            'totalPelanggan',
            'totalPendapatan',
            'totalTransaksi',
            'totalByStatusTransaksi',
            'averageRating',
            'totalRating',
            'totalTransaksiByMonth'
        ));
    }

    public function DashboardPengusaha(){
        $idPengusaha = session()->get('id');
        $getUser = DB::table('pengusaha')->where('email', session()->get('email'))->first();
        // dd($getUser);
        $totalPelanggan = DB::table('transaksi')
                    ->select(DB::raw('count(distinct(id_pelanggan)) as total_pelanggan'))
                    ->where('id_pengusaha', $idPengusaha)
                    ->whereNull('deleted_at')
                    ->groupBy('id_pelanggan')
                    ->get()
                    ->sum('total_pelanggan'); 
                    
        $totalPendapatan = DB::table('transaksi')
                           ->where('id_pengusaha', $idPengusaha)
                           ->whereNull('deleted_at')
                           ->sum('total');
        $totalTransaksi = DB::table('transaksi')
                          ->where('id_pengusaha', $idPengusaha)
                          ->whereNull('deleted_at')
                          ->get()
                          ->count();
        $totalByStatusTransaksi =   DB::table('transaksi')
                                    ->leftJoin('status','transaksi.id_status', 'status.id')
                                    ->where('transaksi.id_pengusaha', $idPengusaha)
                                    ->whereNull('transaksi.deleted_at')
                                    // ->where('transaksi.created_at', 'LIKE 2020-04%')
                                    ->select('status.nama', DB::raw('count(status.nama) as total_status'))
                                    ->groupBy('transaksi.id_status')
                                    ->get();

        $averageRating = DB::table('rating')
                         ->where('id_pengusaha', $idPengusaha)
                         ->avg('nilai');
        $totalRating = DB::table('rating')
                        ->where('id_pengusaha', $idPengusaha)
                        ->count();
        // dd($averageRating);
                         
        // dd($totalByStatusTransaksi->sum('total_status'));

        // $totalByStatusTransaksi =  $this->rebuildArrayStatusTransaksi($totalByStatusTransaksi);

        $groupByMonth = "YEAR(created_at),MONTH(created_at)";
        $year = "2022";
        $finish = DB::table('status')->orderBy('sequence','desc')->first(['id', 'nama']);
        // dd($finish);
        $getByMonth = DB::table('transaksi')
                      ->where('id_pengusaha', $idPengusaha)
                      ->where('id_status', $finish->id)
                      ->where('created_at','LIKE',$year."%")
                      ->selectRaw("YEAR(created_at) as Year, MONTH(created_at) as month, count(id) as value")
                      ->groupByRaw($groupByMonth)
                      ->get();
        // dd($getByMonth);
        // $getByMonth = DB::table('transaksi')
        //               ->leftJoin('status','transaksi.id_status', 'status.id')
        //               ->where('transaksi.id_pengusaha', $idPengusaha)
        //               ->where('transaksi.created_at','LIKE',$year."%")
        //               ->selectRaw("YEAR(transaksi.created_at) as Year, MONTH(transaksi.created_at) as month, status.nama, count(status.nama) as total_status")
        //               ->groupByRaw('transaksi.id_status')
        //               ->groupByRaw($groupByMonth)
        //               ->get()
        //               ->dd();

        $getByMonth = $this->convertDateArray($getByMonth);


        // $groupby = "CAST(created_at as DATE)";
        // $byDateFinish = ChatSessionModels::selectRaw("$groupby AS Date, count(id) AS QTY")
        //                 ->where("created_at","LIKE",date("Y-m",strtotime($year."-".$month))."%")
        //                 ->where('status','Finish')->groupByRaw($groupby)->get();
        // $byDateDisconnected = ChatSessionModels::selectRaw("$groupby AS Date, count(id) AS QTY")
        //                         ->where("created_at","LIKE",date("Y-m",strtotime($year."-".$month))."%")
        //                         ->where('status','Disconnected')->groupByRaw($groupby)->get();
        // $groupMonth = "YEAR(created_at),MONTH(created_at)";
        // $monthlyFinish = ChatSessionModels::selectRaw("YEAR(created_at) AS Year,Month(created_at) as month,count(id) AS QTY")
        //                 ->where('created_at','LIKE',$year."%")
        //                 ->where('status','Finish')->groupByRaw($groupMonth)->get();
        // $monthlyDisconnected = ChatSessionModels::selectRaw("YEAR(created_at) AS Year,Month(created_at) as month,count(id) AS QTY")
        //                         ->where('created_at','LIKE',$year."%")
        //                         ->where('status','Disconnected')->groupByRaw($groupMonth)->get();
        
        // dd($totalByStatusTransaksi);
        // $statusLaundry = new StatusLaundry;
        // $statusLaundry = $statusLaundry->cekStatus();
        // dd($statusLaundry);
        
        return view('adminView.dashboard.pengusaha', compact(
            'getUser',
            'getByMonth',
            'totalPelanggan',
            'totalPendapatan',
            'totalTransaksi',
            'totalByStatusTransaksi',
            'averageRating',
            'totalRating'
        ));
    }
    public function convertDateArray($data){
        $newArray = array();
        // $itemArray = new \ArrayObject();
        // dd($data);
        foreach ($data as $item ) {
            $itemArray = new \stdClass();
            $itemArray->y = date('F', strtotime($item->Year.'-'.$item->month.'-1'));
            $itemArray->yM = date('Y-m', strtotime($item->Year.'-'.$item->month.'-1')); 
            $itemArray->jumlah = $item->value;
            // dd($itemArray);
            array_push($newArray, $itemArray);
        }
        // dd($newArray);
        return $newArray;
    }
    public function rebuildArrayStatusTransaksi($data){
        $newArray = array();
        dd('test',$data);
        // foreach ($data as $item ) {
        //     $itemArray = {
        //         $item->nama, $item->total_status
        //     };

        //     array_push($newArray, $itemArray);

        // }
        return $newArray;
    }
}