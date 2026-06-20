<x-default-layout>
    <head>
        <title>Sekretariat BKOKU KPT</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <style>
        .nav{
            margin-left: 10px!important;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 145px;
            height: 32px;
            padding: 0 18px;
            border-radius: 6px;
            color: #ffffff;
            font-weight: 700;
            line-height: 1;
            text-align: center;
        }

        .status-info {
            background-color: #7c3aed;
        }

        .status-baharu {
            background-color: #2877e3;
        }

        .status-saringan {
            background-color: #f59e0b;
        }

        .status-disokong {
            background-color: #f59e0b;
        }

        .status-dikembalikan {
            background-color: #e95b4f;
        }

        .status-layak {
            background-color: #51cb85;
        }

        .status-tidak-layak {
            background-color: #f2386b;
        }

        .status-dibayar {
            background-color: #16a6ad;
        }

        .status-batal {
            background-color: #6c757d;
        }

        .sejarah-table td,
        .sejarah-table th {
            vertical-align: middle;
        }

        .sejarah-table .status-cell {
            text-align: center;
        }

        .sejarah-table .id-column {
            width: 42%;
        }

        .sejarah-table .date-column {
            width: 15%;
        }

        .sejarah-table .status-column {
            width: 20%;
        }

        .sejarah-table .executor-column {
            width: 23%;
            white-space: normal;
            word-break: normal;
        }
    </style>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Permohonan</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Permohonan</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Sejarah</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->
    <br>
    <body>
    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <!-- Page header section  -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Sejarah Permohonan <br><small> Klik ID Permohonan untuk melihat maklumat lanjut rekod permohonan</small></h2>
                        </div>
                        <div class="body">
                            @php
                                $formatNama = function ($nama) {
                                    if (!$nama) {
                                        return null;
                                    }

                                    $conjunctions = ['bin', 'binti'];
                                    $words = explode(' ', strtolower($nama));

                                    return collect($words)->map(function ($word) use ($conjunctions) {
                                        if (in_array($word, $conjunctions, true)) {
                                            return $word;
                                        }

                                        return collect(explode("'", $word))->map(function ($part) {
                                            return ucfirst($part);
                                        })->implode("'");
                                    })->implode(' ');
                                };

                                $statusMap = [
                                    1 => ['label' => 'Deraf', 'class' => 'status-info', 'route' => 'papar.rekod.permohonan.id'],
                                    2 => ['label' => 'Baharu', 'class' => 'status-baharu', 'route' => 'papar.rekod.permohonan.id'],
                                    3 => ['label' => 'Sedang Disaring', 'class' => 'status-saringan', 'route' => 'papar.rekod.permohonan.id'],
                                    4 => ['label' => 'Disokong', 'class' => 'status-disokong', 'route' => 'papar.rekod.saringan.id'],
                                    5 => ['label' => 'Dikembalikan', 'class' => 'status-dikembalikan', 'route' => 'papar.rekod.saringan.id'],
                                    6 => ['label' => 'Layak', 'class' => 'status-layak', 'route' => 'papar.rekod.kelulusan.id'],
                                    7 => ['label' => 'Tidak Layak', 'class' => 'status-tidak-layak', 'route' => 'papar.rekod.kelulusan.id'],
                                    8 => ['label' => 'Dibayar', 'class' => 'status-dibayar', 'route' => 'papar.rekod.pembayaran.id'],
                                    9 => ['label' => 'Batal', 'class' => 'status-batal', 'route' => 'papar.rekod.permohonan.id'],
                                    10 => ['label' => 'Berhenti', 'class' => 'status-batal', 'route' => 'papar.rekod.permohonan.id'],
                                ];
                                $pelaksanaDisokong = $sejarah_p->firstWhere('status', 4)?->pelaksana;
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-striped table-hover sejarah-table">
                                    <thead>
                                        <tr>
                                            <th class="id-column">ID Permohonan</th>
                                            <th class="date-column">Tarikh Status</th>
                                            <th class="status-column status-cell">Status</th>
                                            <th class="executor-column">Dilaksanakan Oleh</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($sejarah_p as $rekod)
                                        @php
                                            $statusInfo = $statusMap[(int) $rekod->status] ?? ['label' => 'Tiada Maklumat', 'class' => 'status-batal', 'route' => 'papar.rekod.permohonan.id'];
                                            $detailUrl = route($statusInfo['route'], ['id' => $rekod->id]);
                                            $statusDate = optional($rekod->created_at)->format('d/m/Y');
                                            $pelaksanaUser = $rekod->pelaksana;

                                            if (in_array((int) $rekod->status, [6, 7], true) && !$pelaksanaUser) {
                                                $pelaksanaUser = $pelaksanaDisokong;
                                            }

                                            $pelaksana = $formatNama($pelaksanaUser->name ?? $pelaksanaUser->nama ?? null);
                                        @endphp
                                        <tr>
                                            <td><a href="{{ $detailUrl }}">{{ $permohonan->no_rujukan_permohonan }}</a></td>
                                            <td>{{ $statusDate ?: '-' }}</td>
                                            <td class="status-cell">
                                                <span class="status-pill {{ $statusInfo['class'] }}">{{ $statusInfo['label'] }}</span>
                                            </td>
                                            <td class="executor-column">{{ $pelaksana ?: '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tiada rekod sejarah ditemui.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>
</x-default-layout>
