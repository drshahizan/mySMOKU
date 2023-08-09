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

    public function maklumatPerbaharui()
    {
        return view('pages.saringan.maklumatPerbaharui');
    }

    public function maklumatProfilDiri()
    {
        return view('pages.saringan.maklumatProfilDiri');
    }

    public function maklumatAkademik()
    {
        return view('pages.saringan.maklumatAkademik');
    }

    public function maklumatAkademik2()
    {
        return view('pages.saringan.maklumatAkademik2');
    }

    public function salinanDokumen()
    {
        return view('pages.saringan.salinanDokumen');
    }

    public function salinanInvois()
    {
        return view('pages.saringan.salinanInvois');
    }

    public function salinanAkademik()
    {
        return view('pages.saringan.salinanAkademik');
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
        if($request->get('maklumat_profil_diri')=="lengkap"&&$request->get('maklumat_akademik')=="lengkap"&&$request->get('salinan_dokumen')=="lengkap"){
            
        }
        else{
            if($request->get('maklumat_profil_diri')=="tak_lengkap"){
                $catatan1=$request->get('catatan_profil_diri');
            }
            else{
                $catatan1=null;
            }
    
            if($request->get('maklumat_akademik')=="tak_lengkap"){
                $catatan2=$request->get('catatan_maklumat_akademik');
            }
            else{
                $catatan2=null;
            }
    
            if($request->get('salinan_dokumen')=="tak_lengkap"){
                $catatan3=$request->get('catatan_salinan_dokumen');
            }
            else{
                $catatan3=null;
            }
    
            $catatan = [
                'catatan1'=>$catatan1, 
                'catatan2'=>$catatan2, 
                'catatan3'=>$catatan3,
            ];
            \Mail::to('ziba0506@gmail.com')->send(new SaringanMail($catatan));
        }
    }
}
