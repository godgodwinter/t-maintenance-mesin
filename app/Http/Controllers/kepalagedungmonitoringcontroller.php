<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\monitoring;
use App\Models\monitoringdetail;
use Illuminate\Http\Request;

class kepalagedungmonitoringcontroller extends Controller
{
    protected $queryid;
    public function index(Request $request)
    {
        #WAJIB
        $pages='monitoring';
        $datas=monitoring::with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.kepalagedung.monitoring.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='monitoring';
        $datas=monitoring::where('nama','like',"%".$cari."%")
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.kepalagedung.monitoring.index',compact('datas','request','pages'));
    }
    public function detail(monitoring $id,Request $request)
   {
       // dd($id);
       $pages='monitoring';
       $datas=monitoringdetail::with('monitoring')->where('monitoring_id',$id->id)
       ->paginate(Fungsi::paginationjml());
       return view('pages.kepalagedung.monitoring.detail',compact('pages','id','datas','request'));

   }
}
