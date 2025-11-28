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
                            <div class="ml-auto">
                                <a href="{{ url('tuntutan/sekretariat/saringan/set-semula-status/'.$tuntutan->id) }}" class="btn btn-primary btn-sm">Set Semula Saringan</a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                                <div class="col-md-6 col-sm-6">
                                    <br>
                                    @php
                                        $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $akademik->peringkat_pengajian)->value('peringkat');
                                        $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                        $nama_penaja = DB::table('bk_penaja')->where('id', $akademik->nama_penaja)->value('penaja');
                                        
                                        // nama pemohon
                                        $text = ucwords(strtolower($smoku->nama)); // Assuming you're sending the text as a POST parameter
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

                                    @endphp

                                    <table class="maklumat">
                                        <tr>
                                            <td><strong>ID Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>{{$tuntutan->no_rujukan_tuntutan}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Kursus</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->nama_kursus}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama</strong></td>
                                            <td>:</td>
                                            <td>{{$pemohon}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Institusi</strong></td>
                                            <td>:</td>
                                            <td>{{$nama_institusi}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>No. Kad Pengenalan</strong></td>
                                            <td>:</td>
                                            <td>{{$smoku->no_kp}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Peringkat</strong></td>
                                            <td>:</td>
                                            <td>{{ucwords(strtolower($peringkat))}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tarikh Tuntutan</strong></td>
                                            <td>:</td>
                                            <td>{{date('d/m/Y', strtotime($tuntutan->tarikh_hantar))}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Sesi/Semester</strong></td>
                                            <td>:</td>
                                            <td>{{$tuntutan->sesi}}-0{{$tuntutan->semester}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Status Penajaan</strong></td>
                                            <td>:</td>
                                                @if($akademik->nama_penaja == '99')
                                                    <td>Ditaja ({{ $akademik->penaja_lain }})</td>
                                                @elseif($akademik->nama_penaja != null)
                                                    <td>Ditaja ({{ $nama_penaja }})</td>
                                                @else
                                                    <td>Tidak Ditaja</td>
                                                @endif

                                            <td class="space">&nbsp;</td>
                                            <td><strong>No. Akaun Bank</strong></td>
                                            <td>:</td>
                                            <td>{{$no_akaun}} - 
                                                @if($penyata_bank!=null)
                                                    @php
                                                        $penyata = "/assets/dokumen/permohonan/".$penyata_bank->dokumen;
                                                    @endphp
                                                    <span><a href="{{ url($penyata) }}" target="_blank">Papar Penyata Bank</a></span>
                                                    
                                                @else
                                                    <strong style="color: red;">Tiada Penyata Bank</strong>
                                                @endif
                                            </td>    
                                        </tr>
                                    </table>
                                <hr>
                                <br>
                                <h6>Maklumat tuntutan:</h6>
                                <br>
                                @php
                                    $i=1;
                                @endphp
                                <form method="POST" action="{{ url('tuntutan/sekretariat/saringan/saring-tuntutan-kedua/'.$tuntutan->id) }}" id="saring">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered mb-5">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th style="width: 5%;">No.</th>
                                                            <th style="width: 20%;">Invois</th>
                                                            <th style="width: 15%;">Keputusan Saringan</th>
                                                            <th style="width: 20%;">No. Resit</th>
                                                            <th style="width: 40%;">Perihal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $keputusan = DB::table('permohonan_peperiksaan')->where('permohonan_id', $permohonan->id)->orderBy('id', 'DESC')->get();
                                                        @endphp
                                                    @if ($keputusan->isNotEmpty())
                                                        @php
                                                            $salinan = DB::table('permohonan_peperiksaan')->where('permohonan_id', $permohonan->id)->orderBy('id', 'DESC')->first();
                                                        @endphp
                                                        <tr>
                                                            <td style="text-align:left;">{{$i++}}</td>
                                                            <td>
                                                                @if($salinan->kepPeperiksaan)
                                                                    <span><a href="{{ url('tuntutan/sekretariat/saringan/keputusan-peperiksaan/'.$permohonan->id) }}" target="_blank">Keputusan Peperiksaan</a></span>
                                                                @else
                                                                    <span>Keputusan Peperiksaan</span>
                                                                @endif    
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="peperiksaan" name="peperiksaan" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="Lengkap">Lengkap</option>
                                                                        <option value="Tidak Lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                CGPA - {{$salinan->cgpa}}
                                                            </td>
                                                            <td>
                                                                Keseluruhan keputusan peperiksaan
                                                            </td>
                                                        </tr>
                                                    @endif
                                                        @foreach($tuntutan_item as $item)
                                                            @php
                                                                $invoisResit = "/assets/dokumen/tuntutan/".$item['resit'];
                                                            @endphp
                                                        <tr>
                                                            <td style="text-align:left;">{{$i++}}</td>
                                                            <td>
                                                                @if($item->resit)
                                                                    <span><a href="{{ url($invoisResit) }}" target="_blank">{{$item['jenis_yuran']}}</a></span>
                                                                @else
                                                                    <span>{{$item['jenis_yuran']}}</span>
                                                                @endif
                                                            </td>
                                                            <td class="hidden-sm-down">
                                                                <div class="form-group c_form_group">
                                                                    <select id="invois[]" name="invois[]" class="form-control" onchange="select()" oninvalid="this.setCustomValidity('Sila pilih')" oninput="setCustomValidity('')" required>
                                                                        <option value="">Pilih</option>
                                                                        <option value="Lengkap">Lengkap</option>
                                                                        <option value="Tidak lengkap">Tidak Lengkap</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                {{$item['no_resit']}}
                                                            </td>
                                                            <td>
                                                                {{$item['nota_resit']}}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>Pengiraan:</h6>
                                    <br>
                                        <p>Baki Terdahulu (RM) : {{number_format($baki_terdahulu)}}</p>

                                    {{csrf_field()}}
                                    @if($permohonan->program == "BKOKU")
                                        @php
                                            if($tuntutan->amaun_wang_saku == null){
                                                $tuntutan->amaun_wang_saku = 0;
                                            }
                                            $jumlah = $tuntutan->amaun_wang_saku;
                                        @endphp
                                        <input type="hidden" name="baki" id="baki" value="">
                                        <input type="hidden" name="baki_disokong" id="baki_disokong_2" value="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                                    <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku,2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong_2" value="{{number_format($tuntutan->amaun_wang_saku, 2, '.', '')}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_2" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
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
                                        <script>
                                            document.getElementById("w_saku_disokong_2").addEventListener("input", SokongW);
                                            function SokongW(){
                                                var w_saku = document.getElementById('w_saku_disokong_2').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_disokong_2').value= parseFloat(w_saku).toFixed(2);
                                            }
                                        </script>
                                    @elseif($permohonan->program == "PPK")
                                        @php
                                            if($tuntutan->amaun_wang_saku == null){
                                                $tuntutan->amaun_wang_saku = 0;
                                            }
                                            $jumlah = $tuntutan->amaun_wang_saku;
                                        @endphp
                                        <input type="hidden" name="baki" id="baki" value="">
                                        <input type="hidden" name="baki_disokong" id="baki_disokong_ppk" value="">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Jenis Tuntutan</th>
                                                    <th class="th-yellow border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Dituntut (RM)</th>
                                                    <th class="th-green border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest bold white">Disokong (RM)</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr class="font-weight-bolder font-size-lg">
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest">Wang Saku</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right">{{number_format($tuntutan->amaun_wang_saku,2)}}</td>
                                                    <td class="border-top-0 pr-0 py-4 font-size-h6 font-weight-boldest text-right"><input type="number" step="0.01" name="w_saku_disokong" id="w_saku_disokong_ppk" value="{{number_format($tuntutan->amaun_wang_saku, 2, '.', '')}}"></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <table class="maklumat2">
                                                <tr>
                                                    <td>Jumlah tuntutan yang disokong (RM)</td>
                                                    <td>:</td>
                                                    <td><input type="number" step="0.01" id="jumlah_disokong_ppk" name="jumlah_disokong" value="{{number_format($jumlah, 2, '.', '')}}" oninvalid="this.setCustomValidity('Sila isi ruang ini')" oninput="setCustomValidity('')" required></td>
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
                                        <script>
                                            document.getElementById("w_saku_disokong_ppk").addEventListener("input", SokongPPK);

                                            function SokongPPK(){
                                                var w_saku = document.getElementById('w_saku_disokong_ppk').value;
                                                w_saku = parseFloat(w_saku);
                                                document.getElementById('jumlah_disokong_ppk').value= parseFloat(w_saku).toFixed(2);
                                            }
                                        </script>
                                    @endif
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
