<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Http\Controllers\Controller;
use DB;

class RatingWebController extends Controller
{
   
    public function index()
    {
        $tipeUserLogin = session()->get('tipe');
        if($tipeUserLogin == 'Pengusaha'){
            $data = Rating::select('rating.*','pelanggan.nama as nama_pelanggan')
                    ->leftJoin('pelanggan','pelanggan.id','rating.id_pelanggan')
                    ->where("id_pengusaha", session()->get('id'))
                    ->get();
            return view('adminView.rating.index_pengusaha', compact('data'));
        }else{
            $data = Rating::select('rating.*','pelanggan.nama as nama_pelanggan', 'pengusaha.nama as nama_pengusaha')
                    ->leftJoin('pengusaha','pengusaha.id', 'rating.id_pengusaha')
                    ->leftJoin('pelanggan','pelanggan.id','rating.id_pelanggan')
                    ->get();
            return view('adminView.rating.index_admin', compact('data'));
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}