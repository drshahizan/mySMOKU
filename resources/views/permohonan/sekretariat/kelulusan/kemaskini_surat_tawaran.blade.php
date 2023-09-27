<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/sekretariat.css">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

        {{-- JAVASCRIPT --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

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
                                <h2>Surat Tawaran<br><small>Kemaskini maklumat dalam surat tawaran untuk dihantarkan kepada pemohon.</small></h2>
                            </div>

                            <div class="card-body" style="padding: 0px 10px 20px 10px;">
                                <form action="{{ route('save') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <table>
                                        <tr>
                                            <td><b>Nama</b></td>
                                            <td><b>:</b></td>
                                            <td>SOFEA AINA BINTI MUHAMMAD AMIR</td>
                                        </tr>
                                        <tr>
                                            <td><b>No. Kad Pengenalan</b></td>
                                            <td><b>:</b></td>
                                            <td>950623031212</td>
                                        </tr>
                                        <tr>
                                            <td><b>Alamat</b></td>
                                            <td><b>:</b></td>
                                            <td>B 8/5/4 KUARTERS PDRM FLAT PADANG, HILIRAN 21100 KUALA TERENGGANU,TERENGGANU</td>
                                        </tr>
                                        <tr>
                                            <td><b>No. Rujukan</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="noRujukan" name="noRujukan" style="width: 100%"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tajuk</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="noRujukan" name="noRujukan" style="width: 100%"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Isi Kandungan 1</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan1" id="kandungan1" cols="120" rows="5"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Isi Kandungan 2</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan2" id="kandungan2" cols="120" rows="5"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Isi Kandungan 3</b></td>
                                            <td><b>:</b></td>
                                            <td><textarea name="kandungan3" id="kandungan3" cols="120" rows="5"></textarea></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 1</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup1" name="penutup1" style="width: 100%"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 2</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup2" name="penutup2" style="width: 100%"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Penutup 3</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="penutup3" name="penutup3" style="width: 100%"></td>
                                        </tr>
                                    </table>

                                    <div class="d-flex flex-center mt-5">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Hantar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            //sorting function
            $('#sortTable1').DataTable();
            $('#sortTable2').DataTable();

            // check all checkboxes at once
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[name="selected_items[]"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        </script>
        
        <!-- Vedor js file and create bundle with grunt  --> 
        <script src="assets/bundles/flotscripts.bundle.js"></script><!-- flot charts Plugin Js -->
        <script src="assets/bundles/c3.bundle.js"></script>
        <script src="assets/bundles/apexcharts.bundle.js"></script>
        <script src="assets/bundles/jvectormap.bundle.js"></script>
        <script src="assets/vendor/toastr/toastr.js"></script>
        
        <!-- Project core js file minify with grunt --> 
        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script src="../js/index.js"></script>
        
        <!-- Vedor js file and create bundle with grunt  --> 
        <script src="assets/bundles/morrisscripts.bundle.js"></script><!-- Morris Plugin Js -->
        
        <!-- Vedor js file and create bundle with grunt  -->    
        <script src="assets/bundles/datatablescripts.bundle.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
        <script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
        <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

        <!-- SweetAlert Plugin Js --> 
        <script src="../js/pages/forms/form-wizard.js"></script>
        <script src="../js/pages/tables/jquery-datatable.js"></script>
        <script src="../js/pages/charts/morris.js"></script>
        <script src="../js/pages/charts/c3.js"></script>

        <!-- Javascript -->
        <script src="assets/bundles/libscripts.bundle.js"></script>    
        <script src="assets/bundles/vendorscripts.bundle.js"></script>
        <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

        <!-- Bootstrap --> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </body>
</x-default-layout> 