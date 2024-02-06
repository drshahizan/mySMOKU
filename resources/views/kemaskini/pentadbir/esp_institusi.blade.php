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

    <div id="main-content" style="width:70%;  margin: 0 auto; margin-top: 30px;">
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
                        <div class="body" style="padding: 15px;">
                            <div class="col-md-6 col-sm-6">
                               <!-- Inside your blade file -->
                                <form method="POST" action="{{route('kemaskini.esp')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="table-responsive">
                                        <table class="maklumat">
                                            <tr>
                                                <td class="vertical-top w-13">Nama Institusi</td>
                                                <td class="vertical-top w-3">:</td>
                                                <td class="vertical-top">
                                                    <div class="form-control-arrow">
                                                        <select name="nama_institusi" id="nama_institusi" class="form-control search" data-control="select2" data-hide-search="true" data-placeholder="Pilih Institusi Pengajian">
                                                            <option value="">Pilih Institusi Pengajian</option>
                                                            @foreach ($institusi as $info)
                                                                <option value="{{ $info->nama_institusi }}">
                                                                    {{ $info->nama_institusi }}
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
                                                    <input type="text" class="form-control" id="institusi_esp" name="institusi_esp" value="" oninvalid="this.setCustomValidity('Sila isi ruang ini dengan kod esp bagi institusi yang dipilih.')" oninput="setCustomValidity('')" required>
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

    <script> 
        $(document).ready(function() {
            $('.search').select2();
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM content loaded');
            var namaInstitusiSelect = document.getElementById('nama_institusi');
            var institusiEspInput = document.getElementById('institusi_esp');
    
            
            // Fetch institusi_esp when the page loads
            updateInstitusiEsp();
            console.log('Event listener attached');
    
            // Add event listener to the select dropdown for change event
            namaInstitusiSelect.addEventListener('change', function() {
                console.log('Dropdown selection changed');
                updateInstitusiEsp();
            });

            // Add event listener to the select dropdown for click event
            namaInstitusiSelect.addEventListener('click', function() {
                console.log('Dropdown clicked');
            });

    
            function updateInstitusiEsp() {
                var selectedNamaInstitusi = namaInstitusiSelect.value;
    
                // Make AJAX request to fetch institusi_esp
                $.ajax({
                    url: '/fetch-institusi-esp',
                    method: 'GET',
                    data: {
                        nama_institusi: selectedNamaInstitusi
                    },
                    success: function(response) {
                        institusiEspInput.value = response.institusi_esp || ''; // Use empty string if institusi_esp is undefined
                    },
                    error: function(xhr) {
                        console.error(xhr);
                        institusiEspInput.value = 'Error fetching data';
                    }
                });
            }
        });
    </script>    
</x-default-layout>
