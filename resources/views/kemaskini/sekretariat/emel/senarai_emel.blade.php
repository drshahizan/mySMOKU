<x-default-layout>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
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
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Permohonan Dikembalikan</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tuntutan Dikembalikan</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fas fa-user-check text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tuntutan Layak</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tuntutan Tidak Layak</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
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
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #787878">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fas fa-list-ol text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Permohonan Dikembalikan</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body" style="background-color: #186ee6">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fa-solid fa-file-circle-plus text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tuntutan Dikembalikan</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-success">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fas fa-user-check text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tuntutan Layak</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-3">
                                    <!--begin::Items-->
                                    <div class="px-6 pt-5 card-rounded h-150px w-100 card theme-dark-bg-body bg-danger">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-30px me-0 mb-5">
                                            {{-- <span class="symbol-label"> --}}
                                            <i class="fa-solid fa-user-xmark text-light" style="font-size: 20px;">
                                                <span class="fw-semibold me-1 align-self-center" style="padding-bottom: 5px; padding-left:5px; font-family:sans-serif;">Tuntutan Tidak Layak</span>
                                            </i>
                                            {{-- </span> --}}
                                        </div>
                                        <!--end::Symbol-->
                                    </div>
                                    <!--end::Items-->
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
