<?php

namespace App\Http\Controllers;

use App\Exports\SenaraiPermohonanBKOKU;
use App\Exports\SenaraiPermohonanPPK;
use App\Models\InfoIpt;
use App\Models\Permohonan;
use App\Models\Smoku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function excelBKOKU()
    {
        $institusiPengajian = InfoIpt::orderBy('nama_institusi')->get();
        
        return view('pelaporan.excel_bkoku', compact('institusiPengajian'));


    }

    public function getExcelBKOKU()
    {
        
        $pelajar = Smoku::whereHas('akademik', function ($query) {
                $query->where('status', 1);
            })
            ->whereHas('permohonan', function ($query) {
                $query->whereIn('status', [6, 8])
                      ->where('program', 'BKOKU');
            })
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with(['infoipt', 'peringkat']);
                 },
                'permohonan' => function ($query) {
                    $query->whereIn('status', [6, 8])
                        ->where('program', 'BKOKU');
                }
            ])
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                // Ambil hanya satu rekod akademik yang status=1
                $akademik = $item->akademik->first();
                // Ambil hanya satu rekod permohonan latest
                $permohonan = $item->permohonan->whereIn('status', [6, 8])->where('program', 'BKOKU')->first();
                return [
                    'id' => $item->id,
                    'smoku_id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'peringkat_pengajian' => ucfirst(strtolower($akademik->peringkat->peringkat)) ?? '-',
                    'nama_kursus' => $akademik->nama_kursus ?? '-',
                    'nama_institusi' => $akademik->infoipt->nama_institusi ?? '-',
                    'tarikh_mula' => $akademik->tarikh_mula ?? '',
                    'tarikh_tamat' => $akademik->tarikh_tamat ?? '',
                    'permohonan_id' => $permohonan->id ?? '',
                    'program' => $permohonan->program ?? '',
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now())
                ];
            });

        return response()->json($pelajar);

    }

    public function cetakSenaraiBKOKUExcel(Request $request)
    {
        $institusi = $request->input('institusi');
        // dd($request->fullUrl(), $request->input('institusi'));
        $id_institusi = null;

        if (!empty($institusi)) {
            $id_institusi = InfoIpt::where('nama_institusi', $institusi)->value('id_institusi');
        }

        $kelulusan = Smoku::whereHas('akademik', function ($query) use ($id_institusi) {
        $query->where('status', 1);

        // Apply filter if $id_institusi is not null
        if (!empty($id_institusi)) {
                $query->where('id_institusi', $id_institusi);
            }
        })
        ->whereHas('permohonan', function ($query) {
            $query->whereIn('status', [6, 8])
                ->where('program', 'BKOKU');
        })
        ->with([
            'butiranPelajar.negeri',
            'butiranPelajar.bandar',
            'butiranPelajar.parlimenRelation',
            'butiranPelajar.dunRelation',
            'butiranPelajar.agamaRelation',
            'keturunanRelation',
            'okuRelation',
            'akademik' => function ($query) use ($id_institusi) {
                $query->where('status', 1)
                    ->when($id_institusi, fn($q) => $q->where('id_institusi', $id_institusi))
                    ->with(['infoipt', 'peringkat', 'modRelation', 'sumberRelation', 'penajaRelation']);
            },
            'permohonan' => function ($query) {
                $query->whereIn('status', [6, 8])
                    ->where('program', 'BKOKU')
                    ->with('kelulusanRelation');
            }
        ])
        ->orderBy('nama')
        ->get();

        // dd($kelulusan);

        return Excel::download(new SenaraiPermohonanBKOKU($kelulusan), 'Data_Excel_BKOKU.xlsx');
    }


    public function excelPPK()
    {
        $institusiPengajian = InfoIpt::orderBy('nama_institusi')->get();
        
        return view('pelaporan.excel_ppk', compact('institusiPengajian'));


    }

    public function getExcelPPK()
    {
        
        $pelajar = Smoku::whereHas('akademik', function ($query) {
                $query->where('status', 1);
            })
            ->whereHas('permohonan', function ($query) {
                $query->whereIn('status', [6, 8])
                      ->where('program', 'PPK');
            })
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with(['infoipt', 'peringkat']);
                 },
                'permohonan' => function ($query) {
                    $query->whereIn('status', [6, 8])
                        ->where('program', 'PPK');
                }
            ])
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                // Ambil hanya satu rekod akademik yang status=1
                $akademik = $item->akademik->first();
                // Ambil hanya satu rekod permohonan latest
                $permohonan = $item->permohonan->whereIn('status', [6, 8])->where('program', 'PPK')->first();
                return [
                    'id' => $item->id,
                    'smoku_id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'peringkat_pengajian' => ucfirst(strtolower($akademik->peringkat->peringkat)) ?? '-',
                    'nama_kursus' => $akademik->nama_kursus ?? '-',
                    'nama_institusi' => $akademik->infoipt->nama_institusi ?? '-',
                    'tarikh_mula' => $akademik->tarikh_mula ?? '',
                    'tarikh_tamat' => $akademik->tarikh_tamat ?? '',
                    'permohonan_id' => $permohonan->id ?? '',
                    'program' => $permohonan->program ?? '',
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now())
                ];
            });

        return response()->json($pelajar);

    }

    public function cetakSenaraiPPKExcel(Request $request)
    {
        $institusi = $request->input('institusi');
        // dd($request->fullUrl(), $request->input('institusi'));
        $id_institusi = null;

        if (!empty($institusi)) {
            $id_institusi = InfoIpt::where('nama_institusi', $institusi)->value('id_institusi');
        }

        $kelulusan = Smoku::whereHas('akademik', function ($query) use ($id_institusi) {
        $query->where('status', 1);

        // Apply filter if $id_institusi is not null
        if (!empty($id_institusi)) {
                $query->where('id_institusi', $id_institusi);
            }
        })
        ->whereHas('permohonan', function ($query) {
            $query->whereIn('status', [6, 8])
                ->where('program', 'PPK');
        })
        ->with([
            'butiranPelajar.negeri',
            'butiranPelajar.bandar',
            'butiranPelajar.parlimenRelation',
            'butiranPelajar.dunRelation',
            'butiranPelajar.agamaRelation',
            'keturunanRelation',
            'okuRelation',
            'akademik' => function ($query) use ($id_institusi) {
                $query->where('status', 1)
                    ->when($id_institusi, fn($q) => $q->where('id_institusi', $id_institusi))
                    ->with(['infoipt', 'peringkat', 'modRelation', 'sumberRelation', 'penajaRelation']);
            },
            'permohonan' => function ($query) {
                $query->whereIn('status', [6, 8])
                    ->where('program', 'PPK')
                    ->with('kelulusanRelation');
            }
        ])
        ->orderBy('nama')
        ->get();

        // dd($kelulusan);

        return Excel::download(new SenaraiPermohonanPPK($kelulusan), 'Data_Excel_PPK.xlsx');
    }

}
