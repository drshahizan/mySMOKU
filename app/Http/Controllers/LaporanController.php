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
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS semAkhirK,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < CURDATE() THEN 1 END) AS telahTamatK
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
        $permohonan = Permohonan::whereHas('akademik', function ($q) {
                        
                        $q->whereHas('infoipt', function ($q) {
                            // $q->where('jenis_institusi', 'IPTS');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });                        
                    })
                    
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
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
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getStatusIPTS()
    {
        $akademik_keseluruhan = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS semAkhirIPTS,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < CURDATE() THEN 1 END) AS telahTamatIPTS
            ')
            ->where('smoku_akademik.status', 1)
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'IPTS')
            ->first();

        return response()->json($akademik_keseluruhan);
    }

    public function senaraiPenajaanIPTS()
    {  
        return view('kemaskini.senarai_penajaan_IPTS');
    }

    public function statusIPTS()
    {
        return view('kemaskini.senarai_IPTS');
    }

    public function getListIPTS()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'IPTS');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusIPTSTamat()
    {
        return view('kemaskini.senarai_IPTS_tamat');
    }

    public function getListIPTSTamat()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'IPTS');
                            $q->where('tarikh_tamat', '<', now()->startOfDay());
                            $q->where('status', 1);
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getStatusP()
    {
        $akademik_keseluruhan = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS semAkhirP,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < CURDATE() THEN 1 END) AS telahTamatP
            ')
            ->where('smoku_akademik.status', 1)
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'P')
            ->first();

        return response()->json($akademik_keseluruhan);
    }

    public function senaraiPenajaanP()
    {  
        return view('kemaskini.senarai_penajaan_P');
    }

    public function statusP()
    {
        return view('kemaskini.senarai_P');
    }

    public function getListP()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'P');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusPTamat()
    {
        return view('kemaskini.senarai_P_tamat');
    }

    public function getListPTamat()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'P');
                            $q->where('tarikh_tamat', '<', now()->startOfDay());
                            $q->where('status', 1);
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getStatusKK()
    {
        $akademik_keseluruhan = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS semAkhirKK,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < CURDATE() THEN 1 END) AS telahTamatKK
            ')
            ->where('smoku_akademik.status', 1)
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'KK')
            ->first();

        return response()->json($akademik_keseluruhan);
    }

    public function senaraiPenajaanKK()
    {  
        return view('kemaskini.senarai_penajaan_KK');
    }

    public function statusKK()
    {
        return view('kemaskini.senarai_KK');
    }

    public function getListKK()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'KK');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusKKTamat()
    {
        return view('kemaskini.senarai_KK_tamat');
    }

    public function getListKKTamat()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'KK');
                            $q->where('tarikh_tamat', '<', now()->startOfDay());
                            $q->where('status', 1);
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getStatusUA()
    {
        $akademik_keseluruhan = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS semAkhirUA,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < CURDATE() THEN 1 END) AS telahTamatUA
            ')
            ->where('smoku_akademik.status', 1)
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'UA')
            ->first();

        return response()->json($akademik_keseluruhan);
    }

    public function senaraiPenajaanUA()
    {  
        return view('kemaskini.senarai_penajaan_UA');
    }

    public function statusUA()
    {
        return view('kemaskini.senarai_UA');
    }

    public function getListUA()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'UA');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusUATamat()
    {
        return view('kemaskini.senarai_UA_tamat');
    }

    public function getListUATamat()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'UA');
                            $q->where('tarikh_tamat', '<', now()->startOfDay());
                            $q->where('status', 1);
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getStatusPPK()
    {
        $akademik_keseluruhan = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 MONTH) THEN 1 END) AS semAkhirPPK,
                COUNT(CASE WHEN smoku_akademik.tarikh_tamat < CURDATE() THEN 1 END) AS telahTamatPPK
            ')
            ->where('smoku_akademik.status', 1)
            ->where('program', 'PPK')
            // ->where('bk_info_institusi.jenis_institusi', 'UA')
            ->first();

        return response()->json($akademik_keseluruhan);
    }

    public function senaraiPenajaanPPK()
    {  
        return view('kemaskini.senarai_penajaan_PPK');
    }

    public function statusPPK()
    {
        return view('kemaskini.senarai_PPK');
    }

    public function getListPPK()
    {
        $permohonan = Permohonan::where('program', 'PPK')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            // $q->where('jenis_institusi', 'UA');
                            $q->where('tarikh_tamat', '>=', now());
                            $q->where('tarikh_tamat', '<=', now()->addMonths(3));
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusPPKTamat()
    {
        return view('kemaskini.senarai_PPK_tamat');
    }

    public function getListPPKTamat()
    {
        $permohonan = Permohonan::where('program', 'PPK')
                    // ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            // $q->where('jenis_institusi', 'UA');
                            $q->where('tarikh_tamat', '<', now()->startOfDay());
                            $q->where('status', 1);
                            
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        
                        $query->where('status', 1);
                        $query->with(['infoipt', 'peringkat']);  // Ensure peringkat is included here
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }
}
