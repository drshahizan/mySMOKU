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
    <h3>Muat Turun Borang Permohonan Peruntukan Program BKOKU</h3>
    
    <div class="border">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen1-tab" data-toggle="tab" data-target="#dokumen1" type="button" role="tab" aria-controls="dokumen1" aria-selected="true">
                    SPPB 1
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen1a-tab" data-toggle="tab" data-target="#dokumen1a" type="button" role="tab" aria-controls="dokumen1a" aria-selected="true">
                    SPPB 1a
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen2-tab" data-toggle="tab" data-target="#dokumen2" type="button" role="tab" aria-controls="dokumen2" aria-selected="true">
                    SPPB 2
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen2a-tab" data-toggle="tab" data-target="#dokumen2a" type="button" role="tab" aria-controls="dokumen2a" aria-selected="true">
                    SPPB 2a
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen3-tab" data-toggle="tab" data-target="#dokumen3" type="button" role="tab" aria-controls="dokumen3" aria-selected="true">
                    SPPB 3
                </button>
            </li>  
        </ul>
    
        <div class="tab-content" id="myTabContent">
            <!-- Replace these placeholders with your actual file names -->
            @php
                $xlsxExtensions = ['xlsx'];
                $pdfExtensions = ['pdf'];
            @endphp

            <div class="tab-pane fadeshow" id="dokumen1" role="tabpanel" aria-labelledby="dokumen1-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($dokumen->dokumen1, PATHINFO_EXTENSION);
                    @endphp
        
                    @if (in_array($fileExtension, $xlsxExtensions))
                        <p>Sila klik link di bawah untuk muat turun Dokumen Permohonan Salur Pelajar Sedia Ada</p>
                        <a href="/assets/dokumen/sppb_1/{{$dokumen->dokumen1}}" download>Klik Sini</a><br>
                    @else
                        <embed src="/assets/dokumen/sppb_1/{{$dokumen->dokumen1}}#zoom=90" width="70%" height="605px" />
                    @endif
                </div>
            </div>

            <div class="tab-pane fadeshow" id="dokumen1a" role="tabpanel" aria-labelledby="dokumen1a-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($dokumen->dokumen1a, PATHINFO_EXTENSION);
                    @endphp
        
                    @if (in_array($fileExtension, $xlsxExtensions))
                        <p>Sila klik link di bawah untuk muat turun Dokumen Salur Pelajar Baharu</p>
                        <a href="/assets/dokumen/sppb_1a/{{$dokumen->dokumen1a}}" download>Klik Sini</a><br>
                    @else
                        <embed src="/assets/dokumen/sppb_1a/{{$dokumen->dokumen1a}}#zoom=90" width="70%" height="605px" />
                    @endif
                </div>
            </div>

            <div class="tab-pane fadeshow" id="dokumen2" role="tabpanel" aria-labelledby="dokumen2-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($dokumen->dokumen2, PATHINFO_EXTENSION);
                    @endphp
        
                    @if (in_array($fileExtension, $xlsxExtensions))
                        <p>Sila klik link di bawah untuk muat turun Dokumen Laporan Bayaran</p>
                        <a href="/assets/dokumen/sppb_2/{{$dokumen->dokumen2}}" download>Klik Sini</a><br>
                    @else
                        <embed src="/assets/dokumen/sppb_2/{{$dokumen->dokumen2}}#zoom=90" width="70%" height="605px" />
                    @endif
                </div>
            </div>

            <div class="tab-pane fadeshow" id="dokumen2a" role="tabpanel" aria-labelledby="dokumen2a-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($dokumen->dokumen2a, PATHINFO_EXTENSION);
                    @endphp
        
                    @if (in_array($fileExtension, $xlsxExtensions))
                        <p>Sila klik link di bawah untuk muat turun Dokumen Laporan Tuntutan</p>
                        <a href="/assets/dokumen/sppb_2a/{{$dokumen->dokumen2a}}" download>Klik Sini</a><br>
                    @else
                        <embed src="/assets/dokumen/sppb_2a/{{$dokumen->dokumen2a}}#zoom=90" width="70%" height="605px" />
                    @endif
                </div>
            </div>

            <div class="tab-pane fadeshow" id="dokumen3" role="tabpanel" aria-labelledby="dokumen3-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($dokumen->dokumen3, PATHINFO_EXTENSION);
                    @endphp
        
                    @if (in_array($fileExtension, $xlsxExtensions))
                        <p>Sila klik link di bawah untuk muat turun Dokumen Penyata Terimaan</p>
                        <a href="/assets/dokumen/sppb_3/{{$dokumen->dokumen3}}" download>Klik Sini</a><br>
                    @else
                        <embed src="/assets/dokumen/sppb_3/{{$dokumen->dokumen3}}#zoom=90" width="70%" height="605px" />
                    @endif
                </div>
            </div>
            
        </div>
    </div>
</body>
</html>

<script>
      if (navigator.plugins && navigator.plugins.length > 0) {
        // There are plugins installed, including PDF viewer plugins.
        console.log('PDF viewer plugin detected.');
    } else {
        // No PDF viewer plugin detected.
        console.log('No PDF viewer plugin detected.');
    }

    $('.nav').find('.nav-link:first').addClass('active');
    $('.tab-content').find('.tab-pane:first').addClass('active');
</script>
