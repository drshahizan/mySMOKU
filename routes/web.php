<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KemaskiniController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\SaringanController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\PenyelarasController;
use App\Http\Controllers\PenyelarasPPKController;
use App\Http\Controllers\ProfilController;

use App\Http\Controllers\TuntutanController;
use App\Http\Controllers\PentadbirController;
use App\Http\Controllers\PegawaiController;
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
    Route::post('profil/simpan', [ProfilController::class, 'simpanProfil'])->name('simpan.profil');
    /*Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::post('post-permohonan', [PermohonanController::class, 'postPermohonan'])->name('permohonan.post'); */

    Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::get('/getBandar/{id}', [PermohonanController::class, 'getBandar']);
    Route::post('permohonan/baharu', [PermohonanController::class, 'simpanPermohonan'])->name('permohonan.simpan');
    Route::post('permohonan/hantar', [PermohonanController::class, 'hantarPermohonan'])->name('permohonan.hantar');
    Route::get('/download/{file}',[PermohonanController::class,'download']);
    Route::post('/permohonan', [PermohonanController::class, 'kemaskiniPermohonan'])->name('kemaskini.post');
    Route::get('permohonan/sejarah', [PermohonanController::class, 'sejarahPermohonan'])->name('permohonan.sejarah');
	Route::get('statuspermohonan/{id}', [PermohonanController::class, 'delete'])->name('delete');
    Route::get('kemaskini/keputusan', [PermohonanController::class, 'kemaskiniKeputusan'])->name('kemaskini.keputusan');
    Route::post('kemaskini/keputusan', [PermohonanController::class, 'save'])->name('save');
    Route::get('lapor/tamat/pengajian', [PermohonanController::class, 'tamatPengajian'])->name('tamat.pengajian');
    Route::post('hantar/dokumen/tamat/pengajian', [PermohonanController::class, 'hantarTamatPengajian'])->name('hantar.tamat.pengajian');

    //Kemaskini - Sekretariat - Emel
    Route::get('kemaskini/sekretariat/emel/senarai-emel', [KemaskiniController::class, 'senaraiEmel']);
    Route::post('kemaskini/sekretariat/emel/kemaskini/{id}', [KemaskiniController::class, 'kemaskiniEmel'])->name('kemaskini.sekretariat.emel.kemaskini.id');

    //Kemaskini - Sekretariat - Emel - BKOKU - Permohonan
    Route::get('kemaskini/sekretariat/emel/BKOKU/permohonan/kemaskini-dikembalikan', [KemaskiniController::class, 'pKemaskiniDikembalikanBKOKU']);

    //Kemaskini - Sekretariat - Emel - BKOKU - Tuntutan
    Route::get('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-tidak-layak', [KemaskiniController::class, 'kemaskiniTidakLayakBKOKU']);
    Route::get('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-layak', [KemaskiniController::class, 'kemaskiniLayakBKOKU']);
    Route::get('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-dikembalikan', [KemaskiniController::class, 'kemaskiniDikembalikanBKOKU']);

    //Kemaskini - Sekretariat - Emel - PPK - Permohonan
    Route::get('kemaskini/sekretariat/emel/PPK/permohonan/kemaskini-dikembalikan', [KemaskiniController::class, 'pKemaskiniDikembalikanPPK']);

    //Kemaskini - Sekretariat - Emel - PPK - Tuntutan
    Route::get('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-tidak-layak', [KemaskiniController::class, 'kemaskiniTidakLayakPPK']);
    Route::get('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-layak', [KemaskiniController::class, 'kemaskiniLayakPPK']);
    Route::get('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-dikembalikan', [KemaskiniController::class, 'kemaskiniDikembalikanPPK']);

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

    //Kemaskini - Sekretariat - Pengajian
    Route::get('sekretariat/kemaskini/peringkat/pengajian', [SekretariatController::class, 'kemaskiniPeringkatPengajian'])->name('peringkat.pengajian');

    //Kemaskini - Sekretariat - Surat Tawaran
    //Route::get('kemaskini/sekretariat/surat/tawaran', [SekretariatController::class, 'viewSuratTawaran'])->name('view');
    Route::get('kemaskini/sekretariat/surat/tawaran/preview', [SekretariatController::class, 'previewSuratTawaran'])->name('preview');
    Route::post('kemaskini/sekretariat/surat/tawaran/send/{suratTawaranId}', [SekretariatController::class, 'sendSuratTawaran'])->name('send');
    // Route::get('kemaskini/sekretariat/surat/tawaran/update/{suratTawaranId}', [SekretariatController::class, 'updatedSuratTawaran'])->name('update');

    //Permohonan - Sekretariat - Kelulusan
    Route::post('permohonan/sekretariat/hantar/semua', [SekretariatController::class, 'hantarSemuaKeputusanPermohonan'])->name('bulk.approval');
    Route::get('permohonan/sekretariat/kelulusan', [SekretariatController::class, 'senaraiKelulusanPermohonan']);
    Route::get('permohonan/sekretariat/kelulusan/{permohonan_id}', [SekretariatController::class, 'maklumatKelulusanPermohonan']);
    Route::post('permohonan/sekretariat/hantar/keputusan/{permohonan_id}', [SekretariatController::class, 'hantarKeputusanPermohonan']);
    Route::get('senarai-permohonan-disokong-pdf', [SekretariatController::class, 'cetakSenaraiPemohonPDF'])->name('senarai.disokong.pdf');
    Route::get('senarai-permohonan-disokong-excel', [SekretariatController::class, 'cetakSenaraiPemohonExcel'])->name('senarai.disokong.excel');

    //Permohonan - Sekretariat - Keputusan
    Route::get('permohonan/sekretariat/keputusan', [SekretariatController::class, 'senaraiKeputusanPermohonan']);
    Route::get('senarai-keputusan-permohonan-BKOKU-pdf', [SekretariatController::class, 'cetakKeputusanPermohonanBKOKU'])->name('senarai.keputusan.BKOKU.pdf');
    Route::get('senarai-keputusan-permohonan-PPK-pdf', [SekretariatController::class, 'cetakKeputusanPermohonanPPK'])->name('senarai.keputusan.PPK.pdf');
    Route::get('/surat-tawaran/{permohonanId}', [SekretariatController::class, 'muatTurunSuratTawaran'])->name('generate-pdf');

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
    Route::get('tuntutan/sekretariat/sejarah/rekod-tuntutan/{id}', [SekretariatController::class, 'rekodTuntutan'])->name('rekod.tuntutan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-tuntutan/{id}', [SekretariatController::class, 'paparRekodTuntutan'])->name('papar.rekod.tuntutan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-saringan/{id}', [SekretariatController::class, 'paparRekodSaringanTuntutan'])->name('papar.rekod.saringan.tuntutan.id');

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
    Route::get('penyelaras/view-permohonan/{id}', [PenyelarasController::class, 'viewPermohonan'])->name('penyelaras.view.permohonan');
    Route::get('penyelaras/senarai/permohonan/keseluruhan', [PenyelarasController::class, 'senaraiPermohonanKeseluruhan'])->name('senarai.permohonanKeseluruhan');


    //Tuntutan - Penyelaras BKOKU - Wang Saku
    Route::get('tuntutan/penyelaras/wang-saku/senarai-tuntutan', [PenyelarasController::class, 'tuntutanWangSaku']);
    Route::get('tuntutan/penyelaras/wang-saku/maklumat-tuntutan', [PenyelarasController::class, 'maklumatTuntutanWangSaku']);

    //Tuntutan - Penyelaras BKOKU- Yuran Dan Wang Saku
    Route::get('tuntutan/penyelaras/yuran-dan-wang-saku/senarai-tuntutan', [PenyelarasController::class, 'tuntutanYuranPengajian']);
    Route::get('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan', [PenyelarasController::class, 'maklumatTuntutanYuranPengajian']);

    //Tuntutan - Penyelaras BKOKU - Kemaskini
    Route::get('tuntutan/penyelaras/kemaskini/kemaskini-tuntutan', [PenyelarasController::class, 'kemaskiniTuntutan']);

    //Tuntutan - Penyelaras BKOKU - Sejarah
    Route::get('tuntutan/penyelaras/tuntutan-keseluruhan/tuntutan-keseluruhan', [PenyelarasController::class, 'tuntutanKeseluruhan'])->name('senarai.tuntutanKeseluruhan');

    //Permohonan - Penyelaras PPK
    Route::get('penyelaras/ppk/dashboard', [PenyelarasPPKController::class,'index'])->name('penyelaras.ppk.dashboard');
    Route::post('penyelaras/ppk/dashboard', [PenyelarasPPKController::class, 'store']);
    Route::get('penyelaras/ppk/permohonan/baharu/{id}', [PenyelarasPPKController::class, 'permohonanBaharu'])->name('penyelaras.ppk.permohonan.baharu');
    Route::get('/bandar/{idnegeri}', [PenyelarasPPKController::class, 'bandar']);
    Route::get('/peringkat/{id}', [PenyelarasPPKController::class, 'peringkat']);
    Route::get('/kursus/{kodperingkat}/{id}', [PenyelarasPPKController::class, 'kursus']);
    Route::post('penyelaras/ppk/baharu', [PenyelarasPPKController::class, 'simpan'])->name('ppk.simpan');
    Route::post('/penyelaras/ppk/permohonan/baharu', [PenyelarasPPKController::class, 'kemaskini'])->name('ppk.kemaskini');
    Route::post('ppk/hantar', [PenyelarasPPKController::class, 'hantar'])->name('ppk.hantar');
    Route::get('penyelaras/ppk/senarai/permohonan-baharu', [PenyelarasPPKController::class, 'senaraiPermohonanBaharu'])->name('senarai.ppk.permohonanBaharu');
    Route::get('penyelaras/ppk/sejarah/sejarah-permohonan', [PenyelarasPPKController::class, 'sejarahPermohonan'])->name('ppk.sejarah.permohonan');
    Route::get('penyelaras/ppk/sejarah/rekod-permohonan/{id}', [PenyelarasPPKController::class, 'rekodPermohonan'])->name('ppk.rekod.permohonan');
    Route::get('penyelaras/ppk/sejarah/papar-permohonan/{id}', [PenyelarasPPKController::class, 'paparRekodPermohonan'])->name('ppk.papar.rekod.permohonan');
    Route::get('penyelaras/ppk/sejarah/permohonan/papar-saringan/{id}', [PenyelarasPPKController::class, 'paparRekodSaringan'])->name('ppk.papar.rekod.saringan');
    Route::get('penyelaras/ppk/sejarah/permohonan/papar-kelulusan/{id}', [PenyelarasPPKController::class, 'paparRekodKelulusan'])->name('ppk.papar.rekod.kelulusan');

    //Tuntutan - Penyelaras PPK
    Route::get('penyelaras/ppk/senarai/tuntutan-baharu', [PenyelarasPPKController::class, 'senaraiTuntutanBaharu'])->name('senarai.ppk.tuntutanBaharu');
    Route::post('ppk/hantar/keputusan/{id}', [PenyelarasPPKController::class, 'hantarKeputusanPeperiksaan'])->name('ppk.keputusan.hantar');
    Route::post('ppk/hantar/{id}', [PenyelarasPPKController::class, 'hantarTuntutan'])->name('ppk.tuntutan.hantar');
    Route::get('penyelaras/ppk/sejarah/sejarah-tuntutan', [PenyelarasPPKController::class, 'sejarahTuntutan'])->name('ppk.sejarah.tuntutan');
    Route::get('penyelaras/ppk/sejarah/rekod-tuntutan/{id}', [PenyelarasPPKController::class, 'rekodTuntutan'])->name('ppk.rekod.tuntutan');
    Route::get('penyelaras/ppk/sejarah/papar-tuntutan/{id}', [PenyelarasPPKController::class, 'paparRekodTuntutan'])->name('ppk.papar.rekod');
    Route::get('penyelaras/ppk/sejarah/keputusan-peperiksaan/{id}', [PenyelarasPPKController::class, 'keputusanPeperiksaan'])->name('ppk.papar.peperiksaan');
    Route::get('penyelaras/ppk/sejarah/papar-saringan/{id}', [PenyelarasPPKController::class, 'paparRekodSaringanTuntutan'])->name('ppk.papar.saringan.tuntutan');


    //Tuntutan Pelajar
    Route::get('tuntutan/baharu',[TuntutanController::class,'tuntutanBaharu'])->name('tuntutan.baharu');
    Route::post('tuntutan/baharu', [TuntutanController::class, 'simpanTuntutan'])->name('simpan.tuntutan');
    Route::post('tuntutan/hantar', [TuntutanController::class, 'hantarTuntutan'])->name('hantar.tuntutan');

    //Pentadbir
    Route::get('pentadbir/dashboard', [PentadbirController::class,'index'])->name('pentadbir.dashboard');
    Route::get('daftarpengguna', [PentadbirController::class, 'daftar'])->name('daftarpengguna');
    Route::post('daftarpengguna', [PentadbirController::class, 'store'])->name('daftarpengguna.post');
    Route::get('pentadbir/api-connection', [PentadbirController::class, 'checkConnectionSmoku'])->name('smoku.api');
    Route::get('pentadbir/alamat', [PentadbirController::class, 'alamat'])->name('alamat');
    Route::post('pentadbir/alamat', [PentadbirController::class, 'save'])->name('alamat.save');
    Route::get('pentadbir/tarikh', [PentadbirController::class, 'tarikh'])->name('tarikh');
    Route::post('pentadbir/tarikh', [PentadbirController::class, 'simpanTarikh'])->name('simpan.tarikh');
    Route::get('pentadbir/jumlah-tuntutan', [PentadbirController::class, 'jumlahTuntutan'])->name('jumlah.tuntutan');
    Route::post('pentadbir/jumlah-tuntutan', [PentadbirController::class, 'simpanJumlah'])->name('simpan.jumlah');

    //Pegawai
    Route::get('pegawai/dashboard', [PegawaiController::class,'index'])->name('pegawai.dashboard');


 });

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
