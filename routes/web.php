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
    
    Route::get('saringan', [SaringanController::class, 'saringan']);
    Route::get('maklumat-pemohon', [SaringanController::class, 'maklumatPemohon'])->name('id');
    Route::get('maklumat-profil-diri', [SaringanController::class, 'maklumatProfilDiri'])->name('id');
    Route::get('maklumat-akademik', [SaringanController::class, 'maklumatAkademik'])->name('id');
    Route::get('salinan-dokumen', [SaringanController::class, 'salinanDokumen'])->name('id');
    Route::get('cetak-senarai-pemohon', [SaringanController::class, 'cetakSenaraiPemohon']);
    Route::get('cetak-maklumat-pemohon', [SaringanController::class, 'cetakMaklumatPemohon']);
    Route::get('send-mail', function () {
   
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
       
        Mail::to('ziba0506@gmail.com')->send(new \App\Mail\SaringanMail($details));
       
        dd("Email is Sent.");
    });
   
    //Permohonan - Sekretariat
    Route::get('sekretariatStatus', [SekretariatController::class, 'statusPermohonan']);
    Route::get('sekretariatKembalikan', [SekretariatController::class, 'kembalikanPermohonan']);
    Route::get('sekretariatKeputusan', [SekretariatController::class, 'keputusanPermohonan']);
    Route::get('suratTawaran', [SekretariatController::class, 'muatTurunSuratTawaran']);
});

//SEKRETARIAT
// Route::prefix('sekretariat')->middleware(['auth','isSekretariat'])->group(function(){
//     Route::get('sekretariatDashboard', [App\Http\Controllers\SekretariatController::class, 'dashboard'] );
    
//     //Permohonan
//     Route::get('sekretariatSP', [SekretariatController::class, 'statusPermohonan']);
//     Route::get('sekretariatKP', [SekretariatController::class, 'keputusanPermohonan']);
// });

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
