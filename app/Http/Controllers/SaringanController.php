<?php

namespace App\Http\Controllers;
use App\Mail\SaringanMail;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

    public function cetakMaklumatPemohon() 
    {
        $pdf = PDF::loadView('pages.saringan.cetakMaklumatPemohon');
        return $pdf->stream('maklumat-pemohon.pdf');
    }

    public function cetakSenaraiPemohon() 
    {
        $pdf = PDF::loadView('pages.saringan.cetakSenaraiPemohon');
        return $pdf->stream('senarai-pemohon.pdf');
    }

    public function saringMaklumat(Request $request) 
    {
        if($request->get('submit')=="Lengkap"){
            //
        }
        else if($request->get('submit')=="Simpan"){
            //
        }
        else if($request->get('submit')=="Kembalikan"){
            $catatan = [
                'catatan1'=>$request->get('catatan_profil_diri'), 
                'catatan2'=>$request->get('catatan_maklumat_akademik'), 
                'catatan3'=>$request->get('catatan_salinan_dokumen'),
            ];
            \Mail::to('ziba0506@gmail.com')->send(new SaringanMail($catatan));
            dd("Email is Sent.");
        }
    }

    public function dikembalikan(Request $request)
    {
        $data = [
            'catatan1'=>'John', 
            'catatan2'=>'Doe', 
            'catatan3'=>'john@doe.com',
        ];
        dd($data);
        \Mail::to('ziba0506@gmail.com')->send(new SaringanMail($data));
       
        dd("Email is Sent.");
    }
}
