<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:type" content="article"/>
    <link rel="stylesheet" href="/assets/css/saringan.css">
</head>
<body>
    @php
        $jantina_p = DB::table('bk_jantina')->where('kod_jantina', $smoku->jantina)->value('jantina');
        $keturunan_p = DB::table('bk_keturunan')->where('kod_keturunan', $smoku->keturunan)->value('keturunan');
        $hubungan_w = DB::table('bk_hubungan')->where('kod_hubungan', $waris->hubungan_waris)->value('hubungan');
    @endphp
    <table class="profile-form">
        <tr>
            <td class="text-center" colspan="3">
                <img src="/assets/media/svg/jata_negara.svg" alt="jata-negara-malaysia">
                <br><b class="title"> MAKLUMAT PROFIL DIRI</b>
                <p><b class="description"> BANTUAN KEWANGAN ORANG KURANG UPAYA <br> (BKOKU)</b> </p>
                <br><br>
            </td>
        </tr>
        <tr>
            <td class="header-part" colspan="3">A. MAKLUMAT PERIBADI</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td style="width: 16%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top">{{$smoku->nama}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->no_kp}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Tarikh Lahir</td>
                <td style="width: 2%">:</td>
                <td>{{date('d/m/Y', strtotime($smoku->tarikh_lahir))}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Umur</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->umur}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Jantina</td>
                <td style="width: 2%">:</td>
                <td>{{$jantina_p}}</td>
            </tr>
            <tr class="gap-left">
                <td>No. Daftar OKU</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->no_daftar_oku}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Kecacatan</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->kategori}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td>{{$keturunan_p}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Tetap</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->alamat_tetap}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Surat-menyurat</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->alamat_surat_menyurat}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Tel (HP)</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->tel_bimbit}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Tel Rumah</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->tel_rumah}}</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Emel</td>
                <td style="width: 2%">:</td>
                <td>{{$smoku->email}}</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 16%">No. Akaun Bank</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td class="gap-bottom">{{$pelajar->no_akaun_bank}}</td>
            </tr>
        </div>
        <tr>
            <td class="header-part" colspan="3">B. MAKLUMAT WARIS</td>
        </tr>
        <div>
        <tr class="gap-left">
            <td style="width: 16%" class="gap-top">Nama </td>
            <td style="width: 2%" class="gap-top">:</td>
            <td class="gap-top">{{$waris->nama_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Kad Pengenalan</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->no_kp_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No Pasport</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->no_pasport_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Hubungan Waris</td>
            <td style="width: 2%">:</td>
            <td>{{$hubungan_w}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Alamat Rumah</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->alamat_waris}}1</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Poskod</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->alamat_poskod_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Bandar</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->alamat_bandar_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Negeri</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->alamat_negeri_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Tel (HP)</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->tel_bimbit_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Pekerjaan</td>
            <td style="width: 2%">:</td>
            <td>{{$waris->pekerjaan_waris}}</td>
        </tr>
        <tr class="gap-left">
            <td class="gap-bottom" style="width: 16%">Pendapatan Bulanan (RM)</td>
            <td class="gap-bottom" style="width: 2%">:</td>
            <td class="gap-bottom">{{$waris->pendapatan_waris}}</td>
        </tr>
        </tr>
            <td class="header-part" colspan="3">C. PERAKUAN</td>
        </tr>
        <tr class="gap-left">
            <td colspan="3" class="gap-top gap-bottom">
                Saya mengaku bahawa segala maklumat yang diberikan adalah betul dan benar belaka. Saya juga faham
                sekiranya maklumat yang diberikan didapati palsu atau tidak benar, pihak kementerian berhak menolak
                permohonan saya dan menghentikan bantuan kewangan ini kepada saya.
            </td>
        </tr>
    </div>
    </table>
</body>
</html>
