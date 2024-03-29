<?php
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\chart;
use App\Http\Controllers\satker;
use App\Http\Controllers\kinerja;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cetakDokumen;
use App\Http\Controllers\backController;
use App\Http\Controllers\PnbpController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\loginController;
use App\Http\Controllers\tiketController;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\agendaController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\NotulaController;
use App\Http\Controllers\RisalahController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\KeputusanController;
use App\Http\Controllers\permohonanController;
use App\Http\Controllers\permohonanLelangLain;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\CapaianPnbpController;
use App\Http\Controllers\FileStorageController;
use App\Http\Controllers\RencanaAksiController;
use App\Http\Controllers\BarangLelangController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\PenetapanLelangController;
use App\Http\Controllers\LaporanPenilaianController;
use App\Http\Controllers\PermohonanLelangController;
use App\Http\Controllers\RisalahLotLelangController;
use App\Http\Controllers\SuratPersetujuanController;
use App\Http\Controllers\KepuasanPelangganController;
use App\Http\Controllers\KinerjaOrganisasiController;
use App\Http\Controllers\PenyampaianLaporanController;
use App\Http\Controllers\PermohonanPenilaianController;
use App\Http\Controllers\IdikatorKinerjaUtamaController;
use App\Http\Controllers\NominasiBestEmployeeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\PemilihanBestEmployeeController;
use App\Http\Controllers\AgendaLaporanPenilaianController;
use App\Http\Controllers\PemberitahuanPenilaianController;
use App\Http\Controllers\LaporanPelaksanaanTugasController;
use App\Http\Controllers\RekapitulasiBestEmployeeController;
use App\Http\Controllers\BeritaAcaraSurveiLapanganPenilaianController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\StatusPenggunaanController;
use App\Http\Controllers\WhatsappReportController;

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

Route::get('', function() {
    return redirect('/login');
});

Route::post('/register', [registerController::class, 'store'])->middleware('guest');

Route::post('/login', [loginController::class, 'login'])->middleware('guest');

Route::post('/logout', [loginController::class, 'logout'])->middleware('verified');

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('/home', [loginController::class, 'home'])->middleware('verified');

Route::get('/register', function() {
    return view('register');
})->middleware('guest');

Route::post('/asd', [agendaController::class, 'daftaragenda'])->middleware('verified');

Route::resource('/agenda', agendaController::class)->middleware('verified');

Route::resource('/pindai', tiketController::class)->middleware('verified');

Route::resource('/permohonan', permohonanController::class)->middleware('verified');

Route::resource('/barang', barangController::class)->middleware('verified');

Route::resource('/penilaian', PermohonanPenilaianController::class)->middleware('verified');

Route::resource('/laporanpenilaian', LaporanPenilaianController::class)->middleware('verified');

Route::resource('/pemberitahuanpenilaian', PemberitahuanPenilaianController::class)->middleware('verified');

Route::resource('/penyampaianlaporan', PenyampaianLaporanController::class)->middleware('verified');

Route::resource('/persetujuan', SuratPersetujuanController::class)->middleware('verified');

Route::resource('/praktis', IdikatorKinerjaUtamaController::class)->middleware('verified');

Route::resource('/kinerjaorganisasi', KinerjaOrganisasiController::class)->middleware('verified');

Route::resource('/pnbp', PnbpController::class)->middleware('verified');

Route::resource('/capaianPnbp', CapaianPnbpController::class)->middleware('verified');

Route::resource('/penetapan_lelang', PenetapanLelangController::class)->middleware('verified');

Route::resource('/risalah', RisalahController::class)->middleware('verified');

Route::resource('/barang_lelang', BarangLelangController::class)->middleware('verified');

Route::controller(cetakDokumen::class)->group(function(){
    Route::post('/cetak', 'cetak')->middleware('verified');
});

Route::controller(backController::class)->group(function(){
    Route::get('/timpenilai/{timpenilai}', 'anggotaTimPenilai')->middleware('verified');
    Route::get('/listTim', 'listTim')->middleware('verified');
    Route::post('/hapusanggota', 'hapusanggota')->middleware('verified');
    Route::post('/nilailimit', 'nilaiLimit')->middleware('verified');
    Route::post('/penetapanLimit', 'penetapanLimit')->middleware('verified'); 
    Route::PATCH('/hapusanggotaJFPP/{hapusanggotaJFPP}', 'hapusanggotaJFPP')->middleware('verified');
    Route::PATCH('/hapusbaslJFPP/{hapusbaslJFPP}', 'hapusbaslJFPP')->middleware('verified');   
});

// Permohonan Verifikasi Email Ulang
Route::get('/email/re-verify', function () {
    return view('auth.reverify-email');
})->middleware('auth')->name('verification.notice');

Route::controller(kinerja::class)->group(function(){
    Route::post('/inputTarget', 'inputTarget')->middleware('verified');
    Route::post('/updateTarget', 'updateTarget')->middleware('verified');
    Route::post('/inputCapaian', 'inputCapaian')->middleware('verified');
    Route::get('/monitoring', 'monitoring')->middleware('verified');
    Route::get('/monitoring/{monitoring}', 'monitoringindividu')->middleware('verified');
    Route::post('/capkin/{capkin}', 'hapusCapkin')->middleware('verified');
    Route::get('/monitoring-bawahan', 'monitoringBawahan')->middleware('verified');
});

Route::controller(chart::class)->group(function(){
    Route::POST('/NKO', 'NKO')->middleware('verified');
    Route::POST('/NKOTW', 'NKOTW')->middleware('verified');
    Route::POST('/PNBPPKN', 'PNBPPKN')->middleware('verified');
    Route::POST('/PNBPLLG', 'PNBPLLG')->middleware('verified');
    Route::POST('/PNBPPPN', 'PNBPPPN')->middleware('verified');
    Route::POST('/kepuasanPelanggan', 'kepuasanPelanggan')->middleware('verified');
});

Route::controller(SuratPersetujuanController::class)->group(function(){
    Route::get('potensi_lelang', 'potensi')->middleware('verified');
    Route::get('potensi_lelang/{potensi_lelang}', 'show')->middleware('verified');
});

Route::resource('/permohonan_lelang', PermohonanLelangController::class)->middleware('verified');

Route::resource('/satker', satker::class)->middleware('verified');

Route::resource('/survey', KepuasanPelangganController::class)->except(['create']);;

// Permohonan Verifikasi Email
Route::get('/email/verify', function () {
    if(auth()->user()->email_verified_at === null){
        return view('auth.verify-email');
    }else{
        return redirect('/home');
    }
})->middleware('auth')->name('verification.notice');

// Permohonan Verifikasi Email Ulang
Route::get('/email/re-verify', function () {
    if(auth()->user()->email_verified_at === null){
        return view('auth.reverify-email');
    }else{
        return redirect('/home');
    }
})->middleware('auth');

// Verifikasi Email
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if(auth()->user()->email_verified_at === null){
        $request->fulfill();
        return redirect('/home');
    }else{
        return redirect('/home');
    }
 
})->middleware(['auth', 'signed'])->name('verification.verify');

// Pengiriman Email Verifikasi
Route::post('/email/verification-notification', function (Request $request) {
    if(auth()->user()->email_verified_at === null){
        $request->user()->sendEmailVerificationNotification();
    }else{
        return redirect('/home');
    }
 
    return view('auth.verify-email')->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Reset Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// permohonan Reset Password 
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
 
    $status = Password::sendResetLink(
        $request->only('email')
    );
 
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// Reset Password Form
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// Reset Password
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
 
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
 
            $user->save();
 
            event(new PasswordReset($user));
        }
    );
 
    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Route::resource('/best_employee', PemilihanBestEmployeeController::class)->middleware('verified');

Route::controller(PemilihanBestEmployeeController::class)->group(function(){
    Route::get('/pemilihan_best_employee', 'pemilihan')->middleware('verified');
    Route::get('/best_employee_responden', 'responden')->middleware('verified');
    Route::get('/best_employee_responden/{best_employee_responden}', 'detailResponden')->middleware('verified');
});

Route::resource('/pilih_best_employee', RekapitulasiBestEmployeeController::class)->middleware('verified');

Route::resource('/nominasiBestEmployee', NominasiBestEmployeeController::class)->middleware('verified');

Route::resource('/user_management', UserManagementController::class)->middleware('verified');

Route::resource('rencana_aksi', RencanaAksiController::class)->middleware('verified');

Route::get('monitoring_rencana_aksi/{rencana_aksi}', [RencanaAksiController::class, 'monitoringRencanaAksi'])->middleware('verified');

Route::controller(permohonanLelangLain::class)->group(function(){
    Route::get('/permohonanlelang', 'index')->middleware('verified');
    Route::post('/permohonanlelang', 'store')->middleware('verified');
    Route::delete('/permohonanlelang/{permohonanlelang}', 'destroy')->middleware('verified');
    Route::post('/inputLot', 'storeLot')->middleware('verified');
    Route::delete('/lotLelang/{lotLelang}', 'destroyLot')->middleware('verified');
});

Route::resource('/lot_lelang', RisalahLotLelangController::class)->middleware('verified');

Route::resource('/digital-knowledge-management', FileStorageController::class)->except('show')->middleware('verified');

Route::resource('/digital-knowledge-management/keputusan', KeputusanController::class)->middleware('verified');

Route::resource('/digital-knowledge-management/presentasi', PresentasiController::class)->middleware('verified');

Route::resource('/digital-knowledge-management/laporan-pelaksanaan-tugas', LaporanPelaksanaanTugasController::class)->middleware('verified');

Route::resource('/digital-knowledge-management/notula', NotulaController::class)->middleware('verified');

Route::resource('/JFPP/LaporanPenilaian', AgendaLaporanPenilaianController::class)->middleware('verified');

Route::resource('/JFPP/BASL', BeritaAcaraSurveiLapanganPenilaianController::class)->middleware('verified');

Route::get('/JFPP', function(){
    return view('JFPP.index',[
        'JFPP'=>'',
        'favicon'=>'/img/ico/JFPP.png',
    ]);
});

Route::controller(ReminderController::class)->group(function(){
    Route::get('reminder/upcoming', 'upcoming')->middleware('verified');
    Route::get('reminder/recent', 'recent')->middleware('verified');
    Route::get('reminder', 'reminder')->middleware('verified');
    Route::post('reminder/{reminder}/view', 'view')->middleware('verified');
    Route::post('reminder', 'create')->middleware('verified');
    Route::delete('reminder/{reminder}', 'delete')->middleware('verified');
});

Route::get('survei/monitoring', [KepuasanPelangganController::class, 'create'])->middleware('verified');

Route::resource('/status-penggunaan', StatusPenggunaanController::class)->middleware('verified');

Route::get('surat-persetujuan/preview/{preview}',[SuratPersetujuanController::class, 'preview'])->middleware('verified');