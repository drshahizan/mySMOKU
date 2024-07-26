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
use App\Models\JumlahTuntutan;
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
            $kod_oku = JenisOku::where('kecacatan',$kategori)->first();

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
                    'kategori' => $kod_oku->kod_oku,
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
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
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
        // $layak = Smoku::join('permohonan','permohonan.smoku_id','=','smoku.id')
        // ->join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        // ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        // ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        // ->leftjoin('tuntutan','tuntutan.permohonan_id','=','permohonan.id')
        // ->where('penyelaras_id','=', Auth::user()->id)
        // ->where('permohonan.status', 8) 
        // ->orderBy('permohonan.tarikh_hantar', 'DESC')
        // ->get(['smoku.*', 'permohonan.id as permohonan_id', 'permohonan.no_rujukan_permohonan', 'tuntutan.status as tuntutan_status','smoku_akademik.*', 'bk_info_institusi.nama_institusi']);
        
        $layak = Smoku::join('permohonan','permohonan.smoku_id','=','smoku.id')
        ->join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->leftjoin('tuntutan','tuntutan.permohonan_id','=','permohonan.id')
        ->where('penyelaras_id','=', Auth::user()->id)
        ->where('permohonan.status', 8) 
        ->orderBy('permohonan.tarikh_hantar', 'DESC')
        ->select('smoku.*', 'permohonan.id as permohonan_id', 'permohonan.no_rujukan_permohonan', 'permohonan.tarikh_hantar', 'tuntutan.status as tuntutan_status','smoku_akademik.*', 'bk_info_institusi.nama_institusi')
        ->distinct() // Add distinct here
        ->get();



        return view('tuntutan.penyelaras_bkoku.tuntutan_baharu', compact('layak'));
    }

    public function kemaskiniKeputusan($id)
    {   
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $smoku_id = $id;

        $akademik = Akademik::where('smoku_id',$id)
            ->where('smoku_akademik.status', 1)
            ->first();
        
            // $semSemasa = $akademik->sem_semasa;
            $semSemasa = 1;
            // $sesiSemasa = $akademik->sesi;

            if($akademik->bil_bulan_per_sem == 6){
                $bilSem = 2;
            } else {
                $bilSem = 3;
            }
            $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
            $currentYear = date('Y');

            $currentDate = Carbon::now();
            $tarikhMula = Carbon::parse($akademik->tarikh_mula);
            $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);
            $sesiMula = $tarikhMula->format('Y') . '/' . ($tarikhMula->format('Y') + 1);

            $tarikhNextSem = clone $tarikhMula; // Clone to avoid modifying the original date
            $nextSemesterDates = [];
            $firstIteration = true;

            while ($tarikhNextSem < $tarikhTamat) 
            {
                $nextSemesterDates[] = [
                    'date' => $tarikhNextSem->format('Y-m-d'),
                    'semester' => $semSemasa,
                    'sesi' => $sesiMula,
                ];

                $semSemasa++;
                $awal = $tarikhNextSem->format('Y');
                
                $akhir = $tarikhNextSem->format('Y') + 1;
                
                $sesiMula = $awal . '/' . $akhir;

                $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));
            }
           
            $currentSesi = null; // Initialize a variable to store the current session
            $previousSesi = null; // Initialize a variable to store the previous session
            $semSemasa = null; // Initialize a variable to store the current semester
            $sesiSemasa = null; // Initialize a variable to store the current session

            foreach ($nextSemesterDates as $key => $data) 
            {
                $dateOfSemester = \Carbon\Carbon::parse($data['date']);
                
                // Set the end date to be just before the start of the next semester
                $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) ? \Carbon\Carbon::parse($nextSemesterDates[$key + 1]['date']) : null;
                $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());
                
                // Check if the current date is within the range of the semester
                if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                    $currentSesi = $data['sesi'];
                    // $semSemasa = $data['semester'];
                    $semSemasa = $data['semester'] - 1;
                    // $sesiSemasa = $data['sesi'];
                    $sesiSemasa = isset($nextSemesterDates[$key - 1]) ? $nextSemesterDates[$key - 1]['sesi'] : null;
                }
            }

            if ($semSemasa === 0 ) {
                return back()->with('sem', 'Semester semasa belum tamat.');
            }

        if ($permohonan) 
        {
            $peperiksaan = Peperiksaan::where('permohonan_id', $permohonan->id)->get();
            $result = Peperiksaan::where('permohonan_id', $permohonan->id)
									->where('sesi', $sesiSemasa)
									->where('semester', $semSemasa)
									->first();

            return view('tuntutan.penyelaras_bkoku.kemaskini_keputusan_peperiksaan', compact('peperiksaan','smoku_id','permohonan','sesiSemasa','semSemasa','result'));
        } 
        else 
        {
            return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
    }

    public function hantarKeputusanPeperiksaan(Request $request, $id)
    {
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();

        //simpan dalam table peperiksaan
        $kepPeperiksaan=$request->kepPeperiksaan;
        $counter = 1; 

        // Check if files were uploaded
        if (!empty($kepPeperiksaan)) {

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
        else {
            return redirect()->back()->with('error', 'No files uploaded.');
        }
    }

    public function tuntutanBaharu($id)
    {   
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();

        $smoku_id = $id;
        $akademik = Akademik::where('smoku_id',$id)
            ->where('smoku_akademik.status', 1)
            ->first();

        $maxLimit = DB::table('bk_jumlah_tuntutan')
        ->where('program','BKOKU')
        ->where('jenis', 'Yuran')
        ->first();	
        $limitWangSaku = DB::table('bk_jumlah_tuntutan')
        ->where('program','BKOKU')
        ->where('jenis', 'Wang Saku')
        ->first();	    

        if ($permohonan && $permohonan->status ==8) {  

            $tuntutan = Tuntutan::where('smoku_id', $id)
                ->where('permohonan_id', $permohonan->id)
                ->orderBy('tuntutan.id', 'desc')
                ->first(['tuntutan.*']);

            // $semSemasa = $akademik->sem_semasa;
            $semSemasa = 1;
            // $sesiSemasa = $akademik->sesi;

            if($akademik->bil_bulan_per_sem == 6){
                $bilSem = 2;
            } else {
                $bilSem = 3;
            }
            $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
            $currentYear = date('Y');

            $currentDate = Carbon::now();
            $tarikhMula = Carbon::parse($akademik->tarikh_mula);
            $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);
            $sesiMula = $tarikhMula->format('Y') . '/' . ($tarikhMula->format('Y') + 1);

            $tarikhNextSem = clone $tarikhMula; // Clone to avoid modifying the original date
            $nextSemesterDates = [];
            $firstIteration = true;

            while ($tarikhNextSem < $tarikhTamat) 
            {
                $nextSemesterDates[] = [
                    'date' => $tarikhNextSem->format('Y-m-d'),
                    'semester' => $semSemasa,
                    'sesi' => $sesiMula,
                ];

                $semSemasa++;
                
                $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));
                $awal = $tarikhNextSem->format('Y');
                
                $akhir = $tarikhNextSem->format('Y') + 1;
                
                $sesiMula = $awal . '/' . $akhir;
            }
           

            $currentSesi = null; // Initialize a variable to store the current session
            $previousSesi = null; // Initialize a variable to store the previous session
            $semSemasa = null; // Initialize a variable to store the current semester
            $sesiSemasa = null; // Initialize a variable to store the current session

            foreach ($nextSemesterDates as $key => $data) {
                // echo 'Date: ' . $data['date'] . ', Semester: ' . $data['semester'] . ', Sesi: ' . $data['sesi'] . '<br>';

                $dateOfSemester = \Carbon\Carbon::parse($data['date']);
                
                // Set the end date to be just before the start of the next semester
                $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) ? \Carbon\Carbon::parse($nextSemesterDates[$key + 1]['date']) : null;
                // $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : $dateOfSemester->endOfDay();
                $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());

                // Check if the current date is within the range of the semester
                if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                    $currentSesi = $data['sesi'];
                    $semSemasa = $data['semester'];
                    $semLepas = $data['semester'] - 1;
                    $sesiSemasa = $data['sesi'];
                    $previousSesi = isset($nextSemesterDates[$key - 1]) ? $nextSemesterDates[$key - 1]['sesi'] : null;
                }

            }

            // Output the results
            // echo 'Current Session: ' . $currentSesi . PHP_EOL;
            // echo 'Previous Session: ' . $previousSesi . PHP_EOL;
            // echo 'Current Semester: ' . $semSemasa . PHP_EOL;
            // echo 'Current Session: ' . $sesiSemasa . PHP_EOL;
            // dd($sesiSemasa);

            if ($semLepas != 0 ) {
                if($semSemasa != $semLepas){
                    // semak dah upload result ke belum
                    $result = Peperiksaan::where('permohonan_id', $permohonan->id)
                    ->where('semester', $semLepas)
                    ->first();
                    if($result == null){
                        if(($semSemasa == $semLepas || $semSemasa == $akademik->sem_semasa) && $permohonan->yuran == null && $permohonan->wang_saku == '1'){
                            return back()->with('sem', 'Wang saku boleh dituntut pada sem seterusnya.');
                        }
                        return redirect()->route('bkoku.kemaskini.keputusan', ['id' => $id])->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                    }
                }
            }

            if(($semSemasa == $semLepas || $semSemasa == $akademik->sem_semasa) && $permohonan->yuran == null && $permohonan->wang_saku == '1'){
                return back()->with('sem', 'Wang saku boleh dituntut pada sem seterusnya.');
            }
       
            if (($currentSesi === $previousSesi) || $previousSesi === null) {
                
                if (!$tuntutan) {
                    $wang_saku = 0.00;
                    //nak tahu baki sesi semasa permohonan lepas
                    $baki_total = $permohonan->baki_dibayar;
                }
                else{
                    $ada = DB::table('tuntutan')
                        ->where('permohonan_id', $tuntutan->permohonan_id)
                        ->orderBy('id', 'desc')
                        ->first();
                    
                    $jumlah_tuntut = DB::table('tuntutan')
                        ->where('permohonan_id', $tuntutan->permohonan_id)
                        ->where('status','!=', 9)
                        ->get();
                    $sum = $jumlah_tuntut->sum('jumlah');	
                    $baki_total = $permohonan->baki_dibayar - $sum;	
                }	
            }
            else {
                if ($permohonan->yuran == null && $permohonan->wang_saku == '1') {
                    if($semSemasa != $semLepas && $semSemasa != $akademik->sem_semasa){
                        $baki_total = $limitWangSaku->jumlah * $akademik->bil_bulan_per_sem; 
                    }
                    else {
                        $baki_total = '0'; 
                    }
                }
                else {
                    $baki_total = $maxLimit->jumlah;
                }
            }
            
            
            if ($tuntutan && ($tuntutan->status == 1 || $tuntutan->status == 5)) 
            {
                $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->get();
            } 
            else if ($tuntutan && $tuntutan->status != 8 && $tuntutan->status != 9)
            {
                return back()->with('sem', 'Tuntutan pelajar masih dalam semakan.');
            }
            else 
            {
                $tuntutan_item = collect(); // An empty collection
            }

            return view('tuntutan.penyelaras_bkoku.borang_tuntutan', compact('permohonan','tuntutan','tuntutan_item','akademik','smoku_id','sesiSemasa','semSemasa','baki_total'));
            
        } 
        else if ($permohonan && $permohonan->status !=8) {

            return redirect()->route('dashboard')->with('permohonan', 'Permohonan pelajar masih dalam semakan.');
        } 
        else {

            return redirect()->route('dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
        
    }

    public function simpanTuntutan(Request $request, $id)
    {   
        $permohonan = Permohonan::all()->where('smoku_id', '=', $id)->first();
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id', '=', $id)->first();

        if(!$tuntutan || $tuntutan->status == 8 || $tuntutan->status == 9){
            
            $biltuntutan = Tuntutan::where('smoku_id', '=', $id)
                ->groupBy('no_rujukan_tuntutan')
                ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
                ->get();
            $bil = $biltuntutan->count();

            $running_num =  $bil + 1; //sebab nak guna satu id je  
            $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num; // try duluuu  

        } 
        else {
            $no_rujukan_tuntutan = $tuntutan->no_rujukan_tuntutan;
        }

        //simpan dalam table tuntutan
        $tuntutan = Tuntutan::where('smoku_id', '=', $id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->where('sesi', '=', $request->sesi)
            ->where('semester', '=', $request->semester)
            ->where('no_rujukan_tuntutan', '=', $no_rujukan_tuntutan)
            ->first();

        if (!$tuntutan) {
            $tuntutan = Tuntutan::create([
                'smoku_id' => $id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,    
                'yuran' => '1',
                'status' => '1',
            ]);
            $tuntutan->save();
        }

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
        $sejarahtuntutan = SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)->first();
        if ($sejarahtuntutan === null) {
            $sejarahtuntutan = SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $id,
                'status' => '1',
        
            ]);
        }
        else{

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
        $permohonan = Permohonan::orderBy('id', 'DESC')
        ->where('smoku_id', '=', $id)->first();

        //update dalam table tuntutan
        $tuntutan = Tuntutan::where('smoku_id', '=', $id)->orderBy('id', 'desc')->first();
        if ($tuntutan != null) {
            $tuntutan->update([
                'wang_saku' => $request->wang_saku,
                'amaun_wang_saku' => $request->amaun_wang_saku,
                'jumlah' => $request->jumlah,
                'tarikh_hantar' => now()->format('Y-m-d'),
                'status' => '2',
            ]);

            $tuntutan->save();
        }
        

        $sejarah = SejarahTuntutan::create([
            'tuntutan_id' => $tuntutan->id,
            'smoku_id' => $id,
            'status' => '2',
    
        ]);
        $sejarah->save();

        // COMMENT PROD
        //emel kepada pelajar
        $emel_pelajar = Smoku::where('id',$id)->first();
        $cc_pelajar = $emel_pelajar->email;

        //emel kepada penyelaras
        $user = User::where('no_kp',Auth::user()->no_kp)->first();

        $catatan = "testing";
        $emel = EmelKemaskini::where('emel_id',14)->first();
    
        Mail::to($user->email)->cc($cc_pelajar)->send(new TuntutanHantar($catatan,$emel));
        
        return redirect()->route('senarai.bkoku.tuntutanBaharu')->with('message', 'Tuntutan pelajar telah di hantar.');
    }

    public function sejarahTuntutan()
    {
        $tuntutan = Tuntutan::join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tuntutan.smoku_id')
        // join('smoku_penyelaras', 'smoku_penyelaras.smoku_id', '=', 'tuntutan.smoku_id')
        // ->where('smoku_penyelaras.penyelaras_id', '=', Auth::user()->id)
        ->where('smoku_akademik.id_institusi', '=', Auth::user()->id_institusi)
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
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.penyelaras_bkoku.papar_saringan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }

    public function sejarahPermohonan()
    {
        $permohonan = Permohonan::join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
        // ->join('smoku_penyelaras', 'smoku_penyelaras.smoku_id', '=', 'permohonan.smoku_id')
        // ->where('smoku_penyelaras.penyelaras_id', '=', Auth::user()->id)
        ->where('smoku_akademik.id_institusi', '=', Auth::user()->id_institusi)
        ->select('permohonan.*')
        ->orderBy('permohonan.tarikh_hantar', 'DESC')
        ->get();

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
        $dokumen = DokumenESP::where('institusi_id', $institusiId)
            ->where('no_rujukan', 'like', '%/1')
            ->orderBy('created_at', 'desc')
            ->get(); 
        
        return view('spbb.penyelaras.muat_turun_dokumen', compact('dokumen','institusiId'));
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
            ->where('no_rujukan', 'like', '%/2')
            ->get();

        return view('spbb.penyelaras.muat_naik_dokumen', compact('institusiId','dokumen'));
    }

    public function hantarBorangSPBB(Request $request)
    {
        $user = auth()->user();
        $institusiId = $user->id_institusi;
        $existRecord = DokumenESP::where('institusi_id', $institusiId)->first();
        $currentYear = Carbon::now()->year;

        $dokumen1 = $request->file('dokumen1');
        $dokumen1a = $request->file('dokumen1a');
        $dokumen2 = $request->file('dokumen2');
        $dokumen2a = $request->file('dokumen2a');
        $dokumen3 = $request->file('dokumen3');
        $dokumen4 = $request->file('dokumen4');
        $uploadedDokumen1 = [];
        $uploadedDokumen1a = [];
        $uploadedDokumen2 = [];
        $uploadedDokumen2a = [];
        $uploadedDokumen3 = [];
        $uploadedDokumen4 = [];

        // Validation rules for each document column
        $rules = [
            'dokumen1.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:2048',
            'dokumen1a.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:2048',
            'dokumen2.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:2048',
            'dokumen2a.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:2048',
            'dokumen3.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:2048',
            'dokumen4.*' => 'sometimes|nullable|mimes:pdf,xls,xlsx|max:2048',
        ];

        // Custom error messages
        $customMessages = [
            'mimes' => 'Format fail bagi :attribute mestilah pdf, xls, atau xlsx sahaja.',
            'max' => 'Saiz maksimum bagi :attribute adalah 2 MB.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($dokumen1 || $dokumen1a || $dokumen2 || $dokumen2a || $dokumen3 || $dokumen4) {
            // Check and process dokumen1
            $file1 = $dokumen1[0] ?? null;
            if ($file1 && $file1->isValid()) {
                $uniqueFilenameDokumen1 = uniqid() . '_' . $file1->getClientOriginalName();
                $file1->move('assets/dokumen/sppb_1', $uniqueFilenameDokumen1);
                $uploadedDokumen1[] = $uniqueFilenameDokumen1;
            }

            // Check and process dokumen1a
            $file1a = $dokumen1a[0] ?? null;
            if ($file1a && $file1a->isValid()) {
                $uniqueFilenameDokumen1a = uniqid() . '_' . $file1a->getClientOriginalName();
                $file1a->move('assets/dokumen/sppb_1a', $uniqueFilenameDokumen1a);
                $uploadedDokumen1a[] = $uniqueFilenameDokumen1a;
            }
            
            // Check and process dokumen2
            $file2 = $dokumen2[0] ?? null;
            if ($file2 && $file2->isValid()) {
                $uniqueFilenameDokumen2 = uniqid() . '_' . $file2->getClientOriginalName();
                $file2->move('assets/dokumen/sppb_2', $uniqueFilenameDokumen2);
                $uploadedDokumen2[] = $uniqueFilenameDokumen2;
            }

            // Check and process dokumen2a
            $file2a = $dokumen2a[0] ?? null;
            if ($file2a && $file2a->isValid()) {
                $uniqueFilenameDokumen2a = uniqid() . '_' . $file2a->getClientOriginalName();
                $file2a->move('assets/dokumen/sppb_2a', $uniqueFilenameDokumen2a);
                $uploadedDokumen2a[] = $uniqueFilenameDokumen2a;
            }

            // Check and process dokumen3
            $file3 = $dokumen3[0] ?? null;
            if ($file3 && $file3->isValid()) {
                $uniqueFilenameDokumen3 = uniqid() . '_' . $file3->getClientOriginalName();
                $file3->move('assets/dokumen/sppb_3', $uniqueFilenameDokumen3);
                $uploadedDokumen3[] = $uniqueFilenameDokumen3;
            }

            // Check and process dokumen4
            $file4 = $dokumen4[0] ?? null;
            if ($file4 && $file4->isValid()) {
                $uniqueFilenameDokumen4 = uniqid() . '_' . $file4->getClientOriginalName();
                $file4->move('assets/dokumen/sppb_4', $uniqueFilenameDokumen4);
                $uploadedDokumen4[] = $uniqueFilenameDokumen4;
            }

            // Update or create the record in the database after processing all files
            if ($existRecord) {
                $existRecord->update([
                    'user_id' => $user->id,
                    'institusi_id' => $institusiId,
                    'no_rujukan' => "{$institusiId}/{$currentYear}/2",
                    'dokumen1' => $uploadedDokumen1[0] ?? null,
                    'dokumen1a' => $uploadedDokumen1a[0] ?? null,
                    'dokumen2' => $uploadedDokumen2[0] ?? null,
                    'dokumen2a' => $uploadedDokumen2a[0] ?? null,
                    'dokumen3' => $uploadedDokumen3[0] ?? null,
                    'dokumen4' => $uploadedDokumen4[0] ?? null,
                ]);
            } else {
                $dokumenESP = new DokumenESP();
                $dokumenESP->user_id = auth()->user()->id;
                $dokumenESP->institusi_id = $institusiId;
                $dokumenESP->no_rujukan = "{$institusiId}/{$currentYear}/2";
                $dokumenESP->dokumen1 = $uploadedDokumen1[0] ?? null;
                $dokumenESP->dokumen1a = $uploadedDokumen1a[0] ?? null;
                $dokumenESP->dokumen2 = $uploadedDokumen2[0]  ?? null;
                $dokumenESP->dokumen2a = $uploadedDokumen2a[0] ?? null;
                $dokumenESP->dokumen3 = $uploadedDokumen3[0]  ?? null;
                $dokumenESP->dokumen4 = $uploadedDokumen4[0]  ?? null;
                $dokumenESP->save();
            }
        }

        // Store the uploaded file names in the session for display in your view
        return redirect()->route('penyelaras.muat-naik.SPBB')->with('success', 'Semua fail SPBB telah berjaya dikemaskini.');
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

        if ($currentMonth == 2) {
            $sesiBayaran = '1/' . $currentYear;
        } elseif ($currentMonth == 4) {
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

    //PENYALURAN - PEMBAYARAN - PERMOHONAN
    public function exportPermohonanLayak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new PermohonanLayak($startDate, $endDate), 'senarai_permohonan__layak.xlsx');
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
        return redirect()->back()->with('success', 'Fail telah berjaya dihantar.');
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

    //PENYALURAN - PEMBAYARAN - TUNTUTAN
    public function exportTuntutanLayak(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        return Excel::download(new TuntutanLayak($startDate, $endDate), 'senarai_tuntutan__layak.xlsx');
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

    public function senaraiPelajar()
    {
        $pelajar = Smoku::join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        // ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->join('users','users.no_kp','=','smoku.no_kp')
        ->leftJoin('tukar_institusi', 'tukar_institusi.smoku_id', '=', 'smoku.id')
        ->where(function($query) {
            $query->where('smoku_akademik.id_institusi', '=', Auth::user()->id_institusi)
                ->orWhere('tukar_institusi.id_institusi_baru', '=', Auth::user()->id_institusi)
                ->where('tukar_institusi.status', '=', 1);
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

}
