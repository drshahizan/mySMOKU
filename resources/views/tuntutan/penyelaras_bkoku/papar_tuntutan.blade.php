<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
    <head>
        <title>{{ config('app.name', 'SistemBKOKU') }}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta property="og:type" content="article"/>
        <link rel="stylesheet" href="/assets/css/style.bundle.css">
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

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
        </style>
    </head>

    <body>
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
                                        $peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $akademik->peringkat_pengajian)->value('peringkat');
                                        $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi)->value('nama_institusi');
                                        $nama_penaja = DB::table('bk_penaja')->where('id', $akademik->nama_penaja)->value('penaja');
                                        // nama pemohon
                                        $text = ucwords(strtolower($smoku->nama)); 
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
                                            <td>{{$tuntutan->created_at->format('d/m/Y')}}</td>
                                            <td class="space">&nbsp;</td>
                                            <td><strong>Sesi/Semester</strong></td>
                                            <td>:</td>
                                            <td>{{$akademik->sesi}}-0{{$akademik->sem_semasa}}</td>
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
                                        </tr>
                                    </table>
                                    <hr>
                                    <br>
                                    <h6>Maklumat tuntutan:</h6>
                                    <br>
                                    @php
                                        $i = 2;
                                    @endphp
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover table-bordered mb-5">
                                                    <thead class="table-primary">
                                                    <tr>
                                                        <th style="width: 5%;">No.</th>
                                                        <th style="width: 20%;">Item</th>
                                                        <th style="width: 20%;">No. Resit</th>
                                                        <th style="width: 40%;">Perihal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td style="text-align:right;">1</td>
                                                        <td>
                                                            <span><a href="{{ route('bkoku.papar.peperiksaan',$smoku->id) }}" target="_blank">Keputusan Peperiksaan</a></span>
                                                        </td>
                                                        <td>
                                                            -
                                                        </td>
                                                        <td>
                                                            Keseluruhan keputusan peperiksaan
                                                        </td>
                                                    </tr>
                                                    @foreach($tuntutan_item as $item)
                                                        <tr>
                                                            <td style="text-align:right;">{{$i++}}</td>
                                                            <td>
                                                                <span><a href="/assets/dokumen/tuntutan/{{$item->resit}}" target="_blank">{{$item['jenis_yuran']}}</a></span>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
