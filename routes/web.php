<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\SaringanController;
use App\Http\Controllers\SekretariatController;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PageController;

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

    /*Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::post('post-permohonan', [PermohonanController::class, 'postPermohonan'])->name('permohonan.post'); */


    Route::get('permohonan', [PermohonanController::class, 'permohonan'])->name('permohonan');
    Route::post('permohonan', [PermohonanController::class, 'store'])->name('permohonan.post');
    Route::get('viewpermohonan', [PermohonanController::class, 'viewpermohonan'])->name('viewpermohonan');
    Route::get('statuspermohonan', [PermohonanController::class, 'statuspermohonan'])->name('sejarahpermohonan');
    
    //Saring permohonan
    Route::get('saringan', [SaringanController::class, 'saringan']);
    Route::get('maklumat-pemohon/{no_kp}', [SaringanController::class, 'maklumatPemohon'])->name('no_kp');
    Route::get('maklumat-perbaharui', [SaringanController::class, 'maklumatPerbaharui'])->name('id');
    Route::get('maklumat-profil-diri/{no_kp}', [SaringanController::class, 'maklumatProfilDiri'])->name('no_kp');
    Route::get('maklumat-akademik/{no_kp}', [SaringanController::class, 'maklumatAkademik'])->name('no_kp');
    Route::get('maklumat-akademik2', [SaringanController::class, 'maklumatAkademik2'])->name('id');
    Route::get('maklumat-tuntutan/{no_kp}', [SaringanController::class, 'maklumatTuntutan'])->name('no_kp');
    Route::post('saring-tuntutan', [SaringanController::class, 'saringTuntutan']);
    Route::get('salinan-dokumen', [SaringanController::class, 'salinanDokumen'])->name('id');
    Route::get('salinan-invois', [SaringanController::class, 'salinanInvois'])->name('id');
    Route::get('salinan-akademik', [SaringanController::class, 'salinanAkademik'])->name('id');
    Route::get('cetak-maklumat-pemohon', [SaringanController::class, 'cetakMaklumatPemohon']);
    Route::post('saring-maklumat-pemohon/{no_kp}', [SaringanController::class, 'saringMaklumat']);

    //Permohonan - Sekretariat
    Route::get('sekretariatStatus', [SekretariatController::class, 'statusPermohonan']);
    Route::get('sekretariatKelulusan', [SekretariatController::class, 'keputusanSaringan']);
    Route::get('sekretariatKeputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::post('hantar-keputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::get('maklumat-keputusan', [SekretariatController::class, 'maklumatKeputusan']);
    Route::get('surat-tawaran', [SekretariatController::class, 'muatTurunSuratTawaran']);
    Route::get('cetak-senarai-pemohon', [SekretariatController::class, 'cetakSenaraiPemohonPDF']);
    Route::get('senarai-disokong-excel', [SekretariatController::class, 'cetakSenaraiPemohonExcel']);
    Route::get('/keputusan', [SekretariatController::class, 'mailKeputusan']);

    //Tuntutan - Sekretariat
    Route::get('tuntutan-keseluruhan', [SekretariatController::class, 'tuntutanKeseluruhan']);
    Route::get('tuntutan-saring', [SekretariatController::class, 'tuntutanSaring']);
    Route::get('tuntutan-kelulusan', [SekretariatController::class, 'tuntutanKelulusan']);
    Route::get('tuntutan-keputusan', [SekretariatController::class, 'tuntutanKeputusan']);

    Route::get('/uploadpage',[PageController::class,'uploadpage']);
    Route::post('/uploadproduct',[PageController::class,'store']);
    Route::get('/show',[PageController::class,'show']);
    Route::get('/download/{file}',[PageController::class,'download']);
    Route::get('/view/{is}',[PageController::class,'view']);

});


Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
