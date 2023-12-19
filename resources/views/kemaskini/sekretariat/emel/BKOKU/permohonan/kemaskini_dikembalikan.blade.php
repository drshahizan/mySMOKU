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
        .my-btn{
            width:100px!important;
        }
        .bi-eye-fill{
            color: black!important;
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
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
            <br>
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Emel Permohonan Dikembalikan</b></li>
                            </ul>
                            <div class="ml-auto">
                                <a href="{{url('kemaskini/sekretariat/emel/papar-emel/'.$emel->id)}}" target="_blank">
                                    <button type="button" class="btn btn-sm my-btn btn-default" title="Print"><i class="bi bi-eye-fill">&nbsp;&nbsp;Lihat Sini</i></button>
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <form method="POST" action="{{ url('kemaskini/sekretariat/emel/kemaskini/'.$emel->id) }}">
                                    {{csrf_field()}}
                                    <div class="table-responsive">
                                        <table class="maklumat2">
                                            <tr>
                                                <td class="vertical-top w-13">Subjek</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><input type="text" class="form-control" id="subjek" name="subjek" value="{{$emel->subjek}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Pendahuluan</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><textarea style="white-space: pre-line" name="pendahuluan" id="pendahuluan" cols="30" rows="3" class="form-control" value="{{$emel->pendahuluan}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required>{{$emel->pendahuluan}}</textarea></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Isi Kandungan 1</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><textarea name="isi_kandungan1" id="isi_kandungan1" cols="30" rows="3" class="form-control" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required>{{$emel->isi_kandungan1}}</textarea></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Isi Kandungan 2</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top"><textarea name="isi_kandungan2" id="isi_kandungan2" cols="30" rows="3" class="form-control" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required>{{$emel->isi_kandungan2}}</textarea></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Penutup</td>
                                                <td class="vertical-top v">:</td>
                                                <td class="vertical-top"><textarea name="penutup" id="penutup" cols="30" rows="3" class="form-control" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required>{{$emel->penutup}}</textarea></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Disediakan Oleh:</td>
                                                <td class="vertical-top v">:</td>
                                                <td class="vertical-top"><textarea name="d_oleh" id="d_oleh" cols="30" rows="3" class="form-control" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required>{{$emel->disediakan_oleh}}</textarea></td>
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
        @if(session('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
</x-default-layout>
