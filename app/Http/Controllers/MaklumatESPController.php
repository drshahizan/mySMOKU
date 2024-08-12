<?php

namespace App\Http\Controllers;

use App\Models\InfoIpt;
use App\Models\JumlahTuntutan;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\Smoku;
use App\Models\Tuntutan;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class MaklumatESPController extends Controller
{
    public function permohonan()
    {
        $kelulusan = Permohonan::orderBy('tarikh_hantar', 'desc')
        ->where('status', '=','6')
        ->whereNull('data_migrate')
        ->get();

        $secretKey = '2z_JoT4dDCNe_bkT9y6kEhc_4plRkUW7Ci1hzoyH';

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('esp.permohonan.permohonan_esp', compact('kelulusan','secretKey', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));     
        
    }

    public function tuntutan()
    {
        $kelulusan = Tuntutan::orderBy('tuntutan.tarikh_hantar', 'desc')
        ->join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
        ->where('tuntutan.status', '=','6')->whereNull('tuntutan.data_migrate')
        ->get(['permohonan.no_rujukan_permohonan','tuntutan.*']);
        // dd($kelulusan);

        $secretKey = '2z_JoT4dDCNe_bkT9y6kEhc_4plRkUW7Ci1hzoyH'; 

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('esp.tuntutan.tuntutan_esp', compact('kelulusan','secretKey','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK','institusiPengajianUA','institusiPengajianPPK'));     
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
            ->leftJoin('senarai_bank as l', 'h.bank_id', '=', 'l.kod_bank')
            ->leftJoin('bk_negeri as i', 'i.id', '=', 'd.negeri_lahir')
            ->leftJoin('bk_bandar as j', 'j.id', '=', 'd.alamat_tetap_bandar')
            ->leftJoin('bk_negeri as k', 'k.id', '=', 'd.alamat_tetap_negeri')
            ->select(
                'a.no_kp as nokp',
                'a.nama',
                DB::raw('DATE_FORMAT(a.tarikh_lahir, "%d/%m/%Y") AS tarikh_lahir'),
                'i.kod_negeri_esp as negeri_lahir',
                'a.jantina',
                DB::raw('LEFT(f.agama, 1) AS agama'),
                DB::raw('LPAD(a.keturunan, 2, "0") as keturunan'),
                DB::raw('"M01" as warganegara'),
                'a.alamat_tetap as alamat1',
                DB::raw('"" as alamat2'),
                'd.alamat_tetap_poskod as poskod',
                'j.bandar as bandar',
                'k.kod_negeri_esp as negeri',
                'd.tel_bimbit as telefon_hp',
                'd.alamat_surat_menyurat as alamat01',
                DB::raw('"" as alamat02'),
                DB::raw('"" as alamat03'),
                'd.tel_rumah as telefon_o',
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
                DB::raw('IF(g.jenis_institusi = "UA", h.no_akaun, d.no_akaun_bank) as no_akaun'),
                DB::raw('IF(g.jenis_institusi = "UA", h.nama_akaun, a.nama) as nama_akaun'),
                DB::raw('IF(g.jenis_institusi = "UA", h.bank_id, "45") as kod_bank'),
                DB::raw('IF(g.jenis_institusi = "UA", l.nama_bank, "BANK ISLAM MALAYSIA BERHAD") as nama_bank'),
                'b.no_rujukan_permohonan as id_permohonan',
                DB::raw('"" as id_tuntutan'),
                'a.email',
                DB::raw('"Z0101" as bidang'),
            );
        
            // Define common conditions
            $query = $query->where('c.status', '=', 1)
            ->where('b.status', '=', 6);

            if ($selectAll === true) {
                // Fetch all relevant data without filtering by specific no_kp values
                $data = $query->get();
                
            } else {
                // Fetch data based on selected no_kp values
                $data = $query->whereIn('a.no_kp', $selectedNokps)
                ->get();
                
            }

            $responseData = [
                'data' => $data
            ];

            return response()->json($responseData);
    }

    public function hantarTuntutan(Request $request)
    {
        $selectAll = $request->input('selectAll');
        $selectedNokps = $request->input('selectedNokps');

        $query = DB::table('smoku as a')
            ->join('permohonan as b', 'b.smoku_id', '=', 'a.id')
            ->join('tuntutan as bb', 'bb.permohonan_id', '=', 'b.id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'a.id')
            ->join('bk_info_institusi as g', 'g.id_institusi', '=', 'c.id_institusi')
            ->join('smoku_butiran_pelajar as d', 'd.smoku_id', '=', 'a.id')
            ->join('bk_peringkat_pengajian as e', 'e.kod_peringkat', '=', 'c.peringkat_pengajian')
            ->leftJoin('bk_agama as f', 'f.id', '=', 'd.agama')
            ->leftJoin('maklumat_bank as h', 'g.id_institusi', '=', 'h.institusi_id')
            ->leftJoin('senarai_bank as l', 'h.bank_id', '=', 'l.kod_bank')
            ->leftJoin('bk_negeri as i', 'i.id', '=', 'd.negeri_lahir')
            ->leftJoin('bk_bandar as j', 'j.id', '=', 'd.alamat_tetap_bandar')
            ->leftJoin('bk_negeri as k', 'k.id', '=', 'd.alamat_tetap_negeri')
            ->select(
                'a.no_kp as nokp',
                'a.nama',
                DB::raw('DATE_FORMAT(a.tarikh_lahir, "%d/%m/%Y") AS tarikh_lahir'),
                'i.kod_negeri_esp as negeri_lahir',
                'a.jantina',
                DB::raw('LEFT(f.agama, 1) AS agama'),
                DB::raw('LPAD(a.keturunan, 2, "0") as keturunan'),
                DB::raw('"M01" as warganegara'),
                'd.alamat_tetap as alamat1',
                DB::raw('"" as alamat2'),
                'd.alamat_tetap_poskod as poskod',
                'j.bandar as bandar',
                'k.kod_negeri_esp as negeri',
                'd.tel_bimbit as telefon_hp',
                'd.alamat_surat_menyurat as alamat01',
                DB::raw('"" as alamat02'),
                DB::raw('"" as alamat03'),
                'd.tel_rumah as telefon_o',
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
                DB::raw('IF(g.jenis_institusi = "UA", h.no_akaun, d.no_akaun_bank) as no_akaun'),
                DB::raw('IF(g.jenis_institusi = "UA", h.nama_akaun, a.nama) as nama_akaun'),
                DB::raw('IF(g.jenis_institusi = "UA", h.bank_id, "45") as kod_bank'),
                DB::raw('IF(g.jenis_institusi = "UA", l.nama_bank, "BANK ISLAM MALAYSIA BERHAD") as nama_bank'),
                'b.no_rujukan_permohonan as id_permohonan',
                'bb.no_rujukan_tuntutan as id_tuntutan',
                'a.email',
                DB::raw('"Z0101" as bidang'),
            );
        
            // Define common conditions
            $query = $query->where('c.status', '=', 1)
            ->where('bb.status', '=', 6);

            if ($selectAll === true) {
                // Fetch all relevant data without filtering by specific no_kp values
                $data = $query->get();
                
            } else {
                // Fetch data based on selected no_kp values
                $data = $query->whereIn('a.no_kp', $selectedNokps)
                ->get();
                
            }

        return response()->json(['data' => $data]);   
    }

    public function receiveData(Request $request)
    {
        // Check the Content-Type header and parse JSON data
        $jsonData = $this->parseJsonData($request);
        try {
            
            // Validate the presence of required keys in $jsonData
            $this->validateJsonData($jsonData);

            // Update the database with the received data
            $responses = $this->updateDatabase($jsonData);

            // If successful, prepare success response
            $response = [
                'status' => 'success',
                'message' => 'Data diterima dan diproses dengan jaya.',
                'data' => $this->formatDataWithTypes($jsonData)
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            // If there's an error, prepare error response
            $response = [
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => $this->formatDataWithTypes($jsonData) // Include the input data in the error response if needed
            ];

            return response()->json($response, 400);
        }
    }

    private function parseJsonData(Request $request)
    {
        $contentType = $request->header('Content-Type');
        $jsonData = null;

        if (strpos($contentType, 'application/json') !== false) {
            // If Content-Type is application/json, parse JSON data from the request body
            $jsonData = $request->json()->all();
        } elseif ($request->has('data')) {
            // If 'data' parameter exists, use it as the JSON data
            $jsonData = json_decode($request->input('data'), true);
        }

        // Check if $jsonData is valid
        if ($jsonData !== null) {
            // Check if $jsonData is empty or not a valid JSON object or array
            if (empty($jsonData) || !is_array($jsonData) && !is_object($jsonData)) {
                throw new \Exception('Invalid or empty JSON data.');
            }
        } else {
            throw new \Exception('JSON data is null.');
        }

        return $jsonData;
    }

    private function validateJsonData($jsonData)
    {
        // Validate the presence of required keys in $jsonData
        if (!isset($jsonData['nokp'], $jsonData['id_permohonan'], $jsonData['tarikh_transaksi'])) {
            throw new \Exception('Invalid JSON format. Missing required fields.');
        }
    }

    private function formatDataWithTypes($jsonData)
    {
        $formattedData = [];

        foreach ($jsonData as $key => $value) {
            $formattedData[$key] = [
                'value' => $value,
                'type' => gettype($value)
            ];
        }

        return $formattedData;
    }

    private function updateDatabase($jsonData)
    {
        $responses = [];

        if (is_array($jsonData)) 
        {            
            // Perform your update query here using $json data
            $dateString = $jsonData['tarikh_transaksi'];

            // Create a DateTime object from the formatted date string
            $date = DateTime::createFromFormat('d/m/Y', $dateString);

            if ($date === false) {
                // Handle invalid date format error
                throw new Exception('Invalid date format: ' . $dateString);
            }

            // Format the DateTime object as 'Y-m-d'
            $formattedDate = $date->format('Y-m-d');

            $smoku = Smoku::where('no_kp', $jsonData['nokp'])->first();

            $rujukan = explode("/", $jsonData['id_permohonan']);
            $program = $rujukan[0]; 

            //fetch max yuran dan wang saku
            $amaun_yuran = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Yuran')->first();
            $amaun_wang_saku = JumlahTuntutan::where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();
            
            if ($smoku === null) {
                // No record found in Smoku table
                $responses[] = [
                    'nokp' => $jsonData['nokp'],
                    'id_permohonan' => $jsonData['id_permohonan'],
                    'tarikh_transaksi' => $jsonData['tarikh_transaksi'],
                    'id_tuntutan' => $jsonData['id_tuntutan'],
                    'yuran_dibayar' => $jsonData['yuran_dibayar'],
                    'wang_saku_dibayar' => $jsonData['wang_saku_dibayar'],
                    'status' => 'Tiada data dalam BKOKU'
                ];
            } else {

                if ($jsonData['id_tuntutan'] == null){
                    // Record found in Smoku table, perform the update
                    $affectedRows = DB::table('permohonan')
                        ->where('smoku_id', $smoku->id)
                        ->where('no_rujukan_permohonan', $jsonData['id_permohonan'])
                        ->update([
                            'yuran_dibayar' => $jsonData['yuran_dibayar'] !== null ? number_format($jsonData['yuran_dibayar'], 2, '.', '') : null,
                            'wang_saku_dibayar' => $jsonData['wang_saku_dibayar'] !== null ? number_format($jsonData['wang_saku_dibayar'], 2, '.', '') : null,
                            'tarikh_transaksi' => $formattedDate,
                            'status' => 8,
                        ] + ($program == 'B' ? ['baki_dibayar' => $amaun_yuran->jumlah - $jsonData['yuran_dibayar'] - $jsonData['wang_saku_dibayar']] : []));

                    $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$smoku->id)->first();    
                    SejarahPermohonan::updateOrCreate(
                        [
                            'smoku_id' => $smoku->id,
                            'permohonan_id' => $permohonan_id->id,
                            'status' => 8,
                        ]
                    );

                }
                else {
                    
                    $permohonan_id = Permohonan::orderBy('id', 'desc')
                            ->where('smoku_id',$smoku->id)
                            ->where('no_rujukan_permohonan', $jsonData['id_permohonan'])
                            ->first();    
                    
                        $affectedRows = DB::table('tuntutan')
                            ->where('smoku_id', $smoku->id)
                            ->where('permohonan_id', $permohonan_id->id)
                            ->update([
                                'yuran_dibayar' => $jsonData['yuran_dibayar'] !== null ? number_format($jsonData['yuran_dibayar'], 2, '.', '') : null,
                                'wang_saku_dibayar' => $jsonData['wang_saku_dibayar'] !== null ? number_format($jsonData['wang_saku_dibayar'], 2, '.', '') : null,
                                'tarikh_transaksi' => $formattedDate,
                                'status' => 8,
                                ] + ($program == 'B' ? ['baki_dibayar' => $amaun_yuran->jumlah - $jsonData['yuran_dibayar'] - $jsonData['wang_saku_dibayar']] : []));

                        $tuntutan_id = Tuntutan::orderBy('id', 'desc')->where('smoku_id',$smoku->id)
                            ->where('permohonan_id', $permohonan_id->id)
                            ->first(); 
                        SejarahTuntutan::updateOrCreate([
                            'smoku_id' => $smoku->id,
                            'tuntutan_id' => $tuntutan_id->id,
                            'status' => 8, 
                        ]);
                }
                

                // Prepare the response based on the update result
                if ($affectedRows > 0) {
                    // Data was updated successfully
                    $responses[] = [
                        'nokp' => $jsonData['nokp'],
                        'id_permohonan' => $jsonData['id_permohonan'],
                        'tarikh_transaksi' => $jsonData['tarikh_transaksi'],
                        'id_tuntutan' => $jsonData['id_tuntutan'],
                        'yuran_dibayar' => $jsonData['yuran_dibayar'],
                        'wang_saku_dibayar' => $jsonData['wang_saku_dibayar'],
                        'status' => 'Data diterima dan update'
                    ];
                } else {
                    // Data was not updated
                    $responses[] = [
                        'nokp' => $jsonData['nokp'],
                        'id_permohonan' => $jsonData['id_permohonan'],
                        'tarikh_transaksi' => $jsonData['tarikh_transaksi'],
                        'id_tuntutan' => $jsonData['id_tuntutan'],
                        'yuran_dibayar' => $jsonData['yuran_dibayar'],
                        'wang_saku_dibayar' => $jsonData['wang_saku_dibayar'],
                        'status' => 'Data tidak diupdate'
                    ];
                }
            } 
        }

        return $responses;
    }

    public function testrequery()
    {
        $bkokuUA = Permohonan::whereIn('status', ['6','8'])->orderBy('created_at', 'DESC')->get();

        return view('esp.requery', compact('bkokuUA'));
    }

    public function kemaskiniStatusESP(Request $request)
    {
        $selectAll = $request->input('selectAll');
        $selectedNokps = $request->input('selectedNokps');

        $query = DB::table('smoku as a')
            ->join('permohonan as b', 'b.smoku_id', '=', 'a.id')
            ->join('smoku_akademik as c', 'c.smoku_id', '=', 'a.id')
            ->select(
                'a.no_kp as noic',
                'b.no_rujukan_permohonan as id_permohonan',
                DB::raw('"" as id_tuntutan'),
            );
        
            // Define common conditions
            $query = $query->where('c.status', '=', 1)
            ->where('b.status', '=', 6);

            if ($selectAll === true) {
                // Fetch all relevant data without filtering by specific no_kp values
                $data = $query->get();
                
            } else {
                // Fetch data based on selected no_kp values
                $data = $query->whereIn('a.no_kp', $selectedNokps)
                ->get();
                
            }

            $responseDataUA = [
                'data' => $data
            ];

            return response()->json($responseDataUA);
    }

    public function test()
    {
        return view('esp.test_hantar');
    }

    public function statusDibayar()
    {
        $kelulusan = Permohonan::where('status', '=','8')->get();

        return view('esp.status_dibayar', compact('kelulusan'));
    }

    public function statusDibayarTuntutan()
    {
        $kelulusan = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
            ->where('tuntutan.status', '=', '8')
            ->select('tuntutan.*', 'permohonan.no_rujukan_permohonan AS no_rujukan_permohonan')
            ->get();

        return view('esp.status_dibayar_tuntutan', compact('kelulusan'));
    }

}
