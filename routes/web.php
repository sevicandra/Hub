<?php
use Illuminate\Http\Request;
use App\Models\laporanPenilaian;
use App\Http\Controllers\kinerja;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cetakDokumen;
use App\Http\Controllers\backController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\tiketController;
use App\Http\Controllers\agendaController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\permohonanController;
use App\Http\Controllers\LaporanPenilaianController;
use App\Http\Controllers\SuratPersetujuanController;
use App\Http\Controllers\PenyampaianLaporanController;
use App\Http\Controllers\PermohonanPenilaianController;
use App\Http\Controllers\IdikatorKinerjaUtamaController;
use App\Http\Controllers\PemberitahuanPenilaianController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/register', [registerController::class, 'store'])->middleware('guest');

Route::post('/login', [loginController::class, 'login'])->middleware('guest');

Route::post('/logout', [loginController::class, 'logout'])->middleware('auth');

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('/home', [loginController::class, 'home'])->middleware('auth');

Route::get('/register', function() {
    return view('register');
})->middleware('guest');

Route::post('/asd', [agendaController::class, 'agenda'])->middleware('auth');

Route::get('/test', function() {
    return view('test');
});

Route::resource('/pindai', tiketController::class)->middleware('auth');

Route::resource('/permohonan', permohonanController::class)->middleware('auth');

Route::resource('/barang', barangController::class)->middleware('auth');

Route::resource('/penilaian', PermohonanPenilaianController::class)->middleware('auth');

Route::resource('/laporanpenilaian', LaporanPenilaianController::class)->middleware('auth');

Route::resource('/pemberitahuanpenilaian', PemberitahuanPenilaianController::class)->middleware('auth');

Route::resource('/penyampaianlaporan', PenyampaianLaporanController::class)->middleware('auth');

Route::resource('/persetujuan', SuratPersetujuanController::class)->middleware('auth');

Route::resource('/praktis', IdikatorKinerjaUtamaController::class);


Route::post('/test', function(Request $request) {
    //
    return $request;
});

Route::controller(cetakDokumen::class)->group(function(){
    Route::post('/cetak', 'cetakPermohonanSKSTPenilai')->middleware('auth');
});

Route::controller(backController::class)->group(function(){
    Route::get('/timpenilai/{timpenilai}', 'anggotaTimPenilai')->middleware('auth');
    Route::get('/listTim', 'listTim')->middleware('auth');
    Route::post('/hapusanggota', 'hapusanggota')->middleware('auth');
    Route::post('/nilailimit', 'nilaiLimit')->middleware('auth');
    Route::post('/penetapanLimit', 'penetapanLimit')->middleware('auth');
    
        
});


Route::get('/test', function() {
    return view('praktisCapaian');
});


Route::controller(kinerja::class)->group(function(){
    Route::post('/inputTarget', 'inputTarget')->middleware('auth');
    Route::post('/updateTarget', 'updateTarget')->middleware('auth');
    Route::post('/inputCapaian', 'inputCapaian')->middleware('auth');
    Route::get('/monitoring', 'monitoring')->middleware('auth');
    Route::get('/monitoring/{monitoring}', 'monitoringindividu')->middleware('auth');
    Route::post('/capkin/{capkin}', 'hapusCapkin');
    
});




