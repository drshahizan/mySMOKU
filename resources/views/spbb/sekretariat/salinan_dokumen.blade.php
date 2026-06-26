<x-default-layout>
    <style>
        .spbb-document-frame {
            border: 1px solid black!important;
        }

        .spbb-document-viewer {
            width: 100%;
            height: 80vh;
        }
    </style>

    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Penyaluran</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <li class="breadcrumb-item text-dark" style="color:darkblue">Muat Turun</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark" style="color:darkblue">Borang SPBB</li>
        </ul>
    </div>

    <br>

    <div class="card p-5">
        <h3>Muat Turun Borang Permohonan Peruntukan Program BKOKU</h3>

    @if ($dokumenSenarai->isNotEmpty())
        <form method="GET" class="mb-5">
            <label for="dokumen_id" class="form-label">Sesi Salur</label>
            <div class="w-100 mw-400px">
                <select name="dokumen_id" id="dokumen_id" class="form-select" onchange="this.form.submit()">
                    @foreach ($dokumenSenarai as $doc)
                        <option value="{{ $doc->id }}" {{ $dokumen && $dokumen->id == $doc->id ? 'selected' : '' }}>
                            {{ $doc->sesi_salur }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if ($dokumen)
                <div class="text-muted mt-2">
                    No Rujukan: {{ $dokumen->no_rujukan }}
                </div>
            @endif
        </form>
    @endif
    
    <div class="spbb-document-frame">
        @if (!$dokumen)
            <p style="text-align: center; margin: 20px;">Tiada dokumen SPBB dimuat naik untuk institusi ini.</p>
        @else
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen1-tab" data-bs-toggle="tab" data-bs-target="#dokumen1" type="button" role="tab" aria-controls="dokumen1" aria-selected="true">
                    SPBB 1
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen1a-tab" data-bs-toggle="tab" data-bs-target="#dokumen1a" type="button" role="tab" aria-controls="dokumen1a" aria-selected="true">
                    SPBB 1a
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen2-tab" data-bs-toggle="tab" data-bs-target="#dokumen2" type="button" role="tab" aria-controls="dokumen2" aria-selected="true">
                    SPBB 2
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen2a-tab" data-bs-toggle="tab" data-bs-target="#dokumen2a" type="button" role="tab" aria-controls="dokumen2a" aria-selected="true">
                    SPBB 2a
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen3-tab" data-bs-toggle="tab" data-bs-target="#dokumen3" type="button" role="tab" aria-controls="dokumen3" aria-selected="true">
                    SPBB 3
                </button>
            </li>  
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dokumen4-tab" data-bs-toggle="tab" data-bs-target="#dokumen4" type="button" role="tab" aria-controls="dokumen4" aria-selected="true">
                    Surat Iringan Universiti
                </button>
            </li>  
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="penyata-tab" data-bs-toggle="tab" data-bs-target="#penyata" type="button" role="tab" aria-controls="penyata" aria-selected="true">
                    Penyata Bank
                </button>
            </li>  
        </ul>
    
        <div class="tab-content" id="myTabContent">
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
                    @elseif (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/sppb_1/{{$dokumen->dokumen1}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Dokumen Permohonan Salur Pelajar Sedia Ada tidak dimuat naik oleh penyelaras.</p>
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
                    @elseif (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/sppb_1a/{{$dokumen->dokumen1a}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Dokumen Salur Pelajar Baharu tidak dimuat naik oleh penyelaras.</p>
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
                    @elseif (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/sppb_2/{{$dokumen->dokumen2}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Dokumen Laporan Bayaran tidak dimuat naik oleh penyelaras.</p>
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
                    @elseif (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/sppb_2a/{{$dokumen->dokumen2a}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Dokumen Laporan Tuntutan tidak dimuat naik oleh penyelaras.</p>
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
                    @elseif (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/sppb_3/{{$dokumen->dokumen3}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Dokumen Penyata Terimaan tidak dimuat naik oleh penyelaras.</p>
                    @endif
                </div>
            </div>

            <div class="tab-pane fadeshow" id="dokumen4" role="tabpanel" aria-labelledby="dokumen4-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($dokumen->dokumen4, PATHINFO_EXTENSION);
                    @endphp

                    @if (in_array($fileExtension, $xlsxExtensions))
                        <p>Sila klik link di bawah untuk muat turun Dokumen Surat Iringan Universiti</p>
                        <a href="/assets/dokumen/sppb_4/{{$dokumen->dokumen4}}" download>Klik Sini</a><br>
                    @elseif (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/sppb_4/{{$dokumen->dokumen4}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Dokumen Surat Iringan Universiti tidak dimuat naik oleh penyelaras.</p>
                    @endif
                </div>
            </div>

            <div class="tab-pane fadeshow" id="penyata" role="tabpanel" aria-labelledby="penyata-tab">
                <div style="text-align: center">
                    @php
                        $fileExtension = pathinfo($penyata->penyata_bank ?? '', PATHINFO_EXTENSION);
                    @endphp
                    
                    @if (in_array($fileExtension, $pdfExtensions))
                        <embed src="/assets/dokumen/penyata_bank_islam/{{$penyata->penyata_bank}}#zoom=90" class="spbb-document-viewer" />
                    @else
                        <p>Penyata bank tidak dimuat naik oleh penyelaras.</p>
                    @endif
                </div>
            </div>

        </div>
        @endif
    </div>
    </div>

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
</x-default-layout>
