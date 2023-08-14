<x-default-layout> 
    <head>
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                                                <td><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; margin-right:50px;"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Tarikh Mesyuarat</b></td>
                                                <td><b>:</b></td>
                                                <td><input type="date" id="tarikh" name="tarikh" style="padding: 5px;"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Pilih Keputusan</b></td>
                                                <td><b>:</b></td>
                                                <td>
                                                    <select id="keputusan" onchange="select1()" style="padding: 5px;">
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
                                            <a href="{{url('keputusan')}}" target="_blank" class="btn btn-primary float-end">
                                                <span>Hantar</span>
                                            </a>
                                            {{-- <button type="submit" id="submitForm" onclick="my_button_click_handler" class="btn btn-primary text-white">Hantar</button> --}}
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
            function confirmButton() {
                confirm("Press a button!");
            }
            function my_button_click_handler(){
                alert('Emel notifikasi telah dihantar ke pemohon.');
            }
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
    </body>
</x-default-layout> 