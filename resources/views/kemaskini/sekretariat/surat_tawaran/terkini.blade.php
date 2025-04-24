<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">

        <style>
            .card{
                padding: 30px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: black;
            }

            .parentSpace {
                width: 100%;
                font-family: Arial, sans-serif;
                font-size: 12px;
                color: black;
                line-height: 1.0;
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

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Surat Tawaran</li>
            <!--end::Item-->
        </ul>
    <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>

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
                                    <table style="margin: 0; padding: 0; border-collapse: collapse;">
                                        <tr style="line-height: 0;">
                                            <td>Tel</td>
                                            <td>:</td>
                                            <td>{{$maklumat_kementerian->tel}}</td>
                                        </tr>
                                        <tr style="line-height: 0;">
                                            <td>E-mel</td>
                                            <td>:</td>
                                            <td>{{$maklumat_kementerian->email}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                               
                            <hr>

                            <form action="#" method="GET">
                                @csrf
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

                                <br>

                                <div class="penerima">
                                    <b>xxxxxxxxxxxxxxxxxxxxxxxx</b>
                                    <br><b>xxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                </div>
                                    
                                <br>
                                <p>Tuan/Puan,</p>
                                <br>
                                <h4>{{ strtoupper($suratTawaran->tajuk) }}</h4>
                                <br>
                                <p>{{$suratTawaran->hormat}}</p>
                                <br>
                                <p>{{$suratTawaran->tujuan}}</p>
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
                                    <br>
                                    <p><b>3. KADAR PEMBIAYAAN</b>
                                        <br>{{$suratTawaran->kandungan2}}</p>
                                    <br>
                                    <p><b>4. HAK KERAJAAN</b>
                                        <br>{{$suratTawaran->kandungan3}}</p>
                                </div>
                                <br>
                                
                                <p>Sekian, terima kasih.</p>
                                <br>
                                <p><b>{{$suratTawaran->penutup1}}</b></p>
                                <p><b>{{$suratTawaran->penutup4_4}}</b></p>
                                <p><b>{{$suratTawaran->penutup2}}</b></p>
                                <br>
                                <p>Saya yang menjalankan amanah,</p>
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
                                <div class="d-flex flex-center mt-5 mb-5">
                                    <a href="{{ url('sekretariat/muat-turun/surat-tawaran/dikemaskini') }}" class="btn btn-info btn-sm" style="width: 15%; margin: 0 auto;">
                                        Muat Turun<i class='fas fa-download' style='color:white!important; padding-left:20px;'></i>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-default-layout> 