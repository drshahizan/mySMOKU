<x-default-layout>
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    <style>
        .maklumat{
            width: 100%!important;
            border: none!important;
        }
        .w-13{
            width: 20% !important;
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
            width: 100%!important;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .vertical-top{
            vertical-align: top!important;
        }
        .form-control-arrow {
            position: relative;
            width: 100%; 
        }
        .form-control-arrow::after {
            content: '\25BC'; /* Unicode character for a black down-pointing triangle */
            position: absolute;
            top: 50%;
            right: 20px; 
            transform: translateY(-50%);
            pointer-events: none; 
        }
        .file-input {
            display: flex;
            align-items: center;
        }

        .file-input input {
            flex: 1; /* Take up remaining space */
        }

        .file-input a {
            width: 60%; /* Set the width of the link to 50% of the column */
            text-overflow: ellipsis; /* Add ellipsis for long file names */
            white-space: nowrap;
            overflow: hidden;
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
            @if(session('success'))
                <div class="alert alert-success" style="color:black; width: 50%; margin: 0 auto; text-align:center;">
                    {{ session('success') }}
                </div>
                <br>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" style="color:black; width: 50%; margin: 0 auto;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                <br>
            @endif

            <!-- Page header section  -->
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
                        <div class="body" style="padding: 20px;">
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <form method="POST" action="{{route('kemaskini.bank', ['id' => $user->id_institusi ])}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="table-responsive">
                                        @php
                                            $id_uni = $user->id_institusi;
                                            $nama_uni = DB::table('bk_info_institusi')->where('id_institusi', $id_uni)->value('nama_institusi');
                                        @endphp
                                        <table class="maklumat">
                                            <tr>
                                                <td class="vertical-top w-13">Nama Institusi</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" value="{{$nama_uni}}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Nama Akaun Bank</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <input type="text" class="form-control" id="nama_bank" name="nama_bank" value="{{$bank->nama_akaun ?? ''}}" oninvalid="this.setCustomValidity('Sila isi ruang ini dengan nama akaun bank institusi anda.')" oninput="setCustomValidity('')" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Bank</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <div class="form-control-arrow">
                                                        <select name="kod_bank" class="form-control search" data-control="select2" data-hide-search="true" data-placeholder="Pilih Bank">
                                                            <option value="">Pilih Bank</option>
                                                            @foreach ($senarai_bank->sortBy('nama_bank') as $senaraiBank)
                                                                <option value="{{ $senaraiBank->kod_bank }}" {{ old('kod_bank', optional($bank)->bank_id) == $senaraiBank->kod_bank ? 'selected' : '' }}>
                                                                    {{ $senaraiBank->nama_bank }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">No. Akaun Bank</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <input type="number" class="form-control" id="no_acc" name="no_acc" value="{{$bank->no_akaun ?? ''}}" oninvalid="this.setCustomValidity('Sila isi ruang ini dengan nombor akaun bank institusi anda.')" oninput="setCustomValidity('')" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Penyata Bank</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <div class="file-input">
                                                        <input type="file" name="penyata"/>
                                                        @if(isset($bank->penyata_bank) && !empty($bank->penyata_bank))
                                                            <a href="{{ asset('assets/dokumen/penyata_bank_islam/' . $bank->penyata_bank) }}" target="_blank">{{ $bank->penyata_bank }}</a>
                                                        @endif
                                                    </div>
                                                    <small style="font-size: 10px; font-style:italic; color: red!important;">**Format fail yang boleh dimuat naik adalah '.pdf' dan '.png' sahaja.</small>
                                                </td>                                                
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="d-flex flex-center mt-5">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if(session('notifikasi'))
            Swal.fire({
                icon: 'warning',
                title: 'Maklumat Bank',
                text: ' {!! session('notifikasi') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script> 
        $(document).ready(function() {
            $('.search').select2();
        });
    </script>    
</x-default-layout>
