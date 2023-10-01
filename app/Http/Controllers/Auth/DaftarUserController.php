<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smoku;
use App\Models\TarikhIklan;
use GuzzleHttp\Client;

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
        /*
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
        $url = 'https://oku-staging.jkm.gov.my/api/oku/' . $request->no_kp;
        $request = $client->get($url, ['headers' => $headers]);

        $response = $request ? $request->getBody()->getContents() : null;
        $status = $request ? $request->getStatusCode() : 500;

        // Parse the JSON string
        $data = json_decode($response, true);
        

        // Access the "data" field
        $dataField = [];
        if (isset($data['data'])) {
            $dataField = $data['data'];
            // Now, $dataField contains the "data" array
            $no_kp = $dataField['NO_ID'];
            return redirect()->route('semaksyarat')->with($no_kp)
            ->with('message', $nokp_in. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');

        } else {

            return redirect()->route('login')
            ->with('message', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
        }
        */

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


    }

    
    
}
