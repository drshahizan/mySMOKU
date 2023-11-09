<?php

namespace App\Http\Controllers;

use App\Exports\BorangSPPB;
use App\Exports\SenaraiPendek;
use App\Mail\KeputusanLayak;
use App\Mail\KeputusanTidakLayak;
use App\Mail\TuntutanDikembalikan;
use App\Mail\TuntutanLayak;
use App\Mail\TuntutanTidakLayak;
use App\Models\DokumenESP;
use App\Models\EmelKemaskini;
use App\Models\Peperiksaan;
use App\Models\Permohonan;
use App\Models\Saringan;
use App\Models\SaringanTuntutan;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\Smoku;
use App\Models\TuntutanItem;
use App\Models\Waris;
use App\Models\Akademik;
use App\Models\InfoIpt;
use App\Models\Kelulusan;
use App\Models\MaklumatKementerian;
use App\Models\SuratTawaran;
use App\Models\TamatPengajian;
use App\Models\Tuntutan;
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
        ->where('status','!=',9)->get();

        return view('dashboard.sekretariat.senarai_permohonan_BKOKU', compact('permohonan'));
    }

    public function filterStatusPermohonanBKOKU(Request $request, $status)
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

    public function peringkatPengajian()
    {
        $recordsBKOKU = TamatPengajian::select('tamat_pengajian.*', 'smoku_akademik.*', 'smoku.nama', 'bk_peringkat_pengajian.peringkat')
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

        return view('kemaskini.sekretariat.pengajian.kemaskini_peringkat_pengajian', compact('recordsBKOKU'));
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

        return redirect()->back()->with('success', 'Peringkat Pengajian updated successfully.');
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
            $existingRecord->penutup4_4 = $request->penutup4_3;
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

        return view('kemaskini.sekretariat.surat_tawaran.terkini', compact('suratTawaran','maklumat_kementerian'));
    }

    public function senaraiKelulusanPermohonan(Request $request)
    {
        $filters = $request->only(['institusi']); // Adjust the filter names as per your form

        $query = Permohonan::select('permohonan.*')
            ->where('permohonan.status', '=', '4');

        if (isset($filters['institusi'])) {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }

        $kelulusan = $query->get();
        $institusiPengajian = InfoIpt::all();

        return view('permohonan.sekretariat.kelulusan.kelulusan', compact('kelulusan', 'institusiPengajian', 'filters'));
    }

    public function cetakSenaraiPemohonPDF(Request $request, $programCode)
    {
        $filters = $request->only(['institusi']); // Adjust the filter names as per your form

        $query = Permohonan::where('permohonan.status', '4')
                            ->where('permohonan.program', $programCode);

        if (isset($filters['institusi']) ) {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }

        $kelulusan = $query->get();

        $pdf = PDF::loadView('permohonan.sekretariat.kelulusan.senarai_disokong_pdf', compact('kelulusan'))->setPaper('A4', 'landscape');

        return $pdf->stream('Senarai-Permohonan-Disokong.pdf');
    }

    public function cetakSenaraiPemohonExcel(Request $request, $programCode)
    {
        $filters = $request->only(['institusi']);

        $query = Permohonan::where('permohonan.status', '4')
                            ->where('permohonan.program', $programCode);

        if (isset($filters['institusi']) && !empty($filters['institusi'])) {
            $selectedInstitusi = $filters['institusi'];
            $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
                ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
                ->where('smoku_akademik.id_institusi', $selectedInstitusi);
        }

        $kelulusan = $query->get();

        return Excel::download(new SenaraiPendek($programCode, $filters), 'PermohonanDisokong.xlsx');
    }

    public function cetakBorangSppbExcel(Request $request, $programCode)
    {
        $filters = $request->only(['institusi']);

        $query = Permohonan::where('permohonan.status', '4')
            ->where('permohonan.program', $programCode);

        // Join the necessary tables to access jenis_institusi
        $query->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')
              ->join('smoku_akademik', 'smoku_akademik.smoku_id', '=', 'smoku.id')
              ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi');

        // Add a condition to check if jenis_institusi is 'UA'
        $query->where('bk_info_institusi.jenis_institusi', 'UA');

        $kelulusan = $query->get();

        return Excel::download(new BorangSPPB($programCode, $filters), 'Borang Permohonan Peruntukan BKOKU.xlsx');
    }

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
        $catatanArray = $request->get('catatan');

        if ($existingRecord) {
            // Update the respective row in permohonan_kelulusan table
            $existingRecord->no_mesyuarat = $request->noMesyuarat;
            $existingRecord->tarikh_mesyuarat = $request->tarikhMesyuarat;
            $existingRecord->keputusan = $keputusan;
            $existingRecord->catatan = implode(', ', $catatanArray); // Save catatan values as a comma-separated string
            $existingRecord->save();
        } else {
            // Create a new row in permohonan_kelulusan table
            $info_mesyuarat = new Kelulusan([
                'permohonan_id' => $id,
                'no_mesyuarat' => $request->get('noMesyuarat'),
                'tarikh_mesyuarat' => $request->get('tarikhMesyuarat'),
                'keputusan' => $keputusan,
                'catatan' => implode(', ', $catatanArray), // Save catatan values as a comma-separated string
            ]);
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
        $studentEmail = Smoku::where('id', $smoku_id)->value('email');
        $emailLulus = EmelKemaskini::where("emel_id",2)->first();
        $emailTidakLulus = EmelKemaskini::where("emel_id",3)->first();
        Mail::to($studentEmail)->send($keputusan == "Lulus" ? new KeputusanLayak($emailLulus) : new KeputusanTidakLayak($emailTidakLulus,$catatanArray));

        // Filter kelulusan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kelulusan = Kelulusan::when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_mesyuarat', [$startDate, $endDate]);
        })
        ->when($keputusan, function ($q) use ($keputusan) {
            return $q->where('keputusan', $keputusan);
        })
        ->get();

        // Pop up notification
        $id_permohonan = Permohonan::where('id', $id)->value('no_rujukan_permohonan');
        $notifikasi = "Emel notifikasi telah dihantar kepada " . $id_permohonan;

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan', 'notifikasi', 'kelulusan'));
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

                    // Send email notifications to all student email addresses
                    $studentEmail = Smoku::where('id', $item->smoku_id)->value('email');
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
                    $studentEmail = Smoku::where('id', $item->smoku_id)->value('email');
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

        // Filter kelulusan
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kelulusan = Kelulusan::orderBy('id', 'desc')
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
            return $q->whereBetween('tarikh_mesyuarat', [$startDate, $endDate]);
        })
        ->when($request->status, function ($q) use ($request) {
            return $q->where('keputusan', $request->status);
        })
        ->get();

        // Pop up notification
        $keputusan = $request->get('keputusan');
        $notifikasi = "Emel notifikasi telah dihantar kepada semua pemohon.";

        return view('permohonan.sekretariat.keputusan.keputusan', compact('keputusan','notifikasi','kelulusan'))->with('error', 'An error occurred while processing the request.');
    }

    public function senaraiKeputusanPermohonan(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kelulusan = Kelulusan::orderBy('id', 'desc')
        ->when($startDate && $endDate, function ($q) use ($startDate, $endDate) {
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

    //PENYALURAN
    public function muatNaikDokumenSPPB()
    {
        $institusiPengajian = InfoIpt::all();
        $dokumen = DokumenESP::orderBy('created_at', 'desc')->get();
        return view('dokumen.sekretariat.muat_naik_dokumen', compact('institusiPengajian','dokumen'));
    }

    public function hantarDokumenSPPB(Request $request)
    {
        $user = auth()->user();
        $institusiId = $request->input('institusi_id'); // Get the selected institution ID from the form
        $existRecord = DokumenESP::where('institusi_id', $institusiId)->first();
        $currentYear = Carbon::now()->year;

        $dokumen1 = $request->file('dokumen1');
        $dokumen1a = $request->file('dokumen1a');
        $dokumen2 = $request->file('dokumen2');
        $dokumen2a = $request->file('dokumen2a');
        $dokumen3 = $request->file('dokumen3');
        $uploadedDokumen1 = [];
        $uploadedDokumen1a = [];
        $uploadedDokumen2 = [];
        $uploadedDokumen2a = [];
        $uploadedDokumen3 = [];

        // Validation rules for each document column
        $rules = [
            'dokumen1.*' => 'required|mimes:pdf,xls,xlsx|max:2048',
            'dokumen1a.*' => 'required|mimes:pdf,xls,xlsx|max:2048',
            'dokumen2.*' => 'required|mimes:pdf,xls,xlsx|max:2048',
            'dokumen2a.*' => 'required|mimes:pdf,xls,xlsx|max:2048',
            'dokumen3.*' => 'required|mimes:pdf,xls,xlsx|max:2048',
        ];

        // Custom error messages
        $customMessages = [
            'required' => 'Sila pilih fail untuk :attribute.',
            'mimes' => 'Format fail bagi :attribute mestilah pdf, xls, atau xlsx sahaja.',
            'max' => 'Saiz maksimum fail adalah 2 MB.',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($dokumen1 && $dokumen1a && $dokumen2 && $dokumen2a && $dokumen3) {
            foreach ($dokumen1 as $key => $sijil) {
                $uniqueFilenameDokumen1 = uniqid() . '_' . $sijil->getClientOriginalName();
                $sijil->move('assets/dokumen/sppb_1', $uniqueFilenameDokumen1);
                $uploadedDokumen1[] = $uniqueFilenameDokumen1;

                $uniqueFilenameDokumen1a = uniqid() . '_' . $dokumen1a[$key]->getClientOriginalName();
                $dokumen1a[$key]->move('assets/dokumen/sppb_1a', $uniqueFilenameDokumen1a);
                $uploadedDokumen1a[] = $uniqueFilenameDokumen1a;

                $uniqueFilenameDokumen2 = uniqid() . '_' . $dokumen2[$key]->getClientOriginalName();
                $dokumen2[$key]->move('assets/dokumen/sppb_2', $uniqueFilenameDokumen2);
                $uploadedDokumen2[] = $uniqueFilenameDokumen2;

                $uniqueFilenameDokumen2a = uniqid() . '_' . $dokumen2a[$key]->getClientOriginalName();
                $dokumen2a[$key]->move('assets/dokumen/sppb_2a', $uniqueFilenameDokumen2a);
                $uploadedDokumen2a[] = $uniqueFilenameDokumen2a;

                $uniqueFilenameDokumen3 = uniqid() . '_' . $dokumen3[$key]->getClientOriginalName();
                $dokumen3[$key]->move('assets/dokumen/sppb_3', $uniqueFilenameDokumen3);
                $uploadedDokumen3[] = $uniqueFilenameDokumen3;

                if($existRecord){
                    $existRecord->update([
                        'user_id' => $user->id, // Use the arrow operator (=>) here, not the equal sign (=)
                        'institusi_id' => $institusiId,
                        'no_rujukan' => "{$institusiId}/{$currentYear}/1",
                        'dokumen1' => $uniqueFilenameDokumen1,
                        'dokumen1a' => $uniqueFilenameDokumen1a,
                        'dokumen2' => $uniqueFilenameDokumen2,
                        'dokumen2a' => $uniqueFilenameDokumen2a,
                        'dokumen3' => $uniqueFilenameDokumen3,
                    ]);
                }
                else{
                    $dokumenESP = new DokumenESP();
                    $dokumenESP->user_id = auth()->user()->id;
                    $dokumenESP->institusi_id = $institusiId;
                    $dokumenESP->no_rujukan = "{$institusiId}/{$currentYear}/1";
                    $dokumenESP->dokumen1 = $uniqueFilenameDokumen1;
                    $dokumenESP->dokumen1a = $uniqueFilenameDokumen1a;
                    $dokumenESP->dokumen2 = $uniqueFilenameDokumen2;
                    $dokumenESP->dokumen2a = $uniqueFilenameDokumen2a;
                    $dokumenESP->dokumen3 = $uniqueFilenameDokumen3;
                    $dokumenESP->save();
                }
            }
        }

        // Store the uploaded file names in the session for display in your view
        return redirect()->route('sekretariat.muat-naik.SPPB')->with('success', 'Semua fail SPBB telah berjaya dikemaskini.');
    }

    public function muatTurunDokumenSPPB()
    {
        // Order by created date in descending order
        $dokumen = DokumenESP::orderBy('created_at', 'desc')->get();
        return view('dokumen.sekretariat.muat_turun_dokumen', compact('dokumen'));
    }

    public function salinanDokumenSPPB($id)
    {
        $dokumen = DokumenESP::where('institusi_id', $id)->first();
        return view('dokumen.sekretariat.salinan_dokumen',compact('dokumen'));
    }


    //TUNTUTAN
    public function senaraiTuntutanKedua()
    {
        $tuntutan = Tuntutan::where('status', '2')
        ->orWhere('status', '=','3')
        ->orWhere('status', '=','5')
        ->orWhere('status', '=','6')
        ->orWhere('status', '=','7')
        ->get();
        $status_kod=0;
        $status = null;
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('tuntutan','status_kod','status'));
    }

    public function keputusanPeperiksaan($id){
        $peperiksaan = Peperiksaan::where('permohonan_id',$id)->get();
        return view('tuntutan.sekretariat.saringan.keputusan_peperiksaan',compact('peperiksaan'));
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
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();

        $status_rekod = new SejarahTuntutan([
            'smoku_id'          =>  $smoku_id,
            'tuntutan_id'       =>  $id,
            'status'            =>  3,
            'dilaksanakan_oleh'    =>  Auth::user()->id,
        ]);
        $status_rekod->save();

        return view('tuntutan.sekretariat.saringan.maklumat_tuntutan',compact('permohonan','smoku','akademik','tuntutan','tuntutan_item'));
    }

    public function saringTuntutanKedua(Request $request, $id)
    {
        $no_rujukan_tuntutan= Tuntutan::where('id', $id)->value('no_rujukan_tuntutan');
        $permohonan_id = Tuntutan::where('id', $id)->value('permohonan_id');
        $smoku_id = Permohonan::where('id', $permohonan_id)->value('smoku_id');
        $smoku_emel =Smoku::where('id', $smoku_id)->value('email');
        $tuntutan_item =TuntutanItem::where('tuntutan_id', $id)->get();

        if($request->get('submit')=="Layak"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  6,
                ]);

            Tuntutan::where('id', $id)
                ->update([
                    'yuran_disokong'        =>  $request->get('yuran_disokong'),
                    'wang_saku_disokong'    =>  $request->get('w_saku_disokong'),
                    'baki_disokong'         =>  $request->get('w_saku_disokong'),
                    'status'                =>  6,
                ]);

            $i=0;
            $invois = $request->get('invois');
            foreach($tuntutan_item as $item){
                TuntutanItem::where('tuntutan_id', $item['id'])
                    ->update([
                        'kep_saringan'      =>  $invois[$i],
                    ]);
                $i++;
            }

            $saringan = new SaringanTuntutan([
                'tuntutan_id'               =>  $id,
                'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                'catatan'                   =>  $request->get('catatan'),
                'status'                    =>  6,
            ]);
            $saringan->save();

            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $id,
                'status'            =>  6,
                'dilaksanakan_oleh'    =>  Auth::user()->id,
            ]);
            $status_rekod->save();

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
        elseif($request->get('submit')=="TidakLayak"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  7,
                ]);

            $i=0;
            $invois = $request->get('invois');
            foreach($tuntutan_item as $item){
                TuntutanItem::where('id', $item['id'])
                    ->update([
                        'kep_saringan'      =>  $invois[$i],
                    ]);
                $i++;
            }

            $saringan = new SaringanTuntutan([
                'tuntutan_id'               =>  $id,
                'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                'catatan'                   =>  $request->get('catatan'),
                'status'                    =>  7,
            ]);
            $saringan->save();

            $status_rekod = new SejarahTuntutan([
                'smoku_id'          =>  $smoku_id,
                'tuntutan_id'       =>  $id,
                'status'            =>  7,
                'dilaksanakan_oleh'    =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            $saringan = SaringanTuntutan::where('tuntutan_id',$id)->first();
            $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();

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
        elseif($request->get('submit')=="Kembalikan"){
            Tuntutan::where('id', $id)
                ->update([
                    'status'   =>  5,
                ]);

            $i=0;
            $invois = $request->get('invois');
            foreach($tuntutan_item as $item){
                TuntutanItem::where('id', $item['id'])
                    ->update([
                        'kep_saringan'      =>  $invois[$i],
                    ]);
                $i++;
            }

            $saringan = new SaringanTuntutan([
                'tuntutan_id'               =>  $id,
                'saringan_kep_peperiksaan'  =>  $request->get('peperiksaan'),
                'catatan'                   =>  $request->get('catatan'),
                'status'                    =>  5,
            ]);
            $saringan->save();

            $status_rekod = new SejarahTuntutan([
                'smoku_id'      =>  $smoku_id,
                'tuntutan_id'   =>  $id,
                'status'        =>  5,
                'dilaksanakan_oleh'    =>  Auth::user()->id,
            ]);
            $status_rekod->save();

            $saringan = SaringanTuntutan::where('tuntutan_id',$id)->first();
            $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();

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
            ->get();
        return view('tuntutan.sekretariat.saringan.senarai_tuntutan',compact('tuntutan','status_kod','status'));
    }

    //Keputusan
    // public function keputusanTuntutan(Request $request)
    // {
    //     $dateRange = $request->input('daterange');
    //     $status = $request->input('status');

    //     // You can update this query to filter by both date range and status
    //     $tuntutanQuery = Tuntutan::where('status', '5')
    //         ->orWhere('status', '6')
    //         ->orWhere('status', '7');

    //     if (!empty($dateRange)) {
    //         // Convert the date range format to "YYYY-MM-DD"
    //         list($start, $end) = explode(' - ', $dateRange);
    //         $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $start)));
    //         $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $end)));

    //         $tuntutanQuery->whereBetween('created_at', [$startDate, $endDate]);
    //     }

    //     if (!empty($status)) {
    //         $tuntutanQuery->where('status', $status);
    //     }

    //     $tuntutan = $tuntutanQuery->get();

    //     return view('tuntutan.sekretariat.keputusan.keputusan_tuntutan', compact('tuntutan'));
    // }

    public function keputusanTuntutan(Request $request)
    {
        $dateRange = $request->input('daterange');
        $status = $request->input('status');

        // You can update this query to filter by both date range and status
        $tuntutanQuery = Tuntutan::where('status', '5')
            ->orWhere('status', '6')
            ->orWhere('status', '7');

        if (!empty($dateRange)) {
            // Convert the date range format to "YYYY-MM-DD"
            list($start, $end) = explode(' - ', $dateRange);
            $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $start)));
            $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $end)));

            // Log the SQL query and bindings
            Log::info('Generated SQL query:', [
                'query' => $tuntutanQuery->whereBetween('created_at', [$startDate, $endDate])->toSql(),
                'bindings' => $tuntutanQuery->getBindings(),
            ]);

            $tuntutanQuery->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (!empty($status)) {
            $tuntutanQuery->where('status', $status);
        }

        $tuntutan = $tuntutanQuery->get();

        return view('tuntutan.sekretariat.keputusan.keputusan_tuntutan', compact('tuntutan'));
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
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.saringan.papar_tuntutan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function kemaskiniTuntutan($id){
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
        return view('tuntutan.sekretariat.saringan.kemaskini_tuntutan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function hantarTuntutan(Request $request, $id){
        $t_id = SejarahTuntutan::where('id', $id)->value('tuntutan_id');
        Tuntutan::where('id', $t_id)
            ->update([
                'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
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
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.saringan.papar_tuntutan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    //Sejarah
    public function sejarahTuntutan(){
        $tuntutan = Tuntutan::where('status', '!=','4')->get();
        return view('tuntutan.sekretariat.sejarah.sejarah_tuntutan',compact('tuntutan'));
    }

    public function rekodTuntutan($id){
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

    public function paparRekodTuntutan($id){
        $sejarah_t = SejarahTuntutan::where('id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $sejarah_t->tuntutan_id)->get();
        $tuntutan = Tuntutan::where('id', $sejarah_t->tuntutan_id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.sejarah.papar_tuntutan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t'));
    }
    public function paparRekodSaringanTuntutan($id){
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
        return view('tuntutan.sekretariat.sejarah.papar_saringan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function paparRekodPembayaran($id){
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

    public function kemaskiniSaringan($id){
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
        return view('tuntutan.sekretariat.sejarah.kemaskini_saringan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    public function hantarSaringan(Request $request, $id){
        $t_id = SejarahTuntutan::where('id', $id)->value('tuntutan_id');
        Tuntutan::where('id', $t_id)
            ->update([
                'yuran_dibayar'         =>  $request->get('yuran_dibayar'),
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
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.sejarah.papar_saringan',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','sejarah_t','saringan'));
    }

    //Pembayaran
    public function senaraiPembayaran()
    {
        $tuntutan = Tuntutan::where('status', '8')->get();
        $status_kod=0;
        $status = null;
        return view('tuntutan.sekretariat.pembayaran.senarai',compact('tuntutan','status_kod','status'));
    }

    public function maklumatPembayaran($id){

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

    public function saringPembayaran(Request $request, $id){
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

        $tuntutan = Tuntutan::where('status', '8')->get();
        return view('tuntutan.sekretariat.pembayaran.senarai',compact('tuntutan','status_kod','status'));
    }

    public function paparPembayaran($id){
        $tuntutan = Tuntutan::where('id', $id)->first();
        $permohonan = Permohonan::where('id', $tuntutan->permohonan_id)->first();
        $saringan = SaringanTuntutan::where('tuntutan_id', $id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $id)->get();
        $smoku_id = $tuntutan->smoku_id;
        $smoku = Smoku::where('id', $smoku_id)->first();
        $rujukan = explode("/", $permohonan->no_rujukan_permohonan);
        $peringkat = $rujukan[1];
        $akademik = Akademik::where('smoku_id', $smoku_id)->where('peringkat_pengajian', $peringkat)->first();
        return view('tuntutan.sekretariat.pembayaran.papar',compact('permohonan','tuntutan','tuntutan_item','smoku','akademik','saringan'));
    }

    public function kemaskiniPembayaran($id){
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

    public function hantarPembayaran(Request $request, $id){
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

        $tuntutan = Tuntutan::where('status', '8')->get();
        return view('tuntutan.sekretariat.pembayaran.senarai',compact('tuntutan','status_kod','status'));
    }
}
