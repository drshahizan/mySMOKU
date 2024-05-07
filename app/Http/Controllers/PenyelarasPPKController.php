<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\MailDaftarPentadbir;
use App\Mail\PermohonanHantar;
use App\Models\Agama;
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
use App\Models\Mod;
use App\Models\SumberBiaya;
use App\Models\Penaja;
use App\Models\ButiranPelajar;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\Dokumen;
use App\Models\Dun;
use App\Models\EmelKemaskini;
use App\Models\JenisOku;
use App\Models\JumlahTuntutan;
use App\Models\Peperiksaan;
use App\Models\Tuntutan;
use App\Models\SejarahTuntutan;
use App\Models\Kelulusan;
use App\Models\Keturunan;
use App\Models\Parlimen;
use App\Models\Saringan;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PenyelarasPPKController extends Controller
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
        
        return view('dashboard.penyelaras_ppk.dashboard', compact('smoku'));
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
            $penyelaras=DB::table('smoku_penyelaras')->where('smoku_id', '=', $smoku->id)
            ->first();
            $penyelaras_sama=DB::table('smoku_penyelaras')->where('smoku_id', '=', $smoku->id)
            ->where([['penyelaras_id', '=', Auth::user()->id]])
            ->first();
            $kodoku = $smoku->kategori;

            if ($smoku != null && ($kodoku ==='DE' || $kodoku ==='DD')) {
                if($penyelaras_sama == null){
                    if ($penyelaras == null) {
                        DB::table('smoku_penyelaras')->insert([
                            'smoku_id' => $smoku->id,
                            'penyelaras_id' => Auth::user()->id,
                            'status' => '1',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        $smoku = Smoku::where('no_kp', $no_kp)->first();
                        $id =  $smoku->id;
                        $no_kp =  $smoku->no_kp;
                        $smoku_id = $request->session()->put('id',$id);
                        $no_kp = $request->session()->put('no_kp',$no_kp);
                        
                        return redirect()->route('penyelaras.ppk.dashboard')->with($smoku_id,$no_kp)
                        ->with('success', $no_kp. ' Sah sebagai OKU berdaftar dengan JKM.');

                    } else {
                        return redirect()->route('penyelaras.ppk.dashboard')->with($no_kp)
                            ->with('failed', $no_kp . ' Sudah didaftarkan di universiti lain.');
                    }

                }else {
                    return redirect()->route('penyelaras.ppk.dashboard')->with($no_kp)
                        ->with('failed', $no_kp . ' Sudah didaftarkan.');
                }
                    
               
            } elseif ($kodoku !='DE' && $kodoku !='DD') {

                return redirect()->route('penyelaras.ppk.dashboard')
                    ->with('failed', $request->no_kp. ' Bukan dalam kategori OKU pendengaran');
            } 

        } 
        else {
            return redirect()->route('penyelaras.ppk.dashboard')
            ->with('failed', $nokp_in. ' Bukan OKU yang berdaftar dengan JKM.');
        }
        

        /*
        $request->validate([
            'no_kp' => ['required', 'string'],
        ]);

        $smoku = Smoku::where([['no_kp', '=', $request->no_kp]])->first();
        
        if($smoku != null){
            $kodoku = $smoku->kategori;
            if ($smoku != null && ($kodoku ==='DE' || $kodoku ==='DD')) {
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
                    ->with('success', $request->no_kp. ' Sah sebagai OKU berdaftar dengan JKM & dalam kategori OKU pendengaran');

            } else if ($kodoku !='DE' || $kodoku !='DD') {

                return redirect()->route('penyelaras.ppk.dashboard')
                    ->with('failed', $request->no_kp. ' Bukan dalam kategori OKU pendengaran');
            }

        }
        
        else {

            return redirect()->route('penyelaras.ppk.dashboard')
                ->with('failed', $request->no_kp. ' Bukan OKU yang berdaftar dengan JKM');
        }
        */
    }

    public function deletePendaftaran($id)
    {
        DB::table('smoku_penyelaras')->where('smoku_id',$id)->delete();
        
        return redirect()->route('penyelaras.ppk.dashboard')->with('success', 'Pendaftaran pelajar telah di padam.');
    }

    public function permohonanBaharu($id)
    {
        $smoku = Smoku:: join('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
            ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
            ->leftJoin('bk_hubungan','bk_hubungan.kod_hubungan','=','smoku.hubungan_waris')
            ->join('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
            ->where('smoku.id', $id)
            ->get(['smoku.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*']);

        $biaya = SumberBiaya::all()->where('kod_biaya','!=','2')->sortBy('kod_biaya');
        $penaja = Penaja::orderby("penaja","asc")->get();
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
        $butiranPelajar = ButiranPelajar::join('smoku','smoku.id','=','smoku_butiran_pelajar.smoku_id')
        ->leftJoin('smoku_waris','smoku_waris.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->leftJoin('smoku_akademik','smoku_akademik.smoku_id','=','smoku_butiran_pelajar.smoku_id')
        ->leftJoin('bk_peringkat_pengajian','smoku_akademik.peringkat_pengajian','=','bk_peringkat_pengajian.kod_peringkat')
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
            'smoku_butiran_pelajar.tel_rumah as tel_rumah_baru', 'smoku.*','smoku_waris.*','smoku_akademik.*','permohonan.*', 'bk_jantina.*', 'bk_keturunan.*', 'bk_hubungan.*', 'bk_jenis_oku.*','bk_peringkat_pengajian.*', 'bk_parlimen.*', 'bk_parlimen.id as id_parlimen'])
        ->where('smoku_id', $id);
        

        if ($permohonan && $permohonan->status >= '1' && $permohonan->status != '9') {
            $dokumen = Dokumen::all()->where('permohonan_id', $permohonan->id);
            return view('permohonan.penyelaras_ppk.permohonan_view', compact('butiranPelajar','hubungan','negeri','bandar','infoipt','peringkat','mod','biaya','penaja','penajaArray','dokumen','agama','parlimen','dun','keturunan','permohonan'));
        } else {
            return view('permohonan.penyelaras_ppk.permohonan_baharu', compact('smoku','hubungan','infoipt','peringkat','kursus','biaya','penaja','penajaArray','negeri','bandar','agama','parlimen','dun','keturunan'));
        }
    }

    public function fetchAmaun(Request $request)
    {
        $sem_semasa = $request->input('sem_semasa');
        $amaunModel = JumlahTuntutan::where('program', 'PPK')->where('semester', $sem_semasa)->first();

        return response()->json(['amaun' => $amaunModel ? $amaunModel->jumlah : null]);
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
            ->where('no_rujukan',null)
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

        // $permohonan->program = 'PPK';
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

        $butiranPelajar->save();

        $waris = Waris::firstOrNew(['smoku_id' => $id]);

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

        $akademik = Akademik::firstOrNew(['smoku_id' => $id]);

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

        $akademik->save();

        // Update an Permohonan record based on smoku_id
        // Permohonan::updateOrCreate(
        //     ['smoku_id' => $id],
        //     [
        //         'no_rujukan_permohonan' => 'P'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar,
        //         'wang_saku' => $request->wang_saku,
        //         'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
        //         'perakuan' => $request->perakuan,
        //     ]
        // );

        // // Retrieve or create a Permohonan record based on smoku_id
       
        /*$permohonan = Permohonan::firstOrNew(['smoku_id' => $id]);

        // Set the attributes
        $permohonan->no_rujukan_permohonan = 'P'.'/'.$request->peringkat_pengajian.'/'.$nokp_pelajar;
        $permohonan->program = 'PPK';
        $permohonan->wang_saku = $request->wang_saku;
        $permohonan->amaun_wang_saku = number_format($request->amaun_wang_saku, 2, '.', '');
        $permohonan->perakuan = $request->perakuan;
        // Conditionally set the status
        if ($permohonan->status == '1' || $permohonan->status == null) {
            $permohonan->status = '1';
        }

        // Save the record
        $permohonan->save();*/

        $permohonan = Permohonan::orderBy('id', 'desc')
            ->where('smoku_id', $id)
            ->first();

        if (!$permohonan || $permohonan->status == 9) {
            $permohonan = Permohonan::create(
                [   'smoku_id' => $id,
                    'no_rujukan_permohonan' => 'P' . '/' . '3' . '/' . $nokp_pelajar,
                    'program' => 'PPK',
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
                    'no_rujukan_permohonan' => 'P' . '/' . '3' . '/' . $nokp_pelajar,
                    'program' => 'PPK',
                    'wang_saku' => $request->wang_saku,
                    'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
                    'perakuan' => $request->perakuan,
                    'status' => $permohonan->status == '1' || $permohonan->status == null ? '1' : $permohonan->status,
                ]
            );
        }

        $permohonan = Permohonan::orderBy('id', 'desc')
            ->where('smoku_id', $id)
            ->first();

        $sejarah = SejarahPermohonan::firstOrNew(['smoku_id' => $id,'permohonan_id'=> $permohonan->id]);

        $sejarah->permohonan_id = $permohonan->id;
        $sejarah->status = '1';

        $sejarah->save();

        return redirect()->route('penyelaras.ppk.dashboard');
    }

    public function kemaskini(Request $request)
    {   
        $smoku = Smoku::where('no_kp', '=', $request->no_kp)->first();
        $id = $smoku->id;

        ButiranPelajar::where('smoku_id' ,$id)
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

        Waris::where('smoku_id' ,$id)
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

        Akademik::where('smoku_id' ,$id)
        ->update([

            'peringkat_pengajian' => $request->peringkat_pengajian,
            'nama_kursus' => $request->nama_kursus,
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

        Permohonan::where('smoku_id' ,$id)
        ->update([

            'program' => 'PPK',
            // 'yuran' => $request->yuran,
            // 'amaun_yuran' => $request->amaun_yuran,
            'wang_saku' => $request->wang_saku,
            'amaun_wang_saku' => number_format($request->amaun_wang_saku, 2, '.', ''),
            'perakuan' => $request->perakuan,

        ]);
    }

    public function hantar(Request $request)
    {
        $smoku_id = Smoku::where('no_kp',$request->no_kp)->first();

        $permohonan = Permohonan::orderBy('id', 'desc')
            ->where('smoku_id', $smoku_id->id)
            ->first();

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

        foreach ($documentTypes as $inputName => $idDokumen) {
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
            
        //emel kepada sekretariat
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
        $emel = EmelKemaskini::where('emel_id',15)->first();

        if (empty($invalidEmails)) {
            Mail::to($user->email)->cc($cc_pelajar)->send(new PermohonanHantar($catatan,$emel));     
        } 
        else {
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

        return redirect()->route('penyelaras.ppk.dashboard')->with('success', 'Permohonan pelajar telah dihantar.');
    }

    public function senaraiPermohonanBaharu()
    {
        $smoku = Smoku::leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
        ->leftJoin('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->leftJoin('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->where('permohonan.status','=', '2')
        ->where('penyelaras_id','=', Auth::user()->id)
        ->orderBy('permohonan.created_at', 'DESC')
        ->get(['smoku.*', 'permohonan.*', 'smoku_akademik.*', 'bk_info_institusi.nama_institusi']);

        return view('permohonan.penyelaras_ppk.senarai_baharu', compact('smoku'));
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
        ->orderBy('permohonan.tarikh_hantar', 'DESC')
        ->get(['smoku.*', 'permohonan.no_rujukan_permohonan', 'permohonan.id as permohonan_id', 'tuntutan.status as tuntutan_status','smoku_akademik.*', 'bk_info_institusi.nama_institusi']);
        

        // $currentDate = Carbon::now();
        // $tarikhMula = Carbon::parse($akademik->tarikh_mula);
        // $tarikhNextSem = $tarikhMula->addMonths($akademik->bil_bulan_per_sem);

        // if($akademik->bil_bulan_per_sem == 6){
        //     $bilSem = 2;
        // } else {
        //     $bilSem = 3;
        // }
            
        // $semSemasa = $akademik->sem_semasa;
        // $totalSemesters = $akademik->tempoh_pengajian * $bilSem;

        return view('tuntutan.penyelaras_ppk.tuntutan_baharu', compact('layak'));
    }

    public function kemaskiniKeputusan($id)
    {   
        $permohonan = Permohonan::orderBy('id', 'DESC')->where('smoku_id', '=', $id)->first();
        $smoku_id = $id;
        
        $akademik = Akademik::where('smoku_id',$id)
            ->where('smoku_akademik.status', 1)
            ->first();
        
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
            // var_dump('Formatted Current Date: ' . $currentDate->format('Y-m-d H:i:s'));
            // var_dump('Formatted Start Date: ' . $dateOfSemester->startOfDay()->format('Y-m-d H:i:s'));
            // var_dump('Formatted End Date: ' . $semesterEndDate->format('Y-m-d H:i:s'));
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
        
        if ($permohonan) {
            
            $peperiksaan = Peperiksaan::where('permohonan_id', $permohonan->id)->get();
            $result = Peperiksaan::where('permohonan_id', $permohonan->id)
									->where('sesi', $sesiSemasa)
									->where('semester', $semSemasa)
									->first();

            return view('tuntutan.penyelaras_ppk.kemaskini_keputusan_peperiksaan', compact('peperiksaan','smoku_id','sesiSemasa','semSemasa','result'));
        } 
        else {

            return redirect()->route('senarai.ppk.tuntutanBaharu')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }    
    }

    public function hantarKeputusanPeperiksaan(Request $request, $id)
    {
        $permohonan = Permohonan::orderBy('id', 'DESC')
            ->where('smoku_id', '=', $id)
            ->first();
        $result = DB::table('permohonan_peperiksaan')
            ->where('permohonan_id', $permohonan->id)
            ->where('sesi', '=', $request->sesi)
            ->where('semester', '=', $request->semester)
			->first();

        if($result){
            return back()->with('failed', 'Keputusan peperiksaan semester terdahulu telah ada.');
        }

        //simpan dalam table peperiksaan
        $kepPeperiksaan = $request->file('kepPeperiksaan');
        $counter = 1; 

        // Check if files were uploaded
        if (!empty($kepPeperiksaan)) {
           
                $filenamekepP = $kepPeperiksaan->getClientOriginalName();  
                $uniqueFilename = $counter . '_' . $filenamekepP;

                while (file_exists('assets/dokumen/peperiksaan/' . $uniqueFilename)) {
                    $counter++;
                    $uniqueFilename = $counter . '_' . $filenamekepP;
                }
    
                $kepPeperiksaan->move('assets/dokumen/peperiksaan', $uniqueFilename);
    
                $data = new peperiksaan();
                $data->permohonan_id = $permohonan->id;
                $data->sesi = $request->sesi;
                $data->semester = $request->semester;
                $data->cgpa = $request->cgpa;
                $data->kepPeperiksaan = $uniqueFilename;
                $data->save();
    
                // Increment counter after successful database save
                $counter++;
                return redirect()->route('senarai.ppk.tuntutanBaharu')->with('message', 'Keputusan peperiksaan pelajar telah di simpan.');
                
        } else {
            // Handle the case where no files were uploaded
            // You might want to redirect back with an error message
            return redirect()->back()->with('error', 'No files uploaded.');
        }
    }

    public function hantarTuntutan(Request $request, $id)
    {
        $permohonan = Permohonan::orderBy('id', 'DESC')
        ->where('smoku_id', '=', $id)->first();

        $biltuntutan = Tuntutan::where('smoku_id', '=', $id)
            ->groupBy('no_rujukan_tuntutan')
            ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
            ->get();

        $bil = $biltuntutan->count();
        $running_num =  $bil + 1; //sebab nak guna satu id je
        $no_rujukan_tuntutan =  $permohonan->no_rujukan_permohonan.'/'.$running_num; // try duluuu

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
                'wang_saku' => $request->wang_saku,
                'amaun_wang_saku' => $request->amaun_wang_saku,
                'tarikh_hantar' => now()->format('Y-m-d'),
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
        
        return redirect()->route('senarai.ppk.tuntutanBaharu')->with('message', 'Tuntutan pelajar telah di hantar.');
    }

    public function sejarahTuntutan()
    {

        $tuntutan = Tuntutan::join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tuntutan.smoku_id')
        ->where('smoku_akademik.id_institusi', '=', Auth::user()->id_institusi)
        ->orderBy('tuntutan.id', 'DESC')
        ->get(['tuntutan.*']);
        // dd($tuntutan);

        return view('tuntutan.penyelaras_ppk.sejarah_tuntutan',compact('tuntutan'));
    }

    public function rekodTuntutan($id)
    {
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $sejarah_t = SejarahTuntutan::where('tuntutan_id', $id)->where('status', '!=','4')->orderBy('created_at', 'desc')->get();
        return view('tuntutan.penyelaras_ppk.rekod_tuntutan',compact('tuntutan','akademik','smoku','sejarah_t','permohonan'));
    }

    public function paparRekodTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.penyelaras_ppk.papar_tuntutan',compact('permohonan','tuntutan','smoku','akademik','sejarah_t'));
    }

    public function keputusanPeperiksaan($id)
    {
        $permohonan = Permohonan::where('smoku_id', $id)->first();
        $akademik = Akademik::where('smoku_id', $id)->first();
        $peperiksaan = Peperiksaan::where('permohonan_id', $permohonan->id)->get();

        return view('tuntutan.penyelaras_ppk.keputusan_peperiksaan',compact('akademik','permohonan','peperiksaan'));
    }

    public function paparRekodSaringanTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.penyelaras_ppk.papar_saringan',compact('permohonan','tuntutan','smoku','akademik','sejarah_t'));
    }

    public function sejarahPermohonan()
    {
        $permohonan = Permohonan::join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'permohonan.smoku_id')
        ->where('smoku_akademik.id_institusi', '=', Auth::user()->id_institusi)
        ->orderBy('permohonan.id', 'DESC')
        ->get(['permohonan.*']);
        
        return view('permohonan.penyelaras_ppk.sejarah_permohonan',compact('permohonan'));
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
        
        return back();
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
  
        return redirect()->route('ppk.sejarah.permohonan')->with('success', 'Permohonan telah dibatalkan.');      
    }

    public function rekodPermohonan($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $sejarah_p = SejarahPermohonan::where('permohonan_id', $id)->orderBy('created_at', 'desc')->get();
        return view('permohonan.penyelaras_ppk.rekod_permohonan',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function paparRekodPermohonan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('permohonan.penyelaras_ppk.papar_permohonan',compact('permohonan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodSaringan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('permohonan.penyelaras_ppk.papar_saringan',compact('permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodKelulusan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $kelulusan = Kelulusan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        return view('permohonan.penyelaras_ppk.papar_kelulusan',compact('permohonan','kelulusan','smoku','sejarah_p'));
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
           
        return redirect()->route('ppk.sejarah.tuntutan')->with('success', 'Tuntutan telah dibatalkan.');       
    }

    public function senaraiDibayar()
    {
        $smoku = Smoku::leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
        ->leftJoin('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->leftJoin('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        // ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->where('permohonan.status','=', '8')
        ->where('smoku_akademik.id_institusi','=', Auth::user()->id_institusi)
        // ->where('penyelaras_id','=', Auth::user()->id)
        ->orderBy('permohonan.tarikh_hantar', 'DESC')
        ->get(['smoku.*', 'permohonan.*', 'permohonan.id as permohonan_id', 'smoku_akademik.*', 'bk_info_institusi.nama_institusi']);

        return view('permohonan.penyelaras_ppk.senarai_dibayar', compact('smoku'));
    }

    public function tuntutanDibayar()
    {
        $smoku = Smoku::leftJoin('permohonan','permohonan.smoku_id','=','smoku.id')
        ->leftJoin('tuntutan','permohonan.id','=','tuntutan.permohonan_id')
        ->leftJoin('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->leftJoin('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        // ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->where('tuntutan.status','=', '8')
        ->where('permohonan.program','=', 'PPK')
        // ->where('penyelaras_id','=', Auth::user()->id)
        ->where('smoku_akademik.id_institusi','=', Auth::user()->id_institusi)
        ->orderBy('tuntutan.id', 'DESC')
        ->get(['smoku.*', 'permohonan.no_rujukan_permohonan', 'tuntutan.*', 'smoku_akademik.*', 'bk_info_institusi.nama_institusi']);

        return view('tuntutan.penyelaras_ppk.tuntutan_dibayar', compact('smoku'));
    }

}
