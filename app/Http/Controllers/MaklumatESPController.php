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
        
        $kelulusan = Permohonan::where('status', '=','6')

        //->where('no_rujukan_permohonan', '=','B/2/950623031212')
        ->get();

        

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
                DB::raw('"J0307" as kursus'),
                DB::raw('DATE_FORMAT(c.tarikh_tamat, "%d/%m/%Y") AS tarikh_tamat'),
                'd.no_akaun_bank as no_akaun',
                'a.nama as nama_akaun',
                DB::raw('"45" as kod_bank'),
                DB::raw('"BANK ISLAM MALAYSIA BERHAD" as nama_bank'),
                'b.no_rujukan_permohonan as id_permohonan',
                'a.email',
                DB::raw('DATE_FORMAT(c.tarikh_tamat, "%d/%m/%Y") AS tamat_cuti'),
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

    // public function kemaskiniStatusESP()
    // {
    //     $data = [
    //                 [
    //                     'nokp' => '870807012377',
    //                     'id_permohonan' => 'B/2/870807012377',
    //                     'tarikh_transaksi' => '08/10/2023',
    //                     'amount' => '3000',
    //                 ],
    //                 [
    //                     'nokp' => '870807012377',
    //                     'id_permohonan' => 'B/2/870807012377',
    //                     'tarikh_transaksi' => '08/10/2023',
    //                     'amount' => '2000',
    //                 ],
    //             ];
        
    //             // Convert the data to JSON
    //             //$jsonData = json_encode($data);
    //             //dd($jsonData);
    //     return view('esp.kemaskini_status_esp', compact('data'));
    // }

    public function receiveData(Request $request)
    {
        
        $contentTypeHeader = $request->header('Content-Type');
        if (strpos($contentTypeHeader, 'application/json') !== false) {
            $jsonString = $request->json()->all();

            foreach ($jsonString as $jsonString) {
                $no_kp = $jsonString['nokp'];
                $no_rujukan_permohonan = $jsonString['id_permohonan'];
                $date = DateTime::createFromFormat('d/m/Y', $jsonString['tarikh_transaksi']);
                $formattedDate = $date->format('Y-m-d');

                $smoku = Smoku::where('no_kp', $no_kp)->first();
                // Check if $smoku is null
                if ($smoku === null) {
                    return response()->json(['message' => 'DATA DITERIMA', 'received_data' => $jsonString, 'BKOKU tiada data nokp' => $no_kp], 200);
                }

                DB::table('permohonan')->where('smoku_id', $smoku->id)->where('no_rujukan_permohonan', $no_rujukan_permohonan)
                    ->update([
                        'yuran_dibayar' => number_format($jsonString['amount'], 2, '.', ''),
                        'tarikh_transaksi' => $formattedDate,
                        'status' => 8,
                    ]);

            }          

            return response()->json(['message' => 'DATA DITERIMA', 'received_data' => $jsonString], 200);
        } else {
            $jsonString = $request->input('data');
            $data = json_decode($jsonString);
            if (is_array($data)) {
                foreach ($data as $dataField) {
                   
                    $no_kp = $dataField->nokp;
                    $no_rujukan_permohonan = $dataField->id_permohonan;
                    $date = DateTime::createFromFormat('d/m/Y', $dataField->tarikh_transaksi);
                    $formattedDate = $date->format('Y-m-d');
    
                    $smoku = Smoku::where('no_kp', $no_kp)->first();
                    // Check if $smoku is null
                    if ($smoku === null) {
                        return response()->json(['message' => 'DATA DITERIMA', 'received_data' => $jsonString, 'BKOKU tiada data nokp' => $no_kp], 200);
                    }
    
                    DB::table('permohonan')->where('smoku_id', $smoku->id)->where('no_rujukan_permohonan', $no_rujukan_permohonan)
                        ->update([
                            'yuran_dibayar' => number_format($dataField->amount, 2, '.', ''),
                            'tarikh_transaksi' => $formattedDate,
                            'status' => 8,
                        ]);
    
                }
            } else {
                return response()->json(['error' => 'Invalid data format'], 400);
            }  
        }

          
        return response()->json(['message' => 'DATA DITERIMA', 'received_data' => $data], 200);
        
        
    
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
