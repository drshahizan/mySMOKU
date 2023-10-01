<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">

        <style>
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
                            <div class="header">
                                <h2>Kemaskini Surat Tawaran<br><small>Kemaskini maklumat dalam surat tawaran untuk dihantarkan kepada pemohon.</small></h2>
                            </div>

                            <div class="card-body" style="padding: 0px 10px 20px 10px;">
                                <form action="{{ route('preview', ['suratTawaranId' => $suratTawaran->id]) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <table>
                                        <tr>
                                            <td><b>No. Rujukan</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="noRujukan" name="noRujukan" style="width: 100%" value="{{$suratTawaran->no_rujukan}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tajuk</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="tajuk" name="tajuk" style="width: 100%" value="{{$suratTawaran->tajuk}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tujuan</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan1" id="kandungan1" cols="120" rows="2">{{$suratTawaran->tujuan}}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Isi Kandungan 1</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan1" id="kandungan1" cols="120" rows="5">{{$suratTawaran->kandungan1}}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Isi Kandungan 2</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan2" id="kandungan2" cols="120" rows="5">{{$suratTawaran->kandungan2}}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Isi Kandungan 3</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan3" id="kandungan3" cols="120" rows="5">{{$suratTawaran->kandungan3}}</textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 1</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup1" name="penutup1" style="width: 100%" value="{{$suratTawaran->penutup1}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 2</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup2" name="penutup2" style="width: 100%" value="{{$suratTawaran->penutup2}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 3.1</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup3_1" name="penutup3_1" style="width: 100%" value="{{$suratTawaran->penutup3_1}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 3.2</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup3_2" name="penutup3_2" style="width: 100%" value="{{$suratTawaran->penutup3_2}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 3.3</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup3_3" name="penutup3_3" style="width: 100%" value="{{$suratTawaran->penutup3_3}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 3.4</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup3_4" name="penutup3_4" style="width: 100%" value="{{$suratTawaran->penutup3_4}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 4.1</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup4_1" name="penutup4_1" style="width: 100%" value="{{$suratTawaran->penutup4_1}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 4.2</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup4_2" name="penutup4_2" style="width: 100%" value="{{$suratTawaran->penutup4_2}}"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 4.3</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup4_3" name="penutup4_3" style="width: 100%" value="{{$suratTawaran->penutup4_3}}"></td>
                                        </tr>
                                    </table>

                                    <div class="d-flex flex-center mt-5">
                                        <button type="submit" class="btn btn-primary btn-sm">Preview Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-default-layout> 