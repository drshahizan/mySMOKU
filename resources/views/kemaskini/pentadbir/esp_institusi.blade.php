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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kod ESP</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Institusi Pengajian</li>
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
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Maklumat Institusi Pengajian</b></li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="body" style="padding: 20px;">
                            <div class="col-md-6 col-sm-6">
                                <br>
                                <form method="POST" action="{{route('kemaskini.esp')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="table-responsive">
                                        <table class="maklumat">
                                            <tr>
                                                <td class="vertical-top w-13">Nama Institusi</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <div class="form-control-arrow">
                                                        <select name="kod_bank" class="form-control search" data-control="select2" data-hide-search="true" data-placeholder="Pilih Bank">
                                                            <option value="">Pilih Bank</option>
                                                            @foreach ($institusi->sortBy('nama_institusi') as $nama)
                                                                <option value="{{ $nama->nama_institusi }}">
                                                                    {{ $nama->nama_bank }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top w-13">Kod ESP</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <input type="number" class="form-control" id="no_acc" name="no_acc" value="{{$institusi->institusi_esp ?? ''}}" oninvalid="this.setCustomValidity('Sila isi ruang ini dengan nombor akaun bank institusi anda.')" oninput="setCustomValidity('')" required>
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
