<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Smoku;
use GuzzleHttp\Client;

class DaftarUserController extends Controller
{
    public function create(Request $request)
    {   
        return view('pages.auth.register');
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
                $smoku_id = $request->session()->put('id',$id);
                return redirect()->route('semaksyarat')->with($smoku_id)
                ->with('message', $nokp_in. ' SAH SEBAGAI OKU BERDAFTAR DENGAN JKM');
            } else {

                $nokp_in = $request->no_kp;
                return redirect()->route('login')
                ->with('message', $nokp_in. ' BUKAN OKU YANG BERDAFTAR DENGAN JKM');
            }


    }

    
    
}
