<x-default-layout>
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <style>
        .maklumat{
            width: 100%!important;
            border: none!important;
        }
        .w-13{
            width: 17% !important;
        }
        .w-3{
            width: 3% !important;
        }
        .maklumat td{
            padding: 5px!important;
            border: none!important;
        }
        .white{
            color: white!important;
        }
        input{
            width: 80%!important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Bank</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <div id="main-content" style="width:80%;  margin: 0 auto;">
        <div class="container-fluid">
            <!-- Page header section  -->
            <br>
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Bank Universiti</b></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <form method="POST" action="#">
                                    {{csrf_field()}}
                                    <div class="table-responsive">
                                        <table class="maklumat">
                                            <tr>
                                                <td class="vertical-top w-13">Nama Institusi</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><input type="text" class="form-control" id="nama_institusi" name="nama_institusi" value="" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Nama Akaun Bank</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><input type="text" class="form-control" id="nama_bank" name="nama_bank" value="" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">No. Akaun</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><input type="text" class="form-control" id="no_acc" name="no_acc" value="" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                        </table>
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
        </div>
    </div>

</x-default-layout>
