<?php

namespace App\Http\Controllers;
use App\Mail\SaringanMail;
use App\Models\Akademik;
use App\Models\ButiranPelajar;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\SejarahPermohonan;
use App\Models\Smoku;
use App\Models\Status;
use App\Models\Waris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Mail;


class SaringanController extends Controller
{
    public function senaraiPermohonan()
    {
        $permohonan = Permohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();
        $status_kod=0;
        $status = null;
        return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status'));
    }

    public function maklumatPermohonan($id)
    {
        Permohonan::where('id', $id)
            ->update([
            'status'   =>  3,
        ]);

        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

        $status_rekod = new SejarahPermohonan([
            'smoku_id'      =>  $smoku_id,
            'permohonan_id' =>  $id,
            'status'        =>  3,
        ]);
        $status_rekod->save();

        $permohonan = Permohonan::where('id', $id)->first();
        $pelajar = ButiranPelajar::where('smoku_id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $smoku = Smoku::where('id', $smoku_id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_permohonan',compact('permohonan','pelajar','akademik','smoku'));
    }

    public function maklumatProfilDiri($id)
    {
        $waris = Waris::where('smoku_id', $id)->first();
        $pelajar = ButiranPelajar::where('smoku_id', $id)->first();
        $smoku = Smoku::where('id', $id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_profil_diri',compact('waris','pelajar','smoku'));
    }

    public function maklumatAkademik($id)
    {
        $akademik = Akademik::where('smoku_id', $id)->first();
        $smoku = Smoku::where('id', $id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_akademik',compact('akademik','smoku'));
    }

    public function maklumatTuntutan()
    {
        return view('permohonan.sekretariat.saringan.maklumat_tuntutan');
    }

    public function saringTuntutan(Request $request,$id)
    {
        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();
        $status_kod = 3;
        $status = "Permohonan dan tuntutan ".$no_rujukan_permohonan." telah disaring dan disokong.";
        return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status'));
    }

    public function saringPermohonan(Request $request,$id)
    {
        if($request->get('maklumat_profil_diri')=="lengkap"&&$request->get('maklumat_akademik')=="lengkap"&&$request->get('salinan_dokumen')=="lengkap"){

            Permohonan::where('id', $id)
                ->update([
                'status'   =>  4,
            ]);

            $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

            $status_trans = new Status([
                'smoku_id'      =>  $smoku_id,
                'permohonan_id' =>  $id,
                'status'        =>  4,
            ]);
            $status_trans->save();

            $permohonan = Permohonan::where('id', $id)->first();
            $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
            $smoku = Smoku::where('id', $smoku_id)->first();
            return view('permohonan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','pelajar'));
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
            $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');

            $catatan = new Saringan([
                'id_permohonan'           =>  $no_rujukan_permohonan,
                'catatan_profilDiri'      =>  $profil,
                'catatan_akademik'        =>  $akademik,
                'catatan_salinanDokumen'  =>  $salinan,
            ]);
            $catatan->save();

            $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
            Permohonan::where('id', $id)
                ->update([
                'status'   =>  5,
            ]);

            $status_rekod = new SejarahPermohonan([
                'smoku_id'      =>  $smoku_id,
                'permohonan_id' =>  $id,
                'status'        =>  5,
            ]);
            $status_rekod->save();

            $permohonan = Permohonan::where('status', '2')
            ->orWhere('status', '=','3')
            ->orWhere('status', '=','4')
            ->orWhere('status', '=','5')
            ->get();

            $status_kod = 2;
            $status = "Permohonan ".$no_rujukan_permohonan." telah dikembalikan.";
            return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status'));
        }
    }

    public function paparPermohonan($id){
        $permohonan = ermohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $pelajar = ButiranPelajar::where('smoku_id', $smoku_id)->first();
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $id)->first();
        return view('permohonan.sekretariat.saringan.papar_permohonan',compact('permohonan','catatan','pelajar','smoku'));
    }

    public function paparTuntutan($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $pelajar = ButiranPelajar::where('smoku_id', $id)->first();
        $smoku = Smoku::where('id', $id)->first();
        return view('permohonan.sekretariat.saringan.papar_tuntutan',compact('permohonan','pelajar','smoku'));
    }

    public function sejarahPermohonan(){
        $permohonan = Permohonan::all();
        return view('permohonan.sekretariat.sejarah.sejarah_permohonan',compact('permohonan'));
    }
}
