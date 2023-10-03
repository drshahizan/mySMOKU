<?php

namespace App\Http\Controllers;

use App\Exports\SenaraiPendek;
use App\Mail\KeputusanLayak;
use App\Mail\KeputusanTidakLayak;
use App\Mail\TuntutanDikembalikan;
use App\Mail\TuntutanLayak;
use App\Mail\TuntutanTidakLayak;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\Smoku;
use App\Models\TuntutanItem;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\Kelulusan;
use App\Models\MaklumatKementerian;
use App\Models\SuratTawaran;
use App\Models\Tuntutan;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $smoku_id = Permohonan::where('id', $id)->value('smoku_id');

        if($request->get('keputusan')=="Lulus"){
            //update permohonan table
            Permohonan::where('id', $id)
                ->update([
                'status'   =>  6,
            ]);

            //send & update permohonan_kelulusan table
            $info_mesyuarat = new Kelulusan([
                'permohonan_id' =>  $id,
                'no_mesyuarat'  =>  $request->get('noMesyuarat'),
                'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
                'keputusan'  =>  $request->get('keputusan'),
                'catatan'  =>  $request->get('catatan'),
            ]);
            $info_mesyuarat->save();

            //update sejarah_permohonan table
            $sejarah = new SejarahPermohonan([
                'smoku_id'      =>  $smoku_id,
                'permohonan_id' =>  $id,
                'status'        =>  6,
            ]);
            $sejarah->save();

            //emel notifikasi
            $message = 'Test message';
            Mail::to("fateennashuha9@gmail.com")->send(new KeputusanLayak($message));
        }
        else{
            //update permohonan table
            Permohonan::where('id', $id)
                ->update([
                'status'   =>  7,
            ]);

            //send & update permohonan_kelulusan table
            $info_mesyuarat = new Kelulusan([
                'permohonan_id' =>  $id,
                'no_mesyuarat'  =>  $request->get('noMesyuarat'),
                'tarikh_mesyuarat'  =>  $request->get('tarikhMesyuarat'),
                'keputusan'  =>  $request->get('keputusan'),
                'catatan'  =>  $request->get('catatan'),
            ]);
            $info_mesyuarat->save();

            //update sejarah permohonan table
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

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kelulusan = Kelulusan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_mesyuarat', [$startDate, $endDate]);
        })
        ->when($request->status, function ($q) use ($request) {
            return $q->where('keputusan', $request->status);
        })
        ->get();

        $keputusan = $request->get('keputusan');
        $id_permohonan = Permohonan::where('smoku_id', $id)->value('no_rujukan_permohonan');
        $notifikasi = "Emel notifikasi telah dihantar kepada ".$id_permohonan;

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi','kelulusan'));
    }

    public function hantarSemuaKeputusanPermohonan(Request $request)
    {
        // Get the selected item IDs from the form
        $selectedItemIds = $request->input('selected_items');

        if ($selectedItemIds !== null)
        {
            // Loop through $selectedItemIds and update the database accordingly
            foreach ($selectedItemIds as $itemId) {
                //$itemId is the permohonan id
                $item = Permohonan::find($itemId);
                //$email = DB::table('users')->where('id', $item['smoku_id'])->value('email');

                if ($item) {
                    if($request->get('keputusan')=="Lulus"){
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

                        //emel notifikasi layak
                        $message = 'Test message';
                        Mail::to("fateennashuha9@gmail.com")->send(new KeputusanLayak($message));
                    }
                    else{
                        // Update the 'Permohonan' model's status
                        $item->update([
                            'status' => 7,
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
                            'status' => 7,
                        ]);

                        //emel notifikasi tidak layak
                        $message = 'Test message';
                        Mail::to("fateennashuha9@gmail.com")->send(new KeputusanTidakLayak($message));
                    }
                }
            }
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kelulusan = Kelulusan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_mesyuarat', [$startDate, $endDate]);
        })
        ->when($request->status, function ($q) use ($request) {
            return $q->where('keputusan', $request->status);
        })
        ->get();

        $keputusan = $request->get('keputusan');
        $notifikasi = "Emel notifikasi telah dihantar kepada semua pemohon ";

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi','kelulusan'))->with('error', 'An error occurred while processing the request.');
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

    public function cetakKeputusanPermohonanBKOKU()
    {
        $permohonan = Kelulusan::all();
        $pdf = PDF::loadView('permohonan.sekretariat.keputusan.senarai_keputusan_BKOKU_pdf', compact('permohonan'))->setPaper('A4', 'potrait');
        return $pdf->stream('Senarai-Keputusan-Permohonan-BKOKU.pdf');
    }

    public function cetakKeputusanPermohonanPPK()
    {
        $permohonan = Kelulusan::all();
        $pdf = PDF::loadView('permohonan.sekretariat.keputusan.senarai_keputusan_PPK_pdf', compact('permohonan'))->setPaper('A4', 'potrait');
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
        $pdf->getCanvas()->page_text(290, 800, "{PAGE_NUM} - {PAGE_COUNT}", null, 10);

        // Stream the PDF
        return $pdf->stream('SuratTawaran_'.$permohonanId.'.pdf');
    }

    //Step 1: Editing Data - Allow users to view and edit the current data.
    public function previewSuratTawaran()
    {
        $suratTawaran = SuratTawaran::first();
        return view('permohonan.sekretariat.kemaskini.surat_tawaran_diubah', compact('suratTawaran'));
    }


    //Step 2: Preview Changes - Show users a preview of the changes they made.
    // public function previewSuratTawaran($suratTawaranId)
    // {
    //     $suratTawaran = SuratTawaran::find($suratTawaranId);

    //     if (!$suratTawaran) {
    //         abort(404);
    //     }

    //     return view('permohonan.sekretariat.kemaskini.surat_tawaran_diubah', compact('suratTawaran'));
    // }


    //Step 3: Confirm and Update - Allow users to confirm and update the data in the database.
    public function sendSuratTawaran(Request $request, $suratTawaranId)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'noRujukan' => 'required|string',
            'tajuk' => 'required|string',
            'tujuan' => 'required|string',
            'kandungan1' => 'required|string|max:65535',
            'kandungan2' => 'required|string|max:65535',
            'kandungan3' => 'required|string|max:65535',
            'pentup1' => 'required|string',
            'penutup2' => 'required|string',
            'penutup3_1' => 'required|string',
            'penutup3_2' => 'required|string',
            'penutup3_3' => 'required|string',
            'penutup3_4' => 'required|string',
            'penutup4_1' => 'required|string',
            'penutup4_2' => 'required|string',
            'penutup4_3' => 'required|string',
        ]);

        // Find the SuratTawaran record by ID
        $suratTawaran = SuratTawaran::find($suratTawaranId);

        // Update the SuratTawaran record with the validated data
        $suratTawaran->update($validatedData);

        // Redirect to the final view with a success message
        // return view('permohonan.sekretariat.kemaskini.surat_tawaran_terkini', compact('suratTawaran'))
        // ->with('success', 'Surat Tawaran updated successfully.');
        return redirect()->route('update', ['suratTawaranId' => $suratTawaranId])->with('success', 'Surat Tawaran telah dikemaskini.');
    }

    //Step 4: Final latest view - Allow users to view the updated version of "Surat Tawaran"
    public function updatedSuratTawaran($suratTawaranId)
    {
        $suratTawaran = SuratTawaran::find($suratTawaranId);
        $maklumat_kementerian = MaklumatKementerian::first();

        if (!$suratTawaran) {
            abort(404); // Handle the case where the record is not found
        }

        return view('permohonan.sekretariat.kemaskini.surat_tawaran_terkini', compact('suratTawaran','maklumat_kementerian'));
    }

    // public function updatedSuratTawaran()
    // {
    //     dd("Inside updatedSuratTawaran method");
    //     $suratTawaran = SuratTawaran::first();
    //     return view('permohonan.sekretariat.kemaskini.surat_tawaran_terkini', compact('suratTawaran'));
    // }

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

        Tuntutan::where('id', $id)
            ->update([
                'status'   =>  3,
            ]);

        $tuntutan = Tuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = Permohonan::where('id', $tuntutan->permohonan_id)->value('smoku_id');
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();

        $status_rekod = new SejarahTuntutan([
            'smoku_id'      =>  $smoku_id,
            'tuntutan_id'   =>  $id,
            'status'        =>  3,
        ]);
        $status_rekod->save();

        return view('tuntutan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','smoku','akademik','tuntutan','tuntutan_item'));
    }

    public function saringTuntutanKedua(Request $request, $id){
        $no_rujukan_tuntutan= Tuntutan::where('id', $id)->value('no_rujukan_tuntutan');
        $permohonan_id = Tuntutan::where('id', $id)->value('permohonan_id');
        $smoku_id = Permohonan::where('id', $permohonan_id)->value('smoku_id');

        if($request->get('submit')=="Layak"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  6,
                ]);

            Tuntutan::where('id', $id)
                ->update([
                    'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_dibayar'     =>  $request->get('w_saku_dibayar'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'status'                =>  6,
                ]);

            $status_rekod = new SejarahTuntutan([
                'smoku_id'      =>  $smoku_id,
                'tuntutan_id'   =>  $id,
                'status'        =>  6,
            ]);
            $status_rekod->save();

            $catatan = "testing";
            Mail::to('ziba0506@gmail.com')->send(new TuntutanLayak($catatan));
            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah disaring dengan status 'Layak'.";
        }
        elseif($request->get('submit')=="TidakLayak"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  7,
                ]);

            $status_rekod = new SejarahTuntutan([
                'smoku_id'      =>  $smoku_id,
                'tuntutan_id'   =>  $id,
                'status'        =>  7,
            ]);
            $status_rekod->save();

            $catatan = "testing";
            Mail::to('ziba0506@gmail.com')->send(new TuntutanTidakLayak($catatan));

            $status_kod=1;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah disaring dengan status 'Tidak Layak'.";
        }
        elseif($request->get('submit')=="Kembalikan"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  5,
                ]);

            $status_rekod = new SejarahTuntutan([
                'smoku_id'      =>  $smoku_id,
                'tuntutan_id'   =>  $id,
                'status'        =>  5,
            ]);
            $status_rekod->save();

            $catatan = "testing";
            Mail::to('ziba0506@gmail.com')->send(new TuntutanDikembalikan($catatan));

            $status_kod=2;
            $status = "Tuntutan ".$no_rujukan_tuntutan." telah dikembalikan.";
        }

        $tuntutan = Tuntutan::where('status', '2')
            ->orWhere('status', '=','3')
            ->orWhere('status', '=','4')
            ->orWhere('status', '=','5')
            ->get();
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('tuntutan','status_kod','status'));
    }


    public function keputusanTuntutan()
    {
        $tuntutan = Tuntutan::where('status', '=','5')
        ->orWhere('status', '=','6')
        ->orWhere('status', '=','7')
        ->get();
        return view('tuntutan.sekretariat.keputusan.keputusan_tuntutan',compact('tuntutan'));
    }

    public function sejarahTuntutan(){
        $tuntutan = Tuntutan::where('status', '!=','4')->get();
        return view('tuntutan.sekretariat.sejarah.sejarah_tuntutan',compact('tuntutan'));
    }

    public function rekodTuntutan($id){
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        $sejarah_t = SejarahTuntutan::where('tuntutan_id', $id)->where('status', '!=','4')->orderBy('created_at', 'desc')->get();
        return view('tuntutan.sekretariat.sejarah.rekod_tuntutan',compact('tuntutan','akademik','smoku','sejarah_t','permohonan'));
    }

    public function paparRekodTuntutan($id){
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.sekretariat.sejarah.papar_tuntutan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }
    public function paparRekodSaringanTuntutan($id){
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $akademik = Akademik::where('smoku_id', $smoku_id)->first();
        return view('tuntutan.sekretariat.sejarah.papar_saringan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }
}
