<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\maintenance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminmaintenancecontroller extends Controller
{
    public function index(Request $request)
    {
        #WAJIB
        $pages='maintenance';
        $datas=maintenance::with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.maintenance.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='maintenance';
        $datas=maintenance::where('nama','like',"%".$cari."%")
        ->with('users')
        ->paginate(Fungsi::paginationjml());

        return view('pages.admin.maintenance.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='maintenance';
        $users=User::where('tipeuser','=','operator')->get();
        return view('pages.admin.maintenance.create',compact('pages','users'));
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

            $getid=DB::table('maintenance')->insertGetId(
                array(
                       'tgl'     =>   $request->tgl,
                       'users_id'     =>   $request->users_id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('maintenance')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(maintenance $id)
    {
        $pages='maintenance';
        $users=User::where('tipeuser','=','operator')->get();

        return view('pages.admin.maintenance.edit',compact('pages','id','users'));
    }
    public function update(maintenance $id,Request $request)
    {


        $request->validate([
            'tgl'=>'required',
        ],
        [
            'tgl.required'=>'name harus diisi',
        ]);


            maintenance::where('id',$id->id)
            ->update([
                'tgl'     =>   $request->tgl,
                'users_id'     =>   $request->users_id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('maintenance')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(maintenance $id){

        maintenance::destroy($id->id);
        return redirect()->route('maintenance')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
}
