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
        footer .pagenum:before {
            content: counter(page);
        }
        footer { 
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px; 
            height: 50px; 
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
    {{-- Table --}}
    <div style="margin: 10px; display: block;">
        <div class="tittle" style="text-align: center; font-size: 14px;">
            <b>SENARAI PERMOHONAN BKOKU/PPK YANG DISOKONG</b>
        </div>
        <br>
        <table id="sortTable" class="table table-striped">
            <thead class="text-center">
                <tr>
                    <th style="width: 3%"><b>No.</b></th>
                    <th style="width: 15%"><b>ID Permohonan</b></th>
                    <th style="width: 5%"><b>Jenis Permohonan</b></th>
                    <th style="width: 20%"><b>Nama</b></th>
                    <th style="width: 5%"><b>Jenis Kecacatan</b></th>                                        
                    <th style="width: 5%"><b>Peringkat Pengajian </b></th>
                    <th style="width: 15%"><b>Nama Kursus</b></th>
                    <th style="width: 5%"><b>Institusi Pengajian</b></th>
                    <th style="width: 9%"><b>Tarikh Mula Pengajian</b></th>
                    <th style="width: 18%"><b>Tarikh Tamat Pengajian</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="no">1.</td>                                            
                    <td>KPTPPK/3/B980112105666</td>
                    <td>PPK</td>
                    <td>Aishah Binti Samsudin</td>
                    <td>Pendengaran</td>                                       
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Business Administration (Hons) In International Business And Finance</td>
                    <td>UTAR</td>
                    <td class="text-center">02/07/2020</td>
                    <td class="text-center">20/07/2023</td>
                </tr> 
                <tr>
                    <td class="no">2.</td>                                            
                    <td>KPTBKOKU/2/970703041223</td>
                    <td>BKOKU</td>
                    <td>Mohd Ali Bin Abu Kassim</td>
                    <td>penglihatan</td>
                    <td>Diploma</td>
                    <td>Diploma In Information And Communication Technology</td>
                    <td>INTI</td>
                    <td class="text-center">03/09/2019</td>
                    <td class="text-center">27/07/2023</td>
                </tr> 
                <tr> 
                    <td class="no">3.</td>                                           
                    <td>KPT/BKOKU/3/970204052445</td>
                    <td>BKOKU</td>
                    <td>Sarah Binti Yusri</td>
                    <td>penglihatan</td>
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Science In Psychology With Management</td>
                    <td>UiTM(Shah Alam)</td>
                    <td class="text-center">15/09/2019</td>
                    <td class="text-center">05/07/2023</td>
                </tr> 
                <tr>
                    <td class="no">4.</td>
                    <td>KPT/BKOKU/5/970703041223</td>
                    <td>BKOKU</td>
                    <td>Santosh A/L Ariyaran</td>
                    <td>fizikal</td>
                    <td>Sarjana</td>
                    <td>Master Of Science Data Science</td>
                    <td>UTP</td>                                     
                    <td class="text-center">10/7/2021</td>
                    <td class="text-center">03/08/2024</td>
                </tr> 
                <tr>
                    <td class="no">5.</td>
                    <td>KPT/BKOKU/6/960909105668</td>
                    <td>BKOKU</td>
                    <td>Ling Kai Jie</td>
                    <td>pertuturan</td>                                        
                    <td>Doktor Falsafah</td>
                    <td>Doctor Of Philosophy (Phd) In Social Science And Humanities</td>
                    <td>UiTM(Shah Alam)</td>
                    <td class="text-center">08/07/2022</td>
                    <td class="text-center">08/07/2024</td>
                </tr> 
                <tr>
                    <td class="no">6.</td>
                    <td>KPT/BKOKU/6/950804082447</td>
                    <td>BKOKU</td>
                    <td>Akmal Bin Kairuddin</td>
                    <td>pertuturan</td>                                        
                    <td>Doktor Falsafah</td>
                    <td>Doctor Of Philosophy (Phd) Creative Industries & Art Practice</td>
                    <td>Universiti Limkokwing</td>
                    <td class="text-center">07/07/2023</td>
                    <td class="text-center">18/07/2025</td>
                </tr>
                <tr>
                    <td class="no">7.</td>
                    <td>KPT/BKOKU/3/021212050334</td>
                    <td>BKOKU</td>
                    <td>Santishwaran A/L Paven</td>
                    <td>pertuturan</td>                                        
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Science Computer Science</td>
                    <td>UTM(Skudai)</td>
                    <td class="text-center">05/09/2021</td>
                    <td class="text-center">05/08/2025</td>
                </tr>
                <tr>
                    <td class="no">8.</td>
                    <td>KPT/PPK/3/990201065225</td>
                    <td>PPK</td>
                    <td>Ezra Hanisah Binti Md Yunos</td>
                    <td>Pendengaran</td>                                    
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Science Computer Science</td>
                    <td>UTM(Skudai)</td>
                    <td class="text-center">05/09/2020</td>
                    <td class="text-center">05/07/2024</td>
                </tr>
                <tr>
                    <td class="no">9.</td>
                    <td>KPT/BKOKU/3/010305058473</td>
                    <td>BKOKU</td>
                    <td>Arshahad Bin Kairul Zaman</td>
                    <td>fizikal</td>                                        
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Public Administration (Honours)</td>
                    <td>UiTM(Dungun)</td>
                    <td class="text-center">07/09/2021</td>
                    <td class="text-center">20/07/2025</td>
                </tr>
                <tr>
                    <td class="no">10.</td>
                    <td>KPT/BKOKU/3/981004045253</td>
                    <td>BKOKU</td>
                    <td>Syed Abdul Kassim Hussain Yusof</td>
                    <td>Pembelajaran</td>
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Business Administration (Honours) Healthcare Management</td>
                    <td>UiTM(Shah Alam)</td>                                        
                    <td class="text-center">05/09/2022</td>
                    <td class="text-center">20/07/2025</td>
                </tr>
                <tr>
                    <td class="no">11.</td>                                            
                    <td>KPTPPK/3/B980112105666</td>
                    <td>PPK</td>
                    <td>Aishah Binti Samsudin</td>
                    <td>Pendengaran</td>                                       
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Business Administration (Hons) In International Business</td>
                    <td>UTAR</td>
                    <td class="text-center">02/07/2020</td>
                    <td class="text-center">20/07/2023</td>
                </tr> 
                {{-- <tr>
                    <td class="no">2.</td>                                            
                    <td>KPTBKOKU/2/970703041223</td>
                    <td>BKOKU</td>
                    <td>Mohd Ali Bin Abu Kassim</td>
                    <td>penglihatan</td>
                    <td>Diploma</td>
                    <td>Diploma In Information And Communication Technology</td>
                    <td>INTI</td>
                    <td class="text-center">03/09/2019</td>
                    <td class="text-center">27/07/2023</td>
                </tr> 
                <tr> 
                    <td class="no">3.</td>                                           
                    <td>KPT/BKOKU/3/970204052445</td>
                    <td>BKOKU</td>
                    <td>Sarah Binti Yusri</td>
                    <td>penglihatan</td>
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Science In Psychology With Management</td>
                    <td>UiTM(Shah Alam)</td>
                    <td class="text-center">15/09/2019</td>
                    <td class="text-center">05/07/2023</td>
                </tr> 
                <tr>
                    <td class="no">4.</td>
                    <td>KPT/BKOKU/5/970703041223</td>
                    <td>BKOKU</td>
                    <td>Santosh A/L Ariyaran</td>
                    <td>fizikal</td>
                    <td>Sarjana</td>
                    <td>Master Of Science Data Science</td>
                    <td>UTP</td>                                     
                    <td class="text-center">10/7/2021</td>
                    <td class="text-center">03/08/2024</td>
                </tr> 
                <tr>
                    <td class="no">5.</td>
                    <td>KPT/BKOKU/6/960909105668</td>
                    <td>BKOKU</td>
                    <td>Ling Kai Jie</td>
                    <td>pertuturan</td>                                        
                    <td>Doktor Falsafah</td>
                    <td>Doctor Of Philosophy (Phd) In Social Science And Humanities</td>
                    <td>UiTM(Shah Alam)</td>
                    <td class="text-center">08/07/2022</td>
                    <td class="text-center">08/07/2024</td>
                </tr> 
                <tr>
                    <td class="no">6.</td>
                    <td>KPT/BKOKU/6/950804082447</td>
                    <td>BKOKU</td>
                    <td>Akmal Bin Kairuddin</td>
                    <td>pertuturan</td>                                        
                    <td>Doktor Falsafah</td>
                    <td>Doctor Of Philosophy (Phd) Creative Industries & Art Practice</td>
                    <td>Universiti Limkokwing</td>
                    <td class="text-center">07/07/2023</td>
                    <td class="text-center">18/07/2025</td>
                </tr>
                <tr>
                    <td class="no">7.</td>
                    <td>KPT/BKOKU/3/021212050334</td>
                    <td>BKOKU</td>
                    <td>Santishwaran A/L Paven</td>
                    <td>pertuturan</td>                                        
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Science Computer Science</td>
                    <td>UTM(Skudai)</td>
                    <td class="text-center">05/09/2021</td>
                    <td class="text-center">05/08/2025</td>
                </tr>
                <tr>
                    <td class="no">8.</td>
                    <td>KPT/PPK/3/990201065225</td>
                    <td>PPK</td>
                    <td>Ezra Hanisah Binti Md Yunos</td>
                    <td>Pendengaran</td>                                    
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Science Computer Science</td>
                    <td>UTM(Skudai)</td>
                    <td class="text-center">05/09/2020</td>
                    <td class="text-center">05/07/2024</td>
                </tr>
                <tr>
                    <td class="no">9.</td>
                    <td>KPT/BKOKU/3/010305058473</td>
                    <td>BKOKU</td>
                    <td>Arshahad Bin Kairul Zaman</td>
                    <td>fizikal</td>                                        
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Public Administration (Honours)</td>
                    <td>UiTM(Dungun)</td>
                    <td class="text-center">07/09/2021</td>
                    <td class="text-center">20/07/2025</td>
                </tr>
                <tr>
                    <td class="no">10.</td>
                    <td>KPT/BKOKU/3/981004045253</td>
                    <td>BKOKU</td>
                    <td>Syed Abdul Kassim Hussain Yusof</td>
                    <td>Pembelajaran</td>
                    <td>Sarjana Muda</td>
                    <td>Bachelor Of Business Administration (Honours) Healthcare Management</td>
                    <td>UiTM(Shah Alam)</td>                                        
                    <td class="text-center">05/09/2022</td>
                    <td class="text-center">20/07/2025</td>
                </tr> --}}
            </tbody>
        </table>
        <footer>
            <div class="pagenum-container" style="float: right">Page
                <span class="pagenum"></span>
            </div>
        </footer>
    </div>

    <script>
        document.getElementById("text").innerHtml = document.getElementById("text").innerHtml.toLowerCase();
    </script>

    {{-- <script type="text/php">
        if (isset($pdf)) 
        {
            $x = 400;
            $y = 10;
            $text = "Page {PAGE_NUM}";
            $font = null;
            $size = 8;
            $color = array(0,0,0);
            $word_space = 0.0; 
            $char_space = 0.0; 
            $angle = 0.0;  
            $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
        }
    </script> --}}
</body>
</html>