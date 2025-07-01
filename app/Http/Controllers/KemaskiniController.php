<?php

namespace App\Http\Controllers;

use App\Models\Agama;
use App\Models\Akademik;
use App\Models\Bandar;
use App\Models\ButiranPelajar;
use App\Models\Dokumen;
use App\Models\Dun;
use App\Models\EmelKemaskini;
use App\Models\Hubungan;
use App\Models\InfoIpt;
use App\Models\JenisOku;
use App\Models\JumlahPeruntukan;
use App\Models\Keturunan;
use App\Models\Kursus;
use App\Models\Mod;
use App\Models\Negeri;
use App\Models\Parlimen;
use App\Models\Penaja;
use App\Models\PeringkatPengajian;
use App\Models\Permohonan;
use App\Models\Smoku;
use App\Models\SumberBiaya;
use App\Models\Tuntutan;
use App\Models\User;
use App\Models\Waris;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KemaskiniController extends Controller
{
    public function senaraiJumlahPeruntukan()
    {
        $peruntukan = JumlahPeruntukan::orderBy('updated_at','desc')->get();
        return view('kemaskini.sekretariat.peruntukan.kemaskini_peruntukan', compact('peruntukan'));
    }

    public function kemaskiniJumlahPeruntukan(Request $request)
    {
        $request->validate([
            'tarikh_mula' => 'required|date',
            'tarikh_tamat' => 'required|date',
            'jumlahBKOKU' => 'required|numeric',
            'jumlahPPK' => 'required|numeric',
        ]);
    
        // Find the record or create a new one
        $peruntukan = JumlahPeruntukan::where('tarikh_mula', $request->tarikh_mula)
            ->where('tarikh_tamat', $request->tarikh_tamat)
            ->first();
    
        if ($peruntukan === null) {
            JumlahPeruntukan::create([
                'tarikh_mula' => $request->tarikh_mula,
                'tarikh_tamat' => $request->tarikh_tamat,
                'jumlahBKOKU' => $request->jumlahBKOKU,
                'jumlahPPK' => $request->jumlahPPK,
            ]);
        } else {
            $peruntukan->update([
                'tarikh_mula' => $request->tarikh_mula,
                'tarikh_tamat' => $request->tarikh_tamat,
                'jumlahBKOKU' => $request->jumlahBKOKU,
                'jumlahPPK' => $request->jumlahPPK,
            ]);
        }
    
        return redirect()->route('senarai.amaun.peruntukan');
    }

    public function senaraiEmel(){
        return view('kemaskini.sekretariat.emel.senarai_emel');
    }

    public function pKemaskiniDikembalikanBKOKU(){
        $emel = EmelKemaskini::where('id',1)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_dikembalikan',compact('emel'));
    }

    public function pKemaskiniLayakBKOKU(){
        $emel = EmelKemaskini::where('id',2)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_layak',compact('emel'));
    }

    public function pKemaskiniTidakLayakBKOKU(){
        $emel = EmelKemaskini::where('id',3)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.permohonan.kemaskini_tidak_layak',compact('emel'));
    }

    public function kemaskiniDikembalikanBKOKU(){
        $emel = EmelKemaskini::where('id',4)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_dikembalikan',compact('emel'));
    }

    public function kemaskiniLayakBKOKU(){
        $emel = EmelKemaskini::where('id',5)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_layak',compact('emel'));
    }

    public function kemaskiniTidakLayakBKOKU(){
        $emel = EmelKemaskini::where('id',6)->first();
        return view('kemaskini.sekretariat.emel.BKOKU.tuntutan.kemaskini_tidak_layak',compact('emel'));
    }

    public function pKemaskiniDikembalikanPPK(){
        $emel = EmelKemaskini::where('id',7)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_dikembalikan',compact('emel'));
    }

    public function pKemaskiniLayakPPK(){
        $emel = EmelKemaskini::where('id',8)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_layak',compact('emel'));
    }

    public function pKemaskiniTidakLayakPPK(){
        $emel = EmelKemaskini::where('id',9)->first();
        return view('kemaskini.sekretariat.emel.PPK.permohonan.kemaskini_tidak_layak',compact('emel'));
    }

    public function kemaskiniDikembalikanPPK(){
        $emel = EmelKemaskini::where('id',10)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_dikembalikan',compact('emel'));
    }

    public function kemaskiniLayakPPK(){
        $emel = EmelKemaskini::where('id',11)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_layak',compact('emel'));
    }

    public function kemaskiniTidakLayakPPK(){
        $emel = EmelKemaskini::where('id',12)->first();
        return view('kemaskini.sekretariat.emel.PPK.tuntutan.kemaskini_tidak_layak',compact('emel'));
    }
    
    public function kemaskiniEmel(Request $request, $id){
        $emel = EmelKemaskini::where('id',$id)->first();
        
        EmelKemaskini::where('id', $id)
            ->update([
                'subjek'            => $request->get('subjek'),
                'pendahuluan'       => $request->get('pendahuluan'),
                'isi_kandungan1'    => $request->get('isi_kandungan1'),
                'isi_kandungan2'    => $request->get('isi_kandungan2'),
                'penutup'           => $request->get('penutup'),
                'disediakan_oleh'   => $request->get('d_oleh'),
            ]);

        if($emel->id == 1){
            $emel = EmelKemaskini::where('id',1)->first();
            return back()->with('success', 'Emel permohonan BKOKU yang dikembalikan telah berjaya dikemaskini.');
        }
        if($emel->id == 2){
            $emel = EmelKemaskini::where('id',2)->first();
            return back()->with('success', 'Emel permohonan BKOKU yang layak telah berjaya dikemaskini.');
        }
        if($emel->id == 3){
            $emel = EmelKemaskini::where('id',3)->first();
            return back()->with('success', 'Emel permohonan BKOKU yang tidak layak telah berjaya dikemaskini.');
        }
        if($emel->id == 4){
            $emel = EmelKemaskini::where('id',4)->first();
            return back()->with('success', 'Emel tuntutan BKOKU yang dikemabalikan telah berjaya dikemaskini.');

        }
        if($emel->id == 5){
            $emel = EmelKemaskini::where('id',5)->first();
            return back()->with('success', 'Emel tuntutan BKOKU yang layak telah berjaya dikemaskini.');
        }
        if($emel->id == 6){
            $emel = EmelKemaskini::where('id',6)->first();
            return back()->with('success', 'Emel tuntutan BKOKU yang tidak layak telah berjaya dikemaskini.');
        }
        if($emel->id == 7){
            $emel = EmelKemaskini::where('id',7)->first();
            return back()->with('success', 'Emel permohonan PPK yang dikembalikan telah berjaya dikemaskini.');
        }
        if($emel->id == 8){
            $emel = EmelKemaskini::where('id',8)->first();
            return back()->with('success', 'Emel permohonan PPK yang layak telah berjaya dikemaskini.');
        }
        if($emel->id == 9){
            $emel = EmelKemaskini::where('id',9)->first();
            return back()->with('success', 'Emel permohonan PPK yang tidak layak telah berjaya dikemaskini.');
        }
        if($emel->id == 10){
            $emel = EmelKemaskini::where('id',10)->first();
            return back()->with('success', 'Emel tuntutan PPK yang dikembalikan telah berjaya dikemaskini.');
        }
        if($emel->id == 11){
            $emel = EmelKemaskini::where('id',11)->first();
            return back()->with('success', 'Emel tuntutan PPK yang layak telah berjaya dikemaskini.');
        }
        if($emel->id == 12){
            $emel = EmelKemaskini::where('id',12)->first();
            return back()->with('success', 'Emel tuntutan PPK yang tidak layak telah berjaya dikemaskini.');
        }     
    }

    public function paparEmel($id)
    {
        $emel = EmelKemaskini::where('id',$id)->first();
        return view('kemaskini.sekretariat.emel.papar_emel',compact('emel'));
    }

    public function maklumatPelajar()
    {
        return view('kemaskini.sekretariat.pelajar.semak_pelajar');
    }

    public function semakPelajar(Request $request)
    {
        $request->validate([
            'no_kp' => 'required|max:12'
        ]);

        $akaun_pelajar = User::where('no_kp', $request->no_kp)->first();

        return view('kemaskini.sekretariat.pelajar.semak_pelajar', compact('akaun_pelajar'));
    }

    public function updatePelajar(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'email' => 'required|email',
            'no_kp' => 'required',
            'email_verified_at' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->email_verified_at = $request->email_verified_at;
        $user->save();

        // Update Smoku if exists
        $smoku = Smoku::where('no_kp', $request->no_kp)->first();
        if ($smoku) {
            $smoku->nama = $request->nama;
            $smoku->email = $request->email;
            $smoku->save();

            // Update ButiranPelajar if exists
            $butiran = ButiranPelajar::where('smoku_id', $smoku->id)->first();
            if ($butiran) {
                $butiran->emel = $request->email;
                $butiran->save();
            }
        }

        return redirect()->route('kemaskini.sekretariat.pelajar.maklumat')->with('success', 'Maklumat pelajar berjaya dikemaskini.');
    }

    public function senaraiProfilDiriPelajar()
    {
        $institusiPengajian = InfoIpt::orderBy('nama_institusi')->get();
        
        return view('kemaskini.sekretariat.pelajar.senarai_pelajar_institusi', compact('institusiPengajian'));


    }

    public function getSenaraiPelajar()
    {
        
        $pelajar = Smoku::whereHas('akademik', function ($query) {
                $query->where('status', 1);
            })
            ->whereHas('permohonan')
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with('infoipt');
                 },
            'permohonan'])
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                // Ambil hanya satu rekod akademik yang status=1
                $akademik = $item->akademik->first();
                return [
                    'id' => $item->id,
                    'smoku_id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'no_daftar_oku' => $item->no_daftar_oku,
                    'nama_kursus' => $akademik->nama_kursus ?? '-',
                    'nama_institusi' => $akademik->infoipt->nama_institusi ?? '-',
                    'tarikh_mula' => $akademik->tarikh_mula ?? '',
                    'tarikh_tamat' => $akademik->tarikh_tamat ?? '',
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now())
                ];
            });

        return response()->json($pelajar);



    }

    public function kemaskiniProfilDiriPelajar($smoku_id)
    {   
        $smoku = Smoku::leftJoin('bk_jenis_oku','bk_jenis_oku.kod_oku','=','smoku.kategori')
            ->leftJoin('bk_jantina','bk_jantina.kod_jantina','=','smoku.jantina')
            ->leftJoin('bk_keturunan', 'bk_keturunan.kod_keturunan', '=', 'smoku.keturunan')
            ->where('smoku.id', $smoku_id)
            ->get(['smoku.*','smoku.id as smoku_id','bk_jenis_oku.*','bk_jantina.*','bk_keturunan.*'])
            ->first();
        $butiranPelajar = ButiranPelajar::where('smoku_id', $smoku->smoku_id)->first();
        
        $negeri = Negeri::all()->sortBy('id');
        $bandar = Bandar::all()->sortBy('id');
        $keturunan = Keturunan::all()->sortBy('id');
        $agama = Agama::all()->sortBy('id');
        $parlimen = Parlimen::all()->sortBy('id');
        $dun = Dun::all()->sortBy('id');
        $oku = JenisOku::all()->sortBy('id');

        $waris = Waris::where('smoku_id', $smoku->smoku_id)->first();
        $hubungan = Hubungan::all()->sortBy('kod_hubungan');

        $akademik = Akademik::where('smoku_id', $smoku->smoku_id)->where('status', 1)->first();
        
        $institusi = InfoIpt::orderby("nama_institusi","asc")->select('id_institusi','nama_institusi')->get();
        // dd($institusi);

        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kod_mod');
        $biaya = SumberBiaya::all()->sortBy('id');
        $penaja = Penaja::orderby("penaja","asc")->get();
        $penajaArray = $penaja->toArray();

        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->smoku_id)->first();
        $dokumen = Dokumen::where('permohonan_id', $permohonan->id)->get();

        return view('kemaskini.sekretariat.pelajar.profil_pelajar_institusi',compact('smoku','butiranPelajar','negeri','keturunan','agama','bandar','parlimen','dun','oku','waris','hubungan','akademik','institusi','peringkat','kursus','mod','biaya','penaja','penajaArray','dokumen'));
    }

    public function peringkatProfilPelajar($ipt=0)
    {

        $peringkatData['data'] = Kursus::select('bk_kursus.kod_peringkat','bk_peringkat_pengajian.peringkat')
            ->join('bk_peringkat_pengajian', function ($join) {
                $join->on('bk_kursus.kod_peringkat', '=', 'bk_peringkat_pengajian.kod_peringkat');
            })
            ->where('id_institusi',$ipt)
            ->groupBy('bk_kursus.kod_peringkat','bk_peringkat_pengajian.peringkat')
            ->get();

        return response()->json($peringkatData);

    }

    public function kursusProfilPelajar($kodperingkat=0,$ipt=0)
    {

        $kursusData['data'] = Kursus::orderby("nama_kursus","asc")
            // ->select('id_institusi','kod_peringkat','nama_kursus')
            ->where('kod_peringkat',$kodperingkat)
            ->where('id_institusi',$ipt)
            ->get();

        return response()->json($kursusData);

    }

    public function simpanProfilDiriPelajar(Request $request, $smoku_id)
    {  
    
        $smoku = Smoku::where('id', $smoku_id)->first();
        $butiran_pelajar = ButiranPelajar::where('smoku_id',$smoku->id)->first();
        $waris = Waris::where('smoku_id',$smoku->id)->first();
        $akademik = Akademik::where('smoku_id',$smoku->id)->where('status', 1)->first();

        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

        $dokumen1 = Dokumen::where('permohonan_id', $permohonan->id)->where('id_dokumen', 1)->first();
        $dokumen2 = Dokumen::where('permohonan_id', $permohonan->id)->where('id_dokumen', 2)->first();

        // Get the current values
        $currentValues = [
            'nama' => $smoku->nama,
            'no_kp' => $smoku->no_kp,
            'tarikh_lahir' => $smoku->tarikh_lahir,
            'umur' => $smoku->umur,
            'keturunan' => $smoku->keturunan,
            'email' => $smoku->email ?? '',
            'no_akaun_bank' => $butiran_pelajar->no_akaun_bank,
            'negeri_lahir' => $butiran_pelajar->negeri_lahir,
            'agama' => $butiran_pelajar->agama,
            'alamat_tetap' => $butiran_pelajar->alamat_tetap,
            'alamat_tetap_negeri' => $butiran_pelajar->alamat_tetap_negeri,
            'alamat_tetap_bandar' => $butiran_pelajar->alamat_tetap_bandar,
            'alamat_tetap_poskod' => $butiran_pelajar->alamat_tetap_poskod,
            'parlimen' => $butiran_pelajar->parlimen,
            'dun' => $butiran_pelajar->dun,
            'alamat_surat_menyurat' => $butiran_pelajar->alamat_surat_menyurat,
            'alamat_surat_negeri' => $butiran_pelajar->alamat_surat_negeri,
            'alamat_surat_bandar' => $butiran_pelajar->alamat_surat_bandar,
            'alamat_surat_poskod' => $butiran_pelajar->alamat_surat_poskod,
            'tel_bimbit' => $butiran_pelajar->tel_bimbit,
            'tel_rumah' => $butiran_pelajar->tel_rumah,
            'status_pekerjaan' => $butiran_pelajar->status_pekerjaan,
            'pekerjaan' => $butiran_pelajar->pekerjaan,
            'pendapatan' => $butiran_pelajar->pendapatan,
            'no_daftar_oku' => $smoku->no_daftar_oku,
            'kategori' => $smoku->kategori,
            'nama_waris' => $waris->nama_waris,
            'no_kp_waris' => $waris->no_kp_waris,
            'no_pasport_waris' => $waris->no_pasport_waris,
            'tel_bimbit_waris' => $waris->tel_bimbit_waris,
            'hubungan_lain_waris' => $waris->hubungan_lain_waris,
            'alamat_waris' => $waris->alamat_waris,
            'alamat_negeri_waris' => $waris->alamat_negeri_waris,
            'alamat_bandar_waris' => $waris->alamat_bandar_waris,
            'alamat_poskod_waris' => $waris->alamat_poskod_waris,
            'pekerjaan_waris' => $waris->pekerjaan_waris,
            'pendapatan_waris' => $waris->pendapatan_waris,
            'id_institusi' => $akademik->id_institusi,
            'no_pendaftaran_pelajar' => $akademik->no_pendaftaran_pelajar,
            'peringkat_pengajian' => $akademik->peringkat_pengajian,
            'nama_kursus' => $akademik->nama_kursus,
            'tempoh_pengajian' => $akademik->tempoh_pengajian,
            'bil_bulan_per_sem' => $akademik->bil_bulan_per_sem,
            'sesi' => $akademik->sesi,
            'mod' => $akademik->mod,
            'tarikh_mula' => $akademik->tarikh_mula,
            'tarikh_tamat' => $akademik->tarikh_tamat,
            'sumber_biaya' => $akademik->sumber_biaya,
            'sumber_lain' => $akademik->sumber_lain,
            'nama_penaja' => $akademik->nama_penaja,
            'penaja_lain' => $akademik->penaja_lain,
            'dokumen' => $dokumen1->dokumen ?? '',
            'catatan' => $dokumen1->catatan ?? '',
            'dokumen' => $dokumen2->dokumen ?? '',
            'catatan' => $dokumen2->catatan ?? ''
        ];
        

        // Update the values
        $smoku->update([
            'nama' => strtoupper($request->nama_pelajar),
            'email' => $request->emel ?? '',
            'no_daftar_oku' => $request->no_daftar_oku,
            'kategori' => $request->oku,
        ]);



        $user_ada = User::where('no_kp', $request->no_kp)->get();

        //Semak table user dah ada ic betul ke tak. kalau ada delete dulu
        if ($user_ada->isNotEmpty()) {
            // Delete all matching entries
            User::where('no_kp', $request->no_kp)->delete();

        }
        User::where('no_kp',$smoku->no_kp)
        ->update([
            'nama' => strtoupper($request->nama_pelajar),
            'no_kp' => $request->no_kp,
            'email' => $request->emel ?? ''
        ]);

        if($butiran_pelajar != null) {
            ButiranPelajar::where('smoku_id' ,$smoku->id)
                ->update([
                    'emel' => $request->emel ?? '',
                    'no_akaun_bank' => $request->no_akaun_bank,
                    'negeri_lahir' => $request->negeri_lahir,
                    'agama' => $request->agama,
                    'alamat_tetap' => strtoupper($request->alamat_tetap),
                    'alamat_tetap_negeri' => $request->alamat_tetap_negeri,
                    'alamat_tetap_bandar' => $request->alamat_tetap_bandar,
                    'alamat_tetap_poskod' => $request->alamat_tetap_poskod,
                    'parlimen' => $request->parlimen,
                    'dun' => $request->dun,
                    'alamat_surat_menyurat' => strtoupper($request->alamat_surat_menyurat),
                    'alamat_surat_negeri' => $request->alamat_surat_negeri,
                    'alamat_surat_bandar' => $request->alamat_surat_bandar,
                    'alamat_surat_poskod' => $request->alamat_surat_poskod,
                    'tel_bimbit' => str_replace('-', '', $request->tel_bimbit),
                    'tel_rumah' => str_replace('-', '', $request->tel_rumah),
                    'status_pekerjaan' => $request->status_pekerjaan,
                    'pekerjaan' => strtoupper($request->pekerjaan),
                    'pendapatan' => $request->pendapatan
    
                ]);
        }

        if($waris != null) {
            Waris::where('smoku_id' ,$smoku->id)
                ->update([
                    'nama_waris' => strtoupper($request->nama_waris),
                    'no_kp_waris' => $request->no_kp_waris,
                    'no_pasport_waris' => $request->no_pasport_waris,
                    'tel_bimbit_waris' => str_replace('-', '', $request->tel_bimbit_waris),
                    'hubungan_waris' => $request->hubungan_waris,
                    'hubungan_lain_waris' => $request->hubungan_lain_waris,
                    'alamat_waris' => strtoupper($request->alamat_waris),
                    'alamat_negeri_waris' => $request->alamat_negeri_waris,
                    'alamat_bandar_waris' => $request->alamat_bandar_waris,
                    'alamat_poskod_waris' => $request->alamat_poskod_waris,
                    'pekerjaan_waris' => strtoupper($request->pekerjaan_waris),
                    'pendapatan_waris' => $request->pendapatan_waris
    
                ]);
        }

        if($akademik != null) {
            Akademik::where('smoku_id' ,$smoku->id)->where('status', 1)
                ->update([
                    'id_institusi' => $request->id_institusi,
                    'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
                    // 'peringkat_pengajian' => $request->peringkat_pengajian,
                    // 'nama_kursus' => $request->nama_kursus,
                    'tempoh_pengajian' => $request->tempoh_pengajian,
                    'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
                    'sesi' => $request->sesi,
                    'mod' => $request->mod,
                    'tarikh_mula' => $request->tarikh_mula,
                    'tarikh_tamat' => $request->tarikh_tamat,
                    'sumber_biaya' => $request->sumber_biaya,
                    'sumber_lain' => $request->sumber_lain,
                    'nama_penaja' => $request->nama_penaja,
                    'penaja_lain' => $request->penaja_lain,
                ]);
        }

        

        $runningNumber = rand(1000, 9999);
        $uploadPath = 'assets/dokumen/permohonan';

        $documentTypes = [
            'akaunBank' => 1,
            'suratTawaran' => 2,
            'invoisResit' => 3,
        ];

        foreach ($documentTypes as $inputName => $idDokumen) {
            $file = $request->file("upload_$inputName");
            // dd($file);

            // Define note field name dynamically
            $noteField = "nota_$inputName";
            $noteContent = $request->input($noteField);

            // Check if the document already exists
            $existingDocument = Dokumen::where('permohonan_id', $permohonan->id)
                ->where('id_dokumen', $idDokumen)
                ->first();

            if ($file) {
                // Generate new filename
                $originalFilename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $filenameWithoutExtension = pathinfo($originalFilename, PATHINFO_FILENAME);
                $newFilename = $filenameWithoutExtension . '_' . $runningNumber . '.' . $extension;
                // dd($newFilename);
                // Move the file to the designated path
                $file->move($uploadPath, $newFilename);

                if ($existingDocument) {
                    // Optionally delete the old file
                    if (file_exists("$uploadPath/{$existingDocument->dokumen}")) {
                        unlink("$uploadPath/{$existingDocument->dokumen}");
                    }

                    // Update the existing document record
                    $existingDocument->dokumen = $newFilename;
                    $existingDocument->catatan = $noteContent;
                    $existingDocument->save();
                } else {
                    // Create a new document record
                    $data = new Dokumen();
                    $data->permohonan_id = $permohonan->id;
                    $data->id_dokumen = $idDokumen;
                    $data->dokumen = $newFilename;
                    $data->catatan = $noteContent;
                    $data->save();
                }
            } 
            // else if ($existingDocument) {
                
            //     // Update the existing document record
            //     $existingDocument->catatan = $noteContent;
            //     $existingDocument->save();
                
            // }
        }


        // Check if any updates were made
        $updatedValues = [
            'nama' => $request->nama_pelajar,
            'no_kp' => $request->no_kp,
            'tarikh_lahir' => $request->tarikh_lahir,
            'umur' => intval($request->umur),
            'keturunan' => $request->keturunan,
            'email' => $request->emel,
            'no_akaun_bank' => $request->no_akaun_bank,
            'negeri_lahir' => $request->negeri_lahir,
            'agama' => $request->agama,
            'alamat_tetap' => $request->alamat_tetap,
            'alamat_tetap_negeri' => $request->alamat_tetap_negeri,
            'alamat_tetap_bandar' => $request->alamat_tetap_bandar,
            'alamat_tetap_poskod' => $request->alamat_tetap_poskod,
            'parlimen' => $request->parlimen,
            'dun' => $request->dun,
            'alamat_surat_menyurat' => $request->alamat_surat_menyurat,
            'alamat_surat_negeri' => $request->alamat_surat_negeri,
            'alamat_surat_bandar' => $request->alamat_surat_bandar,
            'alamat_surat_poskod' => $request->alamat_surat_poskod,
            'tel_bimbit' => $request->tel_bimbit,
            'tel_rumah' => $request->tel_rumah ?? "",
            'status_pekerjaan' => $request->status_pekerjaan,
            'pekerjaan' => $request->pekerjaan ?? "",
            'pendapatan' => $request->pendapatan,
            'no_daftar_oku' => $request->no_daftar_oku,
            'kategori' => $request->oku,
            'nama_waris' => $request->nama_waris,
            'no_kp_waris' => $request->no_kp_waris,
            'no_pasport_waris' => $request->no_pasport_waris,
            'tel_bimbit_waris' => $request->tel_bimbit_waris,
            'hubungan_lain_waris' => $request->hubungan_lain_waris,
            'alamat_waris' => $request->alamat_waris,
            'alamat_negeri_waris' => $request->alamat_negeri_waris,
            'alamat_bandar_waris' => $request->alamat_bandar_waris,
            'alamat_poskod_waris' => $request->alamat_poskod_waris,
            'pekerjaan_waris' => $request->pekerjaan_waris,
            'pendapatan_waris' => $request->pendapatan_waris,
            'id_institusi' => $request->id_institusi,
            'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
            'peringkat_pengajian' => $request->peringkat_pengajian,
            'nama_kursus' => $request->nama_kursus,
            'tempoh_pengajian' => $request->tempoh_pengajian,
            'bil_bulan_per_sem' => $request->bil_bulan_per_sem,
            'sesi' => $request->sesi,
            'mod' => $request->mod,
            'tarikh_mula' => $request->tarikh_mula,
            'tarikh_tamat' => $request->tarikh_tamat,
            'sumber_biaya' => $request->sumber_biaya,
            'sumber_lain' => $request->sumber_lain,
            'nama_penaja' => $request->nama_penaja,
            'penaja_lain' => $request->penaja_lain,
            'dokumen' => $dokumen1->dokumen ?? '',
            'catatan' => $request->input("nota_akaunBank"),
            'dokumen' => $dokumen2->dokumen ?? '',
            'catatan' => $request->input("nota_suratTawaran")
        ];

        
        if ($currentValues != $updatedValues) {   
            
            $permohonans = Permohonan::where('smoku_id', $smoku->id)->get();

            // Update no_kp in smoku first
            if ($request->no_kp != $smoku->no_kp) {
                //semak dalam smoku no_kp
                $smoku_ada = Smoku::where('no_kp', $request->no_kp)->get();
                
                if ($smoku_ada->isNotEmpty()) {
                    // Delete all matching entries
                    Smoku::where('no_kp', $request->no_kp)->delete();

                }
                Smoku::where('id', $smoku->id)
                    ->update(['no_kp' => $request->no_kp]);
            }

            // Update akademik
            if ($request->peringkat_pengajian != $akademik->peringkat_pengajian) {
                if ($permohonans->firstWhere('status', '<', 6)) {
                    Akademik::where('smoku_id', $smoku->id)
                        ->where('status', 1)
                        ->update([
                            'peringkat_pengajian' => $request->peringkat_pengajian,
                            'nama_kursus' => $request->nama_kursus,
                        ]);
                } else {
                    return back()->with('failed', 'Maklumat peringkat pengajian tidak boleh dikemaskini.');
                }
            } else {
                // peringkat unchanged, only update course name
                Akademik::where('smoku_id', $smoku->id)
                    ->where('status', 1)
                    ->update([
                        'nama_kursus' => $request->nama_kursus,
                    ]);
            }

            // Loop through permohonan to update only the matching one
            foreach ($permohonans as $permohonan) {
                $parts = explode('/', $permohonan->no_rujukan_permohonan);

                if (count($parts) === 3) {
                    $updateRujukan = false;

                    // If old peringkat matches akademik before update
                    if ($parts[1] == $akademik->peringkat_pengajian) {

                        // Update peringkat part in rujukan if it changed
                        if ($request->peringkat_pengajian != $akademik->peringkat_pengajian) {
                            $parts[1] = $request->peringkat_pengajian;
                            $updateRujukan = true;
                        }

                    }

                    // Update no_kp part in rujukan if it changed
                    if ($request->no_kp != $smoku->no_kp) {
                        $parts[2] = $request->no_kp;
                        $updateRujukan = true;
                    }

                    if ($updateRujukan) {
                        $new_no_rujukan = implode('/', $parts);
                        $permohonan->update([
                            'no_rujukan_permohonan' => $new_no_rujukan,
                        ]);
                    }
                }
            }

            $tuntutans = Tuntutan::where('smoku_id', $smoku->id)->get();

            foreach ($tuntutans as $tuntutan) {
                $parts = explode('/', $tuntutan->no_rujukan_tuntutan);

                if (count($parts) === 4) { // Ensure it's in format B/peringkat/no_kp/n
                    $updateRujukan = false;

                    // Match only tuntutan with peringkat same as request
                    if ($parts[1] == $request->peringkat_pengajian) {

                        // Update peringkat_pengajian
                        if ($request->peringkat_pengajian != $akademik->peringkat_pengajian) {
                            if ($permohonan && $permohonan->status < 6) {
                                $parts[1] = $request->peringkat_pengajian;
                                $updateRujukan = true;
                            } else {
                                return back()->with('failed', 'Maklumat peringkat pengajian tidak boleh dikemaskini.');
                            }
                        }
                    
                    }

                    // Update no_kp
                    if ($request->no_kp != $smoku->no_kp) {
                        $parts[2] = $request->no_kp;
                        $updateRujukan = true;
                    }

                    // Apply update if needed
                    if ($updateRujukan) {
                        $new_no_rujukan_tuntutan = implode('/', $parts);
                        $tuntutan->update([
                            'no_rujukan_tuntutan' => $new_no_rujukan_tuntutan,
                        ]);
                    }
                }
            }


            //update mod or sumber biaya = layak yuran or wang saku sahaja
            if ($request->sumber_biaya != $akademik->sumber_biaya || $request->mod != $akademik->mod) {
                if ($permohonan) {
                    $mod = $request->mod;
                    // dd($mod);
                    $sumber = $request->sumber_biaya;
                    //  dd($sumber);

                    $yuran = null;
                    $wang_saku = null;

                    $mod1 = 1;
                    $mod2 = 2;
                    $mod34 = [3, 4];
                    $sumber_layak = [3, 4, 5];
                    $sumber_tidak = [1, 2];

                    

                    if ($mod == $mod1 && in_array($sumber, $sumber_layak)) {
                        // dd('sini');
                        $yuran = 1;
                        $wang_saku = 1;
                    } elseif ($mod == $mod1 && in_array($sumber, $sumber_tidak)) {
                        // dd('sini ke');
                        $yuran = null;
                        $wang_saku = 1;
                    } elseif ($mod == $mod2 && in_array($sumber, $sumber_layak)) {
                        // dd('ke sini');
                        $yuran = 1;
                        $wang_saku = null;
                    } elseif ($mod == $mod2 && in_array($sumber, $sumber_tidak)) {
                        // dd('atau sini');
                        $yuran = null;
                        $wang_saku = null;
                    } elseif (in_array($mod, $mod34) && in_array($sumber, $sumber_layak)) {
                        // dd('sini eh');
                        $yuran = 1;
                        $wang_saku = null;
                    }

                    // dd($yuran);
                    // dd($wang_saku);
                    Permohonan::where('smoku_id', $smoku->id)
                        ->update([
                            'yuran' => $yuran,
                            'wang_saku' => $wang_saku,
                        ]);
                }
            }


            return redirect()->route('kemaskini.sekretariat.senarai.profil')->with('success', 'Maklumat profil berjaya dikemaskini.');

            
        }

        // No updates were made
        return redirect()->route('kemaskini.sekretariat.senarai.profil');
    }

    public function senaraiPelajar()
    {
        $infoipt = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->first();

        if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk == $infoipt ->id_institusi) {
            $infoiptCollection = InfoIpt::where('id_induk', Auth::user()->id_institusi)->get();
        }
        // else if ($infoipt && $infoipt->id_induk != null && $infoipt ->id_induk != $infoipt ->id_institusi) {
        //     $infoiptCollection = InfoIpt::where('id_institusi', Auth::user()->id_institusi)->get();
        // } 
        else {
            $infoiptCollection = collect([$infoipt]); // Wrap single object in a collection for consistency
        }
        
        // Extract all `id_institusi` values (handles both single and multiple records)
        $idInstitusiList = $infoiptCollection->pluck('id_institusi');

        $pelajar = Smoku::join('smoku_akademik','smoku_akademik.smoku_id','=','smoku.id')
        ->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')
        // ->join('smoku_penyelaras','smoku_penyelaras.smoku_id','=','smoku.id')
        ->join('users','users.no_kp','=','smoku.no_kp')
        ->leftJoin('tukar_institusi', 'tukar_institusi.smoku_id', '=', 'smoku.id')
        ->where(function ($query) use ($idInstitusiList) {
            $query->whereIn('smoku_akademik.id_institusi', $idInstitusiList)
                  ->orWhere(function ($subQuery) use ($idInstitusiList) {
                      $subQuery->whereIn('tukar_institusi.id_institusi_baru', $idInstitusiList)
                               ->where('tukar_institusi.status', '=', 1);
                  });
        })
        ->orderBy('smoku.id', 'DESC')
        ->get(['smoku.*','tukar_institusi.*','smoku.id as smoku_id','smoku_akademik.*', 'bk_info_institusi.id_institusi', 'bk_info_institusi.nama_institusi', 'bk_info_institusi.jenis_institusi','users.created_at as tarikh_daftar']);

        $infoipt = InfoIpt::where('jenis_institusi', 'UA')->orderBy('nama_institusi')->get();
        $infoiptIPTS = InfoIpt::where('jenis_institusi', 'IPTS')->orderBy('nama_institusi')->get();
        $infoiptP = InfoIpt::where('jenis_institusi', 'P')->orderBy('nama_institusi')->get();
        $infoiptKK = InfoIpt::where('jenis_institusi', 'KK')->orderBy('nama_institusi')->get();

        return view('kemaskini.penyelaras.senarai_pelajar', compact('pelajar','infoipt','infoiptIPTS','infoiptP','infoiptKK'));
    }


}
