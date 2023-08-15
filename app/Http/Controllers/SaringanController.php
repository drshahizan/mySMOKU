<?php

namespace App\Http\Controllers;
use App\Mail\SaringanMail;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\TuntutanPermohonan;
use App\Models\Waris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class SaringanController extends Controller
{
    public function saringan()
    {
        $permohonan = TuntutanPermohonan::join('statustransaksi','statustransaksi.id_permohonan','=','permohonan.id_permohonan')
        ->get(['permohonan.*', 'statustransaksi.*'])
        ->where('status','=','2');
        return view('pages.saringan.saringan',compact('permohonan'));
    }

    public function maklumatPemohon($id)
    {
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        return view('pages.saringan.maklumatPemohon',compact('permohonan','pelajar'));
    }

    public function maklumatPerbaharui()
    {
        return view('pages.saringan.maklumatPerbaharui');
    }

    public function maklumatProfilDiri($id)
    {
        $waris = Waris::where('nokp_pelajar', $id)->first();
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        return view('pages.saringan.maklumatProfilDiri',compact('waris','pelajar'));
    }

    public function maklumatAkademik($id)
    {
        $akademik = Akademik::where('nokp_pelajar', $id)->first();
        return view('pages.saringan.maklumatAkademik',compact('akademik'));
    }

    public function maklumatAkademik2()
    {
        return view('pages.saringan.maklumatAkademik2');
    }

    public function maklumatTuntutan()
    {
        return view('pages.saringan.maklumatTuntutan');
    }

    public function saringTuntutan(Request $request)
    {
        $permohonan = TuntutanPermohonan::all();
        return view('pages.saringan.saringan',compact('permohonan'));
    }

    public function salinanDokumen($id)
    {
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        return view('pages.saringan.salinanDokumen',compact('permohonan','pelajar'));
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

    public function saringMaklumat(Request $request,$id) 
    {
        if($request->get('maklumat_profil_diri')=="lengkap"&&$request->get('maklumat_akademik')=="lengkap"&&$request->get('salinan_dokumen')=="lengkap"){
            $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
            $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
            $status = "Permohonan Telah Disokong";
            return view('pages.saringan.maklumatTuntutan',compact('permohonan','pelajar','status'));
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
            $permohonan = TuntutanPermohonan::all();
            $status = "Permohonan Telah Dikembalikan";
            return view('pages.saringan.saringan',compact('permohonan','status'));
        }
    }

    //Tuntutan - Saring
    public function tuntutanSaring()
    {
        $permohonan = TuntutanPermohonan::all();
        return view('pages.saringan.tuntutanSaring',compact('permohonan'));
    }
}
