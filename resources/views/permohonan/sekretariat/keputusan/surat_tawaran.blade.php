<html lang="en">
    <head>
        {{-- <style>
            @page {
                size: A4;
            } 
        
            body {
                margin: 0.3cm;
                font-size:14px;
                font-family: Arial, sans-serif;
                line-height: 1.15;
                /* background-image:url('logoKPT.png');  */
                background-size: 450px 300px; 
                background-position:center; 
                background-repeat: no-repeat; 
                background-attachment: fixed; 
            }

            .parentSpace{
                width: 100%;
                display:inherit;
            }
            .left {
                float: left;
                width: 60%;
            }
            .right {
                float: right;
                width: 20%;
            }

            /* .contact-info {
                display: flex;
                align-items: center;
                justify-content: space-between;
            } */
        </style>         --}}
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
                opacity: 0.3;
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
                    <b>KEMENTERIAN PENDIDIKAN TINGGI</b>
                    <br>MINISTRY OF HIGHER EDUCATION
                    <br>
                    <br>Bahagian Biasiswa
                    <br>Scholarship Division
                    <br>Aras 2, No.2, Menara 2,
                    <br>Jalan P5/6, Presint 5
                    <br>62200 Putrajaya
                    <br>Malaysia
                </div>
            </div>

            <div class="right">
                <table>
                    <tr>
                        <td>Tel</td>
                        <td>:</td>
                        <td>603-8870 9000</td>
                    </tr>
                    <tr>
                        <td>Hotline</td>
                        <td>:</td>
                        <td>603-8888 1616</td>
                    </tr>
                    <tr>
                        <td>Faks</td>
                        <td>:</td>
                        <td>603-8870 6839</td>
                    </tr>
                </table>
            </div>
        </div>
           
        <br><br><br><br><br><br><br><br><hr>

        <p>
            <span style="float: right">
                Rujukan Kami : KPT - 000101140417<br>
                Tarikh : {{$todayDate}}<br>
            </span>
        </p>

        <br>

        @php
            $nama = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.nama');
            $no_kp = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.no_kp');
            $alamat = DB::table('smoku')->where('id',$permohonan['smoku_id'])->value('smoku.alamat_tetap');
            $program = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('nama_kursus');
            $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('tarikh_mula');
            $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $permohonan['smoku_id'])->value('tarikh_tamat');
            $institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_info_institusi.nama_institusi');
            $mod = DB::table('smoku_akademik')->join('bk_mod','bk_mod.kod_mod','=','smoku_akademik.mod' )->where('smoku_id', $permohonan['smoku_id'])->value('bk_mod.mod');
        @endphp

        <div class="penerima" style="width: 40%">
            <b>{{$nama}}</b>
            <br><b>NO.KP : {{$no_kp}}</b>
            <br>{{$alamat}}
        </div>
            
        <br>
        <p>Tuan/Puan,</p>
        <br>
        <h3>TAWARAN PROGRAM BANTUAN KEWANGAN PELAJAR OKU DI INSTITUSI
            PENGAJIAN TINGGI (IPT) KEMENTERIAN PENGAJIAN TINGGI (KPT)</h3>
        <br>
        <p>Sukacita di maklumkan bahawa tuan/puan telah ditawarkan pembiayaan Program Bantuan
            Kewangan Pelajar OKU di Kementerian Pengajian Tinggi untuk mengikuti kursus berikut :-</p>
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
                Walaubagaimanapun, sekiranya kursus yang diikuti tamat lebih awal sebelum tempoh tersebut,
                tuan/puan dikehendaki untuk memaklumkan ke Bahagian ini dengan kadar segera. Tempoh
                tajaan ini adalah tertakluk kepada surat tawaran asal institusi pengajian dan tidak melebihi
                tempoh maksimum penajaan.</p><br>
            <p>3. Untuk pengetahuan pihak tuan/puan, penetapan kadar bayaran adalah berdasarkan tuntutan
                tahun kalendar akademik pelajar dan IPT serta tidak melebihi <b>RM 5000.00 setahun</b>. 
                Ini bermakna tempoh yang layak adalah bermula dari tuntutan pertama dibuat dalam tahun
                semasa. Tuntutan untuk semester yang telah berlalu adalah tidak dibenarkan.</p><br>
            <p>4. Kerajaan berhak meminda terma-terma tawaran <b>BKOKU</b> ini dari semasa ke semasa.
                Kerajaan juga berhak menarik balik tawaran ini sekiranya tuan/puan didapati melanggar mana-mana terma seperti yang telah ditetapkan.</p>
        </div>
        <br>
        
        <p>Sekian, terima kasih.</p>
        <br>
        <p><b>“PRIHATIN RAKYAT : DARURAT MEMERANGI COVID-19”</b></p>
        <br>
        <p><b>“BERKHIDMAT UNTUK NEGARA”</b></p>
        <br>
        <p>Saya yang menjalankan amanah,</p>
        <p><b>Setiausaha<br>
            Bahagian Biasiswa<br>
            b.p. Ketua Setiausaha<br>
            Kementerian Pengajian Tinggi</b>
        </p>
        <br>
        <p><div style="text-align: center;">Nota: Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan."</div></p>
        <br>
        <p>s.k :<br>
            Unit Kebajikan<br>
            Bahagian Hal Ehwal Pelajar<br>
            UNIVERSITI TEKNOLOGI MARA, SHAH ALAM
        </p>
    </body>
</html>
