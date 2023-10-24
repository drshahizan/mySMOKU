<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class MaklumatKursusController extends Controller
{


public function index(Request $request)
{
    $client = new Client();
    $url = 'http://10.29.216.151/api/bkoku/request-MQR';

    try {
        $response = $client->get($url);
        $statusCode = $response->getStatusCode();
        $data = json_decode($response->getBody()->getContents(), true);

        if ($statusCode == 200 && isset($data['data'])) {
            $dataField = $data['data'];
            dd($dataField);
        } else {
            // Handle unexpected response status code or missing 'data' field
            // You might want to log an error or return an appropriate response.
        }
    } catch (RequestException $e) {
        if ($e->hasResponse()) {
            $statusCode = $e->getResponse()->getStatusCode();
            // Handle different response status codes here, e.g., 405 Method Not Allowed
        } else {
            // Handle other request exceptions
        }
    }
}

}
