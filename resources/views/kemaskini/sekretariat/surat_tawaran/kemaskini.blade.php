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
                                        <br>{{ strtoupper($maklumat_kementerian->nama_kementerian_bi) }}<br>
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
                                        <tr style="line-height: 0;">
                                            <td>Tel</td>
                                            <td>:</td>
                                            <td>{{$maklumat_kementerian->tel}}</td>
                                        </tr>
                                        <tr style="line-height: 0;">
                                            <td>Hotline</td>
                                            <td>:</td>
                                            <td>{{$maklumat_kementerian->hotline}}</td>
                                        </tr>
                                        <tr style="line-height: 0;">
                                            <td>Faks</td>
                                            <td>:</td>
                                            <td>{{$maklumat_kementerian->faks}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                               
                            <hr>

                            <form action="{{ route('send', ['suratTawaranId' => $suratTawaran->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <p>
                                    <span style="float: right">
                                        Ruj. Kami : KPT.BKOKU-xxxxxxxxx<br>
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
                                <div class="col-md-12 fv-row">
                                    <h4><input class="form-control form-control-solid" type="text" id="tajuk" name="tajuk" value="{{ strtoupper($suratTawaran->tajuk) }}"></h4>
                                </div>
                                <br>
                                <div class="col-md-12 fv-row">
                                    <textarea class="form-control form-control-solid" name="tujuan" id="tujuan">{{$suratTawaran->tujuan}}</textarea>
                                </div>
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
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">2. Bantuan ini berkuatkuasa mulai <b>xxxxxxxxx hingga xxxxxxxxx.</label>
                                        <textarea class="form-control form-control-solid" name="kandungan1" id="kandungan1">{{$suratTawaran->kandungan1}}</textarea>
                                    </div>
                                    <br>
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">3.</label>
                                        <textarea class="form-control form-control-solid" name="kandungan2" id="kandungan2">{{$suratTawaran->kandungan2}}</textarea>
                                    </div>
                                    <br>
                                    <div class="col-md-12 fv-row">
                                        <label class="fs-6 fw-semibold mb-2">4.</label>
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
                                    <input class="form-control" type="text" id="penutup3_2" name="penutup3_2" style="font-weight:bold" value="{{$suratTawaran->penutup3_2}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup3_3" name="penutup3_3" style="font-weight:bold" value="{{$suratTawaran->penutup3_3}}">
                                </div>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup3_4" name="penutup3_4" style="font-weight:bold" value="{{$suratTawaran->penutup3_4}}">
                                </div>
                                <br><br>

                                <p><div style="text-align: center;">"Nota: Surat ini adalah cetakan komputer dan tandatangan tidak diperlukan."</div></p>

                                <p>s.k : </p>
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup4_1" name="penutup4_1" style="font-weight:bold" value="{{$suratTawaran->penutup4_1}}">
                                </div> 
                                <div class="col-md-5 fv-row">
                                    <input class="form-control" type="text" id="penutup4_2" name="penutup4_2" style="font-weight:bold" value="{{$suratTawaran->penutup4_2}}">
                                </div>
                                
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