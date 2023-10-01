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
                padding: 40px;
                font-family: Arial, sans-serif;
                font-size: 14px;
                color: black;
            }

            .parentSpace {
                width: 100%;
                font-family: Arial, sans-serif;
                font-size: 12px;
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
                                    <table style="margin: 0; padding: 0; border-collapse: collapse;">
                                        <tr>
                                            <td style="line-height: 0;">Tel</td>
                                            <td style="line-height: 0;">:</td>
                                            <td style="line-height: 0;">603-8870 9000</td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 0;">Hotline</td>
                                            <td style="line-height: 0;">:</td>
                                            <td style="line-height: 0;">603-8888 0606</td>
                                        </tr>
                                        <tr>
                                            <td style="line-height: 0;">Faks</td>
                                            <td style="line-height: 0;">:</td>
                                            <td style="line-height: 0;">603-8870 6839</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                               
                            <hr>

                            @if($editMode)
                                <form action="{{ route('update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="suratTawaranId" value="{{ $suratTawaran->id }}">
                                    <p>
                                        <span style="float: right">
                                            Rujukan Kami : KPT - 000101140417<br>
                                            Tarikh : tarikh kelulusan <br>
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
                                    <h4><input type="text" id="tajuk" name="tajuk" style="width: 100%" value="{{ strtoupper($suratTawaran->tajuk) }}"></h4>
                                    <br>
                                    <p>Sukacita di maklumkan bahawa tuan/puan telah ditawarkan pembiayaan Program Bantuan
                                        Kewangan Pelajar OKU di Kementerian Pengajian Tinggi untuk mengikuti kursus berikut :-</p>
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
                                    <div class="main-content" style="text-align:justify;">
                                        <p>2. Bantuan ini berkuatkuasa mulai <b> hingga .</b>
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

                                    <input type="hidden" name="suratTawaranId" value="{{ $suratTawaran->id }}">
                                    <div class="d-flex flex-center mt-5 mb-5">
                                        <button type="submit" class="btn btn-primary btn-sm">Confirm and Update</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-default-layout> 