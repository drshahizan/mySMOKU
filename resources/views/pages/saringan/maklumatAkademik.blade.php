<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:type" content="article"/>
    <link rel="stylesheet" href="assets/css/saringan.css">
</head>
<body>
    <table class="profile-form">
        <tr>
            <td class="text-center" colspan="3">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/JATA_NEGARA_MALAYSIA.png/776px-JATA_NEGARA_MALAYSIA.png?18218224030856" alt="jata-negara-malaysia">
                <br><b class="title"> MAKLUMAT AKADEMIK</b>
                <p><b class="description"> BANTUAN KEWANGAN ORANG KURANG UPAYA <br> (BKOKU)</b> </p> 
                <br><br>
            </td>
        </tr>
        <tr>
            <td class="header-part" colspan="3">A. MAKLUMAT AKADEMIK</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td style="width: 16%" class="gap-top">No Pendaftaran Pelajar</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td>AI12392</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Nama Kursus</td>
                <td style="width: 2%">:</td>
                <td>Bachelor Of Arts In Mobile Media Production</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Peringkat Pengajian</td>
                <td style="width: 2%">:</td>
                <td>Sarjana Muda</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Nama Pusat Pengajian</td>
                <td style="width: 2%">:</td>
                <td>Asia Pacific University Of Technology And Innovation</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Tarikh Mula Pengajian</td>
                <td style="width: 2%">:</td>
                <td>08/08/2023</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Tarikh Tamat Pengajian</td>
                <td style="width: 2%">:</td>
                <td>30/08/2023</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Semester Semasa</td>
                <td style="width: 2%">:</td>
                <td>06</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Tempoh Pengajian</td>
                <td style="width: 2%">:</td>
                <td>02</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Bil Bulan Persemester</td>
                <td style="width: 2%">:</td>
                <td>04</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Mod Pengajian</td>
                <td style="width: 2%">:</td>
                <td>Jarak Jauh</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Sumber Pembiayaan</td>
                <td style="width: 2%">:</td>
                <td>Pinjaman</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 16%">Nama Penaja</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td class="gap-bottom">JPA</td>
            </tr>
        </div>
        </tr>
            <td class="header-part" colspan="3">B. PERAKUAN</td>
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
