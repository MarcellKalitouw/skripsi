<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class DashboardWebController extends Controller
{
    public function DashboardPengusaha(){
        $getUser = DB::table('pengusaha')->where('email', session()->get('email'))->first();
        // dd($getUser);
        
        return view('adminView.dashboard.pengusaha', compact('getUser'));
    }
}