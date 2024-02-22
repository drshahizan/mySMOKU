<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hubungan;
use App\Models\JenisOku;
use App\Models\Keturunan;
use Illuminate\Http\Request;
use App\Models\Smoku;
use App\Models\TarikhIklan;
use App\Models\User;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class DaftarUserController extends Controller
{
    public function create(Request $request)
    {   
        $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
        $catatan = $iklan->catatan ?? "";

        return view('pages.auth.register', compact('catatan'));
    }

    public function semak(Request $request)
    {
        //using api smoku
        $request->validate([
            'no_kp' => ['required', 'string'],
            
        ]);

        $nokp_in = $request->no_kp;
        $user = User::where('no_kp', $nokp_in)->first();

        if (!$user) 
        {
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

                $smoku = Smoku::where('no_kp', $no_kp)->first();
                $id =  $smoku->id;
                $no_kp =  $smoku->no_kp;
                $smoku_id = $request->session()->put('id',$id);
                $no_kp = $request->session()->put('no_kp',$no_kp);


                return redirect()->route('semaksyarat')->with($smoku_id,$no_kp)
                ->with('message', $nokp_in. ' Sah sebagai OKU berdaftar dengan JKM.');

            } else {

                return redirect()->route('login')
                ->with('message', $nokp_in. ' Bukan OKU yang berdaftar dengan JKM.');
            }

        }
        else{
            return redirect()->route('login')->with('message',  ' Maklumat pendaftaran '.$nokp_in.' telah wujud.');
        } 
        
        /*
        $request->validate([
            'no_kp' => ['required', 'string'],
            
        ]);

        $nokp_smoku=Smoku::where('no_kp', '=', $request->no_kp)
        ->first();
            
            if ($nokp_smoku != null) {
                
                $nokp_in = $request->no_kp;
                $smoku = Smoku::where('no_kp', $nokp_in)->first();
                $id =  $smoku->id;
                $no_kp =  $smoku->no_kp;
                $smoku_id = $request->session()->put('id',$id);
                $no_kp = $request->session()->put('no_kp',$no_kp);
                return redirect()->route('semaksyarat')->with($smoku_id,$no_kp)
                ->with('message', $nokp_in. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');
            } else {

                $nokp_in = $request->no_kp;
                return redirect()->route('login')
                ->with('message', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
            }
            
        */
    }
}
