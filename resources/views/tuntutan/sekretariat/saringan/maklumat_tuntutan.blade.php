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
            width: 90%;
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
            width: 80px;
            text-align: right;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 2px 5px;
            font-size: 13px!important;
        }
        textarea{
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
        .vertical-top{
            vertical-align: top!important;
        }
        /* .th-yellow{
            background-color: #a27a00!important;
        }
        .th-green{
            background-color: #007842!important;
        } */
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
                                <h6>Maklumat tuntutan:</h6>
                                <br>
                                @php
                                    $str = $permohonan->id_permohonan;
                                    $id_permohonan = str_replace('/', '-', $str);
                                    $invoisResit = "/assets/dokumen/permohonan/salinan_invoisResit_".$id_permohonan.".pdf";
                                @endphp
                                <form method="POST" action="{{ url('tuntutan/sekretariat/saringan/saring-tuntutan-kedua/'.$permohonan->id) }}" id="saring">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered mb-5">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th style="width: 5%;">No.</th>
                                                            <th style="width: 20%;">Item</th>
                                                            <th style="width: 25%;">Keputusan Saringan</th>
                                                            <th style="width: 50%;">Perihal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="text-align:right;">1</td>
                                                            <td>
                                                                <span><a href="{{ url('tuntutan/sekretariat/saringan/keputusan-peperiksaan') }}" target="_blank">Keputusan Peperiksaan</a></span>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="invois" name="invois" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Keseluruhan keputusan peperiksaan
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:right;">2</td>
                                                            <td>
                                                                <span><a href="{{ url($invoisResit) }}" target="_blank">Invois/resit 1</a></span>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="invois" name="invois" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Kad matrik
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:right;">3</td>
                                                            <td>
                                                                <span><a href="{{ url($invoisResit) }}" target="_blank">Invois/resit 2</a></span>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="invois" name="invois" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Yuran peperiksaan
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="text-align:right;">4</td>
                                                            <td>
                                                                <span><a href="{{ url($invoisResit) }}" target="_blank">Invois/resit 3</a></span>
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="invois" name="invois" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="lengkap">Lengkap</option>
                                                                        <option value="tak_lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Yuran perpustakaan
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Pengiraan:</h6>
                                    <br>
                                    <!--begin: Invoice body-->
                                    {{csrf_field()}}
                                    @php
                                        $jumlah = 600+1800;
                                        if($jumlah > 5000){
                                            $jumlah = 5000;
                                        }
                                    @endphp
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                                <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                                <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                                <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                                <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                                <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dibayar (RM)</th>
                                                <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Baki (RM)</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Yuran Pengajian</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($permohonan->amaun, 2)}}</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(5000 - $permohonan->amaun - $akademik->bil_bulanpersem * 300, 2)}}</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="yuran_disokong" id="yuran_disokong" value="{{number_format($permohonan->amaun, 2, '.', '')}}"></td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_disokong">{{number_format(5000 - $permohonan->amaun - $akademik->bil_bulanpersem * 300, 2)}}</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="w_saku_disokong" id="w_saku_disokong" value="{{number_format($permohonan->amaun, 2, '.', '')}}"></td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="w_baki_disokong">{{number_format(5000 - $permohonan->amaun - $akademik->bil_bulanpersem * 300, 2)}}</td>
                                            </tr>
                                            <tr class="font-weight-bolder font-size-lg">
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($akademik->bil_bulanpersem * 300, 2)}}</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format(0, 2)}}</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="yuran_dibayar" id="yuran_dibayar" value="{{number_format($akademik->bil_bulanpersem * 300, 2, '.', '')}}"></td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="y_baki_dibayar">{{number_format(0, 2)}}</td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" name="w_saku_dibayar" id="w_saku_dibayar" value="{{number_format($akademik->bil_bulanpersem * 300, 2, '.', '')}}"></td>
                                                <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right" id="w_baki_dibayar">{{number_format(0, 2)}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table class="maklumat2">
                                            <tr>
                                                <td class="vertical-top">Jumlah tuntutan yang disokong (RM)</td>
                                                <td class="vertical-top">:</td>
                                                <td class="vertical-top"><input type="number" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top">Jumlah tuntutan yang dibayar (RM)</td>
                                                <td class="vertical-top">:</td>
                                                <td class="vertical-top"><input type="number" name="jumlah_dibayar" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
                                            </tr>
                                            <tr>
                                                <td class="vertical-top">Catatan</td>
                                                <td class="vertical-top">:</td>
                                                <td class="vertical-top"><textarea name="catatan" id="catatan" cols="30" rows="3"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>Keputusan akhir</td>
                                                <td>:</td>
                                                <td class="hidden-sm-down">
                                                    <div class="form-group c_form_group">
                                                        <select id="keputusan" name="submit" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih item dalam senarai')" oninput="setCustomValidity('')" required>
                                                            <option value="">Pilih</option>
                                                            <option value="Kembalikan">Kembalikan</option>
                                                            <option value="Layak">Layak</option>
                                                            <option value="TidakLayak">Tidak Layak</option>
                                                        </select>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <!--end: Invoice body-->
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn btn-primary theme-bg gradient action-btn" value="Hantar" id="check">Hantar</button>
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
