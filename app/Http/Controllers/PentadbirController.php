<?php

namespace App\Http\Controllers;

use App\Mail\HebahanIklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\InfoIpt;
use App\Models\MaklumatKementerian;
use App\Models\TarikhIklan;
use App\Models\JumlahTuntutan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailDaftarPengguna;
use App\Mail\MailDaftarPentadbir;
use App\Models\Iklan;
use App\Models\Smoku;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;


class PentadbirController extends Controller
{
    public function index()
    {
        return view('dashboard.pentadbir.dashboard');
    }
    
    public function daftar()
    {

        $tahap = Role::all()->sortBy('id');
        $infoipt = InfoIpt::where('jenis_institusi','!=', 'IPTS')->orderBy('nama_institusi')->get(); 
        $infoppk = InfoIpt::whereIn('id_institusi', ['01055','00938','01127','00933','00031','00331'])->orderBy('nama_institusi')->get(); 
               
        return view('kemaskini.pentadbir.daftar_pengguna', compact('tahap', 'infoipt','infoppk'));
    }

    public function getSenaraiPengguna()
    {
        
        $user = User::where('users.tahap','!=', '1')
            ->with(['role','infoipt'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'email' => $item->email,
                    'tahap' => $item->role->id ?? null,
                    'peranan' => $item->role->name ?? '-',
                    'institusi' => $item->infoipt->id_institusi ?? null,
                    // 'nama_institusi' => $item->infoipt->nama_institusi ?? '-',
                    'jawatan' => $item->jawatan,
                    'created_at' => $item->created_at,
                    'status' => $item->status
                ];
            });

        return response()->json($user);

    }

    public function store(Request $request)
    {
        $user = User::where('no_kp', $request->no_kp)->first();

        // Generate a random password
        $characters = 'abcdef12345!@#$%^&';
        $password_length = 12;
        $password = '';
        for ($i = 0; $i < $password_length; $i++) {
            $password .= $characters[random_int(0, strlen($characters) - 1)];
        }

        // Determine institution ID
        $institutionId = $request->edit_institusi_ipt ?? $request->edit_institusi_ppk ?? $request->id_institusi;

        // dd($institutionId);
        if (is_null($user)) {
            // Create new user
            $user = User::create([
                'nama' => strtoupper($request->nama),
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => strtoupper($request->jawatan),
                'password' => Hash::make($password),
                'status' => $request->status ?? 1,
                'id_institusi' => $institutionId,
            ]);

            Mail::to($request->email)->send(new MailDaftarPentadbir($request->email, $request->no_kp, $password));

            return response()->json(['message' => 'Emel notifikasi telah dihantar kepada ' . $request->nama]);
        }

        // User exists – check if status changed
        if ($user->status != $request->status) {
            $user->update([
                'nama' => strtoupper($request->nama),
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => strtoupper($request->jawatan),
                'status' => $request->status,
                'id_institusi' => $institutionId,
            ]);

            if ($request->status == 1) {
                return redirect()->route('daftarpengguna')->with('message', 'Status pengguna ' . $request->nama . ' telah diaktifkan.');
            } else {
                return redirect()->route('daftarpengguna')->with('tidak', 'Status pengguna ' . $request->nama . ' telah ditukar tidak aktif.');
            }
        }

        // Status remains the same – just update info
        $user->update([
            'nama' => strtoupper($request->nama),
            'email' => $request->email,
            'tahap' => $request->tahap,
            'jawatan' => strtoupper($request->jawatan),
            'id_institusi' => $institutionId,
        ]);

        return redirect()->route('daftarpengguna');
    }


    // public function checkConnection()
    // {
    //     $error = [];
    //     $success = [];

    //     try {
    //         $headers = [
    //             'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
    //             'Content-Type' => 'application/json',
    //             'Authorization' => 'Bearer knhnxYoATGLiN5WxErU6SVVw8c9xhw09vQ3KRPkOtcH3O0CYh21wDA4CsypX',
    //         ];

    //         $client = new Client();
    //         $url = 'https://oku-staging.jkm.gov.my/api/oku/000212101996';
    //         $response = $client->get($url, ['headers' => $headers]);

    //         $statusCode = $response->getStatusCode();
    //         $responseContent = $response->getBody()->getContents();

    //         // Check if the status code indicates success (usually 2xx)
    //         if ($statusCode >= 200 && $statusCode < 300) {
    //             // API connection is successful
    //             $data = json_decode($responseContent, true);
    //             $success['smoku'] = 'Sambungan API SMOKU berjaya';
    //         } else {
    //             // Handle API error
    //             $error['smoku'] = 'Permintaan API SMOKU gagal dengan kod status: ' . $statusCode;
    //         }
    //     } catch (\Exception $e) {
    //         // Handle exceptions
    //         $error['smoku'] = 'Ralat dikesan: ' . $e->getMessage();
    //     }

    //     // try {
    //     //     $client = new Client();
    //     //     $url = 'http://10.29.216.151/api/bkoku/request-MQR';
    //     //     $response = $client->post($url);

    //     //     $statusCode = $response->getStatusCode();
    //     //     $responseContent = $response->getBody()->getContents();

    //     //     // Check if the status code indicates success (usually 2xx)
    //     //     if ($statusCode >= 200 && $statusCode < 300) {
    //     //         // API connection is successful
    //     //         $data = json_decode($responseContent, true);
    //     //         $success['mqa'] = 'Sambungan API MQA berjaya';
    //     //     } else {
    //     //         // Handle API error
    //     //         $error['mqa'] = 'Permintaan API MQA gagal dengan kod status: ' . $statusCode;
    //     //     }
    //     // } catch (\Exception $e) {
    //     //     // Handle exceptions
    //     //     $error['mqa'] = 'Ralat dikesan: ' . $e->getMessage();
    //     // }

    //     try {
    //         $client = new Client();
    //         $url = 'https://espbstg.mohe.gov.my/api/studentsInfo.php';
    //         // $url = 'http://espbdev.mohe.gov.my/api/studentsInfo.php';
    //         $response = $client->get($url);

    //         $statusCode = $response->getStatusCode();
    //         $responseContent = $response->getBody()->getContents();

    //         // Check if the status code indicates success (usually 2xx)
    //         if ($statusCode >= 200 && $statusCode < 300) {
    //             // API connection is successful
    //             $data = json_decode($responseContent, true);
    //             $success['esp'] = 'Sambungan API ESP berjaya';
    //         } else {
    //             // Handle API error
    //             $error['esp'] = 'Permintaan API ESP gagal dengan kod status: ' . $statusCode;
    //         }
    //     } catch (\Exception $e) {
    //         // Handle exceptions
    //         $error['esp'] = 'Ralat dikesan: ' . $e->getMessage();
    //     }

    //     return view('kemaskini.pentadbir.semakkan_api', [
    //         'success' => $success,
    //         'error' => $error,
    //         'data' => $data, // You can pass $data to the view if needed
    //     ]);
    // }
    public function checkConnection()
    {
        $error = [];
        $success = [];
        $data = [];

        try {
            $headers = [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer knhnxYoATGLiN5WxErU6SVVw8c9xhw09vQ3KRPkOtcH3O0CYh21wDA4CsypX',
            ];

            $client = new Client();
            $url = 'https://oku.jkm.gov.my/api/oku/051123030366';
            // $url = 'https://oku-staging.jkm.gov.my/api/oku/000212101996';
            $response = $client->get($url, ['headers' => $headers]);

            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();

            // Check if the status code indicates success (usually 2xx)
            if ($statusCode >= 200 && $statusCode < 300) {
                // API connection is successful
                $data = json_decode($responseContent, true);
                $success['smoku'] = 'Sambungan API SMOKU berjaya';
            } else {
                // Handle API error
                $error['smoku'] = 'Permintaan API SMOKU gagal dengan kod status: ' . $statusCode;
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $error['smoku'] = 'Ralat dikesan: ' . $e->getMessage();
        }

        // Add code to check the status of the API from the non-secure site
        try {
            $client = new Client();
            $url = 'http://10.29.216.151/api/bkoku/request-MQR';
            $response = $client->post($url);
        
            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();
        
            // Check if the status code indicates success (usually 2xx)
            if ($statusCode >= 200 && $statusCode < 300) {
                // API connection is successful
                $data = json_decode($responseContent, true);
                $success['mqa'] = 'Sambungan API MQA berjaya';
            } else {
                // Handle API error
                $error['mqa'] = 'Permintaan API MQA gagal dengan kod status: ' . $statusCode;
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $error['mqa'] = 'Ralat dikesan: ' . $e->getMessage();
        }
        

        try {
            $client = new Client();
            $url = 'https://espb.mohe.gov.my/api/studentsInfo.php';
            // $url = 'http://espbdev.mohe.gov.my/api/studentsInfo.php';
            $response = $client->get($url);

            $statusCode = $response->getStatusCode();
            $responseContent = $response->getBody()->getContents();

            // Check if the status code indicates success (usually 2xx)
            if ($statusCode >= 200 && $statusCode < 300) {
                // API connection is successful
                $data = json_decode($responseContent, true);
                $success['esp'] = 'Sambungan API ESP berjaya';
            } else {
                // Handle API error
                $error['esp'] = 'Permintaan API ESP gagal dengan kod status: ' . $statusCode;
            }
        } catch (\Exception $e) {
            // Handle exceptions
            $error['esp'] = 'Ralat dikesan: ' . $e->getMessage();
        }

        return view('kemaskini.pentadbir.semakkan_api', [
            'success' => $success,
            'error' => $error,
            'data' => $data, // You can pass $data to the view if needed
        ]);
    }


    public function alamat()
    {
        $maklumat = MaklumatKementerian::get();

        return view('kemaskini.pentadbir.alamat', compact('maklumat'));
    }

    public function save(Request $request)
    {
        $maklumat = MaklumatKementerian::first();

        if ($maklumat === null) {
            $maklumat = MaklumatKementerian::create([
                'nama_kementerian_bm' => $request->nama_kementerian_bm,
                'nama_kementerian_bi' => $request->nama_kementerian_bi,
                'nama_bahagian_bm' => $request->nama_bahagian_bm,
                'nama_bahagian_bi' => $request->nama_bahagian_bi,
                'alamat1' => $request->alamat1,
                'alamat2' => $request->alamat2,
                'poskod' => $request->poskod,
                'negeri' => $request->negeri,
                'negara' => $request->negara,
                'tel' => $request->tel,
                'hotline' => $request->hotline,
                'faks' => $request->faks,
                'email' => $request->email,
            ]);
        } else {
            $maklumat->update([
                'nama_kementerian_bm' => $request->nama_kementerian_bm,
                'nama_kementerian_bi' => $request->nama_kementerian_bi,
                'nama_bahagian_bm' => $request->nama_bahagian_bm,
                'nama_bahagian_bi' => $request->nama_bahagian_bi,
                'alamat1' => $request->alamat1,
                'alamat2' => $request->alamat2,
                'poskod' => $request->poskod,
                'negeri' => $request->negeri,
                'negara' => $request->negara,
                'tel' => $request->tel,
                'hotline' => $request->hotline,
                'faks' => $request->faks,
                'email' => $request->email,
            ]);
        }
        return redirect()->route('alamat');
    }

    public function tarikh()
    {
        $tarikh = TarikhIklan::orderBy('created_at', 'desc')->first(); 

        return view('kemaskini.pentadbir.tarikh_iklan', compact('tarikh'));
    }

    public function simpanTarikh(Request $request)
    {
        
        $tarikh = TarikhIklan::create([
            'tarikh_mula'  => $request->tarikh_mula,
            'masa_mula'    => $request->masa_mula,
            'tarikh_tamat' => $request->tarikh_tamat,
            'masa_tamat'   => $request->masa_tamat,
            'permohonan'   => $request->has('permohonan') ? 1 : 0,
            'tuntutan'     => $request->has('tuntutan') ? 1 : 0,
            'emel'         => $request->has('emel') ? 1 : 0,
            'catatan'      => $request->catatan,
        ]);

        if ($request->emel == 'on'){
            $catatan = $request->catatan;
            $isTuntutan = $request->has('tuntutan');
            $isPermohonan = $request->has('permohonan');

            $penyelaras = User::whereIn('tahap', [2, 6])
                ->where('status', 1)
                ->whereNotNull('email_verified_at')
                ->pluck('email');

            $pelajarQuery = User::join('smoku', 'smoku.no_kp', '=', 'users.no_kp')
                ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                ->where('users.tahap', 1)
                ->where('users.status', 1)
                ->where('smoku_akademik.status', 1)
                ->whereNotNull('users.email_verified_at')
                ->select('users.email');

            $pelajar = $pelajarQuery->get()->pluck('email');

            $pelajarAktif = (clone $pelajarQuery)
                ->where('smoku_akademik.tarikh_tamat', '>', now())
                ->get()
                ->pluck('email');

            // $emails = $users_pelajar->pluck('email')->toArray();

            // dd($emails);
            
            $emailmain = "bkoku@mohe.gov.my";

            $bcc = collect()
                ->merge($penyelaras)
                ->merge($isTuntutan && !$isPermohonan ? $pelajarAktif : $pelajar)
                ->map(fn($email) => preg_replace('/\s+/', '', $email)) // remove ALL whitespace
                ->filter(fn($email) => filter_var($email, FILTER_VALIDATE_EMAIL))
                ->unique()
                ->values()
                ->toArray();

            // Send email only if there are valid recipients    
            if (!empty($bcc)) {
                Mail::to($emailmain)->bcc($bcc)->send(new HebahanIklan($catatan));
            } else {
                Log::warning('No valid email addresses found to send BCC.');
            }

        }
        
        return redirect()->route('tarikh');
    }

    public function jumlahTuntutan()
    {
        $jumlah = JumlahTuntutan::get();

        return view('kemaskini.pentadbir.jumlah_tuntutan', compact('jumlah'));
    }

    public function simpanJumlah(Request $request)
    {
        $jumlah = JumlahTuntutan::where('program', $request->program)
        ->where('jenis', $request->jenis)
        ->where('semester', $request->semester)
        ->first();
        if ($jumlah === null) {
            $jumlah = JumlahTuntutan::create([
                'program' => $request->program,
                'jenis' => $request->jenis,
                'semester' => $request->semester,
                'jumlah' => $request->jumlah,
            ]);
        } 
        else {
            $jumlah->update([
                'program' => $request->program,
                'jenis' => $request->jenis,
                'semester' => $request->semester,
                'jumlah' => $request->jumlah,
            ]);
        }
        
        return redirect()->route('jumlah.tuntutan');
    }

    public function viewESPInstitusi()
    {
        $institusi = InfoIpt::orderBy('nama_institusi')->get();

        return view('kemaskini.pentadbir.esp_institusi', compact('institusi'));
    }

    public function fetchInstitusiEsp(Request $request) 
    {
        $namaInstitusi = $request->input('nama_institusi');
        $infoIpt = InfoIpt::where('nama_institusi', $namaInstitusi)->first();

        if ($infoIpt) {
            return response()->json(['institusi_esp' => $infoIpt->institusi_esp]);
        } else {
            return response()->json(['error' => 'Institusi ESP tiada.']);
        }
    }

    public function kemaskiniESPInstitusi(Request $request)
    {
        $namaInstitusi = $request->input('nama_institusi');
        $institusiEsp = $request->input('institusi_esp');

        // Update the database record
        $infoIpt = InfoIpt::where('nama_institusi', $namaInstitusi)->first();

        if ($infoIpt) {
            $infoIpt->institusi_esp = $institusiEsp;
            $infoIpt->save();
            return redirect()->back()->with('success', 'Kod ESP telah berjaya dikemaskini.');
        } 
        else {
            return redirect()->back()->with('error', 'Institusi tidak dijumpai.');
        }
    }


    public function iklan()
    {
        $iklan = Iklan::orderBy('created_at', 'desc')->get(); 

        return view('kemaskini.pentadbir.tambah_iklan', compact('iklan'));
    }

    public function simpanIklan(Request $request)
    {
        $iklan = Iklan::create([
            'kategori_iklan' => $request->kategori_iklan,
            'tajuk_iklan' => $request->tajuk_iklan,
            'tarikh_iklan' => $request->tarikh_iklan,
            'status' => $request->status,
            'iklan' => $request->iklan,
        ]);
        
  
        return redirect()->route('iklan');
    }
    
}
