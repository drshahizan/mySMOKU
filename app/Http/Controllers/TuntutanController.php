<?php

namespace App\Http\Controllers;

use App\Mail\TuntutanHantar;
use App\Models\Tuntutan;
use App\Models\TuntutanItem;
use App\Models\Permohonan;
use App\Models\Smoku;
use App\Models\SejarahTuntutan;
use App\Models\Akademik;
use App\Models\EmelKemaskini;
use App\Models\InfoIpt;
use App\Models\Peperiksaan;
use App\Models\SaringanTuntutan;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Month;

class TuntutanController extends Controller
{
    public function tuntutanBaharu()
    {   
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $akademik = Akademik::join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        ->where('smoku_id',$smoku_id->id)
        ->where('status',1)
        ->first();

        $peringkat_pengajian = $akademik->peringkat_pengajian;
        $permohonan = Permohonan::where('smoku_id', $smoku_id->id)
            ->where(function ($q) use ($peringkat_pengajian) {
                $q->whereRaw("
                    CAST(NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') AS UNSIGNED) = ?
                ", [$peringkat_pengajian])
                ->orWhereRaw("
                    NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') IS NULL
                ");
            })
            ->orderBy('id', 'desc')
            ->first();

        if ($permohonan && $permohonan->status == 6 || $permohonan->status == 7 || $permohonan->status == 8) {

            $bilSem = ($akademik->bil_bulan_per_sem == 6) ? 2 : 3;
            $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
            $currentDate = Carbon::now();

            $tarikhMula = Carbon::parse($akademik->tarikh_mula);
            $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);

            $bulanMula  = $tarikhMula->format('n');
            $isSpecialStart = in_array($bulanMula, [1, 2, 3, 4, 5, 6]);

            // Initialize tahun sesi
            $tahunSesi = $isSpecialStart ? $tarikhMula->year - 1 : $tarikhMula->year;
            $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

            // Define semester pattern
            if (in_array($bulanMula, [1, 2, 3, 4, 5, 6])) {
                if ($akademik->bil_bulan_per_sem == 6) {
                    $pattern = [1, 2];
                } elseif ($akademik->bil_bulan_per_sem == 4) {
                    $pattern = [2, 3];
                } else {
                    $pattern = [$bilSem];
                }
            } else {
                $pattern = [$bilSem];
            }
            
            $patternIndex = 0;
            $currentPattern = $pattern[$patternIndex];
            $semInCurrentSesi = 0;

            $tarikhNextSem = clone $tarikhMula;
            $nextSemesterDates = [];
            $semCounter = 0;
            $semSemasa = 1;

            // Build all semesters
            while ($tarikhNextSem < $tarikhTamat) {
                $bulanMasuk = $tarikhNextSem->month;
                //     // 10092025 - tak kira semester dah. kira sesi 1 dan sesi 2 
                //     // sesi 1 untuk kemasukan bulan julai sehingga disember
                //     // sesi 2 untuk kemasukan bulan januari sehingga jun
                $sesi_bulan = in_array($bulanMasuk, [7,8,9,10,11,12]) ? 1 : 2;

                $nextSemesterDates[] = [
                    'date'       => $tarikhNextSem->format('F Y'),
                    'semester'   => $semSemasa,
                    'sesi'       => $sesiMula,    // tahun akademik
                    'sesi_bulan' => $sesi_bulan,  // sesi 1 atau 2
                ];

                $semSemasa++;
                $semCounter++;
                $semInCurrentSesi++;

                $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));

                if ($isSpecialStart) {
                    if ($semInCurrentSesi >= $currentPattern) {
                        $semInCurrentSesi = 0;
                        $tahunSesi++;
                        $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);

                        if ($patternIndex < count($pattern) - 1) {
                            $patternIndex++;
                        }
                        $currentPattern = $pattern[$patternIndex] ?? $pattern[count($pattern) - 1];
                    }
                } else {
                    if ($semCounter % $bilSem == 0) {
                        $tahunSesi++;
                        $sesiMula = $tahunSesi . '/' . ($tahunSesi + 1);
                    }
                }
            }

            // Vars to store current/previous
            $currentSesi = null;
            $previousSesi = null;
            $semSemasa = null;
            $sesiSemasa = null;

            // Find current semester/session
            foreach ($nextSemesterDates as $key => $data) {
                $dateOfSemester = Carbon::parse($data['date']);

                $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) 
                    ? Carbon::parse($nextSemesterDates[$key + 1]['date']) 
                    : null;

                $semesterEndDate = $nextSemesterStartDate 
                    ? $nextSemesterStartDate->subSecond() 
                    : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());

                if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                    $currentSesi = $data['sesi'];        // tahun akademik (eg. 2025/2026)
                    $sesiSemasa  = $data['sesi_bulan'];  // sesi 1 atau 2
                    $semSemasa   = $data['semester'];
                    $semLepas    = $data['semester'] - 1;

                    $sesiLepas = isset($nextSemesterDates[$key - 1]) 
                        ? $nextSemesterDates[$key - 1]['sesi_bulan'] 
                        : 'Tiada';
                    $previousSesi = isset($nextSemesterDates[$key - 1]) 
                        ? $nextSemesterDates[$key - 1]['sesi'] 
                        : $data['sesi'];    
                }
            }

            // Example debug output
            // echo '<br>';
            // echo 'Tahun Lepas: ' . $previousSesi . '<br>';
            // echo 'Tahun Semasa: ' . $currentSesi . '<br>';
            // echo 'Sesi Lepas: ' . $sesiLepas . '<br>';
            // echo 'Sesi Semasa: ' . $sesiSemasa . '<br>';
            // echo 'Semester Semasa: ' . $semSemasa . '<br>';
            // dd('sini');

            $tuntutan = Tuntutan::where('smoku_id', $smoku_id->id)
                ->where('permohonan_id', $permohonan->id)
                ->whereNotIn('status', [6,8])
                ->whereNull('data_migrate')
                ->orderBy('tuntutan.id', 'desc')
                ->first(['tuntutan.*']);

            //semak keputusan    
            if ($currentDate <= $semesterEndDate ) {
                // semak dah upload result ke belum
                $result = Peperiksaan::where('permohonan_id', $permohonan->id)
                ->where('sesi', $previousSesi)
                ->where('semester', $sesiLepas)
                ->first();
                if(!$result && !$tuntutan && $sesiLepas != 'Tiada'){
                    return redirect()->route('kemaskini.keputusan')->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                }elseif($result && $result->pengesahan_rendah== 1){
                    return redirect()->route('kemaskini.keputusan')->with('error', 'Keputusan peperiksaan dalam semakan.');

                }

            }
            else
            {
                return back()->with('sem', 'Tamat pengajian.');
            }

            // Retrieve amount ews // penerima biasiswa sedia ada, amaun masih 2400
            if ($akademik->sumber_biaya == 1){
                $amaun = DB::table('bk_jumlah_tuntutan')->where('program', 'BKOKU')->where('jenis', 'Wang Saku')->where('semester', 'B')->first();
            } else{
                $amaun = DB::table('bk_jumlah_tuntutan')->where('program', 'BKOKU')->where('jenis', 'Wang Saku')->first();
            }
            
            return view('tuntutan.pelajar.tuntutan_baharu', compact('permohonan', 'tuntutan','akademik','smoku_id','amaun'));
                
        } else if ($permohonan && $permohonan->status !=6) {

            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Permohonan anda masih dalam semakan.');
        } else {

            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
    }

    //TK GUNA DAH
    public function simpanTuntutan(Request $request)
    {   
        $resitRules = 'nullable|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png';
        $request->validate([
            'resit' => 'sometimes|array',
            'resit.*' => $resitRules,
        ]);

        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id',$smoku_id->id)->first();
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id', '=', $smoku_id->id)->first();

        if(!$tuntutan || $tuntutan->status == 6 || $tuntutan->status == 8 || $tuntutan->status == 9){
            
            $biltuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
                ->where('permohonan_id', '=', $permohonan->id)
                ->groupBy('no_rujukan_tuntutan')
                ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
                ->get();
            $bil = $biltuntutan->count();

            $running_num =  $bil + 1; //sebab nak guna satu id je  
            $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num;   

        } 
        else {
            $no_rujukan_tuntutan = $tuntutan->no_rujukan_tuntutan;
        }

        //simpan dalam table tuntutan
        $tuntutan = Tuntutan::where('smoku_id', $smoku_id->id)
            ->where('permohonan_id', $permohonan->id)
            ->where('sesi', $request->sesi)
            ->where('semester', $request->semester)
            ->first();

        if ($tuntutan) {
            // Case: same sesi + semester found
            if (in_array($tuntutan->status, [1, 2, 5])) {
                // update existing
                $updateData = [
                   'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                    'yuran' => '1',
                ];

                if ($tuntutan->status != '5') {
                    $updateData['status'] = '1';
                }

                $tuntutan->update($updateData);
            } else {
                // status not in 1,2,5 → cannot update
                return back()->with('sem', 'Tuntutan telah dituntut untuk semester ini.');
            }
        } else {
            // Case: sesi + semester not found → create new
            $tuntutan = Tuntutan::create([
                'smoku_id' => $smoku_id->id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,
                'yuran' => '1',
                'status' => '1',
            ]);
        }


        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::orderBy('id', 'desc')
            ->where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();

        $resit = $request->resit;

    
        // Check if $request->resit is not null before iterating
        if ($resit !== null && is_array($resit) && isset($resit[0]) && $resit[0] !== null) {
            foreach ($resit as $resitItem) {
                $extension = strtolower($resitItem->getClientOriginalExtension());
                $uniqueFilename = Str::uuid()->toString() . '.' . $extension;

                $resitItem->move('assets/dokumen/tuntutan', $uniqueFilename);

                // Create an array with all data
                $data = [
                    'tuntutan_id' => $tuntutan->id,
                    'jenis_yuran' => $request->jenis_yuran,
                    'no_resit' => $request->no_resit,
                    'nota_resit' => $request->nota_resit,
                    'amaun' => $request->amaun_yuran,
                    'resit' => $uniqueFilename,
                ];

                // Update or create the record
                TuntutanItem::updateOrCreate(
                    [
                        'tuntutan_id' => $tuntutan->id,
                        'jenis_yuran' => $request->jenis_yuran,
                    ],
                    $data
                );
            }
        } else {
            // If $request->resit is null, update other data without updating resit
            TuntutanItem::updateOrCreate(
                [
                    'tuntutan_id' => $tuntutan->id,
                    'jenis_yuran' => $request->jenis_yuran,
                ],
                [
                    'no_resit' => $request->no_resit,
                    'nota_resit' => $request->nota_resit,
                    'amaun' => $request->amaun_yuran,
                ]
            );
        }
            
        //simpan dalam table sejarah_tuntutan
        $sejarahtuntutan = SejarahTuntutan::updateOrCreate(
            ['tuntutan_id' => $tuntutan->id], // syarat
            [
                'smoku_id' => $smoku_id->id,
                'status'   => '1',
            ]
        );
            
        return redirect()->route('tuntutan.baharu')->with('message', 'simpan.');
    }

    public function hantarTuntutan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $akademik = Akademik::join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
            ->where('smoku_id', $smoku_id->id)
            ->where('status', 1)
            ->first();

        $peringkat_pengajian = $akademik->peringkat_pengajian;
        $permohonan = Permohonan::where('smoku_id', $smoku_id->id)
            ->where(function ($q) use ($peringkat_pengajian) {
                $q->whereRaw("
                    CAST(NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') AS UNSIGNED) = ?
                ", [$peringkat_pengajian])
                ->orWhereRaw("
                    NULLIF(SUBSTRING_INDEX(SUBSTRING_INDEX(no_rujukan_permohonan,'/',2),'/',-1), '') IS NULL
                ");
            })
            ->orderByDesc('id')
            ->first();

        if (! $permohonan) {
            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }

        // Ambil no rujukan permohonan
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        // Semak tuntutan terakhir
        $tuntutan_akhir = Tuntutan::where('smoku_id', $smoku_id->id)->orderByDesc('id')->first();

        if (! $tuntutan_akhir || in_array($tuntutan_akhir->status, [6, 8, 9], true)) {
            $bil = Tuntutan::where('smoku_id', $smoku_id->id)
                ->where('permohonan_id', $permohonan->id)
                ->groupBy('no_rujukan_tuntutan')
                ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan')
                ->get()
                ->count();

            $running_num = $bil + 1;
            $no_rujukan_tuntutan = $no_rujukan_permohonan . '/' . $running_num;
        } else {
            $no_rujukan_tuntutan = $tuntutan_akhir->no_rujukan_tuntutan;
        }

        // --- Cari rekod sedia ada (kalau ada)
        $tuntutan = [
            'smoku_id' => $smoku_id->id,
            'permohonan_id' => $permohonan->id,
            'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
            'sesi' => $request->sesi,
        ];

        $existing = Tuntutan::where($tuntutan)->orderByDesc('id')->first();

        // Semak sama ada sebelum ini status = 5 (dikembalikan)
        $wasReturned = $existing && $existing->status === '5';

        // --- Data untuk dikemas kini / cipta
        $updateData = [
            'semester' => $request->semester,
            'wang_saku' => '1',
            'amaun_wang_saku' => $request->amaun_wang_saku,
            'jumlah' => $request->amaun_wang_saku,
            'status' => '2',
        ];

        // Tambah tarikh_hantar hanya jika status sebelum ini bukan 5
        if (! $wasReturned) {
            $updateData['tarikh_hantar'] = now()->format('Y-m-d');
        }

        // --- Cipta atau kemas kini rekod
        $tuntutan = Tuntutan::updateOrCreate($tuntutan, $updateData);

        // Rekod sejarah tuntutan
        SejarahTuntutan::create([
            'tuntutan_id' => $tuntutan->id,
            'smoku_id' => $smoku_id->id,
            'status' => '2',
            'dilaksanakan_oleh' => Auth::id(),
        ]);

        // === Emel Pemberitahuan ===
        $catatan = "Tuntutan";
        $emel = EmelKemaskini::where('emel_id',14)->first();
        Mail::to($smoku_id->email)->send(new TuntutanHantar($catatan,$emel));
        
        return redirect()->route('pelajar.dashboard')->with('message', 'Tuntutan anda telah dihantar.');
    }

    public function sejarahTuntutan()
    {
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();

        $akademik = Akademik::where('smoku_id', $smoku_id->id)->where('status', 1)->first();
        $institusi = InfoIpt::where('id_institusi', $akademik->id_institusi)->first();   

        if ($smoku_id) {
            $permohonan = Permohonan::orderBy('id', 'desc')
                ->where('smoku_id', '=', $smoku_id->id)->first();

            if ($permohonan) {
                $tuntutan = Tuntutan::orderBy('id', 'desc')->where('tuntutan.status', '!=', '4')
                    ->where('tuntutan.smoku_id', '=', $smoku_id->id)
                    ->where('tuntutan.permohonan_id', '=', $permohonan->id)
                    ->get();

                return view('tuntutan.pelajar.sejarah_tuntutan',compact('tuntutan','institusi'));    

            } 
            else {
                return redirect()->route('pelajar.dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
            }
        }
    }

    public function batalTuntutan($id)
    {
        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        $tuntutan_id = Tuntutan::orderBy('id', 'desc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->first();
        DB::table('tuntutan')->orderBy('id', 'asc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->where('id',$tuntutan_id->id)
            ->update([
                'status' => 9
            ]);

        SejarahTuntutan::create([
            'smoku_id' => $id,
            'tuntutan_id' => $tuntutan_id->id,
            'status' => 9
        ]);
           
        return redirect()->route('pelajar.dashboard')->with('permohonan', 'Tuntutan telah dibatalkan.');      
    }

    public function deleteTuntutan($id)
    {  
        $smoku_id = Smoku::where('id', $id)->first();
        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->first();

        if ($tuntutan) {

            DB::table('tuntutan')->where('id',$tuntutan->id)->delete(); //delete permohonan
            DB::table('tuntutan_item')->where('tuntutan_id',$tuntutan->id)->delete();
            DB::table('sejarah_tuntutan')->where('tuntutan_id',$tuntutan->id)->delete();
        } 
        
        return redirect()->route('pelajar.sejarah.tuntutan');     
    }

    public function deleteItemTuntutan($id)
    {
        $tuntutan_item = TuntutanItem::where('id', $id)->first();

        if ($tuntutan_item) {
            DB::table('tuntutan_item')->where('id',$tuntutan_item->id)->delete();
        } 
        
        return back();
    }
}
