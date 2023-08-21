<?php

namespace App\Http\Controllers;

use App\Exports\SenaraiPendek;
use App\Models\Permohonan;
use App\Models\TuntutanPermohonan;
use App\Models\Waris;
use App\Models\Akademik;
use App\Mail\mailKeputusan;
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
    
    public function statusPermohonan(Request $request)
    {
        $keseluruhan = TuntutanPermohonan::all();
        return view('pages.sekretariat.permohonan.status', compact('keseluruhan'));

        // if(!$request)
        // {
        //     $keseluruhan = TuntutanPermohonan::when($request->program != null, function($q) use($request){
        //                     return $q->where('program', $request->program);
        //                 })
        //                 ->when($request->status != null, function($q) use($request){
        //                     return $q->where('status',$request->status);
        //                 });
        //     return view('pages.sekretariat.permohonan.status', compact('keseluruhan'));
        // }
        // else{
        //     $keseluruhan = TuntutanPermohonan::all();
        //     return view('pages.sekretariat.permohonan.status',compact('keseluruhan'));
        // } 
    }

    public function keputusanSaringan()
    {
        $kelulusan = TuntutanPermohonan::all();
        return view('pages.sekretariat.permohonan.kelulusan', compact('kelulusan'));
    }
    
    public function kembalikanPermohonan()
    {
        return view('pages.sekretariat.permohonan.kembalikan');
    }

    public function keputusanPermohonan()
    {
        return view('pages.sekretariat.permohonan.keputusan');
    }

    public function maklumatKeputusan()
    {
        return view('pages.sekretariat.permohonan.maklumatKeputusan');
    }

    public function keputusan(Request $request)
    {
        $todayDate = Carbon::now()->format('Y-m-d');
        $keputusan = ['Layak','Tidak Layak','Dikembalikan'];
        if($request)
        {
            $keputusanPermohonan = Permohonan::when($request->date != null, function($q) use($request){
                            return $q->whereDate('created_at',$request->date);
                        })
                        ->when($request->keputusan != null, function($q) use($request){

                            return $q->where('keputusan_message',$request->keputusan);
                        })
                        ->paginate(10);

            return view('pages.sekretariat.permohonan.keputusan', compact('keputusanPermohonan'));
        }
        else{
            $keputusanPermohonan = Permohonan::where('user_id')->orderBy('created_at','desc')->paginate();
            return view('pages.sekretariat.permohonan.keputusan', compact('keputusanPermohonan'));
        }
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

    public function cetakSenaraiPemohonExcel() 
    {
        return Excel::download(new SenaraiPendek, 'PermohonanDisokong.xlsx');
    }

    public function cetakSenaraiPemohonPDF() 
    {
        // $pdf = PDF::loadView('pages.saringan.cetakSenaraiPemohon');
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->stream('senarai-pemohon.pdf');
        
        // $pdf = app('dompdf.wrapper');
        // $pdf->getDomPDF()->set_option("enable_php", true);
        // $pdf->setPaper('A4', 'landscape');
        // $data = ['title' => 'Testing Page Number In Body'];
        // $pdf->loadView('pages.saringan.cetakSenaraiPemohon', $data);
        // return $pdf->stream('senarai-pemohon.pdf');

        $pdf = App::make('dompdf.wrapper');
        $data = ['title' => 'Testing Page Number In Body'];
        $pdf->loadView('pages.saringan.cetakSenaraiPemohon', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();

        $canvas = $dom_pdf ->get_canvas();
        $canvas->page_text(400, 575, "Page {PAGE_NUM}", null, 8, array(0, 0, 0));

        return $pdf->stream('senarai-pemohon.pdf');;
    }

    public function mailKeputusan(Request $request)
    {
        if($request->get('maklumat_profil_diri')=="lengkap"&&$request->get('maklumat_akademik')=="lengkap"&&$request->get('salinan_dokumen')=="lengkap"){
            return redirect('/maklumat-tuntutan')->with('disokong', 'Permohonan Telah Disokong');
        }
        else{
            if($request->get('maklumat_profil_diri')=="tak_lengkap"){
                $catatan1=$request->get('catatan_profil_diri');
            }
            else{
                $catatan1=null;
            }
    
            if($request->get('maklumat_akademik')=="tak_lengkap"){
                $catatan2=$request->get('catatan_maklumat_akademik');
            }
            else{
                $catatan2=null;
            }
    
            if($request->get('salinan_dokumen')=="tak_lengkap"){
                $catatan3=$request->get('catatan_salinan_dokumen');
            }
            else{
                $catatan3=null;
            }
    
            $catatan = [
                'catatan1'=>$catatan1, 
                'catatan2'=>$catatan2, 
                'catatan3'=>$catatan3,
            ];
        }
        Mail::to("fateennashuha9@gmail.com")->send(new mailKeputusan($catatan));
        return redirect('/sekretariatKeputusan')->with('message','Emel notifikasi telah dihantar kepada pemohon');
    }

    public function qrcode()
    {
      return view('pages.sekretariat.permohonan.qrcode');
    }

    //TUNTUTAN

    public function tuntutanKeseluruhan()
    {
        return view('pages.sekretariat.tuntutan.keseluruhan');
    }

    public function tuntutanSaring()
    {
        $permohonan = TuntutanPermohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->get();
        $status = null;
        return view('pages.sekretariat.tuntutan.saring',compact('permohonan','status'));
    }

    public function maklumatTuntutan2($id){
        $permohonan = TuntutanPermohonan::where('nokp_pelajar', $id)->first();
        $pelajar = Permohonan::where('nokp_pelajar', $id)->first();
        return view('pages.sekretariat.tuntutan.maklumatTuntutan',compact('permohonan','pelajar'));
    }

    public function tuntutanKelulusan()
    {
        $permohonan = TuntutanPermohonan::where('status', '4')
        ->get();
        return view('pages.sekretariat.tuntutan.kelulusan', compact('permohonan'));
    }

    public function tuntutanKeputusan()
    {
        $permohonan = TuntutanPermohonan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','4')
        ->orWhere('status', '=','5')
        ->orWhere('status', '=','6')
        ->orWhere('status', '=','7')
        ->get();
        return view('pages.sekretariat.tuntutan.keputusan',compact('permohonan'));
    }
}