<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TarikhIklan;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{

    public function index(Request $request)
    {   
        $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
        $catatan = $iklan->catatan ?? "";
        // Log::info('Catatan: ' . $catatan); // Log the content of $catatan
        return view('pages.landing',compact('catatan'));// CATATAN
    }   
}
