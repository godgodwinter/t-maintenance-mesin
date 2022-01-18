<?php

use App\Http\Controllers\adminapicontroller;
use App\Http\Controllers\admincetakcontroller;
use App\Http\Controllers\admindashboardcontroller;
use App\Http\Controllers\admingedungcontroller;
use App\Http\Controllers\admingrafikcontroller;
use App\Http\Controllers\adminkategoricontroller;
use App\Http\Controllers\adminkriteriacontroller;
use App\Http\Controllers\adminkriteriadetailcontroller;
use App\Http\Controllers\adminmaintenancecontroller;
use App\Http\Controllers\adminmesincontroller;
use App\Http\Controllers\adminmonitoringcontroller;
use App\Http\Controllers\adminnotifcontroller;
use App\Http\Controllers\adminpelaporankerusakancontroller;
use App\Http\Controllers\adminpelatihcontroller;
use App\Http\Controllers\adminpemaincontroller;
use App\Http\Controllers\adminpemainseleksicontroller;
use App\Http\Controllers\adminpenilaiancontroller;
use App\Http\Controllers\adminpenilaiandetailcontroller;
use App\Http\Controllers\adminposisipemaincontroller;
use App\Http\Controllers\adminposisiseleksicontroller;
use App\Http\Controllers\adminprosesperhitungancontroller;
use App\Http\Controllers\adminseedercontroller;
use App\Http\Controllers\adminseederthcontroller;
use App\Http\Controllers\adminsettingscontroller;
use App\Http\Controllers\admintahunpenilaiancontroller;
use App\Http\Controllers\admintahunpenilaiandetailcontroller;
use App\Http\Controllers\adminuserscontroller;
use App\Http\Controllers\landingcontroller;
use App\Http\Controllers\pelatihtahunpenilaiancontroller;
use App\Http\Controllers\pemaintahunpenilaiancontroller;
use App\Http\Controllers\profilecontroller;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Facades\Yugo\SMSGateway\Interfaces\SMS;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


Route::get('/', [landingcontroller::class, 'index']);


//halaman admin fixed
Route::group(['middleware' => ['auth:web', 'verified']], function() {

    //DASHBOARD-MENU
    Route::get('/dashboard', [admindashboardcontroller::class, 'index'])->name('dashboard');
    //settings
    Route::get('/admin/settings', [adminsettingscontroller::class, 'index'])->name('settings');
    Route::put('/admin/settings/{id}', [adminsettingscontroller::class, 'update'])->name('settings.update');


    Route::get('/admin/profile', [adminsettingscontroller::class, 'profile'])->name('profile');
    Route::put('/admin/profile/admin/update', [adminsettingscontroller::class, 'profileupdate'])->name('profileupdate');

    Route::get('/pelatih/profile/', [profilecontroller::class, 'pelatih'])->name('pelatih.profile');
    Route::put('/pelatih/profile/update', [profilecontroller::class, 'pelatihupdate'])->name('pelatih.profileupdate');

    Route::get('/pemain/profile/', [profilecontroller::class, 'pemain'])->name('pemain.profile');
    Route::put('/pemain/profile/update', [profilecontroller::class, 'pemainupdate'])->name('pemain.profileupdate');

    //MASTERING
    //USER
    Route::get('/admin/users', [adminuserscontroller::class, 'index'])->name('users');
    Route::get('/admin/users/{id}', [adminuserscontroller::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{id}', [adminuserscontroller::class, 'update'])->name('users.update');
    Route::delete('/admin/users/{id}', [adminuserscontroller::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/datausers/cari', [adminuserscontroller::class, 'cari'])->name('users.cari');
    Route::get('/admin/datausers/create', [adminuserscontroller::class, 'create'])->name('users.create');
    Route::post('/admin/datausers', [adminuserscontroller::class, 'store'])->name('users.store');
    Route::delete('/admin/datausers/multidel', [adminuserscontroller::class, 'multidel'])->name('users.multidel');


    //gedung
    Route::get('/admin/gedung', [admingedungcontroller::class, 'index'])->name('gedung');
    Route::get('/admin/gedung/{id}', [admingedungcontroller::class, 'edit'])->name('gedung.edit');
    Route::put('/admin/gedung/{id}', [admingedungcontroller::class, 'update'])->name('gedung.update');
    Route::delete('/admin/gedung/{id}', [admingedungcontroller::class, 'destroy'])->name('gedung.destroy');
    Route::get('/admin/datagedung/cari', [admingedungcontroller::class, 'cari'])->name('gedung.cari');
    Route::get('/admin/datagedung/create', [admingedungcontroller::class, 'create'])->name('gedung.create');
    Route::post('/admin/datagedung', [admingedungcontroller::class, 'store'])->name('gedung.store');


    //kategori
    Route::get('/admin/kategori', [adminkategoricontroller::class, 'index'])->name('kategori');
    Route::get('/admin/kategori/{id}', [adminkategoricontroller::class, 'edit'])->name('kategori.edit');
    Route::put('/admin/kategori/{id}', [adminkategoricontroller::class, 'update'])->name('kategori.update');
    Route::delete('/admin/kategori/{id}', [adminkategoricontroller::class, 'destroy'])->name('kategori.destroy');
    Route::get('/admin/datakategori/cari', [adminkategoricontroller::class, 'cari'])->name('kategori.cari');
    Route::get('/admin/datakategori/create', [adminkategoricontroller::class, 'create'])->name('kategori.create');
    Route::post('/admin/datakategori', [adminkategoricontroller::class, 'store'])->name('kategori.store');


    //mesin
    Route::get('/admin/mesin', [adminmesincontroller::class, 'index'])->name('mesin');
    Route::get('/admin/mesin/{id}', [adminmesincontroller::class, 'edit'])->name('mesin.edit');
    Route::put('/admin/mesin/{id}', [adminmesincontroller::class, 'update'])->name('mesin.update');
    Route::delete('/admin/mesin/{id}', [adminmesincontroller::class, 'destroy'])->name('mesin.destroy');
    Route::get('/admin/datamesin/cari', [adminmesincontroller::class, 'cari'])->name('mesin.cari');
    Route::get('/admin/datamesin/create', [adminmesincontroller::class, 'create'])->name('mesin.create');
    Route::post('/admin/datamesin', [adminmesincontroller::class, 'store'])->name('mesin.store');


    //monitoring
    Route::get('/admin/monitoring', [adminmonitoringcontroller::class, 'index'])->name('monitoring');
    Route::get('/admin/monitoring/{id}', [adminmonitoringcontroller::class, 'edit'])->name('monitoring.edit');
    Route::put('/admin/monitoring/{id}', [adminmonitoringcontroller::class, 'update'])->name('monitoring.update');
    Route::delete('/admin/monitoring/{id}', [adminmonitoringcontroller::class, 'destroy'])->name('monitoring.destroy');
    Route::get('/admin/datamonitoring/cari', [adminmonitoringcontroller::class, 'cari'])->name('monitoring.cari');
    Route::get('/admin/datamonitoring/create', [adminmonitoringcontroller::class, 'create'])->name('monitoring.create');
    Route::post('/admin/datamonitoring', [adminmonitoringcontroller::class, 'store'])->name('monitoring.store');


    //pelaporankerusakan
    Route::get('/admin/pelaporankerusakan', [adminpelaporankerusakancontroller::class, 'index'])->name('pelaporankerusakan');
    Route::get('/admin/pelaporankerusakan/{id}', [adminpelaporankerusakancontroller::class, 'edit'])->name('pelaporankerusakan.edit');
    Route::put('/admin/pelaporankerusakan/{id}', [adminpelaporankerusakancontroller::class, 'update'])->name('pelaporankerusakan.update');
    Route::delete('/admin/pelaporankerusakan/{id}', [adminpelaporankerusakancontroller::class, 'destroy'])->name('pelaporankerusakan.destroy');
    Route::get('/admin/datapelaporankerusakan/cari', [adminpelaporankerusakancontroller::class, 'cari'])->name('pelaporankerusakan.cari');
    Route::get('/admin/datapelaporankerusakan/create', [adminpelaporankerusakancontroller::class, 'create'])->name('pelaporankerusakan.create');
    Route::post('/admin/datapelaporankerusakan', [adminpelaporankerusakancontroller::class, 'store'])->name('pelaporankerusakan.store');


    //maintenance
    Route::get('/admin/maintenance', [adminmaintenancecontroller::class, 'index'])->name('maintenance');
    Route::get('/admin/maintenance/{id}', [adminmaintenancecontroller::class, 'edit'])->name('maintenance.edit');
    Route::put('/admin/maintenance/{id}', [adminmaintenancecontroller::class, 'update'])->name('maintenance.update');
    Route::delete('/admin/maintenance/{id}', [adminmaintenancecontroller::class, 'destroy'])->name('maintenance.destroy');
    Route::get('/admin/datamaintenance/cari', [adminmaintenancecontroller::class, 'cari'])->name('maintenance.cari');
    Route::get('/admin/datamaintenance/create', [adminmaintenancecontroller::class, 'create'])->name('maintenance.create');
    Route::post('/admin/datamaintenance', [adminmaintenancecontroller::class, 'store'])->name('maintenance.store');

    //API
    Route::get('/admin/api/kriteriadetail/{tahunpenilaian}', [admintahunpenilaiandetailcontroller::class, 'apikriteriadetail'])->name('api.kriteriadetail');
    Route::get('/admin/api/periksaminimum/{tahunpenilaian}', [admintahunpenilaiandetailcontroller::class, 'apiperiksaminimum'])->name('api.periksaminimum');
    Route::get('/admin/api/pemainseleksi/inputnilai/{tahunpenilaian}', [adminapicontroller::class, 'pemainseleksi_inputnilai'])->name('api.pemainseleksi.inputnilai');

    Route::get('/admin/api/nilaipersiswa/{prosespenilaian}/{pemainseleksi}/{kriteriadetail}', [adminapicontroller::class, 'nilaipersiswa'])->name('api.nilaipersiswa');



    //seeder
    Route::post('/admin/seeder/hard', [adminseedercontroller::class, 'hard'])->name('seeder.hard');

    Route::post('/admin/proses/cleartemp', [adminprosescontroller::class, 'cleartemp'])->name('cleartemp');



});


