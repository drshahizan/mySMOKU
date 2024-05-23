<?php

namespace App\Console\Commands;

use App\Mail\MailTamatPenajaan;
use App\Mail\MailTamatPenajaanKemaskini;
use App\Models\Akademik;
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


        $akademik = Akademik::where('status', 1)
        ->where('emel_tamat', null)->get();
        $akademik_tamat = Akademik::where('status', 1)
        ->where('emel_tamat', 1)->get();

        $now = Carbon::now();

        //komen jap. nnati dapat emel semua
        // foreach ($akademik as $item) {
        //     $time_passed = $now->diffInDays($item['tarikh_tamat']);
        //     $emel_test = 'rohaizah.muhamad@mohe.gov.my, malina.zakaria@mohe.gov.my, wsyafiqah4@gmail.com';
        //     $invalidEmails = []; // Assuming you have a list of invalid emails to check against
            
        //     if ($time_passed < 1) {
        //         $item->update([
        //             'emel_tamat' => 1,
        //         ]);

        //         $catatan = "hahahaha";
        //         if (empty($invalidEmails)) 
        //         {            
        //             // Mail::to($emailmain)->cc($smoku_id->email)->send(new PengesahanCGPA($catatan)); 
        //             Mail::to(explode(', ', $emel_test))->send(new MailTamatPenajaan($catatan));

        //         } 
        //         else 
        //         {
        //             foreach ($invalidEmails as $invalidEmail) {
        //                 Log::error('Invalid email address: ' . $invalidEmail);
        //             }
        //         }
        //     }
        // }

        //komen jap. nnati dapat emel semua
        // foreach ($akademik_tamat as $item_tamat) {
        //     $time_passed = $now->diffInDays($item_tamat['tarikh_tamat']);
        //     $emel_test = 'rohaizah.muhamad@mohe.gov.my, malina.zakaria@mohe.gov.my, wsyafiqah4@gmail.com';
        //     $invalidEmails = []; // Assuming you have a list of invalid emails to check against
            
        //     if ($time_passed > 1) {
        //         $item_tamat->update([
        //             'emel_tamat' => 2,
        //         ]);

        //         $catatan = "yaa dah tamat";
        //         if (empty($invalidEmails)) 
        //         {            
        //             // Mail::to($emailmain)->cc($smoku_id->email)->send(new PengesahanCGPA($catatan)); 
        //             Mail::to(explode(', ', $emel_test))->send(new MailTamatPenajaanKemaskini($catatan));

        //         } 
        //         else 
        //         {
        //             foreach ($invalidEmails as $invalidEmail) {
        //                 Log::error('Invalid email address: ' . $invalidEmail);
        //             }
        //         }
        //     }
        // }



        $this->info('task executed successfully!');
    }
}
