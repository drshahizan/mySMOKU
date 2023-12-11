<x-default-layout>
    <head>
        <style>
            .card{
                padding: 30px;
                color: black;
            }

            .parentSpace {
                width: 100%;
                color: black;
                line-height: 1.1 !important;
            }
    
            .left {
                float: left;
                width: 80%;
            }
    
            .right {
                float: right;
                width: 20%;
                padding-top: 70px;
            }

            table, tr, td{
                border: none !important;
            }
        </style>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="card">
                            <div class="parentSpace">
                                <div class="left">
                                    <div class="logo" style="padding-top:5px; float: left;">
                                        <img src="{{asset('logoKPT.png')}}" alt="Kementerian Pengajian Tinggi" style="height: 100px; width: 150px;">
                                    </div>
                    
                                    <div class="address" style="padding-left: 150px; margin-top:0%;">
                                        <b>{{$maklumat_kementerian->nama_kementerian_bm}}</b>
                                        <br>{{$maklumat_kementerian->nama_kementerian_bi}}<br>
                                        <br>{{$maklumat_kementerian->nama_bahagian_bm}}
                                        <br>{{$maklumat_kementerian->nama_bahagian_bi}}
                                        <br>{{$maklumat_kementerian->alamat1}}
                                        <br>{{$maklumat_kementerian->alamat2}}
                                        <br>{{$maklumat_kementerian->poskod}} {{$maklumat_kementerian->negeri}}
                                        <br>{{$maklumat_kementerian->negara}}
                                    </div>
                                </div>
                    
                                <div class="right">
                                    <table style="margin: 0; padding: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="line-height: 0;">Tel</td>
                                            <td style="line-height: 0;">:</td>
                                            <td style="line-height: 0;">{{$maklumat_kementerian->tel}}</td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 0;">Hotline</td>
                                            <td style="line-height: 0;">:</td>
                                            <td style="line-height: 0;">{{$maklumat_kementerian->hotline}}</td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 0;">Faks</td>
                                            <td style="line-height: 0;">:</td>
                                            <td style="line-height: 0;">{{$maklumat_kementerian->faks}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                               
                            <hr>

                            <form action="#" method="GET">
                                @csrf
                                <p>
                                    <span style="float: right">
                                        No Rujukan Kami : KPT - xxxxxxxxx<br>
                                        Tarikh : xxxxxxxxx <br>
                                    </span>
                                </p>

                                <br>

                                <div class="penerima">
                                    <b>xxxxxxxxxxxxxxxx</b>
                                    <br><b>NO.KP : xxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                </div>
                                    
                                <br>
                                <p>Tuan/Puan,</p>
                                <br>
                                <h4>{{ strtoupper($suratTawaran->tajuk) }}</h4>
                                <br>
                                <p>{{$suratTawaran->tujuan}}</p>
                                <br>

                                <table>
                                    <tr>
                                        <td><strong>Program Pengajian </strong></td>
                                        <td><b>:</b></td>
                                        <td>xxxxxxxxxxxxxxxx</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Mod Pengajian </strong></td>
                                        <td><b>:</b></td>
                                        <td>xxxxxxxxxxxxxxxx</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Tempoh Penajaan </strong></td>
                                        <td><b>:</b></td>
                                        <td>xxxxxxxxxxxxxxxx</td>
                                    </tr>

                                    <tr>
                                        <td><strong>Institusi Pengajian </strong></td>
                                        <td><b>:</b></td>
                                        <td>xxxxxxxxxxxxxxxx</td>
                                    </tr>
                                </table>
                                
                                <br>
                                <div class="main-content">
                                    <p>2. Bantuan ini berkuatkuasa mulai <b>xxxxxxxxx hingga xxxxxxxxx.</b> {{$suratTawaran->kandungan1}}</p>
                                    <br>
                                    <p>3. {{$suratTawaran->kandungan2}}</p>
                                    <br>
                                    <p>4. {{$suratTawaran->kandungan3}}</p>
                                </div>
                                <br>
                                
                                <p>Sekian, terima kasih.</p>
                                <br>
                                <p><b>{{$suratTawaran->penutup1}}</b></p>
                                <p><b>{{$suratTawaran->penutup4_4}}</b></p>
                                <br>
                                <p><b>{{$suratTawaran->penutup2}}</b></p>
                                <br>
                                <p>Saya yang menjalankan amanah,</p>
                                <p>
                                    <b>{{$suratTawaran->penutup3_1}}</b> <br>
                                    <b>{{$suratTawaran->penutup3_2}}</b> <br>
                                    <b>{{$suratTawaran->penutup3_3}}</b> <br>
                                    <b>{{$suratTawaran->penutup3_4}}</b> <br>
                                </p>
                                <br>
                                <p><div style="text-align: center;">"Nota: Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan."</div></p>
                                <br>
                                <p>s.k :<br>
                                    {{$suratTawaran->penutup4_1}} <br>
                                    {{$suratTawaran->penutup4_2}} <br>
                                    {{$suratTawaran->penutup4_3}} <br>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-default-layout> 