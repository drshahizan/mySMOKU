<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaringanController extends Controller
{
    public function saringan()
    {
        return view('pages.saringan.saringan');
    }
}
