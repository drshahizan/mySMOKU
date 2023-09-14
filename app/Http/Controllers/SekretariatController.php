<?php

namespace App\Http\Controllers;

use App\Exports\SenaraiPendek;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\TuntutanPermohonan;
use App\Models\Waris;
use App\Models\Akademik;
use App\Mail\mailKeputusan;
use App\Models\Kelulusan;
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
        return view('pages.sekretariat.dashboard');
    }

    public function statusPermohonanBKOKU(Request $request)
    {
        $keseluruhan = TuntutanPermohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('pages.sekretariat.permohonan.statusBKOKU', compact('keseluruhan'));
    }

    public function filterStatusPermohonanBKOKU(Request $request, $status)
    {
        $keseluruhan = TuntutanPermohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->get();

        return view('pages.sekretariat.permohonan.statusBKOKU', compact('keseluruhan'));
    }

    public function statusPermohonanPPK(Request $request)
    {
        $keseluruhan = TuntutanPermohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('pages.sekretariat.permohonan.statusPPK', compact('keseluruhan'));
    }

    public function filterStatusPermohonanPPK(Request $request, $status)
    {
        $keseluruhan = TuntutanPermohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($status != null, function ($q) use ($status) {
            return $q->where('status', $status);
        })
        ->get();

        return view('pages.sekretariat.permohonan.statusPPK', compact('keseluruhan'));
    }

    public function kelulusanPermohonan()
    {
        $kelulusan = TuntutanPermohonan::where('status', '=','4')->get();
        return view('pages.sekretariat.permohonan.kelulusan', compact('kelulusan'));
    }

    public function cetakSenaraiPemohonExcel()
    {
        return Excel::download(new SenaraiPendek, 'PermohonanDisokong.xlsx');
    }

    public function cetakSenaraiPemohonPDF()
    {
        $kelulusan = TuntutanPermohonan::where('status', '4')->get();

        $pdf = PDF::loadView('pages.saringan.cetakSenaraiPemohon', compact('kelulusan'))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('senarai-pemohon.pdf');
    }

    public function lihatKelulusan($id)
    {
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $id_permohonan = $permohonan->id_permohonan;
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        $catatan = Saringan::where('id_permohonan', $id_permohonan)->first();
        return view('pages.sekretariat.permohonan.maklumatKelulusan',compact('permohonan','pelajar','catatan'));
    }

    public function kemaskiniKelulusan(Request $request,$id)
    {
        $id_permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->value('id');

        if($request->get('keputusan')=="Lulus"){
            TuntutanPermohonan::where('nokp_pelajar', $id)
                ->update([
                'status'   =>  6,
            ]);
            
            $info_mesyuarat = new Kelulusan([
                'id_permohonan' =>  $id_permohonan,
                'no_mesyuarat'  =>  $request->get('noMesyuarat'),
                'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
                'keputusan'  =>  $request->get('keputusan'),
                'catatan'  =>  $request->get('catatan'),
            ]);
            $info_mesyuarat->save();
        }
        else{
            TuntutanPermohonan::where('nokp_pelajar', $id)
                ->update([
                'status'   =>  7,
            ]);

            $info_mesyuarat = new Kelulusan([
                'id_permohonan' =>  $id_permohonan,
                'no_mesyuarat'  =>  $request->get('noMesyuarat'),
                'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
                'keputusan'  =>  $request->get('keputusan'),
                'catatan'  =>  $request->get('catatan'),
            ]);
            $info_mesyuarat->save();
        }

        $permohonan = TuntutanPermohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        $id_permohonan2 = TuntutanPermohonan::where('nokp_pelajar', $id)->value('id_permohonan');

        $notifikasi = "Emel notifikasi telah dihantar kepada ".$id_permohonan2;
        $message = 'Test message';
        Mail::to("fateennashuha9@gmail.com")->send(new mailKeputusan($message));
        return view('pages.sekretariat.permohonan.keputusan', compact('permohonan','notifikasi'));
    }

    public function keputusanPermohonan(Request $request)
    {
        $permohonan = TuntutanPermohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        $notifikasi = NULL;
        return view('pages.sekretariat.permohonan.keputusan', compact('permohonan','notifikasi'));
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
    public function tuntutanSaring()
    {
        $permohonan = TuntutanPermohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->get();
        $status_kod=0;
        $status = null;
        return view('pages.sekretariat.tuntutan.saring',compact('permohonan','status_kod','status'));
    }

    public function keputusanPeperiksaan(){
        return view('pages.sekretariat.tuntutan.keputusanPeperiksaan');
    }

    public function maklumatTuntutan2($id){
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        return view('pages.sekretariat.tuntutan.maklumatTuntutan',compact('permohonan','pelajar'));
    }

    public function saringMaklumatTuntutan(Request $request, $id){
        $id_permohonan = TuntutanPermohonan::where('id', $id)->value('id_permohonan');
        $permohonan = TuntutanPermohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();

        if($request->get('submit')=="Layak"){
            $status_kod=1;
            $status = "Tuntutan ".$id_permohonan." telah disaring dengan status 'Layak'.";
        }
        elseif($request->get('submit')=="TidakLayak"){
            $status_kod=1;
            $status = "Tuntutan ".$id_permohonan." telah disaring dengan status 'Tidak Layak'.";
        }
        elseif($request->get('submit')=="Kembalikan"){
            $status_kod=2;
            $status = "Tuntutan ".$id_permohonan." telah dikembalikan.";
        }

        return view('pages.sekretariat.tuntutan.saring',compact('permohonan','status_kod','status'));
    }


    public function tuntutanKeputusan()
    {
        $permohonan = TuntutanPermohonan::where('status', '=','5')
        ->orWhere('status', '=','6')
        ->orWhere('status', '=','7')
        ->get();
        return view('pages.sekretariat.tuntutan.keputusan',compact('permohonan'));
    }

    public function sejSenaraiTuntutan(){
        $permohonan = TuntutanPermohonan::where('status', '!=','4')->get();
        return view('pages.sekretariat.tuntutan.sejarah_tuntutan',compact('permohonan'));
    }
}
