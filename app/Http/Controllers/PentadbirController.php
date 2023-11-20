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
        $user = User::leftjoin('roles','roles.id','=','users.tahap')
        ->orderBy('users.created_at', 'desc')
        ->get(['users.*', 'roles.name']);

        $tahap = Role::all()->sortBy('id');
        $infoipt = InfoIpt::where('jenis_institusi','!=', 'IPTS')->orderBy('nama_institusi')->get(); 
        $infoppk = InfoIpt::whereIn('id_institusi', ['01055','00938','01127','00933','00031','00331'])->orderBy('nama_institusi')->get(); 
               
        return view('kemaskini.pentadbir.daftar_pengguna', compact('user', 'tahap', 'infoipt','infoppk'));
    }

    public function store(Request $request)
    {   
        $user = User::where('no_kp', '=', $request->no_kp)->first();
        $previousStatus = $user->status;
        if ($user === null) {
            $user = User::create([
                'nama' => $request->nama,
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                //'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => '1',
        
            ]);

            // Assuming you have two different select elements with unique names
            if ($request->has('id_institusibkoku')) {
                // Handle the case where the first select element is present
                $user->id_institusi = $request->id_institusibkoku;
            } elseif ($request->has('id_institusippk')) {
                // Handle the case where the second select element is present
                $user->id_institusi = $request->id_institusippk;
            }

            $email = $request->email;
            $no_kp = $request->no_kp;
            Mail::to($email)->send(new MailDaftarPengguna($email,$no_kp));
            //return redirect()->route('daftarpengguna')->with('message', 'Emel notifikasi telah dihantar kepada ' .$request->nama);    
        
        } else {
            // If the user exists, update their information
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'status' => $request->status,
            ]);
            
            // Set the institution ID based on the selected option
            if ($request->has('id_institusibkoku')) {
                $user->id_institusi = $request->id_institusibkoku;
            } elseif ($request->has('id_institusippk')) {
                $user->id_institusi = $request->id_institusippk;
            }
        }

        $user->save();

        if($user->status != $previousStatus){

            // $email = $request->email;
            // $no_kp = $request->no_kp;
            // Mail::to($email)->send(new MailDaftarPengguna($email,$no_kp));
            if($request->status == 1 ){
                return redirect()->route('daftarpengguna')->with('message', 'Status pengguna ' .$request->nama. ' telah diaktifkan. ');
            } else {
                return redirect()->route('daftarpengguna')->with('message', 'Status pengguna ' .$request->nama. ' telah ditukar tidak aktif. ');
            }
            
        }

        return redirect()->route('daftarpengguna');
    }

    public function checkConnection()
    {
        $error = [];
        $success = [];

        try {
            $headers = [
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer knhnxYoATGLiN5WxErU6SVVw8c9xhw09vQ3KRPkOtcH3O0CYh21wDA4CsypX',
            ];

            $client = new Client();
            $url = 'https://oku-staging.jkm.gov.my/api/oku/000212101996';
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
            $url = 'http://espbstg.mohe.gov.my/api/studentsInfo.php';
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
            'tarikh_mula' => $request->tarikh_mula,
            'masa_mula' => $request->masa_mula,
            'tarikh_tamat' => $request->tarikh_tamat,
            'masa_tamat' => $request->masa_tamat,
            'catatan' => $request->catatan,
        ]);
        
        $catatan = $request->catatan;
        $users = User::whereIn('tahap', [1, 2, 6])
        ->where('status', 1)
        ->whereNotNull('email_verified_at')
        ->get();        
        $email = "wsyafiqah4@gmail.com";
        $bcc = $users->pluck('email')->toArray();
        // Validate each email address
        $invalidEmails = [];
        foreach ($bcc as $bcc) {
            if (!filter_var($bcc, FILTER_VALIDATE_EMAIL)) {
                $invalidEmails[] = $bcc;
            }
        }
        if (empty($invalidEmails)) {
            Mail::to($email)->bcc($bcc)->send(new HebahanIklan($catatan)); 
        } else {
            foreach ($invalidEmails as $invalidEmail) {
                 Log::error('Invalid email address: ' . $invalidEmail);
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
        } else {
            $jumlah->update([
                'program' => $request->program,
                'jenis' => $request->jenis,
                'semester' => $request->semester,
                'jumlah' => $request->jumlah,
            ]);
        }
        
        return redirect()->route('jumlah.tuntutan');
    }
}
