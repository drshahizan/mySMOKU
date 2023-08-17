<x-default-layout> 
    <head>
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
        <style>
            table, tr, td{
                border: none!important;
            }
        </style>
    </head>
    
    <body>
    <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="row clearfix">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-sm navbar-light bg-light page_menu">
                            <h2 style="padding-top: 5px;"><b>Rekod Keputusan Permohonan</b></h2>
                            {{-- <div class="ml-auto" style="color:black;">
                                <a href="{{ url('surat-tawaran') }}" target="_blank" class="btn btn-secondary btn-round btn-sm"><i class="fa fa-download"></i> Surat Tawaran</a>
                            </div> --}}
                        </nav>
                    </div>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6">
                                        <br>
                                        <table class="pemohon">
                                            <tr>
                                                <td><strong>Nama </strong></td>
                                                <td><b>:</b></td>
                                                <td>Mohd Ali Bin Abu Kassim</td>
                                            </tr>
                                            <tr>
                                                <td><strong>No. Kad Pengenalan </strong></td>
                                                <td><b>:</b></td>
                                                <td>970703041223</td>
                                            </tr>
                                            <tr>
                                                <td><strong>ID Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>KPTBKOKU/4/970703041223</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tarikh Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>06/08/2023</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>Disokong</td>
                                            </tr>
                                        </table>
                                        <p><strong> </strong>  </p>
                                        <p><strong> </strong> </p>                                    
                                    </div>
                                </div>
                            
                                <hr><br>

                                <div class="col-md-6 col-sm-6">
                                    <form action="{{ url('hantar-keputusan') }}" method="POST">
                                        {{csrf_field()}}
                                        <table>
                                            <tr>
                                                <td><b>No. Mesyuarat</b></td>
                                                <td><b>:</b></td>
                                                <td><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; margin-right:50px;" required></td>
                                            </tr>
                                            <tr>
                                                <td><b>Tarikh Mesyuarat</b></td>
                                                <td><b>:</b></td>
                                                <td><input type="date" id="tarikh" name="tarikh" style="padding: 5px;" required></td>
                                            </tr>
                                            <tr>
                                                <td><b>Keputusan</b></td>
                                                <td><b>:</b></td>
                                                <td>
                                                    <select id="keputusan" id="keputusan" style="padding: 5px;" required>
                                                        <option value="">Pilih Keputusan</option>
                                                        <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                        <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Catatan</b></td>
                                                <td><b>:</b></td>
                                                <td><input type="text" id="catatan" name="noMesyuarat" style="padding: 5px; width:500px;"></td>
                                            </tr>
                                        </table>
                                        <br>
                                        <div class="submit" style="text-align: right;">
                                            <button type="submit" id="submit" class="btn btn-primary text-white">Hantar</button>
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
            // input validation
            var btn = document.getElementById('submit');
            btn.addEventListener('click', function() {
                if (document.getElementById('noMesyuarat').checked||document.getElementById('checkbox2b').checked||document.getElementById('checkbox2c').checked||document.getElementById('checkbox2d').checked) {
                    document.getElementById("noMesyuarat").required = false;
                }
                else{
                    document.getElementById("noMesyuarat").required = true;
                }

                if (document.getElementById('tarikh').checked||document.getElementById('checkbox3b').checked||document.getElementById('checkbox3c').checked||document.getElementById('checkbox3d').checked) {
                    document.getElementById("tarikh").required = false;
                }
                else{
                    document.getElementById("tarikh").required = true;
                }
                if (document.getElementById('keputusan').checked||document.getElementById('checkbox3b').checked||document.getElementById('checkbox3c').checked||document.getElementById('checkbox3d').checked) {
                    document.getElementById("keputusan").required = false;
                }
                else{
                    document.getElementById("keputusan").required = true;
                }
            })      

            // sweet alert
            $(btn).ready(function() {
                alertify.set('notifier','position', 'top-center');
                alertify.success('Emel notifikasi telah dihantar kepada pemohon');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name+"csrf-token"]').attr('content')
                    }
                });
            });
        </script>
       {{-- <script>
        @if(session('status'))
            alert('{{session('status')}}');
            swal({
                title: "Emel notifikasi telah dihantar ke pemohon.",
                text: "Klik OK untuk teruskan!",
                icon: "success",
                button: "OK",
            });
       </script> --}}

       <!-- Javascript -->
       <script src="assets/bundles/libscripts.bundle.js"></script>    
       <script src="assets/bundles/vendorscripts.bundle.js"></script>
       <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    </body>
</x-default-layout> 