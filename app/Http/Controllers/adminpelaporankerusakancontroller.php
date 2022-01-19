<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\pelaporankerusakan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminpelaporankerusakancontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='pelaporankerusakan';
        $datas=pelaporankerusakan::with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.pelaporankerusakan.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='pelaporankerusakan';
        $datas=pelaporankerusakan::where('nama','like',"%".$cari."%")
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.pelaporankerusakan.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='pelaporankerusakan';
        $users=User::where('tipeuser','=','operator')->get();
        return view('pages.admin.pelaporankerusakan.create',compact('pages','users'));
    }

    public function store(Request $request)
    {

        // dd($request);
            $request->validate([
                'tgl'=>'required',

            ],
            [
                'tgl.required'=>'tgl harus diisi',
            ]);

            $getid=DB::table('pelaporankerusakan')->insertGetId(
                array(
                       'tgl'     =>   $request->tgl,
                       'users_id'     =>   $request->users_id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('pelaporankerusakan')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(pelaporankerusakan $id)
    {
        $pages='pelaporankerusakan';
        $users=User::where('tipeuser','=','operator')->get();

        return view('pages.admin.pelaporankerusakan.edit',compact('pages','id','users'));
    }
    public function update(pelaporankerusakan $id,Request $request)
    {


        $request->validate([
            'tgl'=>'required',
        ],
        [
            'tgl.required'=>'name harus diisi',
        ]);


            pelaporankerusakan::where('id',$id->id)
            ->update([
                'tgl'     =>   $request->tgl,
                'users_id'     =>   $request->users_id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('pelaporankerusakan')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(pelaporankerusakan $id){

        pelaporankerusakan::destroy($id->id);
        return redirect()->route('pelaporankerusakan')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
