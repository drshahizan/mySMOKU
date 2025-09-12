<?php

namespace App\Http\Controllers;

use App\Exports\DokumenSPBB2;
use App\Exports\DokumenSPBB2a;
use App\Exports\DokumenSPBB3;
use App\Exports\DokumenSPBB4;
use App\Exports\DokumenSPPB1;
use App\Exports\DokumenSPPB1a;
use App\Exports\PermohonanLayak;
use App\Http\Controllers\Controller;
use App\Mail\PermohonanHantar;
use App\Mail\TuntutanHantar;
use App\Models\Agama;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
use App\Models\SumberBiaya;
use App\Models\Penaja;
use App\Models\Status;
use App\Models\JenisOku;
use App\Models\Dokumen;
use App\Models\Hubungan;
use App\Models\Negeri;
use App\Models\Bandar;
use App\Models\DokumenESP;
use App\Models\Dun;
use App\Models\EmelKemaskini;
use App\Models\Tuntutan;
use App\Models\TuntutanItem;
use App\Models\SejarahTuntutan;
use App\Models\Peperiksaan;
use App\Models\Saringan;
use App\Models\Kelulusan;
use App\Models\Keturunan;
use App\Models\MaklumatBank;
use App\Models\Parlimen;
use App\Exports\TuntutanLayak;
use App\Imports\ModifiedPermohonanImport;
use App\Imports\ModifiedTuntutanImport;
use App\Mail\MailDaftarPentadbir;
use App\Mail\PengesahanCGPA;
use App\Models\JumlahTuntutan;
use App\Models\SaringanTuntutan;
use App\Models\SenaraiBank;
use App\Models\TukarInstitusi;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
            ->orWhereRaw("(SELECT permohonan.status FROM permohonan 
                JOIN smoku_penyelaras ON smoku_penyelaras.smoku_id = permohonan.smoku_id 
                WHERE permohonan.smoku_id = smoku.id AND penyelaras_id = " . Auth::user()->id . " 
                ORDER BY permohonan.id DESC LIMIT 1) = 9")
            ->select('smoku.*', 'smoku_penyelaras.*', 'permohonan.status', 'permohonan.id as permohonan_id')
            ->get();

        return view('dashboard.penyelaras_bkoku.dashboard', compact('smoku'));
    }

    public function store(Request $request)
    {
        //using api smoku
        $request->validate([
            'no_kp' => ['required', 'string'],
            
        ]);
        $nokp_in = $request->no_kp;

        $headers = [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer knhnxYoATGLiN5WxErU6SVVw8c9xhw09vQ3KRPkOtcH3O0CYh21wDA4CsypX',
        ];
        $client = new Client();
        $url = 'https://oku.jkm.gov.my/api/oku/' . $request->no_kp;
        // $url = 'https://oku-staging.jkm.gov.my/api/oku/' . $request->no_kp;
        $guzzleRequest = $client->get($url, ['headers' => $headers]);

        $response = $guzzleRequest ? $guzzleRequest->getBody()->getContents() : null;
        $status = $guzzleRequest ? $guzzleRequest->getStatusCode() : 500;

        // Parse the JSON string
        $data = json_decode($response, true);
        
        // Access the "data" field
        $dataField = [];
        if (isset($data['data'])) {
            $dataField = $data['data'];
            
            // Now, $dataField contains the "data" array
            $no_kp = $dataField['NO_ID'];
           
            $jantina = isset($dataField['JANTINA']) ? substr($dataField['JANTINA'], 0, 1) : null;
            $tarikh_lahir = $dataField['TARIKH_LAHIR'];
            $tarikhLahirDate = DateTime::createFromFormat('d/m/Y', $tarikh_lahir);
            $formattedDate = $tarikhLahirDate->format('Y-m-d');

            $kategori = $dataField['KATEGORI'];
            $jenis_oku = JenisOku::where('kecacatan',$kategori)->first();
            // dd($dataField['NO_DAFTAR_OKU']);
            if ($jenis_oku !== null) {
                $kod_oku = $jenis_oku->kod_oku;
            } else {
                $kod_oku = isset($dataField['NO_DAFTAR_OKU']) && !empty($dataField['NO_DAFTAR_OKU'])
                   ? substr($dataField['NO_DAFTAR_OKU'], 0, 2)
                   : null;
            }

            $keturunan = $dataField['KETURUNAN'];
            $kod = Keturunan::where('keturunan',$keturunan)->first();
            if ($kod !== null) {
                $kod_keturunan = $kod->kod_keturunan;
            } else {
                $kod_keturunan = null;
            }

            $hubungan = $dataField['HUBUNGAN_WARIS'];
            $kod = Hubungan::where('hubungan',$hubungan)->first();
            if ($kod !== null) {
                $kod_hubungan = $kod->kod_hubungan;
            } else {
                $kod_hubungan = null;
            }

            Smoku::updateOrInsert(
                ['no_kp' => $dataField['NO_ID']], // Condition to find the record
                [
                    'no_id_tentera' => $dataField['NO_ID_TENTERA'],
                    'nama' => $dataField['NAMA_PENUH'],
                    'no_daftar_oku' => $dataField['NO_DAFTAR_OKU'],
                    'kategori' => $kod_oku,
                    'jantina' => $jantina,
                    'tarikh_lahir' => $formattedDate,
                    'umur' => $dataField['UMUR'],
                    'keturunan' => $kod_keturunan,
                    'tel_rumah' => $dataField['TEL_RUMAH'],
                    'tel_bimbit' => $dataField['TEL_BIMBIT'],
                    'email' => $dataField['EMEL'],
                    'pekerjaan' => $dataField['PEKERJAAN'],
                    'pendapatan' => $dataField['PENDAPATAN'],
                    'status_pekerjaan' => $dataField['STATUS_PEKERJAAN'],
                    'alamat_tetap' => $dataField['ALAMAT_TETAP'],
                    'alamat_surat_menyurat' => $dataField['ALAMAT_SURAT_MENYURAT'],
                    'nama_waris' => $dataField['NAMA_WARIS'],
                    'tel_bimbit_waris' => $dataField['TEL_BIMBIT_WARIS'],
                    'hubungan_waris' => $kod_hubungan,
                    'pekerjaan_waris' => $dataField['PEKERJAAN_WARIS'],
                    // 'pendapatan_waris' => $dataField['PENDAPATAN_WARIS'],
                    'updated_at' => DB::raw('NOW()')
                ],
                [
                    'created_at' => DB::raw('NOW()')
                ]
            );

            $smoku=Smoku::where([['no_kp', '=', $no_kp]])->first();
            // dd($smoku);
            $penyelaras=DB::table('smoku_penyelaras')->where('smoku_id', '=', $smoku->id)
            ->first();
            $penyelaras_sama=DB::table('smoku_penyelaras')->where('smoku_id', '=', $smoku->id)
            ->where([['penyelaras_id', '=', Auth::user()->id]])
            ->first();
            // dd($penyelaras_sama);

            if ($smoku != null && $penyelaras_sama == null) {
                if ($penyelaras == null) {
                    DB::table('smoku_penyelaras')->insert([
                        'smoku_id' => $smoku->id,
                        'penyelaras_id' => Auth::user()->id,
                        'status' => '1',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                } else {
                    return redirect()->route('penyelaras.dashboard')->with($no_kp)
                        ->with('failed', $no_kp . ' Sudah didaftarkan di universiti lain.');
                }
            } else {
                return redirect()->route('penyelaras.dashboard')->with($no_kp)
                    ->with('failed', $no_kp . ' Sudah didaftarkan.');
            }

            $smoku = Smoku::where('no_kp', $no_kp)->first();
            $id =  $smoku->id;
            $no_kp =  $smoku->no_kp;
            $smoku_id = $request->session()->put('id',$id);
            $no_kp = $request->session()->put('no_kp',$no_kp);
            
            return redirect()->route('penyelaras.dashboard')->with($smoku_id,$no_kp)
            ->with('success', $no_kp. ' Sah sebagai OKU berdaftar dengan JKM.');
        } 
        else 
        {
            return redirect()->route('penyelaras.dashboard')
            ->with('failed', $nokp_in. ' Bukan OKU yang berdaftar dengan JKM.');
        }
        
        /*
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
                ->with('success', $no_kp. ' Sah sebagai OKU berdaftar dengan JKM.');
            } 
            else {
                $nokp_in = $request->nokp;
                return redirect()->route('penyelaras.dashboard')
                ->with('failed', $nokp_in. ' Bukan OKU yang berdaftar dengan JKM.');
            }
            */
    }

    public function deletePendaftaran($id)
    {
        DB::table('smoku_penyelaras')->where('smoku_id',$id)->delete();
        
        return redirect()->route('penyelaras.dashboard')->with('success', 'Pendaftaran pelajar telah di padam.');
    }

    public function permohonanBaharu($id)
    {
        set_time_limit(1200);
        
        $smoku = Smoku:: join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
            ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
            ->leftJoin('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
            ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
            ->where('smoku.id', $id)
            ->get(['smoku.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*']);
        
        $biaya = SumberBiaya::all()->where('kod_biaya','!=','2')->sortBy('kod_biaya');
        $penaja = Penaja::all()->sortBy('kod_penaja');
        $penajaArray = $penaja->toArray();
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');
        $negeri = Negeri::orderby("kod_negeri","asc")->select('id','negeri','kod_negeri')->get();
        $bandar = Bandar::orderby("id","asc")->select('id','bandar')->get();
        $agama = Agama::orderby("id","asc")->select('id','agama')->get();
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if($infoipt ->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi){
            $infoipt = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        else if($infoipt ->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi){
            $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        }
        else{
            $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        }
        // dd($infoipt);
        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kod_mod');
        $keturunan = Keturunan::all()->sortBy('id');
        $parlimen = Parlimen::orderby("id","asc")->get();
        $dun = Dun::orderby("id","asc")->get();

        $permohonan = Permohonan::orderby("id","desc")->where('smoku_id', $id)->first();
        $butiranPelajar = ButiranPelajar::orderBy('permohonan.id', 'desc')
        ->join('smoku','smoku.id','=','smoku_butiran_pelajar.smoku_id')
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
            'smoku_butiran_pelajar.tel_rumah as tel_rumah_baru', 'smoku.*','smoku_waris.*','smoku_akademik.*','permohonan.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*', 'bk_parlimen.*', 'bk_parlimen.id as id_parlimen'])
        ->where('smoku_id', $id) 
        ->first();

        if ($permohonan && $permohonan->status >= '1' && $permohonan->status != '9') {
            $dokumen = Dokumen::all()->where('permohonan_id', $permohonan->id);
            return view('permohonan.penyelaras_bkoku.permohonan_view', compact('butiranPelajar','hubungan','negeri','bandar','infoipt','peringkat','mod','biaya','penaja','penajaArray','dokumen','agama','parlimen','dun','keturunan','permohonan'));
        } else {
            return view('permohonan.penyelaras_bkoku.permohonan_baharu', compact('smoku','hubungan','infoipt','peringkat','mod','kursus','biaya','penaja','penajaArray','negeri','bandar','agama','parlimen','dun','keturunan'));
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
            ->orderBy('bk_peringkat_pengajian.kod_peringkat','desc')
            ->get();

        return response()->json($peringkatData);
    }

    public function kursus($kodperingkat=0,$ipt=0)
    {
        $kursusData['data'] = Kursus::orderby("nama_kursus","asc")
            ->where('kod_peringkat',$kodperingkat)
            ->where('id_institusi',$ipt)
            ->groupBy(['nama_kursus', 'kod_nec', 'bidang'])
            ->select('nama_kursus', 'kod_nec', 'bidang')
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
                'email' => $request->emel,
                'keturunan' => $request->keturunan,
            ]
        );

        // $permohonan = Permohonan::firstOrNew(['smoku_id' => $id]);

        // $permohonan->program = 'BKOKU';
        // $permohonan->status = '1';

        // $permohonan->save();

        $butiranPelajar = ButiranPelajar::firstOrNew(['smoku_id' => $id]);

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

        // Save the record
        $butiranPelajar->save();

        // Retrieve or create a Waris record based on smoku_id
        $waris = Waris::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
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
        // Permohonan::updateOrCreate(
        //     ['smoku_id' => $id, 'status' => 1],
        //     [
        //         'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar,
        //         'program' => 'BKOKU',
        //         'yuran' => $request->yuran,
        //         'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
        //         'wang_saku' => $request->wang_saku,
        //         'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
        //         'perakuan' => $request->perakuan,
        //         'status' => '1',
        //     ]
        // );
       
        // // Retrieve or create a Permohonan record based on smoku_id
        $permohonan = Permohonan::orderBy('id', 'desc')
         ->where('smoku_id', $id)
         ->first(); 

        if (!$permohonan || $permohonan->status == 9) {
            $permohonan = Permohonan::create(
                [   'smoku_id' => $id,
                    'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar,
                    'program' => 'BKOKU',
                    'yuran' => $request->yuran,
                    'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
                    'wang_saku' => $request->wang_saku,
                    'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                    'perakuan' => $request->perakuan,
                    'status' => 1,
                ]
            );
        } elseif ($permohonan->status == 1) {
            $permohonan = Permohonan::updateOrCreate(
                ['smoku_id' => $id,'status' => 1],
                [
                    'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar,
                    'program' => 'BKOKU',
                    'yuran' => $request->yuran,
                    'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
                    'wang_saku' => $request->wang_saku,
                    'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                    'perakuan' => $request->perakuan,
                    'status' => $permohonan->status == '1' || $permohonan->status == null ? '1' : $permohonan->status,
                ]
            );
        } elseif ($permohonan->status == 5) {
            $permohonan = Permohonan::updateOrCreate(
                ['smoku_id' => $id,'status' => 5],
                [
                    'no_rujukan_permohonan' => 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar,
                    'program' => 'BKOKU',
                    'yuran' => $request->yuran,
                    'amaun_yuran' => number_format($request->amaun_yuran, 2, '.', ''),
                    'wang_saku' => $request->wang_saku,
                    'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                    'perakuan' => $request->perakuan,
                ]
            );
        }   
        /*$permohonan = Permohonan::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
        $permohonan->no_rujukan_permohonan = 'B'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar;
        $permohonan->program = 'BKOKU';
        $permohonan->yuran = $request->yuran;
        $permohonan->amaun_yuran = number_format($request->amaun_yuran, 2, '.', '');
        $permohonan->wang_saku = $request->wang_saku;
        $permohonan->amaun_wang_saku = number_format($request->amaun_wang_saku, 2, '.', '');
        $permohonan->perakuan = $request->perakuan;
        // Conditionally set the status
        if ($permohonan->status == '1' || $permohonan->status == null) {
            $permohonan->status = '1';
        }

        // Save the record
        $permohonan->save();*/

        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        // Retrieve or create a SejarahPermohonan record based on smoku_id
        $sejarah = SejarahPermohonan::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
        $sejarah->permohonan_id = $permohonan_id->id;
        $sejarah->status = '1';

        // Save the record
        $sejarah->save();

        //$dokumen = Dokumen::where('smoku_id', '=', $smoku_id->id)->first();
        $permohonan_id = Permohonan::where('smoku_id',$id)->first();

        return redirect()->route('penyelaras.dashboard');
    }

    public function hantar(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',$request->no_kp)->first();
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

        // Generate a running number (you can use your logic here)
        $runningNumber = rand(1000, 9999);

        // Create an array to store the document types and their respective IDs
        $documentTypes = [
            'akaunBank' => 1,
            'suratTawaran' => 2,
            'invoisResit' => 3,
        ];

        foreach ($documentTypes as $inputName => $idDokumen) 
        {
            $file = $request->file($inputName);

            if ($file) {
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                $newFilename = $filenameWithoutExtension . '_' . $runningNumber . '.' . $extension;
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

        //emel kepada sekretariat - comment asal
        // $user_sekretariat = User::where('tahap',3)->first();
        // $cc = $user_sekretariat->email;
        //emel kepada sekretariat -ada ramai sekretariat
        // $user_sekretariat = User::where('tahap',3)->get();
        // $cc = $user_sekretariat->pluck('email')->toArray();
        // $invalidEmails = [];
        // foreach ($cc as $email_cc) {
        //     if (!filter_var($email_cc, FILTER_VALIDATE_EMAIL)) {
        //         $invalidEmails[] = $email_cc;
        //     }
        // }
        //taknak emel sekretariat


        // COMMENT PROD
        //emel kepada pelajar 
        $emel_pelajar = Smoku::where('id',$smoku_id->id)->first();
        $cc_pelajar = $emel_pelajar->email;

        //emel kepada penyelaras
        $user = User::where('no_kp',Auth::user()->no_kp)->first();

        $catatan = "testing";
        $emel = EmelKemaskini::where('emel_id',13)->first();

        if (empty($invalidEmails)) 
        {
            Mail::to($user->email)->cc($cc_pelajar)->send(new PermohonanHantar($catatan, $emel));
        } 
        else 
        {
            foreach ($invalidEmails as $invalidEmail) {
                Log::error('Invalid email address: ' . $invalidEmail);
            }
        }


        //CREATE USER ID TERUS UNTUK PELAJAR
        $user = User::where('no_kp', '=', $smoku_id->no_kp)->first();
        $characters = 'abcdefghijklmn123456789!@#$%^&';
        $password_length = 12;

        // Generate the random password
        $password = '';
        for ($i = 0; $i < $password_length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }

        if ($user === null) 
        {
            $userData = [
                'nama' => $request->nama_pelajar,
                'no_kp' => $request->no_kp,
                'email' => $request->emel,
                'tahap' => 1,
                'password' => Hash::make($password),
                'status' => 1,
            ];
   
            $user = User::create($userData);
            
            // COMMENT PROD
            $email = $request->emel;
            $no_kp = $request->no_kp;
            Mail::to($email)->send(new MailDaftarPentadbir($email,$no_kp,$password)); 
        }

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
        ->orderBy('permohonan.tarikh_hantar', 'DESC')
        ->get(['smoku.*', 'permohonan.*', 'smoku_akademik.*', 'bk_info_institusi.nama_institusi']);

        return view('permohonan.penyelaras_bkoku.senarai_baharu', compact('smoku'));
    }

    public function senaraiTuntutanBaharu()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        // else if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi) {
        //     $infoiptCollection = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        // } 
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }

        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');
        
        $layak = Smoku::join('permohonan','permohonan.smoku_id','=','smoku.id')
        ->join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->leftJoin('tuntutan', function ($join) {
            $join->on('tuntutan.permohonan_id', '=', 'permohonan.id')
                ->whereRaw('tuntutan.id = (
                    SELECT MAX(t.id) 
                    FROM tuntutan t
                    WHERE t.permohonan_id = permohonan.id
                )')
                ->whereNull('tuntutan.data_migrate');
        })
        ->whereIn('smoku_akademik.id_institusi', $idInstitusiList)
        ->whereIn('permohonan.status', [6,8]) 
        ->whereDate('smoku_akademik.tarikh_tamat', '>', today())
        ->orderBy('permohonan.tarikh_hantar', 'DESC')
        ->select('smoku.*', 'permohonan.program', 'permohonan.id as permohonan_id', 'permohonan.no_rujukan_permohonan', 'permohonan.tarikh_hantar', 'tuntutan.status as tuntutan_status','smoku_akademik.*', 'bk_info_institusi.nama_institusi')
        ->distinct()
        ->get();

        // dd($layak);

        return view('tuntutan.penyelaras_bkoku.tuntutan_baharu', compact('layak'));
    }

    public function kemaskiniKeputusan($id)
    {   
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $smoku_id = $id;

        $akademik = Akademik::where('smoku_id',$id)
            ->where('smoku_akademik.status', 1)
            ->first();
        
        $bilSem = ($akademik->bil_bulan_per_sem == 6) ? 2 : 3;
        $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
        $currentDate = Carbon::now();

        $tarikhMula = Carbon::parse($akademik->tarikh_mula);
        $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);

        $bulanMula  = $tarikhMula->format('n');
        $isSpecialStart = in_array($bulanMula, [1, 3]);

        // Initialize tahun sesi
        $tahunSesi = $isSpecialStart ? $tarikhMula->year - 1 : $tarikhMula->year;
        $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

        // Define semester pattern
        if (in_array($bulanMula, [1, 3])) {
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

            return view('tuntutan.penyelaras_bkoku.kemaskini_keputusan_peperiksaan', compact('peperiksaan','smoku_id','permohonan','previousSesi','sesiLepas','result'));
        } 
        else 
        {
            return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
    }

    public function hantarKeputusanPeperiksaan(Request $request, $id)
    {
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $smoku_id = Smoku::where('id',$id)->first();
        //simpan dalam table peperiksaan
        $kepPeperiksaan=$request->kepPeperiksaan;
        $counter = 1; 

        // Check if files were uploaded
        // tak wajib
        $counter = 1; // Initialize the counter

        if ($request->hasFile('kepPeperiksaan')) {
            $kepPeperiksaan = $request->file('kepPeperiksaan');
            $filenamekepP = $kepPeperiksaan->getClientOriginalName();
            $uniqueFilename = $counter . '_' . $filenamekepP;

            // Append increment to the filename until it's unique
            while (file_exists('assets/dokumen/peperiksaan/' . $uniqueFilename)) {
                $counter++;
                $uniqueFilename = $counter . '_' . $filenamekepP;
            }

            // Move the uploaded file
            $kepPeperiksaan->move('assets/dokumen/peperiksaan', $uniqueFilename);
        } else {
            // Set a default value if no file is uploaded
            $uniqueFilename = null;
        }

        $cgpa = $request->cgpa;
            if($cgpa >= 0.0 && $cgpa < 2.0){
                $pengesahan = 1;
                $catatan = "Pelajar telah menghantar keputusan peperiksaan semester lepas. Keputusan tersebut perlu pengesahan daripada Sekretariat KPT sebelum tuntutan dapat dikemukakan.";
                
                if (!empty(trim($smoku_id->email))) 
                {       
                    // Mail::to($emailmain)->cc($smoku_id->email)->send(new PengesahanCGPA($catatan)); 
                    Mail::to($smoku_id->email)->send(new PengesahanCGPA($catatan)); 

                } 
               
            }else{
                $pengesahan = null;
            }

        // Save the peperiksaan record
        $data = new peperiksaan();
        $data->permohonan_id = $permohonan->id;
        $data->sesi = $request->sesi;
        $data->semester = $request->semester;
        $data->cgpa = $request->cgpa;
        $data->pengesahan_rendah=$pengesahan;
        $data->kepPeperiksaan = $uniqueFilename;
        $data->save();

        return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('message', 'Keputusan peperiksaan pelajar telah disimpan.');

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



    public function tuntutanBaharu($id)
    {   
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();

        $smoku_id = $id;
        $akademik = Akademik::where('smoku_id',$id)
            ->where('smoku_akademik.status', 1)
            ->first();

        // against missing akademik
        if (!$akademik) {
            return back()->with('error', 'Maklumat akademik pelajar tidak ditemui.');
        }

        $maxLimitRow = DB::table('bk_jumlah_tuntutan')
            ->where('program','BKOKU')
            ->where('jenis', 'Yuran')
            ->first();    

        $limitWangSakuRow = DB::table('bk_jumlah_tuntutan')
            ->where('program','BKOKU')
            ->where('jenis', 'Wang Saku')
            ->first();    

        $maxLimit = $maxLimitRow->jumlah ?? 0;  
        $limitWangSaku = $limitWangSakuRow->jumlah ?? 0;


        if ($permohonan && $permohonan->status == 6 || $permohonan->status == 7 || $permohonan->status == 8) {  

            $bilSem = ($akademik->bil_bulan_per_sem == 6) ? 2 : 3;
            $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
            $currentDate = Carbon::now();

            $tarikhMula = Carbon::parse($akademik->tarikh_mula);
            $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);

            $bulanMula  = $tarikhMula->format('n');
            $isSpecialStart = in_array($bulanMula, [1, 3]);

            // Initialize tahun sesi
            $tahunSesi = $isSpecialStart ? $tarikhMula->year - 1 : $tarikhMula->year;
            $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

            // Define semester pattern
            if (in_array($bulanMula, [1, 3])) {
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

            // Example debug output
            // echo '<br>';
            // echo 'Tahun Lepas: ' . $previousSesi . '<br>';
            // echo 'Tahun Semasa: ' . $currentSesi . '<br>';
            // echo 'Sesi Lepas: ' . $sesiLepas . '<br>';
            // echo 'Sesi Semasa: ' . $sesiSemasa . '<br>';
            // echo 'Semester Semasa: ' . $semSemasa . '<br>';
            // dd('sini');

            $tuntutan = Tuntutan::where('smoku_id', $id)
                ->where('permohonan_id', $permohonan->id)
                ->whereNotIn('status', [6,8])
                // ->where('sesi', $sesiSemasa)
                // ->where('semester', $semSemasa)
                ->whereNull('data_migrate')
                ->orderBy('tuntutan.id', 'desc')
                ->first(['tuntutan.*']);
            

            if ($currentDate <= $semesterEndDate ) {
                if($currentSesi != $previousSesi){
                    // semak dah upload result ke belum
                    $result = Peperiksaan::where('permohonan_id', $permohonan->id)
                    ->where('sesi', $previousSesi)
                    ->where('semester', $sesiLepas)
                    ->first();
                    if($result == null){
                        return redirect()->route('bkoku.kemaskini.keputusan', ['id' => $id])->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                    }elseif($result && $result->pengesahan_rendah== 1){
                        return back()->with('sem', 'Keputusan peperiksaan dalam semakan.');

                    }
                    
                }
                   
            }
            else
            {
                return back()->with('sem', 'Tamat pengajian.');
            }
            
            // dd($akademik->sesi);
       
            if (($currentSesi === $akademik->sesi) || $previousSesi === null) {
            

                if (!$tuntutan || $tuntutan->status == 1) {
                    if ($semSemasa == $semLepas){
                        $wang_saku = 0.00;
                    }

                    //nak tahu baki sesi semasa permohonan lepas
                    $baki_total = $permohonan->baki_dibayar ?? $maxLimit;
                    //  dd($baki_total);
                }
                else{
                    // dd('sini');
                    $ada = DB::table('tuntutan')
                        ->where('permohonan_id', $tuntutan->permohonan_id)
                        ->orderBy('id', 'desc')
                        ->first();

                    if($ada -> sesi ==  null){
                        $baki_total = $maxLimit;	
                    }else{
                        $jumlah_tuntut = DB::table('tuntutan')
                        ->where('permohonan_id', $tuntutan->permohonan_id)
                        ->where('status','!=', 9)
                        ->get();
                        $sum = $jumlah_tuntut->sum('jumlah');	
                        
                        // $baki_total = $permohonan->baki_dibayar - $sum;	
                        $baki_total = $maxLimit - $sum;	
                    }
                    
                    // dd($baki_total);
                }	
            }
            else {

                
                if ($permohonan->yuran == null && $permohonan->wang_saku == '1') {
                    if($semSemasa != $semLepas && $semSemasa != $akademik->sem_semasa){
                        $baki_total = $limitWangSaku * $akademik->bil_bulan_per_sem; 
                    }
                    else {
                        $baki_total = '0'; 
                    }
                }
                else {
                    $baki_total = $maxLimit;
                    
                }
            }
            
            
            if ($tuntutan && ($tuntutan->status == 1 || $tuntutan->status == 2 || $tuntutan->status == 5)) 
            {
                $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->get();
            } 
            // else if ($tuntutan && $tuntutan->status != 8 && $tuntutan->status != 9)
            // {
            //     // return back()->with('sem', 'Tuntutan pelajar masih dalam semakan.');
            //     $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->get();                           

            //     // dd($tuntutan);
            // }
            else if ($tuntutan && ($tuntutan->status == 3 || $tuntutan->status == 4))
            {
                return back()->with('sem', 'Tuntutan pelajar masih dalam semakan.');
            }
            else 
            {
                $tuntutan_item = collect(); // An empty collection
            }

            return view('tuntutan.penyelaras_bkoku.borang_tuntutan', compact('permohonan','tuntutan','tuntutan_item','akademik','smoku_id','sesiSemasa','semSemasa','baki_total'));
            
        } 
        else if ($permohonan && $permohonan->status !=6) {

            return redirect()->route('dashboard')->with('permohonan', 'Permohonan pelajar masih dalam semakan.');
        } 
        else {

            return redirect()->route('dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
        
    }

    public function simpanTuntutan(Request $request, $id)
    {   
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $id)->first();
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id', '=', $id)->first();

        if(!$tuntutan || $tuntutan->status == 6 || $tuntutan->status == 8 || $tuntutan->status == 9){
            
            $biltuntutan = Tuntutan::where('smoku_id', '=', $id)
                ->groupBy('no_rujukan_tuntutan')
                ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
                ->get();
            $bil = $biltuntutan->count();

            $running_num =  $bil + 1; //sebab nak guna satu id je  
            $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num;   

        } 
        else {
            $no_rujukan_tuntutan = $tuntutan->no_rujukan_tuntutan;
        }

        //simpan dalam table tuntutan
        $tuntutan = Tuntutan::where('smoku_id', $id)
            ->where('permohonan_id', $permohonan->id)
            ->where('sesi', $request->sesi)
            ->where('no_rujukan_tuntutan', $no_rujukan_tuntutan)
            ->first();

        // if ($tuntutan) {
        //     // kalau semester sama dengan yang sedia ada
        //     if ($tuntutan->semester == $request->semester) {
        //         return back()->with('sem', 'Tuntutan pelajar boleh dituntut pada sem seterusnya.');
        //     }
        // } else {

        //     $akademik = Akademik::where('smoku_id',$id)
        //         ->where('smoku_akademik.status', 1)
        //         ->first();
        //     // semak kalau semester permohonan sama dengan request
        //     if ($akademik->sem_semasa == $request->semester) {
        //         return back()->with('sem', 'Tuntutan pelajar boleh dituntut pada sem seterusnya.');
        //     }
        // }

        // kalau tak ada record, atau semester lain → buat rekod baru
        $tuntutan = Tuntutan::create([
            'smoku_id' => $id,
            'permohonan_id' => $permohonan->id,
            'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
            'sesi' => $request->sesi,
            'semester' => $request->semester,    
            'yuran' => '1',
            'status' => '1',
        ]);

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::orderBy('id', 'desc')
            ->where('smoku_id', '=', $id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();

        $resit = $request->resit;
        $counter = 1;

        // Check if $request->resit is not null before iterating
        if ($resit !== null && is_array($resit) && isset($resit[0]) && $resit[0] !== null) {
            foreach ($resit as $resitItem) {
                $filenameresit = $resitItem->getClientOriginalName();
                $uniqueFilename = $counter . '_' . $filenameresit;

                // Append increment to the filename until it's unique
                while (file_exists('assets/dokumen/tuntutan/' . $uniqueFilename)) {
                    $counter++;
                    $uniqueFilename = $counter . '_' . $filenameresit;
                }

                $resitItem->move('assets/dokumen/tuntutan', $uniqueFilename);

                // Create an array with all data
                $data = [
                    'tuntutan_id' => $tuntutan->id,
                    'jenis_yuran' => $request->jenis_yuran,
                    'no_resit' => $request->no_resit,
                    'nota_resit' => $request->nota_resit,
                    'amaun' => $request->amaun_yuran,
                    'resit' => $uniqueFilename,
                ];

                // Update or create the record
                TuntutanItem::updateOrCreate(
                    [
                        'tuntutan_id' => $tuntutan->id,
                        'jenis_yuran' => $request->jenis_yuran,
                    ],
                    $data
                );

                $counter++;
            }
        } else {
            // If $request->resit is null, update other data without updating resit
            TuntutanItem::updateOrCreate(
                [
                    'tuntutan_id' => $tuntutan->id,
                    'jenis_yuran' => $request->jenis_yuran,
                ],
                [
                    'no_resit' => $request->no_resit,
                    'nota_resit' => $request->nota_resit,
                    'amaun' => $request->amaun_yuran,
                ]
            );
        }

            
        //simpan dalam table sejarah_tuntutan
        $sejarahtuntutan = SejarahTuntutan::updateOrCreate(
            ['tuntutan_id' => $tuntutan->id], // syarat
            [
                'smoku_id' => $id,
                'status'   => '1',
            ]
        );
            
        return redirect()->route('bkoku.tuntutan.baharu', [$id])->with('message', 'Simpan.');
    }

    public function hantarTuntutan(Request $request, $id)
    {
        $permohonan = Permohonan::where('smoku_id', $id)->orderByDesc('id')->first();

        if ($permohonan) {
            $no_rujukan_tuntutan = null;

            // === CASE 1: Wang Saku Sahaja (yuran == null & wang_saku == 1) ===
            if (is_null($permohonan->yuran) && $permohonan->wang_saku == 1) {
                // Guna permohonan pertama
                $permohonan = Permohonan::where('smoku_id', $id)->orderBy('id')->first();
                $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

                $tuntutan = Tuntutan::where('smoku_id', $id)->orderByDesc('id')->first();

                if (!$tuntutan || in_array($tuntutan->status, [8, 9])) {
                    $biltuntutan = Tuntutan::where('smoku_id', $id)
                        ->groupBy('no_rujukan_tuntutan')
                        ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan')
                        ->get();
                    $bil = $biltuntutan->count();

                    $running_num = $bil + 1;
                    $no_rujukan_tuntutan = $no_rujukan_permohonan . '/' . $running_num;
                } else {
                    $no_rujukan_tuntutan = $tuntutan->no_rujukan_tuntutan;
                }

                //simpan dalam table tuntutan
                $tuntutan = Tuntutan::where('smoku_id', $id)
                    ->where('permohonan_id', $permohonan->id)
                    ->where('sesi', $request->sesi)
                    ->where('no_rujukan_tuntutan', $no_rujukan_tuntutan)
                    ->first();

                // if ($tuntutan) {
                //     // kalau semester sama dengan yang sedia ada
                //     if ($tuntutan->semester == $request->semester) {
                //         return back()->with('sem', 'Tuntutan pelajar boleh dituntut pada sem seterusnya.');
                //     }
                // } else {

                //     $akademik = Akademik::where('smoku_id',$id)
                //         ->where('smoku_akademik.status', 1)
                //         ->first();
                //     // semak kalau semester permohonan sama dengan request
                //     if ($akademik->sem_semasa == $request->semester) {
                //         return back()->with('sem', 'Tuntutan pelajar boleh dituntut pada sem seterusnya.');
                //     }
                // }

                // kalau tak ada record, atau semester lain → buat rekod baru
                $tuntutan = Tuntutan::create([
                    'smoku_id' => $id,
                    'permohonan_id' => $permohonan->id,
                    'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                    'sesi' => $request->sesi,
                    'semester' => $request->semester,    
                    'wang_saku' => $request->wang_saku,
                    'amaun_wang_saku' => $request->amaun_wang_saku,
                    'status' => '1',
                ]);

                $sejarah = SejarahTuntutan::create([
                    'tuntutan_id' => $tuntutan->id,
                    'smoku_id' => $id,
                    'status' => '1',
                    'dilaksanakan_oleh' =>  Auth::user()->id,
            
                ]);
                $sejarah->save();
            }

            // === CASE 2: Wang Saku + Yuran ===
            elseif ($permohonan->yuran == 1 && $permohonan->wang_saku == 1) {
                $tuntutan = Tuntutan::where('smoku_id', $id)->orderByDesc('id')->first();

                if ($tuntutan) {
                    $tuntutan->update([
                        'wang_saku' => $request->wang_saku,
                        'amaun_wang_saku' => $request->amaun_wang_saku,
                        'jumlah' => $request->jumlah,
                        'tarikh_hantar' => now()->format('Y-m-d'),
                        'status' => '2',
                    ]);
                }
            }

            // === KEMASKINI UMUM (dijalankan selepas semua kes) ===
            $tuntutan = Tuntutan::where('smoku_id', $id)->orderByDesc('id')->first();

            if ($tuntutan) {
                $tuntutan->update([
                    'jumlah' => $request->jumlah,
                    'tarikh_hantar' => now()->format('Y-m-d'),
                    'status' => '2',
                ]);
            }
        }

        $sejarah = SejarahTuntutan::create([
            'tuntutan_id' => $tuntutan->id,
            'smoku_id' => $id,
            'status' => '2',
            'dilaksanakan_oleh' =>  Auth::user()->id,
    
        ]);
        $sejarah->save();

        // COMMENT PROD
        //emel kepada pelajar
        $emel_pelajar = Smoku::where('id',$id)->first();
        $cc_pelajar = $emel_pelajar->email;

        //emel kepada penyelaras
        $user = User::where('no_kp',Auth::user()->no_kp)->first();

        $catatan = "Tuntutan";
        $emel = EmelKemaskini::where('emel_id',14)->first();
    
        Mail::to($user->email)->cc($cc_pelajar)->send(new TuntutanHantar($catatan,$emel));
        
        return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('message', 'Tuntutan pelajar telah di hantar.');
    }

    public function sejarahTuntutan()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        // else if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi) {
        //     $infoiptCollection = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        // } 
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');

        $tuntutan = Tuntutan::join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tuntutan.smoku_id')
        // join('smoku_penyelaras', 'smoku_penyelaras.smoku_id', '=', 'tuntutan.smoku_id')
        // ->where('smoku_penyelaras.penyelaras_id', '=', Auth::user()->id)
        ->whereIn('smoku_akademik.id_institusi', $idInstitusiList)
        ->select('tuntutan.*')
        ->orderBy('tuntutan.id', 'DESC')
        ->get();

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

        return view('tuntutan.penyelaras_bkoku.keputusan_peperiksaan',compact('akademik','permohonan','peperiksaan'));
    }

    public function paparRekodSaringanTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();

        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)
        ->where('status', '8')
        ->where('id', '<', $sejarah_t->tuntutan_id)
        ->orderBy('id','desc')->first();

        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;
        $sama_semester = false;
        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
            if ($baki_terdahulu == null){
                $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
                $baki_terdahulu = $j_tuntutan->jumlah;
            }
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true;
            }
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        // dd($baki_terdahulu);


        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.penyelaras_bkoku.papar_saringan',compact('sama_semester','baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function sejarahPermohonan()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        // else if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi) {
        //     $infoiptCollection = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        // } 
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');
        
        $permohonan = Permohonan::join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
            ->whereIn('smoku_akademik.id_institusi', $idInstitusiList) // Use `whereIn` for multiple IDs
            ->select('permohonan.*')
            ->orderBy('permohonan.tarikh_hantar', 'DESC')
            ->get();
        // dd($permohonan);
        return view('permohonan.penyelaras_bkoku.sejarah_permohonan',compact('permohonan'));
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
        
        return redirect()->route('bkoku.sejarah.permohonan');
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
  
        return redirect()->route('bkoku.sejarah.permohonan')->with('success', 'Permohonan telah dibatalkan.');      
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

    //DOKUMEN SPBB
    public function muatTurunBorangSPBB()
    {   
        $user = auth()->user();
        $institusiId = $user->id_institusi;
        
        // Get documents for the user's 'institusi_id' and 'no_rujukan' ending in '/1'
        // $dokumen = DokumenESP::where('institusi_id', $institusiId)
        //     ->where('no_rujukan', 'like', '%/1')
        //     ->orderBy('created_at', 'desc')
        //     ->get(); 
        
        return view('spbb.penyelaras.muat_turun_dokumen', compact('institusiId'));
    }

    public function muatTurunDokumenSPBB1()
    {
        return Excel::download(new DokumenSPPB1, 'SPBB1-BKOKU.xlsx');
    }

    public function muatTurunDokumenSPBB1a()
    {
        return Excel::download(new DokumenSPPB1a, 'SPBB1a-BKOKU.xlsx');
    }

    public function muatTurunDokumenSPBB2()
    {
        return Excel::download(new DokumenSPBB2, 'SPBB2-BKOKU.xlsx');
    }

    public function muatTurunDokumenSPBB2a()
    {
        return Excel::download(new DokumenSPBB2a, 'SPBB2a-BKOKU.xlsx');
    }

    public function muatTurunDokumenSPBB3()
    {
        return Excel::download(new DokumenSPBB3, 'SPBB3-BKOKU.xlsx');
    }

    public function muatNaikBorangSPBB()
    {   
        $user = auth()->user();
        $institusiId = $user->id_institusi;
        
        // Get documents for the user's 'institusi_id' and 'no_rujukan' ending in '/2'
        $dokumen = DokumenESP::where('institusi_id', $institusiId)
            // ->where('no_rujukan', 'like', '%/2')
            ->orderByDesc('id')
            ->get();

        return view('spbb.penyelaras.muat_naik_dokumen', compact('institusiId','dokumen'));
    }

    public function hantarBorangSPBB(Request $request)
    {
        $user = auth()->user();
        $institusiId = $user->id_institusi;
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        // Check last record in the same month/year
        $lastRecord = DokumenESP::where('institusi_id', $institusiId)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->orderByDesc('id')
            ->first();

        // Validation rules
        $rules = [
            'dokumen1.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:8192',
            'dokumen1a.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:8192',
            'dokumen2.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:8192',
            'dokumen2a.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:8192',
            'dokumen3.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:8192',
            'dokumen4.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:8192',
        ];

        $customMessages = [
            'mimes' => 'Format fail bagi :attribute mestilah pdf, xls, atau xlsx sahaja.',
            'max' => 'Saiz maksimum bagi :attribute adalah 8 MB.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!$lastRecord) {
            // Create new record → increment number for institusi
            $lastRecordOverall = DokumenESP::where('institusi_id', $institusiId)
                ->whereYear('created_at', $currentYear)
                ->orderByDesc('id')
                ->first();

            if ($lastRecordOverall && preg_match('/\/(\d+)$/', $lastRecordOverall->no_rujukan, $matches)) {
                $nextNumber = intval($matches[1]) + 1;
            } else {
                $nextNumber = 1;
            }

            $noRujukan = "{$institusiId}/{$currentYear}/{$nextNumber}";

            $dokumenESP = new DokumenESP();
            $dokumenESP->user_id = $user->id;
            $dokumenESP->institusi_id = $institusiId;
            $dokumenESP->no_rujukan = $noRujukan;
        } else {
            // Update same-month record
            $dokumenESP = $lastRecord;
        }

        $uploadedAnyFile = false;

        // Helper function to handle file upload
        $processFile = function ($inputName, $folder, $oldFile = null) use ($request, &$uploadedAnyFile) {
            $file = $request->file($inputName)[0] ?? null;
            if ($file && $file->isValid()) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->move("assets/dokumen/{$folder}", $filename);
                $uploadedAnyFile = true; // mark as uploaded
                return $filename;
            }
            return $oldFile; // keep old if no new file
        };

        // Only replace if uploaded, else keep old
        $dokumenESP->dokumen1 = $processFile('dokumen1', 'sppb_1', $dokumenESP->dokumen1);
        $dokumenESP->dokumen1a = $processFile('dokumen1a', 'sppb_1a', $dokumenESP->dokumen1a);
        $dokumenESP->dokumen2 = $processFile('dokumen2', 'sppb_2', $dokumenESP->dokumen2);
        $dokumenESP->dokumen2a = $processFile('dokumen2a', 'sppb_2a', $dokumenESP->dokumen2a);
        $dokumenESP->dokumen3 = $processFile('dokumen3', 'sppb_3', $dokumenESP->dokumen3);
        $dokumenESP->dokumen4 = $processFile('dokumen4', 'sppb_4', $dokumenESP->dokumen4);

        $dokumenESP->save();

        if ($uploadedAnyFile) {
            return redirect()->route('penyelaras.muat-naik.SPBB')
                ->with('success', 'Fail SPBB telah berjaya dikemaskini.');
        } else {
            return redirect()->route('penyelaras.muat-naik.SPBB');
        }

    }

    //PENYALURAN - MAKLUMAT LEJAR
    public function maklumatLejar()
    {   
        $user = auth()->user();
        $institusiId = $user->id_institusi;
        
        // Get documents for the user's 'institusi_id' and 'no_rujukan' ending in '/2'
        $dokumen = DokumenESP::where('institusi_id', $institusiId)
            // ->where('no_rujukan', 'like', '%/2')
            ->orderByDesc('id')
            ->get();

        return view('spbb.penyelaras.maklumat_lejar', compact('institusiId','dokumen'));
    }

    //PENYALURAN - LEJAR - PERMOHONAN
    public function exportPermohonanLayak()
    {
        return Excel::download(new PermohonanLayak, 'senarai_permohonan__layak.xlsx');
    }

    public function uploadedFilePembayaranPermohonan(Request $request)
    {
        $request->validate([
            'modified_excel_file1' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('modified_excel_file1');

        // Use the Laravel Excel package to import data from the Excel file
        $import = new ModifiedPermohonanImport();
        $data = Excel::import($import, $file);

        // Process the imported data and update the permohonan records
        $this->updatePermohonanRecords($import->getModifiedData());
        
        // You may add a success message or redirect to a success page
        return redirect()->back()->with('success', 'Maklumat Lejar telah berjaya dikemaskini.');
    }

    private function updatePermohonanRecords($modifiedData)
    {
        foreach ($modifiedData as $modifiedRecord)
        {
            $noRujukan = $modifiedRecord['no_rujukan_permohonan'];
            $yuranDibayar = $modifiedRecord['yuran_dibayar'];
            $wangSakuDibayar = $modifiedRecord['wang_saku_dibayar'];
            $noBaucer = $modifiedRecord['no_baucer'];
            $perihal = $modifiedRecord['perihal'];
            $tarikhBaucer = $modifiedRecord['tarikh_baucer'];
            $statusPemohon = $modifiedRecord['status_pemohon'];

            // Retrieve the corresponding database record based on no_rujukan_permohonan
            $permohonan = Permohonan::where('no_rujukan_permohonan', $noRujukan)->first();

            //fetch max yuran dan wang saku
            $amaun_yuran = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Yuran')->first();
            $amaun_wang_saku = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();
            
            if ($permohonan) {
                // Update the retrieved database record with the modified data
                $permohonan->update([
                    'yuran_dibayar' => $yuranDibayar,
                    'wang_saku_dibayar' => $wangSakuDibayar,
                    'no_baucer' => $noBaucer,
                    'perihal' => $perihal,
                    'tarikh_baucer' => $tarikhBaucer,
                    'baki_dibayar' => $amaun_yuran->jumlah - $yuranDibayar - $wangSakuDibayar,
                    'status_pemohon' => $statusPemohon
                ]);
                // Optionally, you can log a success message
                Log::info("Record with no_rujukan_permohonan $noRujukan updated successfully.");
            } 
            else {
                // Optionally, log a message or handle the case where no matching record is found
                Log::warning("No record found for no_rujukan_permohonan $noRujukan.");
            }
        }
    }

    //PENYALURAN - LEJAR - TUNTUTAN
    public function exportTuntutanLayak()
    {
        
        return Excel::download(new TuntutanLayak, 'senarai_tuntutan__layak.xlsx');
    }

    public function uploadedFilePembayaranTuntutan(Request $request)
    {
        $request->validate([
            'modified_excel_file2' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('modified_excel_file2');

        // Use the Laravel Excel package to import data from the Excel file
        $import = new ModifiedTuntutanImport();
        $data = Excel::import($import, $file);

        // Process the imported data and update the tuntutan records
        $this->updateTuntutanRecords($import->getModifiedData());
        
        // You may add a success message or redirect to a success page
        return redirect()->back()->with('success', 'Fail telah berjaya dihantar.');
    }

    private function updateTuntutanRecords($modifiedData)
    {
        foreach ($modifiedData as $modifiedRecord)
        {
            $noRujukan = $modifiedRecord['no_rujukan_tuntutan'];
            $yuranDibayar = $modifiedRecord['yuran_dibayar'];
            $wangSakuDibayar = $modifiedRecord['wang_saku_dibayar'];
            $noBaucer = $modifiedRecord['no_baucer'];
            $perihal = $modifiedRecord['perihal'];
            $tarikhBaucer = $modifiedRecord['tarikh_baucer'];
            $statusPemohon = $modifiedRecord['status_pemohon'];

            // Retrieve the corresponding database record based on no_rujukan_tuntutan
            $tuntutan = Tuntutan::where('no_rujukan_tuntutan', $noRujukan)->first();

            //fetch max yuran dan wang saku
            $amaun_yuran = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Yuran')->first();
            $amaun_wang_saku = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();
            
            if ($tuntutan) {
                // Update the retrieved database record with the modified data
                $tuntutan->update([
                    'yuran_dibayar' => $yuranDibayar,
                    'wang_saku_dibayar' => $wangSakuDibayar,
                    'no_baucer' => $noBaucer,
                    'perihal' => $perihal,
                    'tarikh_baucer' => $tarikhBaucer,
                    'baki_dibayar' => $amaun_yuran->jumlah - $yuranDibayar - $wangSakuDibayar,
                    'status_pemohon' => $statusPemohon
                ]);
                // Optionally, you can log a success message
                Log::info("Record with no_rujukan_tuntutan $noRujukan updated successfully.");
            } 
            else {
                // Optionally, log a message or handle the case where no matching record is found
                Log::warning("No record found for no_rujukan_tuntutan $noRujukan.");
            }
        }
    }


    //KEMASKINI BANK
    public function maklumatBank()
    {   
        $user = auth()->user();
        $id = $user->id_institusi;
        $bank = MaklumatBank::where('institusi_id', $id)->first();
        $senarai_bank = SenaraiBank::all();

        // Check if a record exists, and if not, create a new one
        if (!$bank) {
            $bank = new MaklumatBank();
            $bank->institusi_id = $id;
            $bank->nama_akaun = ''; 
            $bank->no_akaun = '';  
        }

        return view('kemaskini.penyelaras.maklumat_bank', compact('user','bank','senarai_bank'));
    }

    public function kemaskiniMaklumatBank(Request $request, $id)
    {
        // Check the id of institusi for the respective user
        $user = auth()->user();

        // Check if a record with the specified institusi_id exists
        $bankExist = MaklumatBank::where('institusi_id', $id)->first();

        $rules = [
            'penyata' => $bankExist ? 'file|mimes:pdf,png|max:2048' : 'required|file|mimes:pdf,png|max:2048',
        ];

        $messages = [
            'penyata.required' => 'Sila pilih penyata bank.',
            'penyata.file' => 'Fail yang boleh dimuat naik mestilah format PDF atau PNG.',
            'penyata.mimes' => 'Fail yang boleh dimuat naik mestilah format PDF atau PNG.',
            'penyata.max' => 'Saiz fail tidak boleh melebihi 2 MB / 2048 KB.',
        ];

        // Validate the request
        $this->validate($request, $rules, $messages);

        // Handle file upload only if a new file is provided
        if ($request->hasFile('penyata')) {
            $file = $request->file('penyata');
            $fileName = uniqid() . '_' . $file->getClientOriginalName(); // Generate a unique filename

            // Move the uploaded file to the desired directory
            $file->move('assets/dokumen/penyata_bank_islam', $fileName);

            // If the record exists, update it; otherwise, create a new one
            if ($bankExist) {
                $bankExist->update([
                    'bank_id' => $request->input('kod_bank'),
                    'nama_akaun' => $request->input('nama_bank'),
                    'no_akaun' => $request->input('no_acc'),
                    'penyata_bank' => $fileName,
                ]);
            } else {
                // If the record doesn't exist, create a new one with the file
                MaklumatBank::create([
                    'institusi_id' => $id,
                    'bank_id' => $request->input('kod_bank'),
                    'nama_akaun' => $request->input('nama_bank'),
                    'no_akaun' => $request->input('no_acc'),
                    'penyata_bank' => $fileName,
                ]);
            }
        } else {
            // No new file uploaded, update other fields if necessary
            if ($bankExist) {
                $bankExist->update([
                    'bank_id' => $request->input('kod_bank'),
                    'nama_akaun' => $request->input('nama_bank'),
                    'no_akaun' => $request->input('no_acc'),
                ]);
            }
        }

        // Fetch the updated $bank data from the database
        $bank = MaklumatBank::where('institusi_id', $id)->first();

        // Pass senarai bank
        $senarai_bank = SenaraiBank::all();

        session()->flash('success', 'Maklumat bank telah berjaya dikemaskini.');
        return view('kemaskini.penyelaras.maklumat_bank', compact('bank', 'user','senarai_bank'));
    }

    //PENYALURAN - PEMBAYARAN
    public function senaraiPemohonLayak(Request $request)
    {
        $sesiBayaran = '';
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        if ($currentMonth == 6) {
            $sesiBayaran = '1/' . $currentYear;
        } elseif ($currentMonth == 8) {
            $sesiBayaran = '2/' . $currentYear;
        } elseif ($currentMonth == 10) {
            $sesiBayaran = '3/' . $currentYear;
        } else{
            $sesiBayaran = '4/' . $currentYear;
        }
        
        $user = auth()->user();
        $institusiId = $user->id_institusi;


        // $permohonanLayak = Permohonan::orderBy('id', 'desc')->where('permohonan.status', '=', '6')->where('permohonan.data_migrate', 'NULL')->get();
        $permohonanLayak = Permohonan::orderBy('id', 'desc')
                            ->where('status', '=', '6')
                            ->whereNull('data_migrate')
                            ->get();
        
        $tuntutanLayak = Tuntutan::orderBy('id', 'desc')
                            ->where('status', '=', '6')
                            ->whereNull('data_migrate')
                            ->get();


        // $tuntutanLayak = Tuntutan::orderBy('id', 'desc')->where('tuntutan.status', '=', '6')->where('tuntutan.data_migrate', 'NULL')->get();

        $permohonanBerhenti = Permohonan::orderBy('id', 'desc')->where('permohonan.sesi_bayaran', $sesiBayaran)
                                        ->where('permohonan.status', '=', '10');
        $tuntutanBerhenti = Tuntutan::orderBy('id', 'desc')->where('tuntutan.sesi_bayaran', $sesiBayaran)
                                        ->where('tuntutan.status', '=', '10');
        $permohonanDibayar = Permohonan::where('permohonan.sesi_bayaran', $sesiBayaran)
                                        ->where('permohonan.status', '=', '8')
                                        ->where(function($query) {
                                            $query->whereColumn('permohonan.yuran_dibayar', '!=', 'permohonan.yuran_disokong')
                                                ->orWhereColumn('permohonan.wang_saku_dibayar', '!=', 'permohonan.wang_saku_disokong');
                                        });
        $tuntutanDibayar = Tuntutan::where('tuntutan.sesi_bayaran', $sesiBayaran)
                                    ->where('tuntutan.status', '=', '8')
                                    ->where(function($query) {
                                        $query->whereColumn('tuntutan.yuran_dibayar', '!=', 'tuntutan.yuran_disokong')
                                            ->orWhereColumn('tuntutan.wang_saku_dibayar', '!=', 'tuntutan.wang_saku_disokong');
                                    });

        $kutipanBalik = $permohonanBerhenti->union($tuntutanBerhenti)->union($permohonanDibayar)->union($tuntutanDibayar)->get();

        return view('penyaluran.penyelaras.senarai_pembayaran', compact('permohonanLayak','tuntutanLayak','institusiId','kutipanBalik'));
    }

    // MODAL PENYALURAN - PERMOHONAN
    public function hantarInfoBaucerPermohonan(Request $request, $id)
    {
        //fetch max yuran dan wang saku
        $amaun_yuran = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Yuran')->first();
        $amaun_wang_saku = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();

        // Use $smoku_id to associate the data with a specific smoku_id
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        
        // Retrieve and process the form data from $request
        $existingRecord = Permohonan::where('id', $id)->first();

        if ($existingRecord) {
            // Update the respective row in permohonan table
            $existingRecord->yuran_dibayar = number_format($request->yuranDibayar, 2, '.', '');
            $existingRecord->wang_saku_dibayar = number_format($request->wangSakuDibayar, 2, '.', '');
            $existingRecord->baki_dibayar = $amaun_yuran->jumlah - $request->yuranDibayar - $request->wangSakuDibayar;
            $existingRecord->no_baucer = $request->noBaucer;
            $existingRecord->perihal = $request->perihal;
            $existingRecord->tarikh_baucer = $request->tarikhBaucer;
            $existingRecord->save();

            // Update permohonan table
            Permohonan::where('id', $id)->update([
                'status' => 8,
            ]);

            // Update sejarah_permohonan table
            $sejarah = new SejarahPermohonan([
                'smoku_id' => $smoku_id,
                'permohonan_id' => $id,
                'status' => 8,
            ]);
            $sejarah->save();
        }

        //filter for keputusan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $dibayar = Permohonan::orderBy('id', 'desc')
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->where('permohonan.status', '=', '8')->get();

        return redirect()->route('penyelaras.senarai.dibayar', compact('dibayar'));
    }

    //MODAL PENYALURAN - TUNTUTAN
    public function hantarInfoBaucerTuntutan(Request $request, $id)
    {
        //fetch max yuran dan wang saku
        $amaun_yuran = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Yuran')->first();
        $amaun_wang_saku = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();

        // Use $smoku_id to associate the data with a specific smoku_id
        $smoku_id = Tuntutan::where('id', $id)->value('smoku_id');
        
        // Retrieve and process the form data from $request
        $existingRecord = Tuntutan::where('id', $id)->first();

        if ($existingRecord) {
            // Update the respective row in tuntutan_kelulusan table
            $existingRecord->yuran_dibayar = number_format($request->yuranDibayar, 2, '.', '');
            $existingRecord->wang_saku_dibayar = number_format($request->wangSakuDibayar, 2, '.', '');
            $existingRecord->baki_dibayar = $amaun_yuran->jumlah - $request->yuranDibayar - $request->wangSakuDibayar;
            $existingRecord->no_baucer = $request->noBaucer;
            $existingRecord->perihal = $request->perihal;
            $existingRecord->tarikh_baucer = $request->tarikhBaucer;
            $existingRecord->save();

            // Update tuntutan table
            Tuntutan::where('id', $id)->update([
                'status' => 8,
            ]);

            // Update sejarah_tuntutan table
            $sejarah = new Sejarahtuntutan([
                'smoku_id' => $smoku_id,
                'tuntutan_id' => $id,
                'status' => 8,
            ]);
            $sejarah->save();
        }

        //filter for keputusan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $dibayar = Tuntutan::orderBy('id', 'desc')
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->where('tuntutan.status', '=', '8')->get();

        return redirect()->route('penyelaras.senarai.dibayar', compact('dibayar'));
    }

    //PENYALURAN - DIBAYAR
    public function senaraiPemohonDibayar(Request $request)
    {
        set_time_limit(1200);
        $permohonanDibayar = Permohonan::orderBy('id', 'desc')->where('permohonan.status', '=', '8')->get();
        $tuntutanDibayar = Tuntutan::orderBy('id', 'desc')->where('tuntutan.status', '=', '8')->get();

        return view('penyaluran.penyelaras.senarai_permohonan_dibayar', compact('permohonanDibayar','tuntutanDibayar'));
    }

    // Modal view maklumat baucer
    public function updateMaklumatBaucerPermohonan(Request $request, $permohonanId)
    {
        $permohonan = Permohonan::find($permohonanId);

        $permohonan->yuran_dibayar = $request->input('yuranDibayar');
        $permohonan->wang_saku_dibayar = $request->input('wangSakuDibayar');
        $permohonan->no_baucer = $request->input('noBaucer');
        $permohonan->perihal = $request->input('perihal');
        $permohonan->tarikh_baucer = $request->input('tarikhBaucer');

        $permohonan->save();

        session()->flash('success', 'Maklumat baucer telah berjaya dikemaskini.');

        return redirect('/penyelaras/penyaluran/permohonan-tuntutan/dibayar');
    }

    public function updateMaklumatBaucerTuntutan(Request $request, $tuntutanId)
    {
        $tuntutan = Tuntutan::find($tuntutanId);

        $tuntutan->yuran_dibayar = $request->input('yuranDibayar');
        $tuntutan->wang_saku_dibayar = $request->input('wangSakuDibayar');
        $tuntutan->no_baucer = $request->input('noBaucer');
        $tuntutan->perihal = $request->input('perihal');
        $tuntutan->tarikh_baucer = $request->input('tarikhBaucer');

        $tuntutan->save();

        session()->flash('success', 'Maklumat baucer telah berjaya dikemaskini.');

        return redirect('/penyelaras/penyaluran/permohonan-tuntutan/dibayar');
    }

    public function deleteItemTuntutan($id)
    {
        // $tuntutan = Tuntutan::orderBy('id', 'desc')->where('id',$id)->first();
        $tuntutan_item = TuntutanItem::where('id', $id)->first();

        if ($tuntutan_item) 
        {
            DB::table('tuntutan_item')->where('id',$tuntutan_item->id)->delete();
        } 
        
        return back();
    }

    public function deleteTuntutan($id)
    {
        $smoku_id = Smoku::where('id', $id)->first();
        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->first();

        if ($tuntutan) {

            DB::table('tuntutan')->where('id',$tuntutan->id)->delete(); //delete permohonan
            DB::table('tuntutan_item')->where('tuntutan_id',$tuntutan->id)->delete();
            DB::table('sejarah_tuntutan')->where('tuntutan_id',$tuntutan->id)->delete();
        } 
        
        return redirect()->route('bkoku.sejarah.tuntutan');
    }

    public function batalTuntutan($id)
    {
        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        $tuntutan_id = Tuntutan::orderBy('id', 'desc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->first();

        DB::table('tuntutan')->orderBy('id', 'asc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->where('id',$tuntutan_id->id)
            ->update([
                'status' => 9
            ]);

        SejarahTuntutan::create([
            'smoku_id' => $id,
            'tuntutan_id' => $tuntutan_id->id,
            'status' => 9
        ]);
           
        return redirect()->route('bkoku.sejarah.tuntutan')->with('permohonan', 'Tuntutan telah dibatalkan.');      
    }

    public function senaraiPelajarInstitusi()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt->id_induk == $infoipt->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        } else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection
        }

        $idInstitusiList = $infoiptCollection->pluck('id_institusi');

        $institusiPengajian = InfoIpt::whereIn('id_institusi', $idInstitusiList)->orderBy('nama_institusi')->get();

        return view('kemaskini.penyelaras.senarai_pelajar_institusi', compact('institusiPengajian'));
    }

    public function getSenaraiPelajarPenyelaras()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt->id_induk == $infoipt->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        } else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection
        }

        $idInstitusiList = $infoiptCollection->pluck('id_institusi');

        $pelajar = Smoku::whereHas('akademik', function ($query) use ($idInstitusiList) {
                $query->where('status', 1)
                    ->whereIn('id_institusi', $idInstitusiList);
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->with(['akademik' => function ($query) use ($idInstitusiList) {
                $query->where('status', 1)
                    ->whereIn('id_institusi', $idInstitusiList)
                    ->with('infoipt');
                },
                'permohonan' => function ($query) {
                    $query->where('program', 'BKOKU');
                }
            ])
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                $akademik = $item->akademik->first();
                return [
                    'id' => $item->id,
                    'smoku_id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'no_daftar_oku' => $item->no_daftar_oku,
                    'nama_kursus' => $akademik->nama_kursus ?? '-',
                    'nama_institusi' => $akademik->infoipt->nama_institusi ?? '-',
                    'tarikh_mula' => $akademik->tarikh_mula ?? '',
                    'tarikh_tamat' => $akademik->tarikh_tamat ?? '',
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now()),
                ];
            });
    


        return response()->json($pelajar);
    }


    public function profilPelajarInstitusi($smoku_id)
    {   
        $smoku = Smoku::leftJoin('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
            ->leftJoin('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
            ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
            ->where('smoku.id', $smoku_id)
            ->get(['smoku.*','smoku.id as smoku_id','bk_jenis_oku.*','bk_jantina.*','bk_keturunan.*'])
            ->first();
        $butiranPelajar = ButiranPelajar::where('smoku_id', $smoku->smoku_id)->first();
        
        $negeri = Negeri::all()->sortBy('id');
        $bandar = Bandar::all()->sortBy('id');
        $keturunan = Keturunan::all()->sortBy('id');
        $agama = Agama::all()->sortBy('id');
        $parlimen = Parlimen::all()->sortBy('id');
        $dun = Dun::all()->sortBy('id');
        $oku = JenisOku::all()->sortBy('id');

        $waris = Waris::where('smoku_id', $smoku->smoku_id)->first();
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');

        $akademik = Akademik::where('smoku_id', $smoku->smoku_id)->where('status', 1)->first();
        

        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');
        $institusi = InfoIpt::whereIn("id_institusi",$idInstitusiList)->orderby("nama_institusi","asc")->select('id_institusi','nama_institusi')->get();
        // dd($institusi);

        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kod_mod');
        $biaya = SumberBiaya::all()->sortBy('id');
        $penaja = Penaja::orderby("penaja","asc")->get();
        $penajaArray = $penaja->toArray();

        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->smoku_id)->first();
        $dokumen = Dokumen::where('permohonan_id', $permohonan->id)->get();

        return view('kemaskini.penyelaras.profil_pelajar_institusi',compact('smoku','butiranPelajar','negeri','keturunan','agama','bandar','parlimen','dun','oku','waris','hubungan','akademik','institusi','peringkat','kursus','mod','biaya','penaja','penajaArray','dokumen'));
    }

    public function peringkatProfilPelajar($ipt=0)
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

    public function kursusProfilPelajar($kodperingkat=0,$ipt=0)
    {

        $kursusData['data'] = Kursus::orderby("nama_kursus","asc")
            // ->select('id_institusi','kod_peringkat','nama_kursus')
            ->where('kod_peringkat',$kodperingkat)
            ->where('id_institusi',$ipt)
            ->get();

        return response()->json($kursusData);

    }

    public function simpanProfilPelajarInstitusi(Request $request, $smoku_id)
    {  
    
        $smoku = Smoku::where('id', $smoku_id)->first();
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
            'no_daftar_oku' => $smoku->no_daftar_oku,
            'kategori' => $smoku->kategori,
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
            'id_institusi' => $akademik->id_institusi,
            'no_pendaftaran_pelajar' => $akademik->no_pendaftaran_pelajar,
            'peringkat_pengajian' => $akademik->peringkat_pengajian,
            'nama_kursus' => $akademik->nama_kursus,
            'tempoh_pengajian' => $akademik->tempoh_pengajian,
            'bil_bulan_per_sem' => $akademik->bil_bulan_per_sem,
            'sesi' => $akademik->sesi,
            'mod' => $akademik->mod,
            'tarikh_mula' => $akademik->tarikh_mula,
            'tarikh_tamat' => $akademik->tarikh_tamat,
            'sumber_biaya' => $akademik->sumber_biaya,
            'sumber_lain' => $akademik->sumber_lain,
            'nama_penaja' => $akademik->nama_penaja,
            'penaja_lain' => $akademik->penaja_lain,
            'upload_akaunBank' => $dokumen1->dokumen ?? '',
            'nota_akaunBank' => $dokumen1->catatan ?? '',
            'upload_suratTawaran' => $dokumen2->dokumen ?? '',
            'nota_suratTawaran' => $dokumen2->catatan ?? ''
        ];
        

        // Update the values
        $smoku->update([
            'nama' => strtoupper($request->nama_pelajar),
            'email' => $request->emel,
            'no_daftar_oku' => $request->no_daftar_oku,
            'kategori' => $request->oku,
        ]);

        //Semak table user dah ada ic betul ke tak. kalau ada delete dulu
        if ($request->no_kp != $smoku->no_kp) {
            // Check if the new no_kp already exists in the users table
            $user_ada = User::where('no_kp', $request->no_kp)->get();

            if ($user_ada->isNotEmpty()) {
                // Delete all users with the new no_kp to prevent conflict
                User::where('no_kp', $request->no_kp)->delete();
            }

            // Now update the user with the old no_kp to the new one
            User::where('no_kp', $smoku->no_kp)
                ->update([
                    'nama' => strtoupper($request->nama_pelajar),
                    'no_kp' => $request->no_kp,
                    'email' => $request->emel ?? ''
                ]);
        } else {
            // no_kp not changed, just update name/email
            User::where('no_kp', $smoku->no_kp)
                ->update([
                    'nama' => strtoupper($request->nama_pelajar),
                    'email' => $request->emel ?? ''
                ]);
        }

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
                    'hubungan_waris' => $request->hubungan_waris,
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
                    'id_institusi' => $request->id_institusi,
                    'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
                    // 'peringkat_pengajian' => $request->peringkat_pengajian,
                    // 'nama_kursus' => $request->nama_kursus,
                    'tempoh_pengajian' => $request->tempoh_pengajian,
                    'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
                    'sesi' => $request->sesi,
                    'mod' => $request->mod,
                    'tarikh_mula' => $request->tarikh_mula,
                    'tarikh_tamat' => $request->tarikh_tamat,
                    'sumber_biaya' => $request->sumber_biaya,
                    'sumber_lain' => $request->sumber_lain,
                    'nama_penaja' => $request->nama_penaja,
                    'penaja_lain' => $request->penaja_lain,
                ]);
        }

        

        $runningNumber = rand(1000, 9999);
        $uploadPath = 'assets/dokumen/permohonan';

        $documentTypes = [
            'akaunBank' => 1,
            'suratTawaran' => 2,
            'invoisResit' => 3,
        ];

        foreach ($documentTypes as $inputName => $idDokumen) {
            $file = $request->file("upload_$inputName");
            // dd($file);

            // Define note field name dynamically
            $noteField = "nota_$inputName";
            $noteContent = $request->input($noteField);

            // Check if the document already exists
            $existingDocument = Dokumen::where('permohonan_id', $permohonan->id)
                ->where('id_dokumen', $idDokumen)
                ->first();

            if ($file) {
                // Generate new filename
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                $newFilename = $filenameWithoutExtension . '_' . $runningNumber . '.' . $extension;
                // dd($newFilename);
                // Move the file to the designated path
                $file->move($uploadPath, $newFilename);

                if ($existingDocument) {
                    // Optionally delete the old file
                    if (file_exists("$uploadPath/{$existingDocument->dokumen}")) {
                        unlink("$uploadPath/{$existingDocument->dokumen}");
                    }

                    // Update the existing document record
                    $existingDocument->dokumen = $newFilename;
                    $existingDocument->catatan = $noteContent;
                    $existingDocument->save();
                } else {
                    // Create a new document record
                    $data = new Dokumen();
                    $data->permohonan_id = $permohonan->id;
                    $data->id_dokumen = $idDokumen;
                    $data->dokumen = $newFilename;
                    $data->catatan = $noteContent;
                    $data->save();
                }
            } 
            // else if ($existingDocument) {
                
            //     // Update the existing document record
            //     $existingDocument->catatan = $noteContent;
            //     $existingDocument->save();
                
            // }
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
            'no_daftar_oku' => $request->no_daftar_oku,
            'kategori' => $request->oku,
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
            'id_institusi' => $request->id_institusi,
            'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
            'peringkat_pengajian' => $request->peringkat_pengajian,
            'nama_kursus' => $request->nama_kursus,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
            'sesi' => $request->sesi,
            'mod' => $request->mod,
            'tarikh_mula' => $request->tarikh_mula,
            'tarikh_tamat' => $request->tarikh_tamat,
            'sumber_biaya' => $request->sumber_biaya,
            'sumber_lain' => $request->sumber_lain,
            'nama_penaja' => $request->nama_penaja,
            'penaja_lain' => $request->penaja_lain,
            'dokumen' => $dokumen1->dokumen ?? '',
            'catatan' => $request->input("nota_akaunBank"),
            'dokumen' => $dokumen2->dokumen ?? '',
            'catatan' => $request->input("nota_suratTawaran")
        ];

        
        if ($currentValues != $updatedValues) {    
            $permohonans = Permohonan::where('smoku_id', $smoku->id)->get();

            // Update no_kp in smoku first
            if ($request->no_kp != $smoku->no_kp) {
                //semak dalam smoku no_kp
                $smoku_ada = Smoku::where('no_kp', $request->no_kp)->get();
                
                if ($smoku_ada->isNotEmpty()) {
                    // Delete all matching entries
                    Smoku::where('no_kp', $request->no_kp)->delete();

                }
                Smoku::where('id', $smoku->id)
                    ->update(['no_kp' => $request->no_kp]);
            }

            // Update akademik
            if ($request->peringkat_pengajian != $akademik->peringkat_pengajian) {
                if ($permohonans->firstWhere('status', '<', 6)) {
                    Akademik::where('smoku_id', $smoku->id)
                        ->where('status', 1)
                        ->update([
                            'peringkat_pengajian' => $request->peringkat_pengajian,
                            'nama_kursus' => $request->nama_kursus,
                        ]);
                } else {
                    return back()->with('failed', 'Maklumat peringkat pengajian tidak boleh dikemaskini.');
                }
            } else {
                // peringkat unchanged, only update course name
                Akademik::where('smoku_id', $smoku->id)
                    ->where('status', 1)
                    ->update([
                        'nama_kursus' => $request->nama_kursus,
                    ]);
            }

            // Loop through permohonan to update only the matching one
            foreach ($permohonans as $permohonan) {
                $parts = explode('/', $permohonan->no_rujukan_permohonan);

                if (count($parts) === 3) {
                    $updateRujukan = false;

                    // If old peringkat matches akademik before update
                    if ($parts[1] == $akademik->peringkat_pengajian) {

                        // Update peringkat part in rujukan if it changed
                        if ($request->peringkat_pengajian != $akademik->peringkat_pengajian) {
                            $parts[1] = $request->peringkat_pengajian;
                            $updateRujukan = true;
                        }

                    }

                    // Update no_kp part in rujukan if it changed
                    if ($request->no_kp != $smoku->no_kp) {
                        $parts[2] = $request->no_kp;
                        $updateRujukan = true;
                    }

                    if ($updateRujukan) {
                        $new_no_rujukan = implode('/', $parts);
                        $permohonan->update([
                            'no_rujukan_permohonan' => $new_no_rujukan,
                        ]);
                    }
                }
            }

            $tuntutans = Tuntutan::where('smoku_id', $smoku->id)->get();

            foreach ($tuntutans as $tuntutan) {
                $parts = explode('/', $tuntutan->no_rujukan_tuntutan);

                if (count($parts) === 4) { // Ensure it's in format B/peringkat/no_kp/n
                    $updateRujukan = false;

                    // Match only tuntutan with peringkat same as request
                    if ($parts[1] == $request->peringkat_pengajian) {

                        // Update peringkat_pengajian
                        if ($request->peringkat_pengajian != $akademik->peringkat_pengajian) {
                            if ($permohonan && $permohonan->status < 6) {
                                $parts[1] = $request->peringkat_pengajian;
                                $updateRujukan = true;
                            } else {
                                return back()->with('failed', 'Maklumat peringkat pengajian tidak boleh dikemaskini.');
                            }
                        }
                    
                    }

                    // Update no_kp
                    if ($request->no_kp != $smoku->no_kp) {
                        $parts[2] = $request->no_kp;
                        $updateRujukan = true;
                    }

                    // Apply update if needed
                    if ($updateRujukan) {
                        $new_no_rujukan_tuntutan = implode('/', $parts);
                        $tuntutan->update([
                            'no_rujukan_tuntutan' => $new_no_rujukan_tuntutan,
                        ]);
                    }
                }
            }

            //update mod or sumber biaya = layak yuran or wang saku sahaja
            if ($request->sumber_biaya != $akademik->sumber_biaya || $request->mod != $akademik->mod) {
                if ($permohonan) {
                    $mod = $request->mod;
                    // dd($mod);
                    $sumber = $request->sumber_biaya;
                    //  dd($sumber);

                    $yuran = null;
                    $wang_saku = null;

                    $mod1 = 1;
                    $mod2 = 2;
                    $mod34 = [3, 4];
                    $sumber_layak = [3, 4, 5];
                    $sumber_tidak = [1, 2];

                    

                    if ($mod == $mod1 && in_array($sumber, $sumber_layak)) {
                        // dd('sini');
                        $yuran = 1;
                        $wang_saku = 1;
                    } elseif ($mod == $mod1 && in_array($sumber, $sumber_tidak)) {
                        // dd('sini ke');
                        $yuran = null;
                        $wang_saku = 1;
                    } elseif ($mod == $mod2 && in_array($sumber, $sumber_layak)) {
                        // dd('ke sini');
                        $yuran = 1;
                        $wang_saku = null;
                    } elseif ($mod == $mod2 && in_array($sumber, $sumber_tidak)) {
                        // dd('atau sini');
                        $yuran = null;
                        $wang_saku = null;
                    } elseif (in_array($mod, $mod34) && in_array($sumber, $sumber_layak)) {
                        // dd('sini eh');
                        $yuran = 1;
                        $wang_saku = null;
                    }

                    // dd($yuran);
                    // dd($wang_saku);
                    Permohonan::where('smoku_id', $smoku->id)
                        ->update([
                            'yuran' => $yuran,
                            'wang_saku' => $wang_saku,
                        ]);
                }
            }


            return back()->with('success', 'Maklumat profil berjaya dikemaskini.');

            
        }

        // No updates were made
        return back();
    }

    public function senaraiPelajar()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        // else if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi) {
        //     $infoiptCollection = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        // } 
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');

        $pelajar = Smoku::join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        // ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->join('users','users.no_kp','=','smoku.no_kp')
        ->leftJoin('tukar_institusi', 'tukar_institusi.smoku_id', '=', 'smoku.id')
        ->where(function ($query) use ($idInstitusiList) {
            $query->whereIn('smoku_akademik.id_institusi', $idInstitusiList)
                  ->orWhere(function ($subQuery) use ($idInstitusiList) {
                      $subQuery->whereIn('tukar_institusi.id_institusi_baru', $idInstitusiList)
                               ->where('tukar_institusi.status', '=', 1);
                  });
        })
        ->orderBy('smoku.id', 'DESC')
        ->get(['smoku.*','tukar_institusi.*','smoku.id as smoku_id','smoku_akademik.*', 'bk_info_institusi.id_institusi', 'bk_info_institusi.nama_institusi', 'bk_info_institusi.jenis_institusi','users.created_at as tarikh_daftar']);

        $infoipt = InfoIpt::where('jenis_institusi', 'UA')->orderBy('nama_institusi')->get();
        $infoiptIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $infoiptP = InfoIpt::where('jenis_institusi', 'P')->orderBy('nama_institusi')->get();
        $infoiptKK = InfoIpt::where('jenis_institusi', 'KK')->orderBy('nama_institusi')->get();

        return view('kemaskini.penyelaras.senarai_pelajar', compact('pelajar','infoipt','infoiptIPTS','infoiptP','infoiptKK'));
    }

    public function tukarInstitusi(Request $request, $id)
    {
        $tukar_institusi = TukarInstitusi::updateOrCreate(['smoku_id' => $id]);

        $tukar_institusi->smoku_id = $id;
        $tukar_institusi->id_institusi = $request->input('id_institusi_asal');
        $tukar_institusi->id_institusi_baru = $request->input('id_institusi');
        $tukar_institusi->status = 0;

        $tukar_institusi->save();

        // Redirect to the original page
        return redirect()->back()->with('success', 'Permohonan tukar institusi berjaya dihantar untuk semakan Sekretariat BKOKU KPT.');
    }

    public function terimaPelajar(Request $request, $id)
    {
        Akademik::updateOrCreate(['smoku_id' => $id, 'status' => 1],
        [
            'id_institusi' => $request->id_baru,
            'nama_kursus' => NULL,
            'mod' => NULL,
            'tempoh_pengajian' => NULL,
            'bil_bulan_per_sem' => NULL,
            'sesi' => NULL,
            'no_pendaftaran_pelajar' => NULL,
            'tarikh_mula' => NULL,
            'tarikh_tamat' => NULL,
            'sem_semasa' => NULL,
            'sumber_biaya' => NULL,
            'sumber_lain' => NULL,
            'nama_penaja' => NULL,
            'penaja_lain' => NULL,
        ]);

        DB::table('smoku_penyelaras')
        ->updateOrInsert(
            ['smoku_id' => $id],
            [
                'penyelaras_id' => Auth::user()->id,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $permohonan = Permohonan::where('smoku_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        if ($permohonan) {
            $permohonan->update([
                'perakuan' => NULL,
                'status' => '1',
            ]);
        }

        // Redirect to the original page
        return redirect()->back()->with('success', 'Tukar institusi berjaya.');
    }

    public function senaraiSuratTawaranBKOKU()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        // else if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi) {
        //     $infoiptCollection = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        // } 
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');

        $institusiPengajian = InfoIpt::orderBy('nama_institusi')->whereIn('id_institusi', $idInstitusiList)->get();
        
        return view('kemaskini.penyelaras.senarai_surat_tawaran', compact('institusiPengajian'));


    }

    public function getSenaraiLayakBKOKU()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');
        
        $pelajar = Smoku::whereHas('akademik', function ($query)  use ($idInstitusiList) {
                $query->where('status', 1)
                      ->whereIn('id_institusi', $idInstitusiList);
            })
            ->whereHas('permohonan', function ($query) {
                $query->whereIn('status', [6, 8]);
            })
            ->with(['akademik' => function ($query) use ($idInstitusiList) {
                $query->where('status', 1)->whereIn('id_institusi', $idInstitusiList)->with(['infoipt', 'peringkat']);
                 },
            'permohonan'])
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                // Ambil hanya satu rekod akademik yang status=1
                $akademik = $item->akademik->first();
                // Ambil hanya satu rekod permohonan latest
                $permohonan = $item->permohonan->whereIn('status', [6, 8])->first();
                return [
                    'id' => $item->id,
                    'smoku_id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'peringkat_pengajian' => ucfirst(strtolower($akademik->peringkat->peringkat)) ?? '-',
                    'nama_kursus' => $akademik->nama_kursus ?? '-',
                    'nama_institusi' => $akademik->infoipt->nama_institusi ?? '-',
                    'tarikh_mula' => $akademik->tarikh_mula ?? '',
                    'tarikh_tamat' => $akademik->tarikh_tamat ?? '',
                    'permohonan_id' => $permohonan->id ?? '',
                    'program' => $permohonan->program ?? '',
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now())
                ];
            });

        return response()->json($pelajar);



    }

}
