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
            <td class="header-part" colspan="3"> A. SEMAKAN KELAYAKAN MQA</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td class="gap-top" style="width: 16%; padding-left: 20px;">Nama Institusi</td>
                <td class="gap-top" style="width: 2%">:</td>
                <td class="gap-top">Universiti Malaysia Sabah</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Peringkat</td>
                <td style="width: 2%">:</td>
                <td>Diploma</td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Nama Kursus</td>
                <td style="width: 2%">:</td>
                <td>Komputer Sains</td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 16%">Adakah anda penerima HLP?</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td class="gap-bottom">Ya</td>
            </tr>
        </div>
        <tr>
            <td class="header-part" colspan="3">B. MAKLUMAT PERIBADI</td>
        </tr>
        <div>
            <tr class="gap-left">
                <td style="width: 16%" class="gap-top">Nama</td>
                <td style="width: 2%" class="gap-top">:</td>
                <td class="gap-top"></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Kad Pengenalan</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Tarikh Lahir</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Umur</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Jantina</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td>No. JKM</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Kecacatan</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Bangsa</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Rumah</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Poskod</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Bandar</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Negeri</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Tel(HP)</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">No. Tel Rumah</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td style="width: 16%">Alamat Emel</td>
                <td style="width: 2%">:</td>
                <td></td>
            </tr>
            <tr class="gap-left">
                <td class="gap-bottom" style="width: 16%">No. Akaun Bank</td>
                <td class="gap-bottom" style="width: 2%">:</td>
                <td class="gap-bottom"></td>
            </tr>
        </div>
        <tr>
            <td class="header-part" colspan="3">C. MAKLUMAT WARIS</td>
        </tr>
        <div>
        <tr class="gap-left">
            <td style="width: 16%" class="gap-top">Nama </td>
            <td style="width: 2%" class="gap-top">:</td>
            <td class="gap-top"></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Kad Pengenalan</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No Pasport</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Hubungan Waris</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Lain-lain (Sila Nyatakan)</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Alamat Rumah</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Poskod</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Bandar</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">Negeri</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Tel(HP)</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td style="width: 16%">No. Tel Rumah</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td class="gap-bottom" style="width: 16%">Pendapatan</td>
            <td class="gap-bottom" style="width: 2%">:</td>
            <td class="gap-bottom"></td>
        </tr>
    </div>
        <tr>
            <td class="header-part" colspan="3">D. MAKLUMAT TUTUTAN</td>
        </tr>
    <div>
        <tr class="gap-left">
            <td style="width: 16%" class="gap-top">Jenis Tuntutan</td>
            <td style="width: 2%">:</td>
            <td></td>
        </tr>
        <tr class="gap-left">
            <td class="gap-bottom" style="width: 16%">Amaun</td>
            <td class="gap-bottom" style="width: 2%">:</td>
            <td class="gap-bottom"></td>
        </tr>
        </tr>
            <td class="header-part" colspan="3">E. PERAKUAN</td>
        </tr>
        <tr class="gap-left">
            <td colspan="3" class="gap-top gap-bottom">
                Saya mengaku bahawa segala maklumat yang diberikan adalah betul dan benar belaka. Saya juga faham
                sekiranya maklumat yang diberikan didapati palsu atau tidak benar, pihak kementerian berhak menolak
                permohonan saya dan menghentikan bantuan kewangan ini kepada saya.
            </td>
        </tr>
    </div>
</body>
</html>
