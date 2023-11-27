<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use App\Models\LanjutPengajian;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\Smoku;
use App\Models\TamatPengajian;
use App\Models\TangguhPengajian;
use App\Models\Tuntutan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelajarController extends Controller
{
    public function index()
    {
        $user = User::all()->where('no_kp',Auth::user()->no_kp);
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = SejarahPermohonan::orderby("sejarah_permohonan.created_at","desc")
        ->join('permohonan','sejarah_permohonan.permohonan_id','=','permohonan.id')
        ->join('bk_status','bk_status.kod_status','=','sejarah_permohonan.status')
        ->get(['sejarah_permohonan.*','permohonan.no_rujukan_permohonan','permohonan.status as status_semasa','bk_status.status'])
        ->where('smoku_id',$smoku_id->id)
        ->where('status', '!=', 'DISOKONG');
        //dd($smoku_id);

        $tuntutan_id = Tuntutan::orderby("id","desc")->where('smoku_id',$smoku_id->id)->first();
        // dd($tuntutan_id);
        if($tuntutan_id !== null){
            $tuntutan = Tuntutan::orderby("sejarah_tuntutan.created_at","desc")
                ->join('sejarah_tuntutan','sejarah_tuntutan.tuntutan_id','=','tuntutan.id')
                ->join('bk_status','bk_status.kod_status','=','sejarah_tuntutan.status')
                ->get(['sejarah_tuntutan.*','tuntutan.*','bk_status.status','tuntutan.status as status_semasa'])
                ->where('smoku_id',$smoku_id->id)
                ->where('tuntutan_id',$tuntutan_id->id)
                ->where('status', '!=', 'DISOKONG');
        } else {
            $tuntutan = [];
        }
        
        

        $akademik = Akademik::join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->where('smoku_id',$smoku_id->id)
        ->where('status',1)
        ->first();

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
        return view('dashboard.pelajar.dashboard', compact('user','permohonan','akademik','tuntutan'));
    }

    public function tamatPengajian()
    {   
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id', $smoku->id)->first();

        return view('kemaskini.pelajar.lapor_tamat_pengajian',compact('permohonan'));
    }

    public function hantarTamatPengajian(Request $request)
    {
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

        if (!$smoku || !$permohonan) {
            return redirect()->route('tamat.pengajian')->with('error', 'Permohonan tidak ditemui.');
        }

        $sijilTamat = $request->file('sijilTamat');
        $transkrip = $request->file('transkrip');
        $uploadedSijilTamat = [];
        $uploadedTranskrip = [];

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
                    $existingRecord->perakuan = $request->perakuan;
                    $existingRecord->save();
                } else {
                    // Create a new record
                    $tamatPengajian = new TamatPengajian();
                    $tamatPengajian->smoku_id = $smoku->id;
                    $tamatPengajian->permohonan_id = $permohonan->id;
                    $tamatPengajian->sijil_tamat = $uniqueFilenameSijil;
                    $tamatPengajian->transkrip = $uniqueFilenameTranskrip;
                    $tamatPengajian->perakuan = $request->perakuan;
                    $tamatPengajian->save();
                }
            }
        }

        // Store the uploaded file names or URLs in the session
        session()->put('uploadedSijilTamat', $uploadedSijilTamat);
        session()->put('uploadedTranskrip', $uploadedTranskrip);
        session()->put('perakuan', $request->input('perakuan'));

        return redirect()->route('tamat.pengajian')->with('success', 'Dokumen lapor diri tamat pengajian telah dihantar.');
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
}
