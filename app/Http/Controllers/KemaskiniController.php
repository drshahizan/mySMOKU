<?php

namespace App\Http\Controllers;

use App\Mail\MailDaftarPentadbir;
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
use App\Models\KelasPenganugerahan;
use App\Models\Kelulusan;
use App\Models\Keturunan;
use App\Models\Kursus;
use App\Models\Mod;
use App\Models\Negeri;
use App\Models\Parlimen;
use App\Models\Penaja;
use App\Models\PeringkatPengajian;
use App\Models\Permohonan;
use App\Models\SejarahPermohonan;
use App\Models\Smoku;
use App\Models\SumberBiaya;
use App\Models\TamatPengajian;
use App\Models\Tuntutan;
use App\Models\User;
use App\Models\Waris;
use Carbon\Carbon;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
                // Check tamat pengajian
                $permohonanId = optional($item->permohonan->first())->id;

                $tamat_pengajian = TamatPengajian::where('smoku_id', $item->id)
                    ->where('permohonan_id', $permohonanId)
                    ->exists();
                
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
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now()),
                    'tamat_pengajian' => $tamat_pengajian
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
        
        $institusi = InfoIpt::whereIn('jenis_institusi', ['UA','IPTS','KK','P'])->orderby("nama_institusi","asc")->select('id_institusi','nama_institusi')->get();
        // dd($institusi);

        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kod_mod');
        $biaya = SumberBiaya::all()->sortBy('id');
        $penaja = Penaja::orderby("penaja","asc")->get();
        $penajaArray = $penaja->toArray();

        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->smoku_id)->first();
        $dokumen = Dokumen::where('permohonan_id', $permohonan?->id ?? 0)->get();
        
        return view('kemaskini.sekretariat.pelajar.profil_pelajar_institusi',compact('smoku','butiranPelajar','negeri','keturunan','agama','bandar','parlimen','dun','oku','waris','hubungan','akademik','institusi','peringkat','kursus','mod','biaya','penaja','penajaArray','dokumen'));
    }

    public function peringkatProfilPelajar($id=0)
    {

        $peringkatData['data'] = Kursus::select('bk_kursus.kod_peringkat','bk_peringkat_pengajian.peringkat')
            ->join('bk_peringkat_pengajian', function ($join) {
                $join->on('bk_kursus.kod_peringkat', '=', 'bk_peringkat_pengajian.kod_peringkat');
            })
            ->where('id_institusi',$id)
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
            'upload_akaunBank' => $dokumen1->dokumen ?? '',
            'nota_akaunBank' => $dokumen1->catatan ?? '',
            'upload_suratTawaran' => $dokumen2->dokumen ?? '',
            'nota_suratTawaran' => $dokumen2->catatan ?? ''
        ];
        

        // Update the values
        $smoku->update([
            'nama' => strtoupper($request->nama_pelajar),
            'email' => $request->emel ?? '',
            'no_daftar_oku' => $request->no_daftar_oku,
            'kategori' => $request->oku,
        ]);

        //Semak table user dah ada ic betul ke tak. kalau ada delete dulu
        if ($request->no_kp != $smoku->no_kp) {
            // Check if the new no_kp already exists in the users table
            $user_ada = User::where('no_kp', $request->no_kp)->get();

            if ($user_ada->isNotEmpty()) {
                // Delete all users with the new no_kp to prevent conflict
                User::where('no_kp', $request->no_kp)->delete();
            }

            // Now update the user with the old no_kp to the new one
            User::where('no_kp', $smoku->no_kp)
                ->update([
                    'nama' => strtoupper($request->nama_pelajar),
                    'no_kp' => $request->no_kp,
                    'email' => $request->emel ?? ''
                ]);
        } else {
            // no_kp not changed, just update name/email
            User::where('no_kp', $smoku->no_kp)
                ->update([
                    'nama' => strtoupper($request->nama_pelajar),
                    'email' => $request->emel ?? ''
                ]);
        }

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

        $docRules = 'nullable|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png';
        $request->validate([
            'upload_akaunBank' => $docRules,
            'upload_suratTawaran' => $docRules,
            'upload_invoisResit' => $docRules,
        ]);

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
                $extension = strtolower($file->getClientOriginalExtension());
                $newFilename = Str::uuid()->toString() . '.' . $extension;
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

    public function senaraiSuratTawaran()
    {
        $institusiPengajian = InfoIpt::orderBy('nama_institusi')->get();
        
        return view('kemaskini.sekretariat.pelajar.senarai_surat_tawaran', compact('institusiPengajian'));


    }

    public function getSenaraiLayak()
    {
        
        $pelajar = Smoku::whereHas('akademik', function ($query) {
                $query->where('status', 1);
            })
            ->whereHas('permohonan', function ($query) {
                $query->whereIn('status', [6, 8]);
            })
            ->with(['akademik' => function ($query) {
                $query->where('status', 1)->with(['infoipt', 'peringkat']);
                 },
            'permohonan'])
            ->orderBy('nama')
            ->get()
            ->map(function ($item) {
                // Ambil hanya satu rekod akademik yang status=1
                $akademik = $item->akademik->first();
                // Ambil hanya satu rekod permohonan latest
                $permohonan = $item->permohonan->whereIn('status', [6, 8])->first();
                return [
                    'id' => $item->id,
                    'smoku_id' => $item->id,
                    'nama' => $item->nama,
                    'no_kp' => $item->no_kp,
                    'peringkat_pengajian' => ucfirst(strtolower($akademik->peringkat->peringkat)) ?? '-',
                    'nama_kursus' => $akademik->nama_kursus ?? '-',
                    'nama_institusi' => $akademik->infoipt->nama_institusi ?? '-',
                    'tarikh_mula' => $akademik->tarikh_mula ?? '',
                    'tarikh_tamat' => $akademik->tarikh_tamat ?? '',
                    'permohonan_id' => $permohonan->id ?? '',
                    'program' => $permohonan->program ?? '',
                    'status_aktif' => $akademik->tarikh_tamat && Carbon::parse($akademik->tarikh_tamat)->gte(now())
                ];
            });

        return response()->json($pelajar);



    }

    public function tambahPelajar()
    {
        $smoku = Smoku::join('smoku_daftar', 'smoku_daftar.smoku_id', '=', 'smoku.id')
            // ->where('pendaftar_id', '=', Auth::user()->id)
            ->where('status', '=', 0)
            ->get();

        return view('kemaskini.sekretariat.pelajar.pendaftaran_pelajar', compact('smoku'));
    }

    public function semakSMOKU(Request $request)
    {
        //using api smoku
        $request->validate([
            'no_kp' => ['required', 'string'],
            
        ]);
        $nokp_in = $request->no_kp;

        $headers = [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer knhnxYoATGLiN5WxErU6SVVw8c9xhw09vQ3KRPkOtcH3O0CYh21wDA4CsypX',
        ];
        $client = new Client();
        $url = 'https://oku.jkm.gov.my/api/oku/' . $request->no_kp;
        // $url = 'https://oku-staging.jkm.gov.my/api/oku/' . $request->no_kp;
        $guzzleRequest = $client->get($url, ['headers' => $headers]);

        $response = $guzzleRequest ? $guzzleRequest->getBody()->getContents() : null;
        $status = $guzzleRequest ? $guzzleRequest->getStatusCode() : 500;

        // Parse the JSON string
        $data = json_decode($response, true);
        
        // Access the "data" field
        $dataField = [];
        if (isset($data['data'])) {
            $dataField = $data['data'];
            
            // Now, $dataField contains the "data" array
            $no_kp = $dataField['NO_ID'];
           
            $jantina = isset($dataField['JANTINA']) ? substr($dataField['JANTINA'], 0, 1) : null;
            $tarikh_lahir = $dataField['TARIKH_LAHIR'];
            $tarikhLahirDate = DateTime::createFromFormat('d/m/Y', $tarikh_lahir);
            $formattedDate = $tarikhLahirDate->format('Y-m-d');

            $kategori = $dataField['KATEGORI'];
            $jenis_oku = JenisOku::where('kecacatan',$kategori)->first();
            // dd($dataField['NO_DAFTAR_OKU']);
            if ($jenis_oku !== null) {
                $kod_oku = $jenis_oku->kod_oku;
            } else {
                $kod_oku = isset($dataField['NO_DAFTAR_OKU']) && !empty($dataField['NO_DAFTAR_OKU'])
                   ? substr($dataField['NO_DAFTAR_OKU'], 0, 2)
                   : null;
            }

            $keturunan = $dataField['KETURUNAN'];
            $kod = Keturunan::where('keturunan',$keturunan)->first();
            if ($kod !== null) {
                $kod_keturunan = $kod->kod_keturunan;
            } else {
                $kod_keturunan = null;
            }

            $hubungan = $dataField['HUBUNGAN_WARIS'];
            $kod = Hubungan::where('hubungan',$hubungan)->first();
            if ($kod !== null) {
                $kod_hubungan = $kod->kod_hubungan;
            } else {
                $kod_hubungan = null;
            }

            Smoku::updateOrInsert(
                ['no_kp' => $dataField['NO_ID']], // Condition to find the record
                [
                    'no_id_tentera' => $dataField['NO_ID_TENTERA'],
                    'nama' => $dataField['NAMA_PENUH'],
                    'no_daftar_oku' => $dataField['NO_DAFTAR_OKU'],
                    'kategori' => $kod_oku,
                    'jantina' => $jantina,
                    'tarikh_lahir' => $formattedDate,
                    'umur' => $dataField['UMUR'],
                    'keturunan' => $kod_keturunan,
                    'tel_rumah' => $dataField['TEL_RUMAH'],
                    'tel_bimbit' => $dataField['TEL_BIMBIT'],
                    'email' => $dataField['EMEL'],
                    'pekerjaan' => $dataField['PEKERJAAN'],
                    'pendapatan' => $dataField['PENDAPATAN'],
                    'status_pekerjaan' => $dataField['STATUS_PEKERJAAN'],
                    'alamat_tetap' => $dataField['ALAMAT_TETAP'],
                    'alamat_surat_menyurat' => $dataField['ALAMAT_SURAT_MENYURAT'],
                    'nama_waris' => $dataField['NAMA_WARIS'],
                    'tel_bimbit_waris' => $dataField['TEL_BIMBIT_WARIS'],
                    'hubungan_waris' => $kod_hubungan,
                    'pekerjaan_waris' => $dataField['PEKERJAAN_WARIS'],
                    // 'pendapatan_waris' => $dataField['PENDAPATAN_WARIS'],
                    'created_at' => DB::raw('NOW()'),
                    'updated_at' => DB::raw('NOW()')
                ]
            );

            $smoku=Smoku::where([['no_kp', '=', $no_kp]])->first();
            $permohonan=Permohonan::where([['smoku_id', '=', $smoku->id]])->first();
            if(!$permohonan){
                $alreadyRegistered = DB::table('smoku_daftar')
                    ->where('smoku_id', $smoku->id)
                    ->exists();

                $alreadyByUser = DB::table('smoku_daftar')
                    ->where('smoku_id', $smoku->id)
                    ->where('pendaftar_id', Auth::id())
                    ->exists();

                if ($alreadyRegistered && $alreadyByUser) {
                    return redirect()->route('kemaskini.sekretariat.daftar.pelajar')
                        ->with($no_kp)
                        ->with('warning', $no_kp . ' Maklumat pelajar telah didaftarkan.');
                }else if ($alreadyRegistered && !$alreadyByUser) {
                    return redirect()->route('kemaskini.sekretariat.daftar.pelajar')
                        ->with($no_kp)
                        ->with('warning', $no_kp . ' Maklumat pelajar telah didaftarkan oleh sekretariat lain.');
                }

                DB::table('smoku_daftar')->insert([
                    'smoku_id' => $smoku->id,
                    'pendaftar_id' => Auth::id(),
                    'status' => '0',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                return redirect()->route('kemaskini.sekretariat.daftar.pelajar')
                    ->with('failed_url', route('kemaskini.sekretariat.senarai.profil'))
                    ->with('failed_msg', $no_kp . ' Maklumat pelajar telah wujud dalam SisPO.');
            }

            $smoku = Smoku::where('no_kp', $no_kp)->first();
            $id =  $smoku->id;
            $no_kp =  $smoku->no_kp;
            $smoku_id = $request->session()->put('id',$id);
            $no_kp = $request->session()->put('no_kp',$no_kp);
            
            return redirect()->route('kemaskini.sekretariat.daftar.pelajar')->with($smoku_id,$no_kp)
            ->with('success', $no_kp. ' Sah sebagai OKU berdaftar dengan JKM.');
        } 
        else 
        {
            return redirect()->route('penyelaras.dashboard')
            ->with('failed', $nokp_in. ' Bukan OKU yang berdaftar dengan JKM.');
        }
        
    }

    public function kemaskiniDaftarPelajar($smoku_id)
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
        
        $institusi = InfoIpt::whereIn('jenis_institusi', ['UA','IPTS','KK','P'])->orderby("nama_institusi","asc")->select('id_institusi','nama_institusi')->get();
        // dd($institusi);

        $peringkat = PeringkatPengajian::all()->sortBy('kod_peringkat');
        $kursus = Kursus::all()->sortBy('nama_kursus');
        $mod = Mod::all()->sortBy('kod_mod');
        $biaya = SumberBiaya::all()->sortBy('id');
        $penaja = Penaja::orderby("penaja","asc")->get();
        $penajaArray = $penaja->toArray();
        
        return view('kemaskini.sekretariat.pelajar.daftar_pelajar_institusi',compact('smoku','butiranPelajar','negeri','keturunan','agama','bandar','parlimen','dun','oku','waris','hubungan','akademik','institusi','peringkat','kursus','mod','biaya','penaja','penajaArray'));
    }

    public function simpanDaftarPelajar(Request $request, $smoku_id)
    {
        $smoku = Smoku::findOrFail($smoku_id);
        $nokp_pelajar = $smoku->no_kp;

        // Update Smoku
        $smoku->update([
            'umur'       => $request->umur,
            'email'      => $request->emel,
            'keturunan'  => $request->keturunan,
        ]);

        // Butiran Pelajar
        ButiranPelajar::updateOrCreate(
            ['smoku_id' => $smoku_id],
            [
                'negeri_lahir'            => $request->negeri_lahir,
                'agama'                   => $request->agama,
                'alamat_tetap'            => strtoupper($request->alamat_tetap),
                'alamat_tetap_negeri'     => $request->alamat_tetap_negeri,
                'alamat_tetap_bandar'     => $request->alamat_tetap_bandar,
                'alamat_tetap_poskod'     => $request->alamat_tetap_poskod,
                'parlimen'                => $request->parlimen,
                'dun'                     => $request->dun,
                'alamat_surat_menyurat'   => strtoupper($request->alamat_surat_menyurat),
                'alamat_surat_negeri'     => $request->alamat_surat_negeri,
                'alamat_surat_bandar'     => $request->alamat_surat_bandar,
                'alamat_surat_poskod'     => $request->alamat_surat_poskod,
                'tel_bimbit'              => str_replace('-', '', $request->tel_bimbit),
                'tel_rumah'               => str_replace('-', '', $request->tel_rumah),
                'no_akaun_bank'           => $request->no_akaun_bank,
                'emel'                    => $request->emel,
                'status_pekerjaan'        => $request->status_pekerjaan,
                'pekerjaan'               => strtoupper($request->pekerjaan),
                'pendapatan'              => $request->pendapatan,
            ]
        );

        // Waris
        Waris::updateOrCreate(
            ['smoku_id' => $smoku_id],
            [
                'nama_waris'         => strtoupper($request->nama_waris),
                'no_kp_waris'        => $request->no_kp_waris,
                'no_pasport_waris'   => $request->no_pasport_waris,
                'hubungan_waris'     => $request->hubungan_waris,
                'hubungan_lain_waris'=> $request->hubungan_lain_waris,
                'tel_bimbit_waris'   => str_replace('-', '', $request->tel_bimbit_waris),
                'alamat_waris'       => strtoupper($request->alamat_waris),
                'alamat_negeri_waris'=> $request->alamat_negeri_waris,
                'alamat_bandar_waris'=> $request->alamat_bandar_waris,
                'alamat_poskod_waris'=> $request->alamat_poskod_waris,
                'pekerjaan_waris'    => strtoupper($request->pekerjaan_waris),
                'pendapatan_waris'   => $request->pendapatan_waris,
            ]
        );

        // Akademik
        Akademik::updateOrCreate(
            ['smoku_id' => $smoku_id],
            [
                'no_pendaftaran_pelajar' => $request->no_pendaftaran_pelajar,
                'peringkat_pengajian'    => $request->peringkat_pengajian,
                'nama_kursus'            => $request->nama_kursus,
                'id_institusi'           => $request->id_institusi,
                'sesi'                   => $request->sesi,
                'tarikh_mula'            => $request->tarikh_mula,
                'tarikh_tamat'           => $request->tarikh_tamat,
                'sem_semasa'             => '1',
                'tempoh_pengajian'       => $request->tempoh_pengajian,
                'bil_bulan_per_sem'      => $request->bil_bulan_per_sem,
                'mod'                    => $request->mod,
                'sumber_biaya'           => $request->sumber_biaya,
                'sumber_lain'            => $request->sumber_lain,
                'nama_penaja'            => $request->nama_penaja,
                'penaja_lain'            => $request->penaja_lain,
                'status'                 => '1',
            ]
        );

        // Permohonan & Sejarah
        $programCode = $request->program === 'BKOKU' ? 'B' : 'P';
        $permohonan = Permohonan::updateOrCreate(
            ['smoku_id' => $smoku_id],
            [
                'no_rujukan_permohonan' => "{$programCode}/{$request->peringkat_pengajian}/{$nokp_pelajar}",
                'program'     => $request->program,
                'yuran'       => $request->yuran,
                'wang_saku'   => $request->wang_saku,
                'perakuan'    => '1',
                'status'      => '8',
                'data_migrate'=> '1',
            ]
        );

        $permohonan_kelulusan = Kelulusan::updateOrCreate(
            ['permohonan_id' => $permohonan->id],
            [
                'keputusan'    => 'Lulus',
                'catatan'      => 'DILULUSKAN',
            ]
        );

        SejarahPermohonan::updateOrCreate(
            ['smoku_id' => $smoku_id],
            [
                'permohonan_id' => $permohonan->id,
                'status'        => '8',
            ]
        );

        // Dokumen
        $runningNumber = rand(1000, 9999);
        $documentTypes = [
            'akaunBank'   => 1,
            'suratTawaran'=> 2,
            'invoisResit' => 3,
        ];

        $docRules = 'nullable|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png';
        $request->validate([
            'akaunBank' => $docRules,
            'suratTawaran' => $docRules,
            'invoisResit' => $docRules,
        ]);

        foreach ($documentTypes as $inputName => $idDokumen) {
            if ($file = $request->file($inputName)) {
                $extension = strtolower($file->getClientOriginalExtension());
                $newFilename = Str::uuid()->toString() . '.' . $extension;
                $file->move('assets/dokumen/permohonan', $newFilename);

                Dokumen::updateOrCreate(
                    [
                        'permohonan_id' => $permohonan->id,
                        'id_dokumen'    => $idDokumen,
                    ],
                    [
                        'dokumen' => $newFilename,
                        'catatan' => $request->input("nota_$inputName"),
                    ]
                );
            }
        }

        // Create user if not exist
        $user = User::where('no_kp', $nokp_pelajar)->first();
        if (!$user) {
            $password = collect(str_split('abcdefghijklmn123456789!@#$%^&'))
                ->random(12)
                ->implode('');

            $user = User::create([
                'nama'         => $request->nama_pelajar,
                'no_kp'        => $request->no_kp,
                'email'        => $request->emel,
                'tahap'        => 1,
                'password'     => Hash::make($password),
                'data_migrate' => 1,
                'status'       => 1,
            ]);

            Mail::to($request->emel)->send(new MailDaftarPentadbir(
                $request->emel,
                $request->no_kp,
                $password
            ));
        }

        // Update daftar
        DB::table('smoku_daftar')
            ->where('smoku_id', $smoku_id)
            ->update([
                'status'     => '1',
                'updated_at' => now(),
            ]);

        return redirect()->route('kemaskini.sekretariat.daftar.pelajar')->with('success', 'Pendaftaran pelajar sedia ada telah berjaya.');
    }

    public function deletePendaftaranPelajar($id)
    {
        DB::table('smoku_daftar')->where('smoku_id',$id)->delete();
        
        return redirect()->route('kemaskini.sekretariat.daftar.pelajar')->with('success', 'Pendaftaran pelajar telah di padam.');
    }

    //Sekretariat lapor tamat pengajian pelajar
    public function tamatPengajianPelajar($smoku_id)
    {   
        $smoku = Smoku::where('id', $smoku_id)->first();
        $tamat_pengajian = TamatPengajian::where('smoku_id', $smoku->id)->first();
        $maklumat_kerja = ButiranPelajar::where('smoku_id', $smoku->id)->first();

        $kelas = KelasPenganugerahan::all()->sortBy('id');

        $ipt = InfoIpt::orderBy('nama_institusi', 'asc')
              ->whereIn('jenis_institusi', ['UA', 'IPTS', 'P', 'KK'])
              ->get();
       
        // Initialize variables to hold uploaded file information
        $uploadedSijilTamat = [];
        $uploadedTranskrip = [];
        $cgpa = '';
        $kelas_p = '';
        $perakuan = '';
        $status_pekerjaan = '';
        $sektor = '';
        $pekerjaan = '';
        $pendapatan = '';
        $uploadedTawaran = [];
        $institusi = '';
        $peringkat = '';
        $kursus = '';

        // Check if $tamat_pengajian is not null and has uploaded files
        if ($tamat_pengajian) {
            if ($tamat_pengajian->sijil_tamat) {
                $uploadedSijilTamat = is_array($tamat_pengajian->sijil_tamat) ? $tamat_pengajian->sijil_tamat : [$tamat_pengajian->sijil_tamat];
            }

            if ($tamat_pengajian->transkrip) {
                $uploadedTranskrip = is_array($tamat_pengajian->transkrip) ? $tamat_pengajian->transkrip : [$tamat_pengajian->transkrip];
            }

            if($tamat_pengajian->cgpa){
                $cgpa = $tamat_pengajian->cgpa;
            }

            if($tamat_pengajian->kelas){
                $kelas_p = $tamat_pengajian->kelas;
            }

            if($tamat_pengajian->perakuan){
                $perakuan = $tamat_pengajian->perakuan;
            }
        }
        // Check if $maklumat_kerja is not null
        if ($maklumat_kerja) {
           

            if ($maklumat_kerja->status_pekerjaan) {
                $status_pekerjaan = $maklumat_kerja->status_pekerjaan ? $maklumat_kerja->status_pekerjaan : [$maklumat_kerja->status_pekerjaan];
            }

            if ($maklumat_kerja->sektor) {
                $sektor = $maklumat_kerja->sektor ? $maklumat_kerja->sektor : [$maklumat_kerja->sektor];
            }
            
            if ($maklumat_kerja->pekerjaan) {
                $pekerjaan = $maklumat_kerja->pekerjaan ? $maklumat_kerja->pekerjaan : [$maklumat_kerja->pekerjaan];
            }

            if($maklumat_kerja->pendapatan){
                $pendapatan = $maklumat_kerja->pendapatan ? $maklumat_kerja->pendapatan : [$maklumat_kerja->pendapatan];
            }
        }
        // Check if $pengajian_baharu is not null and has uploaded files
        if ($tamat_pengajian) {
            if ($tamat_pengajian->tawaran) {
                $uploadedTawaran = is_array($tamat_pengajian->tawaran) ? $tamat_pengajian->tawaran : [$tamat_pengajian->tawaran];
            }

            if($tamat_pengajian->institusi){
                $institusi = $tamat_pengajian->id_institusi;
            }

            if($tamat_pengajian->peringkat){
                $peringkat = $tamat_pengajian->peringkat_pengajian;
            }

            if($tamat_pengajian->kursus){
                $kursus = $tamat_pengajian->nama_kursus;
            }
        }

        // dd($pekerjaan);

           

        return view('kemaskini.sekretariat.pelajar.lapor_tamat_pengajian', compact('smoku', 'uploadedSijilTamat', 'uploadedTranskrip', 'cgpa', 'kelas_p', 'perakuan', 'status_pekerjaan', 'sektor', 'pekerjaan', 'pendapatan', 'kelas', 'uploadedTawaran', 'ipt', 'tamat_pengajian'));
    }

    public function hantarTamatPengajianPelajar(Request $request, $smoku_id)
    {
        $smoku = Smoku::where('id', $smoku_id)->first();
        $permohonan = Permohonan::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();
        $akademik = Akademik::orderBy('id', 'desc')->where('smoku_id', $smoku->id)->first();

        // Validate incoming file uploads
        $validatedData = $request->validate([
            'sijilTamat.*' => 'required|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png|max:2048',
            'transkrip.*' => 'required|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png|max:2048',
            'tawaran.*'    => 'required|file|mimes:pdf,jpg,jpeg,png|mimetypes:application/pdf,image/jpeg,image/png|max:2048',
        ]);

        $uploadedSijilTamat = [];
        $uploadedTranskrip = [];
        $uploadedTawaran = [];

        $sijilTamat = $request->file('sijilTamat');
        $transkrip = $request->file('transkrip');
        $tawaran = $request->file('tawaran');

        $cgpa = $request->cgpa;
        $kelas = $request->kelas;
        $perakuan = $request->perakuan;

        // Find or create a TamatPengajian record
        $tamatPengajian = TamatPengajian::firstOrNew([
            'smoku_id' => $smoku->id,
            'permohonan_id' => $permohonan->id,
        ]);

        // Handle sijil tamat & transkrip
        if ($sijilTamat && $transkrip) {
            foreach ($sijilTamat as $key => $sijil) {
                $extension = strtolower($sijil->getClientOriginalExtension());
                $filenameSijil = Str::uuid()->toString() . '.' . $extension;
                $sijil->move('assets/dokumen/sijil_tamat', $filenameSijil);
                $uploadedSijilTamat[] = $filenameSijil;

                $transkripExtension = strtolower($transkrip[$key]->getClientOriginalExtension());
                $filenameTranskrip = Str::uuid()->toString() . '.' . $transkripExtension;
                $transkrip[$key]->move('assets/dokumen/salinan_transkrip', $filenameTranskrip);
                $uploadedTranskrip[] = $filenameTranskrip;

                // Store only last file if multiple uploaded
                $tamatPengajian->sijil_tamat = $filenameSijil;
                $tamatPengajian->transkrip = $filenameTranskrip;
            }
        }

        // Handle tawaran
        if ($tawaran) {
            foreach ($tawaran as $file) {
                $extension = strtolower($file->getClientOriginalExtension());
                $filenameTawaran = Str::uuid()->toString() . '.' . $extension;
                $file->move('assets/dokumen/permohonan', $filenameTawaran);
                $uploadedTawaran[] = $filenameTawaran;

                // Store only last file if multiple uploaded
                $tamatPengajian->tawaran = $filenameTawaran;
            }

        }

        // Save academic info
        $tamatPengajian->cgpa = $cgpa;
        $tamatPengajian->kelas = $kelas;
        // Save new permohonan info
        $tamatPengajian->institusi = $request->id_institusi;
        $tamatPengajian->peringkat = $request->peringkat_pengajian;
        $tamatPengajian->kursus = $request->nama_kursus;
        $tamatPengajian->institusi_lama = $akademik->id_institusi; //simpan maklumat lama
        $tamatPengajian->peringkat_lama = $akademik->peringkat_pengajian;
        $tamatPengajian->kursus_lama = $akademik->nama_kursus;
        $tamatPengajian->perakuan = $perakuan;
        $tamatPengajian->save();

        // Update employment info
        $status_pekerjaan = $request->status_pekerjaan;
        $sektor = $status_pekerjaan === 'TIDAK BEKERJA' ? null : $request->sektor;
        $pekerjaan = $status_pekerjaan === 'TIDAK BEKERJA' ? null : strtoupper($request->pekerjaan);
        $pendapatan = $status_pekerjaan === 'TIDAK BEKERJA' ? null : $request->pendapatan;

        ButiranPelajar::where('smoku_id', $smoku->id)->update([
            'status_pekerjaan' => $status_pekerjaan,
            'sektor'           => $sektor,
            'pekerjaan'        => $pekerjaan,
            'pendapatan'       => $pendapatan,
        ]);

        // Store uploaded filenames in session
        session()->put('uploadedSijilTamat', $uploadedSijilTamat);
        session()->put('uploadedTranskrip', $uploadedTranskrip);
        session()->put('uploadedTawaran', $uploadedTawaran);
        session()->put('perakuan', $perakuan);

        return redirect()->route('kemaskini.sekretariat.senarai.profil')->with('success', 'Dokumen lapor diri tamat pengajian telah berjaya dihantar.');
    }

}
