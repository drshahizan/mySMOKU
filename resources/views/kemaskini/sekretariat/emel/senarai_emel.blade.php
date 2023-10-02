<x-default-layout>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    </head>


    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark" style="color:darkblue">Emel</li>
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <br>

    {{-- Body Content --}}
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row clearfix">
                    <div class="card">
                        <div class="header">
                            <h2>Kategori BKOKU</h2>
                        </div>
                        <div class="body">
                            <!--begin::First Row-->
                            <div class="row g-3 g-lg-6" style="text-align: center;">
                                <!--begin::Col-->
                                <div class="col-3">
                                    <a href="{{url('kemaskini/sekretariat/emel/BKOKU/permohonan/kemaskini-dikembalikan')}}">
                                        <!--begin::Items-->
                                        <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-orange">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px me-0 mb-5 justify-content-center align-items-center">
                                                {{-- <p class="symbol-label"> --}}
                                                <i class="fa-solid fa-reply text-light" style="font-size: 35px;"></i><br><br>
                                                <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px;">Permohonan Dikembalikan</p>
                                                {{-- </p> --}}
                                            </div>
                                            <!--end::Symbol-->
                                        </div>
                                        <!--end::Items-->
                                    </a>
                                </div>
                                <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-3">

                                        <a href="{{url('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-dikembalikan')}}">
                                            <!--begin::Items-->
                                            <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-dikembalikan">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-0 mb-5">
                                                    {{-- <p class="symbol-label"> --}}
                                                    <i class="fa-solid fa-reply-all text-light" style="font-size: 35px;"></i><br><br>
                                                    <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px;">Tuntutan Dikembalikan</p>
                                                    {{-- </p> --}}
                                                </div>
                                                <!--end::Symbol-->
                                            </div>
                                            <!--end::Items-->
                                        </a>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-3">
                                        <a href="{{url('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-layak')}}">
                                            <!--begin::Items-->
                                            <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px me-0 mb-5">
                                                    {{-- <p class="symbol-label"> --}}
                                                    <i class="fas fa-user-check text-light" style="font-size: 35px;"></i><br><br>
                                                    <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px;">Tuntutan Layak</p>
                                                    {{-- </p> --}}
                                                </div>
                                                <!--end::Symbol-->
                                            </div>
                                            <!--end::Items-->
                                        </a>
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-3">
                                        <a href="{{url('kemaskini/sekretariat/emel/BKOKU/tuntutan/kemaskini-tidak-layak')}}">
                                        <!--begin::Items-->
                                        <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-30px me-0 mb-5">
                                                {{-- <p class="symbol-label"> --}}
                                                <i class="fa-solid fa-user-xmark text-light" style="font-size: 35px;"></i><br><br>
                                                <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px; ">Tuntutan Tidak Layak</p>
                                                {{-- </p> --}}
                                            </div>
                                            <!--end::Symbol-->
                                        </div>
                                        <!--end::Items-->
                                        </a>
                                    </div>
                                    <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>

                        {{-- PPK --}}
                        <div class="header">
                            <h2>Kategori PPK</h2>
                        </div>
                        <div class="body">
                            <!--begin::First Row-->
                            <div class="row g-3 g-lg-6" style="text-align: center;">
                                <!--begin::Col-->
                                <div class="col-3">
                                    <a href="{{url('kemaskini/sekretariat/emel/PPK/permohonan/kemaskini-dikembalikan')}}">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-orange">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <p class="symbol-label"> --}}
                                            <i class="fa-solid fa-reply text-light" style="font-size: 35px;"></i><br><br>
                                            <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px; ">Permohonan Dikembalikan</p>
                                            {{-- </p> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                    </a>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <a href="{{url('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-dikembalikan')}}">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-dikembalikan">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <p class="symbol-label"> --}}
                                            <i class="fa-solid fa-reply-all text-light" style="font-size: 35px;"></i><br><br>
                                            <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px; ">Tuntutan Dikembalikan</p>
                                            {{-- </p> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                    </a>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <a href="{{url('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-dikembalikan')}}">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <p class="symbol-label"> --}}
                                            <i class="fas fa-user-check text-light" style="font-size: 35px;"></i><br><br>
                                            <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px; ">Tuntutan Layak</p>
                                            {{-- </p> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                    </a>
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <a href="{{url('kemaskini/sekretariat/emel/PPK/tuntutan/kemaskini-dikembalikan')}}">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <p class="symbol-label"> --}}
                                            <i class="fa-solid fa-user-xmark text-light" style="font-size: 35px;"></i><br><br>
                                            <p class="fw-semibold me-1 align-self-center text-light" style="padding-bottom: 5px; padding-left:5px; font-size: 14px; ">Tuntutan Tidak Layak</p>
                                            {{-- </p> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                    </a>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-default-layout>
