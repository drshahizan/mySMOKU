<?php


namespace App\Http\Controllers;

use App\Models\Kursus;
use Illuminate\Support\Facades\Http;

class MaklumatKursusController extends Controller
{
    public function index()
    {
        set_time_limit(1200);

        $response = Http::post('http://10.29.216.151/api/bkoku/request-MQR');

        if ($response->successful()) {
            $data = json_decode($response->body(), true);

            if (isset($data['dataMQR'])) {
                $counter = 0;
                foreach ($data['dataMQR'] as $item) {
                    //if ($counter < 1) {

                        Kursus::updateOrInsert(
                            ['no_rujukan' => $item['NoRujProg']], // Condition to find the record
                            [
                                'no_sijil' => $item['NoSiriSijil'],
                                'nama_kursus' => $item['NamaProgBM'],
                                'nama_kursus_bi' => $item['NamaProgBI'],
                                'kod_nec' => $item['KodNEC'],
                                'bidang' => $item['BidangProgram'],
                                'kod_peringkat' => $item['PeringkatKelayakan'],
                                'peringkat' => $item['Peringkat'],
                                'kod_pengendalian' => $item['KodPengendalian'],
                                'kaedah_pengendalian' => $item['KaedahPengendalian'],
                                'tarikh_mula' => $item['TarikhAkrMula'],
                                'tarikh_tamat' => $item['TarikhAkrTamat'],
                                'id_institusi' => $item['IdAgensi'],
                                'nama_institusi' => $item['NamaAgensiBM'],
                                'nama_institusi_bi' => $item['NamaAgensiBI'],
                                'poskod' => $item['Poskod'],
                                'BilMingguPjg' => $item['BilMingguPjg'],
                                'BilMingguPndk' => $item['BilMingguPndk'],
                                'BilSemPjg' => $item['BilSemPjg'],
                                'BilSemPndk' => $item['BilSemPndk'],
                                'BilThn' => $item['BilThn'],
                                'BilBln' => $item['BilBln'],
                                'BilThnTo' => $item['BilThnTo'],
                                'MingguPanjang' => $item['MingguPanjang'],
                                'SemPanjang' => $item['SemPanjang'],
                                'MingguPendek' => $item['MingguPendek'],
                                'SemPendek' => $item['SemPendek'],
                                'PYear' => $item['PYear'],
                                'PMonth' => $item['PMonth'],
                                'PYearTo' => $item['PYearTo'],
                                'PMonthTo' => $item['PMonthTo'] 
                            ]
                        );
                        
                        //MaklumatKursusMQA::create($item);
                       //$counter++;
                    // } else {
                    //    break; // Break the loop after inserting 10 records
                    // }
                }
                return response()->json(['message' => 'Data inserted successfully'], 200);
            } else {
                return response()->json(['error' => 'Invalid API response format'], 500);
            }
            //untuk papar
            // foreach ($data['dataMQR'] as $item) {
            //     foreach ($item as $key => $value) {
            //         echo $key . ": " . $value . "<br>";
                    
            //     }
            //     echo "<br>"; // Add a line break between items
            // }
        } else {
            return response()->json(['error' => 'Unable to fetch data from API'], $response->status());
        }
    }

    public function MQAPA()
    {
        set_time_limit(1200);

        $response = Http::post('http://10.29.216.151/api/bkoku/request-MQAPA');

        if ($response->successful()) {
            $data = json_decode($response->body(), true);

            if (isset($data['dataMQRPA'])) {
                // $counter = 0;
                foreach ($data['dataMQRPA'] as $item) {
                    
                    // if ($counter < 1) {
                        
                        Kursus::updateOrInsert(
                            ['no_rujukan' => $item['NoRujProg']], // Condition to find the record
                            [
                                'nama_kursus' => $item['NamaProgBM'],
                                'nama_kursus_bi' => $item['NamaProgBI'],
                                'kod_nec' => $item['KodNEC'],
                                'bidang' => $item['Bidang'],
                                'kod_peringkat' => $item['PeringkatKelayakan'],
                                'peringkat' => $item['Peringkat'],
                                'kod_pengendalian' => $item['KodPengendalian'],
                                'kaedah_pengendalian' => $item['KaedahPengendalian'],
                                'tarikh_mula' => $item['TarikhMula'],
                                'tarikh_tamat' => $item['TarikhTamat'],
                                'id_institusi' => $item['IdAgensi'],
                                'nama_institusi' => $item['NamaIPTBM'],
                                'nama_institusi_bi' => $item['NamaIPTBI'],
                                'poskod' => $item['Poskod'],
                                'institusi_penganugerahan' => $item['InstitusiPenganugerahan']
                            ]
                        );
                        
                        //MaklumatKursusMQA::create($item);
                    //    $counter++;
                    // } else {
                    //    break; // Break the loop after inserting 10 records
                    // }
                }
                return response()->json(['message' => 'Data inserted successfully'], 200);
            } else {
                return response()->json(['error' => 'Invalid API response format'], 500);
            }
            //untuk papar
            // foreach ($data['dataMQR'] as $item) {
            //     foreach ($item as $key => $value) {
            //         echo $key . ": " . $value . "<br>";
                    
            //     }
            //     echo "<br>"; // Add a line break between items
            // }
        } else {
            return response()->json(['error' => 'Unable to fetch data from API'], $response->status());
        }
    }

    public function test(){

        $kursus = Kursus::all()->sortBy('NamaProgBM');
        return view('mqa.maklumat_kursus', compact('kursus'));
    }

}