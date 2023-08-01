<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\Waris;

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
			'noJKM' => 'required',
            'no_akaunbank' => 'required',
            'emel' => 'required'
            
        ]);

        $data = $request->all();
        $check = $this->create($data);

        $request->validate([
			'nama_waris' => 'required',
			'nokp_waris' => 'required|unique:waris',
            'pendapatan' => 'required'
            
        ]);

        $data = $request->all();
        $check = $this->store($data);

        return view('pages.dashboards.index');
        //return redirect()->back();
    }

    public function create(array $data)
    {
      return Permohonan::create([
		'nama_pelajar' => $data['nama_pelajar'],
		'nokp_pelajar' => $data['nokp_pelajar'],
		'tkh_lahir' => $data['tkh_lahir'],
		'umur' => $data['umur'],
		'jantina' => $data['jantina'],
		'noJKM' => $data['noJKM'],
		'kecacatan' => $data['kecacatan'],
		'bangsa' => $data['bangsa'],
		'alamat1' => $data['alamat1'],
		'alamat_poskod' => $data['alamat_poskod'],
		'alamat_negeri' => $data['alamat_negeri'],
		'dun' => $data['bandar'],
		'no_tel' => $data['no_tel'],
		'no_telR' => $data['no_telR'],
		'no_akaunbank' => $data['no_akaunbank'],
		'emel' => $data['emel']
      ]);

    }


    public function store(array $data)
    {
      return Waris::create([
		'nama_waris' => $data['nama_waris'],
		'nokp_waris' => $data['nokp_waris'],
		'alamat1' => $data['alamatW1'],
		'alamat_poskod' => $data['alamatW_poskod'],
        'alamat_bandar' => $data['alamatW_bandar'],
		'alamat_negeri' => $data['alamatW_negeri'],
		'no_tel' => $data['no_telW'],
		'no_telR' => $data['no_telRW'],
		'nokp_pelajar' => $data['nokp_pelajar'],
		'hubungan' => $data['hubungan'],
		'pendapatan' => $data['pendapatan'],

      ]);

    }




}
