<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\TarikhIklan;

class LandingPageController extends Controller
{

    public function index()
    {   
        $iklan = TarikhIklan::orderBy('created_at', 'desc')->first();
        $catatan = $iklan->catatan ?? "";

        return view('pages.landing', compact('catatan'));
    }   
}
