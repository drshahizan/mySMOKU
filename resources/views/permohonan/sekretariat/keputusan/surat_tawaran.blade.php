<html lang="en">
    <head>
        <style>
            @page {
                size: A4;
                font-family: Arial, sans-serif;
                font-size: 12pt;
                line-height: 1.15;
            }
    
            body::before {
                content: "";
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('logoKPT_grayscale.png');
                background-size: 450px 300px;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
                opacity: 0.2;
                z-index: -1; /* Place behind content */
            }

            body {
                background-size: 450px 300px;
                background-position: center;
                background-repeat: no-repeat;
                background-attachment: fixed;
            }
            
            .parentSpace {
                width: 100%;
                display: inherit;
            }
    
            .left {
                float: left;
                width: 60%;
            }
    
            .right {
                float: right;
                width: 20%;
                font-size: 9pt; 
                margin-top: 100px;
                line-height: 1;
            }
        </style>
    </head>

    <body>
        <div class="parentSpace">
            <div class="left">
                <div class="logo" style="margin-top:20px; float: left;">
                    <img src="logoKPT.png" alt="Kementerian Pengajian Tinggi" style="height: 100px; width: 150px;">
                </div>

                <div class="address" style="padding-left: 150px; font-size: 10pt; margin-top:0%;">
                    <b>{{ strtoupper ($maklumat_kementerian->nama_kementerian_bm)}}</b>
                    <br><span style="font-style: italic;">{{ strtoupper($maklumat_kementerian->nama_kementerian_bi) }}</span>
                    <br>
                    <br>{{$maklumat_kementerian->nama_bahagian_bm}}
                    <br><span style="font-style: italic;">{{$maklumat_kementerian->nama_bahagian_bi}}</span>
                    <br>{{$maklumat_kementerian->alamat1}}
                    <br>{{$maklumat_kementerian->alamat2}}
                    <br>{{$maklumat_kementerian->poskod}} {{$maklumat_kementerian->negeri}}
                    <br>{{$maklumat_kementerian->negara}}
                </div>
            </div>

            <div class="right">
                <table>
                    <tr>
                        <td>Tel</td>
                        <td>:</td>
                        <td>{{$maklumat_kementerian->tel}}</td>
                    </tr>
                    <tr>
                        <td>Hotline</td>
                        <td>:</td>
                        <td>{{$maklumat_kementerian->hotline}}</td>
                    </tr>
                    <tr>
                        <td>Faks</td>
                        <td>:</td>
                        <td>{{$maklumat_kementerian->faks}}</td>
                    </tr>
                </table>
            </div>
        </div>
           
        <br><br><br><br><br><br><br><br>
        
        <hr>

        @php
            $tarikh_kelulusan = DB::table('permohonan_kelulusan')->where('permohonan_id',$permohonan['id'])->value('tarikh_mesyuarat');
            $nama = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.nama');
            $no_kp = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.no_kp');
            $alamat = DB::table('smoku_butiran_pelajar')->where('smoku_id',$permohonan['smoku_id'])->value('alamat_tetap');
            $poskod = DB::table('smoku_butiran_pelajar')->where('smoku_id',$permohonan['smoku_id'])->value('alamat_tetap_poskod');
            $bandar = DB::table('smoku_butiran_pelajar')->join('bk_bandar','bk_bandar.id','=','smoku_butiran_pelajar.alamat_tetap_bandar' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_bandar.bandar');
            $negeri = DB::table('smoku_butiran_pelajar')->join('bk_negeri','bk_negeri.id','=','smoku_butiran_pelajar.alamat_tetap_negeri' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_negeri.negeri');
            $program = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('nama_kursus');
            $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('tarikh_mula');
            $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('tarikh_tamat');
            $mod = DB::table('smoku_akademik')->join('bk_mod','bk_mod.kod_mod','=','smoku_akademik.mod' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_mod.mod');
            $institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_info_institusi.nama_institusi');
        @endphp

        @php
            \Carbon\Carbon::setLocale('ms');
        @endphp

        <p>
            <span style="float: right">
                @if ($permohonan->program == "BKOKU")
                    Ruj. Kami : KPT.BKOKU-{{$no_kp}}<br>
                @else
                    Ruj. Kami : KPT.PPK-{{$no_kp}}<br>
                @endif
                Tarikh : {{date('d/m/Y', strtotime($tarikh_kelulusan))}}<br>
            </span>
        </p>

        <br><br>

        <div class="penerima" style="width: 50%">
            <b>{{$nama}}</b>
            <br><b>NO.KP : {{$no_kp}}</b>
            <br>{{$alamat}},
            <br>{{$poskod}}, {{$bandar}}
            <br>{{$negeri}}
        </div>
            
        <br>
        <p>Tuan/Puan,</p>
        <br>
        <h3>{{ strtoupper($kandungan_surat->tajuk) }}</h3>
        <br>
        <p>{{ $kandungan_surat->tujuan }}</p>
        <br>

        <table>
            <tr>
                <td><strong>Program Pengajian </strong></td>
                <td><b>:</b></td>
                <td>{{ strtoupper($program) }}</td>
            </tr>

            <tr>
                <td><strong>Mod Pengajian </strong></td>
                <td><b>:</b></td>
                <td>{{strtoupper($mod)}}</td>
            </tr>

            <tr>
                <td><strong>Tempoh Penajaan </strong></td>
                <td><b>:</b></td>
                <td>{{ \Carbon\Carbon::parse($tarikh_mula)->isoFormat('D MMMM Y') }} hingga {{ \Carbon\Carbon::parse($tarikh_tamat)->isoFormat('D MMMM Y') }}</td>
            </tr>

            <tr>
                <td><strong>Institusi Pengajian </strong></td>
                <td><b>:</b></td>
                <td>{{strtoupper($institusi)}}</td>
            </tr>
        </table>
        
        <br>
        <div class="main-content" style="text-align:justify;">
            <p>2.  Bantuan ini berkuatkuasa mulai <b>{{ \Carbon\Carbon::parse($tarikh_mula)->isoFormat('D MMMM Y') }} hingga {{ \Carbon\Carbon::parse($tarikh_tamat)->isoFormat('D MMMM Y') }}.</b>
                  {{$kandungan_surat->kandungan1}}</p><br>
            <p>3.   {{$kandungan_surat->kandungan2}}</p><br>
            <p>4.   {{$kandungan_surat->kandungan3}}</p><br>
        </div>
        
        <p>Sekian, terima kasih.</p>
        <br>
        <p><b>{{$kandungan_surat->penutup1}}</b></p>
        <br>
        <p><b>{{$kandungan_surat->penutup4_4}}</b></p>
        <br>
        <p><b>{{$kandungan_surat->penutup2}}</b></p>
        
        <p> Saya yang menjalankan amanah,</p><br>
        <p> {{$kandungan_surat->penutup3_1}} <br>
            {{$kandungan_surat->penutup3_2}} <br>
            {{$kandungan_surat->penutup3_3}} <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{$kandungan_surat->penutup3_4}} <br>
        </p>
        <br><br>
        <div style="text-align: center; font-style: italic;">"Nota: Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan."</div>
        <br><br>
        <p>s.k :<br>
            {{$kandungan_surat->penutup4_1}} <br>
            {{$kandungan_surat->penutup4_2}} <br>
            {{strtoupper($institusi)}} <br>
        </p>
    </body>
</html>
