<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\monitoring;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminmonitoringcontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='monitoring';
        $datas=monitoring::with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.monitoring.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='monitoring';
        $datas=monitoring::where('nama','like',"%".$cari."%")
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.monitoring.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='monitoring';
        $users=User::where('tipeuser','=','operator')->get();
        return view('pages.admin.monitoring.create',compact('pages','users'));
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

            $getid=DB::table('monitoring')->insertGetId(
                array(
                       'tgl'     =>   $request->tgl,
                       'users_id'     =>   $request->users_id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('monitoring')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(monitoring $id)
    {
        $pages='monitoring';
        $users=User::where('tipeuser','=','operator')->get();

        return view('pages.admin.monitoring.edit',compact('pages','id','users'));
    }
    public function update(monitoring $id,Request $request)
    {


        $request->validate([
            'tgl'=>'required',
        ],
        [
            'tgl.required'=>'name harus diisi',
        ]);


            monitoring::where('id',$id->id)
            ->update([
                'tgl'     =>   $request->tgl,
                'users_id'     =>   $request->users_id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('monitoring')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(monitoring $id){

        monitoring::destroy($id->id);
        return redirect()->route('monitoring')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
