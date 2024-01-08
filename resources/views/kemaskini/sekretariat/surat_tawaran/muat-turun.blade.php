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
                width: 22%;
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
           
        <br><br><br><br><br><br><br><br>
        
        <hr>

        <p>
            <span style="float: right">
                Ruj. Kami : KPT.BKOKU-XXXXXXXXXX <br>
                Tarikh : XXXXXXXXXX <br>
            </span>
        </p>

        <br>

        <div class="penerima" style="width: 40%">
            <b>XXXXXXXXXX</b>
            <br><b>NO.KP : XXXXXXXXXX</b>
            <br>XXXXXXXXXX
            <br>XXXXX, XXXXXXXXXX
            <br>XXXXXXXXXX
        </div>
            
        <br>
        <p>Tuan/Puan,</p>
        <br>
        <h3>{{ strtoupper( $suratTawaran->tajuk) }}</h3>
        <br>
        <p>{{ $suratTawaran->tujuan }}</p>
        <br>

        <table>
            <tr>
                <td><strong>Program Pengajian </strong></td>
                <td><b>:</b></td>
                <td>XXXXXXXXXXXXXXX</td>
            </tr>

            <tr>
                <td><strong>Mod Pengajian </strong></td>
                <td><b>:</b></td>
                <td>XXXXXXXXXXXXXXX</td>
            </tr>

            <tr>
                <td><strong>Tempoh Penajaan </strong></td>
                <td><b>:</b></td>
                <td>XXXXXXXXXXXXXXX</td>
            </tr>

            <tr>
                <td><strong>Institusi Pengajian </strong></td>
                <td><b>:</b></td>
                <td>XXXXXXXXXXXXXXX</td>
            </tr>
        </table>
        
        <br>
        <div class="main-content" style="text-align:justify;">
            <p>2. Bantuan ini berkuatkuasa mulai <b>XXXXXXXXXXX hingga XXXXXXXXXXX.</b>
                  {{ $suratTawaran->kandungan1}}</p><br>
            <p>3. {{ $suratTawaran->kandungan2}}</p><br>
            <p>4. {{ $suratTawaran->kandungan3}}</p><br>
        </div>
        
        <p>Sekian, terima kasih.</p>
        <br>
        <p><b>{{ $suratTawaran->penutup1}}</b></p>
        <p><b>{{$suratTawaran->penutup4_4}}</b></p>
        <p><b>{{ $suratTawaran->penutup2}}</b></p>
        <br>
        <p>Saya yang menjalankan amanah,</p>
        <p> {{ $suratTawaran->penutup3_1}} <br>
            {{ $suratTawaran->penutup3_2}} <br>
            {{ $suratTawaran->penutup3_3}} <br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ $suratTawaran->penutup3_4}} <br>
        </p>
        <br>
        <p><div style="text-align: center;  font-style: italic;">Nota: Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan."</div></p>
        <br>
        <p>s.k :<br>
            {{ $suratTawaran->penutup4_1}} <br>
            {{ $suratTawaran->penutup4_2}} <br>
            XXXXXXXXXXXXXXXXXXX <br>
        </p>
    </body>
</html>
