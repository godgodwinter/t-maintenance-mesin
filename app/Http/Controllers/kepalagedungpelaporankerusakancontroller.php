<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\pelaporankerusakan;
use App\Models\pelaporankerusakandetail;
use Illuminate\Http\Request;

class kepalagedungpelaporankerusakancontroller extends Controller
{
    protected $queryid;
    public function index(Request $request)
    {
        #WAJIB
        $pages='pelaporankerusakan';
        $datas=pelaporankerusakan::with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.kepalagedung.pelaporankerusakan.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='pelaporankerusakan';
        $datas=pelaporankerusakan::where('nama','like',"%".$cari."%")
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.kepalagedung.pelaporankerusakan.index',compact('datas','request','pages'));
    }
    public function detail(pelaporankerusakan $id,Request $request)
   {
       // dd($id);
       $pages='pelaporankerusakan';
       $datas=pelaporankerusakandetail::with('pelaporankerusakan')->where('pelaporankerusakan_id',$id->id)
       ->paginate(Fungsi::paginationjml());
       return view('pages.kepalagedung.pelaporankerusakan.detail',compact('pages','id','datas','request'));

   }
}
