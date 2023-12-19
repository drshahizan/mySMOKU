<?php

namespace App\Console\Commands;

use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\SejarahTuntutan;
use App\Models\Tuntutan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ResetSaringan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reset:saringan';

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
        $permohonan = Permohonan::where('status', 3)->get();
        $tuntutan = Tuntutan::where('status', 3)->get();
        $now = Carbon::now();
        foreach ($permohonan as $item){
            $time_passed = $now->diffInMinutes($item['updated_at']);
            if($time_passed > 1440){
                Permohonan::where('id', $item['id'])
                    ->update([
                        'status'   =>  2,
                    ]);

                $status_rekod = new SejarahPermohonan([
                    'smoku_id'          =>  $item['smoku_id'],
                    'permohonan_id'     =>  $item['id'],
                    'status'            =>  2,
                ]);
                $status_rekod->save();
            }
        }

        foreach ($tuntutan as $item){
            $time_passed = $now->diffInMinutes($item['updated_at']);
            if($time_passed > 1440){
                Tuntutan::where('id', $item['id'])
                    ->update([
                        'status'   =>  2,
                    ]);

                $status_rekod = new SejarahTuntutan([
                    'smoku_id'          =>  $item['smoku_id'],
                    'tuntutan_id'       =>  $item['id'],
                    'status'            =>  2,
                ]);
                $status_rekod->save();
            }
        }

        $this->info('task executed successfully!');
    }
}
