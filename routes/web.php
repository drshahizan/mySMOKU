<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\SaringanController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\PenyelarasController;
use App\Http\Controllers\ProfilController;

use App\Http\Controllers\TuntutanController;
use App\Http\Controllers\PentadbirController;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PageController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });

   /*Route::name('permohonan.')->group(function () {
        //Route::get('/', [PermohonanController::class, 'permohonanbaru']);
        Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
        Route::post('post-permohonan', [PermohonanController::class, 'postPermohonan'])->name('permohonan.post'); 
        //Route::resource('/user-management/permissions', PermissionManagementController::class);
    });*/
    Route::get('profildiri', [ProfilController::class, 'profildiri'])->name('profil-diri');
    Route::post('profildiri', [ProfilController::class, 'store'])->name('profildiri.store');
    /*Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::post('post-permohonan', [PermohonanController::class, 'postPermohonan'])->name('permohonan.post'); */


    Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::get('/getBandar/{id}', [PermohonanController::class, 'getBandar']);
    Route::post('permohonan', [PermohonanController::class, 'simpanmohon'])->name('permohonan.post');
    Route::post('hantarpermohonan', [PermohonanController::class, 'hantarpermohonan'])->name('hantarpermohonan');
    Route::get('viewpermohonan', [PermohonanController::class, 'viewpermohonan'])->name('viewpermohonan');
    Route::get('/download/{file}',[PermohonanController::class,'download']);
    Route::get('kemaskini',[PermohonanController::class,'kemaskini'])->name('kemaskini');
    Route::post('kemaskini', [PermohonanController::class, 'update'])->name('kemaskini.post');
    Route::get('statuspermohonan', [PermohonanController::class, 'statuspermohonan'])->name('sejarahpermohonan');
	Route::get('statuspermohonan/{nokp}', [PermohonanController::class, 'delete'])->name('delete');
    Route::get('baharuimohon', [PermohonanController::class, 'baharuimohon'])->name('baharuimohon');
    Route::post('baharuimohon', [PermohonanController::class, 'save'])->name('save');
  
    //Saring permohonan
    Route::get('saringan', [SaringanController::class, 'saringan']);
    Route::get('saringan/PPK', [SaringanController::class, 'saringanPPK']);
    Route::get('maklumat/pemohon/{no_kp}', [SaringanController::class, 'maklumatPemohon'])->name('maklumat.permohonan.no_kp');
    Route::get('maklumat/perbaharui', [SaringanController::class, 'maklumatPerbaharui'])->name('maklumat.pembaharui.no_kp');
    Route::get('maklumat/profil/diri/{no_kp}', [SaringanController::class, 'maklumatProfilDiri'])->name('maklumat.profil.diri.no_kp');
    Route::get('maklumat/akademik/{no_kp}', [SaringanController::class, 'maklumatAkademik'])->name('maklumat.akademik.no_kp');
    Route::get('maklumat/akademik2', [SaringanController::class, 'maklumatAkademik2'])->name('maklumat.akademik2.no_kp');
    Route::get('maklumat/tuntutan/{no_kp}', [SaringanController::class, 'maklumatTuntutan'])->name('maklumat.tuntutan.no_kp');
    Route::post('saring/tuntutan/{no_kp}', [SaringanController::class, 'saringTuntutan'])->name('saring.tuntutan.no_kp');
    Route::get('salinan/dokumen/{id}', [SaringanController::class, 'salinanDokumen'])->name('salinan.dokumen.id');
    Route::get('salinan/invois', [SaringanController::class, 'salinanInvois'])->name('salinan.invois.no_kp');
    Route::get('salinan/akademik', [SaringanController::class, 'salinanAkademik'])->name('salinan.akademik.no_kp');
    Route::get('cetak/maklumat/pemohon', [SaringanController::class, 'cetakMaklumatPemohon']);
    Route::post('saring/maklumat/pemohon/{no_kp}', [SaringanController::class, 'saringMaklumat']);
    Route::get('permohonan/telah/disaring/{no_kp}', [SaringanController::class, 'permohonanTelahDisaring'])->name('permohonan.telah.disaring.no_kp');
    Route::get('tuntutan/telah/disaring/{no_kp}', [SaringanController::class, 'tuntutanTelahDisaring'])->name('tuntutan.telah.disaring.no_kp');

    //Permohonan - Sekretariat
    Route::get('dashboard/sekretariat', [SekretariatController::class, 'dashboard']);
    Route::get('permohonan/BKOKU', [SekretariatController::class, 'statusPermohonanBKOKU']);
    Route::get('/BKOKU/status/{status}', [SekretariatController::class, 'filterStatusPermohonanBKOKU'])->name('statusB.permohonan');
    // Route::get('/status/{status}', [SekretariatController::class, 'filterStatusPermohonanBKOKU'])->name('statusB.permohonan');
    Route::get('permohonan/PPK', [SekretariatController::class, 'statusPermohonanPPK']);
    Route::get('/PPK/status/{status}', [SekretariatController::class, 'filterStatusPermohonanPPK'])->name('statusP.permohonan');
    // Route::get('/status/{status}', [SekretariatController::class, 'filterStatusPermohonanPPK'])->name('statusP.permohonan');
    Route::get('permohonan/kelulusan', [SekretariatController::class, 'kelulusanPermohonan']);
    Route::get('permohonan/keputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::get('kemaskini/kelulusan/{no_kp}', [SekretariatController::class, 'kemaskiniKelulusan']);
    Route::post('hantar-keputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::get('hantar-keputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::get('surat-tawaran', [SekretariatController::class, 'muatTurunSuratTawaran']);
    Route::get('cetak-senarai-pemohon', [SekretariatController::class, 'cetakSenaraiPemohonPDF']);
    Route::get('senarai-disokong-excel', [SekretariatController::class, 'cetakSenaraiPemohonExcel']);
    Route::get('/keputusan', [SekretariatController::class, 'mailKeputusan']);
    Route::get('/generate-qrcode', [SekretariatController::class, 'qrcode']);

    //Tuntutan - Sekretariat
    Route::get('tuntutan-keseluruhan', [SekretariatController::class, 'tuntutanKeseluruhan']);
    Route::get('tuntutan-saring', [SekretariatController::class, 'tuntutanSaring']);
    Route::get('tuntutan/keputusan/peperiksaan', [SekretariatController::class, 'keputusanPeperiksaan']);
    Route::get('maklumat-tuntutan-2/{no_kp}', [SekretariatController::class, 'maklumatTuntutan2'])->name('maklumat.tuntutan2.no_kp');
    Route::post('tuntutan/saring/maklumat/{id}', [SekretariatController::class, 'saringMaklumatTuntutan'])->name('tuntutan.saring.maklumat.id');
    Route::get('tuntutan-keputusan', [SekretariatController::class, 'tuntutanKeputusan']);

    //Permohonan - Penyelaras 
    Route::get('permohonanbaru', [PenyelarasController::class, 'permohonanbaru'])->name('permohonanbaru');
    Route::get('dashboardpenyelaras', [PenyelarasController::class, 'create'])->name('dashboardpenyelaras');
    Route::post('dashboardpenyelaras', [PenyelarasController::class, 'store']);
    Route::get('keseluruhan-Permohonan', [PenyelarasController::class, 'keseluruhanPermohonan'])->name('keseluruhan-Permohonan');
    Route::get('borangPermohonanBaru/{id}', [PenyelarasController::class, 'borangPermohonanBaru'])->name('borangPermohonanBaru');
    Route::get('/bandar/{idnegeri}', [PenyelarasController::class, 'bandar']);
    Route::get('/peringkat/{id}', [PenyelarasController::class, 'peringkat']);
    Route::get('/kursus/{kodperingkat}/{id}', [PenyelarasController::class, 'kursus']);
    Route::post('borangPermohonanBaru', [PenyelarasController::class, 'simpan'])->name('simpan');
    Route::post('hantar', [PenyelarasController::class, 'hantar'])->name('hantar');
    Route::get('viewpermohonanbaru/{id}', [PenyelarasController::class, 'viewpermohonanbaru'])->name('viewpermohonanbaru');


    //Tuntutan - Penyelaras
    Route::get('tuntutan-wang-saku', [PenyelarasController::class, 'tuntutanWangSaku']);
    Route::get('maklumat-tuntutan-wang-saku', [PenyelarasController::class, 'maklumatTuntutanWangSaku']);
    Route::get('tuntutan-yuran-pengajian', [PenyelarasController::class, 'tuntutanYuranPengajian']);
    Route::get('maklumat-tuntutan-yuran-pengajian', [PenyelarasController::class, 'maklumatTuntutanYuranPengajian']);
    Route::get('kemaskini-tuntutan', [PenyelarasController::class, 'kemaskiniTuntutan']);
    Route::get('penyelaras-sejarah-tuntutan', [PenyelarasController::class, 'sejarahTuntutan']);

    //Tuntutan Pelajar 
    Route::get('borangTuntutanYuran',[TuntutanController::class,'borangtuntutanyuran'])->name('borangTuntutanYuran');
    Route::post('borangTuntutanYuran', [TuntutanController::class, 'savetuntutan'])->name('savetuntutan');
    Route::get('hantartuntutan', [TuntutanController::class, 'hantartuntutan'])->name('hantartuntutan');;

    //Pentadbir
    Route::get('daftarpengguna', [PentadbirController::class, 'daftar'])->name('daftarpengguna');
    Route::post('daftarpengguna', [PentadbirController::class, 'store'])->name('daftarpengguna.post');
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
