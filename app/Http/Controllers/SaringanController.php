<?php

namespace App\Http\Controllers;
use App\Mail\SaringanMail;
use App\Models\Akademik;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\TuntutanPermohonan;
use App\Models\Waris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;


class SaringanController extends Controller
{
    public function saringan()
    {
        $permohonan = TuntutanPermohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();
        $status_kod=0;
        $status = null;
        return view('pages.saringan.saringan',compact('permohonan','status_kod','status'));
    }

    public function maklumatPemohon($id)
    {
        TuntutanPermohonan::where('nokp_pelajar', $id)
            ->update([
            'status'   =>  3,
        ]);
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

    public function saringTuntutan(Request $request,$id)
    {
        $id_permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->value('id_permohonan');
        $permohonan = TuntutanPermohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();
        $status_kod = 3;
        $status = "Permohonan dan tuntutan ".$id_permohonan." telah disaring dan disokong.";
        return view('pages.saringan.saringan',compact('permohonan','status_kod','status'));
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
            
            TuntutanPermohonan::where('nokp_pelajar', $id)
                ->update([
                'status'   =>  4,
            ]);
            
            $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
            $id_permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->value('id_permohonan');
            $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
            $status_kod = 1;
            $status = "Permohonan ".$id_permohonan." telah disaring dan disokong.";
            return view('pages.saringan.maklumatTuntutan',compact('permohonan','pelajar','status_kod','status'));
        }
        else{
            $catatan[]="";
            $profil="";
            $akademik = "";
            $salinan="";
            $n=0;
            if($request->get('maklumat_profil_diri')=="tak_lengkap"){
                $checked = $request->input('catatan_maklumat_profil_diri');
                for($i=0; $i < count($checked); $i++){
                    $catatan[$n]=$checked[$i];
                    $profil= $profil . $checked[$i] . ",";
                    $n++;
                }
            }
    
            if($request->get('maklumat_akademik')=="tak_lengkap"){
                $checked = $request->input('catatan_maklumat_akademik');
                for($i=0; $i < count($checked); $i++){
                    $catatan[$n]=$checked[$i];
                    $akademik = $akademik . $checked[$i] . ",";
                    $n++;
                }
            }
    
            if($request->get('salinan_dokumen')=="tak_lengkap"){
                $checked = $request->input('catatan_salinan_dokumen');
                for($i=0; $i < count($checked); $i++){
                    $catatan[$n]=$checked[$i];
                    $salinan = $salinan . $checked[$i] . ",";
                    $n++;
                }
            }
            Mail::to('ziba0506@gmail.com')->send(new SaringanMail($catatan));
            $id_permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->value('id_permohonan');
            
            $catatan = new Saringan([
                'id_permohonan'           =>  $id_permohonan,
                'catatan_profilDiri'      =>  $profil,
                'catatan_akademik'        =>  $akademik,
                'catatan_salinanDokumen'  =>  $salinan,
            ]);
            $catatan->save();

            TuntutanPermohonan::where('nokp_pelajar', $id)
                ->update([
                'status'   =>  5,
            ]);

            $permohonan = TuntutanPermohonan::where('status', '2')
            ->orWhere('status', '=','3')
            ->orWhere('status', '=','4')
            ->orWhere('status', '=','5')
            ->get();
            
            $status_kod = 2;
            $status = "Permohonan ".$id_permohonan." telah dikembalikan.";
            return view('pages.saringan.saringan',compact('permohonan','status_kod','status'));
        }
    }

    public function permohonanTelahDisaring($id){
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $id_permohonan = $permohonan->id_permohonan;
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        $catatan = Saringan::where('id_permohonan', $id_permohonan)->first();
        return view('pages.saringan.permohonanTelahDisaring',compact('permohonan','catatan','pelajar'));
    }

    public function tuntutanTelahDisaring($id){
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        return view('pages.saringan.tuntutanTelahDisaring',compact('permohonan','pelajar'));
    }
}
