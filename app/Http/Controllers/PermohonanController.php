<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ButiranPelajar;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\User;
use App\Models\Smoku;
use App\Models\Infoipt;
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
use App\Models\TamatPengajian;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PermohonanController extends Controller
{
    public function permohonan()
    {

        $smoku = Smoku::join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
        ->join('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
        ->join('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
        ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
        ->get(['smoku.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*'])
        ->where('no_kp', Auth::user()->no_kp);
        
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $akademikmqa = Akademik::join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->join('bk_peringkat_pengajian','bk_peringkat_pengajian.kod_peringkat','=','smoku_akademik.peringkat_pengajian')
        ->get(['smoku_akademik.*', 'bk_info_institusi.*', 'bk_peringkat_pengajian.*'])
        ->where('smoku_id',$smoku_id->id);

        $mod = Mod::all()->sortBy('kod_mod');
        $biaya = SumberBiaya::all()->sortBy('kod_biaya');
        $penaja = Penaja::all()->sortBy('kod_penaja');
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');
        $negeri = Negeri::orderby("kod_negeri","asc")->select('id','negeri')->get();
        $bandar = Bandar::orderby("id","asc")->select('id','bandar')->get();
        $institusi = InfoIpt::orderby("id","asc")->select('id_institusi','nama_institusi')->get();
        $peringkat = PeringkatPengajian::orderby("id","asc")->select('kod_peringkat','peringkat')->get();
        $permohonan = Permohonan::where('smoku_id', $smoku_id->id)->first();

        $butiranPelajar = ButiranPelajar::join('smoku','smoku.id','=','smoku_butiran_pelajar.smoku_id')
        ->join('smoku_waris','smoku_waris.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->join('smoku_akademik','smoku_akademik.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->join('permohonan','permohonan.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
        ->join('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
        ->join('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
        ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
        ->get(['smoku_butiran_pelajar.*', 'smoku.*','smoku_waris.*','smoku_akademik.*','permohonan.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*'])
        ->where('smoku_id', $smoku_id->id);

        if ($permohonan && $permohonan->status >= '1') {
            $dokumen = Dokumen::where('permohonan_id', $permohonan->id)->get();
            return view('pages.permohonan.permohonan_view', compact('smoku','butiranPelajar','hubungan','negeri','bandar','institusi','peringkat','mod','biaya','penaja','dokumen','permohonan'));

        } else {
            //$userHasSubmittedForm = false;
            return view('pages.permohonan.permohonan-baru', compact('smoku','akademikmqa','mod','biaya','penaja','hubungan','negeri'));

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

    public function simpanPermohonan(Request $request)
    {   

        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();

        $butiranPelajar = ButiranPelajar::firstOrNew(['smoku_id' => $smoku_id->id]);

        $butiranPelajar->alamat_surat_menyurat = $request->alamat_surat_menyurat;
        $butiranPelajar->alamat_surat_negeri = $request->alamat_surat_negeri;
        $butiranPelajar->alamat_surat_bandar = $request->alamat_surat_bandar;
        $butiranPelajar->alamat_surat_poskod = $request->alamat_surat_poskod;
        $butiranPelajar->tel_bimbit = $request->tel_bimbit;
        $butiranPelajar->tel_rumah = $request->tel_rumah;
        $butiranPelajar->no_akaun_bank = $request->no_akaun_bank;
        $butiranPelajar->emel = $request->emel;

        $butiranPelajar->save();

        $waris = Waris::firstOrNew(['smoku_id' => $smoku_id->id]);

        $waris->nama_waris = $request->nama_waris;
        $waris->no_kp_waris = $request->no_kp_waris;
        $waris->no_pasport_waris = $request->no_pasport_waris;
        $waris->hubungan_waris = $request->hubungan_waris;
        $waris->hubungan_lain_waris = $request->hubungan_lain_waris;
        $waris->tel_bimbit_waris = $request->tel_bimbit_waris;
        $waris->alamat_waris = $request->alamat_waris;
        $waris->alamat_negeri_waris = $request->alamat_negeri_waris;
        $waris->alamat_bandar_waris = $request->alamat_bandar_waris;
        $waris->alamat_poskod_waris = $request->alamat_poskod_waris;
        $waris->pekerjaan_waris = $request->pekerjaan_waris;
        $waris->pendapatan_waris = $request->pendapatan_waris;

        $waris->save();


        // Update or create an Akademik record based on smoku_id
        Akademik::updateOrCreate(
            ['smoku_id' => $smoku_id->id],
            [
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
            ]
        );
       
        $permohonan = Permohonan::firstOrNew(['smoku_id' => $smoku_id->id]);

        $permohonan->no_rujukan_permohonan = 'B'.'/'.$request->peringkat_pengajian.'/'.Auth::user()->no_kp;
        $permohonan->program = 'BKOKU';
        $permohonan->yuran = $request->yuran;
        $permohonan->amaun_yuran = $request->amaun_yuran;
        $permohonan->wang_saku = $request->wang_saku;
        $permohonan->amaun_wang_saku = $request->amaun_wang_saku;
        $permohonan->perakuan = $request->perakuan;
        $permohonan->status = '1';

        $permohonan->save();

        $permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();
        $sejarah = SejarahPermohonan::firstOrNew(['smoku_id' => $smoku_id->id]);

        $sejarah->permohonan_id = $permohonan_id->id;
        $sejarah->status = '1';

        $sejarah->save();


        //$dokumen = Dokumen::where('smoku_id', '=', $smoku_id->id)->first();
        $permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();
        //UPLOAD DOKUMEN BY JAVASCRIPT




        return redirect()->route('viewpermohonan');

    }

    public function hantarPermohonan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id', '=', $smoku_id->id)->first();
        if ($permohonan != null) {
            Permohonan::where('smoku_id' ,$smoku_id->id)
            ->update([
                'perakuan' => $request->perakuan,
                'status' => '2',

            ]);
            
        }

        $permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();
        $mohon = SejarahPermohonan::create([
            'permohonan_id' => $permohonan_id->id,
            'smoku_id' => $smoku_id->id,
            'status' => '2',
    
        ]);
        $mohon->save();


        $permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();

        // Generate a running number (you can use your logic here)
        $runningNumber = rand(1000, 9999);

        // Create an array to store the document types and their respective IDs
        $documentTypes = [
            'akaunBank' => 1,
            'suratTawaran' => 2,
            'invoisResit' => 3,
        ];

        $dataArray = [];

        foreach ($documentTypes as $inputName => $idDokumen) {
            $file = $request->file($inputName);

            if ($file) {
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                
                // Remove the extension from the original filename
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                
                // Generate the new filename
                $newFilename = $filenameWithoutExtension . '_' . $runningNumber . '.' . $extension;
                
                // Move the file to the destination directory
                $file->move('assets/dokumen/permohonan', $newFilename);
                
                // Create a new instance of dokumen and set its properties
                $data = new dokumen();
                $data->permohonan_id = $permohonan_id->id;
                $data->id_dokumen = $idDokumen;
                $data->dokumen = $newFilename;
                $data->catatan = $request->input("nota_$inputName");
                
                // Add the data to the array
                $dataArray[] = $data;
            }
        }

        // Save all instances to the database in a loop
        foreach ($dataArray as $data) {
            $data->save();
        }


            //TAMBAHAN FILE
            $dokumen = $request->file('dokumen'); 
            $catatan = $request->input('catatan'); 

            // Check if $dokumen is a valid array and $catatan is an array
            if (is_array($dokumen) && is_array($catatan)) {
                foreach ($dokumen as $key => $img) {
                    $originalFilename = $img->getClientOriginalName();
                    $extension = $img->getClientOriginalExtension();
                    
                    $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                    $runningNumber = rand(1000, 9999);
                    $profileImage = $filenameWithoutExtension . '_' . $runningNumber . '.' . $extension;
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




        return redirect()->route('dashboard')->with('message', 'Permohonan anda telah dihantar.');

    }

    public function download(Request $request,$file){   
        return response()->download(public_path('assets/dokumen/permohonan/'.$file));
    }


    public function kemaskiniPermohonan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        ButiranPelajar::where('smoku_id' ,$smoku_id->id)
        ->update([

                'alamat_surat_menyurat' => $request->alamat_surat_menyurat,
                'alamat_surat_negeri' => $request->alamat_surat_negeri,
                'alamat_surat_bandar' => $request->alamat_surat_bandar,
                'alamat_surat_poskod' => $request->alamat_surat_poskod,
                'tel_bimbit' => $request->tel_bimbit,
                'tel_rumah' => $request->tel_rumah,
                'no_akaun_bank' => $request->no_akaun_bank,
                'emel' => $request->emel,

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

        Akademik::where('smoku_id' ,$smoku_id->id)
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

        Permohonan::where('smoku_id' ,$smoku_id->id)
        ->update([

            // 'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.Auth::user()->no_kp,
            'program' => 'BKOKU',
            'yuran' => $request->yuran,
            'amaun_yuran' => $request->amaun_yuran,
            'wang_saku' => $request->wang_saku,
            'amaun_wang_saku' => $request->amaun_wang_saku,
            'perakuan' => $request->perakuan,
            // 'status' => '1',

        ]);

        /*$permohonan_id = Permohonan::where('smoku_id',$smoku_id->id)->first();
        SejarahPermohonan::where('smoku_id' ,$smoku_id->id)
        ->where('permohonan_id' ,$permohonan_id->id)
        ->update([

            'permohonan_id' => $permohonan_id->id,
            'status' => '1',

        ]);*/
        
    }
 
    public function sejarahPermohonan(){
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $permohonan = Permohonan::join('bk_status', 'bk_status.kod_status', '=', 'permohonan.status')
            ->get(['permohonan.*', 'bk_status.status'])
            ->where('smoku_id', $smoku_id->id)
            ->first();
        //dd($permohonan);    

        if ($permohonan !== null) {
            return view('pages.permohonan.permohonan_sejarah', compact('permohonan'));
        } else {
            return back()->with('message', 'Tiada permohonan lama.');
        }

    }

    public function batalpermohonan(){
        $permohonan = SejarahPermohonan::join('permohonan','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->join('statusinfo','statusinfo.kodstatus','=','statustransaksi.status')
        ->get(['permohonan.*', 'statustransaksi.*','statusinfo.*'])
        ->where('nokp_pelajar', Auth::user()->nokpm);
        return view('pages.permohonan.permohonan_sejarah', compact('permohonan'));
        
    }

    public function delete($nokp){

        //$pelajar = Permohonan::find($nokp);
        $pelajar = DB::table('pelajar')->where('nokp_pelajar', $nokp)->first();
        $nokp = $pelajar->nokp_pelajar;
        //$pelajar->delete(); //delete pelajar

        $permohonan = DB::table('permohonan')->where('nokp_pelajar', $nokp)->first();
        $id_permohonan = $permohonan->id_permohonan;
        //$permohonan->delete();
        DB::table('pelajar')->where('nokp_pelajar',$nokp)->delete();
        DB::table('permohonan')->where('id_permohonan',$id_permohonan)->delete(); //delete permohonan
        DB::table('waris')->where('nokp_pelajar',$nokp)->delete();
        DB::table('maklumatakademik')->where('nokp_pelajar' ,$nokp)
        ->update([

            'no_pendaftaranpelajar' => NULL,
            'sesi' => NULL,
            'tkh_mula' => NULL,
            'tkh_tamat' => NULL,
            'sem_semasa' => NULL,
            'tempoh_pengajian' => NULL,
            'bil_bulanpersem' => NULL,
            'mod' => NULL,
            'cgpa' => NULL,
            'sumber_biaya' => NULL,
            'nama_penaja' => NULL,
            'status' => NULL,

        ]);

        DB::table('dokumen')->where('id_permohonan',$id_permohonan)->delete();
        DB::table('statustransaksi')->where('id_permohonan',$id_permohonan)->delete();
        
        return redirect()->route('permohonan.sejarah');
        
    }

    public function kemaskiniKeputusan()
    {
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $permohonan = Permohonan::all()->where('smoku_id', '=', $smoku_id->id)->first();
        $peperiksaan = Peperiksaan::all()->where('permohonan_id', '=', $permohonan->id);   

        return view('pages.permohonan.kemaskini_keputusan_peperiksaan', compact('peperiksaan'));
    }

    public function save(Request $request)
    {   
        
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::all()->where('smoku_id', '=', $smoku_id->id)->first();

        $kepPeperiksaan=$request->kepPeperiksaan;
        $counter = 1; 

        foreach($kepPeperiksaan as $kepPeperiksaan) {
        
            $filenamekepP =$kepPeperiksaan->getClientOriginalName();  
            $uniqueFilename = $counter . '_' . $filenamekepP;

            // Append increment to the filename until it's unique
            while (file_exists('assets/dokumen/peperiksaan/' . $uniqueFilename)) {
                $counter++;
                $uniqueFilename = $counter . '_' . $filenamekepP;
            }
            $kepPeperiksaan->move('assets/dokumen/peperiksaan',$uniqueFilename);

            
            $data=new peperiksaan();
            $data->permohonan_id=$permohonan->id;
            $data->sesi=$request->sesi;
            $data->semester=$request->semester;
            $data->cgpa=$request->cgpa;
            $data->kepPeperiksaan=$uniqueFilename;
            $data->save();

            $counter++;
        }    

        return redirect()->route('kemaskini.keputusan');
    }

    public function tamatPengajian()
    {   
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id', $smoku->id)->first();

        return view('pages.permohonan.lapor_tamat_pengajian');
    }

    public function hantarTamatPengajian(Request $request)
    {
        $user = Auth::user();
        $smoku = Smoku::where('no_kp', $user->no_kp)->first();
        $permohonan = Permohonan::where('smoku_id', $smoku->id)->first();

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

    public function sejarahTuntutan(){
        // $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        // $permohonan = Permohonan::join('bk_status', 'bk_status.kod_status', '=', 'permohonan.status')
        //     ->get(['permohonan.*', 'bk_status.status'])
        //     ->where('smoku_id', $smoku_id->id)
        //     ->first();
        // //dd($permohonan);    

        // if ($permohonan !== null) {
        //     return view('pages.permohonan.permohonan_sejarah', compact('permohonan'));
        // } else {
        //     return back()->with('message', 'Tiada permohonan lama.');
        // }

    }
}


