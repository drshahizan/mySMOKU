<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\TuntutanPermohonan;

class PermohonanController extends Controller
{
    public function permohonan()
    {
        return view('pages.permohonan.permohonan-baru');
    }

    public function postPermohonan(Request $request)
    {  
        $request->validate([
			'nama_pelajar' => 'required',
			'nokp_pelajar' => 'required|unique:pelajar',
			//'noJKM' => 'required',
           // 'no_akaunbank' => 'required',
           // 'emel' => 'required'
            
        ]);

        $data = $request->all();
        $check = $this->create($data);

        /*$request->validate([
			'nama_waris' => 'required',
			'nokp_waris' => 'required|unique:waris',
            'pendapatan' => 'required'
            
        ]);

        $data = $request->all();
        $check = $this->create($data);*/

        return view('pages.dashboards.index');
        //return redirect()->back();
    }

    public function create(array $data)
    {
        $user = Permohonan::create($data);
        $user->nama_pelajar = $data['nama_pelajar'];
        $user->nokp_pelajar = $data['nokp_pelajar'];
        $user->tkh_lahir = $data['tkh_lahir'];
        $user->umur = $data['umur'];
        $user->jantina = $data['jantina'];
        $user->noJKM = $data['noJKM'];
        $user->kecacatan = $data['kecacatan'];
        $user->bangsa = $data['bangsa'];
        $user->alamat1 = $data['alamat1'];
        $user->alamat_poskod = $data['alamat_poskod'];
        $user->alamat_negeri = $data['alamat_negeri'];
        $user->dun = $data['bandar'];
        $user->no_tel = $data['no_tel'];
        $user->no_telR = $data['no_telR'];
        $user->no_akaunbank = $data['no_akaunbank'];
        $user->emel = $data['emel'];

        $user = Waris::create($data);
        $user->nama_waris = $data['nama_waris'];
        $user->nokp_waris = $data['nokp_waris'];
        $user->alamat1 = $data['alamatW1'];
        $user->alamat_poskod = $data['alamatW_poskod'];
        $user->alamat_bandar = $data['alamatW_bandar'];
        $user->alamat_negeri = $data['alamatW_negeri'];
        $user->no_tel = $data['no_telW'];
        $user->no_telR = $data['no_telRW'];
        $user->nokp_pelajar = $data['nokp_pelajar'];
        $user->hubungan = $data['hubungan'];
        $user->pendapatan = $data['pendapatan'];

        $user = Akademik::create($data);
        $user->no_pendaftaranpelajar = $data['no_pendaftaranpelajar'];
        $user->nokp_pelajar = $data['nokp_pelajar'];
        $user->peringkat_pengajian = $data['peringkat_pengajian'];
        $user->nama_kursus = $data['nama_kursus'];
        $user->id_institusi = $data['id_institusi'];
        $user->tkh_mula = $data['tkh_mula'];
        $user->tkh_tamat = $data['tkh_tamat'];
        $user->sem_semasa = $data['sem_semasa'];
        $user->tempoh_pengajian = $data['tempoh_pengajian'];
        $user->bil_bulanpersem = $data['bil_bulanpersem'];
        $user->cgpa = $data['cgpa'];
        $user->sumber_biaya = $data['sumber_biaya'];
        $user->nama_penaja = $data['nama_penaja'];
        //$user->status = $data['status'];
        //$user->terimaHLP = $data['terimaHLP'];
        //$user->tkh_maklumat = $data['tkh_maklumat'];

        
        $user = TuntutanPermohonan::create($data);
        $user->id_permohonan = $data['nokp_pelajar'];
        $user->nokp_pelajar = $data['nokp_pelajar'];
        //$user->program = $data['program'];
        $user->jenis_tuntutan = $data['jenis_tuntutan'];
        $user->amaun = $data['amaun'];
        $user->perakuan = $data['perakuan'];
        


        //$user->update();

        return $user;
        

      
    }




}


