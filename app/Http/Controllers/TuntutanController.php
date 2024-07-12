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
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TuntutanController extends Controller
{
    public function tuntutanBaharu()
    {   
        $smoku_id = Smoku::where('no_kp', Auth::user()->no_kp)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku_id->id)->first();

        $akademik = DB::table('smoku_akademik')
            ->where('smoku_id',$permohonan->smoku_id)
            ->where('smoku_akademik.status', 1)
            ->first();
        $maxLimit = DB::table('bk_jumlah_tuntutan')
            ->where('program','BKOKU')
            ->where('jenis', 'Yuran')
            ->first();	
        $limitWangSaku = DB::table('bk_jumlah_tuntutan')
            ->where('program','BKOKU')
            ->where('jenis', 'Wang Saku')
            ->first();	   	

        if ($permohonan && $permohonan->status == 8) {

            $tuntutan = Tuntutan::where('smoku_id', $smoku_id->id)
                    ->where('permohonan_id', $permohonan->id)
                    ->orderBy('tuntutan.id', 'desc')
                    ->first(['tuntutan.*']);

            // $semSemasa = $akademik->sem_semasa;
            $semSemasa = 1;
            // $sesiSemasa = $akademik->sesi;

            if($akademik->bil_bulan_per_sem == 6){
                $bilSem = 2;
            } else {
                $bilSem = 3;
            }
            $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
            $currentYear = date('Y');

            $currentDate = Carbon::now();
            $tarikhMula = Carbon::parse($akademik->tarikh_mula);
            $tarikhTamat = Carbon::parse($akademik->tarikh_tamat);
            $sesiMula = $tarikhMula->format('Y') . '/' . ($tarikhMula->format('Y') + 1);

            $tarikhNextSem = clone $tarikhMula; // Clone to avoid modifying the original date
            $nextSemesterDates = [];
            $firstIteration = true;

            while ($tarikhNextSem < $tarikhTamat) 
            {
                $nextSemesterDates[] = [
                    'date' => $tarikhNextSem->format('Y-m-d'),
                    'semester' => $semSemasa,
                    'sesi' => $sesiMula,
                ];

                $semSemasa++;
                $tarikhNextSem->add(new DateInterval("P{$akademik->bil_bulan_per_sem}M"));

                $awal = $tarikhNextSem->format('Y');
                $akhir = $tarikhNextSem->format('Y') + 1;
                
                $sesiMula = $awal . '/' . $akhir;
            }
           

            $currentSesi = null; // Initialize a variable to store the current session
            $previousSesi = null; // Initialize a variable to store the previous session
            $semSemasa = null; // Initialize a variable to store the current semester
            $sesiSemasa = null; // Initialize a variable to store the current session

            foreach ($nextSemesterDates as $key => $data) 
            {
                $dateOfSemester = \Carbon\Carbon::parse($data['date']);
                
                // Set the end date to be just before the start of the next semester
                $nextSemesterStartDate = isset($nextSemesterDates[$key + 1]) ? \Carbon\Carbon::parse($nextSemesterDates[$key + 1]['date']) : null;
                // $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : $dateOfSemester->endOfDay();
                $semesterEndDate = $nextSemesterStartDate ? $nextSemesterStartDate->subSecond() : ($tarikhTamat ? $tarikhTamat->endOfDay()->subSecond() : $dateOfSemester->endOfDay()->subSecond());

                // Check if the current date is within the range of the semester
                if ($currentDate->between($dateOfSemester->startOfDay(), $semesterEndDate)) {
                    $currentSesi = $data['sesi'];
                    $semSemasa = $data['semester'];
                    $semLepas = $data['semester'] - 1;
                    $sesiSemasa = $data['sesi'];
                    $previousSesi = isset($nextSemesterDates[$key - 1]) ? $nextSemesterDates[$key - 1]['sesi'] : null;
                }
            }

            // Output the results
            // echo 'Current Session: ' . $currentSesi . PHP_EOL;
            // echo 'Previous Session: ' . $previousSesi . PHP_EOL;
            // echo 'Current Semester: ' . $semSemasa . PHP_EOL;
            // echo 'Current Session: ' . $sesiSemasa . PHP_EOL;
            // dd($semLepas);
            // echo 'Date: ' . $data['date'] . ', Semester: ' . $data['semester'] . ', Sesi: ' . $data['sesi'];

            if ($semLepas != 0 ) {
                if($semSemasa != $semLepas){
                    // semak dah upload result ke belum
                    $result = Peperiksaan::where('permohonan_id', $permohonan->id)
                    ->where('semester', $semLepas)
                    ->first();
                    if($result == null){
                        if(($semSemasa == $semLepas || $semSemasa == $akademik->sem_semasa) && $permohonan->yuran == null && $permohonan->wang_saku == '1'){
                            return back()->with('sem', 'Wang saku boleh dituntut pada sem seterusnya.');
                        }
                        return redirect()->route('kemaskini.keputusan')->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                    }elseif($result && $result->pengesahan_rendah== 1){
                        return redirect()->route('kemaskini.keputusan')->with('error', 'Keputusan peperiksaan dalam semakan.');

                    }

                }
            }

            // if(($semSemasa == $semLepas || $semSemasa == $akademik->sem_semasa) && $permohonan->yuran == null && $permohonan->wang_saku == '1'){
            //     return back()->with('sem', 'Wang saku boleh dituntut pada sem seterusnya.');
            // }
       
            if (($currentSesi === $previousSesi) || $previousSesi === null) 
            {
                if (!$tuntutan) {
                    $wang_saku = 0.00;
                    //nak tahu baki sesi semasa permohonan lepas
                    $baki_total = $permohonan->baki_dibayar;
                }
                else{
                    $ada = DB::table('tuntutan')
                        ->where('permohonan_id', $tuntutan->permohonan_id)
                        ->orderBy('id', 'desc')
                        ->first();
                    
                    $jumlah_tuntut = DB::table('tuntutan')
                        ->where('permohonan_id', $tuntutan->permohonan_id)
                        ->where('status','!=', 9)
                        ->get();
                    $sum = $jumlah_tuntut->sum('jumlah');	
                    $baki_total = $permohonan->baki_dibayar - $sum;	
                }	
            }
            else {
                if ($permohonan->yuran == null && $permohonan->wang_saku == '1') {
                    if($semSemasa != $semLepas && $semSemasa != $akademik->sem_semasa){
                        // dd($akademik->bil_bulan_per_sem);
                        $baki_total = $limitWangSaku->jumlah * $akademik->bil_bulan_per_sem; 
                    }
                    else {
                        $baki_total = '0'; 
                    }
                }
                else {
                    $baki_total = $maxLimit->jumlah;
                }
            }   

            if ($tuntutan && ($tuntutan->status == 1 || $tuntutan->status == 5)) {
                
                $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->get();
            } 
            else if ($tuntutan && $tuntutan->status != 8 && $tuntutan->status != 9){
                
                return redirect()->route('pelajar.dashboard')->with('sem', 'Tuntutan anda masih dalam semakan.');
            }
            else {
                
                $tuntutan_item = collect(); // An empty collection
            }
            
            return view('tuntutan.pelajar.tuntutan_baharu', compact('permohonan', 'tuntutan', 'tuntutan_item','akademik','smoku_id','sesiSemasa','semSemasa','baki_total'));
                
        } else if ($permohonan && $permohonan->status !=8) {

            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Permohonan anda masih dalam semakan.');
        } else {

            return redirect()->route('pelajar.dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');
        }
    }

    public function simpanTuntutan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::all()->where('smoku_id', '=', $smoku_id->id)->first();
        $no_rujukan_permohonan = $permohonan->no_rujukan_permohonan;

        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id', '=', $smoku_id->id)->first();

        if(!$tuntutan || $tuntutan->status == 8 || $tuntutan->status == 9){
            
            $biltuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
                ->groupBy('no_rujukan_tuntutan')
                ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
                ->get();
            $bil = $biltuntutan->count();

            $running_num =  $bil + 1; //sebab nak guna satu id je  
            $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num; // try duluuu  

        } 
        else {  
            $no_rujukan_tuntutan = $tuntutan->no_rujukan_tuntutan;
        }

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->where('sesi', '=', $request->sesi)
            ->where('semester', '=', $request->semester)
            ->where('no_rujukan_tuntutan', '=', $no_rujukan_tuntutan)
            ->first();

            if(!$tuntutan){
            $tuntutan = Tuntutan::create([
                'smoku_id' => $smoku_id->id,
                'permohonan_id' => $permohonan->id,
                'no_rujukan_tuntutan' => $no_rujukan_tuntutan,
                'sesi' => $request->sesi,
                'semester' => $request->semester,
                'yuran' => '1',
                'status' => '1',
            ]);

            $tuntutan->save();
        }    

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::orderBy('id', 'desc')
            ->where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();    

        $resit = $request->resit;
        $counter = 1; 

        // Check if $request->resit is not null before iterating
        if ($resit !== null && is_array($resit) && isset($resit[0]) && $resit[0] !== null) {
            foreach ($resit as $resitItem) {
                $filenameresit = $resitItem->getClientOriginalName();
                $uniqueFilename = $counter . '_' . $filenameresit;

                // Append increment to the filename until it's unique
                while (file_exists('assets/dokumen/tuntutan/' . $uniqueFilename)) {
                    $counter++;
                    $uniqueFilename = $counter . '_' . $filenameresit;
                }

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

                $counter++;
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
        $sejarahtuntutan = SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)->first();
        if ($sejarahtuntutan === null) {
            $sejarahtuntutan = SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $smoku_id->id,
                'status' => '1',
        
            ]);

        }
        else{
            SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)
                ->update([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $smoku_id->id,
                'status' => '1',
            ]);
        }
        $sejarahtuntutan->save();
            
        return redirect()->route('tuntutan.baharu')->with('message', 'simpan.');
    }

    public function hantarTuntutan(Request $request)
    {   
        $smoku_id = Smoku::where('no_kp',Auth::user()->no_kp)->first();
        $permohonan = Permohonan::all()->where('smoku_id', '=', $smoku_id->id)->first();

        $tuntutan = Tuntutan::where('smoku_id', $smoku_id->id)->orderBy('id', 'desc')->first();

        if ($tuntutan !== null) {
            $tuntutan->update([
                'wang_saku' => $request->wang_saku,
                'amaun_wang_saku' => $request->amaun_wang_saku,
                'jumlah' => $request->jumlah,
                'tarikh_hantar' => now()->format('Y-m-d'),
                'status' => '2',
            ]);
            // Save the changes to the database
            $tuntutan->save();
        }

        //simpan dalam table tuntutan_item
        // $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
        //     //->where('permohonan_id', '=', $permohonan->id) //salah ni
        //     ->first();
        
        $user = SejarahTuntutan::create([
            'tuntutan_id' => $tuntutan->id,
            'smoku_id' => $smoku_id->id,
            'status' => '2',
    
        ]);
        $user->save();

        // //emel kepada sekretariat
        // $user_sekretariat = User::where('tahap',3)->first();
        // $cc = $user_sekretariat->email;

        // COMMENT PROD
        $catatan = "testing";
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
