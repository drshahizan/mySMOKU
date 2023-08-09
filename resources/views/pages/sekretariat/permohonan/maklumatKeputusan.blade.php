<x-default-layout> 
    <link rel="stylesheet" href="assets/css/sekretariat.css">
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-sm navbar-light bg-light page_menu">
                        <div class="header">
                            <h2><b>Rekod Keputusan Permohonan</b></h2>
                        </div>

                        {{-- <div class="ml-auto" style="color:black;">
                            <a href="{{ url('suratTawaran') }}" target="_blank" class="btn btn-secondary btn-round btn-sm"><i class="fa fa-download"></i> Surat Tawaran</a>
                        </div> --}}
                    </nav>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                            <div class="d-flex align-items-center">
                                <img class="img" src="https://www.shareicon.net/data/128x128/2016/05/24/770085_man_512x512.png" data-toggle="tooltip" data-placement="top" title="" alt="Avatar" class="w35 h35 rounded" data-original-title="Avatar Name">
                                <div class="ml-2" style="padding-top: 10px;">
                                    Ali Bin Abu
                                    <p class="mb-0">alibinabu@graduate.utm.my</p>
                                </div>
                            </div>

                            <hr><br>

                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <p><strong>ID Permohonan: </strong> KPTBKOKUD020223015001</p>
                                    <p><strong>Tarikh Permohonan: </strong> 02/07/2023 </p>
                                    <p><strong>Status Permohonan: </strong> Disokong</p>                                    
                                </div>
                            </div>

                           <div class="col-md-6 col-sm-6">
                            <form action="#" method="POST">
                                {{-- Kelulusan --}}
                                <label for="noMesyuarat"><b>No. Mesyuarat:</b></label>
                                    <input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; margin-right:50px;">
                                <label for="tarikh"><b>Tarikh Mesyuarat:</b></label>
                                    <input type="date" id="tarikh" name="tarikh" style="padding: 5px;"><br><br>
                                <label><b>Pilih Keputusan: </b></label>
                                    <select id="keputusan" style="padding: 5px;">
                                            <option value="">Pilih Keputusan</option>
                                            <option value="Lulus" {{Request::get('status') == 'Lulus' ? 'selected':'' }} >Lulus</option>
                                            <option value="Tidak Lulus" {{Request::get('status') == 'Tidak Lulus' ? 'selected':'' }} >Tidak Lulus</option>
                                    </select>
                                <br><br>
                                <label for="tarikh"><b>Catatan:</b></label>
                                    <input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; width:500px;">
                                    {{-- <textarea id="catatan" name="catatan" rows="2" cols="50"></textarea> --}}

                                <br><br>
                                <div class="submit" style="text-align: right;">
                                    <button type="submit" class="btn btn-primary text-white">Hantar</button>
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
   </script>
</x-default-layout> 