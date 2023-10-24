<?php

namespace App\Http\Controllers;

use App\Models\MaklumatKursusMQA;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class MaklumatKursusController extends Controller
{
    public function index()
    {
        $response = Http::post('http://10.29.216.151/api/bkoku/request-MQR');

        if ($response->successful()) {
            $data = json_decode($response->body(), true);

            // if (isset($data['dataMQR'])) {
            //     foreach ($data['dataMQR'] as $item) {
            //         MaklumatKursusMQA::create($item); // Assuming $item is an associative array containing your data
            //     }
            //     return response()->json(['message' => 'Data inserted successfully'], 200);
            // } else {
            //     return response()->json(['error' => 'Invalid API response format'], 500);
            // }
            foreach ($data['dataMQR'] as $item) {
                foreach ($item as $key => $value) {
                    echo $key . ": " . $value . "<br>";
                    
                }
                echo "<br>"; // Add a line break between items
            }
        } else {
            return response()->json(['error' => 'Unable to fetch data from API'], $response->status());
        }
    }

}