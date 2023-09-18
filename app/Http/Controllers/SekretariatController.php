<?php

namespace App\Http\Controllers;

use App\Exports\SenaraiPendek;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\Smoku;
use App\Models\Waris;
use App\Models\Akademik;
use App\Mail\mailKeputusan;
use App\Models\Kelulusan;
use App\Models\Tuntutan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class SekretariatController extends Controller
{
    public function dashboard()
    {
        return view('dashboard.sekretariat.dashboard');
    }

    public function statusPermohonanBKOKU(Request $request)
    {
        $permohonan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_BKOKU', compact('permohonan'));
    }

    public function filterStatusPermohonanBKOKU(Request $request, $status)
    {
        $permohonan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_BKOKU', compact('permohonan'));
    }

    public function bilanganTuntutanBKOKU(Request $request)
    {
        $tuntutan = Tuntutan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_tuntutan_BKOKU', compact('tuntutan'));
    }

    public function statusPermohonanPPK(Request $request)
    {
        $permohonan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_PPK', compact('permohonan'));
    }

    public function filterStatusPermohonanPPK(Request $request, $status)
    {
        $permohonan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_PPK', compact('permohonan'));
    }

    public function bilanganTuntutanPPK(Request $request)
    {
        $tuntutan = Tuntutan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_tuntutan_BKOKU', compact('tuntutan'));
    }

    public function senaraiKelulusanPermohonan()
    {
        $kelulusan = Permohonan::where('status', '=','4')->get();
        return view('permohonan.sekretariat.kelulusan.kelulusan', compact('kelulusan'));
    }

    public function cetakSenaraiPemohonExcel()
    {
        return Excel::download(new SenaraiPendek, 'PermohonanDisokong.xlsx');
    }

    public function cetakSenaraiPemohonPDF()
    {
        $kelulusan = Permohonan::where('status', '4')->get();

        $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_pdf', compact('kelulusan'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('Senarai-Permohonan-Disokong.pdf');
    }

    public function maklumatKelulusanPermohonan($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        return view('permohonan.sekretariat.kelulusan.maklumat_kelulusan',compact('permohonan'));
    }

    public function hantarKeputusanPermohonan(Request $request,$id)
    {
        $permohonan_id = Permohonan::where('smoku_id', $id)->value('id');

        if($request->get('keputusan')=="Lulus"){
            Permohonan::where('smoku_id', $id)
                ->update([
                'status'   =>  6,
            ]);

            $info_mesyuarat = new Kelulusan([
                'permohonan_id' =>  $permohonan_id,
                'no_mesyuarat'  =>  $request->get('noMesyuarat'),
                'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
                'keputusan'  =>  $request->get('keputusan'),
                'catatan'  =>  $request->get('catatan'),
            ]);
            $info_mesyuarat->save();
        }
        else{
            Permohonan::where('smoku_id', $id)
                ->update([
                'status'   =>  7,
            ]);

            $info_mesyuarat = new Kelulusan([
                'permohonan_id' =>  $permohonan_id,
                'no_mesyuarat'  =>  $request->get('noMesyuarat'),
                'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
                'keputusan'  =>  $request->get('keputusan'),
                'catatan'  =>  $request->get('catatan'),
            ]);
            $info_mesyuarat->save();
        }

        $keputusan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        $id_permohonan = Permohonan::where('smoku_id', $id)->value('no_rujukan_permohonan');
        $notifikasi = "Emel notifikasi telah dihantar kepada ".$id_permohonan;
        $message = 'Test message';
        Mail::to("fateennashuha9@gmail.com")->send(new mailKeputusan($message));

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi'));
    }

    public function senaraiKeputusanPermohonan(Request $request)
    {
        $keputusan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        $notifikasi = NULL;
        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi'));
    }

    public function kembalikanPermohonan()
    {
        return view('pages.sekretariat.permohonan.kembalikan');
    }

    public function muatTurunSuratTawaran()
    {
        // $permohonan = Permohonan::findOrFail('A123');
        // $pengajian = ['maklumatPengajian' => $permohonan];

        // $pdf = Pdf::loadView('pages.sekretariat.permohonan.suratTawaran', $permohonan);
        // $todayDate = Carbon::now()->format('d-m-Y');

        // return $pdf->download('SuratTawaran-'.A123.'-'.$todayDate.'.pdf');

        $pdf = Pdf::loadView('pages.sekretariat.permohonan.suratTawaran');
        return $pdf->download('SuratTawaran.pdf');
    }

    //TUNTUTAN
    public function senaraiTuntutanKedua()
    {
        $permohonan = Permohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->get();
        $status_kod=0;
        $status = null;
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('permohonan','status_kod','status'));
    }

    public function keputusanPeperiksaan(){
        return view('tuntutan.sekretariat.saringan.keputusan_peperiksaan');
    }

    public function maklumatTuntutanKedua($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','smoku','akademik'));
    }

    public function saringTuntutanKedua(Request $request, $id){
        $no_rujukan_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $permohonan = Permohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();

        if($request->get('submit')=="Layak"){
            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_permohonan." telah disaring dengan status 'Layak'.";
        }
        elseif($request->get('submit')=="TidakLayak"){
            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_permohonan." telah disaring dengan status 'Tidak Layak'.";
        }
        elseif($request->get('submit')=="Kembalikan"){
            $status_kod=2;
            $status = "Tuntutan ".$no_rujukan_permohonan." telah dikembalikan.";
        }

        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('permohonan','status_kod','status'));
    }


    public function keputusanTuntutan()
    {
        $permohonan = Permohonan::where('status', '=','5')
        ->orWhere('status', '=','6')
        ->orWhere('status', '=','7')
        ->get();
        return view('tuntutan.sekretariat.keputusan.keputusan_tuntutan',compact('permohonan'));
    }

    public function sejarahTuntutan(){
        $permohonan = Permohonan::where('status', '!=','4')->get();
        return view('tuntutan.sekretariat.sejarah.sejarah_tuntutan',compact('permohonan'));
    }
}
