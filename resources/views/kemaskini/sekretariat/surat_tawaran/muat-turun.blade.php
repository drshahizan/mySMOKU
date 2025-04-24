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

        <table style="float: right">
            <tr>
                <td>Ruj. Kami</td>
                <td>:</td>
                <td>KPT.BKOKU-XXXXXXXXXX </td>
            </tr>
            <tr>
                <td>Tarikh</td>
                <td>:</td>
                <td>XXXXXXXXXX</td>
            </tr>
        </table>
           
        

        <br><br><br>

        <div class="penerima" style="width: 40%">
            <b>XXXXXXXXXXXXXXXXXXXX</b>
            <br><b>XXXXXXXXXXXX</b>
            <br>XXXXXXXXXX
            <br>XXXXXXXXXX
            <br>XXXXXXXXXX
        </div>
            
        <br>
        <p>Tuan/Puan,</p>
        <p><b>{{ strtoupper( $suratTawaran->tajuk) }}</b></p>
        <p>{{$suratTawaran->hormat}}</p>
        <p>{{ $suratTawaran->tujuan }}</p>
        <br>
        <table>
            <tr>
                <td><strong>PERINGKAT </strong></td>
                <td><b>:</b></td>
                <td>xxxxxxxxxxxxxxxx</td>
            </tr>

            <tr>
                <td><strong>KURSUS </strong></td>
                <td><b>:</b></td>
                <td>xxxxxxxxxxxxxxxx</td>
            </tr>

            <tr>
                <td><strong>INSTITUSI </strong></td>
                <td><b>:</b></td>
                <td>xxxxxxxxxxxxxxxx</td>
            </tr>

            <tr>
                <td><strong>TEMPOH PENGAJIAN </strong></td>
                <td><b>:</b></td>
                <td>xxxxxxxxxxxxxxxx</td>
            </tr>

            <tr>
                <td><strong>MOD PENGAJIAN </strong></td>
                <td><b>:</b></td>
                <td>xxxxxxxxxxxxxxxx</td>
            </tr>
        </table>
        <br>
        <div class="main-content" style="text-align: justify;">
            <p><b>2. TEMPOH KUAT KUASA</b>
                <br>
                {{$suratTawaran->kandungan1}}</p>
            <p><b>3. KADAR PEMBIAYAAN</b>
                <br>{{$suratTawaran->kandungan2}}</p>
            <p><b>4. HAK KERAJAAN</b>
                <br>{{$suratTawaran->kandungan3}}</p>
        </div>
        <br>
        <p>Sekian, terima kasih.</p>
        <br>
        <p><b>{{ $suratTawaran->penutup1}}</b></p>
        <p><b>{{$suratTawaran->penutup4_4}}</b></p>
        <p><b>{{ $suratTawaran->penutup2}}</b></p>
        <p>Saya yang menjalankan amanah,</p>
        <br>
        <p>
            <b>{{$suratTawaran->penutup3_1}}</b> <br>
            {{$suratTawaran->penutup3_2}} <br>
            {{$suratTawaran->penutup3_3}} <br>
            {{$suratTawaran->penutup3_4}} <br>
            
        </p>
        <br>
        <p>s.k : {{$suratTawaran->penutup4_1}} <br>
            {{$suratTawaran->penutup4_2}} <br>
            XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX <br>
        </p>
        <br>
        <p style="text-align: center;">
            <span style="font-style: italic;"><b>
              * Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan.
            </b></span>
        </p>
    </body>
</html>
