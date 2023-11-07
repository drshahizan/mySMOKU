<?php

namespace App\Http\Controllers;
use App\Mail\SaringanMail;
use App\Models\Akademik;
use App\Models\ButiranPelajar;
use App\Models\Dokumen;
use App\Models\EmelKemaskini;
use App\Models\JumlahTuntutan;
use App\Models\Kelulusan;
use App\Models\Peperiksaan;
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

        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        $smoku = Smoku::where('id', $smoku_id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_permohonan',compact('permohonan','pelajar','akademik','smoku'));
    }

    public function maklumatPermohonanDiperbaharui($id)
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
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        $smoku = Smoku::where('id', $smoku_id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_permohonan_diperbaharui',compact('permohonan','pelajar','akademik','smoku'));
    }

    public function maklumatProfilDiri($id)
    {
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $waris = Waris::where('smoku_id', $smoku_id)->first();
        $pelajar = ButiranPelajar::where('smoku_id', $smoku_id)->first();
        $smoku = Smoku::where('id', $smoku_id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_profil_diri',compact('waris','pelajar','smoku'));
    }

    public function maklumatAkademik($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $permohonan->smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.saringan.maklumat_akademik',compact('akademik',));
    }

    public function salinanDokumen($id)
    {
        $dokumen = Dokumen::where('permohonan_id', $id)->get();
        return view('permohonan.sekretariat.saringan.salinan_dokumen',compact('dokumen'));
    }

    public function saringTuntutan(Request $request,$id)
    {
        Permohonan::where('id', $id)
            ->update([
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki'                  =>  $request->get('baki'),
                'baki_disokong'         =>  $request->get('baki_disokong'),
                'catatan_disokong'      =>  $request->get('catatan'),
                'status'                =>  4,
            ]);

        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

        $status_rekod = new SejarahPermohonan([
            'smoku_id'      =>  $smoku_id,
            'permohonan_id' =>  $id,
            'status'        =>  4,
        ]);
        $status_rekod->save();

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
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_emel =Smoku::where('id', $permohonan->smoku_id)->value('email');
        if($request->get('maklumat_profil_diri')=="lengkap"&&$request->get('maklumat_akademik')=="lengkap"&&$request->get('salinan_dokumen')=="lengkap"){

            $permohonan = Permohonan::where('id', $id)->first();
            $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
            $smoku = Smoku::where('id', $smoku_id)->first();
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
            $peringkat = $rujukan[1];
            $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
            return view('permohonan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','smoku','akademik','j_tuntutan'));
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

            $program = Permohonan::where('id', $id)->value('program');
            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',1)->first();
                Mail::to($smoku_emel)->send(new SaringanMail($catatan,$emel));
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',7)->first();
                Mail::to($smoku_emel)->send(new SaringanMail($catatan,$emel));
            }

            $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');

            $catatan = new Saringan([
                'permohonan_id'            =>  $id,
                'no_rujukan_saringan'      =>  $no_rujukan_permohonan,
                'catatan_profil_diri'      =>  $profil,
                'catatan_akademik'         =>  $akademik,
                'catatan_salinan_dokumen'  =>  $salinan,
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

    public function saringPermohonanDiperbaharui(Request $request,$id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_emel =Smoku::where('id', $permohonan->smoku_id)->value('email');
        if($request->get('maklumat_akademik')=="lengkap"){

            $permohonan = Permohonan::where('id', $id)->first();
            $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
            $smoku = Smoku::where('id', $smoku_id)->first();
            $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
            return view('permohonan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','smoku','akademik'));
        }
        else{
            $catatan[]="";
            $profil="";
            $akademik = "";
            $salinan="";
            $n=0;

            if($request->get('maklumat_akademik')=="tak_lengkap"){
                $checked = $request->input('catatan_maklumat_akademik');
                for($i=0; $i < count($checked); $i++){
                    $catatan[$n]=$checked[$i];
                    $akademik = $akademik . $checked[$i] . ",";
                    $n++;
                }
            }
            $program = Permohonan::where('id', $id)->value('program');

            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',1)->first();
                Mail::to($smoku_emel)->send(new SaringanMail($catatan,$emel));
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',7)->first();
                Mail::to($smoku_emel)->send(new SaringanMail($catatan,$emel));
            }

            $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');

            $catatan = new Saringan([
                'permohonan_id'            =>  $id,
                'no_rujukan_saringan'      =>  $no_rujukan_permohonan,
                'catatan_akademik'         =>  $akademik,
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
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.saringan.papar_permohonan',compact('permohonan','catatan','smoku','akademik'));
    }

    public function paparPermohonanDiperbaharui($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.saringan.papar_permohonan_diperbaharui',compact('permohonan','catatan','smoku','akademik'));
    }

    public function paparTuntutan($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $sejarah_p = SejarahPermohonan::where('id', $id)->where('status',4)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.saringan.papar_tuntutan',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function sejarahPermohonan(){
        $permohonan = Permohonan::all();
        return view('permohonan.sekretariat.sejarah.sejarah_permohonan',compact('permohonan'));
    }

    public function rekodPermohonan($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        $sejarah_p = SejarahPermohonan::where('permohonan_id', $id)->orderBy('created_at', 'desc')->get();
        return view('permohonan.sekretariat.sejarah.rekod_permohonan',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function paparRekodPermohonan($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.sejarah.papar_permohonan',compact('permohonan','smoku','akademik','sejarah_p'));
    }
    public function paparRekodSaringan($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.sejarah.papar_saringan',compact('permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodPembayaran($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = Permohonan::where('id', $sejarah_p->permohonan_id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.sejarah.papar_pembayaran',compact('permohonan','akademik','smoku','sejarah_p'));
    }
    public function paparRekodKelulusan($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $kelulusan = Kelulusan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        return view('permohonan.sekretariat.sejarah.papar_kelulusan',compact('permohonan','kelulusan','smoku','sejarah_p'));
    }

    //Kemaskini Sejarah Saringan
    public function kemaskiniSaringan($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.sejarah.kemaskini_saringan',compact('permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function hantarSaringan(Request $request,$id){
        $p_id = SejarahPermohonan::where('id', $id)->value('permohonan_id');
        Permohonan::where('id', $p_id)
            ->update([
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki_disokong'         =>  $request->get('baki_disokong'),
            ]);

        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.sejarah.papar_saringan',compact('permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function kemaskiniSaringanP($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.saringan.kemaskini_saringan',compact('permohonan','smoku','akademik'));
    }

    //Kemaskini Permohonan - Saringan
    public function hantarSaringanP(Request $request,$id){
        Permohonan::where('id', $id)
            ->update([
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki_disokong'         =>  $request->get('baki_disokong'),
            ]);

        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.saringan.papar_tuntutan',compact('permohonan','smoku','akademik'));
    }

    //pembayaran
    public function senaraiPembayaran()
    {
        $permohonan = Permohonan::where('status', '8')->get();
        $status_kod=0;
        $status = null;
        return view('permohonan.sekretariat.pembayaran.senarai',compact('permohonan','status_kod','status'));
    }

    public function maklumatPembayaran($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.pembayaran.maklumat_pembayaran',compact('permohonan','smoku','akademik'));
    }

    public function saringPembayaran(Request $request,$id)
    {
        Permohonan::where('id', $id)
            ->update([
                'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_dibayar'     =>  $request->get('w_saku_dibayar'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki'                  =>  $request->get('baki'),
                'baki_disokong'         =>  $request->get('baki_disokong'),
                'baki_dibayar'          =>  $request->get('baki_dibayar'),
                'catatan_dibayar'       =>  $request->get('catatan'),
                'status'                =>  8,
            ]);

        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

        $status_rekod = new SejarahPermohonan([
            'smoku_id'      =>  $smoku_id,
            'permohonan_id' =>  $id,
            'status'        =>  8,
        ]);
        $status_rekod->save();

        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('status', '8')->get();
        $status_kod = 3;
        $status = "Permohonan ".$no_rujukan_permohonan." telah dibayar.";
        return view('permohonan.sekretariat.pembayaran.senarai',compact('permohonan','status_kod','status'));
    }

    public function paparPembayaran($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.pembayaran.papar',compact('permohonan','akademik','smoku'));
    }

    public function kemaskiniPembayaran($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.pembayaran.kemaskini',compact('permohonan','smoku','akademik'));
    }

    public function hantarPembayaran(Request $request,$id){
        Permohonan::where('id', $id)
            ->update([
                'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_dibayar'     =>  $request->get('w_saku_dibayar'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki'                  =>  $request->get('baki'),
                'baki_disokong'         =>  $request->get('baki_disokong'),
                'baki_dibayar'          =>  $request->get('baki_dibayar'),
                'catatan_dibayar'       =>  $request->get('catatan'),
            ]);

        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('status', '8')->get();
        $status_kod = 3;
        $status = "Pembayaran ".$no_rujukan_permohonan." telah dikemaskini.";
        return view('permohonan.sekretariat.pembayaran.senarai',compact('permohonan','status_kod','status'));
    }
}
