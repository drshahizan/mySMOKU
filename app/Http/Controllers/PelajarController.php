<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Akademik;
use App\Models\Bandar;
use App\Models\ButiranPelajar;
use App\Models\Dokumen;
use App\Models\Dun;
use App\Models\Hubungan;
use App\Models\InfoIpt;
use App\Models\KelasPenganugerahan;
use App\Models\Keturunan;
use App\Models\LanjutPengajian;
use App\Models\Negeri;
use App\Models\Parlimen;
use App\Models\PeringkatPengajian;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\Smoku;
use App\Models\TamatPengajian;
use App\Models\TangguhPengajian;
use App\Models\Tuntutan;
use App\Models\User;
use App\Models\Waris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelajarController extends Controller
{
    public function index()
    {
        $user = User::all()->where('no_kp',Auth::user()->no_kp);
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();

        $permohonan_id = Permohonan::orderby("id","desc")->where('smoku_id',$smoku_id->id)->first();
        if($permohonan_id !== null){
            $permohonan = SejarahPermohonan::orderby("sejarah_permohonan.created_at","desc")
            ->join('bk_status','bk_status.kod_status','=','sejarah_permohonan.status')
            ->get(['sejarah_permohonan.*','bk_status.status','sejarah_permohonan.status as kod_status'])
            ->where('smoku_id',$smoku_id->id)
            ->where('permohonan_id',$permohonan_id->id)
            ->where('status', '!=', 'DISOKONG');
        } 
        else {
            $permohonan = [];
        }


        $tuntutan_id = Tuntutan::orderby("id","desc")->where('smoku_id',$smoku_id->id)->first();
        if($tuntutan_id !== null){
            $tuntutan = Tuntutan::orderby("sejarah_tuntutan.created_at","desc")
                ->join('sejarah_tuntutan','sejarah_tuntutan.tuntutan_id','=','tuntutan.id')
                ->join('bk_status','bk_status.kod_status','=','sejarah_tuntutan.status')
                ->get(['sejarah_tuntutan.*','tuntutan.*','bk_status.status','tuntutan.status as status_semasa'])
                ->where('smoku_id',$smoku_id->id)
                ->where('tuntutan_id',$tuntutan_id->id)
                ->where('status', '!=', 'DISOKONG');
        } 
        else {
            $tuntutan = [];
        }
        

        $akademik = Akademik::join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->where('smoku_id',$smoku_id->id)
        ->where('status',1)
        ->first();

        if($akademik !== null)
        {
            $currentDate = Carbon::now();
            $tarikhMula = Carbon::parse($akademik->tarikh_mula);
            $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);
            $tarikhNextSem = $tarikhMula->addMonths($akademik->bil_bulan_per_sem);

            if($akademik->bil_bulan_per_sem == 6){
                $bilSem = 2;
            } else {
                $bilSem = 3;
            }
                
            $semSemasa = $akademik->sem_semasa;
            $totalSemesters = $akademik->tempoh_pengajian * $bilSem;

            if ($currentDate->greaterThan($tarikhTamat)) {
                echo "<script>
                    var userChoice;
                    var isValidChoice = false;

                    while (!isValidChoice) {
                        userChoice = prompt('Tempoh pengajian telah tamat. Sila pilih satu opsyen:\\n\\n1. Lapor Tamat Pengajian\\n2. Tangguh Pengajian\\n3. Perlanjutan Pengajian');

                        if (userChoice === null) {
                            // Handle the case when the user clicks cancel in the prompt
                            alert('Pilihan dibatalkan. Sila pilih satu opsyen.');
                        } else if (userChoice === '1') {
                            // Handle option 1
                            var confirmOption1 = confirm('Adakah anda pasti mahu lapor tamat pengajian?');
                            if (confirmOption1) {
                                window.location.href = '" . route('tamat.pengajian') . "'; // Redirect to option 1 route 
                                isValidChoice = true;
                            }
                        } else if (userChoice === '2') {
                            // Handle option 2
                            var confirmOption2 = confirm('Adakah anda pasti mahu tangguh pengajian?');
                            if (confirmOption2) {
                                window.location.href = '" . route('tangguh.pengajian') . "'; // Redirect to option 2 route 
                                isValidChoice = true;
                            }
                        } else if (userChoice === '3') {
                            // Handle option 3
                            var confirmOption3 = confirm('Adakah anda pasti mahu perlanjutan pengajian?');
                            if (confirmOption3) {
                                window.location.href = '" . route('lanjut.pengajian') . "'; // Redirect to option 3 route 
                                isValidChoice = true;
                            }
                        } else {
                            // Handle invalid input
                            alert('Pilihan tidak sah. Sila pilih antara 1, 2, atau 3.');
                        }
                    }
                </script>";
            }
        }

        return view('dashboard.pelajar.dashboard', compact('user','permohonan','permohonan_id','akademik','tuntutan'));
    }

    public function tamatPengajian()
    {   
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $tamat_pengajian = TamatPengajian::where('smoku_id', $smoku->id)->first();
        $maklumat_kerja = ButiranPelajar::where('smoku_id', $smoku->id)->first();

        $kelas = KelasPenganugerahan::all()->sortBy('id');

       
        // Initialize variables to hold uploaded file information
        $uploadedSijilTamat = [];
        $uploadedTranskrip = [];
        $cgpa = '';
        $kelas_p = '';
        $perakuan = '';
        $status_pekerjaan = '';
        $sektor = '';
        $pekerjaan = '';
        $pendapatan = '';

        // Check if $tamat_pengajian is not null and has uploaded files
        if ($tamat_pengajian) {
            if ($tamat_pengajian->sijil_tamat) {
                $uploadedSijilTamat = is_array($tamat_pengajian->sijil_tamat) ? $tamat_pengajian->sijil_tamat : [$tamat_pengajian->sijil_tamat];
            }

            if ($tamat_pengajian->transkrip) {
                $uploadedTranskrip = is_array($tamat_pengajian->transkrip) ? $tamat_pengajian->transkrip : [$tamat_pengajian->transkrip];
            }

            if($tamat_pengajian->cgpa){
                $cgpa = $tamat_pengajian->cgpa;
            }

            if($tamat_pengajian->kelas){
                $kelas_p = $tamat_pengajian->kelas;
            }

            if($tamat_pengajian->perakuan){
                $perakuan = $tamat_pengajian->perakuan;
            }
        }
        // Check if $maklumat_kerja is not null
        if ($maklumat_kerja) {
           

            if ($maklumat_kerja->status_pekerjaan) {
                $status_pekerjaan = $maklumat_kerja->status_pekerjaan ? $maklumat_kerja->status_pekerjaan : [$maklumat_kerja->status_pekerjaan];
            }

            if ($maklumat_kerja->sektor) {
                $sektor = $maklumat_kerja->sektor ? $maklumat_kerja->sektor : [$maklumat_kerja->sektor];
            }
            
            if ($maklumat_kerja->pekerjaan) {
                $pekerjaan = $maklumat_kerja->pekerjaan ? $maklumat_kerja->pekerjaan : [$maklumat_kerja->pekerjaan];
            }

            if($maklumat_kerja->pendapatan){
                $pendapatan = $maklumat_kerja->pendapatan ? $maklumat_kerja->pendapatan : [$maklumat_kerja->pendapatan];
            }
        }

        // dd($pekerjaan);

        return view('kemaskini.pelajar.lapor_tamat_pengajian', compact('uploadedSijilTamat', 'uploadedTranskrip', 'cgpa', 'kelas_p', 'perakuan', 'status_pekerjaan', 'sektor', 'pekerjaan', 'pendapatan', 'kelas'));
    }

    public function hantarTamatPengajian(Request $request)
    {
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

       // Validate incoming file uploads
        $validatedData = $request->validate([
            'sijilTamat.*' => 'required|mimes:pdf,jpg,jpeg,png|max:2048', // Maximum size in kilobytes (2 MB = 2048 KB)
            'transkrip.*' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $sijilTamat = $request->file('sijilTamat');
        $transkrip = $request->file('transkrip');
        $uploadedSijilTamat = [];
        $uploadedTranskrip = [];
        $cgpa = $request->cgpa;
        $kelas = $request->kelas;

        // Check if a record already exists
        $existingRecord = TamatPengajian::where('smoku_id', $smoku->id)
            ->where('permohonan_id', $permohonan->id)
            ->first();

        if ($sijilTamat && $transkrip) {
            foreach ($sijilTamat as $key => $sijil) {
                $uniqueFilenameSijil = uniqid() . '_' . $sijil->getClientOriginalName();
                $sijil->move('assets/dokumen/sijil_tamat', $uniqueFilenameSijil);
                $uploadedSijilTamat[] = $uniqueFilenameSijil;

                $uniqueFilenameTranskrip = uniqid() . '_' . $transkrip[$key]->getClientOriginalName();
                $transkrip[$key]->move('assets/dokumen/salinan_transkrip', $uniqueFilenameTranskrip);
                $uploadedTranskrip[] = $uniqueFilenameTranskrip;

                if ($existingRecord) {
                    // Update the existing record with the new file names
                    $existingRecord->sijil_tamat = $uniqueFilenameSijil;
                    $existingRecord->transkrip = $uniqueFilenameTranskrip;
                    $existingRecord->cgpa = $request->cgpa;
                    $existingRecord->kelas = $request->kelas;
                    $existingRecord->perakuan = $request->perakuan;
                    $existingRecord->save();
                } else {
                    // Create a new record
                    $tamatPengajian = new TamatPengajian();
                    $tamatPengajian->smoku_id = $smoku->id;
                    $tamatPengajian->permohonan_id = $permohonan->id;
                    $tamatPengajian->sijil_tamat = $uniqueFilenameSijil;
                    $tamatPengajian->transkrip = $uniqueFilenameTranskrip;
                    $tamatPengajian->cgpa = $request->cgpa;
                    $tamatPengajian->kelas = $request->kelas;
                    $tamatPengajian->perakuan = $request->perakuan;
                    $tamatPengajian->save();
                }
            }
        }

        //update maklumat pekerjaan
        $status_pekerjaan = $request->status_pekerjaan;
        $sektor = $request->sektor;
        $pekerjaan = strtoupper($request->pekerjaan);
        $pendapatan = $request->pendapatan;

        // Check if status_pekerjaan is 'TIDAK BEKERJA'
        if ($status_pekerjaan === 'TIDAK BEKERJA') {
            $sektor = null;
            $pekerjaan = null;
            $pendapatan = null;
        }

        ButiranPelajar::where('smoku_id', $smoku->id)
            ->update([
                'status_pekerjaan' => $status_pekerjaan,
                'sektor' => $sektor,
                'pekerjaan' => $pekerjaan,
                'pendapatan' => $pendapatan
            ]);

        // Store the uploaded file names or URLs in the session
        session()->put('uploadedSijilTamat', $uploadedSijilTamat);
        session()->put('uploadedTranskrip', $uploadedTranskrip);
        session()->put('perakuan', $request->input('perakuan'));

        return redirect()->route('tamat.pengajian')->with('success', 'Dokumen lapor diri tamat pengajian telah berjaya dihantar.');
    }

    public function tangguhPengajian()
    {   
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id', $smoku->id)->first();

        return view('kemaskini.pelajar.tangguh_pengajian',compact('permohonan'));
    }

    public function hantarTangguhPengajian(Request $request)
    {
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

        if (!$smoku || !$permohonan) {
            return redirect()->route('tamat.pengajian')->with('error', 'Permohonan tidak ditemui.');
        }

        $suratTangguh = $request->file('suratTangguh');
        $sokongan = $request->file('sokongan');
        $uploadedsuratTangguh = [];
        $uploadedSokongan = [];

        // Check if a record already exists
        $existingRecord = TangguhPengajian::where('smoku_id', $smoku->id)
            ->where('permohonan_id', $permohonan->id)
            ->first();

        if ($suratTangguh && $sokongan) {
            foreach ($suratTangguh as $key => $surat) {
                $uniqueFilenameSurat = uniqid() . '_' . $surat->getClientOriginalName();
                $surat->move('assets/dokumen/surat_tangguh_lanjut', $uniqueFilenameSurat);
                $uploadedsuratTangguh[] = $uniqueFilenameSurat;

                $uniqueFilenameSokongan = uniqid() . '_' . $sokongan[$key]->getClientOriginalName();
                $sokongan[$key]->move('assets/dokumen/surat_tangguh_lanjut', $uniqueFilenameSokongan);
                $uploadedSokongan[] = $uniqueFilenameSokongan;

                if ($existingRecord) {
                    // Update the existing record with the new file names
                    $existingRecord->surat_tangguh = $uniqueFilenameSurat;
                    $existingRecord->dokumen_sokongan = $uniqueFilenameSokongan;
                    $existingRecord->perakuan = $request->perakuan;
                    $existingRecord->save();
                } else {
                    // Create a new record
                    $tamatPengajian = new TangguhPengajian();
                    $tamatPengajian->smoku_id = $smoku->id;
                    $tamatPengajian->permohonan_id = $permohonan->id;
                    $tamatPengajian->surat_tangguh = $uniqueFilenameSurat;
                    $tamatPengajian->dokumen_sokongan = $uniqueFilenameSokongan;
                    $tamatPengajian->perakuan = $request->perakuan;
                    $tamatPengajian->save();
                }
            }
        }

        // Store the uploaded file names or URLs in the session
        session()->put('uploadedsuratTangguh', $uploadedsuratTangguh);
        session()->put('uploadedSokongan', $uploadedSokongan);
        session()->put('perakuan', $request->input('perakuan'));

        return redirect()->route('tangguh.pengajian')->with('success', 'Dokumen penangguhan pengajian telah dihantar.');
    }

    public function lanjutPengajian()
    {   
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id', $smoku->id)->first();

        return view('kemaskini.pelajar.lanjut_pengajian',compact('permohonan'));
    }

    public function hantarLanjutPengajian(Request $request)
    {
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

        if (!$smoku || !$permohonan) {
            return redirect()->route('lanjut.pengajian')->with('error', 'Permohonan tidak ditemui.');
        }

        $suratLanjut = $request->file('suratLanjut');
        $jadual = $request->file('jadual');
        $sokongan = $request->file('sokongan');
        $uploadedSuratLanjut = [];
        $uploadedJadual = [];
        $uploadedSokongan = [];

        // Check if a record already exists
        $existingRecord = LanjutPengajian::where('smoku_id', $smoku->id)
            ->where('permohonan_id', $permohonan->id)
            ->first();

        if ($suratLanjut && $jadual && $sokongan) {
            foreach ($suratLanjut as $key => $surat) {
                $uniqueFilenameSurat = uniqid() . '_' . $surat->getClientOriginalName();
                $surat->move('assets/dokumen/surat_tangguh_lanjut', $uniqueFilenameSurat);
                $uploadedSuratLanjut[] = $uniqueFilenameSurat;

                $uniqueFilenameJadual = uniqid() . '_' . $jadual[$key]->getClientOriginalName();
                $jadual[$key]->move('assets/dokumen/surat_tangguh_lanjut', $uniqueFilenameJadual);
                $uploadedJadual[] = $uniqueFilenameJadual;

                $uniqueFilenameSokongan = uniqid() . '_' . $sokongan[$key]->getClientOriginalName();
                $sokongan[$key]->move('assets/dokumen/surat_tangguh_lanjut', $uniqueFilenameSokongan);
                $uploadedSokongan[] = $uniqueFilenameSokongan;

                if ($existingRecord) {
                    // Update the existing record with the new file names
                    $existingRecord->surat_lanjut = $uniqueFilenameSurat;
                    $existingRecord->jadual = $uniqueFilenameJadual;
                    $existingRecord->dokumen_sokongan = $uniqueFilenameSokongan;
                    $existingRecord->perakuan = $request->perakuan;
                    $existingRecord->save();
                } else {
                    // Create a new record
                    $tamatPengajian = new LanjutPengajian();
                    $tamatPengajian->smoku_id = $smoku->id;
                    $tamatPengajian->permohonan_id = $permohonan->id;
                    $tamatPengajian->surat_lanjut = $uniqueFilenameSurat;
                    $tamatPengajian->jadual = $uniqueFilenameJadual;
                    $tamatPengajian->dokumen_sokongan = $uniqueFilenameSokongan;
                    $tamatPengajian->perakuan = $request->perakuan;
                    $tamatPengajian->save();
                }
            }
        }

        // Store the uploaded file names or URLs in the session
        session()->put('uploadedSuratLanjut', $uploadedSuratLanjut);
        session()->put('uploadedJadual', $uploadedJadual);
        session()->put('uploadedSokongan', $uploadedSokongan);
        session()->put('perakuan', $request->input('perakuan'));

        return redirect()->route('lanjut.pengajian')->with('success', 'Dokumen pelanjutan pengajian telah dihantar.');
    }

    public function profilPelajar()
    {   
        $smoku = Smoku::leftJoin('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
            ->leftJoin('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
            ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
            ->where('no_kp', Auth::user()->no_kp)
            ->get(['smoku.*','smoku.id as smoku_id','bk_jenis_oku.*','bk_jantina.*','bk_keturunan.*'])
            ->first();
        $butiranPelajar = ButiranPelajar::where('smoku_id', $smoku->smoku_id)->first();
        
        $negeri = Negeri::all()->sortBy('id');
        $bandar = Bandar::all()->sortBy('id');
        $keturunan = Keturunan::all()->sortBy('id');
        $agama = Agama::all()->sortBy('id');
        $parlimen = Parlimen::all()->sortBy('id');
        $dun = Dun::all()->sortBy('id');

        $waris = Waris::where('smoku_id', $smoku->smoku_id)->first();
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');

        $akademik = Akademik::where('smoku_id', $smoku->smoku_id)->where('status', 1)->first();
        $institusi = InfoIpt::orderby("id","asc")->select('id_institusi','nama_institusi')->get();

        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');

        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->smoku_id)->first();
        $dokumen = Dokumen::where('permohonan_id', $permohonan->id)->get();

        return view('kemaskini.pelajar.profil_pelajar',compact('smoku','butiranPelajar','negeri','keturunan','agama','bandar','parlimen','dun','waris','hubungan','akademik','institusi','peringkat','dokumen'));
    }

    public function simpanProfilPelajar(Request $request)
    {  
        $smoku = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $butiran_pelajar = ButiranPelajar::where('smoku_id',$smoku->id)->first();
        $waris = Waris::where('smoku_id',$smoku->id)->first();
        $akademik = Akademik::where('smoku_id',$smoku->id)->where('status', 1)->first();

        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

        $dokumen1 = Dokumen::where('permohonan_id', $permohonan->id)->where('id_dokumen', 1)->first();
        $dokumen2 = Dokumen::where('permohonan_id', $permohonan->id)->where('id_dokumen', 2)->first();

        // Get the current values
        $currentValues = [
            'nama' => $smoku->nama,
            'no_kp' => $smoku->no_kp,
            'tarikh_lahir' => $smoku->tarikh_lahir,
            'umur' => $smoku->umur,
            'keturunan' => $smoku->keturunan,
            'email' => $smoku->email,
            'no_akaun_bank' => $butiran_pelajar->no_akaun_bank,
            'negeri_lahir' => $butiran_pelajar->negeri_lahir,
            'agama' => $butiran_pelajar->agama,
            'alamat_tetap' => $butiran_pelajar->alamat_tetap,
            'alamat_tetap_negeri' => $butiran_pelajar->alamat_tetap_negeri,
            'alamat_tetap_bandar' => $butiran_pelajar->alamat_tetap_bandar,
            'alamat_tetap_poskod' => $butiran_pelajar->alamat_tetap_poskod,
            'parlimen' => $butiran_pelajar->parlimen,
            'dun' => $butiran_pelajar->dun,
            'alamat_surat_menyurat' => $butiran_pelajar->alamat_surat_menyurat,
            'alamat_surat_negeri' => $butiran_pelajar->alamat_surat_negeri,
            'alamat_surat_bandar' => $butiran_pelajar->alamat_surat_bandar,
            'alamat_surat_poskod' => $butiran_pelajar->alamat_surat_poskod,
            'tel_bimbit' => $butiran_pelajar->tel_bimbit,
            'tel_rumah' => $butiran_pelajar->tel_rumah,
            'status_pekerjaan' => $butiran_pelajar->status_pekerjaan,
            'pekerjaan' => $butiran_pelajar->pekerjaan,
            'pendapatan' => $butiran_pelajar->pendapatan,
            'nama_waris' => $waris->nama_waris,
            'no_kp_waris' => $waris->no_kp_waris,
            'no_pasport_waris' => $waris->no_pasport_waris,
            'tel_bimbit_waris' => $waris->tel_bimbit_waris,
            'hubungan_lain_waris' => $waris->hubungan_lain_waris,
            'alamat_waris' => $waris->alamat_waris,
            'alamat_negeri_waris' => $waris->alamat_negeri_waris,
            'alamat_bandar_waris' => $waris->alamat_bandar_waris,
            'alamat_poskod_waris' => $waris->alamat_poskod_waris,
            'pekerjaan_waris' => $waris->pekerjaan_waris,
            'pendapatan_waris' => $waris->pendapatan_waris,
            'no_pendaftaran_pelajar' => $akademik->no_pendaftaran_pelajar,
            'peringkat_pengajian' => $akademik->peringkat_pengajian,
            'nama_kursus' => $akademik->nama_kursus,
            'tempoh_pengajian' => $akademik->tempoh_pengajian,
            'bil_bulan_per_sem' => $akademik->bil_bulan_per_sem,
            'dokumen' => $dokumen1->dokumen ?? '',
            'catatan' => $dokumen1->catatan ?? '',
            'dokumen' => $dokumen2->dokumen ?? '',
            'catatan' => $dokumen2->catatan ?? ''
        ];
        

        // Update the values
        $smoku->update([
            'nama' => strtoupper($request->nama_pelajar),
            'email' => $request->emel,
        ]);

        User::where('no_kp',Auth::user()->no_kp)
        ->update([
            'nama' => strtoupper($request->nama_pelajar),
            'no_kp' => $request->no_kp,
            'email' => $request->emel
        ]);

        if($butiran_pelajar != null) {
            ButiranPelajar::where('smoku_id' ,$smoku->id)
                ->update([
                    'emel' => $request->emel,
                    'no_akaun_bank' => $request->no_akaun_bank,
                    'negeri_lahir' => $request->negeri_lahir,
                    'agama' => $request->agama,
                    'alamat_tetap' => strtoupper($request->alamat_tetap),
                    'alamat_tetap_negeri' => $request->alamat_tetap_negeri,
                    'alamat_tetap_bandar' => $request->alamat_tetap_bandar,
                    'alamat_tetap_poskod' => $request->alamat_tetap_poskod,
                    'parlimen' => $request->parlimen,
                    'dun' => $request->dun,
                    'alamat_surat_menyurat' => strtoupper($request->alamat_surat_menyurat),
                    'alamat_surat_negeri' => $request->alamat_surat_negeri,
                    'alamat_surat_bandar' => $request->alamat_surat_bandar,
                    'alamat_surat_poskod' => $request->alamat_surat_poskod,
                    'tel_bimbit' => str_replace('-', '', $request->tel_bimbit),
                    'tel_rumah' => str_replace('-', '', $request->tel_rumah),
                    'status_pekerjaan' => $request->status_pekerjaan,
                    'pekerjaan' => strtoupper($request->pekerjaan),
                    'pendapatan' => $request->pendapatan
    
                ]);
        }

        if($waris != null) {
            Waris::where('smoku_id' ,$smoku->id)
                ->update([
                    'nama_waris' => strtoupper($request->nama_waris),
                    'no_kp_waris' => $request->no_kp_waris,
                    'no_pasport_waris' => $request->no_pasport_waris,
                    'tel_bimbit_waris' => str_replace('-', '', $request->tel_bimbit_waris),
                    'hubungan_lain_waris' => $request->hubungan_lain_waris,
                    'alamat_waris' => strtoupper($request->alamat_waris),
                    'alamat_negeri_waris' => $request->alamat_negeri_waris,
                    'alamat_bandar_waris' => $request->alamat_bandar_waris,
                    'alamat_poskod_waris' => $request->alamat_poskod_waris,
                    'pekerjaan_waris' => strtoupper($request->pekerjaan_waris),
                    'pendapatan_waris' => $request->pendapatan_waris
    
                ]);
        }

        if($akademik != null) {
            Akademik::where('smoku_id' ,$smoku->id)->where('status', 1)
                ->update([
                    'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
                    'peringkat_pengajian' => $request->peringkat_pengajian,
                    'nama_kursus' => $request->nama_kursus,
                    'tempoh_pengajian' => $request->tempoh_pengajian,
                    'bil_bulan_per_sem' => $request->bil_bulan_per_sem
                ]);
        }

        $runningNumber = rand(1000, 9999);

        $documentTypes = [
            'akaunBank' => 1,
            'suratTawaran' => 2,
            'invoisResit' => 3,
        ];

        foreach ($documentTypes as $inputName => $idDokumen) {
            $file = $request->file($inputName);

            if ($file) {
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                $newFilename = $filenameWithoutExtension . '_' . $runningNumber . '.' . $extension;
                $file->move('assets/dokumen/permohonan', $newFilename);

                // Check if the document already exists
                $existingDocument = Dokumen::where('permohonan_id', $permohonan->id)
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
                    $data->permohonan_id = $permohonan->id;
                    $data->id_dokumen = $idDokumen;
                    $data->dokumen = $newFilename;
                    $data->catatan = $request->input("nota_$inputName");

                    // Save the new instance to the database
                    $data->save();
                }
            }
            else {
                // Update all documents that match the conditions
                Dokumen::where('permohonan_id', $permohonan->id)
                ->where('id_dokumen', $idDokumen)
                ->update(['catatan' => $request->input("nota_$inputName")]);
            }

            
        }

        // Check if any updates were made
        $updatedValues = [
            'nama' => $request->nama_pelajar,
            'no_kp' => $request->no_kp,
            'tarikh_lahir' => $request->tarikh_lahir,
            'umur' => intval($request->umur),
            'keturunan' => $request->keturunan,
            'email' => $request->emel,
            'no_akaun_bank' => $request->no_akaun_bank,
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
            'tel_rumah' => $request->tel_rumah ?? "",
            'status_pekerjaan' => $request->status_pekerjaan,
            'pekerjaan' => $request->pekerjaan ?? "",
            'pendapatan' => $request->pendapatan,
            'nama_waris' => $request->nama_waris,
            'no_kp_waris' => $request->no_kp_waris,
            'no_pasport_waris' => $request->no_pasport_waris,
            'tel_bimbit_waris' => $request->tel_bimbit_waris,
            'hubungan_lain_waris' => $request->hubungan_lain_waris,
            'alamat_waris' => $request->alamat_waris,
            'alamat_negeri_waris' => $request->alamat_negeri_waris,
            'alamat_bandar_waris' => $request->alamat_bandar_waris,
            'alamat_poskod_waris' => $request->alamat_poskod_waris,
            'pekerjaan_waris' => $request->pekerjaan_waris,
            'pendapatan_waris' => $request->pendapatan_waris,
            'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
            'peringkat_pengajian' => $request->peringkat_pengajian,
            'nama_kursus' => $request->nama_kursus,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
            'dokumen' => $dokumen1->dokumen ?? '',
            'catatan' => $request->input("nota_akaunBank"),
            'dokumen' => $dokumen2->dokumen ?? '',
            'catatan' => $request->input("nota_suratTawaran")
        ];

        
        if ($currentValues != $updatedValues) {    
            return back()->with('success', 'Maklumat profil berjaya dikemaskini.');
        }

        // No updates were made
        return back();
    }

}
