<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use App\Models\Smoku;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MaklumatESPController extends Controller
{
    public function index()
    {
        
        $kelulusan = Permohonan::where('status', '=','6')->get();

        

        return view('esp.hantar_esp', compact('kelulusan'));
            
        
    }

    public function hantar(Request $request)
    {

        $selectAll = $request->input('selectAll');
        $selectedNokps = $request->input('selectedNokps');

        $query = DB::table('smoku as a')
            ->join('permohonan as b', 'b.smoku_id', '=', 'a.id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'a.id')
            ->join('bk_info_institusi as g', 'g.id_institusi', '=', 'c.id_institusi')
            ->join('smoku_butiran_pelajar as d', 'd.smoku_id', '=', 'a.id')
            ->join('bk_peringkat_pengajian as e', 'e.kod_peringkat', '=', 'c.peringkat_pengajian')
            ->leftJoin('bk_agama as f', 'f.id', '=', 'd.agama')
            ->leftJoin('maklumat_bank as h', 'g.id_institusi', '=', 'h.institusi_id')
            ->select(
                'a.no_kp as nokp',
                'a.nama',
                DB::raw('DATE_FORMAT(a.tarikh_lahir, "%d/%m/%Y") AS tarikh_lahir'),
                'd.negeri_lahir',
                'a.jantina',
                DB::raw('LEFT(f.agama, 1) AS agama'),
                'a.keturunan',
                DB::raw('"M01" as warganegara'),
                'a.alamat_tetap as alamat1',
                DB::raw('"" as alamat2'),
                'd.alamat_tetap_poskod as poskod',
                'd.alamat_tetap_bandar as bandar',
                'd.alamat_tetap_negeri as negeri',
                'd.tel_bimbit as telefon_hp',
                'd.alamat_surat_menyurat as alamat01',
                DB::raw('"" as alamat02'),
                DB::raw('"" as alamat03'),
                DB::raw('"" as telefon_o'),
                DB::raw('CASE WHEN b.program = "BKOKU" THEN "OKU" ELSE "PPK" END as program'),
                'e.kod_esp as peringkat',
                DB::raw('DATE_FORMAT(c.tarikh_mula, "%d/%m/%Y") AS tahun_tawar'),
                DB::raw('DATE_FORMAT(c.tarikh_mula, "%d/%m/%Y") AS tahun_taja'),
                DB::raw('CONCAT( c.tempoh_pengajian * 12) as tempoh_taja'),
                DB::raw('DATE_FORMAT(c.tarikh_mula, "%d/%m/%Y") AS tarikh_taja'),
                DB::raw('SUBSTRING_INDEX(c.sesi, "/", 1) AS sesi_mula'),
                DB::raw('CONCAT(SUBSTRING_INDEX(c.sesi, "/", 1) + c.tempoh_pengajian) AS sesi_tamat'),
                'g.institusi_esp as institut',
                'c.nama_kursus as kursus',
                DB::raw('DATE_FORMAT(c.tarikh_tamat, "%d/%m/%Y") AS tarikh_tamat'),
                DB::raw('IF(g.jenis_institusi = "IPTS", d.no_akaun_bank, h.no_akaun) as no_akaun'),
                DB::raw('IF(g.jenis_institusi = "IPTS", a.nama, h.nama_akaun) as nama_akaun'),
                
                DB::raw('"45" as kod_bank'),
                DB::raw('"BANK ISLAM MALAYSIA BERHAD" as nama_bank'),
                'b.no_rujukan_permohonan as id_permohonan',
                'a.email',
                DB::raw('"J0307" as kursus'),
            );
        
        if ($selectAll === true) {
            // Fetch all relevant data without filtering by specific no_kp values
            $data = $query->where('c.status', '=', 1)
                ->where('b.status', '=', 6)
                ->get();
        } else {
            // Fetch data based on selected no_kp values
            $data = $query->whereIn('a.no_kp', $selectedNokps)
                ->where('c.status', '=', 1)
                ->where('b.status', '=', 6)
                ->get();
        }    

        return response()->json(['data' => $data]);
        
            
        
    }


    public function receiveData(Request $request)
    {
        
        $contentTypeHeader = $request->header('Content-Type');
        if (strpos($contentTypeHeader, 'application/json') !== false) {
            $jsonString = $request->json()->all();
            $responses = [];

            foreach ($jsonString as $jsonString) {
                $no_kp = $jsonString['nokp'];
                $no_rujukan_permohonan = $jsonString['id_permohonan'];
                $date = DateTime::createFromFormat('d/m/Y', $jsonString['tarikh_transaksi']);
                $formattedDate = $date->format('Y-m-d');

                $smoku = Smoku::where('no_kp', $no_kp)->first();
                // Check if $smoku is null
                if ($smoku === null) {
                    $responses[] = [
                        'nokp' => $no_kp,
                        'id_permohonan' => $no_rujukan_permohonan,
                        'tarikh_transaksi' => $jsonString['tarikh_transaksi'],
                        'amaun' => $jsonString['amount'],
                        'status' => 'Tiada data dalam BKOKU'
                    ];
                } else {

                    DB::table('permohonan')->where('smoku_id', $smoku->id)->where('no_rujukan_permohonan', $no_rujukan_permohonan)
                    ->update([
                        'yuran_dibayar' => number_format($jsonString['amount'], 2, '.', ''),
                        'tarikh_transaksi' => $formattedDate,
                        'status' => 8,
                    ]);

                    $responses[] = [
                        'nokp' => $no_kp,
                        'id_permohonan' => $no_rujukan_permohonan,
                        'tarikh_transaksi' => $jsonString['tarikh_transaksi'],
                        'amaun' => $jsonString['amount'],
                        'status' => 'Data diterima'
                    ];   

                }

                 

            }          

            return response()->json(['received_data' => $responses], 200);

        } else {
            $jsonString = $request->input('data');
            $data = json_decode($jsonString);
            $responses = [];

            if (is_array($data)) {
                foreach ($data as $dataField) {
                   
                    $no_kp = $dataField->nokp;
                    $no_rujukan_permohonan = $dataField->id_permohonan;
                    $date = DateTime::createFromFormat('d/m/Y', $dataField->tarikh_transaksi);
                    $formattedDate = $date->format('Y-m-d');
    
                    $smoku = Smoku::where('no_kp', $no_kp)->first();
                    // Check if $smoku is null
                    if ($smoku === null) {
                        $responses[] = [
                            'nokp' => $no_kp,
                            'id_permohonan' => $no_rujukan_permohonan,
                            'tarikh_transaksi' => $dataField->tarikh_transaksi,
                            'amaun' => $dataField->amount,
                            'status' => 'BKOKU tiada data nokp'
                        ];
                    }else{

                        DB::table('permohonan')->where('smoku_id', $smoku->id)->where('no_rujukan_permohonan', $no_rujukan_permohonan)
                        ->update([
                            'yuran_dibayar' => number_format($dataField->amount, 2, '.', ''),
                            'tarikh_transaksi' => $formattedDate,
                            'status' => 8,
                        ]);

                        $responses[] = [
                            'nokp' => $no_kp,
                            'id_permohonan' => $no_rujukan_permohonan,
                            'tarikh_transaksi' => $dataField->tarikh_transaksi,
                            'amaun' => $dataField->amount,
                            'status' => 'DATA DITERIMA'
                        ];

                    }
                }
                return response()->json(['received_data' => $responses], 200);
                
            } else {
                return response()->json(['error' => 'Invalid data format'], 400);
            }  
        }

        
        
    
    }

    public function testrequery(){


        return view('esp.requery');
    }

    function makeApiRequest(Request $request) {
        $jsonData = $request->input('data');
        $parameters = json_decode($jsonData, true); // Decode JSON data
    
        if ($parameters === null && json_last_error() !== JSON_ERROR_NONE) {
            // Handle JSON decoding error
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid JSON data received.'
            ], 400); // 400 Bad Request status code indicates a client error
        }
    
        // Check if the required keys exist in the $parameters array
        if (!isset($parameters[0]['noic']) || !isset($parameters[0]['id_permohonan']) || !isset($parameters[0]['id_tuntutan'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid JSON data structure. Missing required keys.'
            ], 400);
        }
    
        // Extract values from the parameters array
        $idPermohonan = $parameters[0]['id_permohonan'];
        $idTuntutan = $parameters[0]['id_tuntutan'];
        $noic = $parameters[0]['noic'];
    
        // Prepare data for the API request
        $postData = [
            'id_permohonan' => $idPermohonan,
            'id_tuntutan' => $idTuntutan,
            'noic' => $noic
        ];
    
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'http://espbstg.mohe.gov.my/api/studentsStatus.php');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        $result = curl_exec($curl);
        curl_close($curl);
    
        // Handle the result or return it, depending on your use case
        return $result;
    }
    
    


    public function test(){


        return view('esp.test_hantar');
    }

    public function statusDibayar(){

        $kelulusan = Permohonan::where('status', '=','8')->get();

        return view('esp.status_dibayar', compact('kelulusan'));
    }


    public function store(Request $request)
    {
        $post = Smoku::create($request->all());
        return response()->json($post, 201);
    }

    public function show(Smoku $post)
    {
        return $post;
    }

    public function update(Request $request, Smoku $post)
    {
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function destroy(Smoku $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
