-<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Senarai Permohonan Disokong</title>
    <link rel="stylesheet" href="assets/css/style.bundle.css">
    <link rel="stylesheet" href="assets/css/saringan.css">
    <style>
        table{
            border: 1px solid black!important;
            width: 100%;
        }
        th{
            padding-top: 6px!important;
            padding-bottom: 6px!important;
            background-color: #3d0066!important;
            color: white!important;
        }
        th,td{
            border: 1px solid black!important;
        }
        body{
            font-size: 11px!important;
        }
        td{
            vertical-align: top!important;
            padding-bottom: 6px!important;
            text-transform:capitalize;
        }
        td:first-line {
            text-transform: capitalize;
        }
        .alignleft {
            float: left;
        }
        .alignright {
            float: right;
        }
        td.no{
            text-align: right;
        }
        .page-number-container {
            position: absolute;
            bottom: 20px; 
            right: 560px; 
            font-size: 12px;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header">
        <div class="image">
            <img src="logoKPT.png" alt="Kementerian Pengajian Tinggi" style="width:10%; height:10%; float: left;">
        </div>
        <div class="alignleft" style="padding-left: 25px; padding-top:25px; font-size: 12px;">
            <b>KEMENTERIAN PENDIDIKAN TINGGI</b>
            <br>MINISTRY OF HIGHER EDUCATION<br>
        </div>
        <div class="alignright" style="padding-top: 10px;">
            <table style="border: none!important;">
                <tr style="border: none!important;">
                    <td style="border: none!important;"><b>No. Mesyuarat </b></td>
                    <td style="border: none!important;"><b>:</b></td>
                    <td style="border: none!important;"><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 10px!important;"></td>
                </tr>
                <tr style="border: none!important;">
                    <td style="border: none!important;"><b>Tarikh Mesyuarat </b></td>
                    <td style="border: none!important;"><b>:</b></td>
                    <td style="border: none!important;"><input type="text" id="tarikhMesyuarat" name="tarikhMesyuarat" style="padding: 10px;"></td>
                </tr>
            </table>
        </div>     
    </div>

    <br><br><br><br><br>

    <div style="margin: 10px; display: block;">
        <div class="tittle" style="text-align: center; font-size: 14px;">
            <b>SENARAI PERMOHONAN BKOKU/PPK YANG DISOKONG</b>
        </div>
        <br>
        {{-- Table --}}
        <table id="sortTable" class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th style="width: 3%"><b>No.</b></th>
                    <th style="width: 10%"><b>ID Permohonan</b></th>
                    <th style="width: 20%"><b>Nama</b></th>
                    <th style="width: 10%"><b>Jenis Kecacatan</b></th>                                        
                    <th style="width: 20%"><b>Nama Kursus</b></th>
                    <th style="width: 20%"><b>Institusi Pengajian</b></th>
                    <th style="width: 8%"><b>Tarikh Mula Pengajian</b></th>
                    <th style="width: 9%"><b>Tarikh Tamat Pengajian</b></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $filteredKelulusan = $kelulusan->filter(function ($item) {
                        $jenis_institusi = DB::table('smoku_akademik')
                            ->join('bk_info_institusi', 'bk_info_institusi.id_institusi', '=', 'smoku_akademik.id_institusi')
                            ->where('smoku_id', $item['smoku_id'])
                            ->value('bk_info_institusi.jenis_institusi');
                        return $item['program'] === 'BKOKU' && $jenis_institusi === 'IPTS';
                    });
                @endphp
            
                @foreach ($filteredKelulusan as $item)
                    @php
                        // Fetch data
                        $smoku = DB::table('smoku')->where('id', $item['smoku_id'])->first();
                        $akademik = DB::table('smoku_akademik')->where('smoku_id', $item['smoku_id'])->first();
                        $institusi = DB::table('bk_info_institusi')->where('id_institusi', $akademik->id_institusi ?? null)->value('nama_institusi');
            
                        // Nama pemohon
                        $nama_pemohon = collect(explode(' ', ucwords(strtolower($smoku->nama))))
                            ->map(fn($word) => in_array(Str::lower($word), ['bin', 'binti']) ? Str::lower($word) : $word)
                            ->implode(' ');
            
                        // Nama kursus
                        $nama_kursus = transformBracketsToCapital(
                            collect(explode(' ', ucwords(strtolower($akademik->nama_kursus ?? ''))))
                                ->map(fn($word) => in_array(Str::lower($word), ['of', 'in', 'and']) ? Str::lower($word) : $word)
                                ->implode(' ')
                        );
            
                        // Institusi pengajian
                        $institusi_pengajian = transformBracketsToUppercase(
                            collect(explode(' ', ucwords(strtolower($institusi ?? ''))))
                                ->map(fn($word) => in_array(Str::lower($word), ['of', 'in', 'and']) ? Str::lower($word) : $word)
                                ->implode(' ')
                        );
            
                        // Jenis kecacatan
                        $jenis_kecacatan = DB::table('smoku')
                            ->join('bk_jenis_oku', 'bk_jenis_oku.kod_oku', '=', 'smoku.kategori')
                            ->where('smoku.id', $item['smoku_id'])
                            ->value('bk_jenis_oku.kecacatan');
                    @endphp
            
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item['no_rujukan_permohonan'] }}</td>
                        <td>{{ $nama_pemohon }}</td>
                        <td>{{ ucwords(strtolower($jenis_kecacatan)) }}</td>
                        <td>{{ $nama_kursus }}</td>
                        <td>{{ $institusi_pengajian }}</td>
                        <td class="text-center">{{ $akademik->tarikh_mula ? date('d/m/Y', strtotime($akademik->tarikh_mula)) : '-' }}</td>
                        <td class="text-center">{{ $akademik->tarikh_tamat ? date('d/m/Y', strtotime($akademik->tarikh_tamat)) : '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <?php
            $pageNumber = 1; // Initialize the page number
        ?>

        <!-- Page number container -->
        <div class="page-number-container">
            {{ $pageNumber }}
        </div>

        <?php
            $pageNumber++; // Increment the page number
        ?>
    </div>

    <script>
        document.getElementById("text").innerHtml = document.getElementById("text").innerHtml.toLowerCase();
    </script>

    <script>
        // Get all pages in the PDF
        const pages = document.querySelectorAll('.page');

        // Get the page number container
        const pageNumberContainer = document.querySelector('.page-number');

        // Function to update the page number when a new page is displayed
        const updatePageNumber = () => {
            const currentPage = Array.from(pages).findIndex(page => page.style.display !== 'none') + 1;
            const totalPages = pages.length;
            pageNumberContainer.textContent = `${currentPage} of ${totalPages}`;
        };

        // Attach an event listener to execute the function when the PDF is loaded
        window.addEventListener('DOMContentLoaded', () => {
            // Update the page number when the PDF is loaded
            updatePageNumber();
        });

        // Attach an event listener to execute the function when a new page is displayed
        document.addEventListener('pagechanged', () => {
            // Update the page number when a new page is displayed
            updatePageNumber();
        });
    </script>
</body>
</html>