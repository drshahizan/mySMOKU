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
    Route::get('tamatPengajian', [PermohonanController::class, 'tamatPengajian'])->name('tamatPengajian');


    //Permohonan - Sekretariat - Saringan
    Route::get('permohonan/sekretariat/saringan/senarai-permohonan', [SaringanController::class, 'senaraiPermohonan']);
    Route::get('permohonan/sekretariat/saringan/maklumat-permohonan/{id}', [SaringanController::class, 'maklumatPermohonan'])->name('maklumat.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-profil-diri/{id}', [SaringanController::class, 'maklumatProfilDiri'])->name('maklumat.profil.diri.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-akademik/{id}', [SaringanController::class, 'maklumatAkademik'])->name('maklumat.akademik.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-tuntutan/{id}', [SaringanController::class, 'maklumatTuntutan'])->name('maklumat.tuntutan.id');
    Route::post('permohonan/sekretariat/saringan/saring-tuntutan/{id}', [SaringanController::class, 'saringTuntutan'])->name('saring.tuntutan.id');
    Route::get('permohonan/sekretariat/saringan/salinan-dokumen/{id}', [SaringanController::class, 'salinanDokumen'])->name('salinan.dokumen.id');
    Route::post('permohonan/sekretariat/saringan/saring-permohonan/{id}', [SaringanController::class, 'saringPermohonan'])->name('saring.permohonan.id');;
    Route::get('permohonan/sekretariat/saringan/papar-permohonan/{id}', [SaringanController::class, 'paparPermohonan'])->name('papar.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/papar-tuntutan/{id}', [SaringanController::class, 'paparTuntutan'])->name('papar.tuntutan.id');

    //Permohonan - Sekretariat - Dashboard
    Route::get('dashboard/sekretariat', [SekretariatController::class, 'dashboard']);
    Route::get('sekretariat/permohonan/BKOKU/keseluruhan', [SekretariatController::class, 'statusPermohonanBKOKU']);
    Route::get('sekretariat/permohonan/BKOKU/status/{status}', [SekretariatController::class, 'filterStatusPermohonanBKOKU'])->name('statusB.permohonan');
    Route::get('sekretariat/tuntutan/BKOKU/dibayar', [SekretariatController::class, 'bilanganTuntutanBKOKU']);
    Route::get('sekretariat/permohonan/PPK/keseluruhan', [SekretariatController::class, 'statusPermohonanPPK']);
    Route::get('sekretariat/permohonan/PPK/status/{status}', [SekretariatController::class, 'filterStatusPermohonanPPK'])->name('statusP.permohonan');
    Route::get('sekretariat/tuntutan/PPK/dibayar', [SekretariatController::class, 'bilanganTuntutanPPK']);

    //Permohonan - Sekretariat - Kelulusan
    Route::get('permohonan/sekretariat/kelulusan', [SekretariatController::class, 'senaraiKelulusanPermohonan']);
    Route::get('permohonan/sekretariat/kelulusan/{smoku_id}', [SekretariatController::class, 'maklumatKelulusanPermohonan']);
    Route::post('permohonan/sekretariat/hantar/keputusan/{smoku_id}', [SekretariatController::class, 'hantarKeputusanPermohonan']);
    Route::get('permohonan/senarai-disokong-pdf', [SekretariatController::class, 'cetakSenaraiPemohonPDF'])->name('senarai.disokong.pdf');
    Route::get('permohonan/senarai-disokong-excel', [SekretariatController::class, 'cetakSenaraiPemohonExcel'])->name('senarai.disokong.excel');
    Route::get('surat-tawaran', [SekretariatController::class, 'muatTurunSuratTawaran']);

    //Permohonan - Sekretariat - Keputusan
    Route::get('permohonan/sekretariat/keputusan', [SekretariatController::class, 'senaraiKeputusanPermohonan']);

    //Permohonan - Sekretariat - Sejarah
    Route::get('permohonan/sekretariat/sejarah/sejarah-permohonan', [SaringanController::class, 'sejarahPermohonan']);
    Route::get('permohonan/sekretariat/sejarah/rekod-permohonan/{id}', [SaringanController::class, 'rekodPermohonan'])->name('rekod.permohonan.id');
    Route::get('permohonan/sekretariat/sejarah/papar-permohonan/{id}', [SaringanController::class, 'paparRekodPermohonan'])->name('papar.rekod.permohonan.id');
    Route::get('permohonan/sekretariat/sejarah/papar-saringan/{id}', [SaringanController::class, 'paparRekodSaringan'])->name('papar.rekod.saringan.id');
    Route::get('permohonan/sekretariat/sejarah/papar-kelulusan/{id}', [SaringanController::class, 'paparRekodKelulusan'])->name('papar.rekod.kelulusan.id');

    //Tuntutan - Sekretariat - Saringan
    Route::get('tuntutan/sekretariat/saringan/senarai_tuntutan', [SekretariatController::class, 'senaraiTuntutanKedua']);
    Route::get('tuntutan/sekretariat/saringan/keputusan-peperiksaan', [SekretariatController::class, 'keputusanPeperiksaan']);
    Route::get('tuntutan/sekretariat/saringan/maklumat-tuntutan-kedua/{id}', [SekretariatController::class, 'maklumatTuntutanKedua'])->name('maklumat.tuntutan.kedua.id');
    Route::post('tuntutan/sekretariat/saringan/saring-tuntutan-kedua/{id}', [SekretariatController::class, 'saringTuntutanKedua'])->name('saring.tuntutan.kedua.id');

    //Tuntutan - Sekretariat - Keputusan
    Route::get('tuntutan/sekretariat/keputusan/keputusan-tuntutan', [SekretariatController::class, 'keputusanTuntutan']);

    //Tuntutan - Sekretariat - Sejarah
    Route::get('tuntutan/sekretariat/sejarah/sejarah-tuntutan', [SekretariatController::class, 'sejarahTuntutan']);
    Route::get('tuntutan/sekretariat/sejarah/rekod-tuntutan/{id}', [SaringanController::class, 'rekodTuntutan'])->name('rekod.permohonan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-tuntutan/{id}', [SaringanController::class, 'paparRekodTuntutan'])->name('papar.rekod.permohonan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-saringan/{id}', [SaringanController::class, 'paparRekodSaringanTuntutan'])->name('papar.rekod.saringan.tuntutan.id');



    //Permohonan - Penyelaras BKOKU
    Route::get('penyelaras/dashboard', [PenyelarasController::class, 'index'])->name('penyelaras.dashboard');
    Route::post('penyelaras/dashboard', [PenyelarasController::class, 'store']);
    Route::get('penyelaras/permohonan/baharu/{id}', [PenyelarasController::class, 'permohonanBaharu'])->name('penyelaras.permohonan.baharu');
    Route::get('/bandar/{idnegeri}', [PenyelarasController::class, 'bandar']);
    Route::get('/peringkat/{id}', [PenyelarasController::class, 'peringkat']);
    Route::get('/kursus/{kodperingkat}/{id}', [PenyelarasController::class, 'kursus']);
    Route::post('penyelarasbaharu', [PenyelarasController::class, 'simpan'])->name('simpan');
    Route::post('hantar', [PenyelarasController::class, 'hantar'])->name('hantar');
    Route::get('penyelaras/senarai/permohonan/baharu', [PenyelarasController::class, 'senaraiPermohonanBaharu'])->name('senarai.permohonanBaharu');
    Route::get('penyelaras/senarai/permohonan/keseluruhan', [PenyelarasController::class, 'senaraiPermohonanKeseluruhan'])->name('senarai.permohonanKeseluruhan');

    Route::get('viewpermohonanbaru/{id}', [PenyelarasController::class, 'viewpermohonanbaru'])->name('viewpermohonanbaru');


    //Tuntutan - Penyelaras BKOKU - Wang Saku
    Route::get('tuntutan/penyelaras/wang-saku/senarai-tuntutan', [PenyelarasController::class, 'tuntutanWangSaku']);
    Route::get('tuntutan/penyelaras/wang-saku/maklumat-tuntutan', [PenyelarasController::class, 'maklumatTuntutanWangSaku']);

    //Tuntutan - Penyelaras BKOKU- Yuran Dan Wang Saku
    Route::get('tuntutan/penyelaras/yuran-dan-wang-saku/senarai-tuntutan', [PenyelarasController::class, 'tuntutanYuranPengajian']);
    Route::get('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan', [PenyelarasController::class, 'maklumatTuntutanYuranPengajian']);

    //Tuntutan - Penyelaras BKOKU - Kemaskini
    Route::get('tuntutan/penyelaras/kemaskini/kemaskini-tuntutan', [PenyelarasController::class, 'kemaskiniTuntutan']);

    //Tuntutan - Penyelaras BKOKU - Sejarah
    Route::get('tuntutan/penyelaras/sejarah/sejarah-tuntutan', [PenyelarasController::class, 'sejarahTuntutan']);

    //Permohonan - Penyelaras PPK 
    //Permohonan - Penyelaras PPK
    Route::get('permohonanbaruppk', [PenyelarasPPKController::class, 'permohonanbaruppk'])->name('permohonanbaruppk');
    Route::get('dashboardpenyelarasppk', [PenyelarasPPKController::class,'create'])->name('dashboardpenyelarasppk');
    Route::post('dashboardpenyelarasppk', [PenyelarasPPKController::class, 'store']);
    Route::get('keseluruhan-PermohonanPPK', [PenyelarasPPKController::class, 'keseluruhanPermohonanPPK'])->name('keseluruhan-PermohonanPPK');
    Route::get('borangPermohonanBaruPPK/{id}', [PenyelarasPPKController::class, 'borangPermohonanBaruPPK'])->name('borangPermohonanBaruPPK');
    Route::get('/bandar/{idnegeri}', [PenyelarasPPKController::class, 'bandar']);
    Route::get('/peringkat/{id}', [PenyelarasPPKController::class, 'peringkat']);
    Route::get('/kursus/{kodperingkat}/{id}', [PenyelarasPPKController::class, 'kursus']);
    Route::post('borangPermohonanBaruPPK', [PenyelarasPPKController::class, 'simpan'])->name('simpanpermohonanppk');
    Route::post('hantarpermohonanppk', [PenyelarasPPKController::class, 'hantar'])->name('hantarpermohonanppk');
    Route::get('viewpermohonanbaruppk/{id}', [PenyelarasPPKController::class, 'viewpermohonanbaruppk'])->name('viewpermohonanbaruppk');



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
