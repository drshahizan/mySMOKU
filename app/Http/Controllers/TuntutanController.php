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
        //dd($permohonan);
        $akademik = Akademik::where('smoku_id', $smoku_id->id)
        ->where('smoku_akademik.status', 1)
        ->select('smoku_akademik.*')
        ->first();
        // dd($akademik);

        $currentDate = Carbon::now();
        $tarikhMula = Carbon::parse($akademik->tarikh_mula);
        $tarikhNextSem = $tarikhMula->addMonths($akademik->bil_bulan_per_sem);

        if($akademik->bil_bulan_per_sem == 6){
            $bilSem = 2;
        } else {
            $bilSem = 3;
        }
         
        $semSemasa = $akademik->sem_semasa;
        $totalSemesters = $akademik->tempoh_pengajian * $bilSem;
        
        if ($permohonan && $permohonan->status == 8) {
            //dd($tarikhNextSem);
            if ($currentDate->greaterThan($tarikhNextSem)) {
                // dd('sini');

                while ($semSemasa <= $totalSemesters) {
                     //semak dah upload result ke belum
                    $result = Peperiksaan::where('permohonan_id', $permohonan->id)
                    ->where('sesi', $akademik->sesi)
                    ->where('semester', $semSemasa)
                    ->first();
                    
                    if($result == null){
                        return redirect()->route('kemaskini.keputusan')->with('error', 'Sila kemaskini keputusan peperiksaan semester lepas terlebih dahulu.');
                    }
                    //dd('hehe');
                
                    // Increment $semSemasa for the next iteration
                    $semSemasa = $semSemasa + 1;

                    $tuntutan = Tuntutan::where('smoku_id', $smoku_id->id)
                        ->where('permohonan_id', $permohonan->id)
                        ->orderBy('tuntutan.id', 'desc')
                        ->first(['tuntutan.*']);

                    //dd($tuntutan);    

                    if ($tuntutan && $tuntutan->status == 1) {
                        $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->get();
                    } 
                    else if ($tuntutan && $tuntutan->status != 8  && $tuntutan->status != 9){
                        return redirect()->route('pelajar.dashboard')->with('sem', 'Tuntutan anda masih dalam semakan.');
                    }
                    else {
                        $tuntutan_item = collect(); // An empty collection
                    }
                    
                    $akademik = Akademik::where('smoku_id', $smoku_id->id)
                        ->where('smoku_akademik.status', 1)->first();
                    
                    return view('tuntutan.pelajar.tuntutan_baharu', compact('permohonan', 'tuntutan', 'tuntutan_item', 'akademik'));

                }

            } else { // sebab tuntutan pun boleh kemukakan pada semester sama
                // dd('situ');
                $tuntutan = Tuntutan::where('smoku_id', $smoku_id->id)
                        ->where('permohonan_id', $permohonan->id)
                        ->orderBy('tuntutan.id', 'desc')
                        ->first(['tuntutan.*']);

                //dd($tuntutan);    

                if ($tuntutan && ($tuntutan->status == 1 || $tuntutan->status == 5)) {
                   
                    $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->get();
                } 
                else if ($tuntutan && $tuntutan->status != 8 && $tuntutan->status != 9){
                    
                    return redirect()->route('pelajar.dashboard')->with('sem', 'Tuntutan anda masih dalam semakan.');
                }
                else {
                    
                    $tuntutan_item = collect(); // An empty collection
                }
                
                $akademik = Akademik::where('smoku_id', $smoku_id->id)
                    ->where('smoku_akademik.status', 1)->first();
                
                return view('tuntutan.pelajar.tuntutan_baharu', compact('permohonan', 'tuntutan', 'tuntutan_item', 'akademik'));
                //return redirect()->route('pelajar.dashboard')->with('sem', 'Ralat. Tuntutan hanya boleh dikemukakan pada semester kedua dan seterusnya.');
            }
        
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
        //dd($tuntutan->status); 
        if(!$tuntutan || $tuntutan->status == 8 || $tuntutan->status == 9){
            
            $biltuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
                ->groupBy('no_rujukan_tuntutan')
                ->selectRaw('no_rujukan_tuntutan, count(id) AS bilangan') 
                ->get();
            $bil = $biltuntutan->count();

            $running_num =  $bil + 1; //sebab nak guna satu id je  
            $no_rujukan_tuntutan =  $no_rujukan_permohonan.'/'.$running_num; // try duluuu  

        } else {
            
            $no_rujukan_tuntutan = $tuntutan->no_rujukan_tuntutan;
            //dd($no_rujukan_tuntutan);    

        }

        //simpan dalam table tuntutan_item
        $tuntutan = Tuntutan::where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->where('sesi', '=', $request->sesi)
            ->where('semester', '=', $request->semester)
            ->where('no_rujukan_tuntutan', '=', $no_rujukan_tuntutan)
            ->first();
        //dd($tuntutan);
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
        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('smoku_id', '=', $smoku_id->id)
            ->where('permohonan_id', '=', $permohonan->id)
            ->first();

        $resit = $request->resit;
        $counter = 1; 

        foreach($resit as $resit) {
                     
            $filenameresit =$resit->getClientOriginalName();
            $uniqueFilename = $counter . '_' . $filenameresit;

            // Append increment to the filename until it's unique
            while (file_exists('assets/dokumen/tuntutan/' . $uniqueFilename)) {
                $counter++;
                $uniqueFilename = $counter . '_' . $filenameresit;
            }
            $resit->move('assets/dokumen/tuntutan',$uniqueFilename);

            $data=new tuntutanitem();
            $data->tuntutan_id=$tuntutan->id;
            $data->jenis_yuran=$request->jenis_yuran;
            $data->no_resit=$request->no_resit;
            $data->resit=$uniqueFilename;
            $data->nota_resit=$request->nota_resit;
            $data->amaun=number_format($request->amaun_yuran, 2, '.', '');
            $data->save();

            $counter++;
        }

            
        //simpan dalam table sejarah_tuntutan
        $sejarahtuntutan = SejarahTuntutan::where('tuntutan_id', '=', $tuntutan->id)->first();
        if ($sejarahtuntutan === null) {
            $sejarahtuntutan = SejarahTuntutan::create([
                'tuntutan_id' => $tuntutan->id,
                'smoku_id' => $smoku_id->id,
                'status' => '1',
        
            ]);

        }else{

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

        //emel kepada sekretariat
        $user_sekretariat = User::where('tahap',3)->first();
        $cc = $user_sekretariat->email;

        $catatan = "testing";
        $emel = EmelKemaskini::where('emel_id',14)->first();
        //dd($cc);
        //dd($emel);
        Mail::to($smoku_id->email)->cc($cc)->send(new TuntutanHantar($catatan,$emel));
        
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
            //dd($permohonan);    

            if ($permohonan) {
                $tuntutan = Tuntutan::orderBy('id', 'desc')->where('tuntutan.status', '!=', '4')
                    ->where('tuntutan.smoku_id', '=', $smoku_id->id)
                    ->where('tuntutan.permohonan_id', '=', $permohonan->id)
                    ->get();

                // $tuntutan_status = Tuntutan::where('tuntutan.status', '!=', '4')
                //     ->where('tuntutan.smoku_id', '=', $smoku_id->id)
                //     ->where('tuntutan.permohonan_id', '=', $permohonan->id)
                //     ->first();    
                //dd($tuntutan);    

                return view('tuntutan.pelajar.sejarah_tuntutan',compact('tuntutan','institusi'));    

            } else {

                return redirect()->route('pelajar.dashboard')->with('permohonan', 'Sila hantar permohonan terlebih dahulu.');

            }
        }

        //dd($tuntutan);

       
    }

    public function batalTuntutan($id)
    {

        $permohonan_id = Permohonan::orderBy('id', 'desc')->where('smoku_id',$id)->first();
        DB::table('tuntutan')->orderBy('id', 'asc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)
            ->update([
                'status' => 9
            ]);
        $tuntutan_id = Tuntutan::orderBy('id', 'desc')->where('smoku_id',$id)->where('permohonan_id',$permohonan_id->id)->first();
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
        // dd($id); // ni tuntutan id
        $tuntutan = Tuntutan::orderBy('id', 'desc')->where('id',$id)->first();
        $tuntutan_item = TuntutanItem::where('tuntutan_id', $tuntutan->id)->first();

        if ($tuntutan_item) {

            DB::table('tuntutan_item')->where('id',$tuntutan_item->id)->delete();
        } 
        
        return redirect()->route('tuntutan.baharu');
        
    }
}
