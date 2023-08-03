<?php

namespace App\Http\Controllers;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class SaringanController extends Controller
{
    public function saringan()
    {
        return view('pages.saringan.saringan');
    }

    // public function maklumatPemohon($id)
    // {
    //     $id="PHDBKOKU000021";
    //     $permohonan = Permohonan::where('id_permohonan', $id)->orderBy('id', 'ASC')->get();
    //     return view('pages.saringan.maklumatPemohon',compact('permohonan'));
    // }

    public function maklumatPemohon()
    {
        return view('pages.saringan.maklumatPemohon');
    }

    public function maklumatProfilDiri()
    {
        return view('pages.saringan.maklumatProfilDiri');
    }

    public function maklumatAkademik()
    {
        return view('pages.saringan.maklumatAkademik');
    }

    public function salinanDokumen()
    {
        return view('pages.saringan.salinanDokumen');
    }
}
