<x-default-layout>
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <style>
        .maklumat2{
            width: 100%!important;
            border: none!important;
        }
        .w-13{
            width: 13% !important;
        }
        .w-3{
            width: 3% !important;
        }
        .maklumat2 td{
            padding: 5px!important;
            border: none!important;
        }
        .white{
            color: white!important;
        }
        input, textarea{
            width: 90%!important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        button{
            margin: 5px;
            width:150px!important;
        }
        .vertical-top{
            vertical-align: top!important;
        }
    </style>

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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Emel</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">BKOKU</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Dikembalikan</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <br>
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Emel Tuntutan Dikembalikan</b></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <form>
                                    <div class="table-responsive">
                                        <table class="maklumat2">
                                            <tr>
                                                <td class="vertical-top w-13">Subjek</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><input type="number" class="form-control" id="jumlah_disokong_ppk" name="jumlah_disokong" value="" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Pendahuluan</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Isi Kandungan</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Penutup</td>
                                                <td class="vertical-top v">:</td>
                                                <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3" class="form-control"></textarea></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary theme-bg gradient action-btn" value="Kemaskini" id="check">Kemaskini</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-default-layout>
