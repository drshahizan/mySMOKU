<x-default-layout> 
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <style>
        .maklumat, .maklumat td{
            border: none!important;
            padding:2px 8px!important;
        }
        .maklumat2, .maklumat2 td{
            border: none!important;
        }
        .table{
            table-layout: fixed;
            width: 75%;
        }
        select{
            padding: 3px 6px!important;
            border: 1px solid #ccc!important;
            border-radius: 6px!important;
            font-size: 13px!important;
        }
        .small-td{
            width: 11%;
        }
        .table td, .table th, .table2 td, .table2 th{
            padding: 7px!important;
        }
        .white{
            color: white!important;
        }
        input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number]{
            width: 70px;
            text-align: right;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 2px 5px;
            font-size: 13px!important;
        }
        .bold{
            font-weight: bold!important;
        }
        .space{
            width: 15%;
        }
        .red-color{
            color: red!important;
        }
        button{
            margin: 5px;
            width:150px!important;
        }
    </style>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light page_menu">
                        <!--<a class="navbar-brand" href="#">M.</a>-->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars text-muted"></i>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item vivify swoopInTop delay-150 active"><b>Saring Tuntutan</b></li>
                            </ul>
                            {{-- <div class="ml-auto">
                                <a href="{{ url('cetak-maklumat-pemohon') }}" target="_blank" class="btn btn-primary">Cetak</a>
                            </div> --}}
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    @php
                                        $akademik = DB::table('maklumatakademik')->where('nokp_pelajar', $pelajar->nokp_pelajar)->first();
                                        $institusi = DB::table('bk_infoipt')->where('idipt', $akademik->id_institusi)->value('namaipt');
                                        $peringkat = DB::table('bk_peringkatpengajian')->where('kodperingkat', $akademik->peringkat_pengajian)->value('peringkat');
                                        // nama pemohon
                                        $text = ucwords(strtolower($pelajar->nama_pelajar)); // Assuming you're sending the text as a POST parameter
                                        $conjunctions = ['bin', 'binti', 'of', 'in', 'and'];
                                        $words = explode(' ', $text);
                                        $result = [];
                                        foreach ($words as $word) {
                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                $result[] = Str::lower($word);
                                            } else {
                                                $result[] = $word;
                                            }
                                        }
                                        $pemohon = implode(' ', $result);

                                        //nama kursus
                                        $text2 = ucwords(strtolower($akademik->nama_kursus)); // Assuming you're sending the text as a POST parameter
                                        $conjunctions = ['of', 'in', 'and'];
                                        $words = explode(' ', $text2);
                                        $result = [];
                                        foreach ($words as $word) {
                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                $result[] = Str::lower($word);
                                            } else {
                                                $result[] = $word;
                                            }
                                        }
                                        $kursus = implode(' ', $result);

                                        //institusi pengajian
                                        $text3 = ucwords(strtolower($institusi)); // Assuming you're sending the text as a POST parameter
                                        $conjunctions = ['of', 'in', 'and'];
                                        $words = explode(' ', $text3);
                                        $result = [];
                                        foreach ($words as $word) {
                                            if (in_array(Str::lower($word), $conjunctions)) {
                                                $result[] = Str::lower($word);
                                            } else {
                                                $result[] = $word;
                                            }
                                        }
                                        $institusi = implode(' ', $result);
                                    @endphp
                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>ID Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->id_permohonan}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Kursus</strong></td>
                                            <td>:</td>
                                            <td>{{$kursus}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pemohon}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Institusi</strong></td>
                                            <td>:</td>
                                            <td>{{$institusi}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>{{$pelajar->nokp_pelajar}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Peringkat</strong></td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($peringkat))}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarikh Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>{{$permohonan->created_at->format('d/m/Y')}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Sesi/Semester</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->sesi}}-0{{$akademik->sem_semasa}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Penajaan</strong></td>
                                            <td>:</td>
                                            @if($akademik->nama_penaja!=null)
                                                <td>Ditaja ({{$akademik->nama_penaja}})</td>
                                            @else
                                                <td>Tidak Ditaja</td>
                                            @endif
                                        </tr>
                                    </table>   
                                <hr>
                                <br>
                                <h6>Maklumat resit/invois:</h6>
                                <br>
                                <form method="POST" action="{{ url('saringan') }}" id="saring">

                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered mb-5">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th style="width: 5%; text-align:right;">No.</th>                                                        
                                                            <th style="width: 20%;">Item</th>
                                                            <th style="width: 25%;">Keputusan Saringan</th>
                                                            <th style="width: 50%;">Catatan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align:right;">1</td>
                                                            <td>
                                                                <span>Resit/Invois 1</span>
                                                            </td>           
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="maklumat_profil_diri" name="maklumat_profil_diri" class="form-control" onchange="select1()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Yuran Peperiksaan
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:right;">2</td>
                                                            <td>
                                                                <span>Resit/Invois 2</span>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="maklumat_akademik" name="maklumat_akademik" class="form-control" onchange="select2()"  oninvalid="this.setCustomValidity('Sila tandakan sekurang-kurangnya satu kotak')" oninput="setCustomValidity('')" required>
                                                                        {{-- oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')"  --}}
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Yuran Perkhidmatan
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:right;">3</td>
                                                            <td>
                                                                <span>Resit/Invois 3</span>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="maklumat_akademik" name="maklumat_akademik" class="form-control" onchange="select3()"  oninvalid="this.setCustomValidity('Sila tandakan sekurang-kurangnya satu kotak')" oninput="setCustomValidity('')" required>
                                                                        {{-- oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')"  --}}
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                Yuran Komputer
                                                            </td>
                                                        </tr>                                                
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Sejarah tuntutan:</h6>
                                    <br>
                                    <!--begin: Invoice body-->
                                    {{csrf_field()}}     
                                    @php
                                        $jumlah = 400;
                                        if($jumlah > 5000){
                                            $jumlah = 5000;
                                        }
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white small-td">Semester</th>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Tuntutan Yuran Pengajian (RM)</th>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Tuntutan Wang Saku (RM)</th>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Keseluruhan (RM)</th>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">1</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(1200, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(4*300, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(2400, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(2600, 2)}}</td>
                                                </tr>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">2</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(1000, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(4*300, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(2200, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(400, 2)}}</td>
                                                </tr>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">3</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(4*300, 2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun+$akademik->bil_bulanpersem*300, 2)}}</td>
                                                    @if ($permohonan->amaun+$akademik->bil_bulanpersem*300 > 400)
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right bold red-color">{{number_format(400, 2)}}</td>
                                                    @else
                                                        <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right bold">{{number_format($permohonan->amaun+$akademik->bil_bulanpersem*300, 2)}}</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="maklumat2">
                                            <tr>
                                                <td>Jumlah Layak Tuntut (RM)</td>
                                                <td>:</td>
                                                <td><input type="number" name="layak_tuntut" value="{{$jumlah}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                        </table>
                                    </div>
                                <!--end: Invoice body-->       
                                <div class="col-md-6 text-right">
                                    <button type="submit" name="submit" class="btn btn-success text-white" value="Layak"><i class="fa fa-check"></i> Layak</button>
                                    <button type="submit" name="submit" class="btn btn-warning theme-bg gradient action-btn" value="Kembalikan"><i class="fa fa-reply"></i> Kembalikan</button>
                                    <button type="submit" name="submit" class="btn btn-danger" value="TidakLayak"><i class="bi bi-x"></i> Tidak Layak</button>
                                </div>
                                </form>  
                            </div>                   
                        </div> 
                    </div>                                       
                </div>
            </div>
        </div>
    </div>
</x-default-layout> 