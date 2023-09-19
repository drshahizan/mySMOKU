<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Smoku;
use App\Models\Hubungan;
use App\Models\Negeri;
use App\Models\Bandar;
use App\Models\InfoIpt;
use App\Models\PeringkatPengajian;
use App\Models\Kursus;
use App\Models\Sumberbiaya;
use App\Models\Penaja;
use App\Models\ButiranPelajar;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\Dokumen;


class PenyelarasPPKController extends Controller
{
    public function index()
    {
        $smoku = Smoku::orderBy('smoku.id','desc')
            ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
            ->leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
            ->get(['smoku.*', 'smoku_penyelaras.*', 'permohonan.*'])
            ->where('penyelaras_id','=', Auth::user()->id)
            ->where('status','!=', '2');
        //dd($smoku);    

        return view('dashboard.penyelaras_ppk.dashboard', compact('smoku'));

    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kp' => ['required', 'string'],
        ]);

        $smoku = Smoku::where([['no_kp', '=', $request->no_kp]])->first();
        
        if($smoku != null){
            $kodoku = $smoku->kategori;
            if ($smoku != null && $kodoku ==='DE') {
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

                return redirect()->route('penyelaras.ppk.dashboard')->with($smoku_id,$no_kp)
                    ->with('message', $request->no_kp. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM & DALAM KATEGORI OKU PENDENGARAN');

            } else if ($kodoku !='DE') {

                return redirect()->route('penyelaras.ppk.dashboard')
                    ->with('xmessage', $request->no_kp. ' BUKAN DALAM KATEGORI OKU PENDENGARAN');
            }

        }
        
        else {

            return redirect()->route('penyelaras.ppk.dashboard')
                ->with('xmessage', $request->no_kp. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
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

        $biaya = SumberBiaya::all()->sortBy('kod_biaya');
        $penaja = Penaja::all()->sortBy('kod_penaja');
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');
        $negeri = Negeri::orderby("kod_negeri","asc")->select('id','negeri')->get();

        $infoipt = InfoIpt::all()->where('jenis_institusi','PPK')->sortBy('nama_institusi');
        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');


        return view('permohonan.penyelaras_ppk.borang_permohonan_ppk', compact('smoku','hubungan','infoipt','peringkat','kursus','biaya','penaja','negeri'));
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
        $butiranPelajar = ButiranPelajar::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
        $butiranPelajar->alamat_surat_menyurat = $request->alamat_surat_menyurat;
        $butiranPelajar->alamat_surat_negeri = $request->alamat_surat_negeri;
        $butiranPelajar->alamat_surat_bandar = $request->alamat_surat_bandar;
        $butiranPelajar->alamat_surat_poskod = $request->alamat_surat_poskod;
        $butiranPelajar->tel_bimbit = $request->tel_bimbit;
        $butiranPelajar->tel_rumah = $request->tel_rumah;
        $butiranPelajar->no_akaun_bank = $request->no_akaun_bank;
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
       
        // Retrieve or create a Permohonan record based on smoku_id
        $permohonan = Permohonan::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
        $permohonan->no_rujukan_permohonan = 'P'.'/'.$request->peringkat_pengajian.'/'.Auth::user()->no_kp;
        $permohonan->program = 'PPK';
        $permohonan->wang_saku = $request->wang_saku;
        $permohonan->amaun_wang_saku = $request->amaun_wang_saku;
        $permohonan->perakuan = $request->perakuan;
        $permohonan->status = '1';

        // Save the record
        $permohonan->save();

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




        return redirect()->route('penyelaras.ppk.dashboard');

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

        return redirect()->route('penyelaras.ppk.dashboard')->with('message', 'Permohonan pelajar telah dihantar.');

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
        return view('permohonan.penyelaras_ppk.permohonanbaru', compact('smoku'));
    }
}
