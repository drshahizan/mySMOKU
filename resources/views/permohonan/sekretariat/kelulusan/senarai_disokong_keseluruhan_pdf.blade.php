<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Senarai Permohonan Disokong Keseluruhan</title>
    <link rel="stylesheet" href="assets/css/style.bundle.css">
    <link rel="stylesheet" href="assets/css/saringan.css">
    <style>
        table {
            border: 1px solid black!important;
            width: 100%;
        }
        th {
            padding-top: 6px!important;
            padding-bottom: 6px!important;
            background-color: #3d0066!important;
            color: white!important;
        }
        th, td {
            border: 1px solid black!important;
        }
        body {
            font-size: 10px!important;
        }
        td {
            vertical-align: top!important;
            padding-bottom: 6px!important;
            text-transform: capitalize;
        }
        .alignleft {
            float: left;
        }
        .alignright {
            float: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="image">
            <img src="logoKPT.png" alt="Kementerian Pengajian Tinggi" style="width:10%; height:10%; float: left;">
        </div>
        <div class="alignleft" style="padding-left: 25px; padding-top:25px; font-size: 12px;">
            <b>KEMENTERIAN PENDIDIKAN TINGGI</b>
            <br>MINISTRY OF HIGHER EDUCATION<br>
        </div>
        <div class="alignright" style="padding-top: 10px;">
            <table style="border: none!important;">
                <tr style="border: none!important;">
                    <td style="border: none!important;"><b>No. Mesyuarat </b></td>
                    <td style="border: none!important;"><b>:</b></td>
                    <td style="border: none!important;"><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 10px!important;"></td>
                </tr>
                <tr style="border: none!important;">
                    <td style="border: none!important;"><b>Tarikh Mesyuarat </b></td>
                    <td style="border: none!important;"><b>:</b></td>
                    <td style="border: none!important;"><input type="text" id="tarikhMesyuarat" name="tarikhMesyuarat" style="padding: 10px;"></td>
                </tr>
            </table>
        </div>
    </div>

    <br><br><br><br><br>

    <div style="margin: 10px; display: block;">
        <div class="tittle" style="text-align: center; font-size: 14px;">
            <b>SENARAI PERMOHONAN BKOKU/PPK YANG DISOKONG</b>
        </div>
        <br>

        <table class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th style="width: 3%"><b>No.</b></th>
                    <th style="width: 7%"><b>Program</b></th>
                    <th style="width: 10%"><b>ID Permohonan</b></th>
                    <th style="width: 17%"><b>Nama</b></th>
                    <th style="width: 9%"><b>Jenis Kecacatan</b></th>
                    <th style="width: 18%"><b>Nama Kursus</b></th>
                    <th style="width: 18%"><b>Institusi Pengajian</b></th>
                    <th style="width: 9%"><b>Tarikh Mula Pengajian</b></th>
                    <th style="width: 9%"><b>Tarikh Tamat Pengajian</b></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 0;
                    require_once app_path('helpers.php');
                @endphp

                @foreach ($kelulusan as $item)
                    @php
                        $i++;
                        $pemohon = DB::table('smoku')->where('id', $item['smoku_id'])->value('nama');
                        $kursus = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('status', 1)->value('nama_kursus');
                        $jenis_kecacatan = DB::table('smoku')->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')->where('smoku.id', $item['smoku_id'])->value('bk_jenis_oku.kecacatan');
                        $institusi = DB::table('smoku_akademik')->join('bk_info_institusi','bk_info_institusi.id_institusi','=','smoku_akademik.id_institusi')->where('smoku_id', $item['smoku_id'])->where('smoku_akademik.status', 1)->value('bk_info_institusi.nama_institusi');
                        $tarikh_mula = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('status', 1)->value('tarikh_mula');
                        $tarikh_tamat = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->where('status', 1)->value('tarikh_tamat');

                        $nama_pemohon = formatNamaPemohon($pemohon);
                        $nama_kursus = transformBracketsToCapital(ucwords(strtolower($kursus)));
                        $institusi_pengajian = transformBracketsToUppercase(ucwords(strtolower($institusi)));
                    @endphp

                    <tr>
                        <td class="text-center">{{ $i }}</td>
                        <td class="text-center">{{ strtoupper($item['program']) }}</td>
                        <td>{{ $item['no_rujukan_permohonan'] }}</td>
                        <td>{{ $nama_pemohon }}</td>
                        <td>{{ ucwords(strtolower($jenis_kecacatan)) }}</td>
                        <td>{{ $nama_kursus }}</td>
                        <td>{{ $institusi_pengajian }}</td>
                        <td class="text-center">{{ $tarikh_mula ? date('d/m/Y', strtotime($tarikh_mula)) : '-' }}</td>
                        <td class="text-center">{{ $tarikh_tamat ? date('d/m/Y', strtotime($tarikh_tamat)) : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
