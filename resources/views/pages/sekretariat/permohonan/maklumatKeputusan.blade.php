<x-default-layout> 
    <head>
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
                                <div class="d-flex align-items-center">
                                    <img class="img" src="https://www.shareicon.net/data/128x128/2016/05/24/770085_man_512x512.png" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="w35 h35 rounded" data-original-title="Avatar Name">
                                    <div class="ml-2" style="padding-top: 10px;">
                                        Mohd Ali Bin Abu Kassim
                                        <p class="mb-0">ali12@graduate.utm.my</p>
                                    </div>
                                </div>

                                <hr><br>

                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6">
                                        <p><strong>ID Permohonan: </strong> KPTBKOKU/4/970703041223</p>
                                        <p><strong>Tarikh Permohonan: </strong> 06/08/2023 </p>
                                        <p><strong>Status Permohonan: </strong> Disokong</p>                                    
                                    </div>
                                </div>

                            <div class="col-md-6 col-sm-6">
                                <form action="{{ url('hantar-keputusan') }}" method="POST">
                                    {{csrf_field()}}
                                    {{-- Kelulusan --}}
                                    <label for="noMesyuarat"><b>No. Mesyuarat:</b></label>
                                        <input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; margin-right:50px;">
                                    <label for="tarikh"><b>Tarikh Mesyuarat:</b></label>
                                        <input type="date" id="tarikh" name="tarikh" style="padding: 5px;"><br><br>
                                    <label><b>Pilih Keputusan: </b></label>
                                        <select id="keputusan" onchange="select1()" style="padding: 5px;">
                                                <option value="">Pilih Keputusan</option>
                                                <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                                <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                        </select>
                                    <br><br>
                                    <label for="tarikh"><b>Catatan:</b></label>
                                        <input type="text" id="catatan" name="noMesyuarat" style="padding: 5px; width:500px;">
                                    <br><br>

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