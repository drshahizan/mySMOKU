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

        <style>
            .nav{
                margin-left: 20px!important;
            }
        </style>
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Maklumat Pelajar</li>
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
                    <div class="card align-items-center">
                        <div class="tab-content" id="myTabContent">
							<!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Row-->
                                <div class="row align-items-center">
                                    {{-- Form 1: Semak Pelajar --}}
                                    <form action="{{ route('kemaskini.sekretariat.pelajar.semak') }}" method="POST">
                                        @csrf
                                        <div class="text-center mb-4">
                                            <h2>Semak No. Kad Pengenalan Pelajar</h2>
                                            <input type="text" name="no_kp" maxlength="12" class="form-control text-center mx-auto" style="max-width: 300px;" placeholder="No Kad Pengenalan">
                                            <button type="submit" class="btn btn-primary mt-3">Semak</button>
                                        </div>
                                    </form>

                                    {{-- Form 2: Kemaskini Pelajar --}}
                                    @isset($akaun_pelajar)
                                    <form action="{{ route('kemaskini.sekretariat.pelajar.update', $akaun_pelajar->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="text-center mt-5">
                                            <h4>Kemaskini Maklumat Pelajar</h4>

                                            <input type="text" name="nama" class="form-control mb-3 mx-auto" value="{{ $akaun_pelajar->nama }}" placeholder="Nama" style="max-width: 400px;">
                                            <input type="text" name="no_kp" class="form-control mb-3 mx-auto" value="{{ $akaun_pelajar->no_kp }}" readonly style="max-width: 400px;">
                                            <input type="email" name="email" class="form-control mb-3 mx-auto" value="{{ $akaun_pelajar->email }}" placeholder="E-mel" style="max-width: 400px;">

                                            <div class="d-flex mb-3" style="max-width: 400px; margin: 0 auto;">
                                                <input type="datetime-local" name="email_verified_at"
                                                    class="form-control"
                                                    value="{{ $akaun_pelajar->email_verified_at ? $akaun_pelajar->email_verified_at->format('Y-m-d\TH:i') : '' }}"
                                                    style="flex: 1;">

                                                @if (is_null($akaun_pelajar->email_verified_at))
                                                    <span class="text-danger ms-12" style="font-size: 1.0rem; white-space: nowrap; align-self: center;">
                                                        * Tiada Pengesahan E-mel
                                                    </span>
                                                @endif
                                            </div>

                                            <button type="submit" class="btn btn-warning">Kemaskini</button>
                                        </div>

                                    </form>
                                    @endisset

                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: ' {!! session('success') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

</x-default-layout>
