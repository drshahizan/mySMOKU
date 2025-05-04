<x-default-layout>
    <head>
       <!-- Javascript -->
        <script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">

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
                line-height: 1.1 !important;
            }
    
            .left {
                float: left;
                width: 82%;
            }
    
            .right {
                float: right;
                width: 18%;
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
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
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

                            <form action="{{ route('sendPPK', ['suratTawaranId' => $suratTawaran->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <table style="float: right">
                                    <tr>
                                        <td>Ruj. Kami</td>
                                        <td>:</td>
                                        <td>KPT.PPK-XXXXXXXXXX </td>
                                    </tr>
                                    <tr>
                                        <td>Tarikh</td>
                                        <td>:</td>
                                        <td>XXXXXXXXXX</td>
                                    </tr>
                                </table>

                                <br><br><br>

                                <div class="penerima">
                                    <b>xxxxxxxxxxxxxxxxxxxxxxxx</b>
                                    <br><b>xxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                    <br><b>xxxxxxxxxxxxxxxx</b>
                                </div>
                                    
                                <br>
                                <p>Tuan/Puan,</p>
                                <div class="col-md-12 fv-row">
                                    <h4><input class="form-control form-control-solid" type="text" id="tajuk" name="tajuk" value="{{ strtoupper($suratTawaran->tajuk) }}"></h4>
                                </div>
                                <br>
                                <div class="col-md-12 fv-row">
                                    <input class="form-control form-control-solid" type="text" id="hormat" name="hormat" value="{{$suratTawaran->hormat}}">
                                </div>
                                <br>
                                <div class="col-md-12 fv-row">
                                    <textarea class="form-control form-control-solid" name="tujuan" id="tujuan">{{$suratTawaran->tujuan}}</textarea>
                                </div>
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
                                        <td><strong>TEMPOH PENGAJIAN</strong></td>
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
                                <div class="main-content">
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2"><b>2. TEMPOH KUAT KUASA</b></label>
                                        <textarea class="form-control form-control-solid" name="kandungan1" id="kandungan1">{{$suratTawaran->kandungan1}}</textarea>
                                    </div>
                                    <br>
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2"><b>3. KADAR PEMBIAYAAN</b></label>
                                        <textarea class="form-control form-control-solid" name="kandungan2" id="kandungan2">{{$suratTawaran->kandungan2}}</textarea>
                                    </div>
                                    <br>
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2"><b>4. HAK KERAJAAN</b></label>
                                        <textarea class="form-control form-control-solid" name="kandungan3" id="kandungan3">{{$suratTawaran->kandungan3}}</textarea>
                                    </div>
                                </div>

                                <br><br>
                                
                                <p>Sekian, terima kasih.</p>
                                <br>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup1" name="penutup1" style="font-weight:bold" value="{{$suratTawaran->penutup1}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup4_4" name="penutup4_4" style="font-weight:bold" value="{{$suratTawaran->penutup4_4}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup2" name="penutup2" style="font-weight:bold" value="{{$suratTawaran->penutup2}}">
                                </div>
                                <br><br>

                                <p>Saya yang menjalankan amanah,</p>
                                
                                <br>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup3_1" name="penutup3_1" style="font-weight:bold" value="{{$suratTawaran->penutup3_1}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup3_2" name="penutup3_2" value="{{$suratTawaran->penutup3_2}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup3_3" name="penutup3_3" value="{{$suratTawaran->penutup3_3}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup3_4" name="penutup3_4" value="{{$suratTawaran->penutup3_4}}">
                                </div>
                                <br><br>

                                <div class="d-flex align-items-center">
                                    <label for="penutup4_1" class="me-2">s.k. :</label>
                                    <input class="form-control" type="text" id="penutup4_1" name="penutup4_1"
                                           style="font-weight: bold; width: auto;" 
                                           value="{{$suratTawaran->penutup4_1}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup4_2" name="penutup4_2" style="font-weight:bold" value="{{$suratTawaran->penutup4_2}}">
                                </div>
                                <br><br>

                                <p style="text-align: center;">
                                    <span style="font-style: italic;"><b>
                                      * Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan.
                                    </b></span>
                                </p>
                                  
                                
                                <div class="d-flex flex-center mt-5 mb-5">
                                    <button type="submit" class="btn btn-primary btn-sm">Kemaskini</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Javascript-->
        {{-- <script>
            tinymce.init({
            selector: '#kandungan2', // Replace with the ID or class of your textarea
            plugins: 'autolink lists link image charmap print preview',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            height: 300 // Set the height of the editor
            });
            var editorContent = tinymce.get('kandungan2').getContent();
        </script> --}}
    </body>
</x-default-layout> 