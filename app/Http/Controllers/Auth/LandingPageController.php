<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Hubungan;
use App\Models\JenisOku;
use App\Models\Keturunan;
use Illuminate\Http\Request;
use App\Models\Smoku;
use App\Models\TarikhIklan;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class LandingPageController extends Controller
{
    public function index()
    {   
       
        return view('pages.landing');
    }

   
    
    
}
