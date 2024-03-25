<?php

namespace App\Http\Controllers;

use App\Exports\Penyaluran;
use App\Mail\SaringanMail;
use App\Models\Akademik;
use App\Models\ButiranPelajar;
use App\Models\Dokumen;
use App\Models\EmelKemaskini;
use App\Models\InfoIpt;
use App\Models\JumlahTuntutan;
use App\Models\Kelulusan;
use App\Models\Negeri;
use App\Models\Peperiksaan;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\SejarahPermohonan;
use App\Models\Smoku;
use App\Models\Status;
use App\Models\Waris;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SaringanController extends Controller
{
    public function senaraiPermohonan(Request $request)
    {
        $status_kod=0;
        $status = null;

        $permohonan = Permohonan::whereIn('status', ['2','3','4','5'])->orderBy('tarikh_hantar', 'desc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA', 'institusiPengajianPPK'));
    }

    public function maklumatPermohonan($id)
    {
        Permohonan::where('id', $id)
            ->update([
            'status'   =>  3,
        ]);

        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

        $status_rekod = new SejarahPermohonan([
            'smoku_id'          =>  $smoku_id,
            'permohonan_id'     =>  $id,
            'status'            =>  3,
            'dilaksanakan_oleh'    =>  Auth::user()->id,
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
            'smoku_id'          =>  $smoku_id,
            'permohonan_id'     =>  $id,
            'status'            =>  3,
            'dilaksanakan_oleh'    =>  Auth::user()->id,
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

    public function setSemulaStatus(Request $request, $id){
        Permohonan::where('id', $id)
            ->update([
                'status'   =>  2,
            ]);

        $permohonan = Permohonan::where('id',$id)->first();
        $status_rekod = new SejarahPermohonan([
            'smoku_id'          =>  $permohonan->smoku_id,
            'permohonan_id'     =>  $id,
            'status'            =>  2,
        ]);
        $status_rekod->save();

        $status_kod=0;
        $status = null;

        //filter
        $filters = $request->only(['institusi']);

        $query = Permohonan::select('permohonan.*')
            ->where(function ($query) {
                $query->where('permohonan.status', '=', '2')
                    ->orWhere('permohonan.status', '=', '3')
                    ->orWhere('permohonan.status', '=', '4')
                    ->orWhere('permohonan.status', '=', '5');
            });

        if (isset($filters['institusi'])) {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }

        $permohonan = $query->orderBy('tarikh_hantar', 'desc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPPK = InfoIpt::where('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK','institusiUA','institusiPPK'));
    }

    public function maklumatProfilDiri($id)
    {
        $smoku_id = Permohonan::orderby("id","desc")->where('id', $id)->value('smoku_id');
        $waris = Waris::where('smoku_id', $smoku_id)->first();
        $pelajar = ButiranPelajar::where('smoku_id', $smoku_id)->first();
        $smoku = Smoku::where('id', $smoku_id)->first();
        return view('permohonan.sekretariat.saringan.maklumat_profil_diri',compact('waris','pelajar','smoku'));
    }

    public function maklumatAkademik($id)
    {
        $permohonan = Permohonan::orderby("id","desc")->where('id', $id)->first();
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
            'smoku_id'          =>  $smoku_id,
            'permohonan_id'     =>  $id,
            'status'            =>  4,
            'dilaksanakan_oleh' =>  Auth::user()->id,
        ]);
        $status_rekod->save();

        //filter
        $filters = $request->only(['institusi']);
        $query = Permohonan::select('permohonan.*')
                    ->where(function ($query) {
                        $query->where('permohonan.status', '=', '2')
                            ->orWhere('permohonan.status', '=', '3')
                            ->orWhere('permohonan.status', '=', '4')
                            ->orWhere('permohonan.status', '=', '5');
                    });
        if (isset($filters['institusi'])) {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }
        $permohonan = $query->orderBy('tarikh_hantar', 'desc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        //notifikasi
        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $status_kod = 3;
        $status = "Permohonan dan tuntutan ".$no_rujukan_permohonan." telah disaring dan disokong.";

        return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));
    }

    public function saringPermohonan(Request $request,$id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
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

            // COMMENT PROD
            $smoku_emel =Smoku::where('id', $permohonan->smoku_id)->value('email');
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
                'smoku_id'          =>  $smoku_id,
                'permohonan_id'     =>  $id,
                'status'            =>  5,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            //notifikasi
            $status_kod = 2;
            $status = "Permohonan ".$no_rujukan_permohonan." telah dikembalikan.";

            //filter
            $filters = $request->only(['institusi']); // Adjust the filter names as per your form
            $query = Permohonan::select('permohonan.*')
                ->where(function ($query) {
                    $query->where('permohonan.status', '=', '2')
                        ->orWhere('permohonan.status', '=', '3')
                        ->orWhere('permohonan.status', '=', '4')
                        ->orWhere('permohonan.status', '=', '5');
                });

            if (isset($filters['institusi'])) {
                $selectedInstitusi = $filters['institusi'];
                $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                    ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                    ->where('smoku_akademik.id_institusi', $selectedInstitusi);
            }

            $permohonan = $query->orderBy('tarikh_hantar', 'desc')->get();

            $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
            $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
            $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
            $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
            $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

            return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));
        }
    }

    public function saringPermohonanDiperbaharui(Request $request,$id)
    {
        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('id', $id)->first();
        
        if($request->get('maklumat_akademik')=="lengkap"){

            $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
            Permohonan::where('id', $id)
                ->update([
                    'status'   =>  4,
                ]);

            $status_rekod = new SejarahPermohonan([
                'smoku_id'          =>  $smoku_id,
                'permohonan_id'     =>  $id,
                'status'            =>  4,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            //notifikasi
            $status_kod = 3;
            $status = "Permohonan ".$no_rujukan_permohonan." telah disokong.";

            //filter table
            $filters = $request->only(['institusi']); // Adjust the filter names as per your form
            $query = Permohonan::select('permohonan.*')
                ->where(function ($query) {
                    $query->where('permohonan.status', '=', '2')
                        ->orWhere('permohonan.status', '=', '3')
                        ->orWhere('permohonan.status', '=', '4')
                        ->orWhere('permohonan.status', '=', '5');
                });

            if (isset($filters['institusi'])) {
                $selectedInstitusi = $filters['institusi'];
                $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                    ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                    ->where('smoku_akademik.id_institusi', $selectedInstitusi);
            }
            $permohonan = $query->orderBy('tarikh_hantar', 'desc')->get();

            $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
            $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
            $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
            $institusiUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
            $institusiPPK = InfoIpt::where('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

            return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiUA','institusiPPK'));
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

            // COMMENT PROD
            $smoku_emel =Smoku::where('id', $permohonan->smoku_id)->value('email');
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
                'smoku_id'          =>  $smoku_id,
                'permohonan_id'     =>  $id,
                'status'            =>  5,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            //notifikasi
            $status_kod = 2;
            $status = "Permohonan ".$no_rujukan_permohonan." telah dikembalikan.";

            //filter table
            $filters = $request->only(['institusi']); // Adjust the filter names as per your form
            $query = Permohonan::select('permohonan.*')
                ->where(function ($query) {
                    $query->where('permohonan.status', '=', '2')
                        ->orWhere('permohonan.status', '=', '3')
                        ->orWhere('permohonan.status', '=', '4')
                        ->orWhere('permohonan.status', '=', '5');
                });

            if (isset($filters['institusi'])) {
                $selectedInstitusi = $filters['institusi'];
                $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                    ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                    ->where('smoku_akademik.id_institusi', $selectedInstitusi);
            }
            $permohonan = $query->orderBy('tarikh_hantar', 'desc')->get();

            $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
            $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
            $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
            $institusiUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
            $institusiPPK = InfoIpt::where('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

            return view('permohonan.sekretariat.saringan.senarai_permohonan',compact('permohonan','status_kod','status','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiUA','institusiPPK'));
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
        $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $sejarah_p = SejarahPermohonan::where('id', $id)->where('status',4)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('permohonan.sekretariat.saringan.papar_tuntutan',compact('permohonan','akademik','smoku','sejarah_p','j_tuntutan'));
    }

    public function sejarahPermohonan(Request $request)
    {
        $permohonan = Permohonan::where('status', '!=','1')->orderBy('tarikh_hantar', 'desc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('permohonan.sekretariat.sejarah.sejarah_permohonan',compact('permohonan', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA', 'institusiPengajianPPK'));
    }

    public function getDataSejarahIPTS()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'IPTS');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getDataSejarahPOLI()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'P');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getDataSejarahKK()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'KK');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getDataSejarahUA()
    {
        $permohonanUA = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'UA');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();


        return response()->json($permohonanUA);
    }

    public function getDataSejarahPPK()
    {
        $permohonanPPK = Permohonan::where('program', 'PPK')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt');
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();


        return response()->json($permohonanPPK);
    }

    public function rekodPermohonan($id)
    {
        $permohonan = Permohonan::orderBy('id', 'DESC')->where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        $sejarah_p = SejarahPermohonan::where('permohonan_id', $id)->orderBy('created_at', 'desc')->get();

        return view('permohonan.sekretariat.sejarah.rekod_permohonan',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function paparRekodPermohonan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.sejarah.papar_permohonan',compact('permohonan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodSaringan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.sejarah.papar_saringan',compact('j_tuntutan','permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function paparRekodPembayaran($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = Permohonan::where('id', $sejarah_p->permohonan_id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.sejarah.papar_pembayaran',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function paparRekodKelulusan($id)
    {
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $kelulusan = Kelulusan::where('permohonan_id', $sejarah_p->permohonan_id)->first();

        return view('permohonan.sekretariat.sejarah.papar_kelulusan',compact('permohonan','kelulusan','smoku','sejarah_p'));
    }

    //Kemaskini Sejarah Saringan
    public function kemaskiniSaringan($id)
    {
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

    public function hantarSaringan(Request $request,$id)
    {
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
        $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();

        return view('permohonan.sekretariat.sejarah.papar_saringan',compact('j_tuntutan','permohonan','catatan','smoku','akademik','sejarah_p'));
    }

    public function kemaskiniSaringanP($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.saringan.kemaskini_saringan',compact('permohonan','smoku','akademik'));
    }

    //Kemaskini Permohonan - Saringan
    public function hantarSaringanP(Request $request,$id)
    {
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
    public function senaraiPembayaran(Request $request)
    {
        $permohonan = Permohonan::where('status', '8')->orderBy('tarikh_hantar', 'desc')->get();
        $status_kod=0;
        $status = null;

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('permohonan.sekretariat.pembayaran.senarai',compact('permohonan','status_kod','status', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA', 'institusiPengajianPPK'));
    }

    public function getPembayaranPermohonanIPTS()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'IPTS');
                        });
                    })
                    ->where('status', 8)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getPembayaranPermohonanPOLI()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'P');
                        });
                    })
                    ->where('status', 8)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getPembayaranPermohonanKK()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'KK');
                        });
                    })
                    ->where('status', 8)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getPembayaranPermohonanUA()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'UA');
                        });
                    })
                    ->where('status', 8)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();


        return response()->json($permohonan);
    }

    public function getPembayaranPermohonanPPK()
    {
        $permohonanPPK = Permohonan::where('program', 'PPK')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt');
                    })
                    ->where('status', 8)                    
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku', 'tuntutan'])
                    ->get();


        return response()->json($permohonanPPK);
    }

    public function cetakSenaraiPenyaluranExcel(Request $request, $programCode)
    {
        $institusi = $request->input('institusi');

        return Excel::download(new Penyaluran($programCode, $institusi), 'SenaraiPenyaluran.xlsx');
    }

    public function kemaskiniInfoCek(Request $request)
    {
        // Get the selected item IDs from the form
        $selectedItemIds = $request->input('selected_items');

        if ($selectedItemIds !== null)
        {
            foreach ($selectedItemIds as $itemId){

                $permohonan = Permohonan::orderBy('id', 'desc')->where('id', '=', $itemId)->first();
                if ($permohonan != null) {
                    Permohonan::where('id' ,$itemId)
                    ->update([
                        'no_cek' => $request->noCek,
                        'tarikh_transaksi' => $request->tarikhTransaksi,

                    ]);

                }
            }
        }

        return back()->with('success', 'No Cek dan Tarikh Transaksi berjaya dikemaskini');
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
            'smoku_id'          =>  $smoku_id,
            'permohonan_id'     =>  $id,
            'status'            =>  8,
            'dilaksanakan_oleh' =>  Auth::user()->id,
        ]);
        $status_rekod->save();

        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('status', '8')->orderBy('created_at', 'DESC')->get();
        $status_kod = 3;
        $status = "Permohonan ".$no_rujukan_permohonan." telah dibayar.";

        return view('permohonan.sekretariat.pembayaran.senarai',compact('permohonan','status_kod','status'));
    }

    public function paparPembayaran($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        $secretKey = 't73QYeipBMmHcDuzGAcNSXP_bgbOFXMyLM99OARs';

        return view('permohonan.sekretariat.pembayaran.papar',compact('permohonan','secretKey','akademik','smoku'));
    }

    public function kemaskiniPembayaran($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('permohonan.sekretariat.pembayaran.kemaskini',compact('permohonan','smoku','akademik'));
    }

    public function hantarPembayaran(Request $request,$id)
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
            ]);

        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('status', '8')->orderBy('created_at', 'DESC')->get();
        $status_kod = 3;
        $status = "Pembayaran ".$no_rujukan_permohonan." telah dikemaskini.";
        
        return view('permohonan.sekretariat.pembayaran.senarai',compact('permohonan','status_kod','status'));
    }

    public function returnToPenyelaras(Request $request)
    {
        $itemId = $request->input('item_id'); // Assuming you send 'item_id' in your AJAX request

        if ($itemId !== null) {
            $permohonan = Permohonan::orderBy('id', 'desc')->where('id', '=', $itemId)->first();

            if ($permohonan != null) {
                Permohonan::where('id', $itemId)->update([
                    'status' => 6,
                ]);

                $mohon = SejarahPermohonan::create([
                    'permohonan_id' => $permohonan->id,
                    'smoku_id' => $permohonan->smoku_id,
                    'status' => 6,
                ]);

                $mohon->save();
            }

            return response()->json(['message' => 'Permohonan telah dikembalikan.']);
        }

        return response()->json(['message' => 'Invalid item ID.'], 400);
    }

}
