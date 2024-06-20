<?php

namespace App\Console\Commands;

use App\Mail\MailTamatPenajaan;
use App\Mail\MailTamatPenajaanKemaskini;
use App\Models\Akademik;
use App\Models\ButiranPelajar;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class TamatPenajaan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'makluman:tamatPenajaan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $akademik = Akademik::where('status', 1)
        ->where('emel_tamat', null)->get();

        //test
        // $akademik = Akademik::where('smoku_id', 3725)->get();
        
        //komen jap. nanti dapat emel semua
        // foreach ($akademik as $item) {
        //     $emel = ButiranPelajar::where('smoku_id','=',$item['smoku_id'])->first();
        //     $emel_pelajar = $emel->emel;
        //     $time_passed = $now->diffInDays($item['tarikh_tamat']);
        //     $emel_test = 'rohaizah.muhamad@mohe.gov.my, malina.zakaria@mohe.gov.my, wsyafiqah4@gmail.com';
        //     $invalidEmails = []; // Assuming you have a list of invalid emails to check against
            
        //     if ($time_passed < 90) {
        //         $item->update([
        //             'emel_tamat' => 1,
        //         ]);

        //         $catatan = "SEBELUM";
        //         if (empty($invalidEmails)) 
        //         {            
        //             // Mail::to($emailmain)->cc($smoku_id->email)->send(new PengesahanCGPA($catatan)); 
        //             Mail::to($emel_pelajar)->cc(explode(', ', $emel_test))->send(new MailTamatPenajaan($catatan));

        //         } 
        //         else 
        //         {
        //             foreach ($invalidEmails as $invalidEmail) {
        //                 Log::error('Invalid email address: ' . $invalidEmail);
        //             }
        //         }
        //     }
        // }

        $akademik_tamat = Akademik::where('status', 1)
        ->where('emel_tamat', 1)->get();
        //komen jap. nnati dapat emel semua
        foreach ($akademik_tamat as $item_tamat) {
            $emel = ButiranPelajar::where('smoku_id','=',$item_tamat['smoku_id'])->first();
            $emel_pelajar = $emel->emel;
            $time_passed = $now->diffInDays($item_tamat['tarikh_tamat']);
            $emel_test = 'rohaizah.muhamad@mohe.gov.my, malina.zakaria@mohe.gov.my, wsyafiqah4@gmail.com';
            $invalidEmails = []; // Assuming you have a list of invalid emails to check against
            
            if ($time_passed > 90) {
                $item_tamat->update([
                    'emel_tamat' => 2,
                ]);

                $catatan = "TAMAT";
                if (empty($invalidEmails)) 
                {            
                    // Mail::to($emailmain)->cc($smoku_id->email)->send(new PengesahanCGPA($catatan)); 
                    Mail::to($emel_pelajar)->cc(explode(', ', $emel_test))->send(new MailTamatPenajaanKemaskini($catatan));

                } 
                else 
                {
                    foreach ($invalidEmails as $invalidEmail) {
                        Log::error('Invalid email address: ' . $invalidEmail);
                    }
                }
            }
        }


        $this->info('task executed successfully!');
    }
}
