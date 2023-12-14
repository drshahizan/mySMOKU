<?php

namespace App\Console\Commands;

use App\Models\Permohonan;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TaskUnlock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:task-unlock';

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
        $now = Carbon::now();
        foreach ($permohonan as $item){
            $time_passed = $now->diffInHours($item['updated_at']);
            if($time_passed > 24){
                Permohonan::where('id', $item['id'])
                    ->update([
                        'status'   =>  2,
                    ]);
            }
        }
        $this->info('task executed successfully!');
    }
}
