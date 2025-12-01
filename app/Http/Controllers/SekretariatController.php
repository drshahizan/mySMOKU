<?php

namespace App\Http\Controllers;

use App\Exports\BorangSPPB;
use App\Exports\DrafLejarPermohonan;
use App\Exports\DrafLejarTuntutan;
use App\Exports\DrafSPBB1;
use App\Exports\DrafSPBB1a;
use App\Exports\DrafSPBB2;
use App\Exports\DrafSPBB2a;
use App\Exports\DrafSPBB3;
use App\Exports\LejarPermohonan;
use App\Exports\LejarTuntutan;
use App\Exports\PenyaluranTuntutan;
use App\Exports\SenaraiPendek;
use App\Exports\SenaraiPendekBKOKU;
use App\Exports\SenaraiPendekPOLI;
use App\Exports\SenaraiPendekKK;
use App\Exports\SenaraiPendekUA;
use App\Mail\KeputusanLayak;
use App\Mail\KeputusanTidakLayak;
use App\Mail\TuntutanDikembalikan;
use App\Mail\TuntutanLayak;
use App\Mail\TuntutanTidakLayak;
use App\Models\DokumenESP;
use App\Models\EmelKemaskini;
use App\Models\JumlahTuntutan;
use App\Models\Peperiksaan;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\SaringanTuntutan;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\ButiranPelajar;
use App\Models\Smoku;
use App\Models\Status;
use App\Models\TuntutanItem;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Dokumen;
use App\Models\InfoIpt;
use App\Models\Kelulusan;
use App\Models\LanjutPengajian;
use App\Models\MaklumatKementerian;
use App\Models\PeringkatPengajian;
use App\Models\SuratTawaran;
use App\Models\TamatPengajian;
use App\Models\TangguhPengajian;
use App\Models\Tuntutan;
use App\Models\MaklumatBank;
use App\Models\SesiSalur;
use App\Models\TukarInstitusi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class SekretariatController extends Controller
{
    //PERMOHONAN
    public function dashboardSekretariat()
    {
        return view('dashboard.sekretariat.dashboard');
    }

    public function getPermohonanUA()
    {
        // Cache for 1 minute (optional but recommended for dashboard)
        $response = Cache::remember('permohonanUA_counts', 60, function () {
            $counts = DB::table('permohonan')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'UA')
                ->select('permohonan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('permohonan.status')
                ->pluck('total','permohonan.status'); // returns [status => total]

            return [
                'keseluruhanUA' => $counts->except([9,10])->sum(), // exclude status 9 & 10
                'derafUA'       => $counts[1] ?? 0,
                'baharuUA'      => $counts[2] ?? 0,
                'saringanUA'    => $counts[3] ?? 0,
                'disokongUA'    => $counts[4] ?? 0,
                'dikembalikanUA'=> $counts[5] ?? 0,
                'layakUA'       => $counts[6] ?? 0,
                'tidaklayakUA'  => $counts[7] ?? 0,
                'dibayarUA'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getTuntutanUA()
    {
        // Cache for 1 minute (optional for dashboard)
        $response = Cache::remember('tuntutanUA_counts', 60, function () {
            $counts = DB::table('tuntutan')
                ->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program','=','BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'UA')
                ->select('tuntutan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('tuntutan.status')
                ->pluck('total','tuntutan.status'); // returns [status => total]

            return [
                'keseluruhanTuntutanUA' => $counts->except([9,10])->sum(), // exclude 9 & 10
                'derafTuntutanUA'       => $counts[1] ?? 0,
                'baharuTuntutanUA'      => $counts[2] ?? 0,
                'saringanTuntutanUA'    => $counts[3] ?? 0,
                'disokongTuntutanUA'    => $counts[4] ?? 0,
                'dikembalikanTuntutanUA'=> $counts[5] ?? 0,
                'layakTuntutanUA'       => $counts[6] ?? 0,
                'tidaklayakTuntutanUA'  => $counts[7] ?? 0,
                'dibayarTuntutanUA'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getPermohonanPOLI()
    {
        $response = Cache::remember('permohonanPOLI_counts', 60, function () {
            $counts = DB::table('permohonan')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'P')
                ->select('permohonan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('permohonan.status')
                ->pluck('total', 'permohonan.status');

            return [
                'keseluruhanPOLI' => $counts->except([9,10])->sum(),
                'derafPOLI'       => $counts[1] ?? 0,
                'baharuPOLI'      => $counts[2] ?? 0,
                'saringanPOLI'    => $counts[3] ?? 0,
                'disokongPOLI'    => $counts[4] ?? 0,
                'dikembalikanPOLI'=> $counts[5] ?? 0,
                'layakPOLI'       => $counts[6] ?? 0,
                'tidaklayakPOLI'  => $counts[7] ?? 0,
                'dibayarPOLI'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getTuntutanPOLI()
    {
        $response = Cache::remember('tuntutanPOLI_counts', 60, function () {
            $counts = DB::table('tuntutan')
                ->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'P')
                ->select('tuntutan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('tuntutan.status')
                ->pluck('total', 'tuntutan.status');

            return [
                'keseluruhanTuntutanPOLI' => $counts->except([9,10])->sum(),
                'derafTuntutanPOLI'       => $counts[1] ?? 0,
                'baharuTuntutanPOLI'      => $counts[2] ?? 0,
                'saringanTuntutanPOLI'    => $counts[3] ?? 0,
                'disokongTuntutanPOLI'    => $counts[4] ?? 0,
                'dikembalikanTuntutanPOLI'=> $counts[5] ?? 0,
                'layakTuntutanPOLI'       => $counts[6] ?? 0,
                'tidaklayakTuntutanPOLI'  => $counts[7] ?? 0,
                'dibayarTuntutanPOLI'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getPermohonanKK()
    {
        $response = Cache::remember('permohonanKK_counts', 60, function () {
            $counts = DB::table('permohonan')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'KK')
                ->select('permohonan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('permohonan.status')
                ->pluck('total', 'permohonan.status');

            return [
                'keseluruhanKK' => $counts->except([9,10])->sum(),
                'derafKK'       => $counts[1] ?? 0,
                'baharuKK'      => $counts[2] ?? 0,
                'saringanKK'    => $counts[3] ?? 0,
                'disokongKK'    => $counts[4] ?? 0,
                'dikembalikanKK'=> $counts[5] ?? 0,
                'layakKK'       => $counts[6] ?? 0,
                'tidaklayakKK'  => $counts[7] ?? 0,
                'dibayarKK'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getTuntutanKK()
    {
        $response = Cache::remember('tuntutanKK_counts', 60, function () {
            $counts = DB::table('tuntutan')
                ->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'KK')
                ->select('tuntutan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('tuntutan.status')
                ->pluck('total', 'tuntutan.status');

            return [
                'keseluruhanTuntutanKK' => $counts->except([9,10])->sum(),
                'derafTuntutanKK'       => $counts[1] ?? 0,
                'baharuTuntutanKK'      => $counts[2] ?? 0,
                'saringanTuntutanKK'    => $counts[3] ?? 0,
                'disokongTuntutanKK'    => $counts[4] ?? 0,
                'dikembalikanTuntutanKK'=> $counts[5] ?? 0,
                'layakTuntutanKK'       => $counts[6] ?? 0,
                'tidaklayakTuntutanKK'  => $counts[7] ?? 0,
                'dibayarTuntutanKK'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getPermohonanIPTS()
    {
        $response = Cache::remember('permohonanIPTS_counts', 60, function () {
            $counts = DB::table('permohonan')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'IPTS')
                ->select('permohonan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('permohonan.status')
                ->pluck('total', 'permohonan.status');

            return [
                'keseluruhanIPTS' => $counts->except([9,10])->sum(),
                'derafIPTS'       => $counts[1] ?? 0,
                'baharuIPTS'      => $counts[2] ?? 0,
                'saringanIPTS'    => $counts[3] ?? 0,
                'disokongIPTS'    => $counts[4] ?? 0,
                'dikembalikanIPTS'=> $counts[5] ?? 0,
                'layakIPTS'       => $counts[6] ?? 0,
                'tidaklayakIPTS'  => $counts[7] ?? 0,
                'dibayarIPTS'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getTuntutanIPTS()
    {
        $response = Cache::remember('tuntutanIPTS_counts', 60, function () {
            $counts = DB::table('tuntutan')
                ->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program', 'BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'IPTS')
                ->select('tuntutan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('tuntutan.status')
                ->pluck('total', 'tuntutan.status');

            return [
                'keseluruhanTuntutanIPTS' => $counts->except([9,10])->sum(),
                'derafTuntutanIPTS'       => $counts[1] ?? 0,
                'baharuTuntutanIPTS'      => $counts[2] ?? 0,
                'saringanTuntutanIPTS'    => $counts[3] ?? 0,
                'disokongTuntutanIPTS'    => $counts[4] ?? 0,
                'dikembalikanTuntutanIPTS'=> $counts[5] ?? 0,
                'layakTuntutanIPTS'       => $counts[6] ?? 0,
                'tidaklayakTuntutanIPTS'  => $counts[7] ?? 0,
                'dibayarTuntutanIPTS'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getPermohonanP()
    {
        $response = Cache::remember('permohonanP_counts', 60, function () {
            $counts = DB::table('permohonan')
                ->where('program', 'PPK')
                ->select('status', DB::raw('COUNT(*) as total'))
                ->groupBy('status')
                ->pluck('total', 'status'); // returns [status => total]

            return [
                'keseluruhanP' => $counts->except([9,10])->sum(), // exclude status 9 & 10
                'derafP'       => $counts[1] ?? 0,
                'baharuP'      => $counts[2] ?? 0,
                'saringanP'    => $counts[3] ?? 0,
                'disokongP'    => $counts[4] ?? 0,
                'dikembalikanP'=> $counts[5] ?? 0,
                'layakP'       => $counts[6] ?? 0,
                'tidaklayakP'  => $counts[7] ?? 0,
                'dibayarP'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    public function getTuntutanP()
    {
        $response = Cache::remember('tuntutanP_counts', 60, function () {
            $counts = DB::table('tuntutan')
                ->join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->where('permohonan.program', 'PPK')
                ->select('tuntutan.status', DB::raw('COUNT(*) as total'))
                ->groupBy('tuntutan.status')
                ->pluck('total', 'tuntutan.status');

            return [
                'keseluruhanTP' => $counts->except([9,10])->sum(), // exclude 9 & 10
                'derafTP'       => $counts[1] ?? 0,
                'baharuTP'      => $counts[2] ?? 0,
                'saringanTP'    => $counts[3] ?? 0,
                'disokongTP'    => $counts[4] ?? 0,
                'dikembalikanTP'=> $counts[5] ?? 0,
                'layakTP'       => $counts[6] ?? 0,
                'tidaklayakTP'  => $counts[7] ?? 0,
                'dibayarTP'     => $counts[8] ?? 0,
            ];
        });

        return response()->json($response);
    }

    //BKOKU IPTS
    public function statusPermohonanBKOKU()
    {
        return view('dashboard.sekretariat.senarai_permohonan_IPTS');
    }

    public function getListPermohonanIPTS()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereNotIn('status', [9, 10])
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'IPTS');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function statusTuntutanBKOKU()
    {
        return view('dashboard.sekretariat.senarai_tuntutan_IPTS');
    }

    public function getListTuntutanIPTS()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'IPTS');
                            });
                        $query->whereHas('peringkat');
                    })
                    ->whereHas('permohonan', function ($query) {
                        $query->where('program', 'BKOKU');
                    })
                    ->whereNotIn('status', [9, 10])
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku', 'permohonan'])
                    ->get();

        return response()->json($tuntutan);
    }

    // public function statusTuntutanBKOKU(Request $request, $status)
    // {
    //     $startDate = $request->input('start_date');
    //     $endDate = $request->input('end_date');

    //     $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
    //                     return $q->whereBetween('tuntutan.tarikh_hantar', [$startDate, $endDate]);
    //                 })
    //                 ->when($status === '!=9', function ($q) {
    //                     return $q->where('tuntutan.status', '!=', 9);
    //                 })
    //                 ->when($request->status != null && $status !== '!=9', function ($q) use ($request) {
    //                     return $q->where('tuntutan.status', $request->status);
    //                 })
    //                 ->get();

    //     return view('dashboard.sekretariat.senarai_tuntutan_IPTS', compact('tuntutan'));
    // }

    public function filterStatusPermohonanBKOKU(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->when($status !== null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->where('program', 'BKOKU')->get();

        return view('dashboard.sekretariat.filter_senarai_permohonan_IPTS', compact('permohonan', 'status'));
    }

    public function getListStatusPermohonanIPTS($status)
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->where('status', $status)
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'IPTS');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function filterStatusTuntutanBKOKU(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                        return $q->whereBetween('tuntutan.tarikh_hantar', [$startDate, $endDate]);
                    })
                    ->when($request->status != null, function ($q) use ($request) {
                        return $q->where('tuntutan.status', $request->status);
                    })
                    ->get();

        return view('dashboard.sekretariat.filter_senarai_tuntutan_IPTS', compact('tuntutan','status'));
    }

    public function getFilterListTuntutanIPTS($status)
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'IPTS');
                            });
                    })
                    ->whereHas('permohonan', function ($query) {
                        $query->where('program', 'BKOKU');
                    })
                    ->where('status',$status)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($tuntutan);
    }

    //BKOKU POLI
    public function statusPermohonanPOLI()
    {
        return view('dashboard.sekretariat.senarai_permohonan_POLI');
    }

    public function getListPermohonanPOLI()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
            ->whereNotIn('status', [9, 10])
            ->whereHas('akademik', function ($q) {
                $q->whereHas('infoipt', function ($q) {
                    $q->where('jenis_institusi', 'P');
                });
            })
            ->with(['akademik' => function ($query) {
                $query->where('status', 1);
                $query->with('infoipt');
            }, 'smoku'])
            ->get();

        return response()->json($permohonan);
    }

    public function statusTuntutanPOLI()
    {
        return view('dashboard.sekretariat.senarai_tuntutan_POLI');
    }

    public function getListTuntutanPOLI()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'P');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereNotIn('status', [9, 10])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function filterStatusPermohonanPOLI(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->when($status !== null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->where('program', 'BKOKU')->get();

        return view('dashboard.sekretariat.filter_senarai_permohonan_POLI', compact('permohonan', 'status'));
    }

    public function getListStatusPermohonanPOLI($status)
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->where('status', $status)
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'P');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function filterStatusTuntutanPOLI(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                        return $q->whereBetween('tuntutan.tarikh_hantar', [$startDate, $endDate]);
                    })
                    ->when($request->status != null, function ($q) use ($request) {
                        return $q->where('tuntutan.status', $request->status);
                    })
                    ->get();

        return view('dashboard.sekretariat.filter_senarai_tuntutan_POLI', compact('tuntutan','status'));
    }

    public function getFilterListTuntutanPOLI($status)
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'P');
                            });
                    })
                    ->whereHas('permohonan', function ($query) {
                        $query->where('program', 'BKOKU');
                    })
                    ->where('status',$status)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($tuntutan);
    }


    //BKOKU KK
    public function statusPermohonanKK()
    {
        return view('dashboard.sekretariat.senarai_permohonan_KK');
    }

    public function getListPermohonanKK()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
            ->whereNotIn('status', [9, 10])
            ->whereHas('akademik', function ($q) {
                $q->whereHas('infoipt', function ($q) {
                    $q->where('jenis_institusi', 'KK');
                });
            })
            ->with(['akademik' => function ($query) {
                $query->where('status', 1);
                $query->with('infoipt');
            }, 'smoku'])
            ->get();

        return response()->json($permohonan);
    }

    public function statusTuntutanKK()
    {
        return view('dashboard.sekretariat.senarai_tuntutan_KK');
    }

    public function getListTuntutanKK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'KK');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereNotIn('status', [9, 10])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function filterStatusPermohonanKK(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();

            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->when($status !== null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->where('program', 'BKOKU')->get();

        return view('dashboard.sekretariat.filter_senarai_permohonan_KK', compact('permohonan', 'status'));
    }

    public function getListStatusPermohonanKK($status)
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->where('status', $status)
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'KK');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function filterStatusTuntutanKK(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                        return $q->whereBetween('tuntutan.tarikh_hantar', [$startDate, $endDate]);
                    })
                    ->when($request->status != null, function ($q) use ($request) {
                        return $q->where('tuntutan.status', $request->status);
                    })
                    ->get();

        return view('dashboard.sekretariat.filter_senarai_tuntutan_KK', compact('tuntutan','status'));
    }

    public function getFilterListTuntutanKK($status)
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'KK');
                            });
                    })
                    ->whereHas('permohonan', function ($query) {
                        $query->where('program', 'BKOKU');
                    })
                    ->where('status',$status)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($tuntutan);
    }


    //BKOKU UA
    public function statusPermohonanUA()
    {
        return view('dashboard.sekretariat.senarai_permohonan_BKOKU_UA');
    }

    public function getListPermohonanUA()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
            ->whereNotIn('status', [9, 10])
            ->whereHas('akademik', function ($q) {
                $q->whereHas('infoipt', function ($q) {
                    $q->where('jenis_institusi', 'UA');
                });
            })
            ->with(['akademik' => function ($query) {
                $query->where('status', 1);
                $query->with('infoipt');
            }, 'smoku'])
            ->get();

        return response()->json($permohonan);
    }

    public function statusTuntutanUA()
    {
        return view('dashboard.sekretariat.senarai_tuntutan_BKOKU_UA');
    }

    public function getListTuntutanUA()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'UA');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereNotIn('status', [9, 10])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }


    public function filterStatusPermohonanUA(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->where('program','BKOKU')->get();

        return view('dashboard.sekretariat.filter_senarai_permohonan_BKOKU_UA', compact('permohonan','status'));
    }

    public function getListStatusPermohonanUA($status)
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->where('status', $status)
                    ->whereHas('akademik', function ($q) {
                        $q->whereHas('infoipt', function ($q) {
                            $q->where('jenis_institusi', 'UA');
                        });
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function filterStatusTuntutanUA(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                        return $q->whereBetween('tuntutan.tarikh_hantar', [$startDate, $endDate]);
                    })
                    ->when($request->status != null, function ($q) use ($request) {
                        return $q->where('tuntutan.status', $request->status);
                    })
                    ->get();

        return view('dashboard.sekretariat.filter_senarai_tuntutan_BKOKU_UA', compact('tuntutan','status'));
    }

    public function getFilterListTuntutanUA($status)
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'UA');
                            });
                    })
                    ->whereHas('permohonan', function ($query) {
                        $query->where('program', 'BKOKU');
                    })
                    ->where('status',$status)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($tuntutan);
    }


    //PPK
    public function statusPermohonanPPK()
    {
        return view('dashboard.sekretariat.senarai_permohonan_PPK');
    }

    public function getListPermohonanPPK()
    {
        $permohonan = Permohonan::where('program', 'PPK')
            ->whereNotIn('status', [9, 10])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1);
                $query->with('infoipt');
            }, 'smoku'])
            ->get();

        return response()->json($permohonan);
    }

    public function statusTuntutanPPK()
    {
        return view('dashboard.sekretariat.senarai_tuntutan_PPK');
    }

    public function getListTuntutanPPK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                    })
                    ->whereHas('permohonan', function ($query) {
                        $query->where('program', 'PPK');
                    })
                    ->whereNotIn('status', [9, 10])
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku', 'permohonan'])
                    ->get();

        return response()->json($tuntutan);
    }

    public function filterStatusPermohonanPPK(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_hantar', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.filter_senarai_permohonan_PPK', compact('permohonan','status'));
    }

    public function getListStatusPermohonanPPK($status)
    {
        $permohonan = Permohonan::where('program', 'PPK')
                    ->where('status', $status)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                    }, 'smoku'])
                    ->get();

        return response()->json($permohonan);
    }

    public function filterStatusTuntutanPPK(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tuntutan.tarikh_hantar', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.filter_senarai_tuntutan_PPK', compact('tuntutan','status'));
    }

    public function getFilterListTuntutanPPK($status)
    {
        $tuntutan = Tuntutan::whereHas('permohonan', function ($query) {
                        $query->where('program', 'PPK');
                    })
                    ->where('status',$status)
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)->with('infoipt');
                    }, 'smoku'])
                    ->get();

        return response()->json($tuntutan);
    }

    //KEMASKINI PERINGKAT PENGAJIAN
    public function peringkatPengajian()
    {
        $peringkatPengajian = PeringkatPengajian::all();
        
        // Step 1: Get the latest tamat_pengajian.id per student (smoku_id)
        $latestIds = DB::table('tamat_pengajian')
            ->select(DB::raw('MAX(id) as id'))
            ->groupBy('smoku_id');

        // Step 2: Get the full records for those latest IDs, joined with smoku to get the student name
        $recordsTerkini = TamatPengajian::select('tamat_pengajian.*', 'smoku.nama')
            ->join('smoku', 'tamat_pengajian.smoku_id', '=', 'smoku.id')
            ->whereIn('tamat_pengajian.id', $latestIds)
            ->orderBy('tamat_pengajian.id', 'desc')
            ->get();

        $recordsTerdahulu = TamatPengajian::select('tamat_pengajian.*', 'smoku_akademik.*')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tamat_pengajian.smoku_id')
            ->where('smoku_akademik.status', 0)
            ->get();

        //untuk pelajar yang tak guna flow baru
        $recordsBaru = TamatPengajian::select('tamat_pengajian.*', 'smoku_akademik.*')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tamat_pengajian.smoku_id')
            ->where('smoku_akademik.status', 1)
            ->get();    

        return view('kemaskini.sekretariat.pengajian.kemaskini_peringkat_pengajian', compact('recordsTerkini', 'recordsTerdahulu', 'recordsBaru',));
    }

    public function kemaskiniPeringkatPengajian(Request $request, $id)
    {
        $kelulusan = $request->peringkat_baharu;

        if ($kelulusan == "LULUS") {
            $latestPeringkatPengajian = Akademik::where('smoku_id', $id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($latestPeringkatPengajian) {
                $latestPeringkatPengajian->update(['status' => 0]);
            }

            $tamat_pengajian = TamatPengajian::where('smoku_id', $id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($tamat_pengajian) {
                // Update peringkat_baharu column
                $tamat_pengajian->peringkat_baharu = $kelulusan;
                $tamat_pengajian->save();
            }

            $newRecord = new Akademik([
                'smoku_id' => $id,
                'no_pendaftaran_pelajar' => null,
                'peringkat_pengajian' => $tamat_pengajian->peringkat ?? null,
                'nama_kursus' => $tamat_pengajian->kursus ?? null,
                'id_institusi' => $tamat_pengajian->institusi ?? null,
                'sesi' => NULL,
                'tarikh_mula' => NULL,
                'tarikh_tamat' => NULL,
                'sem_semasa' => NULL,
                'tempoh_pengajian' => NULL,
                'bil_bulan_per_sem' => NULL,
                'mod' => NULL,
                'cgpa' => NULL,
                'sumber_biaya' => NULL,
                'sumber_lain' => NULL,
                'nama_penaja' => NULL,
                'penaja_lain' => NULL,
                'status' => 1,
            ]);
            $newRecord->save();

            return redirect()->back()->with('success', 'Permohonan peringkat pengajian baharu telah diluluskan.');
        } else {
            // If not approved, still update the peringkat_baharu column to reflect rejection
            $tamat_pengajian = TamatPengajian::where('smoku_id', $id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($tamat_pengajian) {
                $tamat_pengajian->peringkat_baharu = $kelulusan;
                $tamat_pengajian->save();
            }

            return redirect()->back()->with('failed', 'Permohonan peringkat pengajian baharu tidak diluluskan.');
        }
    }


    public function tangguhLanjutPengajian()
    {
        $tangguh = TangguhPengajian::select('tangguh_pengajian.*','tangguh_pengajian.status as status_tangguh_lanjut','tangguh_pengajian.surat_tangguh as surat',
            'smoku_akademik.*', 'smoku.nama', 'bk_peringkat_pengajian.peringkat')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tangguh_pengajian.smoku_id')
            ->join('smoku', 'tangguh_pengajian.smoku_id', '=', 'smoku.id')
            ->join('bk_peringkat_pengajian', 'smoku_akademik.peringkat_pengajian', '=', 'bk_peringkat_pengajian.kod_peringkat')
            ->whereIn('smoku_akademik.smoku_id', function ($query) {
                $query->select('smoku_id')
                    ->from('permohonan')
                    ->where('program', 'BKOKU');
            })
            ->where('smoku_akademik.status', 1)
            ->whereRaw('(tangguh_pengajian.created_at, smoku_akademik.smoku_id) IN (SELECT MAX(created_at), smoku_id FROM tangguh_pengajian GROUP BY smoku_id)')
            ->get()->toArray();

        $lanjut = LanjutPengajian::select('lanjut_pengajian.*','lanjut_pengajian.status as status_tangguh_lanjut','lanjut_pengajian.surat_lanjut as surat',
            'smoku_akademik.*', 'smoku.nama', 'bk_peringkat_pengajian.peringkat')
            ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'lanjut_pengajian.smoku_id')
            ->join('smoku', 'lanjut_pengajian.smoku_id', '=', 'smoku.id')
            ->join('bk_peringkat_pengajian', 'smoku_akademik.peringkat_pengajian', '=', 'bk_peringkat_pengajian.kod_peringkat')
            ->whereIn('smoku_akademik.smoku_id', function ($query) {
                $query->select('smoku_id')
                    ->from('permohonan')
                    ->where('program', 'BKOKU');
            })
            ->where('smoku_akademik.status', 1)
            ->whereRaw('(lanjut_pengajian.created_at, smoku_akademik.smoku_id) IN (SELECT MAX(created_at), smoku_id FROM lanjut_pengajian GROUP BY smoku_id)')
            ->get()->toArray();
        $data = array_merge($tangguh, $lanjut);

        return view('kemaskini.sekretariat.pengajian.kemaskini_tangguh_lanjut_pengajian', compact('data'));
    }

    public function kemaskiniTarikhPengajian(Request $request, $id)
    {
        $akademik = Akademik::where('smoku_id', $id)->where('status',1)
            ->orderBy('created_at', 'desc') // Assuming you have a 'created_at' column
            ->first();

        if ($akademik) {
            $akademik->update(['tarikh_tamat' => $request->tarikh_tamat_baru]);
        }

        $tangguh = TangguhPengajian::where('smoku_id', $id)
            ->orderBy('id', 'desc')
            ->first();

        if ($tangguh) {
            $tangguh->update(['status' => $request->status]);
        }

        return redirect()->back()->with('success', 'Tarikh baru tamat pengajian dikemaskini');
    }

    //Step 1: Editing Data - Allow users to view and edit the current data.
    public function previewSuratTawaran()
    {
        $suratTawaran = SuratTawaran::first();
        $maklumat_kementerian = MaklumatKementerian::first();

        return view('kemaskini.sekretariat.surat_tawaran.kemaskini', compact('suratTawaran','maklumat_kementerian'));
    }

    //Step 2: Editing Data - Allow users to send the updated data.
    public function sendSuratTawaran(Request $request, $suratTawaranId)
    {
        $existingRecord = SuratTawaran::where('id', $suratTawaranId)->first();

        if ($existingRecord) {
            $existingRecord->tajuk = $request->tajuk;
            $existingRecord->hormat = $request->hormat;
            $existingRecord->tujuan = $request->tujuan;
            $existingRecord->kandungan1 = $request->kandungan1;
            $existingRecord->kandungan2 = $request->kandungan2;
            $existingRecord->kandungan3 = $request->kandungan3;
            $existingRecord->penutup1 = $request->penutup1;
            $existingRecord->penutup2 = $request->penutup2;
            $existingRecord->penutup3_1 = $request->penutup3_1;
            $existingRecord->penutup3_2 = $request->penutup3_2;
            $existingRecord->penutup3_3 = $request->penutup3_3;
            $existingRecord->penutup3_4 = $request->penutup3_4;
            $existingRecord->penutup4_1 = $request->penutup4_1;
            $existingRecord->penutup4_2 = $request->penutup4_2;
            $existingRecord->penutup4_3 = $request->penutup4_3;
            $existingRecord->penutup4_4 = $request->penutup4_4;
            $existingRecord->save();
        }

        return redirect()->route('update', ['suratTawaranId' => $suratTawaranId])->with('success', 'Surat Tawaran telah dikemaskini.');
    }

    //Step 3: Final latest view - Allow users to view the updated version of "Surat Tawaran"
    public function updatedSuratTawaran($suratTawaranId)
    {
        $suratTawaran = SuratTawaran::find($suratTawaranId);
        $maklumat_kementerian = MaklumatKementerian::first();

        return view('kemaskini.sekretariat.surat_tawaran.terkini', compact('suratTawaranId','suratTawaran','maklumat_kementerian'));
    }

    //Step 4: Download the updated "Surat Tawaran"
    public function muatTurunKemaskiniSuratTawaran()
    {
        $suratTawaran = SuratTawaran::first();
        $maklumat_kementerian = MaklumatKementerian::first();

        $pdf = PDF::loadView('kemaskini.sekretariat.surat_tawaran.muat-turun', compact('suratTawaran', 'maklumat_kementerian'));

        return $pdf->stream('surat-tawaran-dikemaskini.pdf');
    }

    //Step 1: PPK
    public function previewSuratTawaranPPK()
    {
        $suratTawaran = SuratTawaran::find(2);
        $maklumat_kementerian = MaklumatKementerian::first();

        return view('kemaskini.sekretariat.surat_tawaran.ppk.kemaskini', compact('suratTawaran','maklumat_kementerian'));
    }

    //Step 2: PPK
    public function sendSuratTawaranPPK(Request $request, $suratTawaranId)
    {
        $existingRecord = SuratTawaran::where('id', $suratTawaranId)->first();

        if ($existingRecord) {
            $existingRecord->tajuk = $request->tajuk;
            $existingRecord->hormat = $request->hormat;
            $existingRecord->tujuan = $request->tujuan;
            $existingRecord->kandungan1 = $request->kandungan1;
            $existingRecord->kandungan2 = $request->kandungan2;
            $existingRecord->kandungan3 = $request->kandungan3;
            $existingRecord->penutup1 = $request->penutup1;
            $existingRecord->penutup2 = $request->penutup2;
            $existingRecord->penutup3_1 = $request->penutup3_1;
            $existingRecord->penutup3_2 = $request->penutup3_2;
            $existingRecord->penutup3_3 = $request->penutup3_3;
            $existingRecord->penutup3_4 = $request->penutup3_4;
            $existingRecord->penutup4_1 = $request->penutup4_1;
            $existingRecord->penutup4_2 = $request->penutup4_2;
            $existingRecord->penutup4_3 = $request->penutup4_3;
            $existingRecord->penutup4_4 = $request->penutup4_4;
            $existingRecord->save();
        }

        return redirect()->route('updatePPK', ['suratTawaranId' => $suratTawaranId])->with('success', 'Surat Tawaran telah dikemaskini.');
    }

    //Step 3: PPK
    public function updatedSuratTawaranPPK($suratTawaranId)
    {
        $suratTawaran = SuratTawaran::find($suratTawaranId);
        $maklumat_kementerian = MaklumatKementerian::first();

        return view('kemaskini.sekretariat.surat_tawaran.ppk.terkini', compact('suratTawaranId','suratTawaran','maklumat_kementerian'));
    }

    //Step 4: PPK
    public function muatTurunKemaskiniSuratTawaranPPK()
    {
        $suratTawaran = SuratTawaran::find(2);
        $maklumat_kementerian = MaklumatKementerian::first();

        $pdf = PDF::loadView('kemaskini.sekretariat.surat_tawaran.ppk.muat-turun', compact('suratTawaran', 'maklumat_kementerian'));

        return $pdf->stream('surat-tawaran-dikemaskini.pdf');
    }

    //PERMOHONAN - KELULUSAN
    public function senaraiKelulusanPermohonan(Request $request)
    {
        $kelulusan = Permohonan::select('permohonan.*')
            ->where('permohonan.status', '=', '4')
            ->orderBy('id', 'desc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 
        
        // Extract ID values from the collections
        $idsIPTS = $institusiPengajianIPTS->pluck('id_institusi')->toArray();
        $idsPOLI = $institusiPengajianPOLI->pluck('id_institusi')->toArray();
        $idsKK = $institusiPengajianKK->pluck('id_institusi')->toArray();
        $idsUA = $institusiPengajianUA->pluck('id_institusi')->toArray();
        $idsPPK = $institusiPengajianPPK->pluck('id_institusi')->toArray();

        // Count the number of applications for each institution type with smoku_akademik join
        $countUA = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsUA)
                            ->whereIn('permohonan.status', ['4'])
                            ->count();               

        $countPOLI = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsPOLI)
                            ->whereIn('permohonan.status', ['4'])
                            ->count();

        $countKK = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsKK)
                            ->whereIn('permohonan.status', ['4'])
                            ->count();

        $countIPTS = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsIPTS)
                            ->whereIn('permohonan.status', ['4'])
                            ->count();

        $countPPK = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'PPK')
                            ->whereIn('smoku_akademik.id_institusi', $idsPPK)
                            ->whereIn('permohonan.status', ['4'])
                            ->count();

        // Debug output
        // dd($countUA, $countPOLI, $countKK, $countIPTS, $countPPK);

        return view('permohonan.sekretariat.kelulusan.kelulusan', compact('kelulusan', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA', 'institusiPengajianPPK', 'countIPTS', 'countPOLI', 'countKK', 'countUA', 'countPPK'));
    }

    public function cetakSenaraiDisokongPDF(Request $request, $programCode)
    {
        $filters = $request->only(['institusi']); // Adjust the filter names as per your form
        
        $query = Permohonan::orderBy('permohonan.updated_at', 'desc')
                            ->where('permohonan.status', '4');

        if (isset($filters['institusi']) ) 
        {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                  ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                  ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }

        $kelulusan = $query->get();

        //check programCode
        if ($programCode == 'IPTS')
            $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_ipts_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');
        elseif ($programCode == 'POLI')
            $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_poli_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');
        elseif ($programCode == 'KK')
            $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_kk_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');
        elseif ($programCode == 'UA')
            $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_ua_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');
        else
            $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_ppk_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');
        
        //stream pdf
        return $pdf->stream('Senarai-Permohonan-Disokong.pdf');
    }

    public function cetakSenaraiDisokongExcel(Request $request, $programCode)
    {
        $filters = $request->only(['institusi']);

        $query = Permohonan::orderBy('permohonan.updated_at', 'desc')
                            ->where('permohonan.status', '4');

        if (isset($filters['institusi']) && !empty($filters['institusi'])) 
        {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                  ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                  ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }

        $kelulusan = $query->get();
        //check programCode
        if ($programCode == 'IPTS')
            return Excel::download(new SenaraiPendekBKOKU($programCode, $filters), 'Permohonan_BKOKU_IPTS_Disokong.xlsx');
        elseif ($programCode == 'POLI')
            return Excel::download(new SenaraiPendekPOLI($programCode, $filters), 'Permohonan_BKOKU_POLI_Disokong.xlsx');
        elseif ($programCode == 'KK')
            return Excel::download(new SenaraiPendekKK($programCode, $filters), 'Permohonan_BKOKU_KK_Disokong.xlsx');
        elseif ($programCode == 'UA')
            return Excel::download(new SenaraiPendekUA($programCode, $filters), 'Permohonan_BKOKU_UA_Disokong.xlsx');
        else        
            return Excel::download(new SenaraiPendek($programCode, $filters), 'Permohonan_PPK_Disokong.xlsx');
    }

    // public function cetakBorangSppbExcel(Request $request, $programCode)
    // {
    //     $filters = $request->only(['institusi']);

    //     $query = Permohonan::where('permohonan.status', '4')
    //         ->where('permohonan.program', $programCode);

    //     // Join the necessary tables to access jenis_institusi
    //     $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
    //           ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
    //           ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi');

    //     // Add a condition to check if jenis_institusi is 'UA'
    //     $query->where('bk_info_institusi.jenis_institusi', 'UA');

    //     $kelulusan = $query->get();

    //     return Excel::download(new BorangSPPB($programCode, $filters), 'Borang Permohonan Peruntukan BKOKU.xlsx');
    // }

    public function maklumatKelulusanPermohonan($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        return view('permohonan.sekretariat.kelulusan.maklumat_kelulusan',compact('permohonan'));
    }

    public function hantarKeputusanPermohonan(Request $request, $id)
    {
        // $id refers to permohonan id
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $existingRecord = Kelulusan::where('permohonan_id', $id)->first();

        $keputusan = $request->get('keputusan');

        if ($keputusan == "Lulus") {
            // Update permohonan table
            Permohonan::where('id', $id)->update([
                'status' => 6,
            ]);
        } else {
            // Update permohonan table
            Permohonan::where('id', $id)->update([
                'status' => 7,
            ]);
        }

        // Create an array to store catatan values
        $catatanArray = $request->has('catatan') ? $request->get('catatan') : [];

        if ($existingRecord) 
        {
            // Update the respective row in permohonan_kelulusan table
            $existingRecord->no_mesyuarat = $request->noMesyuarat;
            $existingRecord->tarikh_mesyuarat = $request->tarikhMesyuarat;
            $existingRecord->keputusan = $keputusan;

            // Check if 'catatan' key exists in the request
            if ($request->has('catatan')) {
                $existingRecord->catatan = implode(', ', $catatanArray); // Save catatan values as a comma-separated string
            }
            else {
                $existingRecord->catatan = null; // Or any default value you want for catatan when it's not provided
            }
            $existingRecord->save();
        }
        else 
        {
            // Create a new row in permohonan_kelulusan table
            $info_mesyuarat = new Kelulusan([
                'permohonan_id' => $id,
                'no_mesyuarat' => $request->get('noMesyuarat'),
                'tarikh_mesyuarat' => $request->get('tarikhMesyuarat'),
                'keputusan' => $keputusan,
            ]);

            // Check if 'catatan' key exists in the request
            if ($request->has('catatan')) {
                $info_mesyuarat->catatan = implode(', ', $catatanArray);
            }
            else {
                $info_mesyuarat->catatan = null; // Or any default value you want for catatan when it's not provided
            }
            $info_mesyuarat->save();
        }

        // Update sejarah_permohonan table
        $sejarah = new SejarahPermohonan([
            'smoku_id' => $smoku_id,
            'permohonan_id' => $id,
            'status' => $keputusan == "Lulus" ? 6 : 7,
        ]);
        $sejarah->save();

        // Initialize $catatan with an empty string
        $catatan = '';

        // Check if $existingRecord is defined and not null
        if ($existingRecord) {
            $catatan = implode(', ', $catatanArray);
        }

        // Split the comma-separated string into an array
        $catatanArray = explode(', ', $catatan);

        // Email notification
        $studentEmail = ButiranPelajar::where('smoku_id', $smoku_id)->value('emel');
        $emailLulus = EmelKemaskini::where("emel_id",2)->first();
        $emailTidakLulus = EmelKemaskini::where("emel_id",3)->first();
        Mail::to($studentEmail)->send($keputusan == "Lulus" ? new KeputusanLayak($emailLulus) : new KeputusanTidakLayak($emailTidakLulus,$catatanArray));

        $kelulusan = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
                    ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                    ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                    ->orderBy('permohonan_kelulusan.updated_at', 'desc')
                    ->select('permohonan_kelulusan.*','smoku_akademik.id_institusi')
                    ->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 

        // Pop up notification
        $id_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $notifikasi = "Emel notifikasi telah dihantar kepada " . $id_permohonan;

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan', 'notifikasi', 'kelulusan', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));
    }

    public function hantarSemuaKeputusanPermohonan(Request $request)
    {
        // Get the selected item IDs from the form
        $selectedItemIds = $request->input('selected_items');

        if ($selectedItemIds !== null){

            // Initialize an array to store student email addresses
            $studentEmails = [];

            foreach ($selectedItemIds as $itemId)
            {
                // item is find the permohonan id
                $item = Permohonan::find($itemId);
                // Retrieve the item and existing record
                $existingRecord = Kelulusan::where('permohonan_id', $itemId)->first();

                // 1) Lulus
                if($request->get('keputusan')=="Lulus")
                {
                    // Update the 'Permohonan' model's status
                    $item->update([
                        'status' => 6,
                    ]);

                    // Create a 'SejarahPermohonan' record
                    SejarahPermohonan::create([
                        'smoku_id' => $item->smoku_id,
                        'permohonan_id' => $item->id,
                        'status' => 6,
                    ]);

                    // Check if the record of respective permohonan_id already exists
                    if ($existingRecord)
                    {
                        // Create a 'Kelulusan' record
                        $existingRecord->update([
                            'permohonan_id' => $item->id,
                            'no_mesyuarat' => $request->input('noMesyuarat'),
                            'tarikh_mesyuarat' => $request->input('tarikhMesyuarat'),
                            'keputusan' => $request->input('keputusan'),
                            'catatan' => $request->input('catatan'),
                        ]);
                    }
                    else
                    {
                        // Create a 'Kelulusan' record
                        Kelulusan::create([
                            'permohonan_id' => $item->id,
                            'no_mesyuarat' => $request->input('noMesyuarat'),
                            'tarikh_mesyuarat' => $request->input('tarikhMesyuarat'),
                            'keputusan' => $request->input('keputusan'),
                            'catatan' => $request->input('catatan'),
                        ]);
                    }

                    // COMMENT PROD
                    // Send email notifications to all student email addresses
                    $studentEmail = ButiranPelajar::where('smoku_id',  $item->smoku_id)->value('emel');
                    $emailLulus = EmelKemaskini::where("emel_id",2)->first();
                    if ($studentEmail) {
                        $studentEmails[] = $studentEmail;
                    }

                    foreach ($studentEmails as $studentEmail) {
                        Mail::to($studentEmail)->send(new KeputusanLayak($emailLulus));
                    }
                }
                // 2) Tidak Lulus
                else
                {
                    // Update the 'Permohonan' model's status
                    $item->update([
                        'status' => 7,
                    ]);

                    // Create a 'SejarahPermohonan' record
                    SejarahPermohonan::create([
                        'smoku_id' => $item->smoku_id,
                        'permohonan_id' => $item->id,
                        'status' => 7,
                    ]);

                    // Check if the record of respective permohonan_id already exists
                    if ($existingRecord)
                    {
                        // Create a 'Kelulusan' record
                        $existingRecord->update([
                            'permohonan_id' => $item->id,
                            'no_mesyuarat' => $request->input('noMesyuarat'),
                            'tarikh_mesyuarat' => $request->input('tarikhMesyuarat'),
                            'keputusan' => $request->input('keputusan'),
                            'catatan' => $request->input('catatan'),
                        ]);
                    }
                    else
                    {
                        // Create a 'Kelulusan' record
                        Kelulusan::create([
                            'permohonan_id' => $item->id,
                            'no_mesyuarat' => $request->input('noMesyuarat'),
                            'tarikh_mesyuarat' => $request->input('tarikhMesyuarat'),
                            'keputusan' => $request->input('keputusan'),
                            'catatan' => $request->input('catatan'),
                        ]);
                    }

                    // Send email notifications to all student email addresses
                    $studentEmail = ButiranPelajar::where('smoku_id',  $item->smoku_id)->value('emel');
                    if ($studentEmail) {
                        $studentEmails[] = $studentEmail;
                    }

                    // Set a default value
                    $catatan = '';

                    // Check if $existingRecord is defined and not null
                    if ($existingRecord) {
                        $catatan = $existingRecord->catatan;
                    }

                    // Split the comma-separated string into an array
                    $catatanArray = explode(', ', $catatan);

                    foreach ($studentEmails as $studentEmail) {
                        $emailTidakLulus = EmelKemaskini::where("emel_id",3)->first();
                        Mail::to($studentEmail)->send(new KeputusanTidakLayak($emailTidakLulus, $catatanArray));
                    }
                }
            }
        }

        $kelulusan = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
                    ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                    ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                    ->orderBy('permohonan_kelulusan.updated_at', 'desc')
                    ->select('permohonan_kelulusan.*','smoku_akademik.id_institusi')
                    ->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        // Pop up notification
        $keputusan = $request->get('keputusan');
        $notifikasi = "Emel notifikasi telah dihantar kepada semua pemohon.";

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi','kelulusan','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK' ,'institusiPengajianUA','institusiPengajianPPK'));
    }

    //PERMOHONAN - KEPUTUSAN
    public function senaraiKeputusanPermohonan(Request $request)
    {
        $kelulusan = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
                    ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                    ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                    ->orderBy('permohonan_kelulusan.updated_at', 'desc')
                    ->select('permohonan_kelulusan.*','smoku_akademik.id_institusi')
                    ->get();
        
        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 

        $notifikasi = null;

        return view('permohonan.sekretariat.keputusan.keputusan', compact('kelulusan', 'notifikasi', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));
    }

    public function getKeputusanIPTS()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereNotIn('status', [1, 2, 3, 4, 5, 9, 10])
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'IPTS');
                        });
                        $query->whereHas('peringkat');
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                        $query->with('peringkat');
                    }, 'smoku','kelulusan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getKeputusanPOLI()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereNotIn('status', [1, 2, 3, 4, 5, 9, 10])
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'P');
                        });
                        $query->whereHas('peringkat');
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                        $query->with('peringkat');
                    }, 'smoku','kelulusan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getKeputusanKK()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereNotIn('status', [1, 2, 3, 4, 5, 9, 10])
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'KK');
                        });
                        $query->whereHas('peringkat');
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                        $query->with('peringkat');
                    }, 'smoku','kelulusan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getKeputusanUA()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereNotIn('status', [1, 2, 3, 4, 5, 9, 10])
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'UA');
                        });
                        $query->whereHas('peringkat');
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                        $query->with('peringkat');
                    }, 'smoku','kelulusan'])
                    ->get();        

        return response()->json($permohonan);
    }

    public function getKeputusanPPK()
    {
        $permohonan = Permohonan::where('program', 'PPK')
                    ->whereNotIn('status', [1, 2, 3, 4, 5, 9, 10])
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt');
                        $query->whereHas('peringkat');
                    })
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                        $query->with('peringkat');
                    }, 'smoku','kelulusan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function cetakKeputusanPermohonanIPTS(Request $request)
    {
        set_time_limit(1200);
        // Retrieve filter parameters from the request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');
        $institusi = $request->query('institusi');

        $query = Kelulusan::where('bk_info_institusi.jenis_institusi', '=', 'IPTS')
            ->where('permohonan.program', '=', 'BKOKU')
            ->join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
            ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->when(!empty($startDate) && !empty($endDate), function ($q) use ($startDate, $endDate) {
                return $q->whereBetween('permohonan_kelulusan.tarikh_mesyuarat', [$startDate, $endDate]);
            })
            ->when(!empty($status), function ($q) use ($status) {
                return $q->where('permohonan_kelulusan.keputusan', $status);
            })
            ->when(!empty($institusi), function ($q) use ($institusi) {
                return $q->where('bk_info_institusi.nama_institusi', $institusi);
            })
            ->orderBy('permohonan_kelulusan.updated_at', 'desc');

        $permohonan = $query->get();
        //  dd($permohonan);

        // Load your HTML content
        $html = view('permohonan.sekretariat.keputusan.senarai_keputusan_IPTS_pdf', compact('permohonan'))->render();
        
        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('chroot', public_path());
    
        // Create Dompdf instance with options
        $pdf = new Dompdf($options);
    
        // Load HTML into Dompdf
        $pdf->loadHtml($html);
    
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
    
        // Render the PDF
        $pdf->render();
    
        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();
    
        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(400, 570, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);
    
        // Save the PDF to a file or stream it
        return $pdf->stream('Senarai-Keputusan-Permohonan-BKOKU-IPTS.pdf');
    }

    public function cetakKeputusanPermohonanPOLI(Request $request)
    {
        set_time_limit(1200);
        // Retrieve filter parameters from the request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');
        $institusi = $request->query('institusi');

        $query = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
            ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->when(!empty($startDate) && !empty($endDate), function ($q) use ($startDate, $endDate) {
                return $q->whereBetween('permohonan_kelulusan.tarikh_mesyuarat', [$startDate, $endDate]);
            })
            ->when(!empty($status), function ($q) use ($status) {
                return $q->where('permohonan_kelulusan.keputusan', $status);
            })
            ->when(!empty($institusi), function ($q) use ($institusi) {
                return $q->where('bk_info_institusi.nama_institusi', $institusi);
            })
            ->orderBy('permohonan_kelulusan.updated_at', 'desc');

        $permohonan = $query->get();
        
        // Load your HTML content
        $html = view('permohonan.sekretariat.keputusan.senarai_keputusan_POLI_pdf', compact('permohonan'))->render();
        
        
        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('chroot', public_path());
    
        // Create Dompdf instance with options
        $pdf = new Dompdf($options);
    
        // Load HTML into Dompdf
        $pdf->loadHtml($html);
    
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
    
        // Render the PDF
        $pdf->render();
    
        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();
    
        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(400, 570, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);
    
        // Save the PDF to a file or stream it
        return $pdf->stream('Senarai-Keputusan-Permohonan-BKOKU-POLI.pdf');
    }

    public function cetakKeputusanPermohonanKK(Request $request)
    {
        set_time_limit(1200);
        // Retrieve filter parameters from the request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');
        $institusi = $request->query('institusi');

        $query = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
            ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->when(!empty($startDate) && !empty($endDate), function ($q) use ($startDate, $endDate) {
                return $q->whereBetween('permohonan_kelulusan.tarikh_mesyuarat', [$startDate, $endDate]);
            })
            ->when(!empty($status), function ($q) use ($status) {
                return $q->where('permohonan_kelulusan.keputusan', $status);
            })
            ->when(!empty($institusi), function ($q) use ($institusi) {
                return $q->where('bk_info_institusi.nama_institusi', $institusi);
            })
            ->orderBy('permohonan_kelulusan.updated_at', 'desc');

        $permohonan = $query->get();

        // Load your HTML content
        $html = view('permohonan.sekretariat.keputusan.senarai_keputusan_KK_pdf', compact('permohonan'))->render();
        
        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('chroot', public_path());
    
        // Create Dompdf instance with options
        $pdf = new Dompdf($options);
    
        // Load HTML into Dompdf
        $pdf->loadHtml($html);
    
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
    
        // Render the PDF
        $pdf->render();
    
        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();
    
        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(400, 570, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);
    
        // Save the PDF to a file or stream it
        return $pdf->stream('Senarai-Keputusan-Permohonan-BKOKU-UA.pdf');
    }

    public function cetakKeputusanPermohonanUA(Request $request)
    {
        set_time_limit(1200);
        // Retrieve filter parameters from the request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');
        $institusi = $request->query('institusi');

        $query = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
            ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                return $q->whereBetween('permohonan_kelulusan.tarikh_mesyuarat', [$startDate, $endDate]);
            })
            ->when($status, function ($q) use ($status) {
                return $q->where('permohonan_kelulusan.keputusan', $status);
            })
            ->when($institusi, function ($q) use ($institusi) {
                return $q->where('bk_info_institusi.nama_institusi', $institusi);
            })
            ->orderBy('permohonan_kelulusan.updated_at', 'desc');

        $permohonan = $query->get();

        // Load your HTML content
        $html = view('permohonan.sekretariat.keputusan.senarai_keputusan_BKOKU_UA_pdf', compact('permohonan'))->render();
        
        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('chroot', public_path());
    
        // Create Dompdf instance with options
        $pdf = new Dompdf($options);
    
        // Load HTML into Dompdf
        $pdf->loadHtml($html);
    
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
    
        // Render the PDF
        $pdf->render();
    
        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();
    
        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(400, 570, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);
    
        return $pdf->stream('Senarai-Keputusan-Permohonan-BKOKU-UA.pdf');
    }

    public function cetakKeputusanPermohonanPPK(Request $request)
    {
        set_time_limit(1200);
        // Retrieve filter parameters from the request
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        $status = $request->query('status');
        $institusi = $request->query('institusi');
        
        $query = Kelulusan::join('permohonan', 'permohonan_kelulusan.permohonan_id', '=', 'permohonan.id')
            ->leftJoin('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
                return $q->whereBetween('permohonan_kelulusan.tarikh_mesyuarat', [$startDate, $endDate]);
            })
            ->when($status, function ($q) use ($status) {
                return $q->where('permohonan_kelulusan.keputusan', $status);
            })
            ->when($institusi, function ($q) use ($institusi) {
                return $q->where('bk_info_institusi.nama_institusi', $institusi);
            })
            ->orderBy('permohonan_kelulusan.updated_at', 'desc');

        $permohonan = $query->get();
        
        // Load your HTML content
        $html = view('permohonan.sekretariat.keputusan.senarai_keputusan_PPK_pdf', compact('permohonan'))->render();
        
        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->set('chroot', public_path());
    
        // Create Dompdf instance with options
        $pdf = new Dompdf($options);
    
        // Load HTML into Dompdf
        $pdf->loadHtml($html);
    
        // Set paper size and orientation
        $pdf->setPaper('A4', 'landscape');
    
        // Render the PDF
        $pdf->render();
    
        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();
    
        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(400, 570, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);

        return $pdf->stream('Senarai-Keputusan-Permohonan-PPK.pdf');
    }

    public function muatTurunSuratTawaran($permohonanId)
    {
        // Get the "permohonan" data based on $permohonanId
        $permohonan = Permohonan::where('id', $permohonanId)->first();
        $maklumat_kementerian = MaklumatKementerian::first();
        $kandungan_surat = SuratTawaran::first();

        // Load the view into an HTML string
        $html = view('permohonan.sekretariat.keputusan.surat_tawaran', compact('permohonan', 'maklumat_kementerian','kandungan_surat'))->render();

        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Set the chroot to the public directory
        $options->set('chroot', public_path());

        // Create Dompdf instance with options
        $pdf = new Dompdf($options);

        // Load HTML into Dompdf
        $pdf->loadHtml($html);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the PDF
        $pdf->render();

        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();

        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(290, 810, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);

        // Stream the PDF
        return $pdf->stream('SuratTawaran_'.$permohonanId.'.pdf');
    }

    public function muatTurunSuratTawaranPPK($permohonanId)
    {
        // Get the "permohonan" data based on $permohonanId
        $permohonan = Permohonan::where('id', $permohonanId)->first();
        $maklumat_kementerian = MaklumatKementerian::first();
        $kandungan_surat = SuratTawaran::find(2);

        // Load the view into an HTML string
        $html = view('permohonan.sekretariat.keputusan.surat_tawaran_PPK', compact('permohonan', 'maklumat_kementerian','kandungan_surat'))->render();

        // Create Dompdf options
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Set the chroot to the public directory
        $options->set('chroot', public_path());

        // Create Dompdf instance with options
        $pdf = new Dompdf($options);

        // Load HTML into Dompdf
        $pdf->loadHtml($html);

        // Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the PDF
        $pdf->render();

        // Get the total number of pages
        $totalPages = $pdf->getCanvas()->get_page_count();

        // Add page numbers using CSS
        $pdf->getCanvas()->page_text(290, 810, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);

        // Stream the PDF
        return $pdf->stream('SuratTawaran_'.$permohonanId.'.pdf');
    }

    //PENYALURAN SPBB

    //draf
    public function muatTurunDrafSPPB()
    {
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        
        return view('spbb.sekretariat.draf_spbb', compact('institusiPengajianUA'));
    }

    public function muatTurunDrafSPBB1($id_institusi)
    {
        return Excel::download(new DrafSPBB1($id_institusi), 'Draf-SPBB1.xlsx');
    }

    public function muatTurunDrafSPBB1a($id_institusi)
    {
        return Excel::download(new DrafSPBB1a($id_institusi), 'Draf-SPBB1a.xlsx');
    }

    public function muatTurunDrafSPBB2($id_institusi)
    {
        return Excel::download(new DrafSPBB2($id_institusi), 'Draf-SPBB2.xlsx');
    }

    public function muatTurunDrafSPBB2a($id_institusi)
    {
        return Excel::download(new DrafSPBB2a($id_institusi), 'Draf-SPBB2a.xlsx');
    }

    public function muatTurunDrafSPBB3($id_institusi)
    {
        return Excel::download(new DrafSPBB3($id_institusi), 'Draf-SPBB3.xlsx');
    }

    public function muatTurunDrafLejarPermohonan($id_institusi)
    {
        return Excel::download(new DrafLejarPermohonan($id_institusi), 'Draf-Lejar-Baharu_Permohonan.xlsx');
    }

    public function muatTurunDrafLejarTuntutan($id_institusi)
    {
        
        return Excel::download(new DrafLejarTuntutan($id_institusi), 'Draf-Lejar-SediaAda_Tuntutan.xlsx');
    }

    public function muatTurunDokumenSPPB()
    {
        // Get the latest updated_at for each id_institusi
        $dokumen = DokumenESP::select('dokumen_esp.*')
            ->join(
                DB::raw('(SELECT institusi_id, MAX(updated_at) as latest_update 
                        FROM dokumen_esp 
                        GROUP BY institusi_id) as latest'),
                function ($join) {
                    $join->on('dokumen_esp.institusi_id', '=', 'latest.institusi_id')
                        ->on('dokumen_esp.updated_at', '=', 'latest.latest_update');
                }
            )
            ->orderBy('latest.latest_update', 'desc')
            ->get();

        return view('spbb.sekretariat.muat_turun_dokumen', compact('dokumen'));
    }

    public function salinanDokumenSPPB($id)
    {
        $penyata =  MaklumatBank::where('institusi_id', $id)->first();
        $dokumen = DokumenESP::where('institusi_id', $id)->orderByDesc('id')->first();
        return view('spbb.sekretariat.salinan_dokumen',compact('dokumen','penyata'));
    }

    //TUNTUTAN
    public function senaraiTuntutanKedua(Request $request)
    {
        $status_kod = 0;
        $status = null;

        $tuntutan = Tuntutan::select('tuntutan.*')
                ->whereIn('tuntutan.status', ['2','3','4','5'])
                ->orderBy('tarikh_hantar', 'desc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();
        // dd($institusiPengajianPPK); 
        
        // Extract ID values from the collections
        $idsIPTS = $institusiPengajianIPTS->pluck('id_institusi')->toArray();
        $idsPOLI = $institusiPengajianPOLI->pluck('id_institusi')->toArray();
        $idsKK = $institusiPengajianKK->pluck('id_institusi')->toArray();
        $idsUA = $institusiPengajianUA->pluck('id_institusi')->toArray();
        $idsPPK = $institusiPengajianPPK->pluck('id_institusi')->toArray();

        // Count the number of applications for each institution type with smoku_akademik join
        $countUA = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsUA)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();               

        $countPOLI = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsPOLI)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        $countKK = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsKK)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        $countIPTS = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsIPTS)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        $countPPK = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'PPK')
                            ->whereIn('smoku_akademik.id_institusi', $idsPPK)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        // Debug output
        // dd($countUA, $countPOLI, $countKK, $countIPTS, $countPPK);

        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('tuntutan','status_kod','status', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK', 'countIPTS', 'countPOLI', 'countKK', 'countUA', 'countPPK'));
    }

    //Json saringan
    public function getSenaraiTuntutanBKOKUUA()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'UA');
                    })
                    ->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['2','3','4','5'])
            ->with([
                'akademik' => function ($query) {
                    $query->where('status', 1)->with('infoipt')->with('peringkat');
                },
                'smoku',
                'permohonan'
            ])
            ->orderBy('tarikh_hantar', 'desc')
            ->get();

        // Append name of 'dilaksanakan_oleh'
        foreach ($tuntutan as $item) {
            $user_id = DB::table('sejarah_tuntutan')
                        ->where('tuntutan_id', $item->id)
                        ->where('status', $item->status)
                        ->latest()
                        ->value('dilaksanakan_oleh');
            // Add to response object
            $item->user_id = $user_id;            

            if ($user_id === null || in_array($item->status, [1, 2])) {
                $item->dilaksanakan_oleh_nama = "Tiada Maklumat";
            } else {
                $item->dilaksanakan_oleh_nama = DB::table('users')->where('id', $user_id)->value('nama');
            }
        }

        return response()->json($tuntutan);

    }

    public function getSenaraiTuntutanBKOKUPOLI()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'P');
                    })
                    ->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['2','3','4','5'])
            ->with([
                'akademik' => function ($query) {
                    $query->where('status', 1)->with('infoipt')->with('peringkat');
                },
                'smoku',
                'permohonan'
            ])
            ->orderBy('tarikh_hantar', 'desc')
            ->get();

        // Append name of 'dilaksanakan_oleh'
        foreach ($tuntutan as $item) {
            $user_id = DB::table('sejarah_tuntutan')
                        ->where('tuntutan_id', $item->id)
                        ->where('status', $item->status)
                        ->latest()
                        ->value('dilaksanakan_oleh');
            // Add to response object
            $item->user_id = $user_id;            

            if ($user_id === null || in_array($item->status, [1, 2])) {
                $item->dilaksanakan_oleh_nama = "Tiada Maklumat";
            } else {
                $item->dilaksanakan_oleh_nama = DB::table('users')->where('id', $user_id)->value('nama');
            }
        }

        return response()->json($tuntutan);

    }

    public function getSenaraiTuntutanBKOKUKK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'KK');
                    })
                    ->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['2','3','4','5'])
            ->with([
                'akademik' => function ($query) {
                    $query->where('status', 1)->with('infoipt')->with('peringkat');
                },
                'smoku',
                'permohonan'
            ])
            ->orderBy('tarikh_hantar', 'desc')
            ->get();

        // Append name of 'dilaksanakan_oleh'
        foreach ($tuntutan as $item) {
            $user_id = DB::table('sejarah_tuntutan')
                        ->where('tuntutan_id', $item->id)
                        ->where('status', $item->status)
                        ->latest()
                        ->value('dilaksanakan_oleh');
            // Add to response object
            $item->user_id = $user_id;            

            if ($user_id === null || in_array($item->status, [1, 2])) {
                $item->dilaksanakan_oleh_nama = "Tiada Maklumat";
            } else {
                $item->dilaksanakan_oleh_nama = DB::table('users')->where('id', $user_id)->value('nama');
            }
        }

        return response()->json($tuntutan);

    }

    public function getSenaraiTuntutanBKOKUIPTS()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'IPTS');
                    })
                    ->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['2','3','4','5'])
            ->with([
                'akademik' => function ($query) {
                    $query->where('status', 1)->with('infoipt')->with('peringkat');
                },
                'smoku',
                'permohonan'
            ])
            ->orderBy('tarikh_hantar', 'desc')
            ->get();

        // Append name of 'dilaksanakan_oleh'
        foreach ($tuntutan as $item) {
            $user_id = DB::table('sejarah_tuntutan')
                        ->where('tuntutan_id', $item->id)
                        ->where('status', $item->status)
                        ->latest()
                        ->value('dilaksanakan_oleh');
            // Add to response object
            $item->user_id = $user_id;            

            if ($user_id === null || in_array($item->status, [1, 2])) {
                $item->dilaksanakan_oleh_nama = "Tiada Maklumat";
            } else {
                $item->dilaksanakan_oleh_nama = DB::table('users')->where('id', $user_id)->value('nama');
            }
        }

        return response()->json($tuntutan);

    }

    public function getSenaraiTuntutanPPK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    // ->whereHas('infoipt', function ($subQuery) {
                    //     $subQuery->where('jenis_institusi', '=', 'UA');
                    // })
                    ->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'PPK');
            })
            ->whereIn('status', ['2','3','4','5'])
            ->with([
                'akademik' => function ($query) {
                    $query->where('status', 1)->with('infoipt')->with('peringkat');
                },
                'smoku',
                'permohonan'
            ])
            ->orderBy('tarikh_hantar', 'desc')
            ->get();

        // Append name of 'dilaksanakan_oleh'
        foreach ($tuntutan as $item) {
            $user_id = DB::table('sejarah_tuntutan')
                        ->where('tuntutan_id', $item->id)
                        ->where('status', $item->status)
                        ->latest()
                        ->value('dilaksanakan_oleh');
            // Add to response object
            $item->user_id = $user_id;            

            if ($user_id === null || in_array($item->status, [1, 2])) {
                $item->dilaksanakan_oleh_nama = "Tiada Maklumat";
            } else {
                $item->dilaksanakan_oleh_nama = DB::table('users')->where('id', $user_id)->value('nama');
            }
        }

        return response()->json($tuntutan);

    }

    public function keputusanPeperiksaan($id)
    {
        $peperiksaan = Peperiksaan::where('permohonan_id',$id)->get();
        return view('tuntutan.sekretariat.saringan.keputusan_peperiksaan',compact('peperiksaan'));
    }

    public function maklumatTuntutanKedua($id)
    {
        Tuntutan::where('id', $id)
            ->update([
                'status'   =>  3,
            ]);

        $tuntutan = Tuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $penyata_bank = Dokumen::where('permohonan_id', $tuntutan->permohonan_id)
                        ->where('id_dokumen', 1)->first();
        // dd($penyata_bank);
        $smoku_id = Permohonan::where('id', $tuntutan->permohonan_id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $no_akaun = ButiranPelajar::where('smoku_id', $smoku->id)->value('no_akaun_bank');

        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '8')->where('id', '<', $id)->orderBy('id','desc')->first();
        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;
        $sama_semester = false; //semester sama

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        
        if($tuntutan->sesi != $sesi_sebelum){
            // Retrieve amount ews // penerima biasiswa sedia ada, amaun masih 2400
            if ($akademik->sumber_biaya == 1){
                $j_tuntutan = JumlahTuntutan::where('program',"BKOKU")->where('jenis',"Wang Saku")->where('semester', 'B')->first();
                $baki_terdahulu = $j_tuntutan->jumlah;
                
            } else{
                if ($permohonan->program == 'BKOKU'){
                    $j_tuntutan = JumlahTuntutan::where('program',"BKOKU")->where('jenis',"Wang Saku")->first();
                    $baki_terdahulu = $j_tuntutan->jumlah;
                } else {
                    $j_tuntutan = JumlahTuntutan::where('program',"PPK")->where('jenis',"Wang Saku")->where('semester', $tuntutan->semester)->first();
                    $baki_terdahulu = $j_tuntutan->jumlah;
                }
            }
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true; //semester lain
            }
        }
        

        $status_rekod = new SejarahTuntutan([
            'smoku_id'          =>  $smoku_id,
            'tuntutan_id'       =>  $id,
            'status'            =>  3,
            'dilaksanakan_oleh'    =>  Auth::user()->id,
        ]);
        $status_rekod->save();

        return view('tuntutan.sekretariat.saringan.maklumat_tuntutan',compact('sama_semester','baki_terdahulu','permohonan','smoku','akademik','tuntutan','tuntutan_item','penyata_bank','no_akaun'));
    }

    public function setSemulaStatus($id)
    {
        Tuntutan::where('id', $id)
            ->update([
                'status'   =>  2,
            ]);

        $tuntutan = Tuntutan::where('id',$id)->first();
        $sejarah_tuntutan = SejarahTuntutan::where('tuntutan_id',$id)->where('status',2)->first();

        $status_rekod = new SejarahTuntutan([
            'smoku_id'              =>  $tuntutan->smoku_id,
            'tuntutan_id'           =>  $id,
            'status'                =>  2,
            'dilaksanakan_oleh'     =>  $sejarah_tuntutan->dilaksanakan_oleh,
        ]);
        $status_rekod->save();

        return redirect()->route('senarai.tuntutan.kedua');
       
    }

    public function saringTuntutanKedua(Request $request, $id)
    {
        $no_rujukan_tuntutan= Tuntutan::where('id', $id)->value('no_rujukan_tuntutan');
        $permohonan_id = Tuntutan::where('id', $id)->value('permohonan_id');
        $smoku_id = Permohonan::where('id', $permohonan_id)->value('smoku_id');

        $count_item =TuntutanItem::where('tuntutan_id', $id)->count();
        if($count_item==1){
            $tuntutan_item =TuntutanItem::where('tuntutan_id', $id)->first();
        }
        elseif($count_item>1){
            $tuntutan_item =TuntutanItem::where('tuntutan_id', $id)->get();
        }

        // 1) LAYAK
        if($request->get('submit')=="Layak"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  6,
                ]);

            Tuntutan::where('id', $id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'baki_disokong'         =>  $request->get('baki_disokong'),
                    'status'                =>  6,
                ]);

            $i=0;

            $invois = $request->get('invois');

            if($count_item==1){
                TuntutanItem::where('id', $tuntutan_item->id)
                    ->update([
                        'kep_saringan'      =>  $invois[0],
                    ]);
            }
            elseif($count_item>1){
                foreach($tuntutan_item as $item){
                    TuntutanItem::where('id', $item['id'])
                        ->update([
                            'kep_saringan'      =>  $invois[$i],
                        ]);
                    $i++;
                }
            }


            // Check if 'saringan_kep_peperiksaan' is present in the request
            if ($request->has('peperiksaan')) {
                // Check if a record with the provided 'tuntutan_id' and 'saringan_kep_peperiksaan' already exists
                $existingTuntutan = SaringanTuntutan::where('tuntutan_id', $id)
                    ->where('saringan_kep_peperiksaan', $request->get('peperiksaan'))
                    ->first();

                if (!$existingTuntutan) {
                    // Create a new SaringanTuntutan instance with null saringan_kep_peperiksaan
                    $saringan = new SaringanTuntutan([
                        'tuntutan_id'               =>  $id,
                        'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                        'catatan'                   =>  $request->get('catatan'),
                        'status'                    =>  6,
                    ]);
                    $saringan->save();
                } else {
                    // Create a new SaringanTuntutan instance with the provided values
                    $saringan = new SaringanTuntutan([
                        'tuntutan_id'               =>  $id,
                        'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                        'catatan'                   =>  $request->get('catatan'),
                        'status'                    =>  6,
                    ]);
                    $saringan->save();
                }
            } else {
                // Create a new SaringanTuntutan instance with null saringan_kep_peperiksaan
                $saringan = new SaringanTuntutan([
                    'tuntutan_id'               =>  $id,
                    'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                    'catatan'                   =>  $request->get('catatan'),
                    'status'                    =>  6,
                ]);
                $saringan->save();
            }


            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $id,
                'status'            =>  6,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            // COMMENT PROD
            $penyelaras_id = SejarahTuntutan::where('tuntutan_id', $id)->where('status', 2)->value('dilaksanakan_oleh');
            $penyelaras_emel = User::where('id', $penyelaras_id)->value('email');
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            $id_institusi = Akademik::where('id', $smoku_id)->value('id_institusi');
            $jenis_institusi = InfoIpt::where('id_institusi', $id_institusi)->value('jenis_institusi');

            if ($program == "BKOKU") {
                $emel = EmelKemaskini::where('emel_id', 5)->first();

                // Clean and validate $smoku_emel
                $smoku_emel = trim($smoku_emel);
                
                // Validate email
                $isValidEmail = filter_var($smoku_emel, FILTER_VALIDATE_EMAIL);

                if (empty(trim($smoku_emel)) || !$isValidEmail) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($penyelaras_emel)->send(new TuntutanLayak($emel));
                    }
                    
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanLayak($emel));
                    }
                    else{
                        Mail::to($smoku_emel)->send(new TuntutanLayak($emel));
                    }
                }
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',11)->first();
                if (empty(trim($smoku_emel))) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    Mail::to($penyelaras_emel)->send(new TuntutanLayak($emel));
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanLayak($emel));
                }
            }

            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah disaring dengan status 'Layak'.";
        }
        // 2) TIDAK LAYAK
        elseif($request->get('submit')=="TidakLayak"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  7,
                ]);

            Tuntutan::where('id', $id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'baki_disokong'         =>  $request->get('baki_disokong'),
                    'status'                =>  7,
                ]);

            $i=0;
            $invois = $request->get('invois');
            if($count_item==1){
                TuntutanItem::where('id', $tuntutan_item->id)
                    ->update([
                        'kep_saringan'      =>  $invois[0],
                    ]);
            }
            elseif($count_item>1){
                foreach($tuntutan_item as $item){
                    TuntutanItem::where('id', $item['id'])
                        ->update([
                            'kep_saringan'      =>  $invois[$i],
                        ]);
                    $i++;
                }
            }

            // $saringan = new SaringanTuntutan([
            //     'tuntutan_id'               =>  $id,
            //     'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
            //     'catatan'                   =>  $request->get('catatan'),
            //     'status'                    =>  7,
            // ]);
            // $saringan->save();

            // Check if 'saringan_kep_peperiksaan' is present in the request
            if ($request->has('peperiksaan')) {
                // Check if a record with the provided 'tuntutan_id' and 'saringan_kep_peperiksaan' already exists
                $existingTuntutan = SaringanTuntutan::where('tuntutan_id', $id)
                    ->where('saringan_kep_peperiksaan', $request->get('peperiksaan'))
                    ->first();

                if (!$existingTuntutan) {
                    // Create a new SaringanTuntutan instance with null saringan_kep_peperiksaan
                    $saringan = new SaringanTuntutan([
                        'tuntutan_id'               =>  $id,
                        'saringan_kep_peperiksaan'  =>  null,
                        'catatan'                   =>  $request->get('catatan'),
                        'status'                    =>  7,
                    ]);
                    $saringan->save();
                } else {
                    // Create a new SaringanTuntutan instance with the provided values
                    $saringan = new SaringanTuntutan([
                        'tuntutan_id'               =>  $id,
                        'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                        'catatan'                   =>  $request->get('catatan'),
                        'status'                    =>  7,
                    ]);
                    $saringan->save();
                }
            } else {
                // Create a new SaringanTuntutan instance with null saringan_kep_peperiksaan
                $saringan = new SaringanTuntutan([
                    'tuntutan_id'               =>  $id,
                    'saringan_kep_peperiksaan'  =>  null,
                    'catatan'                   =>  $request->get('catatan'),
                    'status'                    =>  7,
                ]);
                $saringan->save();
            }

            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $id,
                'status'            =>  7,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            $saringan = SaringanTuntutan::where('tuntutan_id',$id)->first();
            $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();

            // COMMENT PROD
            $penyelaras_id = SejarahTuntutan::where('tuntutan_id', $id)->where('status', 2)->value('dilaksanakan_oleh');
            $penyelaras_emel = User::where('id', $penyelaras_id)->value('email');
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            $id_institusi = Akademik::where('id', $smoku_id)->value('id_institusi');
            $jenis_institusi = InfoIpt::where('id_institusi', $id_institusi)->value('jenis_institusi');

            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',6)->first();
                // Clean and validate $smoku_emel
                $smoku_emel = trim($smoku_emel);
                
                // Validate email
                $isValidEmail = filter_var($smoku_emel, FILTER_VALIDATE_EMAIL);

                if (empty(trim($smoku_emel)) || !$isValidEmail) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                    }
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                    } else{
                        Mail::to($smoku_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                    }
                }
                
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',12)->first();
                if (empty(trim($smoku_emel))) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    Mail::to($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                }
            }

            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah disaring dengan status 'Tidak Layak'.";
        }
        // 3) DIKEMBALIKAN
        elseif($request->get('submit')=="Kembalikan"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  5,
                ]);

            Tuntutan::where('id', $id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'baki_disokong'         =>  $request->get('baki_disokong'),
                    'status'                =>  5,
                ]);

            $i=0;
            $invois = $request->get('invois');
            if($count_item==1){
                TuntutanItem::where('id', $tuntutan_item->id)
                    ->update([
                        'kep_saringan'      =>  $invois[0],
                    ]);
            }
            elseif($count_item>1){
                foreach($tuntutan_item as $item){
                    TuntutanItem::where('id', $item['id'])
                        ->update([
                            'kep_saringan'      =>  $invois[$i],
                        ]);
                    $i++;
                }
            }

            // Check if 'saringan_kep_peperiksaan' is present in the request
            if ($request->has('peperiksaan')) {
                // Check if a record with the provided 'tuntutan_id' and 'saringan_kep_peperiksaan' already exists
                $existingTuntutan = SaringanTuntutan::where('tuntutan_id', $id)
                    ->where('saringan_kep_peperiksaan', $request->get('peperiksaan'))
                    ->first();

                if (!$existingTuntutan) {
                    // Create a new SaringanTuntutan instance with null saringan_kep_peperiksaan
                    $saringan = new SaringanTuntutan([
                        'tuntutan_id'               =>  $id,
                        'saringan_kep_peperiksaan'  =>  null,
                        'catatan'                   =>  $request->get('catatan'),
                        'status'                    =>  5,
                    ]);
                    $saringan->save();
                } else {
                    // Create a new SaringanTuntutan instance with the provided values
                    $saringan = new SaringanTuntutan([
                        'tuntutan_id'               =>  $id,
                        'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                        'catatan'                   =>  $request->get('catatan'),
                        'status'                    =>  5,
                    ]);
                    $saringan->save();
                }
            } else {
                // Create a new SaringanTuntutan instance with null saringan_kep_peperiksaan
                $saringan = new SaringanTuntutan([
                    'tuntutan_id'               =>  $id,
                    'saringan_kep_peperiksaan'  =>  null,
                    'catatan'                   =>  $request->get('catatan'),
                    'status'                    =>  5,
                ]);
                $saringan->save();
            }


            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $id,
                'status'            =>  5,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            $saringan = SaringanTuntutan::where('tuntutan_id',$id)->first();
            $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();

            // COMMENT PROD
            $penyelaras_id = SejarahTuntutan::where('tuntutan_id', $id)->where('status', 2)->value('dilaksanakan_oleh');
            $penyelaras_emel = User::where('id', $penyelaras_id)->value('email');
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            $id_institusi = Akademik::where('id', $smoku_id)->value('id_institusi');
            $jenis_institusi = InfoIpt::where('id_institusi', $id_institusi)->value('jenis_institusi');

            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',4)->first();
                // Clean and validate $smoku_emel
                $smoku_emel = trim($smoku_emel);
                
                // Validate email
                $isValidEmail = filter_var($smoku_emel, FILTER_VALIDATE_EMAIL);

                if (empty(trim($smoku_emel)) || !$isValidEmail) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                    }
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                    }else{
                        Mail::to($smoku_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                    }
                }
               
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',10)->first();
                if (empty(trim($smoku_emel))) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    Mail::to($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                }
            }

            $status_kod=2;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah dikembalikan.";
        }

        $tuntutan = Tuntutan::where('status', '2')
            ->orWhere('status', '=','3')
            ->orWhere('status', '=','5')
            ->orWhere('status', '=','6')
            ->orWhere('status', '=','7')
            ->orderBy('created_at', 'DESC')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 
        
        // Extract ID values from the collections
        $idsIPTS = $institusiPengajianIPTS->pluck('id_institusi')->toArray();
        $idsPOLI = $institusiPengajianPOLI->pluck('id_institusi')->toArray();
        $idsKK = $institusiPengajianKK->pluck('id_institusi')->toArray();
        $idsUA = $institusiPengajianUA->pluck('id_institusi')->toArray();
        $idsPPK = $institusiPengajianPPK->pluck('id_institusi')->toArray();

        // Count the number of applications for each institution type with smoku_akademik join
        $countUA = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsUA)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();               

        $countPOLI = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsPOLI)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        $countKK = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsKK)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        $countIPTS = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'BKOKU')
                            ->whereIn('smoku_akademik.id_institusi', $idsIPTS)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();

        $countPPK = Tuntutan::join('permohonan','permohonan.id','=','tuntutan.permohonan_id')
                            ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                            ->where('smoku_akademik.status', 1)
                            ->where('permohonan.program', 'PPK')
                            ->whereIn('smoku_akademik.id_institusi', $idsPPK)
                            ->whereIn('tuntutan.status', ['2'])
                            ->count();
        // return redirect()->route('senarai.tuntutan.kedua');
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK', 'countIPTS', 'countPOLI', 'countKK', 'countUA', 'countPPK','tuntutan','status_kod','status'));
    }

    public function keputusanTuntutan(Request $request)
    {
        $tuntutan = Tuntutan::leftJoin('smoku_akademik', 'tuntutan.smoku_id', '=', 'smoku_akademik.smoku_id')
                    ->leftJoin('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                    ->leftJoin('bk_status', 'tuntutan.status', '=', 'bk_status.kod_status')
                    ->whereIn('tuntutan.status', ['5','6','7'])
                    ->orderBy('tuntutan.updated_at', 'desc')
                    ->select('tuntutan.*','smoku_akademik.id_institusi','bk_status.status as keputusan')
                    ->get();          

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 

        return view('tuntutan.sekretariat.keputusan.keputusan_tuntutan', compact('tuntutan','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));
    }

    public function getKeputusanTuntutanIPTS()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'IPTS');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['5','6','7'])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt')->with('peringkat');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getKeputusanTuntutanPOLI()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'P');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['5','6','7'])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt')->with('peringkat');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getKeputusanTuntutanKK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'KK');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['5','6','7'])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt')->with('peringkat');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getKeputusanTuntutanBKOKUUA()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'UA');
                    });
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->whereIn('status', ['5','6','7'])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt')->with('peringkat');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);

    }

    public function getKeputusanTuntutanPPK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt');
                $query->whereHas('peringkat');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'PPK');
            })
            ->whereIn('status', ['5','6','7'])
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt')->with('peringkat');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);

    }

    //Papar Tuntutan Telah Disaring
    public function paparTuntutanKedua($id){
        $tuntutan = Tuntutan::where('id', $id)->first();
        $sejarah_t = SejarahTuntutan::where('tuntutan_id', $id)->where('status', $tuntutan->status)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();

        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '8')->where('id', '<', $id)->orderBy('id','desc')->first();
        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;
        $sama_semester = false;

        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true;
            }
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.saringan.papar_tuntutan',compact('sama_semester','baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function kemaskiniTuntutan($id){
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '6')->where('id', '<', $sejarah_t->tuntutan_id)->orderBy('id','desc')->first();
        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;

        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.saringan.kemaskini_tuntutan',compact('baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function hantarTuntutan(Request $request, $id){
        $t_id = SejarahTuntutan::where('id', $id)->value('tuntutan_id');
        $no_rujukan_tuntutan= Tuntutan::where('id', $t_id)->value('no_rujukan_tuntutan');
        $permohonan_id = Tuntutan::where('id', $t_id)->value('permohonan_id');
        $smoku_id = Tuntutan::where('id', $t_id)->value('smoku_id');
        // dd($no_rujukan_tuntutan);
        // Tuntutan::where('id', $t_id)
        //     ->update([
        //         'baki_disokong'         =>  $request->get('baki_disokong'),
        //         'yuran_disokong'        =>  $request->get('yuran_disokong'),
        //         'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
        //     ]);

        // 1) LAYAK
        if($request->get('keputusan')=="Layak"){

            Tuntutan::where('id', $t_id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'status'                =>  6,
                ]);

            $i=0;

            $existingTuntutan = SaringanTuntutan::where('tuntutan_id', $t_id)->first();
            // Update rekod sedia ada
            $existingTuntutan->update([
                'catatan' => $request->catatan,
                'status'  => 6,
            ]);
            
            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $t_id,
                'status'            =>  6,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            // EMEL
            $penyelaras_id = SejarahTuntutan::where('tuntutan_id', $t_id)->where('status', 2)->value('dilaksanakan_oleh');
            $penyelaras_emel = User::where('id', $penyelaras_id)->value('email');
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            $id_institusi = Akademik::where('id', $smoku_id)->value('id_institusi');
            $jenis_institusi = InfoIpt::where('id_institusi', $id_institusi)->value('jenis_institusi');

            if ($program == "BKOKU") {
                $emel = EmelKemaskini::where('emel_id', 5)->first();

                // Clean and validate $smoku_emel
                $smoku_emel = trim($smoku_emel);
                
                // Validate email
                $isValidEmail = filter_var($smoku_emel, FILTER_VALIDATE_EMAIL);

                if (empty(trim($smoku_emel)) || !$isValidEmail) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($penyelaras_emel)->send(new TuntutanLayak($emel));
                    }
                    
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanLayak($emel));
                    }
                    else{
                        Mail::to($smoku_emel)->send(new TuntutanLayak($emel));
                    }
                }
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',11)->first();
                if (empty(trim($smoku_emel))) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    Mail::to($penyelaras_emel)->send(new TuntutanLayak($emel));
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanLayak($emel));
                }
            }

            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah disaring dengan status 'Layak'.";
        }
        
        // 2) TIDAK LAYAK
        elseif($request->get('keputusan')=="TidakLayak"){

            Tuntutan::where('id', $t_id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'status'                =>  7,
                ]);

            $i=0;

            $existingTuntutan = SaringanTuntutan::where('tuntutan_id', $t_id)->first();
            // Update rekod sedia ada
            $existingTuntutan->update([
                'catatan' => $request->catatan,
                'status'  => 7,
            ]);
            
            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $t_id,
                'status'            =>  7,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();
            $saringan = SaringanTuntutan::where('tuntutan_id',$t_id)->first();
            $tuntutan_item = TuntutanItem::where('tuntutan_id', $t_id)->get();

            // EMEL
            $penyelaras_id = SejarahTuntutan::where('tuntutan_id', $t_id)->where('status', 2)->value('dilaksanakan_oleh');
            $penyelaras_emel = User::where('id', $penyelaras_id)->value('email');
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            $id_institusi = Akademik::where('id', $smoku_id)->value('id_institusi');
            $jenis_institusi = InfoIpt::where('id_institusi', $id_institusi)->value('jenis_institusi');

            if ($program == "BKOKU") {
                $emel = EmelKemaskini::where('emel_id', 6)->first();

                // Clean and validate $smoku_emel
                $smoku_emel = trim($smoku_emel);
                
                // Validate email
                $isValidEmail = filter_var($smoku_emel, FILTER_VALIDATE_EMAIL);

                if (empty(trim($smoku_emel)) || !$isValidEmail) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                    }
                    
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                    } else{
                        Mail::to($smoku_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                    }
                }
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',12)->first();
                if (empty(trim($smoku_emel))) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    Mail::to($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
                }
            }

            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah disaring dengan status 'Tidak Layak'.";
        } 

        // 3) DIKEMBALIKAN
        elseif($request->get('keputusan')=="Kembalikan"){

            Tuntutan::where('id', $t_id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'status'                =>  5,
                ]);

            $i=0;

            $existingTuntutan = SaringanTuntutan::where('tuntutan_id', $t_id)->first();
            // Update rekod sedia ada
            $existingTuntutan->update([
                'catatan' => $request->catatan,
                'status'  => 5,
            ]);
            
            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $t_id,
                'status'            =>  5,
                'dilaksanakan_oleh' =>  Auth::user()->id,
            ]);
            $status_rekod->save();
            $saringan = SaringanTuntutan::where('tuntutan_id',$t_id)->first();
            $tuntutan_item = TuntutanItem::where('tuntutan_id', $t_id)->get();

            // EMEL
            $penyelaras_id = SejarahTuntutan::where('tuntutan_id', $id)->where('status', 2)->value('dilaksanakan_oleh');
            $penyelaras_emel = User::where('id', $penyelaras_id)->value('email');
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            $id_institusi = Akademik::where('id', $smoku_id)->value('id_institusi');
            $jenis_institusi = InfoIpt::where('id_institusi', $id_institusi)->value('jenis_institusi');

            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',4)->first();
                // Clean and validate $smoku_emel
                $smoku_emel = trim($smoku_emel);
                
                // Validate email
                $isValidEmail = filter_var($smoku_emel, FILTER_VALIDATE_EMAIL);

                if (empty(trim($smoku_emel)) || !$isValidEmail) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                    }
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    if($jenis_institusi != 'IPTS'){
                        Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                    }else{
                        Mail::to($smoku_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                    }
                }
               
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',10)->first();
                if (empty(trim($smoku_emel))) {
                    // If $smoku_emel is blank or contains only spaces, just send to penyelaras
                    Mail::to($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                } else {
                    // Otherwise, send to smoku with cc to penyelaras
                    Mail::to($smoku_emel)->cc($penyelaras_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
                }
            }

            $status_kod=2;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah dikembalikan.";
        }

        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)
        ->where('status', '8')
        ->where('id', '<', $sejarah_t->tuntutan_id)
        ->orderBy('id','desc')->first();

        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;
        $sama_semester = false;
        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true;
            }
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        // dd($baki_terdahulu);

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.saringan.papar_tuntutan',compact('sama_semester','baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    //Sejarah
    public function senaraiTuntutan()
    {
        $permohonan = Permohonan::orderBy('created_at', 'DESC')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 
        
        return view('tuntutan.sekretariat.sejarah.senarai_tuntutan',compact('permohonan','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK','institusiPengajianUA','institusiPengajianPPK'));
    }

    public function getDataSenaraiIPTS()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'IPTS');
                            });
                    })
                    ->whereHas('tuntutan') // Filter only Permohonan records that have associated Tuntutan records
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)
                            ->with('infoipt');
                    }, 'smoku', 'tuntutan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getDataSenaraiPOLI()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'P');
                            });
                    })
                    ->whereHas('tuntutan') // Filter only Permohonan records that have associated Tuntutan records
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)
                            ->with('infoipt');
                    }, 'smoku', 'tuntutan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getDataSenaraiKK()
    {
        $permohonan = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1)
                            ->whereHas('infoipt', function ($subQuery) {
                                $subQuery->where('jenis_institusi', '=', 'KK');
                            });
                    })
                    ->whereHas('tuntutan') // Filter only Permohonan records that have associated Tuntutan records
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1)
                            ->with('infoipt');
                    }, 'smoku', 'tuntutan'])
                    ->get();

        return response()->json($permohonan);
    }

    public function getDataSenaraiUA()
    {
        $permohonanUA = Permohonan::where('program', 'BKOKU')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt', function ($subQuery) {
                            $subQuery->where('jenis_institusi', '=', 'UA');
                        });
                    })
                    ->whereHas('tuntutan') // Filter only Permohonan records that have associated Tuntutan records
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku', 'tuntutan'])
                    ->get();


        return response()->json($permohonanUA);
    }

    public function getDataSenaraiPPK()
    {
        $permohonanPPK = Permohonan::where('program', 'PPK')
                    ->whereHas('akademik', function ($query) {
                        $query->where('status', 1);
                        $query->whereHas('infoipt');
                    })
                    ->whereHas('tuntutan') // Filter only Permohonan records that have associated Tuntutan records
                    ->with(['akademik' => function ($query) {
                        $query->where('status', 1);
                        $query->with('infoipt');
                    }, 'smoku', 'tuntutan'])
                    ->get();


        return response()->json($permohonanPPK);
    }

    public function sejarahTuntutan($id)
    {
        $smoku_id = $id;

        return view('tuntutan.sekretariat.sejarah.sejarah_tuntutan',compact('smoku_id'));
    }

    public function getDataSejarahTuntutan($id)
    {
        $tuntutan = Tuntutan::where('smoku_id', $id)->get();


        return response()->json($tuntutan);
    }

    public function rekodTuntutan($id)
    {
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        $sejarah_t = SejarahTuntutan::where('tuntutan_id', $id)->where('status', '!=','4')->orderBy('created_at', 'desc')->get();
        return view('tuntutan.sekretariat.sejarah.rekod_tuntutan',compact('tuntutan','akademik','smoku','sejarah_t','permohonan'));
    }

    public function paparRekodTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();

        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '6')->where('id', '<', $sejarah_t->tuntutan_id)->orderBy('id','desc')->first();
        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;

        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.sejarah.papar_tuntutan',compact('baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }
    public function paparRekodSaringanTuntutan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        // dd($sejarah_t);
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();

        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)
        ->where('status', '8')
        ->where('id', '<', $sejarah_t->tuntutan_id)
        ->orderBy('id','desc')->first();

        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;
        $sama_semester = false;
        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true;
            }
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        // dd($baki_terdahulu);

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.sejarah.papar_saringan',compact('sama_semester','baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function paparRekodPembayaran($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.sejarah.papar_pembayaran',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','saringan','sejarah_t'));
    }

    public function kemaskiniSaringan($id)
    {
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '8')->where('id', '<', $sejarah_t->tuntutan_id)->orderBy('id','desc')->first();
        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;

        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.sejarah.kemaskini_saringan',compact('baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function hantarSaringan(Request $request, $id)
    {
        $t_id = SejarahTuntutan::where('id', $id)->value('tuntutan_id');
        Tuntutan::where('id', $t_id)
            ->update([
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki_disokong'         =>  $request->get('baki_disokong'),
            ]);

        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $tuntutan->no_rujukan_tuntutan);
        $peringkat = $rujukan[1];
        $no_tuntutan = $rujukan[3];

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '8')->where('id', '<', $sejarah_t->tuntutan_id)->orderBy('id','desc')->first();
        if($tuntutan_sebelum!=null){
            $sesi_sebelum = $tuntutan_sebelum->sesi;
        }
        else{
            $sesi_sebelum = null;
        }

        $baki_terdahulu = 0;
        $sama_semester = false;

        if($no_tuntutan == 1){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true;
            }
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.sejarah.papar_saringan',compact('sama_semester','baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    //Pembayaran
    public function senaraiPembayaran()
    {
        $tuntutan = Tuntutan::where('status', '8')->orderBy('created_at', 'DESC')->get();
        $status_kod = 0;
        $status = null;

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get(); 

        return view('tuntutan.sekretariat.pembayaran.senarai',compact('tuntutan','status_kod','status','institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK','institusiPengajianUA','institusiPengajianPPK'));
    }

    public function getPembayaranTuntutanIPTS()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'IPTS');
                    });
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->where('status', 8)
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getPembayaranTuntutanPOLI()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'P');
                    });
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->where('status', 8)
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getPembayaranTuntutanKK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'KK');
                    });
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->where('status', 8)
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getPembayaranTuntutanUA()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt', function ($subQuery) {
                        $subQuery->where('jenis_institusi', '=', 'UA');
                    });
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'BKOKU');
            })
            ->where('status', 8)
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function getPembayaranTuntutanPPK()
    {
        $tuntutan = Tuntutan::whereHas('akademik', function ($query) {
                $query->where('status', 1)
                    ->whereHas('infoipt');
            })
            ->whereHas('permohonan', function ($query) {
                $query->where('program', 'PPK');
            })
            ->where('status', 8)
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
            }, 'smoku', 'permohonan'])
            ->get();

        return response()->json($tuntutan);
    }

    public function cetakSenaraiPenyaluranExcel(Request $request, $programCode)
    {
        $institusi = $request->input('institusi');

        return Excel::download(new PenyaluranTuntutan($programCode, $institusi), 'SenaraiPenyaluran.xlsx');
    }

    public function kemaskiniInfoCek(Request $request)
    {
        // Get the selected item IDs from the form
        $selectedItemIds = $request->input('selected_items');

        if ($selectedItemIds !== null)
        {
            foreach ($selectedItemIds as $itemId){

                $tuntutan = Tuntutan::orderBy('id', 'desc')->where('id', '=', $itemId)->first();
                if ($tuntutan != null) {
                    Tuntutan::where('id' ,$itemId)
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
        $tuntutan = Tuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = Permohonan::where('id', $tuntutan->permohonan_id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.pembayaran.maklumat',compact('permohonan','smoku','akademik','tuntutan','tuntutan_item'));
    }

    public function saringPembayaran(Request $request, $id)
    {
        $no_rujukan_tuntutan= Tuntutan::where('id', $id)->value('no_rujukan_tuntutan');
        $permohonan_id = Tuntutan::where('id', $id)->value('permohonan_id');
        $smoku_id = Permohonan::where('id', $permohonan_id)->value('smoku_id');

        Tuntutan::where('id', $id)
            ->update([
                'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_dibayar'     =>  $request->get('w_saku_dibayar'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'baki_dibayar'          =>  $request->get('w_saku_dibayar'),
                'baki_disokong'         =>  $request->get('w_saku_disokong'),
                'catatan_dibayar'       =>  $request->get('catatan_dibayar'),
                'status'                =>  8,
            ]);

        $status_rekod = new SejarahTuntutan([
            'smoku_id'      =>  $smoku_id,
            'tuntutan_id'   =>  $id,
            'status'        =>  8,
            'dilaksanakan_oleh'    =>  Auth::user()->id,
        ]);
        $status_rekod->save();

        $status_kod=1;
        $status = "Tuntutan ".$no_rujukan_tuntutan." telah dibayar.";
        $tuntutan = Tuntutan::where('status', '8')->orderBy('created_at', 'DESC')->get();

        return view('tuntutan.sekretariat.pembayaran.senarai',compact('tuntutan','status_kod','status'));
    }

    public function paparPembayaran($id)
    {
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        $secretKey = 't73QYeipBMmHcDuzGAcNSXP_bgbOFXMyLM99OARs';

        return view('tuntutan.sekretariat.pembayaran.papar',compact('permohonan','secretKey','tuntutan','tuntutan_item','smoku','akademik','saringan'));
    }

    public function kemaskiniPembayaran($id)
    {
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        return view('tuntutan.sekretariat.pembayaran.kemaskini',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik'));
    }

    public function hantarPembayaran(Request $request, $id)
    {
        Tuntutan::where('id', $id)
            ->update([
                'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_dibayar'     =>  $request->get('w_saku_dibayar'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                'catatan_dibayar'       =>  $request->get('catatan_dibayar'),
            ]);

        $no_rujukan_tuntutan= Tuntutan::where('id', $id)->value('no_rujukan_tuntutan');
        $status_kod=1;
        $status = "Tuntutan ".$no_rujukan_tuntutan." berjaya dikemaskini.";

        $tuntutan = Tuntutan::where('status', '8')->orderBy('created_at', 'DESC')->get();

        return view('tuntutan.sekretariat.pembayaran.senarai',compact('tuntutan','status_kod','status'));
    }

    public function senaraiTukarInstitusi()
    {
        $tukar_institusi = TukarInstitusi::join('smoku','smoku.id','=','tukar_institusi.smoku_id')
        ->orderBy('tukar_institusi.id', 'DESC')
        ->get(['smoku.*','tukar_institusi.*']);

        // $infoipt = InfoIpt::where('jenis_institusi', 'UA')->orderBy('nama_institusi')->get();
        // $infoiptIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        // $infoiptP = InfoIpt::where('jenis_institusi', 'P')->orderBy('nama_institusi')->get();
        // $infoiptKK = InfoIpt::where('jenis_institusi', 'KK')->orderBy('nama_institusi')->get();
        // dd($infoipt); 

        return view('kemaskini.sekretariat.pengajian.kemaskini_tukar_institusi', compact('tukar_institusi'));
    }

    public function kemaskiniTukarInstitusi(Request $request, $id)
    {
        $tukar_institusi = TukarInstitusi::updateOrCreate(['smoku_id' => $id]);
        $tukar_institusi->status = $request->input('status');
        $tukar_institusi->save();

        if ($request->input('status') === '1') {

            $institusi_baru = TukarInstitusi::value('id_institusi_baru');

            // Update or create an Akademik record based on smoku_id
            Akademik::updateOrCreate(
                ['smoku_id' => $id, 'status' => 1], // Condition to find the record
                [
                    'id_institusi' => $institusi_baru,
                ]
            );
            // Redirect to the original page
            return redirect()->back()->with('success', 'Tukar institusi diluluskan.');
        }
        else if ($request->input('status') === '2') {
            // Redirect to the original page
            return redirect()->back()->with('failed', 'Tukar institusi tidak diluluskan.');
        }
        else {
            // Redirect to the original page
            return redirect()->back();
        }
    }

    public function senaraiPengesahanCGPA()
    {
        $pengesahan_cgpa = Peperiksaan::join('permohonan','permohonan.id','=','permohonan_peperiksaan.permohonan_id')
        ->join('smoku','smoku.id','=','permohonan.smoku_id')
        ->where('permohonan_peperiksaan.cgpa', '<', 2.0)
        ->orderBy('permohonan_peperiksaan.id', 'DESC')
        ->get(['smoku.*','permohonan_peperiksaan.*','permohonan_peperiksaan.id as id_result']);
        //  dd($pengesahan_cgpa);

        // $infoipt = InfoIpt::where('jenis_institusi', 'UA')->orderBy('nama_institusi')->get();
        // $infoiptIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        // $infoiptP = InfoIpt::where('jenis_institusi', 'P')->orderBy('nama_institusi')->get();
        // $infoiptKK = InfoIpt::where('jenis_institusi', 'KK')->orderBy('nama_institusi')->get();
        // dd($infoipt); 

        return view('kemaskini.sekretariat.pengajian.kemaskini_pengesahan_cgpa', compact('pengesahan_cgpa'));
    }

    public function kemaskiniPengesahanCGPA(Request $request, $id)
    {
        $pengesahan_cgpa = Peperiksaan::updateOrCreate(['id' => $id]);
        $pengesahan_cgpa->pengesahan_rendah = $request->input('status');
        $pengesahan_cgpa->save();

        if ($request->input('status') === '2') {
            // Redirect to the original page
            return redirect()->back()->with('success', 'Pengesahan GPA disokong.');
        }
        else if ($request->input('status') === '0') {
            // Redirect to the original page
            return redirect()->back()->with('failed', 'Pengesahan GPA tidak disokong.');
        }
        else {
            // Redirect to the original page
            return redirect()->back();
        }
    }

    public function sesiSalur()
    {
        $sesi = SesiSalur::orderBy('created_at', 'desc')->get(); 
        return view('kemaskini.sekretariat.salur.sesi_salur', compact('sesi'));
    }

    public function simpanSesiSalur(Request $request)
    {
        $request->validate([
            'sesi' => 'required|string|max:255',
        ], [
            'sesi.required' => 'Masukkan sesi salur.',
        ]);

        SesiSalur::create([
            'sesi' => $request->sesi,
            'dilaksanakan_oleh' => Auth::id(),
        ]);

        return back()->with('success', 'Sesi salur berjaya disimpan.');
    }

    //PENYALURAN SPBB

    //Muat Turn Lejar
    public function muatTurunLejar()
    {
        $sesiSalur = SesiSalur::orderBy('id', 'desc')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        
        return view('spbb.sekretariat.muat_turun_lejar', compact('institusiPengajianUA','sesiSalur'));
    }

    public function muatTurunLejarPermohonan($id_institusi, $sesi)
    {
        return Excel::download(new LejarPermohonan($id_institusi, $sesi), 'Lejar-Baharu_Permohonan.xlsx');
    }

    public function muatTurunLejarTuntutan($id_institusi, $sesi)
    {
        
        return Excel::download(new LejarTuntutan($id_institusi, $sesi), 'Lejar-SediaAda_Tuntutan.xlsx');
    }

}
