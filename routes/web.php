<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\MaklumatESPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KemaskiniController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MaklumatESP;
use App\Http\Controllers\MaklumatKursusController;
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
use App\Http\Controllers\PelajarController;
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
//api esp
//Route::middleware('api.token')->group(function () {

    //nak test kat luar sistem
    // Route::get('/kemaskiniESP', [MaklumatESPController::class, 'kemaskiniStatusESP']);
    Route::post('/statusESP', [MaklumatESPController::class, 'receiveData']);
    Route::get('/statusESP/dibayar', [MaklumatESPController::class, 'statusDibayar']);
    Route::get('/test/api', [MaklumatESPController::class, 'test']);
    Route::get('/requery', [MaklumatESPController::class, 'testrequery']);
    Route::post('/requery', [MaklumatESPController::class, 'kemaskiniStatusESP'])->name('kemaskini.esp');
    Route::get('/statusESP/dibayar/tuntutan', [MaklumatESPController::class, 'statusDibayarTuntutan']);

    Route::get('/maklumat/MQR', [MaklumatKursusController::class, 'index']);
    Route::get('/maklumat/MQAPA', [MaklumatKursusController::class, 'MQAPA']);
    Route::get('/testmqa/api', [MaklumatKursusController::class, 'test']);
//});


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/laporan/permohonan', [LaporanController::class, 'permohonan'])->name('laporan.permohonan');
    Route::get('/laporan/tuntutan', [LaporanController::class, 'tuntutan'])->name('laporan.tuntutan');

    Route::get('/permohonanESP', [MaklumatESPController::class, 'permohonan'])->name('permohonan.esp');
    Route::post('/permohonanESP', [MaklumatESPController::class, 'hantar'])->name('maklumat.esp');
    Route::get('/tuntutanESP', [MaklumatESPController::class, 'tuntutan'])->name('tuntutan.esp');
    Route::post('/tuntutanESP', [MaklumatESPController::class, 'hantarTuntutan'])->name('maklumat_tuntutan.esp');

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pelajar/dashboard', [PelajarController::class, 'index'])->name('pelajar.dashboard');
    //Route::post('/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('lapor/tamat/pengajian', [PelajarController::class, 'tamatPengajian'])->name('tamat.pengajian');
    Route::get('lapor/tangguh/pengajian', [PelajarController::class, 'tangguhPengajian'])->name('tangguh.pengajian');
    Route::get('lapor/lanjut/pengajian', [PelajarController::class, 'lanjutPengajian'])->name('lanjut.pengajian');
    Route::post('hantar/dokumen/tamat/pengajian', [PelajarController::class, 'hantarTamatPengajian'])->name('hantar.tamat.pengajian');
    Route::post('hantar/dokumen/tangguh/pengajian', [PelajarController::class, 'hantarTangguhPengajian'])->name('hantar.tangguh.pengajian');
    Route::post('hantar/dokumen/lanjut/pengajian', [PelajarController::class, 'hantarLanjutPengajian'])->name('hantar.lanjut.pengajian');

    Route::get('profil/pelajar', [PelajarController::class, 'profilPelajar'])->name('profil.pelajar');
    Route::post('profil/pelajar/simpan', [PelajarController::class, 'simpanProfilPelajar'])->name('simpan.profil.pelajar');

    Route::get('profil', [ProfilController::class, 'index'])->name('tukar.katalaluan');
    Route::post('profil/simpan', [ProfilController::class, 'simpanProfil'])->name('simpan.profil');
    Route::post('katalaluan/simpan', [ProfilController::class, 'simpanKatalaluan'])->name('simpan.katalaluan');

    //Permohonan Pelajar
    Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::get('/getBandar/{id}', [PermohonanController::class, 'getBandar']);
    Route::get('/getParlimen/{id}', [PermohonanController::class, 'getParlimen']);
    Route::get('/getDun/{id}', [PermohonanController::class, 'getDun']);
    Route::get('/peringkat/{id}', [PermohonanController::class, 'peringkat']);
    Route::get('/kursus/{kodperingkat}/{id}', [PermohonanController::class, 'kursus']);
    Route::get('/getPenaja/{id}', [PermohonanController::class, 'getPenaja']);
    Route::get('/fetch-amaun/bkoku', [PermohonanController::class, 'fetchAmaun']);
    Route::post('permohonan/baharu', [PermohonanController::class, 'simpanPermohonan'])->name('permohonan.simpan');
    Route::post('permohonan/hantar', [PermohonanController::class, 'hantarPermohonan'])->name('permohonan.hantar');
    Route::get('/download/{file}',[PermohonanController::class,'download']);
    Route::post('/permohonan', [PermohonanController::class, 'kemaskiniPermohonan'])->name('kemaskini.post');
	Route::get('permohonan/delete/{id}', [PermohonanController::class, 'deletePermohonan'])->name('permohonan.delete');
	Route::get('permohonan/batal/{id}', [PermohonanController::class, 'batalPermohonan'])->name('permohonan.batal');
    Route::get('kemaskini/keputusan', [PermohonanController::class, 'kemaskiniKeputusan'])->name('kemaskini.keputusan');
    Route::post('kemaskini/keputusan', [PermohonanController::class, 'save'])->name('save');
    Route::get('permohonan/sejarah/sejarah-permohonan', [PermohonanController::class, 'sejarahPermohonan'])->name('pelajar.sejarah.permohonan');

    //Tuntutan Pelajar
    Route::get('tuntutan/baharu',[TuntutanController::class,'tuntutanBaharu'])->name('tuntutan.baharu');
    Route::post('tuntutan/baharu', [TuntutanController::class, 'simpanTuntutan'])->name('pelajar.simpan.tuntutan');
    Route::post('tuntutan/hantar', [TuntutanController::class, 'hantarTuntutan'])->name('hantar.tuntutan');
    Route::get('tuntutan/sejarah/sejarah-tuntutan', [TuntutanController::class, 'sejarahTuntutan'])->name('pelajar.sejarah.tuntutan');
    Route::get('tuntutan/delete/{id}', [TuntutanController::class, 'deleteTuntutan'])->name('tuntutan.delete');
    Route::get('tuntutan/item/delete/{id}', [TuntutanController::class, 'deleteItemTuntutan'])->name('tuntutan.item.delete');
	Route::get('tuntutan/batal/{id}', [TuntutanController::class, 'batalTuntutan'])->name('tuntutan.batal');

    //Kemaskini - Sekretariat - Emel
    Route::get('kemaskini/sekretariat/emel/senarai-emel', [KemaskiniController::class, 'senaraiEmel']);
    Route::post('kemaskini/sekretariat/emel/kemaskini/{id}', [KemaskiniController::class, 'kemaskiniEmel'])->name('kemaskini.sekretariat.emel.kemaskini.id');
    Route::get('kemaskini/sekretariat/emel/papar-emel/{id}', [KemaskiniController::class, 'paparEmel'])->name('kemaskini.sekretariat.emel.papar.id');

    //Kemaskini - Sekretariat - Emel - BKOKU - Permohonan
    Route::get('kemaskini/sekretariat/emel/BKOKU/permohonan/kemaskini-dikembalikan', [KemaskiniController::class, 'pKemaskiniDikembalikanBKOKU']);
    Route::get('kemaskini/sekretariat/emel/BKOKU/permohonan/kemaskini-layak', [KemaskiniController::class, 'pKemaskiniLayakBKOKU']);
    Route::get('kemaskini/sekretariat/emel/BKOKU/permohonan/kemaskini-tidak-layak', [KemaskiniController::class, 'pKemaskiniTidakLayakBKOKU']);

    //Kemaskini - Sekretariat - Emel - BKOKU - Tuntutan
    Route::get('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-tidak-layak', [KemaskiniController::class, 'kemaskiniTidakLayakBKOKU']);
    Route::get('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-layak', [KemaskiniController::class, 'kemaskiniLayakBKOKU']);
    Route::get('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-dikembalikan', [KemaskiniController::class, 'kemaskiniDikembalikanBKOKU']);

    //Kemaskini - Sekretariat - Emel - PPK - Permohonan
    Route::get('kemaskini/sekretariat/emel/PPK/permohonan/kemaskini-dikembalikan', [KemaskiniController::class, 'pKemaskiniDikembalikanPPK']);
    Route::get('kemaskini/sekretariat/emel/PPK/permohonan/kemaskini-layak', [KemaskiniController::class, 'pKemaskiniLayakPPK']);
    Route::get('kemaskini/sekretariat/emel/PPK/permohonan/kemaskini-tidak-layak', [KemaskiniController::class, 'pKemaskiniTidakLayakPPK']);

    //Kemaskini - Sekretariat - Emel - PPK - Tuntutan
    Route::get('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-tidak-layak', [KemaskiniController::class, 'kemaskiniTidakLayakPPK']);
    Route::get('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-layak', [KemaskiniController::class, 'kemaskiniLayakPPK']);
    Route::get('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-dikembalikan', [KemaskiniController::class, 'kemaskiniDikembalikanPPK']);

    //Kemaskini - Sekretariat - Peruntukan
    Route::get('kemaskini/sekretariat/jumlah-peruntukan', [KemaskiniController::class, 'senaraiJumlahPeruntukan'])->name('senarai.amaun.peruntukan');
    Route::post('kemaskini/sekretariat/kemaskini/jumlah-peruntukan', [KemaskiniController::class, 'kemaskiniJumlahPeruntukan'])->name('kemaskini.peruntukan');

    //Permohonan - Sekretariat - Saringan
    Route::get('permohonan/sekretariat/saringan/senarai-permohonan', [SaringanController::class, 'senaraiPermohonan']);
    Route::get('permohonan/sekretariat/saringan/maklumat-permohonan/{id}', [SaringanController::class, 'maklumatPermohonan'])->name('maklumat.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-permohonan-diperbaharui/{id}', [SaringanController::class, 'maklumatPermohonanDiperbaharui'])->name('maklumat.permohonan.diperbaharui.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-profil-diri/{id}', [SaringanController::class, 'maklumatProfilDiri'])->name('maklumat.profil.diri.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-akademik/{id}', [SaringanController::class, 'maklumatAkademik'])->name('maklumat.akademik.id');
    Route::get('permohonan/sekretariat/saringan/maklumat-tuntutan/{id}', [SaringanController::class, 'maklumatTuntutan'])->name('maklumat.tuntutan.id');
    Route::post('permohonan/sekretariat/saringan/saring-tuntutan/{id}', [SaringanController::class, 'saringTuntutan'])->name('saring.tuntutan.id');
    Route::get('permohonan/sekretariat/saringan/salinan-dokumen/{id}', [SaringanController::class, 'salinanDokumen'])->name('salinan.dokumen.id');
    Route::post('permohonan/sekretariat/saringan/saring-permohonan/{id}', [SaringanController::class, 'saringPermohonan'])->name('saring.permohonan.id');
    Route::post('permohonan/sekretariat/saringan/saring-permohonan-diperbaharui/{id}', [SaringanController::class, 'saringPermohonanDiperbaharui'])->name('saring.permohonan.diperbaharui.id');;
    Route::get('permohonan/sekretariat/saringan/papar-permohonan/{id}', [SaringanController::class, 'paparPermohonan'])->name('papar.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/papar-permohonan-diperbaharui/{id}', [SaringanController::class, 'paparPermohonanDiperbaharui'])->name('papar.permohonan.diperbaharui.id');
    Route::get('permohonan/sekretariat/saringan/papar-tuntutan/{id}', [SaringanController::class, 'paparTuntutan'])->name('papar.tuntutan.id');
    Route::get('permohonan/sekretariat/saringan/kemaskini-saringan/{id}', [SaringanController::class, 'kemaskiniSaringanP'])->name('kemaskini.saringan.permohonan.id');
    Route::post('permohonan/sekretariat/saringan/hantar-saringan/{id}', [SaringanController::class, 'hantarSaringanP'])->name('hantar.saringan.permohonan.id');
    Route::get('permohonan/sekretariat/saringan/set-semula-status/{id}', [SaringanController::class, 'setSemulaStatus'])->name('kemaskini.saringan.set.status.permohonan.id');

    //Permohonan - Sekretariat - Pembayaran
    Route::get('permohonan/sekretariat/pembayaran/senarai', [SaringanController::class, 'senaraiPembayaran']);
    Route::post('permohonan/sekretariat/hantar/info-cek', [SaringanController::class, 'kemaskiniInfoCek'])->name('sekretariat.infocek.submit');
    Route::get('senarai-penyaluran-excel/{programCode}', [SaringanController::class, 'cetakSenaraiPenyaluranExcel'])->name('senarai.penyaluran.excel');
    Route::post('permohonan/sekretariat/kembali/{id}', [SaringanController::class, 'returnToPenyelaras'])->name('sekretariat.return.infobaucer');

    Route::get('permohonan/sekretariat/pembayaran/maklumat/{id}', [SaringanController::class, 'maklumatPembayaran'])->name('maklumat.pembayaran.id');
    Route::post('permohonan/sekretariat/pembayaran/saring/{id}', [SaringanController::class, 'saringPembayaran'])->name('saring.pembayaran.id');;
    Route::get('permohonan/sekretariat/pembayaran/papar/{id}', [SaringanController::class, 'paparPembayaran'])->name('papar.pembayaran.id');
    Route::get('permohonan/sekretariat/pembayaran/kemaskini/{id}', [SaringanController::class, 'kemaskiniPembayaran'])->name('kemaskini.pembayaran.id');
    Route::post('permohonan/sekretariat/pembayaran/hantar/{id}', [SaringanController::class, 'hantarPembayaran'])->name('hantar.pembayaran.id');

    //Permohonan - Sekretariat - Dashboard
    Route::get('dashboard/sekretariat', [SekretariatController::class, 'dashboardSekretariat'])->name('sekretariat.dashboard');
    Route::get('sekretariat/permohonan/BKOKU/keseluruhan/{status}', [SekretariatController::class, 'statusPermohonanBKOKU'])->name('keseluruhanB.permohonan');
    Route::get('sekretariat/permohonan/BKOKU/UA/keseluruhan/{status}', [SekretariatController::class, 'statusPermohonanUA'])->name('keseluruhanUA.permohonan');
    Route::get('sekretariat/permohonan/PPK/keseluruhan/{status}', [SekretariatController::class, 'statusPermohonanPPK'])->name('keseluruhanP.permohonan');

    Route::get('sekretariat/tuntutan/BKOKU/keseluruhan/{status}', [SekretariatController::class, 'statusTuntutanBKOKU'])->name('keseluruhanB.tuntutan');
    Route::get('sekretariat/tuntutan/BKOKU/UA/keseluruhan/{status}', [SekretariatController::class, 'statusTuntutanUA'])->name('keseluruhanUA.tuntutan');
    Route::get('sekretariat/tuntutan/PPK/keseluruhan/{status}', [SekretariatController::class, 'statusTuntutanPPK'])->name('keseluruhanP.tuntutan');

    Route::get('sekretariat/permohonan/BKOKU/status/{status}', [SekretariatController::class, 'filterStatusPermohonanBKOKU'])->name('statusB.permohonan');
    Route::get('sekretariat/tuntutan/BKOKU/status/{status}', [SekretariatController::class, 'filterStatusTuntutanBKOKU'])->name('statusB.tuntutan');
    Route::get('sekretariat/permohonan/BKOKU/UA/status/{status}', [SekretariatController::class, 'filterStatusPermohonanUA'])->name('statusUA.permohonan');
    Route::get('sekretariat/tuntutan/BKOKU/UA/status/{status}', [SekretariatController::class, 'filterStatusTuntutanUA'])->name('statusUA.tuntutan');
    Route::get('sekretariat/permohonan/PPK/status/{status}', [SekretariatController::class, 'filterStatusPermohonanPPK'])->name('statusP.permohonan');
    Route::get('sekretariat/tuntutan/PPK/status/{status}', [SekretariatController::class, 'filterStatusTuntutanPPK'])->name('statusP.tuntutan');

    //Kemaskini - Sekretariat - Pengajian
    Route::get('sekretariat/kemaskini/peringkat/pengajian', [SekretariatController::class, 'peringkatPengajian'])->name('peringkat.pengajian');
    Route::post('sekretariat/hantar/kemaskini/peringkat/pengajian/{id}', [SekretariatController::class, 'kemaskiniPeringkatPengajian'])->name('kemaskini.peringkat.pengajian');

    //Kemaskini - Sekretariat - Tangguh / Lanjut Pengajian
    Route::get('sekretariat/kemaskini/pengajian', [SekretariatController::class, 'tangguhLanjutPengajian'])->name('tangguh.lanjut.pengajian');
    Route::post('sekretariat/kemaskini/pengajian/{id}', [SekretariatController::class, 'kemaskiniTarikhPengajian'])->name('kemaskini.tarikh.pengajian');

    //Kemaskini - Sekretariat - Surat Tawaran
    Route::get('kemaskini/sekretariat/surat/tawaran/preview', [SekretariatController::class, 'previewSuratTawaran'])->name('preview');
    Route::post('kemaskini/sekretariat/surat/tawaran/send/{suratTawaranId}', [SekretariatController::class, 'sendSuratTawaran'])->name('send');
    Route::get('kemaskini/sekretariat/surat/tawaran/update/{suratTawaranId}', [SekretariatController::class, 'updatedSuratTawaran'])->name('update');
    Route::get('sekretariat/muat-turun/surat-tawaran/dikemaskini', [SekretariatController::class, 'muatTurunKemaskiniSuratTawaran']);

    //Penyaluran - Sekretariat - Dokumen SPBB
    Route::get('penyaluran/sekretariat/muat-naik/dokumen/SPBB', [SekretariatController::class, 'muatNaikDokumenSPPB'])->name('sekretariat.muat-naik.SPBB');
    Route::post('penyaluran/sekretariat/hantar/dokumen/SPBB', [SekretariatController::class, 'hantarDokumenSPPB'])->name('sekretariat.hantar.SPBB');
    Route::get('penyaluran/sekretariat/muat-turun/dokumen/SPBB', [SekretariatController::class, 'muatTurunDokumenSPPB'])->name('sekretariat.muat-turun.SPBB');
    Route::get('penyaluran/sekretariat/lihat/salinan-dokumen/SPBB/{id}', [SekretariatController::class, 'salinanDokumenSPPB'])->name('dokumen.SPBB.id');

    //Permohonan - Sekretariat - Kelulusan
    Route::post('permohonan/sekretariat/hantar/semua', [SekretariatController::class, 'hantarSemuaKeputusanPermohonan'])->name('bulk.approval');
    Route::get('permohonan/sekretariat/kelulusan', [SekretariatController::class, 'senaraiKelulusanPermohonan']);
    Route::get('permohonan/sekretariat/kelulusan/{permohonan_id}', [SekretariatController::class, 'maklumatKelulusanPermohonan']);
    Route::post('permohonan/sekretariat/hantar/keputusan/{permohonan_id}', [SekretariatController::class, 'hantarKeputusanPermohonan']);
    Route::get('senarai-permohonan-disokong-pdf/{programCode}', [SekretariatController::class, 'cetakSenaraiDisokongPDF'])->name('senarai.disokong.pdf');
    Route::get('senarai-permohonan-disokong-excel/{programCode}', [SekretariatController::class, 'cetakSenaraiDisokongExcel'])->name('senarai.disokong.excel');
    Route::get('borang-SPBB-excel/{programCode}', [SekretariatController::class, 'cetakBorangSppbExcel'])->name('borang.SPBB.excel');

    //Permohonan - Sekretariat - Keputusan
    Route::get('permohonan/sekretariat/keputusan', [SekretariatController::class, 'senaraiKeputusanPermohonan']);
    Route::get('senarai-keputusan-permohonan-BKOKU-pdf', [SekretariatController::class, 'cetakKeputusanPermohonanBKOKU'])->name('senarai.keputusan.BKOKU.pdf');
    Route::get('senarai-keputusan-permohonan-BKOKU-UA-pdf', [SekretariatController::class, 'cetakKeputusanPermohonanUA'])->name('senarai.keputusan.BKOKU.UA.pdf');
    Route::get('senarai-keputusan-permohonan-PPK-pdf', [SekretariatController::class, 'cetakKeputusanPermohonanPPK'])->name('senarai.keputusan.PPK.pdf');
    Route::get('/surat-tawaran/{permohonanId}', [SekretariatController::class, 'muatTurunSuratTawaran'])->name('generate-pdf');

    //Permohonan - Sekretariat - Sejarah
    Route::get('permohonan/sekretariat/sejarah/sejarah-permohonan', [SaringanController::class, 'sejarahPermohonan']);
    Route::get('permohonan/sekretariat/sejarah/rekod-permohonan/{id}', [SaringanController::class, 'rekodPermohonan'])->name('rekod.permohonan.id');
    Route::get('permohonan/sekretariat/sejarah/papar-permohonan/{id}', [SaringanController::class, 'paparRekodPermohonan'])->name('papar.rekod.permohonan.id');
    Route::get('permohonan/sekretariat/sejarah/papar-pembayaran/{id}', [SaringanController::class, 'paparRekodPembayaran'])->name('papar.rekod.pembayaran.id');
    Route::get('permohonan/sekretariat/sejarah/papar-saringan/{id}', [SaringanController::class, 'paparRekodSaringan'])->name('papar.rekod.saringan.id');
    Route::get('permohonan/sekretariat/sejarah/papar-kelulusan/{id}', [SaringanController::class, 'paparRekodKelulusan'])->name('papar.rekod.kelulusan.id');
    Route::get('permohonan/sekretariat/sejarah/kemaskini-saringan/{id}', [SaringanController::class, 'kemaskiniSaringan'])->name('kemaskini.saringan.id');
    Route::post('permohonan/sekretariat/sejarah/hantar-saringan/{id}', [SaringanController::class, 'hantarSaringan'])->name('hantar.saringan.id');

    //Tuntutan - Sekretariat - Saringan
    Route::get('tuntutan/sekretariat/saringan/senarai-tuntutan', [SekretariatController::class, 'senaraiTuntutanKedua']);
    Route::get('tuntutan/sekretariat/saringan/keputusan-peperiksaan/{id}', [SekretariatController::class, 'keputusanPeperiksaan'])->name('maklumat.tuntutan.peperiksaan.id');
    Route::get('tuntutan/sekretariat/saringan/maklumat-tuntutan-kedua/{id}', [SekretariatController::class, 'maklumatTuntutanKedua'])->name('maklumat.tuntutan.kedua.id');
    Route::post('tuntutan/sekretariat/saringan/saring-tuntutan-kedua/{id}', [SekretariatController::class, 'saringTuntutanKedua'])->name('saring.tuntutan.kedua.id');
    Route::get('tuntutan/sekretariat/saringan/papar-tuntutan/{id}', [SekretariatController::class, 'paparTuntutanKedua'])->name('papar.tuntutan.kedua.id');
    Route::get('tuntutan/sekretariat/saringan/kemaskini-tuntutan/{id}', [SekretariatController::class, 'kemaskiniTuntutan'])->name('kemaskini.tuntutan.id');
    Route::post('tuntutan/sekretariat/saringan/hantar-tuntutan/{id}', [SekretariatController::class, 'hantarTuntutan'])->name('hantar.tuntutan.id');
    Route::get('tuntutan/sekretariat/saringan/set-semula-status/{id}', [SekretariatController::class, 'setSemulaStatus'])->name('kemaskini.saringan.set.status.tuntutan.id');
    
    //Tuntutan - Sekretariat - Pembayaran
    Route::get('tuntutan/sekretariat/pembayaran/senarai', [SekretariatController::class, 'senaraiPembayaran']);
    Route::get('tuntutan/sekretariat/pembayaran/maklumat/{id}', [SekretariatController::class, 'maklumatPembayaran'])->name('t.maklumat.pembayaran.id');
    Route::post('tuntutan/sekretariat/pembayaran/saring/{id}', [SekretariatController::class, 'saringPembayaran'])->name('t.saring.pembayaran.id');;
    Route::get('tuntutan/sekretariat/pembayaran/papar/{id}', [SekretariatController::class, 'paparPembayaran'])->name('t.papar.pembayaran.id');
    Route::get('tuntutan/sekretariat/pembayaran/kemaskini/{id}', [SekretariatController::class, 'kemaskiniPembayaran'])->name('t.kemaskini.pembayaran.id');
    Route::post('tuntutan/sekretariat/pembayaran/hantar/{id}', [SekretariatController::class, 'hantarPembayaran'])->name('t.hantar.pembayaran.id');
    Route::post('tuntutan/sekretariat/hantar/info-cek', [SekretariatController::class, 'kemaskiniInfoCek'])->name('t.sekretariat.infocek.submit');
    Route::get('tuntutan/senarai-penyaluran-excel/{programCode}', [SekretariatController::class, 'cetakSenaraiPenyaluranExcel'])->name('t.senarai.penyaluran.excel');

    //Tuntutan - Sekretariat - Keputusan
    Route::get('tuntutan/sekretariat/keputusan/keputusan-tuntutan', [SekretariatController::class, 'keputusanTuntutan'])->name('keputusan.tuntutan');
    Route::get('tuntutan/sekretariat/keputusan/filter-tuntutan', [SekretariatController::class, 'filterTuntutan'])->name('filter.tuntutan');

    //Tuntutan - Sekretariat - Sejarah
    Route::get('tuntutan/sekretariat/sejarah/sejarah-tuntutan', [SekretariatController::class, 'sejarahTuntutan']);
    Route::get('tuntutan/sekretariat/sejarah/rekod-tuntutan/{id}', [SekretariatController::class, 'rekodTuntutan'])->name('rekod.tuntutan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-tuntutan/{id}', [SekretariatController::class, 'paparRekodTuntutan'])->name('papar.rekod.tuntutan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-saringan/{id}', [SekretariatController::class, 'paparRekodSaringanTuntutan'])->name('papar.rekod.saringan.tuntutan.id');
    Route::get('tuntutan/sekretariat/sejarah/papar-pembayaran/{id}', [SekretariatController::class, 'paparRekodPembayaran'])->name('papar.rekod.pembayaran.tuntutan.id');
    Route::get('tuntutan/sekretariat/sejarah/kemaskini-saringan/{id}', [SekretariatController::class, 'kemaskiniSaringan'])->name('kemaskini.saringan.tuntutan.id');
    Route::post('tuntutan/sekretariat/sejarah/hantar-saringan/{id}', [SekretariatController::class, 'hantarSaringan'])->name('hantar.saringan.tuntutan.id');

    //Penyaluran - Penyelaras - Dokumen SPBB
    Route::get('penyelaras/penyaluran/muat-turun/borang/spbb', [PenyelarasController::class, 'muatTurunBorangSPPB'])->name('penyelaras.muat-turun.SPBB');
    Route::get('penyelaras/penyaluran/muat-naik/borang/spbb', [PenyelarasController::class, 'muatNaikBorangSPPB'])->name('penyelaras.muat-naik.SPBB');
    Route::post('penyelaras/penyaluran/hantar/borang/spbb', [PenyelarasController::class, 'hantarBorangSPPB'])->name('penyelaras.kemaskini.SPBB');
    Route::get('penyelaras/penyaluran/muat-turun/sppb1', [PenyelarasController::class, 'muatTurunDokumenSPPB1'])->name('penyelaras.dokumen.SPPB1');
    Route::get('penyelaras/penyaluran/muat-turun/sppb1a', [PenyelarasController::class, 'muatTurunDokumenSPPB1a'])->name('penyelaras.dokumen.SPPB1a');

    //Penyaluran - Penyelaras - Pembayaran
    Route::get('penyelaras/penyaluran/permohonan-tuntutan/layak', [PenyelarasController::class, 'senaraiPemohonLayak']);
    Route::post('/penyelaras/hantar/permohonan/info-baucer/{permohonan_id}', [PenyelarasController::class, 'hantarInfoBaucerPermohonan'])->name('permohonan.modal.submit');
    Route::post('/penyelaras/hantar/tuntutan/info-baucer/{tuntutan_id}', [PenyelarasController::class, 'hantarInfoBaucerTuntutan'])->name('tuntutan.modal.submit');
    Route::get('penyelaras/penyaluran/permohonan/dibayar', [PenyelarasController::class, 'senaraiPemohonDibayar'])->name('penyelaras.senarai.dibayar');
    Route::get('/permohonan/senarai-layak-excel', [PenyelarasController::class, 'exportPermohonanLayak'])->name('penyelaras.permohonan.senarai.layak.excel');
    Route::post('/permohonan/process-uploaded-file', [PenyelarasController::class, 'uploadedFilePembayaranPermohonan'])->name('modified.file.pembayaran.permohonan');
    Route::get('/tuntutan/senarai-layak-excel', [PenyelarasController::class, 'exportTuntutanLayak'])->name('penyelaras.tuntutan.senarai.layak.excel');
    Route::post('/tuntutan/process-uploaded-file', [PenyelarasController::class, 'uploadedFilePembayaranTuntutan'])->name('modified.file.pembayaran.tuntutan');
    Route::get('penyaluran/penyelaras/maklumat-baucer/{id}', [PenyelarasController::class, 'maklumatBaucerDibayar']);

    //Kemaskini - Penyelaras - Maklumat Bank
    Route::get('penyelaras/kemaskini/maklumat/bank', [PenyelarasController::class, 'maklumatBank'])->name('maklumat.bank');
    Route::post('penyelaras/kemaskini/hantar/maklumat/bank/{id}', [PenyelarasController::class, 'kemaskiniMaklumatBank'])->name('kemaskini.bank');

    //delete pendaftaran - Penyelaras
    Route::get('penyelaras/pendaftaran/delete/{id}', [PenyelarasController::class, 'deletePendaftaran'])->name('pendaftaran.delete');

    //Permohonan - Penyelaras BKOKU
    Route::get('penyelaras/dashboard', [PenyelarasController::class, 'index'])->name('penyelaras.dashboard');
    Route::post('penyelaras/dashboard', [PenyelarasController::class, 'store']);
    Route::get('penyelaras/permohonan/baharu/{id}', [PenyelarasController::class, 'permohonanBaharu'])->name('penyelaras.permohonan.baharu');
    Route::get('/bandar/{idnegeri}', [PenyelarasController::class, 'bandar']);
    Route::get('/peringkat/{id}', [PenyelarasController::class, 'peringkat']);
    Route::get('/kursus/{kodperingkat}/{id}', [PenyelarasController::class, 'kursus']);
    Route::post('penyelarasbaharu', [PenyelarasController::class, 'simpan'])->name('simpan');
    Route::post('hantar', [PenyelarasController::class, 'hantar'])->name('hantar');
    Route::get('penyelaras/permohonan/delete/{id}', [PenyelarasController::class, 'deletePermohonan'])->name('bkoku.permohonan.delete');
	Route::get('penyelaras/permohonan/batal/{id}', [PenyelarasController::class, 'batalPermohonan'])->name('bkoku.permohonan.batal');
    Route::get('penyelaras/senarai/permohonan/baharu', [PenyelarasController::class, 'senaraiPermohonanBaharu'])->name('senarai.permohonanBaharu');
    Route::get('penyelaras/bkoku/sejarah/sejarah-permohonan', [PenyelarasController::class, 'sejarahPermohonan'])->name('bkoku.sejarah.permohonan');
    Route::get('penyelaras/bkoku/sejarah/rekod-permohonan/{id}', [PenyelarasController::class, 'rekodPermohonan'])->name('bkoku.rekod.permohonan');
    Route::get('penyelaras/bkoku/sejarah/papar-permohonan/{id}', [PenyelarasController::class, 'paparRekodPermohonan'])->name('bkoku.papar.rekod.permohonan');
    Route::get('penyelaras/bkoku/sejarah/permohonan/papar-saringan/{id}', [PenyelarasController::class, 'paparRekodSaringan'])->name('bkoku.papar.rekod.saringan');
    Route::get('penyelaras/bkoku/sejarah/permohonan/papar-kelulusan/{id}', [PenyelarasController::class, 'paparRekodKelulusan'])->name('bkoku.papar.rekod.kelulusan');
    Route::get('penyelaras/bkoku/maklumat-profil-diri/{id}', [SaringanController::class, 'maklumatProfilDiri'])->name('bkoku.papar.maklumat.diri');
    Route::get('penyelaras/bkoku/maklumat-akademik/{id}', [SaringanController::class, 'maklumatAkademik'])->name('bkoku.papar.maklumat.akademik');
    Route::get('penyelaras/bkoku/salinan-dokumen/{id}', [SaringanController::class, 'salinanDokumen'])->name('bkoku.papar.salinan.dokumen');

    //Tuntutan - Penyelaras BKOKU
    Route::get('penyelaras/bkoku/senarai/tuntutan-baharu', [PenyelarasController::class, 'senaraiTuntutanBaharu'])->name('senarai.bkoku.tuntutanBaharu');
    Route::get('bkoku/kemaskini/keputusan/{id}', [PenyelarasController::class, 'kemaskiniKeputusan'])->name('bkoku.kemaskini.keputusan');
    Route::post('bkoku/hantar/keputusan/{id}', [PenyelarasController::class, 'hantarKeputusanPeperiksaan'])->name('bkoku.keputusan.hantar');
    Route::get('bkoku/tuntutan/baharu/{id}',[PenyelarasController::class,'tuntutanBaharu'])->name('bkoku.tuntutan.baharu');
    Route::post('bkoku/simpan/{id}', [PenyelarasController::class, 'simpanTuntutan'])->name('bkoku.simpan.tuntutan');
    Route::post('bkoku/hantar/{id}', [PenyelarasController::class, 'hantarTuntutan'])->name('bkoku.hantar.tuntutan');
    Route::get('penyelaras/bkoku/tuntutan/delete/{id}', [PenyelarasController::class, 'deleteTuntutan'])->name('bkoku.tuntutan.delete');
	Route::get('penyelaras/bkoku/tuntutan/batal/{id}', [PenyelarasController::class, 'batalTuntutan'])->name('bkoku.tuntutan.batal');
    Route::get('penyelaras/bkoku/sejarah/sejarah-tuntutan', [PenyelarasController::class, 'sejarahTuntutan'])->name('bkoku.sejarah.tuntutan');
    Route::get('penyelaras/bkoku/sejarah/rekod-tuntutan/{id}', [PenyelarasController::class, 'rekodTuntutan'])->name('bkoku.rekod.tuntutan');
    Route::get('penyelaras/bkoku/sejarah/papar-tuntutan/{id}', [PenyelarasController::class, 'paparRekodTuntutan'])->name('bkoku.papar.rekod');
    Route::get('penyelaras/bkoku/sejarah/keputusan-peperiksaan/{id}', [PenyelarasController::class, 'keputusanPeperiksaan'])->name('bkoku.papar.peperiksaan');
    Route::get('penyelaras/bkoku/sejarah/papar-saringan/{id}', [PenyelarasController::class, 'paparRekodSaringanTuntutan'])->name('bkoku.papar.saringan.tuntutan');
    Route::get('penyelaras/bkoku/tuntutan/item/delete/{id}', [PenyelarasController::class, 'deleteItemTuntutan'])->name('bkoku.tuntutan.item.delete');
	Route::get('penyelaras/bkoku/tuntutan/batal/{id}', [PenyelarasController::class, 'batalTuntutan'])->name('bkoku.tuntutan.batal');


    //Permohonan - Penyelaras PPK
    Route::get('penyelaras/ppk/dashboard', [PenyelarasPPKController::class,'index'])->name('penyelaras.ppk.dashboard');
    Route::post('penyelaras/ppk/dashboard', [PenyelarasPPKController::class, 'store']);
    Route::get('penyelaras/ppk/permohonan/baharu/{id}', [PenyelarasPPKController::class, 'permohonanBaharu'])->name('penyelaras.ppk.permohonan.baharu');
    Route::get('/fetch-amaun', [PenyelarasPPKController::class, 'fetchAmaun']);
    Route::get('/bandar/{idnegeri}', [PenyelarasPPKController::class, 'bandar']);
    Route::get('/ppk/peringkat/{id}', [PenyelarasPPKController::class, 'peringkat']);
    Route::get('/kursus/ppk/{kodperingkat}/{id}', [PenyelarasPPKController::class, 'kursus']);
    Route::post('penyelaras/ppk/baharu', [PenyelarasPPKController::class, 'simpan'])->name('ppk.simpan');
    Route::post('/penyelaras/ppk/permohonan/baharu', [PenyelarasPPKController::class, 'kemaskini'])->name('ppk.kemaskini');
    Route::post('ppk/hantar', [PenyelarasPPKController::class, 'hantar'])->name('ppk.hantar');
    Route::get('penyelaras/ppk/permohonan/delete/{id}', [PenyelarasPPKController::class, 'deletePermohonan'])->name('ppk.permohonan.delete');
    Route::get('penyelaras/ppk/permohonan/batal/{id}', [PenyelarasPPKController::class, 'batalPermohonan'])->name('ppk.permohonan.batal');
    Route::get('penyelaras/ppk/senarai/permohonan-baharu', [PenyelarasPPKController::class, 'senaraiPermohonanBaharu'])->name('senarai.ppk.permohonanBaharu');
    Route::get('penyelaras/ppk/sejarah/sejarah-permohonan', [PenyelarasPPKController::class, 'sejarahPermohonan'])->name('ppk.sejarah.permohonan');
    Route::get('penyelaras/ppk/sejarah/rekod-permohonan/{id}', [PenyelarasPPKController::class, 'rekodPermohonan'])->name('ppk.rekod.permohonan');
    Route::get('penyelaras/ppk/sejarah/papar-permohonan/{id}', [PenyelarasPPKController::class, 'paparRekodPermohonan'])->name('ppk.papar.rekod.permohonan');
    Route::get('penyelaras/ppk/sejarah/permohonan/papar-saringan/{id}', [PenyelarasPPKController::class, 'paparRekodSaringan'])->name('ppk.papar.rekod.saringan');
    Route::get('penyelaras/ppk/sejarah/permohonan/papar-kelulusan/{id}', [PenyelarasPPKController::class, 'paparRekodKelulusan'])->name('ppk.papar.rekod.kelulusan');
    Route::get('penyelaras/ppk/maklumat-profil-diri/{id}', [SaringanController::class, 'maklumatProfilDiri'])->name('ppk.papar.maklumat.diri');
    Route::get('penyelaras/ppk/maklumat-akademik/{id}', [SaringanController::class, 'maklumatAkademik'])->name('ppk.papar.maklumat.akademik');
    Route::get('penyelaras/ppk/salinan-dokumen/{id}', [SaringanController::class, 'salinanDokumen'])->name('ppk.papar.salinan.dokumen');
    Route::get('penyelaras/ppk/senarai/permohonan-dibayar', [PenyelarasPPKController::class, 'senaraiDibayar'])->name('senarai.ppk.permohonanDibayar');


    //delete pendaftaran - Penyelaras PPK
    Route::get('penyelaras/ppk/pendaftaran/delete/{id}', [PenyelarasPPKController::class, 'deletePendaftaran'])->name('ppk.pendaftaran.delete');

    //Tuntutan - Penyelaras PPK
    Route::get('penyelaras/ppk/senarai/tuntutan-baharu', [PenyelarasPPKController::class, 'senaraiTuntutanBaharu'])->name('senarai.ppk.tuntutanBaharu');
    Route::get('ppk/kemaskini/keputusan/{id}', [PenyelarasPPKController::class, 'kemaskiniKeputusan'])->name('ppk.kemaskini.keputusan');
    Route::post('ppk/hantar/keputusan/{id}', [PenyelarasPPKController::class, 'hantarKeputusanPeperiksaan'])->name('ppk.keputusan.hantar');
    Route::post('ppk/hantar/{id}', [PenyelarasPPKController::class, 'hantarTuntutan'])->name('ppk.tuntutan.hantar');
    Route::get('penyelaras/ppk/sejarah/sejarah-tuntutan', [PenyelarasPPKController::class, 'sejarahTuntutan'])->name('ppk.sejarah.tuntutan');
    Route::get('penyelaras/ppk/sejarah/rekod-tuntutan/{id}', [PenyelarasPPKController::class, 'rekodTuntutan'])->name('ppk.rekod.tuntutan');
    Route::get('penyelaras/ppk/sejarah/papar-tuntutan/{id}', [PenyelarasPPKController::class, 'paparRekodTuntutan'])->name('ppk.papar.rekod');
    Route::get('penyelaras/ppk/sejarah/keputusan-peperiksaan/{id}', [PenyelarasPPKController::class, 'keputusanPeperiksaan'])->name('ppk.papar.peperiksaan');
    Route::get('penyelaras/ppk/sejarah/papar-saringan/{id}', [PenyelarasPPKController::class, 'paparRekodSaringanTuntutan'])->name('ppk.papar.saringan.tuntutan');
    Route::get('penyelaras/ppk/tuntutan/batal/{id}', [PenyelarasPPKController::class, 'batalTuntutan'])->name('ppk.tuntutan.batal');
    Route::get('penyelaras/ppk/senarai/tuntutan-dibayar', [PenyelarasPPKController::class, 'tuntutanDibayar'])->name('senarai.ppk.tuntutanDibayar');

    //Pentadbir
    Route::get('pentadbir/dashboard', [PentadbirController::class,'index'])->name('pentadbir.dashboard');
    Route::get('daftarpengguna', [PentadbirController::class, 'daftar'])->name('daftarpengguna');
    Route::post('daftarpengguna', [PentadbirController::class, 'store'])->name('daftarpengguna.post');
    Route::get('pentadbir/api-connection', [PentadbirController::class, 'checkConnection'])->name('semak.api');
    // Route::get('pentadbir/api-connection/esp', [PentadbirController::class, 'checkConnectionESP'])->name('esp.api');
    // Route::get('pentadbir/api-connection/mqa', [PentadbirController::class, 'checkConnectionMQA'])->name('mqa.api');
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
