<?php

namespace App\Console\Commands;

use App\Models\Kursus;
use App\Models\InfoIpt;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class dataMQRPA extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:mqrpa';

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
        set_time_limit(1200);
        Log::channel('mqr')->info('data:mqrpa started');

        $response = Http::post('http://10.29.216.151/api/bkoku/request-MQAPA');

        if ($response->successful()) {
            $data = json_decode($response->body(), true);

            if (isset($data['dataMQRPA'])) {
                // $counter = 0;
                $counter = 0;
                $institusiCreated = 0;
                $institusiUpdated = 0;
                foreach ($data['dataMQRPA'] as $item) {

                    // if ($counter < 1) {

                    Kursus::updateOrInsert(
                        ['no_rujukan' => $item['NoRujProg']], // Condition to find the record
                        [
                            'nama_kursus' => $item['NamaProgBM'],
                            'nama_kursus_bi' => $item['NamaProgBI'],
                            'kod_nec' => $item['KodNEC'],
                            'bidang' => $item['Bidang'],
                            'kod_peringkat' => $item['PeringkatKelayakan'],
                            'peringkat' => $item['Peringkat'],
                            'kod_pengendalian' => $item['KodPengendalian'],
                            'kaedah_pengendalian' => $item['KaedahPengendalian'],
                            'tarikh_mula' => $item['TarikhMula'],
                            'tarikh_tamat' => $item['TarikhTamat'],
                            'id_institusi' => $item['IdAgensi'],
                            'nama_institusi' => $item['NamaIPTBM'],
                            'nama_institusi_bi' => $item['NamaIPTBI'],
                            'poskod' => $item['Poskod'],
                            'institusi_penganugerahan' => $item['InstitusiPenganugerahan']
                        ]
                    );

                    if (!empty($item['IdAgensi'])) {
                        $institusi = InfoIpt::updateOrCreate(
                            ['id_institusi' => $item['IdAgensi']],
                            [
                                'nama_institusi' => $item['NamaIPTBM'],
                                'nama_institusi_bi' => $item['NamaIPTBI'],
                                'poskod' => $item['Poskod'],
                            ]
                        );
                        if ($institusi->wasRecentlyCreated) {
                            $institusiCreated++;
                        } else {
                            $institusiUpdated++;
                        }
                    }

                    //MaklumatKursusMQA::create($item);
                    $counter++;
                    // } else {
                    //    break; // Break the loop after inserting 10 records
                    // }
                }
                Log::channel('mqr')->info('data:mqrpa finished', [
                    'kursus_total' => $counter,
                    'institusi_created' => $institusiCreated,
                    'institusi_updated' => $institusiUpdated,
                ]);
                $this->info('Data inserted successfully');
                return Command::SUCCESS;
            } else {
                Log::channel('mqr')->warning('data:mqrpa invalid API response format');
                $this->error('Invalid API response format');
                return Command::FAILURE;
            }
            //untuk papar
            // foreach ($data['dataMQR'] as $item) {
            //     foreach ($item as $key => $value) {
            //         echo $key . ": " . $value . "<br>";

            //     }
            //     echo "<br>"; // Add a line break between items
            // }
        } else {
            Log::channel('mqr')->error('data:mqrpa unable to fetch data from API', [
                'status' => $response->status(),
            ]);
            $this->error('Unable to fetch data from API');
            return Command::FAILURE;
        }
    }
}
