<?php

namespace App\Http\Controllers;

use App\Mail\PengesahanCGPA;

use App\Http\Controllers\Controller;
use App\Mail\PermohonanHantar;
use Illuminate\Http\Request;
use App\Models\ButiranPelajar;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\User;
use App\Models\Smoku;
use App\Models\InfoIpt;
use App\Models\PeringkatPengajian;
use App\Models\Kursus;
use App\Models\Mod;
use App\Models\SumberBiaya;
use App\Models\Penaja;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\JenisOku;
use App\Models\Dokumen;
use App\Models\Peperiksaan;
use App\Models\Hubungan;
use App\Models\Negeri;
use App\Models\Bandar;
use App\Models\Agama;
use App\Models\Dun;
use App\Models\EmelKemaskini;
use App\Models\JumlahTuntutan;
use App\Models\Keturunan;
use App\Models\Parlimen;
use App\Models\Saringan;
use App\Models\TamatPengajian;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PermohonanController extends Controller
{
    public function permohonan()
    {
        $smoku = Smoku::join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
        ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
        ->leftJoin('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
        ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*'])
        ->where('no_kp', Auth::user()->no_kp);
        
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();

        $akademikmqa = Akademik::leftJoin('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
        ->leftJoin('bk_peringkat_pengajian', 'bk_peringkat_pengajian.kod_peringkat', '=', 'smoku_akademik.peringkat_pengajian')
        ->where('smoku_id', $smoku_id->id)
        ->where('smoku_akademik.status', 1)
        ->select('smoku_akademik.*', 'bk_info_institusi.*', 'bk_peringkat_pengajian.*', 'smoku_akademik.status as akademik_status')
        ->first();

        $mod = Mod::all()->sortBy('kod_mod');
        $keturunan = Keturunan::all()->sortBy('id');
        $biaya = SumberBiaya::all()->sortBy('id');
        $penaja = Penaja::orderby("penaja","asc")->get();
        $penajaArray = $penaja->toArray();
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');
        $negeri = Negeri::orderby("kod_negeri","asc")->select('id','negeri','kod_negeri')->get();
        $bandar = Bandar::orderby("id","asc")->select('id','bandar')->get();
        $parlimen = Parlimen::orderby("id","asc")->get();
        $dun = Dun::orderby("id","asc")->get();
        $agama = Agama::orderby("id","asc")->select('id','agama')->get();
        $institusi = InfoIpt::orderby("id","asc")->select('id_institusi','nama_institusi')->get();
        $infoipt = InfoIpt::all()->where('jenis_institusi','IPTS')->sortBy('nama_institusi');
        $peringkat = PeringkatPengajian::orderby("kod_peringkat","asc")->select('kod_peringkat','peringkat')->get();
        // $permohonan = Permohonan::orderby("id","desc")->where('smoku_id', $smoku_id->id)->first();

        $peringkat_pengajian = $akademikmqa->peringkat_pengajian;
        $permohonan = Permohonan::where('smoku_id', $smoku_id->id)
            ->where(function ($q) use ($peringkat_pengajian) {
                $q->whereRaw("
                    CAST(NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') AS UNSIGNED) = ?
                ", [$peringkat_pengajian])
                ->orWhereRaw("
                    NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') IS NULL
                ");
            })
            ->orderBy('id', 'desc')
            ->first();
        
        
        
        if ($permohonan && $permohonan->status >= '1' && $permohonan->status != '9') {
            $tamat_pengajian = TamatPengajian::orderBy('id', 'desc')->where('permohonan_id', $permohonan->id)->first();
           
            if ($tamat_pengajian) {

                $permohonan_baru = Permohonan::orderBy('id', 'desc')
                        ->where('smoku_id', $smoku_id->id)
                        ->where('id','!=', $tamat_pengajian->permohonan_id)
                        ->first();

                if ($permohonan_baru !== null)
                {
                    $butiranPelajar = ButiranPelajar::orderBy('permohonan.id', 'desc')
                        ->join('smoku', 'smoku.id', '=', 'smoku_butiran_pelajar.smoku_id')
                        ->join('smoku_waris', 'smoku_waris.smoku_id', '=', 'smoku.id')
                        ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku_butiran_pelajar.smoku_id')
                        ->join('permohonan', 'permohonan.smoku_id', '=', 'smoku_butiran_pelajar.smoku_id')
                        ->join('bk_jantina', 'bk_jantina.kod_jantina', '=', 'smoku.jantina')
                        ->join('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
                        ->join('bk_hubungan', 'bk_hubungan.kod_hubungan', '=', 'smoku.hubungan_waris')
                        ->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')
                        ->where('smoku.id', $smoku_id->id)
                        ->where('smoku_akademik.status', 1)
                        ->where('permohonan.status','!=', 6)
                        ->select(['smoku_butiran_pelajar.*', 'smoku.*','smoku_waris.*','smoku_akademik.*','bk_jantina.*', 'bk_keturunan.*','permohonan.*','bk_hubungan.*'])
                        ->first();
        
                    $dokumen = Dokumen::where('permohonan_id', $permohonan_baru->id)->get();
                    return view('permohonan.pelajar.permohonan_view', compact('butiranPelajar','hubungan','negeri','bandar','institusi','peringkat','mod','biaya','penaja','penajaArray','dokumen','permohonan','parlimen','dun','keturunan','agama'));
                }
                else{
                     return view('permohonan.pelajar.permohonan_baharu', compact('smoku','akademikmqa','infoipt','mod','biaya','penaja','penajaArray','hubungan','negeri','parlimen','dun','keturunan','agama','bandar'));
                }
   
            }else{

                $butiranPelajar = ButiranPelajar::orderBy('permohonan.id', 'desc')
                    ->leftJoin('smoku','smoku.id','=','smoku_butiran_pelajar.smoku_id')
                    ->leftJoin('smoku_waris','smoku_waris.smoku_id','=','smoku_butiran_pelajar.smoku_id')
                    ->leftJoin('smoku_akademik','smoku_akademik.smoku_id','=','smoku_butiran_pelajar.smoku_id')
                    ->leftJoin('permohonan','permohonan.smoku_id','=','smoku_butiran_pelajar.smoku_id')
                    ->leftJoin('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
                    ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
                    ->leftJoin('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
                    ->leftJoin('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
                    ->leftJoin('bk_parlimen','bk_parlimen.id','=','smoku_butiran_pelajar.parlimen')
                    ->get(['smoku_butiran_pelajar.*','smoku_butiran_pelajar.alamat_tetap as alamat_tetap_baru',
                        'smoku_butiran_pelajar.alamat_surat_menyurat as alamat_surat_baru',
                        'smoku_butiran_pelajar.tel_bimbit as tel_bimbit_baru',
                        'smoku_butiran_pelajar.status_pekerjaan as status_pekerjaan_baru',
                        'smoku_butiran_pelajar.pekerjaan as pekerjaan_baru',
                        'smoku_butiran_pelajar.pendapatan as pendapatan_baru',
                        'smoku_butiran_pelajar.tel_rumah as tel_rumah_baru', 'smoku.*','smoku_waris.*','smoku_akademik.*','permohonan.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*','smoku_akademik.status as akademik_status', 'bk_parlimen.*', 'bk_parlimen.id as id_parlimen'])
                    ->where('smoku_id', $smoku_id->id)
                    ->where('akademik_status', 1)
                    ->first();
            }

            $dokumen = Dokumen::where('permohonan_id', $permohonan->id)->get();
            return view('permohonan.pelajar.permohonan_view', compact('smoku','butiranPelajar','hubungan','negeri','bandar','agama','institusi','peringkat','mod','biaya','penaja','penajaArray','dokumen','permohonan','parlimen','dun','keturunan'));
        }
        else {

            return view('permohonan.pelajar.permohonan_baharu', compact('smoku','akademikmqa','mod','biaya','penaja','penajaArray','hubungan','negeri','bandar','agama','parlimen','dun','keturunan'));
        }

    }

    public function getBandar($idnegeri=0)
    {

        $bandarData['data'] = Bandar::orderby("bandar","asc")
         ->select('id','bandar','negeri_id')
         ->where('negeri_id',$idnegeri)
         ->get();

         return response()->json($bandarData);

    }

    public function getParlimen($idnegeri=0)
    {

        $parlimenData['data'] = Parlimen::orderby("parlimen","asc")
         ->select('id','kod_parlimen','parlimen','negeri_id')
         ->where('negeri_id',$idnegeri)
         ->get();

         return response()->json($parlimenData);

    }

    public function getDun($idparlimen=0)
    {

        $dunData['data'] = Dun::orderby("id","asc")
         ->select('id','kod_dun','dun')
         ->where('parlimen_id',$idparlimen)
         ->get();

         return response()->json($dunData);

    }

    public function peringkat($ipt=0)
    {

        $peringkatData['data'] = Kursus::select('bk_kursus.kod_peringkat','bk_peringkat_pengajian.peringkat')
            ->join('bk_peringkat_pengajian', function ($join) {
                $join->on('bk_kursus.kod_peringkat', '=', 'bk_peringkat_pengajian.kod_peringkat');
            })
            ->where('id_institusi',$ipt)
            ->groupBy('bk_kursus.kod_peringkat','bk_peringkat_pengajian.peringkat')
            ->get();

        return response()->json($peringkatData);

    }

    public function kursus($kodperingkat=0,$ipt=0)
    {

        $kursusData['data'] = Kursus::orderby("nama_kursus","asc")
            ->select('id_institusi','kod_peringkat','nama_kursus')
            ->where('kod_peringkat',$kodperingkat)
            ->where('id_institusi',$ipt)
            ->get();

        return response()->json($kursusData);

    }

    public function getPenaja($sumber)
    {
        $penajaData['data'] = Penaja::orderby("penaja", "asc")
            ->select('id', 'sumber_id', 'penaja')
            ->where('sumber_id', $sumber)
            ->get();

        // Add "LAIN-LAIN" option to the penaja data
        $lainLainOption = [
            'id' => 99, // Replace with an appropriate ID
            'sumber_id' => $sumber, // Adjust as needed
            'penaja' => 'LAIN-LAIN',
        ];

        $penajaData['data']->push($lainLainOption);

        return response()->json($penajaData);
    }

    public function fetchAmaun()
    {
        $amaun_yuran = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Yuran')->first();
        $amaun_wang_saku = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();

        return response()->json([
            'amaun_yuran' => $amaun_yuran ? $amaun_yuran->jumlah : null,
            'amaun_wang_saku' => $amaun_wang_saku ? $amaun_wang_saku->jumlah : null
        ]);
    }

    public function simpanPermohonan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();

        Smoku::updateOrCreate(
            ['id' => $smoku_id->id],
            [
                'umur' => $request->umur,
                'email' => $request->emel,
                'keturunan' => $request->keturunan,
            ]
        );

        $butiranPelajar = ButiranPelajar::firstOrNew(['smoku_id' => $smoku_id->id]);

        $butiranPelajar->negeri_lahir = $request->negeri_lahir;
        $butiranPelajar->agama = $request->agama;
        $butiranPelajar->alamat_tetap = strtoupper($request->alamat_tetap);
        $butiranPelajar->alamat_tetap_negeri = $request->alamat_tetap_negeri;
        $butiranPelajar->alamat_tetap_bandar = $request->alamat_tetap_bandar;
        $butiranPelajar->alamat_tetap_poskod = $request->alamat_tetap_poskod;
        $butiranPelajar->parlimen = $request->parlimen;
        $butiranPelajar->dun = $request->dun;
        $butiranPelajar->alamat_surat_menyurat = strtoupper($request->alamat_surat_menyurat);
        $butiranPelajar->alamat_surat_negeri = $request->alamat_surat_negeri;
        $butiranPelajar->alamat_surat_bandar = $request->alamat_surat_bandar;
        $butiranPelajar->alamat_surat_poskod = $request->alamat_surat_poskod;
        $butiranPelajar->tel_bimbit = str_replace('-', '', $request->tel_bimbit);
        $butiranPelajar->tel_rumah = str_replace('-', '', $request->tel_rumah);
        $butiranPelajar->no_akaun_bank = $request->no_akaun_bank;
        $butiranPelajar->emel = $request->emel;
        $butiranPelajar->status_pekerjaan = $request->status_pekerjaan;
        $butiranPelajar->pekerjaan = strtoupper($request->pekerjaan);
        $butiranPelajar->pendapatan = $request->pendapatan;

        $butiranPelajar->save();

        $waris = Waris::firstOrNew(['smoku_id' => $smoku_id->id]);

        $waris->nama_waris = strtoupper($request->nama_waris);
        $waris->no_kp_waris = $request->no_kp_waris;
        $waris->no_pasport_waris = $request->no_pasport_waris;
        $waris->hubungan_waris = $request->hubungan_waris;
        $waris->hubungan_lain_waris = $request->hubungan_lain_waris;
        $waris->tel_bimbit_waris = str_replace('-', '', $request->tel_bimbit_waris);
        $waris->alamat_waris = strtoupper($request->alamat_waris);
        $waris->alamat_negeri_waris = $request->alamat_negeri_waris;
        $waris->alamat_bandar_waris = $request->alamat_bandar_waris;
        $waris->alamat_poskod_waris = $request->alamat_poskod_waris;
        $waris->pekerjaan_waris = strtoupper($request->pekerjaan_waris);
        $waris->pendapatan_waris = $request->pendapatan_waris;

        $waris->save();

        // Retrieve or create a Akademik record based on smoku_id
        $akademik = Akademik::where('smoku_id', $smoku_id->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        if (!$akademik) {
            $akademik = new Akademik();
            $akademik->smoku_id = $smoku_id->id;
            $akademik->status = 1;
        }

        // Update or create an Akademik record based on smoku_id
        //140126
        // Akademik::updateOrCreate(
        //     ['smoku_id' => $smoku_id->id, 'status' => 1], // Condition to find the record
        //     [
        //         'id_institusi' => $request->id_institusi,
        //         'nama_kursus' => $request->nama_kursus,
        //         'mod' => $request->mod,
        //         'tempoh_pengajian' => $request->tempoh_pengajian,
        //         'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
        //         'sesi' => $request->sesi,
        //         'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
        //         'tarikh_mula' => $request->tarikh_mula,
        //         'tarikh_tamat' => $request->tarikh_tamat,
        //         'sem_semasa' => $request->sem_semasa,
        //         'sumber_biaya' => $request->sumber_biaya,
        //         'sumber_lain' => $request->sumber_lain,
        //         'nama_penaja' => $request->nama_penaja,
        //         'penaja_lain' => $request->penaja_lain,
        //         'status' => '1',
        //     ]
        // );

        $akademik->id_institusi = $request->id_institusi;
        $akademik->nama_kursus = $request->nama_kursus;
        $akademik->peringkat_pengajian = $request->peringkat_pengajian;
        $akademik->mod = $request->mod;
        $akademik->tempoh_pengajian = $request->tempoh_pengajian;
        $akademik->bil_bulan_per_sem = $request->bil_bulan_per_sem;
        $akademik->sesi = $request->sesi;
        $akademik->no_pendaftaran_pelajar = $request->no_pendaftaran_pelajar;
        $akademik->tarikh_mula = $request->tarikh_mula;
        $akademik->tarikh_tamat = $request->tarikh_tamat;
        $akademik->sem_semasa = $request->sem_semasa;
        $akademik->sumber_biaya = $request->sumber_biaya;
        $akademik->sumber_lain = $request->sumber_lain;
        $akademik->nama_penaja = $request->nama_penaja;
        $akademik->penaja_lain = $request->penaja_lain;

        $akademik->save();

        $peringkat_pengajian = $akademik->peringkat_pengajian;

        $permohonan = Permohonan::where('smoku_id', $smoku_id->id)
            ->where(function ($q) use ($peringkat_pengajian) {
                $q->whereRaw("
                    CAST(NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') AS UNSIGNED) = ?
                ", [$peringkat_pengajian])
                ->orWhereRaw("
                    NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') IS NULL
                ");
            })
            ->orderBy('id', 'desc')
            ->first();

        $isNewPermohonan = false; 

        if (!$permohonan || $permohonan->status == 9 || $permohonan->status == 8) {
            $permohonan = Permohonan::create(
                [   'smoku_id' => $smoku_id->id,
                    'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.Auth::user()->no_kp,
                    'program' => 'BKOKU',
                    'yuran' => $request->yuran,
                    'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
                    'wang_saku' => $request->wang_saku,
                    'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                    'perakuan' => $request->perakuan,
                    'status' => 1,
                ]
            );
            $isNewPermohonan = true;
        } elseif ($permohonan->status == 1) {
            $permohonan->update([
                'no_rujukan_permohonan' => 'B/'.$request->peringkat_pengajian.'/'.Auth::user()->no_kp,
                'program' => 'BKOKU',
                'yuran' => $request->yuran,
                'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
                'wang_saku' => $request->wang_saku,
                'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                'perakuan' => $request->perakuan,
                // status kekal 1
            ]);
        } 

        if ($isNewPermohonan) {
            SejarahPermohonan::create([
                'smoku_id' => $smoku_id->id,
                'permohonan_id' => $permohonan->id,
                'status' => 1,
            ]);
        }

        $permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();
    }

    public function hantarPermohonan(Request $request)
    {   
        $docRules = 'nullable|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png';
        $request->validate([
            'akaunBank' => $docRules,
            'suratTawaran' => $docRules,
            'invoisResit' => $docRules,
            'dokumen' => 'sometimes|array',
            'dokumen.*' => $docRules,
        ]);

        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', '=', $smoku_id->id)->first();
        
        if ($permohonan != null) {
            Permohonan::where('smoku_id' ,$smoku_id->id)->where('id' ,$permohonan->id)
            ->update([
                'perakuan' => $request->perakuan,
                'tarikh_hantar' => now()->format('Y-m-d'),
                'status' => '2',

            ]);
        }

        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$smoku_id->id)->first();
        $mohon = SejarahPermohonan::create([
            'permohonan_id' => $permohonan_id->id,
            'smoku_id' => $smoku_id->id,
            'status' => '2',
    
        ]);
        $mohon->save();


        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$smoku_id->id)->first();

        $runningNumber = rand(1000, 9999);

        $documentTypes = [
            'akaunBank' => 1,
            'suratTawaran' => 2,
            'invoisResit' => 3,
        ];

        foreach ($documentTypes as $inputName => $idDokumen) {
            $file = $request->file($inputName);

            if ($file) {
                $extension = strtolower($file->getClientOriginalExtension());
                $newFilename = Str::uuid()->toString() . '.' . $extension;
                $file->move('assets/dokumen/permohonan', $newFilename);

                // Check if the document already exists
                $existingDocument = Dokumen::where('permohonan_id', $permohonan_id->id)
                    ->where('id_dokumen', $idDokumen)
                    ->first();

                if ($existingDocument) {
                    // Update the existing document
                    $existingDocument->dokumen = $newFilename;
                    $existingDocument->catatan = $request->input("nota_$inputName");
                    $existingDocument->save();
                } else {
                    // Create a new instance of dokumen and set its properties
                    $data = new Dokumen();
                    $data->permohonan_id = $permohonan_id->id;
                    $data->id_dokumen = $idDokumen;
                    $data->dokumen = $newFilename;
                    $data->catatan = $request->input("nota_$inputName");

                    // Save the new instance to the database
                    $data->save();
                }
            }
        }

        //TAMBAHAN FILE
        $dokumen = $request->file('dokumen'); 
        $catatan = $request->input('catatan'); 

        // Check if $dokumen is a valid array and $catatan is an array
        if (is_array($dokumen) && is_array($catatan)) {
            foreach ($dokumen as $key => $img) {
                $extension = strtolower($img->getClientOriginalExtension());
                $profileImage = Str::uuid()->toString() . '.' . $extension;
                $img->move('assets/dokumen/permohonan/', $profileImage);
                
                $tambahan = new dokumen();
                $tambahan->permohonan_id = $permohonan_id->id;
                $tambahan->id_dokumen = 4;
                $tambahan->dokumen = $profileImage;
                
                // Check if the corresponding catatan exists, otherwise, set it to null
                $tambahan->catatan = isset($catatan[$key]) ? $catatan[$key] : null;
                
                $tambahan->save();
            }
        } else {
            // Handle cases where $dokumen or $catatan are not valid arrays
        }

        //emel kepada sekretariat
        // $user_sekretariat = User::where('tahap',3)->first();
        // $cc = $user_sekretariat->email;


        // COMMENT PROD
        $catatan = "testing";
        $emel = EmelKemaskini::where('emel_id',13)->first();

        if (empty($invalidEmails)) 
        {
            Mail::to($smoku_id->email)->send(new PermohonanHantar($catatan,$emel));
        } 
        else {
            foreach ($invalidEmails as $invalidEmail) {
                 Log::error('Invalid email address: ' . $invalidEmail);
            }
        }
        
            
        return redirect()->route('pelajar.dashboard')->with('message', 'Permohonan anda telah dihantar.');
    }

    public function download(Request $request,$file)
    {   
        return response()->download(public_path('assets/dokumen/permohonan/'.$file));
    }

    public function kemaskiniPermohonan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        ButiranPelajar::where('smoku_id' ,$smoku_id->id)
        ->update([

                'negeri_lahir' => $request->negeri_lahir,
                'agama' => $request->agama,
                'alamat_tetap' => $request->alamat_tetap,
                'alamat_tetap_negeri' => $request->alamat_tetap_negeri,
                'alamat_tetap_bandar' => $request->alamat_tetap_bandar,
                'alamat_tetap_poskod' => $request->alamat_tetap_poskod,
                'parlimen' => $request->parlimen,
                'dun' => $request->dun,
                'alamat_surat_menyurat' => $request->alamat_surat_menyurat,
                'alamat_surat_negeri' => $request->alamat_surat_negeri,
                'alamat_surat_bandar' => $request->alamat_surat_bandar,
                'alamat_surat_poskod' => $request->alamat_surat_poskod,
                'tel_bimbit' => $request->tel_bimbit,
                'tel_rumah' => $request->tel_rumah,
                'no_akaun_bank' => $request->no_akaun_bank,
                'emel' => $request->emel,
                'status_pekerjaan' => $request->status_pekerjaan,
                'pekerjaan' => $request->pekerjaan,
                'pendapatan' => $request->pendapatan,

        ]);

        Waris::where('smoku_id' ,$smoku_id->id)
        ->update([

            'nama_waris' => $request->nama_waris,
            'no_kp_waris' => $request->no_kp_waris,
            'no_pasport_waris' => $request->no_pasport_waris,
            'hubungan_waris' => $request->hubungan_waris,
            'hubungan_lain_waris' => $request->hubungan_lain_waris,
            'tel_bimbit_waris' => $request->tel_bimbit_waris,
            'alamat_waris' => $request->alamat_waris,
            'alamat_negeri_waris' => $request->alamat_negeri_waris,
            'alamat_bandar_waris' => $request->alamat_bandar_waris,
            'alamat_poskod_waris' => $request->alamat_poskod_waris,
            'pekerjaan_waris' => $request->pekerjaan_waris,
            'pendapatan_waris' => $request->pendapatan_waris,

        ]);

        Akademik::where('smoku_id' ,$smoku_id->id)->where('status' ,1)
        ->update([

            'mod' => $request->mod,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
            'sesi' => $request->sesi,
            'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
            'tarikh_mula' => $request->tarikh_mula,
            'tarikh_tamat' => $request->tarikh_tamat,
            'sem_semasa' => $request->sem_semasa,
            'sumber_biaya' => $request->sumber_biaya,
            'sumber_lain' => $request->sumber_lain,
            'nama_penaja' => $request->nama_penaja,
            'penaja_lain' => $request->penaja_lain,
            'status' => '1',

        ]);

        Permohonan::where('smoku_id' ,$smoku_id->id)->where('status','!=',6)
        ->update([

            'yuran' => $request->yuran,
            'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
            'wang_saku' => $request->wang_saku,
            'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
            'perakuan' => $request->perakuan,
           
        ]);

        /*$permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();
        SejarahPermohonan::where('smoku_id' ,$smoku_id->id)
        ->where('permohonan_id' ,$permohonan_id->id)
        ->update([

            'permohonan_id' => $permohonan_id->id,
            'status' => '1',

        ]);*/
    }
 
    public function sejarahPermohonan()
    {
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $program = Permohonan::orderBy('id', 'desc')
            ->where('smoku_id', $smoku_id->id)
            ->first();

        $permohonan = Permohonan::orderBy('id', 'desc')
            ->where('smoku_id', $smoku_id->id)
            ->get();
        if ($program) {
            $catatan = Saringan::orderBy('id', 'desc')
            ->where('permohonan_id', $program->id)
            ->first();
        } else {
            $catatan = '';
        }


        $akademik = Akademik::where('smoku_id', $smoku_id->id)->where('status', 1)->first();
        $institusi = InfoIpt::where('id_institusi', $akademik->id_institusi)->first();    

        if ($permohonan) {
            return view('permohonan.pelajar.sejarah_permohonan', compact('permohonan','institusi','program','catatan'));
        } else {
            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Tiada permohonan lama.');
        }
    }

    public function batalPermohonan($id)
    {
        DB::table('permohonan')->orderBy('id', 'asc')->where('smoku_id',$id)
            ->update([
                'status' => 9
            ]);
        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        SejarahPermohonan::create([
            'smoku_id' => $id,
            'permohonan_id' => $permohonan_id->id,
            'status' => 9
        ]);
  
        return redirect()->route('pelajar.dashboard')->with('permohonan', 'Permohonan telah dibatalkan.');      
    }

    public function deletePermohonan($id)
    {
        
        $smoku_id = Smoku::where('id', $id)->first();
        $permohonan = DB::table('permohonan')->orderBy('id', 'asc')
            ->where('smoku_id', $smoku_id->id)->first();

        DB::table('smoku_butiran_pelajar')->where('smoku_id',$smoku_id->id)->delete();
        DB::table('smoku_waris')->where('smoku_id',$smoku_id->id)->delete();
        DB::table('smoku_akademik')->where('smoku_id',$smoku_id->id)->where('status',1)
        ->update([

            'no_pendaftaran_pelajar' => NULL,
            'sesi' => NULL,
            'tarikh_mula' => NULL,
            'tarikh_tamat' => NULL,
            'sem_semasa' => NULL,
            'tempoh_pengajian' => NULL,
            'bil_bulan_per_sem' => NULL,
            'mod' => NULL,
            'sumber_biaya' => NULL,
            'sumber_lain' => NULL,
            'nama_penaja' => NULL,
            'penaja_lain' => NULL,

        ]);

        if ($permohonan) {

            DB::table('permohonan')->where('id',$permohonan->id)->delete(); //delete permohonan
            DB::table('permohonan_dokumen')->where('permohonan_id',$permohonan->id)->delete();
            DB::table('sejarah_permohonan')->where('permohonan_id',$permohonan->id)->delete();
        } 
        
        return redirect()->route('pelajar.sejarah.permohonan');
        
    }

    public function kemaskiniKeputusan()
    {
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku_id->id)->first();
        $akademik = Akademik::where('smoku_id',$smoku_id->id)
            ->where('smoku_akademik.status', 1)
            ->first();
        
        $bilSem = ($akademik->bil_bulan_per_sem == 6) ? 2 : 3;
        $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
        $currentDate = Carbon::now();

        $tarikhMula = Carbon::parse($akademik->tarikh_mula);
        $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);

        $bulanMula  = $tarikhMula->format('n');
        $isSpecialStart = in_array($bulanMula, [1, 2, 3, 4, 5, 6]);

        // Initialize tahun sesi
        $tahunSesi = $isSpecialStart ? $tarikhMula->year - 1 : $tarikhMula->year;
        $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

        // echo 'tahunSesi: ' . $tahunSesi . ', SesiMula: ' . $sesiMula .  '<br>';

        // Define semester pattern
        if (in_array($bulanMula, [1, 2, 3, 4, 5, 6])) {
            if ($akademik->bil_bulan_per_sem == 6) {
                $pattern = [1, 2];
            } elseif ($akademik->bil_bulan_per_sem == 4) {
                $pattern = [2, 3];
            } else {
                $pattern = [$bilSem];
            }
        } else {
            $pattern = [$bilSem];
        }
        
        $patternIndex = 0;
        $currentPattern = $pattern[$patternIndex];
        $semInCurrentSesi = 0;

        $tarikhNextSem = clone $tarikhMula;
        $nextSemesterDates = [];
        $semCounter = 0;
        $semSemasa = 1;

        // Build all semesters
        while ($tarikhNextSem < $tarikhTamat) {
            $bulanMasuk = $tarikhNextSem->month;
            //     // 10092025 - tak kira semester dah. kira sesi 1 dan sesi 2 
            //     // sesi 1 untuk kemasukan bulan julai sehingga disember
            //     // sesi 2 untuk kemasukan bulan januari sehingga jun
            $sesi_bulan = in_array($bulanMasuk, [7,8,9,10,11,12]) ? 1 : 2;

            $nextSemesterDates[] = [
                'date'       => $tarikhNextSem->format('F Y'),
                'semester'   => $semSemasa,
                'sesi'       => $sesiMula,    // tahun akademik
                'sesi_bulan' => $sesi_bulan,  // sesi 1 atau 2
            ];

            $semSemasa++;
            $semCounter++;
            $semInCurrentSesi++;

            $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));

            if ($isSpecialStart) {
                if ($semInCurrentSesi >= $currentPattern) {
                    $semInCurrentSesi = 0;
                    $tahunSesi++;
                    $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

                    if ($patternIndex < count($pattern) - 1) {
                        $patternIndex++;
                    }
                    $currentPattern = $pattern[$patternIndex] ?? $pattern[count($pattern) - 1];
                }
            } else {
                if ($semCounter % $bilSem == 0) {
                    $tahunSesi++;
                    $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);
                }
            }
        }

        // Vars to store current/previous
        $currentSesi = null;
        $previousSesi = null;
        $semSemasa = null;
        $sesiSemasa = null;
        

        // Find current semester/session
        foreach ($nextSemesterDates as $key => $data) {
            $dateOfSemester = Carbon::parse($data['date']);

            // echo 'Date: ' . $data['date'] . ', Semester: ' . $data['semester'] . ', Tahun: ' . $data['sesi'] . ', Sesi: ' . $data['sesi_bulan'] . '<br>';

            $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) 
                ? Carbon::parse($nextSemesterDates[$key + 1]['date']) 
                : null;

            $semesterEndDate = $nextSemesterStartDate 
                ? $nextSemesterStartDate->subSecond() 
                : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());

            if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                $currentSesi = $data['sesi'];        // tahun akademik (eg. 2025/2026)
                $sesiSemasa  = $data['sesi_bulan'];  // sesi 1 atau 2
                $semSemasa   = $data['semester'];
                $semLepas    = $data['semester'] - 1;

                $sesiLepas = isset($nextSemesterDates[$key - 1]) 
                    ? $nextSemesterDates[$key - 1]['sesi_bulan'] 
                    : 'Tiada';
                $previousSesi = isset($nextSemesterDates[$key - 1]) 
                    ? $nextSemesterDates[$key - 1]['sesi'] 
                    : $data['sesi'];    
            }
        }

        $sesiLepas = $sesiLepas ?? null;

        // Example debug output
        // echo '<br>';
        // echo 'Tahun Lepas: ' . $previousSesi . '<br>';
        // echo 'Tahun Semasa: ' . $currentSesi . '<br>';
        // echo 'Sesi Lepas: ' . $sesiLepas . '<br>';
        // echo 'Sesi Semasa: ' . $sesiSemasa . '<br>';
        // echo 'Semester Semasa: ' . $semSemasa . '<br>';
        // dd('sini');


        if ($permohonan) 
        {
            $peperiksaan = Peperiksaan::where('permohonan_id', $permohonan->id)->get();
            $result = Peperiksaan::where('permohonan_id', $permohonan->id)
									->where('sesi', $previousSesi)
                                    ->where('semester', $sesiLepas)
									->first();
     
            return view('tuntutan.pelajar.kemaskini_keputusan_peperiksaan', compact('peperiksaan','smoku_id','permohonan','previousSesi','sesiLepas','result'));
        } 
        else {
            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }

    }

    public function save(Request $request)
    {   
        $request->validate([
            'kepPeperiksaan' => 'required|array',
            'kepPeperiksaan.*' => 'file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png',
        ]);

        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', '=', $smoku_id->id)->first();
        $emailmain = "bkoku@mohe.gov.my";

        $kepPeperiksaan=$request->kepPeperiksaan;

        foreach($kepPeperiksaan as $kepPeperiksaan) {
        
            $extension = strtolower($kepPeperiksaan->getClientOriginalExtension());
            $uniqueFilename = Str::uuid()->toString() . '.' . $extension;
            $kepPeperiksaan->move('assets/dokumen/peperiksaan',$uniqueFilename);

            $cgpa = $request->cgpa;
            if($cgpa >= 0.0 && $cgpa < 2.0){
                $pengesahan = 1;
                $catatan = "Pelajar telah menghantar keputusan peperiksaan semester lepas. Keputusan tersebut perlu pengesahan daripada Sekretariat KPT sebelum tuntutan dapat dikemukakan.";
                if (empty($invalidEmails)) 
                {            
                    // Mail::to($emailmain)->cc($smoku_id->email)->send(new PengesahanCGPA($catatan)); 
                    Mail::to($smoku_id->email)->send(new PengesahanCGPA($catatan)); 

                } 
                else 
                {
                    foreach ($invalidEmails as $invalidEmail) {
                        Log::error('Invalid email address: ' . $invalidEmail);
                    }
                }
            }else{
                $pengesahan = null;
            }
            
            $data=new peperiksaan();
            $data->permohonan_id=$permohonan->id;
            $data->sesi=$request->sesi;
            $data->semester=$request->semester;
            $data->cgpa=$request->cgpa;
            $data->pengesahan_rendah=$pengesahan;
            $data->kepPeperiksaan=$uniqueFilename;
            $data->save();
        }    

        return redirect()->route('kemaskini.keputusan')->with('success', 'Keputusan peperiksaan telah di simpan.');
    }

    public function deleteKeputusanPeperiksaan($id)
    {
        $keputusan_peperiksaan = Peperiksaan::where('id', $id)->first();

        if ($keputusan_peperiksaan) 
        {
            DB::table('permohonan_peperiksaan')->where('id',$keputusan_peperiksaan->id)->delete();
        } 
        
        return back();
    }

}


