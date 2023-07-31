<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;

class PermohonanController extends Controller
{
    public function permohonan()
    {
        //addVendors(['amcharts', 'amcharts-maps', 'amcharts-stock'],

        return view('pages.permohonan.permohonan-baru');
    }

    public function postPermohonan(Request $request)
    {  
        $request->validate([
			'nama_pelajar' => 'required',
			'nokp_pelajar' => 'required|unique:pelajar',
            /*'tkh_lahir' => 'required',
            'umur',
            'noJKM',
            'bangsa',
            'jantina',
            'kecacatan',
            'alamat1',
            'alamat2',
            'alamat3',
            'alamat_poskod',
            'alamat_negeri',
            'dun',
            'parlimen',
            'alamat_surat1',
            'alamat_surat2',
            'alamat_surat3',
            'alamat_surat_poskod',
            'alamat_surat_bandar',
            'alamat_surat_negeri',
            'no_telR',
            'no_tel',*/
            'no_akaunbank' => 'required',
            'emel' => 'required'
            /*'id_penyelaras'*/
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return view('pages.dashboards.index');
    }




}
