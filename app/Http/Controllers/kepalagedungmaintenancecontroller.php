<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\maintenance;
use App\Models\maintenancedetail;
use Illuminate\Http\Request;

class kepalagedungmaintenancecontroller extends Controller
{
    protected $queryid;
    public function index(Request $request)
    {
        #WAJIB
        $pages='maintenance';
        $datas=maintenance::with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.kepalagedung.maintenance.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='maintenance';
        $datas=maintenance::where('nama','like',"%".$cari."%")
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.kepalagedung.maintenance.index',compact('datas','request','pages'));
    }
    public function detail(maintenance $id,Request $request)
   {
       // dd($id);
       $pages='maintenance';
       $datas=maintenancedetail::with('maintenance')->with('pelaporankerusakandetail')->where('maintenance_id',$id->id)
       ->paginate(Fungsi::paginationjml());
       return view('pages.kepalagedung.maintenance.detail',compact('pages','id','datas','request'));

   }
}
