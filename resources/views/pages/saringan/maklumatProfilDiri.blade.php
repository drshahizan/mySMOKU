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
                <td class="gap-top">Mohd Ali Bin Abu Kassim</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td>990404080221</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Tarikh Lahir</td>
                <td style="width: 2%">:</td>
                <td>04/04/1999</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Umur</td>
                <td style="width: 2%">:</td>
                <td>24</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Jantina</td>
                <td style="width: 2%">:</td>
                <td>Laki</td>
            </tr>
            <tr class="gap-left">
                <td>No. JKM</td>
                <td style="width: 2%">:</td>
                <td>PH1230909899</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Kecacatan</td>
                <td style="width: 2%">:</td>
                <td>Fizikal</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td>Malayu</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Rumah</td>
                <td style="width: 2%">:</td>
                <td>Taman Sri Stulang 1</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Poskod</td>
                <td style="width: 2%">:</td>
                <td>80150</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Bandar</td>
                <td style="width: 2%">:</td>
                <td>Johor Bahru</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Negeri</td>
                <td style="width: 2%">:</td>
                <td>Johor</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Tel(HP)</td>
                <td style="width: 2%">:</td>
                <td>01135679793</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Tel Rumah</td>
                <td style="width: 2%">:</td>
                <td>072666260</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Emel</td>
                <td style="width: 2%">:</td>
                <td>aliabukassim@graduate.aputi.my</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 16%">No. Akaun Bank</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td class="gap-bottom">0503002347654</td>
            </tr>
        </div>
        <tr>
            <td class="header-part" colspan="3">B. MAKLUMAT WARIS</td>
        </tr>
        <div>
        <tr class="gap-left">
            <td style="width: 16%" class="gap-top">Nama </td>
            <td style="width: 2%" class="gap-top">:</td>
            <td class="gap-top">Siti Latifah Binti Mohd Yusuf</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Kad Pengenalan</td>
            <td style="width: 2%">:</td>
            <td>610623035672</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No Pasport</td>
            <td style="width: 2%">:</td>
            <td>-</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Hubungan Waris</td>
            <td style="width: 2%">:</td>
            <td>Ibu</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Lain-lain (Sila Nyatakan)</td>
            <td style="width: 2%">:</td>
            <td>-</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Alamat Rumah</td>
            <td style="width: 2%">:</td>
            <td>Taman Sri Stulang 1</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Poskod</td>
            <td style="width: 2%">:</td>
            <td>80150</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Bandar</td>
            <td style="width: 2%">:</td>
            <td>Johor Bahru</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Negeri</td>
            <td style="width: 2%">:</td>
            <td>Johor</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Tel(HP)</td>
            <td style="width: 2%">:</td>
            <td>0196926567</td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Tel Rumah</td>
            <td style="width: 2%">:</td>
            <td>072666211</td>
        </tr>
        <tr class="gap-left">
            <td class="gap-bottom" style="width: 16%">Pendapatan</td>
            <td class="gap-bottom" style="width: 2%">:</td>
            <td class="gap-bottom">2000</td>
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
