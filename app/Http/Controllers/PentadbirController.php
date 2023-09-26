<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\InfoIpt;
use App\Models\MaklumatKementerian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailDaftarPengguna;
use GuzzleHttp\Client;


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
        $infoipt = InfoIpt::all()->where('jenis_institusi','IPTA')->sortBy('nama_institusi');
        return view('pages.pentadbir.daftarpengguna', compact('user','tahap','infoipt'));
    }

    public function store(Request $request)
    {   
       

        $user = User::where('no_kp', '=', $request->no_kp)->first();
        if ($user === null) {
            $user = User::create([
                'nama' => $request->nama,
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => '1',
        
            ]);
        }else {

        User::where('no_kp' ,$request->no_kp)
            ->update([
                'nama' => $request->nama,
                'no_kp' => $request->no_kp,
                'email' => $request->email,
                'tahap' => $request->tahap,
                'jawatan' => $request->jawatan,
                'id_institusi' => $request->id_institusi,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            
        ]);
        }

        
        

        $user->save();

        $email = $request->email;
        $no_kp = $request->no_kp;

        Mail::to($email)->send(new mailDaftarPengguna($email,$no_kp));
        return redirect()->route('daftarpengguna')->with('message', 'Emel notifikasi telah dihantar kepada ' .$request->nama);


    }

    public function checkConnectionSmoku()
    {
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
            //dd($statusCode);

            // Check if the status code indicates success (usually 2xx)
            if ($statusCode >= 200 && $statusCode < 300) {
                // API connection is successful
                $data = json_decode($responseContent, true);

                return view('pages.pentadbir.semakkan_api', [
                    'success' => 'Sambungan API berjaya',
                    'data' => $data,
                ]);
            } else {
                // Handle API error
                return view('pages.pentadbir.semakkan_api', [
                    'error' => 'Permintaan API gagal dengan kod status: ' . $statusCode,
                ]);
            }
        } catch (\Exception $e) {
            // Handle other exceptions (e.g., network errors)
            return view('pages.pentadbir.semakkan_api', [
                'error' => 'Ralat dikesan: ' . $e->getMessage(),
            ]);
        }
    }

    public function alamat()
    {
        $maklumat = MaklumatKementerian::get();
           
        return view('pages.pentadbir.alamat', compact('maklumat'));

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
    

}
