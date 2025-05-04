<html lang="en">
    <head>
        <style>
            @page {
                size: A4;
                font-family: Arial, sans-serif;
                font-size: 12pt;
                line-height: 1.5;
            }
    
            body::before {
                content: "";
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                /* background-image: url('logoKPT_grayscale.png'); */
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
                line-height: 1.0;
            }
    
            .left {
                float: left;
                width: 60%;
            }
    
            .right {
                float: right;
                width: 30%;
                font-size: 11pt; 
                margin-top: 100px;
                line-height: 1;
            }
        </style>
    </head>

    <body>
        <div class="parentSpace">
            <div class="left">
                <div class="logo" style="margin-top:20px; float: left;">
                    <img src="logoKPT.png" alt="Kementerian Pengajian Tinggi" style="height: 110px; width: 160px;">
                </div>

                <div class="address" style="padding-left: 170px; font-size: 11pt; margin-top:15px;">
                    <b>{{ strtoupper($maklumat_kementerian->nama_kementerian_bm) }}</b>
                    <br><b style="font-style: italic;">{{ strtoupper($maklumat_kementerian->nama_kementerian_bi) }}</b>
                    <br><b>{{$maklumat_kementerian->nama_bahagian_bm}}</b>
                    <br><b style="font-style: italic;">{{$maklumat_kementerian->nama_bahagian_bi}}</b>
                    <br>{{$maklumat_kementerian->alamat1}}
                    <br>{{$maklumat_kementerian->alamat2}}
                    <br>{{$maklumat_kementerian->poskod}} {{strtoupper($maklumat_kementerian->negeri)}}
                    <br>{{strtoupper($maklumat_kementerian->negara)}}
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
                        <td>E-mel</td>
                        <td>:</td>
                        <td>{{$maklumat_kementerian->email}}</td>
                    </tr>
                </table>
            </div>
        </div>
           
        <br><br><br><br><br><br>
        
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
            $peringkat = DB::table('smoku_akademik')->join('bk_peringkat_pengajian','bk_peringkat_pengajian.kod_peringkat','=','smoku_akademik.peringkat_pengajian' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_peringkat_pengajian.peringkat');
            $institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_info_institusi.nama_institusi');
        @endphp

        @php
            \Carbon\Carbon::setLocale('ms');
        @endphp

        <table style="float: right">
            <tr>
                <td>Ruj. Kami</td>
                <td>:</td>
                <td>KPT.BKOKU-{{$no_kp}}</td>
            </tr>
            <tr>
                <td>Tarikh</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse($tarikh_kelulusan)->isoFormat('D MMMM Y') }}</td>
            </tr>
        </table>

        <br><br><br>

        <div class="penerima" style="width: 50%">
            <b>{{$nama}}</b>
            <br><b>{{$no_kp}}</b>
            <br>{{$alamat}}
            <br>{{$poskod}} {{$bandar}}
            <br>{{$negeri}}
        </div>
            
        <br>
        <p>Tuan/Puan,</p>
        
        <p><b>{{ strtoupper($kandungan_surat->tajuk) }}</b></p>
        <p>{{$kandungan_surat->hormat}}</p>
        <p>{{$kandungan_surat->tujuan }}</p>
        <br>

        <table>
            <tr>
                <td><strong>PERINGKAT</strong></td>
                <td><b>:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>{{ strtoupper($peringkat) }}</b></td>
            </tr>

            <tr>
                <td><strong>KURSUS </strong></td>
                <td><b>:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>{{strtoupper($program)}}</b></td>
            </tr>

            <tr>
                <td><strong>INSTITUSI</strong></td>
                <td><b>:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>{{strtoupper($institusi)}}</b></td>
            </tr>

            <tr>
                <td><strong>TEMPOH PENGAJIAN </strong></td>
                <td><b>:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <b>
                    {{ Str::upper(\Carbon\Carbon::parse($tarikh_mula)->isoFormat('D MMMM Y')) }}
                    HINGGA
                    {{ Str::upper(\Carbon\Carbon::parse($tarikh_tamat)->isoFormat('D MMMM Y')) }}
                    </b>
                </td>
            </tr>

            <tr>
                <td><strong>MOD PENGAJIAN </strong></td>
                <td><b>:</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>{{strtoupper($mod)}}</b></td>
            </tr>
        </table>
        
        <br>
        <div class="main-content" style="text-align: justify;">
            <p><b>2. TEMPOH KUAT KUASA</b>
                <br>
                {{$kandungan_surat->kandungan1}}</p>
            <p><b>3. KADAR PEMBIAYAAN</b>
                <br>{{$kandungan_surat->kandungan2}}</p>
            <p><b>4. HAK KERAJAAN</b>
                <br>{{$kandungan_surat->kandungan3}}</p>
        </div>
        
        <br>
        <p>Sekian, terima kasih.</p>
        <br>
        <p><b>{{ $kandungan_surat->penutup1}}</b></p>
        <p><b>{{$kandungan_surat->penutup4_4}}</b></p>
        <p><b>{{ $kandungan_surat->penutup2}}</b></p>
        <p>Saya yang menjalankan amanah,</p>
        <br>
        <p>
            <b>{{$kandungan_surat->penutup3_1}}</b> <br>
            {{$kandungan_surat->penutup3_2}} <br>
            {{$kandungan_surat->penutup3_3}} <br>
            {{$kandungan_surat->penutup3_4}} <br>
            
        </p>
        <br>
        <p>s.k : {{$kandungan_surat->penutup4_1}} <br>
            {{strtoupper($institusi)}} <br>
        </p>
        <br>
        <p style="text-align: center;">
            <span style="font-style: italic;"><b>
              * Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan.
            </b></span>
        </p>
        
    </body>
</html>
