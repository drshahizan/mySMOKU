<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SekretariatController extends Controller
{
    public function dashboard()
    {
        return view('pages.sekretariat.dashboard');
    }
    
    public function statusPermohonan()
    {
        return view('pages.sekretariat.permohonan.status');
    }

    public function permohonanBaru()
    {
        return view('pages.sekretariat.permohonan.baru');
    }

    public function pembaharuanPermohonan()
    {
        return view('pages.sekretariat.permohonan.pembaharuan');
    }

    public function keputusanPermohonan()
    {

        return view('pages.sekretariat.permohonan.keputusan');
    }

    // public function keputusan(Request $request)
    // {
    //     $todayDate = Carbon::now()->format('Y-m-d');
    //     if($request)
    //     {
    //         $keputusanPermohonan = Permohonan::when($request->date != null, function($q) use($request){
    //                         return $q->whereDate('created_at',$request->date);
    //                     })
    //                     ->when($request->keputusan != null, function($q) use($request){

    //                         return $q->where('keputusan_message',$request->keputusan);
    //                     })
    //                     ->paginate(10);

    //         return view('pages.sekretariat.permohonan.keputusan', compact('keputusanPermohonan'));
    //     }
    //     else{
    //         $keputusanPermohonan = Permohonan::where('user_id')->orderBy('created_at','desc')->paginate();
    //         return view('pages.sekretariat.permohonan.keputusan', compact('keputusanPermohonan'));
    //     }
    // }

    public function muatTurunSuratTawaran(int $permohonanId)
    {
        // $permohonan = Permohonan::findOrFail('A123');
        // $pengajian = ['maklumatPengajian' => $permohonan];

        // $pdf = Pdf::loadView('pages.sekretariat.permohonan.suratTawaran', $permohonan);
        // $todayDate = Carbon::now()->format('d-m-Y');

        // return $pdf->download('SuratTawaran-'.A123.'-'.$todayDate.'.pdf');

        $pdf = Pdf::loadView('pages.sekretariat.permohonan.suratTawaran');
        return $pdf->download('SuratTawaran.pdf');
    }
}
