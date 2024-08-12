<?php

namespace App\Http\Controllers;

use App\Exports\BorangSPPB;
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
use App\Models\TukarInstitusi;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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

    public function getPermohonanIPTS()
    {
        $permohonanIPTS = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanIPTS,
                COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafIPTS,
                COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuIPTS,
                COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanIPTS,
                COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongIPTS,
                COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanIPTS,
                COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakIPTS,
                COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakIPTS,
                COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarIPTS
            ')
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'IPTS')
            ->first();

        return response()->json($permohonanIPTS);
    }

    public function getTuntutanIPTS()
    {
        $tuntutanIPTS = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program','=','BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'IPTS')
                ->select(
                    DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status != 9 THEN 1 END) AS keseluruhanTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanIPTS'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanIPTS')
                )
                ->first();

        return response()->json($tuntutanIPTS);
    }

    public function getPermohonanPOLI()
    {
        $permohonanPOLI = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanPOLI,
                COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafPOLI,
                COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuPOLI,
                COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanPOLI,
                COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongPOLI,
                COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanPOLI,
                COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakPOLI,
                COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakPOLI,
                COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarPOLI
            ')
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'P')
            ->first();

        return response()->json($permohonanPOLI);
    }

    public function getTuntutanPOLI()
    {
        $tuntutanPOLI = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program','=','BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'P')
                ->select(
                    DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanPOLI'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanPOLI')
                )
                ->first();

        return response()->json($tuntutanPOLI);
    }

    public function getPermohonanKK()
    {
        $permohonanKK = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanKK,
                COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafKK,
                COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuKK,
                COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanKK,
                COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongKK,
                COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanKK,
                COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakKK,
                COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakKK,
                COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarKK
            ')
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'KK')
            ->first();

        return response()->json($permohonanKK);
    }

    public function getTuntutanKK()
    {
        $tuntutanKK = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program','=','BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'KK')
                ->select(
                    DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status != 9 THEN 1 END) AS keseluruhanTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanKK'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanKK')
                )
                ->first();

        return response()->json($tuntutanKK);
    }

    public function getPermohonanUA()
    {
        $permohonanUA = Permohonan::join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
            ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
            ->selectRaw('
                COUNT(CASE WHEN permohonan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanUA,
                COUNT(CASE WHEN permohonan.status = 1 THEN 1 END) AS derafUA,
                COUNT(CASE WHEN permohonan.status = 2 THEN 1 END) AS baharuUA,
                COUNT(CASE WHEN permohonan.status = 3 THEN 1 END) AS saringanUA,
                COUNT(CASE WHEN permohonan.status = 4 THEN 1 END) AS disokongUA,
                COUNT(CASE WHEN permohonan.status = 5 THEN 1 END) AS dikembalikanUA,
                COUNT(CASE WHEN permohonan.status = 6 THEN 1 END) AS layakUA,
                COUNT(CASE WHEN permohonan.status = 7 THEN 1 END) AS tidaklayakUA,
                COUNT(CASE WHEN permohonan.status = 8 THEN 1 END) AS dibayarUA
            ')
            ->where('program', 'BKOKU')
            ->where('bk_info_institusi.jenis_institusi', 'UA')
            ->first();

        return response()->json($permohonanUA);
    }

    public function getTuntutanUA()
    {
        $tuntutanUA = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')
                ->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                ->where('permohonan.program','=','BKOKU')
                ->where('bk_info_institusi.jenis_institusi', 'UA')
                ->select(
                    DB::raw('COUNT(CASE WHEN tuntutan.status NOT IN (9, 10) THEN 1 END) AS keseluruhanTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 1 THEN 1 END) AS derafTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 2 THEN 1 END) AS baharuTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 3 THEN 1 END) AS saringanTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 4 THEN 1 END) AS disokongTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 5 THEN 1 END) AS dikembalikanTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 6 THEN 1 END) AS layakTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 7 THEN 1 END) AS tidakLayakTuntutanUA'),
                    DB::raw('COUNT(CASE WHEN tuntutan.status = 8 THEN 1 END) AS dibayarTuntutanUA')
                )
                ->first();

        return response()->json($tuntutanUA);
    }

    public function getPermohonanP()
    {
        $keseluruhanP = Permohonan::where('program','=','PPK')->count();
        $derafP = Permohonan::where('program','=','PPK')->where('status','=','1')->count();
        $baharuP = Permohonan::where('program','=','PPK')->where('status','=','2')->count();
        $saringanP = Permohonan::where('program','=','PPK')->where('status','=','3')->count();
        $disokongP = Permohonan::where('program','=','PPK')->where('status','=','4')->count();
        $dikembalikanP = Permohonan::where('program','=','PPK')->where('status','=','5')->count();
        $layakP = Permohonan::where('program','=','PPK')->where('status','=','6')->count();
        $tidaklayakP = Permohonan::where('program','=','PPK')->where('status','=','7')->count();
        $dibayarP = Permohonan::where('program','=','PPK')->where('status','=','8')->count();

        return response()->json([
            'keseluruhanP' => $keseluruhanP,
            'derafP' => $derafP,
            'baharuP' => $baharuP,
            'saringanP' => $saringanP,
            'disokongP' => $disokongP,
            'dikembalikanP' => $dikembalikanP,
            'layakP' => $layakP,
            'tidaklayakP' => $tidaklayakP,
            'dibayarP' => $dibayarP,
        ]);
    }

    public function getTuntutanP()
    {
        $keseluruhanTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '!=', 9)->where('permohonan.program','=','PPK')->count();
        $derafTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 1)->where('permohonan.program','=','PPK')->count();
        $baharuTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 2)->where('permohonan.program','=','PPK')->count();
        $saringanTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 3)->where('permohonan.program','=','PPK')->count();
        $disokongTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 4)->where('permohonan.program','=','PPK')->count();
        $dikembalikanTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 5)->where('permohonan.program','=','PPK')->count();
        $layakTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 6)->where('permohonan.program','=','PPK')->count();
        $tidaklayakTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 7)->where('permohonan.program','=','PPK')->count();
        $dibayarTP = Tuntutan::join('permohonan', 'permohonan.id', '=', 'tuntutan.permohonan_id')->where('tuntutan.status', '=', 8)->where('permohonan.program','=','PPK')->count();

        return response()->json([
            'keseluruhanTP' => $keseluruhanTP,
            'derafTP' => $derafTP,
            'baharuTP' => $baharuTP,
            'saringanTP' => $saringanTP,
            'disokongTP' => $disokongTP,
            'dikembalikanTP' => $dikembalikanTP,
            'layakTP' => $layakTP,
            'tidaklayakTP' => $tidaklayakTP,
            'dibayarTP' => $dibayarTP,
        ]);
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
        
        $recordsTerkini = TamatPengajian::select(
            'tamat_pengajian.*', 'smoku_akademik.*', 'smoku.nama', 'bk_peringkat_pengajian.peringkat',
            DB::raw('(SELECT peringkat_pengajian FROM smoku_akademik WHERE smoku_id = smoku_akademik.smoku_id AND status = 1 ORDER BY created_at DESC LIMIT 1) as peringkat_terkini')
        )
        ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tamat_pengajian.smoku_id')
        ->join('smoku', 'tamat_pengajian.smoku_id', '=', 'smoku.id')
        ->join('bk_peringkat_pengajian', 'smoku_akademik.peringkat_pengajian', '=', 'bk_peringkat_pengajian.kod_peringkat')
        ->whereIn('smoku_akademik.smoku_id', function ($query) {
            $query->select('smoku_id')
                ->from('permohonan')
                ->where('program', 'BKOKU');
        })
        ->where('smoku_akademik.status', 1)
        ->whereRaw('(tamat_pengajian.created_at, smoku_akademik.smoku_id) IN (SELECT MAX(created_at), smoku_id FROM tamat_pengajian GROUP BY smoku_id)')
        ->get();

        $recordsTerdahulu = TamatPengajian::select(
            'tamat_pengajian.*', 'smoku_akademik.*', 'smoku.nama', 'bk_peringkat_pengajian.peringkat',
            DB::raw('(SELECT peringkat_pengajian FROM smoku_akademik WHERE smoku_id = smoku_akademik.smoku_id AND status = 1 ORDER BY created_at DESC LIMIT 1) as peringkat_terkini')
        )
        ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'tamat_pengajian.smoku_id')
        ->join('smoku', 'tamat_pengajian.smoku_id', '=', 'smoku.id')
        ->join('bk_peringkat_pengajian', 'smoku_akademik.peringkat_pengajian', '=', 'bk_peringkat_pengajian.kod_peringkat')
        ->whereIn('smoku_akademik.smoku_id', function ($query) {
            $query->select('smoku_id')
                ->from('permohonan')
                ->where('program', 'BKOKU');
        })
        ->where('smoku_akademik.status', 0)
        ->whereRaw('(tamat_pengajian.created_at, smoku_akademik.smoku_id) IN (SELECT MAX(created_at), smoku_id FROM tamat_pengajian GROUP BY smoku_id)')
        ->get();

        return view('kemaskini.sekretariat.pengajian.kemaskini_peringkat_pengajian', compact('recordsTerkini', 'recordsTerdahulu', 'peringkatPengajian'));
    }

    public function kemaskiniPeringkatPengajian(Request $request, $id)
    {
        // Find the latest 'peringkat_pengajian' for this 'smoku_id'
        $latestPeringkatPengajian = Akademik::where('smoku_id', $id)
            ->orderBy('created_at', 'desc') // Assuming you have a 'created_at' column
            ->first();

        if ($latestPeringkatPengajian) {
            // Update the latest record's 'status' to 1
            $latestPeringkatPengajian->update(['status' => 0]);
        }

        // Create a new record with the specified "status" as 1
        $newRecord = new Akademik([
            'smoku_id' => $id,
            'no_pendaftaran_pelajar' => null,
            'peringkat_pengajian' => $request->peringkat_pengajian,
            'nama_kursus' => NULL,
            'id_institusi' => NULL,
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

        session()->put('kemaskini_success_' . $id, true);

        return redirect()->back()->with('success', 'Peringkat pengajian telah berjaya dikemaskini.');
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
        
        return view('permohonan.sekretariat.kelulusan.kelulusan', compact('kelulusan', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA', 'institusiPengajianPPK'));
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

    //PENYALURAN SPBB
    public function muatTurunDokumenSPPB()
    {
        // Order by created date in descending order
        $dokumen = DokumenESP::orderBy('updated_at', 'desc')->get();
        return view('spbb.sekretariat.muat_turun_dokumen', compact('dokumen'));
    }

    public function salinanDokumenSPPB($id)
    {
        $penyata =  MaklumatBank::where('institusi_id', $id)->first();
        $dokumen = DokumenESP::where('institusi_id', $id)->first();
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
        
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('tuntutan','status_kod','status', 'institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK'));
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
        $smoku_id = Permohonan::where('id', $tuntutan->permohonan_id)->value('smoku_id');
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
        $sama_semester = false; //semester sama

        if($no_tuntutan == 1){
            // dd('sini');
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif ($tuntutan_sebelum==null){
            // dd('sini ke');
            $baki_terdahulu = $permohonan->baki_dibayar;
        }
        elseif($tuntutan->sesi == $sesi_sebelum){
            // dd('siniiii keee');

            $baki_terdahulu = $tuntutan_sebelum->baki_dibayar;
            if ($tuntutan_sebelum->semester != $tuntutan->semester){
                $sama_semester = true; //semester lain
            }
        }
        elseif($tuntutan->sesi != $sesi_sebelum){
            $j_tuntutan = JumlahTuntutan::where('jenis',"Yuran")->first();
            $baki_terdahulu = $j_tuntutan->jumlah;
        }

        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        $status_rekod = new SejarahTuntutan([
            'smoku_id'          =>  $smoku_id,
            'tuntutan_id'       =>  $id,
            'status'            =>  3,
            'dilaksanakan_oleh'    =>  Auth::user()->id,
        ]);
        $status_rekod->save();

        return view('tuntutan.sekretariat.saringan.maklumat_tuntutan',compact('sama_semester','baki_terdahulu','permohonan','smoku','akademik','tuntutan','tuntutan_item'));
    }

    public function setSemulaStatus($id)
    {
        Tuntutan::where('id', $id)
            ->update([
                'status'   =>  2,
            ]);

        $tuntutan = Tuntutan::where('id',$id)->first();
        $status_rekod = new SejarahTuntutan([
            'smoku_id'          =>  $tuntutan->smoku_id,
            'tuntutan_id'       =>  $id,
            'status'            =>  2,
        ]);
        $status_rekod->save();

        $status_kod=0;
        $status = null;

        $query = Tuntutan::select('tuntutan.*')
            ->where('tuntutan.status', '=', '2')
            ->orWhere('tuntutan.status', '=','3')
            ->orWhere('tuntutan.status', '=','5')
            ->orWhere('tuntutan.status', '=','6')
            ->orWhere('tuntutan.status', '=','7');

        $tuntutan = $query->orderBy('tarikh_hantar', 'desc')->get();
        $institusi = InfoIpt::orderBy('nama_institusi', 'asc')->get();

        $institusiPengajianIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $institusiPengajianPOLI = InfoIpt::where('jenis_institusi','P')->orderBy('nama_institusi')->get();
        $institusiPengajianKK = InfoIpt::where('jenis_institusi','KK')->orderBy('nama_institusi')->get();
        $institusiPengajianUA = InfoIpt::where('jenis_institusi','UA')->orderBy('nama_institusi')->get();
        $institusiPengajianPPK = InfoIpt::where('id_institusi', '01055')->orWhere('jenis_permohonan', 'PPK')->orderBy('nama_institusi')->get();

        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK','institusiPengajianUA','institusiPengajianPPK','institusi','tuntutan','status_kod','status'));
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
                        'saringan_kep_peperiksaan'  =>  null,
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
                    'saringan_kep_peperiksaan'  =>  null,
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
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',5)->first();
                Mail::to($smoku_emel)->send(new TuntutanLayak($emel));
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',11)->first();
                Mail::to($smoku_emel)->send(new TuntutanLayak($emel));
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
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',6)->first();
                Mail::to($smoku_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',12)->first();
                Mail::to($smoku_emel)->send(new TuntutanTidakLayak($saringan,$tuntutan_item,$emel));
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
            $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
            $program = Permohonan::where('id', $permohonan_id)->value('program');
            if($program=="BKOKU"){
                $emel = EmelKemaskini::where('emel_id',4)->first();
                Mail::to($smoku_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
            }
            elseif($program=="PPK"){
                $emel = EmelKemaskini::where('emel_id',10)->first();
                Mail::to($smoku_emel)->send(new TuntutanDikembalikan($saringan,$tuntutan_item,$emel));
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

        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('institusiPengajianIPTS', 'institusiPengajianPOLI', 'institusiPengajianKK', 'institusiPengajianUA','institusiPengajianPPK','tuntutan','status_kod','status'));
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
        Tuntutan::where('id', $t_id)
            ->update([
                'baki_disokong'         =>  $request->get('baki_disokong'),
                'yuran_disokong'        =>  $request->get('yuran_disokong'),
                'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
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
        return view('tuntutan.sekretariat.saringan.papar_tuntutan',compact('baki_terdahulu','permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
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

        $tuntutan_sebelum = Tuntutan::where('permohonan_id',$tuntutan->permohonan_id)->where('status', '6')->where('id', '<', $sejarah_t->tuntutan_id)->orderBy('id','desc')->first();
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
        ->orderBy('permohonan_peperiksaan.id', 'DESC')
        ->get(['smoku.*','permohonan_peperiksaan.*']);
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
        $pengesahan_cgpa = Peperiksaan::updateOrCreate(['permohonan_id' => $id]);
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
}
