<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cetak Senarai Pemohon</title>
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
            bottom: 10px; /* Adjust the vertical position as needed */
            right: 550px; /* Adjust the horizontal position as needed */
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
                    <th style="width: 12%"><b>ID Permohonan</b></th>
                    {{-- <th style="width: 5%"><b>Jenis Permohonan</b></th> --}}
                    <th style="width: 20%"><b>Nama</b></th>
                    <th style="width: 10%"><b>Jenis Kecacatan</b></th>                                        
                    {{-- <th style="width: 10%"><b>Peringkat Pengajian </b></th> --}}
                    <th style="width: 20%"><b>Nama Kursus</b></th>
                    <th style="width: 15%"><b>Institusi Pengajian</b></th>
                    <th style="width: 10%"><b>Tarikh Mula Pengajian</b></th>
                    <th style="width: 10%"><b>Tarikh Tamat Pengajian</b></th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                @php
                    require_once app_path('helpers.php'); // Replace with the actual path to your helper file
                @endphp
            
                @foreach ($kelulusan as $item)
                        @php
                            $i++;
                            $nama_pemohon = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_pelajar');
                            $nama_kursus = DB::table('maklumatakademik')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nama_kursus');
                            $nokp = DB::table('pelajar')->where('nokp_pelajar', $item['nokp_pelajar'])->value('nokp_pelajar');
                            $jenis_kecacatan = DB::table('pelajar')->join('bk_jenisoku','bk_jenisoku.kodoku','=','pelajar.kecacatan' )->where('nokp_pelajar', $item['nokp_pelajar'])->value('bk_jenisoku.kecacatan'); //PH,SD
                            $institusi_pengajian = DB::table('maklumatakademik')->join('bk_infoipt','bk_infoipt.idipt','=','maklumatakademik.id_institusi' )->where('nokp_pelajar', $item['nokp_pelajar'])->value('bk_infoipt.namaipt');
                            
                            // nama pemohon
                            $text = ucwords(strtolower($nama_pemohon)); // Assuming you're sending the text as a POST parameter
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

                            //nama kursus
                            $text2 = ucwords(strtolower($nama_kursus)); // Assuming you're sending the text as a POST parameter
                            $conjunctions = ['of', 'in', 'and'];
                            $words = explode(' ', $text2);
                            $result = [];
                            foreach ($words as $word) {
                                if (in_array(Str::lower($word), $conjunctions)) {
                                    $result[] = Str::lower($word);
                                } else {
                                    $result[] = $word;
                                }
                            }
                            $kursus = implode(' ', $result);
                            $namakursus = transformBracketsToCapital($kursus);

                            //institusi pengajian
                            $text3 = ucwords(strtolower($institusi_pengajian)); // Assuming you're sending the text as a POST parameter
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
                            $institusipengajian = transformBracketsToUppercase($institusi);
                        @endphp
                        
                        <tr>
                            <td class="text-center">{{$i}}</td>                                           
                            <td><a href="{{ url('kemaskini/kelulusan/'. $nokp) }}" target="_blank">{{$item['id_permohonan']}}</a></td>
                            <td>{{$pemohon}}</td>
                            <td>{{ucwords(strtolower($jenis_kecacatan))}}</td>                                       
                            <td>{{$namakursus}}</td>
                            <td>{{$institusipengajian}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($item['tkh_mula']))}}</td>
                            <td class="text-center">{{date('d/m/Y', strtotime($item['tkh_tamat']))}}</td>
                        </tr>
                @endforeach 
            </tbody>
        </table>

        <?php
            $pageNumber = 1; // Initialize the page number
        ?>

        <!-- Page number container -->
        <div class="page-number-container">
            Page: {{ $pageNumber }}
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