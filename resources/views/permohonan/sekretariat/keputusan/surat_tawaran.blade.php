<html lang="en">
    <head>
        <style>
            @page {
                size: A4;
                font-family: Arial, sans-serif;
                font-size: 14px;
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
                font-size: 11px; 
                margin-top:75px;
                line-height: 1;
            }
        </style>
    </head>

    <body>
        <div class="parentSpace">
            <div class="left">
                <div class="logo" style="margin-top:10px; float: left;">
                    <img src="logoKPT.png" alt="Kementerian Pengajian Tinggi" style="height: 100px; width: 150px;">
                </div>

                <div class="address" style="padding-left: 150px; font-size: 12px; margin-top:0%;">
                    <b>{{$maklumat_kementerian->nama_kementerian_bm}}</b>
                    <br>{{$maklumat_kementerian->nama_kementerian_bi}}
                    <br>
                    <br>{{$maklumat_kementerian->nama_bahagian_bm}}
                    <br>{{$maklumat_kementerian->nama_bahagian_bi}}
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
           
        <br><br><br><br><br><br><br><br><hr>

        @php
            $tarikh_kelulusan = DB::table('permohonan_kelulusan')->where('permohonan_id',$permohonan['id'])->value('tarikh_mesyuarat');
            $nama = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.nama');
            $no_kp = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.no_kp');
            $alamat = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.alamat_tetap');
            $program = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('nama_kursus');
            $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('tarikh_mula');
            $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('tarikh_tamat');
            $institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_info_institusi.nama_institusi');
            $mod = DB::table('smoku_akademik')->join('bk_mod','bk_mod.kod_mod','=','smoku_akademik.mod' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_mod.mod');
        @endphp

        <p>
            <span style="float: right">
                Rujukan Kami : KPT - {{$kandungan_surat->no_rujukan}}<br>
                Tarikh : {{date('d/m/Y', strtotime($tarikh_kelulusan))}}<br>
            </span>
        </p>

        <br>

        <div class="penerima" style="width: 40%">
            <b>{{$nama}}</b>
            <br><b>NO.KP : {{$no_kp}}</b>
            <br>{{$alamat}}
        </div>
            
        <br>
        <p>Tuan/Puan,</p>
        <br>
        <h3>{{ strtoupper($kandungan_surat->tajuk) }}</h3>
        <br>
        <p>{{$kandungan_surat->tujuan}} :-</p>
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
                <td>{{ Carbon::parse($tarikh_mula)->format('j F Y') }} hingga {{ Carbon::parse($tarikh_tamat)->format('j F Y') }}</td>
            </tr>

            <tr>
                <td><strong>Institusi Pengajian </strong></td>
                <td><b>:</b></td>
                <td>{{strtoupper($institusi)}}</td>
            </tr>
        </table>
        
        <br>
        <div class="main-content" style="text-align:justify;">
            <p>2. Bantuan ini berkuatkuasa mulai <b>{{ Carbon::parse($tarikh_mula)->format('j F Y') }} hingga {{ Carbon::parse($tarikh_tamat)->format('j F Y') }}.</b>
                  {{$kandungan_surat->kandungan1}}</p><br>
            <p>3. {{$kandungan_surat->kandungan2}}</p><br>
            <p>4. {{$kandungan_surat->kandungan3}}</p><br>
        </div>
        
        <p>Sekian, terima kasih.</p>
        <br>
        <p><b>{{$kandungan_surat->penutup1}}</b></p>
        <br>
        <p><b>{{$kandungan_surat->penutup2}}</b></p>
        <br>
        <p>Saya yang menjalankan amanah,</p>
        <p> {{$kandungan_surat->penutup3_1}} <br>
            {{$kandungan_surat->penutup3_2}} <br>
            {{$kandungan_surat->penutup3_3}} <br>
            {{$kandungan_surat->penutup3_4}} <br>
        </p>
        <br>
        <p><div style="text-align: center;">Nota: Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan."</div></p>
        <br>
        <p>s.k :<br>
            {{$kandungan_surat->penutup4_1}} <br>
            {{$kandungan_surat->penutup4_2}} <br>
            {{$kandungan_surat->penutup4_3}} <br>
        </p>
    </body>
</html>
