<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function keseluruhan()
    {
        
        return view('pelaporan.keseluruhan');
       
    }
    public function permohonan()
    {
        
        return view('pelaporan.permohonan');
       
    }
    public function statistik()
    {
        
        return view('pelaporan.statistik');
       
    }
    public function tuntutan()
    {
        
        return view('pelaporan.tuntutan');
       
    }

    public function getStatusKeseluruhan()
    {
        $akademik_keseluruhan = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS dibayarIPTS,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < NOW() THEN 1 END) AS tidaklayakIPTS
            ')
            ->where('smoku_akademik.status', 1)
            // ->where('program', 'BKOKU')
            // ->where('bk_info_institusi.jenis_institusi', 'IPTS')
            ->first();

        return response()->json($akademik_keseluruhan);
    }

    public function senaraiPenajaan()
    {  
        return view('kemaskini.senarai_penajaan');
    }

    public function statusKeseluruhan()
    {
        return view('kemaskini.senarai_keseluruhan');
    }

    public function getListKeseluruhan()
    {
        $permohonan = Permohonan::
                    // where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            // $q->where('jenis_institusi', 'IPTS');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        // $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusKeseluruhanTamat()
    {
        return view('kemaskini.senarai_keseluruhan_tamat');
    }

    public function getListKeseluruhanTamat()
    {
        $permohonan = Permohonan::
                    // where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            // $q->where('jenis_institusi', 'IPTS');
                            $q->where('tarikh_tamat', '<', now()->startOfDay());
                            $q->where('status', 1);
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        // $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }
}
