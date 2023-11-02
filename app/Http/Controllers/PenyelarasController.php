<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\PermohonanHantar;
use App\Mail\TuntutanHantar;
use App\Models\Agama;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Smoku;
use App\Models\ButiranPelajar;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\User;
use App\Models\InfoIpt;
use App\Models\PeringkatPengajian;
use App\Models\Kursus;
use App\Models\Mod;
use App\Models\Sumberbiaya;
use App\Models\Penaja;
use App\Models\Status;
use App\Models\JenisOku;
use App\Models\Dokumen;
use App\Models\Hubungan;
use App\Models\Negeri;
use App\Models\Bandar;
use App\Models\DokumenESP;
use App\Models\EmelKemaskini;
use App\Models\Tuntutan;
use App\Models\TuntutanItem;
use App\Models\SejarahTuntutan;
use App\Models\Peperiksaan;
use App\Models\Saringan;
use App\Models\Kelulusan;
use App\Models\MaklumatBank;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class PenyelarasController extends Controller
{
    public function index()
    {
        $smoku = Smoku::join('smoku_penyelaras', 'smoku_penyelaras.smoku_id', '=', 'smoku.id')
            ->leftJoin('permohonan', 'permohonan.smoku_id', '=', 'smoku.id')
            ->where('penyelaras_id', '=', Auth::user()->id)
            ->where(function ($query) {
                $query->where('permohonan.status', '<', '2')
                    ->orWhereNull('permohonan.status');
            })
            ->select('smoku.*', 'smoku_penyelaras.*', 'permohonan.status')
            ->get();

        //dd($smoku);    

        return view('dashboard.penyelaras_bkoku.dashboard', compact('smoku'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kp' => ['required', 'string'],
        ]);

        $smoku=Smoku::where([['no_kp', '=', $request->no_kp]])->first();

        if ($smoku != null) {
                DB::table('smoku_penyelaras')->insert([
                    'smoku_id' => $smoku->id,
                    'penyelaras_id' => Auth::user()->id,
                    'status' => '1',
                    'created_at' => now(), // sebab tak guna model
                    'updated_at' => now(),
                ]);
                
                $id =  $smoku->id;
                $no_kp =  $smoku->no_kp;
                $smoku_id = $request->session()->put('id',$id);
                $no_kp = $request->session()->put('no_kp',$no_kp);
                return redirect()->route('penyelaras.dashboard')->with($smoku_id,$no_kp)
                ->with('success', $no_kp. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');
            } 
            else {
                $nokp_in = $request->nokp;
                return redirect()->route('penyelaras.dashboard')
                ->with('failed', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
            }
    }

    public function permohonanBaharu($id)
    {
        $smoku = Smoku:: join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
            ->join('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
            ->join('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
            ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
            ->where('smoku.id', $id)
            ->get(['smoku.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*']);

        $biaya = SumberBiaya::all()->where('kod_biaya','!=','2')->sortBy('kod_biaya');
        $penaja = Penaja::all()->sortBy('kod_penaja');
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');
        $negeri = Negeri::orderby("kod_negeri","asc")->select('id','negeri')->get();
        $bandar = Bandar::orderby("id","asc")->select('id','bandar')->get();
        $agama = Agama::orderby("id","asc")->select('id','agama')->get();
        $infoipt = InfoIpt::all()->where('jenis_institusi','IPTA')->sortBy('nama_institusi');
        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kod_mod');

        $permohonan = Permohonan::where('smoku_id', $id)->first();
        $butiranPelajar = ButiranPelajar::join('smoku','smoku.id','=','smoku_butiran_pelajar.smoku_id')
        ->join('smoku_waris','smoku_waris.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->join('smoku_akademik','smoku_akademik.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->join('permohonan','permohonan.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
        ->join('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
        ->join('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
        ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
        ->get(['smoku_butiran_pelajar.*','smoku_butiran_pelajar.alamat_tetap as alamat_tetap_baru','smoku_butiran_pelajar.tel_rumah as tel_rumah_baru', 'smoku.*','smoku_waris.*','smoku_akademik.*','permohonan.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*'])
        ->where('smoku_id', $id);
        

        if ($permohonan && $permohonan->status >= '1') {
            $dokumen = Dokumen::all()->where('permohonan_id', $permohonan->id);
            return view('permohonan.penyelaras_bkoku.permohonan_view', compact('butiranPelajar','hubungan','negeri','bandar','infoipt','peringkat','mod','biaya','penaja','dokumen','agama'));
        } else {
            return view('permohonan.penyelaras_bkoku.permohonan_baharu', compact('smoku','hubungan','infoipt','peringkat','mod','kursus','biaya','penaja','negeri','bandar','agama'));
        }
    }

    public function bandar($idnegeri)
    {

        $dataBandar['data'] = Bandar::orderby("bandar","asc")
            ->select('id','bandar','negeri_id')
            ->where('negeri_id',$idnegeri)
            ->get();

        return response()->json($dataBandar);

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

    public function simpan(Request $request)
    {   
        $smoku = Smoku::where('no_kp', '=', $request->no_kp)->first();
        $id = $smoku->id;
        $nokp_pelajar = $smoku->no_kp;

        Smoku::updateOrCreate(
            ['id' => $id],
            [
                'umur' => $request->umur,
            ]
        );

        $permohonan = Permohonan::firstOrNew(['smoku_id' => $id]);

        $permohonan->program = 'BKOKU';
        $permohonan->status = '1';

        $permohonan->save();

        $butiranPelajar = ButiranPelajar::firstOrNew(['smoku_id' => $id]);

        $butiranPelajar->negeri_lahir = $request->negeri_lahir;
        $butiranPelajar->agama = $request->agama;
        $butiranPelajar->alamat_tetap = $request->alamat_tetap;
        $butiranPelajar->alamat_tetap_negeri = $request->alamat_tetap_negeri;
        $butiranPelajar->alamat_tetap_bandar = $request->alamat_tetap_bandar;
        $butiranPelajar->alamat_tetap_poskod = $request->alamat_tetap_poskod;
        $butiranPelajar->alamat_surat_menyurat = $request->alamat_surat_menyurat;
        $butiranPelajar->alamat_surat_negeri = $request->alamat_surat_negeri;
        $butiranPelajar->alamat_surat_bandar = $request->alamat_surat_bandar;
        $butiranPelajar->alamat_surat_poskod = $request->alamat_surat_poskod;
        $butiranPelajar->tel_bimbit = $request->tel_bimbit;
        $butiranPelajar->tel_rumah = $request->tel_rumah;
        //$butiranPelajar->no_akaun_bank = $request->no_akaun_bank;
        $butiranPelajar->emel = $request->emel;

        // Save the record
        $butiranPelajar->save();


        // Retrieve or create a Waris record based on smoku_id
        $waris = Waris::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
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

        // Save the record
        $waris->save();

        // Retrieve or create a Waris record based on smoku_id
        $akademik = Akademik::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
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
        $akademik->status = '1';

        // Save the record
        $akademik->save();

        // Update an Permohonan record based on smoku_id
        Permohonan::updateOrCreate(
            ['smoku_id' => $id],
            [
                'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar,
                'yuran' => $request->yuran,
                'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
                'wang_saku' => $request->wang_saku,
                'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                'perakuan' => $request->perakuan,
            ]
        );
       
        // // Retrieve or create a Permohonan record based on smoku_id
        // $permohonan = Permohonan::firstOrNew(['smoku_id' => $id]);

        // // Set the attributes
        // $permohonan->no_rujukan_permohonan = 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar;
        // $permohonan->program = 'BKOKU';
        // $permohonan->yuran = $request->yuran;
        // $permohonan->amaun_yuran = number_format($request->amaun_yuran, 2, '.', '');
        // $permohonan->wang_saku = $request->wang_saku;
        // $permohonan->amaun_wang_saku = number_format($request->amaun_wang_saku, 2, '.', '');
        // $permohonan->perakuan = $request->perakuan;
        // $permohonan->status = '1';

        // // Save the record
        // $permohonan->save();

        $permohonan_id = Permohonan::where('smoku_id',$id)->first();
        // Retrieve or create a SejarahPermohonan record based on smoku_id
        $sejarah = SejarahPermohonan::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
        $sejarah->permohonan_id = $permohonan_id->id;
        $sejarah->status = '1';

        // Save the record
        $sejarah->save();


        //$dokumen = Dokumen::where('smoku_id', '=', $smoku_id->id)->first();
        $permohonan_id = Permohonan::where('smoku_id',$id)->first();
        //UPLOAD DOKUMEN BY JAVASCRIPT




        return redirect()->route('penyelaras.dashboard');

    }

    public function hantar(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',$request->no_kp)->first();
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

        //emel kepada sekretariat
        $user_sekretariat = User::where('tahap',3)->first();
        $cc = $user_sekretariat->email;

        //emel kepada penyelaras
        $user = User::where('no_kp',Auth::user()->no_kp)->first();

        $catatan = "testing";
        $emel = EmelKemaskini::where('emel_id',13)->first();
        //dd($cc,$user->email);

        Mail::to($user->email)->cc($cc)->send(new PermohonanHantar($catatan,$emel));    

        return redirect()->route('penyelaras.dashboard')->with('success', 'Permohonan pelajar telah dihantar.');

    }

    public function senaraiPermohonanBaharu()
    {
        $smoku = Smoku::leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
        ->leftJoin('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->leftJoin('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->where('permohonan.status','=', '2')
        ->where('penyelaras_id','=', Auth::user()->id)
        ->get(['smoku.*', 'permohonan.*', 'smoku_akademik.*', 'bk_info_institusi.nama_institusi']);

        //dd($smoku);
        return view('permohonan.penyelaras_bkoku.senarai_baharu', compact('smoku'));
    }

    public function senaraiTuntutanBaharu()
    {
        $layak = Smoku::join('permohonan','permohonan.smoku_id','=','smoku.id')
        ->join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->leftjoin('tuntutan','tuntutan.permohonan_id','=','permohonan.id')
        ->where('penyelaras_id','=', Auth::user()->id)
        ->where('permohonan.status', 8) 
        // ->where(function ($query) {
        //     $query->where('tuntutan.status', '<', '2')
        //         ->orWhereNull('tuntutan.status');
        // })
        ->get(['smoku.*', 'permohonan.id as permohonan_id', 'permohonan.no_rujukan_permohonan', 'tuntutan.status as tuntutan_status','smoku_akademik.*', 'bk_info_institusi.nama_institusi']);
        //dd($layak);

        return view('tuntutan.penyelaras_bkoku.tuntutan_baharu', compact('layak'));
    }

    public function kemaskiniKeputusan($id)
    {   
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $smoku_id = $id;
        //$peperiksaan = Peperiksaan::all()->where('permohonan_id', '=', $permohonan->id);
        if ($permohonan) {
            
            $peperiksaan = Peperiksaan::where('permohonan_id', $permohonan->id)->get();

            return view('tuntutan.penyelaras_bkoku.kemaskini_keputusan_peperiksaan', compact('peperiksaan','smoku_id','permohonan'));
        
        } else {

            return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        
        }
    }

    public function hantarKeputusanPeperiksaan(Request $request, $id)
    {
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();

        //simpan dalam table peperiksaan
        $kepPeperiksaan=$request->kepPeperiksaan;
        $counter = 1; 

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
        
        return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('message', 'Keputusan peperiksaan pelajar telah di simpan.');
    }

    public function tuntutanBaharu($id)
    {   
        $permohonan = Permohonan::where('smoku_id',$id)->first();
        $tuntutan = Tuntutan::join('tuntutan_item','tuntutan_item.tuntutan_id','=','tuntutan.id')
        ->get(['tuntutan.*', 'tuntutan_item.*'])
        ->where('smoku_id', $id)
        ->where('status', 1);
        $smoku_id = $id;
        $akademik = Akademik::where('smoku_id',$id)
            ->where('smoku_akademik.status', 1)
            ->first();

        $currentDate = Carbon::now();
        $tarikhMula = Carbon::parse($akademik->tarikh_mula);
        $tarikhNextSem = $tarikhMula->addMonths($akademik->bil_bulan_per_sem);

        if($akademik->bil_bulan_per_sem == 6){
            $bilSem = 2;
        } else {
            $bilSem = 3;
        }
            
        $semSemasa = $akademik->sem_semasa;
        $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
        if ($permohonan && $permohonan->status ==8) {  
            if ($currentDate->greaterThan($tarikhNextSem)) {
                //dd($id);
                while ($semSemasa <= $totalSemesters) {
                    //semak dah upload result ke belum
                   $result = Peperiksaan::where('permohonan_id', $permohonan->id)
                   ->where('sesi', $akademik->sesi)
                   ->where('semester', $semSemasa)
                   ->first();
                   if($result == null){
                       return redirect()->route('bkoku.kemaskini.keputusan', ['id' => $id])->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                   }
                   //dd('hehe');
               
                   // Increment $semSemasa for the next iteration
                   $semSemasa = $semSemasa + 1;

                   $tuntut = Tuntutan::where('smoku_id', $id)
                       ->where('permohonan_id', $permohonan->id)
                       ->orderBy('tuntutan.id', 'desc')
                       ->first(['tuntutan.*']);

                   //dd($tuntutan);    

                   if ($tuntut && $tuntut->status == 1) {
                       $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntut->id)->get();
                   } 
                   else if ($tuntut && $tuntut->status != 8){
                       return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('sem', 'Tuntutan pelajar masih dalam semakan.');
                   }
                   else {
                       $tuntutan_item = collect(); // An empty collection
                   }
                   
                   $akademik = Akademik::where('smoku_id', $id)
                       ->where('smoku_akademik.status', 1)->first();

                    return view('tuntutan.penyelaras_bkoku.borang_tuntutan', compact('permohonan','tuntut','tuntutan', 'tuntutan_item','smoku_id','akademik'));
                }
            } else {
                return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('sem', 'tak habis sem lagii niiiii.');
            }    

        } else if ($permohonan && $permohonan->status !=8) {
            return redirect()->route('dashboard')->with('permohonan', 'Permohonan anda masih dalam semakan.');
        } else {
            return redirect()->route('dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
        
    }

    public function simpanTuntutan(Request $request, $id)
    {   
        
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        // $biltuntutan = Tuntutan::where('smoku_id', '<=', $id)
        $biltuntutan = Tuntutan::where('smoku_id', '=', $id)
            ->groupBy('no_rujukan_tuntutan')
            ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
            ->get();

        $bil = $biltuntutan->count();
        $running_num =  $bil + 1; //sebab nak guna satu id je
        $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num; // try duluuu

        //simpan dalam table tuntutan
        $tuntutan = Tuntutan::where('smoku_id', '=', $id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();
        if ($tuntutan === null) {
            $tuntutan = Tuntutan::create([
                'smoku_id' => $id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,    
                'yuran' => '1',
                'status' => '1',
            ]);
        }
       /*else {
            Tuntutan::where('smoku_id', '=', $smoku_id->id)
                ->where('permohonan_id', '=', $permohonan->id)
                ->update([
                'smoku_id' => $smoku_id->id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,
                'status' => '1',
                
            ]);

        }*/

        $tuntutan->save();

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::where('smoku_id', '=', $id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();

        $resit = $request->resit;
        $counter = 1; 

        foreach($resit as $resit) {
                     
            $filenameresit =$resit->getClientOriginalName();
            $uniqueFilename = $counter . '_' . $filenameresit;

            // Append increment to the filename until it's unique
            while (file_exists('assets/dokumen/tuntutan/' . $uniqueFilename)) {
                $counter++;
                $uniqueFilename = $counter . '_' . $filenameresit;
            }
            $resit->move('assets/dokumen/tuntutan',$uniqueFilename);

            $data=new tuntutanitem();
            $data->tuntutan_id=$tuntutan->id;
            $data->jenis_yuran=$request->jenis_yuran;
            $data->no_resit=$request->no_resit;
            $data->resit=$uniqueFilename;
            $data->nota_resit=$request->nota_resit;
            $data->amaun=$request->amaun_yuran;
            $data->save();

            $counter++;
        }

            
        //simpan dalam table sejarah_tuntutan
        $sejarahtuntutan = SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)->first();
        if ($sejarahtuntutan === null) {
            $sejarahtuntutan = SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $id,
                'status' => '1',
        
            ]);

        }else{

            SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)
                ->update([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $id,
                'status' => '1',
                
            ]);
        }
        
        $sejarahtuntutan->save();
            
        return redirect()->route('bkoku.tuntutan.baharu', [$id])->with('message', 'Simpan.');

    }

    public function hantarTuntutan(Request $request, $id)
    {
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();

        $biltuntutan = Tuntutan::where('smoku_id', '=', $id)
            ->groupBy('no_rujukan_tuntutan')
            ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
            ->get();

        $bil = $biltuntutan->count();
        $running_num =  $bil + 1; //sebab nak guna satu id je
        $no_rujukan_tuntutan =  $permohonan->no_rujukan_permohonan.'/'.$running_num; // try duluuu

        //update dalam table tuntutan
        $tuntutan = Tuntutan::where('smoku_id', '=', $id)->first();
        if ($tuntutan != null) {
            Tuntutan::where('smoku_id' ,$id)
            ->update([
                'wang_saku' => $request->wang_saku,
                'amaun_wang_saku' => $request->amaun_wang_saku,
                'jumlah' => $request->jumlah,
                'status' => '2',
            ]);
        }
        $tuntutan->save();

        $sejarah = SejarahTuntutan::create([
            'tuntutan_id' => $tuntutan->id,
            'smoku_id' => $id,
            'status' => '2',
    
        ]);
        $sejarah->save();

        //emel kepada sekretariat
        $user_sekretariat = User::where('tahap',3)->first();
        $cc = $user_sekretariat->email;

        //emel kepada penyelaras
        $user = User::where('no_kp',Auth::user()->no_kp)->first();

        $catatan = "testing";
        $emel = EmelKemaskini::where('emel_id',14)->first();
        //dd($cc);
        //dd($emel);
        Mail::to($user->email)->cc($cc)->send(new TuntutanHantar($catatan,$emel));
        
        return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('message', 'Tuntutan pelajar telah di hantar.');
    }

    public function sejarahTuntutan()
    {
        $tuntutan = Tuntutan::where('tuntutan.status', '!=', '4')
        ->join('smoku_penyelaras', 'smoku_penyelaras.smoku_id', '=', 'tuntutan.smoku_id')
        ->where('smoku_penyelaras.penyelaras_id', '=', Auth::user()->id)
        ->select('tuntutan.*')
        ->get();
        //dd($tuntutan);

        return view('tuntutan.penyelaras_bkoku.sejarah_tuntutan',compact('tuntutan'));
    }

    public function rekodTuntutan($id)
    {
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $sejarah_t = SejarahTuntutan::where('tuntutan_id', $id)->where('status', '!=','4')->orderBy('created_at', 'desc')->get();
        return view('tuntutan.penyelaras_bkoku.rekod_tuntutan',compact('tuntutan','akademik','smoku','sejarah_t','permohonan'));
    }

    public function paparRekodTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        //dd($tuntutan_item);
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.penyelaras_bkoku.papar_tuntutan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }

    public function keputusanPeperiksaan($id)
    {
        $permohonan = Permohonan::where('smoku_id', $id)->first();
        $akademik = Akademik::where('smoku_id', $id)->first();
        $peperiksaan = Peperiksaan::where('permohonan_id', $permohonan->id)->get();
        //dd($peperiksaan);

        return view('tuntutan.penyelaras_bkoku.keputusan_peperiksaan',compact('akademik','permohonan','peperiksaan'));
    }

    public function paparRekodSaringanTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.penyelaras_bkoku.papar_saringan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }

    public function sejarahPermohonan()
    {
        $permohonan = Permohonan::where('permohonan.status', '!=','4')
        ->join('smoku_penyelaras', 'smoku_penyelaras.smoku_id', '=', 'permohonan.smoku_id')
        ->where('smoku_penyelaras.penyelaras_id', '=', Auth::user()->id)
        ->select('permohonan.*')
        ->get();

        return view('permohonan.penyelaras_bkoku.sejarah_permohonan',compact('permohonan'));
    }

    public function rekodPermohonan($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $sejarah_p = SejarahPermohonan::where('permohonan_id', $id)->orderBy('created_at', 'desc')->get();
        return view('permohonan.penyelaras_bkoku.rekod_permohonan',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function paparRekodPermohonan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('permohonan.penyelaras_bkoku.papar_permohonan',compact('permohonan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodSaringan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('permohonan.penyelaras_bkoku.papar_saringan',compact('permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodKelulusan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $kelulusan = Kelulusan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        return view('permohonan.penyelaras_bkoku.papar_kelulusan',compact('permohonan','kelulusan','smoku','sejarah_p'));
    }

    public function muatTurunBorangSPPB()
    {   
        $dokumen = DokumenESP::all();
        return view('dokumen.penyelaras.muat_turun_dokumen', compact('dokumen'));
    }

    public function muatNaikBorangSPPB()
    {   
        $institusiPengajian = InfoIpt::all();
        $dokumen = DokumenESP::all();
        return view('dokumen.penyelaras.muat_naik_dokumen', compact('institusiPengajian','dokumen'));
    }

    public function hantarBorangSPPB(Request $request, $id)
    {
        // Check if a record with the given identifier exists
        $dokumenESP = DokumenESP::find($id);

        // Define custom error messages
        $customMessages = [
            'dokumen1.required' => 'Sila pilih fail untuk SPBB1.',
            'dokumen1.mimes' => 'Format fail bagi SPBB1 mestilah pdf, xls, atau xlsx sahaja.',
            'dokumen1.max' => 'Saiz maksimum fail adalah 2 MB.',

            'dokumen2.required' => 'Sila pilih fail untuk SPBB2.',
            'dokumen2.mimes' => 'Format fail bagi SPBB2 mestilah pdf, xls, atau xlsx sahaja.',
            'dokumen2.max' => 'Saiz maksimum fail adalah 2 MB.',

            'dokumen3.required' => 'Sila pilih fail untuk SPBB3.',
            'dokumen3.mimes' => 'Format fail bagi SPBB3 mestilah pdf, xls, atau xlsx sahaja.',
            'dokumen3.max' => 'Saiz maksimum fail adalah 2 MB.',
        ];

        // Define validation rules
        $rules = [
            'dokumen1' => 'required|mimes:pdf,xls,xlsx|max:2048',
            'dokumen2' => 'required|mimes:pdf,xls,xlsx|max:2048',
            'dokumen3' => 'required|mimes:pdf,xls,xlsx|max:2048',
        ];

        // Validate the uploaded files with custom error messages
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Initialize arrays to store uploaded file names
        $uploadedDokumen1 = [];
        $uploadedDokumen2 = [];
        $uploadedDokumen3 = [];

        if ($request->hasFile('dokumen1')) {
            // Handle dokumen1 upload
            $dokumen1 = $request->file('dokumen1');
            $uniqueFilenameDokumen1 = uniqid() . '_' . $dokumen1->getClientOriginalName();
            $dokumen1->move('assets/dokumen/esp/dokumen1', $uniqueFilenameDokumen1);
            $uploadedDokumen1[] = $uniqueFilenameDokumen1;
        }

        if ($request->hasFile('dokumen2')) {
            // Handle dokumen2 upload
            $dokumen2 = $request->file('dokumen2');
            $uniqueFilenameDokumen2 = uniqid() . '_' . $dokumen2->getClientOriginalName();
            $dokumen2->move('assets/dokumen/esp/dokumen2', $uniqueFilenameDokumen2);
            $uploadedDokumen2[] = $uniqueFilenameDokumen2;
        }

        if ($request->hasFile('dokumen3')) {
            // Handle dokumen3 upload
            $dokumen3 = $request->file('dokumen3');
            $uniqueFilenameDokumen3 = uniqid() . '_' . $dokumen3->getClientOriginalName();
            $dokumen3->move('assets/dokumen/esp/dokumen3', $uniqueFilenameDokumen3);
            $uploadedDokumen3[] = $uniqueFilenameDokumen3;
        }

        // Update the record with the uploaded file names
        if (!empty($uploadedDokumen1)) {
            $dokumenESP->dokumen1 = $uniqueFilenameDokumen1;
        }

        if (!empty($uploadedDokumen2)) {
            $dokumenESP->dokumen2 = $uniqueFilenameDokumen2;
        }

        if (!empty($uploadedDokumen3)) {
            $dokumenESP->dokumen3 = $uniqueFilenameDokumen3;
        }

        // Save the record
        $dokumenESP->save();

        // Store the uploaded file names or URLs in the session
        session()->put('uploadedDokumen1', $uploadedDokumen1);
        session()->put('uploadedDokumen2', $uploadedDokumen2);
        session()->put('uploadedDokumen3', $uploadedDokumen3);

        // Redirect to the desired route
        return redirect()->route('penyelaras.dokumen')->with('success', 'Semua fail SPBB telah berjaya dikemaskini.');
    }

    public function maklumatBank()
    {   
        $user = auth()->user();
        $id = $user->id_institusi;
        $bank = MaklumatBank::where('institusi_id', $id)->first();

        // Check if a record exists, and if not, create a new one
        if (!$bank) {
            $bank = new MaklumatBank();
            $bank->institusi_id = $id;
            $bank->nama_akaun = ''; 
            $bank->no_akaun = '';  
        }

        return view('kemaskini.penyelaras.maklumat_bank', compact('user','bank'));
    }

    public function kemaskiniMaklumatBank(Request $request, $id)
    {
        // Check if a record with the specified institusi_id exists
        $bank = MaklumatBank::where('institusi_id', $id)->first();

        // Check the id of institusi for the respective user
        $user = auth()->user();

        // Validation rules for the 'penyata' file input
        $rules = [
            'penyata' => 'file|mimes:pdf,png',
        ];
        $messages = [
            'penyata.file' => 'Invalid file format.',
            'penyata.mimes' => 'The file must be a PDF or PNG.',
        ];

        // Handle file upload only if a new file is provided
        if ($request->hasFile('penyata')) {
            $this->validate($request, $rules, $messages);

            $file = $request->file('penyata');
            $fileName = uniqid() . '_' . $file->getClientOriginalName(); // Generate a unique filename

            // Move the uploaded file to the desired directory
            $file->move('assets/dokumen/penyata_bank_islam', $fileName);

            // If the record exists, update it; otherwise, create a new one
            if ($bank) {
                $bank->update([
                    'nama_akaun' => $request->input('nama_bank'),
                    'no_akaun' => $request->input('no_acc'),
                    'penyata_bank' => $fileName,
                ]);
            } 
            else {
                MaklumatBank::create([
                    'institusi_id' => $id, 
                    'nama_akaun' => $request->input('nama_bank'),
                    'no_akaun' => $request->input('no_acc'),
                    'penyata_bank' => $fileName,
                ]);
            }
        } 
        else {
            // No new file uploaded, update other fields if necessary
            if ($bank) {
                $bank->update([
                    'nama_akaun' => $request->input('nama_bank'),
                    'no_akaun' => $request->input('no_acc'),
                ]);
            }
        }

        return view('kemaskini.penyelaras.maklumat_bank', compact('bank', 'user'));
    }
}
