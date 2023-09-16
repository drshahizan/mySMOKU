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


    Route::get('profildiri', [ProfilController::class, 'profildiri'])->name('profil-diri');
    Route::post('profildiri', [ProfilController::class, 'store'])->name('profildiri.store');
    /*Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::post('post-permohonan', [PermohonanController::class, 'postPermohonan'])->name('permohonan.post'); */


    Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::get('/getBandar/{id}', [PermohonanController::class, 'getBandar']);
    Route::post('permohonan', [PermohonanController::class, 'simpanPermohonan'])->name('permohonan.simpan');
    Route::post('permohonan/hantar', [PermohonanController::class, 'hantarPermohonan'])->name('permohonan.hantar');
    Route::get('viewpermohonan', [PermohonanController::class, 'viewpermohonan'])->name('viewpermohonan');
    Route::get('/download/{file}',[PermohonanController::class,'download']);
    Route::get('kemaskini',[PermohonanController::class,'kemaskini'])->name('kemaskini');
    Route::post('kemaskini', [PermohonanController::class, 'update'])->name('kemaskini.post');
    Route::get('sejarahpermohonan', [PermohonanController::class, 'sejarahPermohonan'])->name('permohonan.sejarah');
	Route::get('statuspermohonan/{id}', [PermohonanController::class, 'delete'])->name('delete');
    Route::get('baharuimohon', [PermohonanController::class, 'baharuimohon'])->name('baharuimohon');
    Route::post('baharuimohon', [PermohonanController::class, 'save'])->name('save');

    //Permohonan - Sekretariat - Saringan
    Route::get('permohonan/sekretariat/saringan/senarai-permohonan', [SaringanController::class, 'senaraiPermohonan']);
    Route::get('permohonan/sekretariat/saringan/maklumat-permohonan/{id}', [SaringanController::class, 'maklumatPermohonan'])->name('maklumat.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-profil-diri/{id}', [SaringanController::class, 'maklumatProfilDiri'])->name('maklumat.profil.diri.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-akademik/{id}', [SaringanController::class, 'maklumatAkademik'])->name('maklumat.akademik.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-tuntutan/{id}', [SaringanController::class, 'maklumatTuntutan'])->name('maklumat.tuntutan.id');
    Route::post('permohonan/sekretariat/saringan/saring-tuntutan/{id}', [SaringanController::class, 'saringTuntutan'])->name('saring.tuntutan.id');
    Route::get('permohonan/sekretariat/saringan/salinan-dokumen/{id}', [SaringanController::class, 'salinanDokumen'])->name('salinan.dokumen.id');
    Route::post('permohonan/sekretariat/saringan/saring-permohonan/{id}', [SaringanController::class, 'saringPermohonan'])->name('saring.tuntutan.id');;
    Route::get('permohonan/sekretariat/saringan/papar-permohonan/{id}', [SaringanController::class, 'paparPermohonan'])->name('papar.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/papar-tuntutan/{id}', [SaringanController::class, 'paparTuntutan'])->name('papar.tuntutan.id');

    //Permohonan - Sekretariat - Sejarah
    Route::get('permohonan/sekretariat/sejarah/senarai-permohonan', [SaringanController::class, 'sejarahPermohonan']);

    //Permohonan - Sekretariat
    Route::get('dashboard/sekretariat', [SekretariatController::class, 'dashboard']);
    Route::get('permohonan/BKOKU', [SekretariatController::class, 'statusPermohonanBKOKU']);
    Route::get('/BKOKU/status/{status}', [SekretariatController::class, 'filterStatusPermohonanBKOKU'])->name('statusB.permohonan');
    Route::get('permohonan/PPK', [SekretariatController::class, 'statusPermohonanPPK']);
    Route::get('/PPK/status/{status}', [SekretariatController::class, 'filterStatusPermohonanPPK'])->name('statusP.permohonan');
    Route::get('permohonan/kelulusan', [SekretariatController::class, 'kelulusanPermohonan']);
    Route::get('kemaskini/kelulusan/{no_kp}', [SekretariatController::class, 'lihatKelulusan']);
    Route::post('keputusan/{no_kp}', [SekretariatController::class, 'kemaskiniKelulusan']);
    Route::get('permohonan/keputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::get('surat-tawaran', [SekretariatController::class, 'muatTurunSuratTawaran']);
    Route::get('cetak-senarai-pemohon', [SekretariatController::class, 'cetakSenaraiPemohonPDF']);
    Route::get('senarai-disokong-excel', [SekretariatController::class, 'cetakSenaraiPemohonExcel']);
    Route::get('/generate-qrcode', [SekretariatController::class, 'qrcode']);

    //Tuntutan - Sekretariat - Saringan
    Route::get('tuntutan/sekretariat/saringan/senarai_tuntutan', [SekretariatController::class, 'senaraiTuntutanKedua']);
    Route::get('tuntutan/sekretariat/saringan/keputusan-peperiksaan', [SekretariatController::class, 'keputusanPeperiksaan']);
    Route::get('tuntutan/sekretariat/saringan/maklumat-tuntutan-kedua/{id}', [SekretariatController::class, 'maklumatTuntutanKedua'])->name('maklumat.tuntutan.kedua.id');
    Route::post('tuntutan/sekretariat/saringan/saring-tuntutan-kedua/{id}', [SekretariatController::class, 'saringTuntutanKedua'])->name('saring.tuntutan.kedua.id');

    //Tuntutan - Sekretariat - Keputusan
    Route::get('tuntutan/sekretariat/keputusan/keputusan-tuntutan', [SekretariatController::class, 'keputusanTuntutan']);

    //Tuntutan - Sekretariat - Sejarah
    Route::get('tuntutan/sekretariat/sejarah/sejarah-tuntutan', [SekretariatController::class, 'sejarahTuntutan']);



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
