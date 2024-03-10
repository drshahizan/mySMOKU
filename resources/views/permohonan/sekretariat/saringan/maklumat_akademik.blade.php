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
            $peringkat_pengajian = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $akademik->peringkat_pengajian ?? '')->value('peringkat');
            $nama_institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi ?? '')->value('nama_institusi');
            $mod = DB::table('bk_mod')->where('kod_mod', $akademik->mod ?? '')->value('mod');
            $sumber_biaya = DB::table('bk_sumber_biaya')->where('kod_biaya', $akademik->sumber_biaya ?? '')->value('biaya');
            $nama_penaja = DB::table('bk_penaja')->where('id', $akademik->nama_penaja ?? '')->value('penaja');
        @endphp

        <table class="profile-form">
            <tr>
                <td class="text-center" colspan="3">
                    <img src="/assets/media/svg/jata_negara.svg" alt="jata-negara-malaysia">
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
                    <td class="gap-top">{{$akademik->no_pendaftaran_pelajar ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Nama Kursus</td>
                    <td style="width: 2%">:</td>
                    <td>{{strtoupper($akademik->nama_kursus ?? '')}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Peringkat Pengajian</td>
                    <td style="width: 2%">:</td>
                    <td>{{$peringkat_pengajian ?? '' }}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Nama Pusat Pengajian</td>
                    <td style="width: 2%">:</td>
                    <td>{{strtoupper($nama_institusi) ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Tarikh Mula Pengajian</td>
                    <td style="width: 2%">:</td>
                    <td>{{date('d/m/Y', strtotime($akademik->tarikh_mula ?? ''))}}</td>
                    
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Tarikh Tamat Pengajian</td>
                    <td style="width: 2%">:</td>
                    <td>{{date('d/m/Y', strtotime($akademik->tarikh_tamat ?? ''))}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Semester Semasa</td>
                    <td style="width: 2%">:</td>
                    <td>{{$akademik->sem_semasa ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Tempoh Pengajian</td>
                    <td style="width: 2%">:</td>
                    <td>{{$akademik->tempoh_pengajian ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Bil Bulan Persemester</td>
                    <td style="width: 2%">:</td>
                    <td>{{$akademik->bil_bulan_per_sem ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Mod Pengajian</td>
                    <td style="width: 2%">:</td>
                    <td>{{$mod ?? ''}}</td>
                </tr>
                <tr class="gap-left">
                    <td style="width: 16%">Sumber Pembiayaan</td>
                    <td style="width: 2%">:</td>
                    <td>{{$sumber_biaya ?? ''}}</td>
                </tr>
                @if ($nama_penaja != null) 
                    <tr class="gap-left">
                        <td class="gap-bottom" style="width: 16%">Nama Penaja</td>
                        <td class="gap-bottom" style="width: 2%">:</td>
                        <td class="gap-bottom">{{$nama_penaja ?? ''}}</td>
                    </tr>
                @endif
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
