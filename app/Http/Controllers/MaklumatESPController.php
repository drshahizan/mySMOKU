<?php

namespace App\Http\Controllers;

use App\Models\Smoku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaklumatESPController extends Controller
{
    public function index()
    {
        
        $data = DB::select('
                SELECT a.no_kp as nokp, a.nama, DATE_FORMAT(a.tarikh_lahir, "%d/%m/%Y") AS tarikh_lahir, d.negeri_lahir, a.jantina
                , d.agama, a.keturunan, "M01" as warganegara, a.alamat_tetap as alamat1, "" as alamat2
                , d.alamat_tetap_poskod as poskod, d.alamat_tetap_bandar as bandar, d.alamat_tetap_negeri as negeri, d.tel_bimbit as telefon_hp
                , d.alamat_surat_menyurat as alamat01, "" as alamat02, "" as alamat03, "" as telefon_o
                , CASE WHEN b.program = "BKOKU" THEN "OKU" ELSE "PPK" END as program
                , e.kod_esp as peringkat, YEAR(c.tarikh_mula) as tahun_tawar, YEAR(c.tarikh_mula) as tahun_taja 
                , c.tempoh_pengajian * 12 as tempoh_taja
                , c.tarikh_mula as tarikh_taja
                , SUBSTRING_INDEX(c.sesi, "/", 1) AS sesi_mula
                , CONCAT(
                    SUBSTRING_INDEX(c.sesi, "/", 1) + c.tempoh_pengajian
                ) AS sesi_tamat
                , c.id_institusi as institusi, c.nama_kursus as kursus
                , c.tarikh_tamat as tarikh_tamat
                , d.no_akaun_bank as no_akaun
                , a.nama as nama_akaun, 101 as kod_bank, "BANK ISLAM (M) BHD." as nama_bank
                , b.no_rujukan_permohonan as id_permohonan 
                FROM smoku a 
                INNER JOIN permohonan b ON b.smoku_id = a.id
                INNER JOIN smoku_akademik c ON c.smoku_id = a.id 
                INNER JOIN smoku_butiran_pelajar d ON d.smoku_id = a.id
                INNER JOIN bk_peringkat_pengajian e ON e.kod_peringkat = c.peringkat_pengajian
                WHERE c.status = 1 AND b.status = 6
                and a.no_kp=950623031212
            ');
            
        return response()->json($data);
            
        
    }

    public function store(Request $request)
    {
        $post = Smoku::create($request->all());
        return response()->json($post, 201);
    }

    public function show(Smoku $post)
    {
        return $post;
    }

    public function update(Request $request, Smoku $post)
    {
        $post->update($request->all());
        return response()->json($post, 200);
    }

    public function destroy(Smoku $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
