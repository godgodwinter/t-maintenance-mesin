<?php

namespace App\Http\Controllers;

use App\Helpers\Fungsi;
use App\Models\maintenance;
use App\Models\maintenancedetail;
use App\Models\pelaporankerusakandetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class operatormaintenancecontroller extends Controller
{
    protected $queryid;
    public function index(Request $request)
    {
        #WAJIB
        $pages='maintenance';
        $datas=maintenance::with('users')->where('users_id',Auth::user()->id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.maintenance.index',compact('datas','request','pages'));
    }
    public function cari(Request $request)
    {
        $cari=$request->cari;
        #WAJIB
        $pages='maintenance';
        $datas=maintenance::where('nama','like',"%".$cari."%")
        ->with('users')->where('users_id',Auth::user()->id)
        ->paginate(Fungsi::paginationjml());

        return view('pages.operator.maintenance.index',compact('datas','request','pages'));
    }
    public function create()
    {
        $pages='maintenance';
        $users=User::where('tipeuser','=','operator')->get();
        return view('pages.operator.maintenance.create',compact('pages','users'));
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
                       'users_id'     =>   Auth::user()->id,
                       'created_at'=>date("Y-m-d H:i:s"),
                       'updated_at'=>date("Y-m-d H:i:s")
                ));

    return redirect()->route('operator.maintenance')->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

    }

    public function edit(maintenance $id)
    {
        $pages='maintenance';
        $users=User::where('tipeuser','=','operator')->get();

        return view('pages.operator.maintenance.edit',compact('pages','id','users'));
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
                'users_id'     =>   Auth::user()->id,
               'updated_at'=>date("Y-m-d H:i:s")
            ]);


    return redirect()->route('operator.maintenance')->with('status','Data berhasil diubah!')->with('tipe','success')->with('icon','fas fa-feather');
    }
    public function destroy(maintenance $id){

        maintenance::destroy($id->id);
        maintenancedetail::where('maintenance_id', $id->id)->delete();
        return redirect()->route('operator.maintenance')->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

    }
    public function detail(maintenance $id,Request $request)
   {
       // dd($id);
       $pages='maintenance';
       $datas=maintenancedetail::with('maintenance')->with('pelaporankerusakandetail')->where('maintenance_id',$id->id)
       ->paginate(Fungsi::paginationjml());
       return view('pages.operator.maintenance.detail',compact('pages','id','datas','request'));

   }

   public function detailcreate(maintenance $id,Request $request)
   {
       // dd($id);
       $pages='maintenance';
    //    $mesin=pelaporankerusakandetail::with('mesin')->get();

       $this->queryid=$id->id;
       $pages='monitoring';
       $mesin=pelaporankerusakandetail::with('mesin')->whereNotIn('id',function($query){
               $query->select('pelaporankerusakandetail_id')->from('maintenancedetail')->where('maintenance_id',$this->queryid)->whereNull('deleted_at');
           })->get();
        //    dd($mesin);
       return view('pages.operator.maintenance.detailcreate',compact('pages','id','mesin','request'));

   }
   public function detailstore(maintenance $id,Request $request)
   {

       // dd($request);
           $request->validate([
               'keterangan'=>'required',

           ],
           [
               'keterangan.required'=>'keterangan harus diisi',
           ]);
           $getmesin_id=pelaporankerusakandetail::where('id',$request->pelaporankerusakandetail_id)->first();
           $getid=DB::table('maintenancedetail')->insertGetId(
               array(
                       'maintenance_id'     =>   $id->id,
                      'pelaporankerusakandetail_id'     =>   $request->pelaporankerusakandetail_id,
                      'mesin_id'     =>   $getmesin_id->mesin_id,
                      'keterangan'     =>   $request->keterangan,
                      'created_at'=>date("Y-m-d H:i:s"),
                      'updated_at'=>date("Y-m-d H:i:s")
               ));

   return redirect()->route('maintenance.detail',$id->id)->with('status','Data berhasil tambahkan!')->with('tipe','success')->with('icon','fas fa-feather');

   }
   public function detaildestroy(maintenance $id,maintenancedetail $maintenancedetail){

       maintenancedetail::destroy($maintenancedetail->id);
       return redirect()->route('operator.maintenance.detail',$id->id)->with('status','Data berhasil dihapus!')->with('tipe','warning')->with('icon','fas fa-feather');

   }
}
