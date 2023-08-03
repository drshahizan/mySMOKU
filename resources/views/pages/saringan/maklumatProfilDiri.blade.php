<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:type" content="article"/>

<body>
    <table>
        <tr>
            <td class="align-right">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/JATA_NEGARA_MALAYSIA.png/776px-JATA_NEGARA_MALAYSIA.png?20220224030856" alt="jata-negara-malaysia" width="50px">
                BANTUAN KEWANGAN ORANG KURANG UPAYA (BKOKU)
            </td>
        </tr>
        <tr>
            <td class="header-part" colspan="3"> A.Semakan Kelayakan MQA</td>
        </tr>
        <tr>
            <td>Nama Institusi</td>
            <td style="width: 10%">:</td>
            <td>Universiti Malaysia Sabah</td>
        </tr>
        <tr>
            <td>Peringkat</td>
            <td style="width: 10%">:</td>
            <td>Diploma</td>
        </tr>
        <tr>
            <td>Nama Kursus</td>
            <td style="width: 10%">:</td>
            <td>Komputer Sains</td>
        </tr>
        <tr>
            <td>Adakah anda penerima HLP?</td>
            <td style="width: 10%">:</td>
            <td>Ya</td>
        </tr>
        <tr>
            <td class="header-part" colspan="3">B. Maklumat Peribadi</td>
        </tr>
        <tr>
            <td>Nama </td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Kad Pengenalan</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Tarikh Lahir</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Jantina</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. JKM</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Kecacatan</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Bangsa</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat Rumah</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Poskod</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Bandar</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Negeri</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Tel(HP)</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Tel Rumah</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat Emel</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Akaun Bank</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr></tr>
            <td class="header-part" colspan="3">C. Maklumat Waris</td>
        </tr>
        <tr>
            <td>Nama </td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Kad Pengenalan</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No Pasport</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Hubungan Waris</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Lain-lain (Sila Nyatakan)</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat Rumah</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Poskod</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Bandar</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Negeri</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Tel(HP)</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>No. Tel Rumah</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
        <tr>
            <td>Pendapatan</td>
            <td style="width: 10%">:</td>
            <td></td>
        </tr>
    </tr>
        <td class="header-part" colspan="3">D. Maklumat Akademik</td>
    </tr>
    <tr>
        <td>No Pendaftaran Pelajar</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Nama Kursus</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Peringkat Pengajian</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Nama Pusat Pengajian</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Tarikh Mula Pengajian</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Tarikh Tamat Pengajian</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Semester Semasa</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Tempoh Pengajian</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Bil Bulan Persemester</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Mod Pengajian</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Sumber Pembiayaan</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Nama Penaja</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    </tr>
        <td class="header-part" colspan="3">E. Maklumat Tuntutan</td>
    </tr>
    <tr>
        <td>Jenis Tuntutan</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    <tr>
        <td>Amaun</td>
        <td style="width: 10%">:</td>
        <td></td>
    </tr>
    </tr>
        <td class="header-part" colspan="3">F. Perakuan</td>
    </tr>
    <tr>
        <td colspan="3">
            Saya mengaku bahawa segala maklumat yang diberikan adalah betul dan benar belaka. Saya juga faham
            sekiranya maklumat yang diberikan didapati palsu atau tidak benar, pihak kementerian berhak menolak
            permohonan saya dan menghentikan bantuan kewangan ini kepada saya
        </td>
    </tr>
</body>
</html>
