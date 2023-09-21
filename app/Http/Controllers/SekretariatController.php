<?php

namespace App\Http\Controllers;

use App\Exports\SenaraiPendek;
use App\Mail\KeputusanLayak;
use App\Mail\KeputusanTidakLayak;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\SejarahPermohonan;
use App\Models\Smoku;
use App\Models\Waris;
use App\Models\Akademik;
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
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_BKOKU', compact('permohonan'));
    }

    public function filterStatusPermohonanBKOKU(Request $request, $status)
    {
        // $permohonan = Permohonan::when($request->date != null, function ($q) use ($request) {
        //     return $q->whereDate('created_at', $request->date);
        // })
        // ->when($status != null, function ($q) use ($status) {
        //     return $q->where('status', $status);
        // })
        // ->get();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_BKOKU', compact('permohonan'));
    }

    public function bilanganTuntutanBKOKU(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_tuntutan_BKOKU', compact('tuntutan'));
    }

    public function statusPermohonanPPK(Request $request)
    {
        // $permohonan = Permohonan::when($request->date != null, function ($q) use ($request) {
        //     return $q->whereDate('created_at', $request->date);
        // })
        // ->when($request->status != null, function ($q) use ($request) {
        //     return $q->where('status', $request->status);
        // })
        // ->get();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_PPK', compact('permohonan'));
    }

    public function filterStatusPermohonanPPK(Request $request, $status)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $permohonan = Permohonan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_permohonan_PPK', compact('permohonan'));
    }

    public function bilanganTuntutanPPK(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $tuntutan = Tuntutan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

        return view('dashboard.sekretariat.senarai_tuntutan_BKOKU', compact('tuntutan'));
    }

    public function kemaskiniPeringkatPengajian()
    {
        $permohonan = Permohonan::all();
        return view('pengajian.sekretariat.kemaskini_peringkat_pengajian', compact('permohonan'));
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
        $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');
        return $pdf->stream('Senarai-Permohonan-Disokong.pdf');
    }

    public function maklumatKelulusanPermohonan($id)
    {
        $permohonan = Permohonan::where('id', $id)->first();
        return view('permohonan.sekretariat.kelulusan.maklumat_kelulusan',compact('permohonan'));
    }

    public function hantarKeputusanPermohonan(Request $request,$id)
    {
        //$id is the id in "permohonan" table
        $permohonan_id = Permohonan::where('smoku_id', $id)->value('id');
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

        //send & update database
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

            //update sejarah permohonan
            $sejarah = new SejarahPermohonan([
                'smoku_id'      =>  $smoku_id,
                'permohonan_id' =>  $permohonan_id,
                'status'        =>  6,
            ]);
            $sejarah->save();

            //emel notifikasi
            $message = 'Test message';
            Mail::to("fateennashuha9@gmail.com")->send(new KeputusanLayak($message));
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

            //update sejarah permohonan
            $sejarah = new SejarahPermohonan([
                'smoku_id'      =>  $smoku_id,
                'permohonan_id' =>  $id,
                'status'        =>  7,
            ]);
            $sejarah->save();

            //emel notifikasi
            $message = 'Test message';
            Mail::to("fateennashuha9@gmail.com")->send(new KeputusanTidakLayak($message));
        }

        //filter
        $kelulusan = Permohonan::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        })
        ->when($request->status != null, function ($q) use ($request) {
            return $q->where('status', $request->status);
        })
        ->get();

         //notification
         $keputusan = $request->get('keputusan');
         $id_permohonan = Permohonan::where('smoku_id', $id)->value('no_rujukan_permohonan');
         $notifikasi = "Emel notifikasi telah dihantar kepada ".$id_permohonan;

         return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi','kelulusan'));
    }

    // public function bulkApproval(Request $request)
    // {
    //     // Get the selected item IDs from the form
    //     $selectedItemIds = $request->input('selected_items');

    //     // Perform bulk approval for the selected items
    //     // Loop through $selectedItemIds and update the database accordingly

    //     // Example:
    //     foreach ($selectedItemIds as $itemId) {
    //         // Assuming you have an 'Item' model and you want to update the 'approved' status
    //         $item = Permohonan::find($itemId);

    //         $permohonan_id = Permohonan::where('smoku_id', $item)->value('id');
    //         $smoku_id = Permohonan::where('id', $item)->value('smoku_id');

    //         if ($item) {
    //             // $item->update([
    //             //     'approved' => true,
    //             // ]);

    //             // Add code to record approval details, send email notifications, etc.
    //             Permohonan::where('smoku_id', $item)
    //                 ->update([
    //                 'status'   =>  6,
    //             ]);

    //             $info_mesyuarat = new Kelulusan([
    //                 'permohonan_id' =>  $permohonan_id,
    //                 'no_mesyuarat'  =>  $request->get('noMesyuarat'),
    //                 'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
    //                 'keputusan'  =>  $request->get('keputusan'),
    //                 'catatan'  =>  $request->get('catatan'),
    //             ]);
    //             $info_mesyuarat->save();

    //             //update sejarah permohonan 
    //             $sejarah = new SejarahPermohonan([
    //                 'smoku_id'      =>  $smoku_id,
    //                 'permohonan_id' =>  $permohonan_id,
    //                 'status'        =>  6,
    //             ]);
    //             $sejarah->save();
    //         }
    //     }

    //     $keputusan = $request->get('keputusan');
    //     $notifikasi = "Emel notifikasi telah dihantar kepada semua pemohon";

    //     return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi','kelulusan'));
    //     // Redirect back with a success message
    //     //return redirect()->back()->with('success', 'Bulk approval completed.');
    // }

    public function bulkApproval(Request $request)
{
    // Get the selected item IDs from the form
    $selectedItemIds = $request->input('selected_items');

    // Loop through $selectedItemIds and update the database accordingly
    foreach ($selectedItemIds as $itemId) {
        $item = Permohonan::find($itemId);

        if ($item) {
            // Update the 'Permohonan' model's status
            $item->update([
                'status' => 6,
            ]);

            // Create a 'Kelulusan' record
            Kelulusan::create([
                'permohonan_id' => $item->id,
                'no_mesyuarat' => $request->input('noMesyuarat'),
                'tarikh_mesyuarat' => $request->input('tarikhMesyuarat'),
                'keputusan' => $request->input('keputusan'),
                'catatan' => $request->input('catatan'),
            ]);

            // Create a 'SejarahPermohonan' record
            SejarahPermohonan::create([
                'smoku_id' => $item->smoku_id,
                'permohonan_id' => $item->id,
                'status' => 6,
            ]);
        }
    }

    view('permohonan.sekretariat.keputusan.keputusan');
    // Redirect to a success page or another route
    //return redirect()->route('permohonan/sekretariat/keputusan');
}


    public function senaraiKeputusanPermohonan(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kelulusan = Kelulusan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_mesyuarat', [$startDate, $endDate]);
        })
        ->when($request->status, function ($q) use ($request) {
            return $q->where('keputusan', $request->status);
        })
        ->get();

        $notifikasi = null;

        return view('permohonan.sekretariat.keputusan.keputusan', compact('kelulusan', 'notifikasi'));
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
        $tuntutan = Tuntutan::where('status', '2')
        ->orWhere('status', '=','3')
        ->get();
        $status_kod=0;
        $status = null;
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('tuntutan','status_kod','status'));
    }

    public function keputusanPeperiksaan(){
        return view('tuntutan.sekretariat.saringan.keputusan_peperiksaan');
    }

    public function maklumatTuntutanKedua($id){
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = Permohonan::where('id', $tuntutan->permohonan_id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','smoku','akademik','tuntutan'));
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

    public function rekodTuntutan($id){
        $permohonan = Permohonan::where('id', $id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $sejarah_p = SejarahPermohonan::where('permohonan_id', $id)->orderBy('created_at', 'desc')->get();
        return view('tuntutan.sekretariat.sejarah.rekod_tuntutan',compact('permohonan','akademik','smoku','sejarah_p'));
    }

    public function paparRekodTuntutan($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.sekretariat.sejarah.papar_tuntutan',compact('permohonan','smoku','akademik','sejarah_p'));
    }
    public function paparRekodSaringanTuntutan($id){
        $sejarah_p = SejarahPermohonan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $sejarah_p->permohonan_id)->first();
        $smoku_id = $permohonan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $catatan = Saringan::where('permohonan_id', $sejarah_p->permohonan_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.sekretariat.sejarah.papar_saringan',compact('permohonan','catatan','smoku','akademik','sejarah_p'));
    }
}
