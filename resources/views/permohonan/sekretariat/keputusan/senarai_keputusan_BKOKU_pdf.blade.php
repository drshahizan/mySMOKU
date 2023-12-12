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
            background-color: rgb(35, 58, 108)!important;
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
            right: 390px; 
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
        <div class="alignleft" style="padding-left: 30px; padding-top:25px; font-size: 12px;">
            <b>KEMENTERIAN PENDIDIKAN TINGGI</b>
            <br>MINISTRY OF HIGHER EDUCATION<br>
        </div>
        <div class="alignright" style="padding-top: 10px;">
            <table style="border: none!important;">
                <tr style="border: none!important; font-size:12px;">
                    <td style="border: none!important;"><b>Tarikh Cetak </b></td>
                    <td style="border: none!important;"><b>:</b></td>
                    <td style="border: none!important;"><input type="text" id="tarikhMesyuarat" name="tarikhMesyuarat" style="padding: 10px; vertical-align:middle;"></td>
                </tr>
            </table>
        </div>     
    </div>

    <br><br><br>

    <div style="padding-top: 20px;  display: block;">
        <div class="tittle" style="text-align: center; font-size: 14px;">
            <b>SENARAI KEPUTUSAN PERMOHONAN BKOKU</b>
        </div>
        
        {{-- Table --}}
        <table class="table table-striped" style="margin: 10px;">
            <thead>
                <tr style="color: white; background-color: #3d0066;">
                    <th style="width: 3%" class="text-center no-sort"><b>No.</b></th>
                    <th style="width: 10%"><b>ID Permohonan</b></th>                                        
                    <th style="width: 25%"><b>Nama</b></th>
                    <th class="text-center" style="width: 22%"><b>Institusi Pengajian</b></th> 
                    <th class="text-center" style="width: 10%"><b>Peringkat Pengajian</b></th> 
                    <th class="text-center" style="width: 10%"><b>No. Mesyuarat</b></th>
                    <th class="text-center" style="width: 10%"><b>Tarikh Kemaskini Keputusan</b></th> 
                    <th class="text-center" style="width: 10%"><b>Status Permohonan</b></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                    require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                @endphp

                @foreach ($permohonan as $item)
                    @php
                        $no_rujukan_permohonan = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('no_rujukan_permohonan');
                        $nama = DB::table('permohonan')->join('smoku', 'smoku.id', '=', 'permohonan.smoku_id')->where('permohonan.id', $item['permohonan_id'])->value('smoku.nama');
                        $program = DB::table('permohonan')->where('id',$item['permohonan_id'])->value('program');
                        $institusi_pengajian = DB::table('permohonan')->join('smoku_akademik', 'permohonan.smoku_id', '=', 'smoku_akademik.smoku_id')
                                                ->join('bk_info_institusi', 'smoku_akademik.id_institusi', '=', 'bk_info_institusi.id_institusi')
                                                ->where('permohonan.id', $item['permohonan_id'])
                                                ->value('bk_info_institusi.nama_institusi');

                        //peringkat pengajian
                        preg_match('/\/(\d+)\//', $no_rujukan_permohonan, $matches); // Extract peringkat pengajian value using regular expression
                        $peringkat_pengajian = isset($matches[1]) ? $matches[1] : null; // $matches[1] will contain the extracted peringkat pengajian value
                        $nama_peringkat = DB::table('bk_peringkat_pengajian')->where('kod_peringkat', $peringkat_pengajian)->value('peringkat');

                        //nama pemohona
                        $text = ucwords(strtolower($nama));
                        $conjunctions = ['bin', 'binti'];
                        $words = explode(' ', $text);
                        $result = [];
                        foreach ($words as $word) {
                            if (in_array(Str::lower($word), $conjunctions)) {
                                $result[] = Str::lower($word);
                            } else {
                                $result[] = $word;
                            }
                        }
                        $pemohon = implode(' ', $result);

                        //institusi pengajian
                        $text3 = ucwords(strtolower($institusi_pengajian)); 
                            $conjunctions = ['of', 'in', 'and'];
                            $words = explode(' ', $text3);
                            $result = [];
                            foreach ($words as $word) {
                                if (in_array(Str::lower($word), $conjunctions)) {
                                    $result[] = Str::lower($word);
                                } else {
                                    $result[] = $word;
                                }
                            }
                        $institusi = implode(' ', $result);
                        $nama_institusi = transformBracketsToUppercase($institusi);
                    @endphp

                    @if($program == "BKOKU")
                        <tr>
                            <td class="text-center">{{$i++}}</td>
                            <td>{{$no_rujukan_permohonan}}</td>
                            <td>{{$pemohon}}</td>
                            <td>{{$nama_institusi}}</td>
                            <td class="text-center">{{ucwords(strtolower($nama_peringkat))}}</td>
                            <td class="text-center">{{$item->no_mesyuarat}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($item->tarikh_mesyuarat))}}</td>
                            @if($item->keputusan == "Lulus")
                                <td class="text-center">Layak</td>
                            @elseif($item->keputusan == "Tidak Lulus")
                                <td class="text-center">Tidak Layak</td>
                            @endif
                        </tr>
                    @endif
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