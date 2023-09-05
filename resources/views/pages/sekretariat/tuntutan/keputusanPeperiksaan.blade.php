<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! printHtmlAttributes('html') !!}>
<!--begin::Head-->
<head>
    <title>{{ config('app.name', 'SistemBKOKU') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:type" content="article"/>
    <link rel="stylesheet" href="/assets/css/style.bundle.css">
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>
<style>
    .nav, h3{
        margin: 10px!important;
    }
    body{
        margin: 10px;
    }
    .border{
        border: 1px solid black!important;
    }
</style>
    <body>
        <h3>Keputusan Peperiksaan Mengikut Sesi/Semester</h3>
        {{-- @php
            $str = $permohonan->id_permohonan;
            $id_permohonan = str_replace('/', '-', $str);
            $suratTawaran = "/assets/dokumen/permohonan/salinan_suratTawaran_".$id_permohonan.".pdf";
            $akaunBankIslam = "/assets/dokumen/permohonan/salinan_akaunBankIslam_".$id_permohonan.".pdf";
            $keputusanPeperiksaan = "/assets/dokumen/permohonan/salinan_keputusanPeperiksaan_".$id_permohonan.".pdf";
            $invoisResit = "/assets/dokumen/permohonan/salinan_invoisResit_".$id_permohonan.".pdf";
            $maklumatBankIPT = "/assets/dokumen/permohonan/salinan_maklumatBankIPT_".$id_permohonan.".pdf";
        @endphp --}}
        <div class="border">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sem1-tab" data-toggle="tab" data-target="#sem1" type="button" role="tab" aria-controls="sem1" aria-selected="true">2020/2021-01</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem2-tab" data-toggle="tab" data-target="#sem2" type="button" role="tab" aria-controls="sem2" aria-selected="false">2020/2021-02</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem3-tab" data-toggle="tab" data-target="#sem3" type="button" role="tab" aria-controls="sem3" aria-selected="false">2021/2022-01</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem4-tab" data-toggle="tab" data-target="#sem4" type="button" role="tab" aria-controls="sem4" aria-selected="false">2021/2022-02</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem5-tab" data-toggle="tab" data-target="#sem5" type="button" role="tab" aria-controls="sem5" aria-selected="false">2022/2023-01</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sem6-tab" data-toggle="tab" data-target="#sem6" type="button" role="tab" aria-controls="sem6" aria-selected="false">2022/2023-02</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fadeshow active" id="sem1" role="tabpanel" aria-labelledby="sem1-tab">
                    <div style="text-align: center">
                        <embed src="/assets/dokumen/keputusanPeperiksaan/keputusanPeperiksaan.pdf#zoom=90" width="70%" height="605px"/>
                    </div>
                </div>
                <div class="tab-pane fade" id="sem2" role="tabpanel" aria-labelledby="sem2-tab">
                    <div style="text-align: center">
                        <embed src="/assets/dokumen/keputusanPeperiksaan/keputusanPeperiksaan.pdf#zoom=90" width="70%" height="605px"/>
                    </div>
                </div>
                <div class="tab-pane fade" id="sem3" role="tabpanel" aria-labelledby="sem3-tab">
                    <div style="text-align: center">
                        <embed src="/assets/dokumen/keputusanPeperiksaan/keputusanPeperiksaan.pdf#zoom=90" width="70%" height="605px"/>
                    </div>
                </div>
                <div class="tab-pane fade" id="sem4" role="tabpanel" aria-labelledby="sem4-tab">
                    <div style="text-align: center">
                        <embed src="/assets/dokumen/keputusanPeperiksaan/keputusanPeperiksaan.pdf#zoom=90" width="70%" height="605px"/>
                    </div>
                </div>
                <div class="tab-pane fade" id="sem5" role="tabpanel" aria-labelledby="sem5-tab">
                    <div style="text-align: center">
                        <embed src="/assets/dokumen/keputusanPeperiksaan/keputusanPeperiksaan.pdf#zoom=90" width="70%" height="605px"/>
                    </div>
                </div>
                <div class="tab-pane fade" id="sem6" role="tabpanel" aria-labelledby="sem6-tab">
                    <div style="text-align: center">
                        <embed src="/assets/dokumen/keputusanPeperiksaan/keputusanPeperiksaan.pdf#zoom=90" width="70%" height="605px"/>
                    </div>
                </div>            
            </div>
        </div>
    </body>
</html>