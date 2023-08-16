<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cetak Senarai Pemohon</title>
    <link rel="stylesheet" href="assets/css/style.bundle.css">
    <link rel="stylesheet" href="assets/css/saringan.css">
    <style>
        th,td{
            border: 1px solid black!important;
        }
        body{
            font-size: 11px!important;
        }
        td{
            text-transform:capitalize;
        }
        td:first-line {
            text-transform: capitalize;
        }
    </style>
</head>

<body>
    {{-- Header --}}
    <div class="header" style="padding-top: 5px; text-align:center; display:block;">
        <div class="image">
            <img src="logoKPT.png" alt="Kementerian Pengajian Tinggi" style=" width:10%; height:10%;">
        </div>
        <br>
        <div class="tittle" style="font-size: 14px;">
            <b>KEMENTERIAN PENGAJIAN TINGGI</b>
        </div>
    </div>

    <hr style="border:solid 1px black; width: 100%;">

    {{-- Table --}}
    <div style="margin: 10px;display: block;">
        <div class="tittle" style="text-align: center; font-size: 14px;">
            <b>SENARAI PERMOHONAN BKOKU YANG DISOKONG</b>
        </div>
        <br>
        <table width="100%" style="border: 1px solid black!important;" id="sortTable" class="table table-striped">
            <thead>
                <tr>
                    <th style="width: 13%"><b>ID Permohonan</b></th>
                    <th style="width: 5%"><b>Jenis Kecacatan</b></th>                                        
                    <th style="width: 15%"><b>Nama</b></th>
                    <th style="width: 8%"><b>No. Kad Pengenalan</b></th>
                    <th style="width: 7%"><b>Peringkat Pengajian </b></th>
                    <th style="width: 20%"><b>Kursus</b></th>
                    <th style="width: 10%"><b>Institusi Pengajian</b></th>
                    <th style="width: 9%" class="text-center"><b>Tarikh Mula Pengajian</b></th>
                    <th style="width: 13%" class="text-center"><b>Tarikh Tamat Pengajian</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>                                            
                    <td>KPTBKOKUB980112105666</td>
                    <td>Pendengaran</td>                                       
                    <td>Aishah Binti Samsudin</td>
                    <td>020112105666</td>
                    <td>Sarjana Muda</td>
                    <td>Business Administration (Hons) in International Business and Finance</td>
                    <td>Universiti Tunku Abdul Rahman</td>
                    <td class="text-center">02/07/2020</td>
                    <td class="text-center">20/07/2023</td>
                </tr> 
                <tr>                                            
                    <td>KPTBKOKUM970703041223</td>
                    <td>penglihatan</td>
                    <td>Mohd Ali Bin Abu Kassim</td>
                    <td>030703041223</td>
                    <td>Diploma</td>
                    <td>Information and Communication Technology</td>
                    <td>Universiti Antarabangsa Inti</td>
                    <td class="text-center">03/09/2019</td>
                    <td class="text-center">27/07/2023</td>
                </tr> 
                <tr>                                            
                    <td>KPTBKOKUB970204052445</td>
                    <td>penglihatan</td>
                    <td>Sarah Binti Yusri</td>
                    <td>970204052445</td>
                    <td>Sarjana Muda</td>
                    <td>Science in Psychology</td>
                    <td>Universiti Teknologi MARA</td>
                    <td class="text-center">15/09/2019</td>
                    <td class="text-center">05/07/2023</td>
                </tr> 
                <tr>
                    <td>KPTBKOKUM970703041223</td>
                    <td>fizikal</td>
                    <td>Santosh A/L Ariyaran</td>
                    <td>970703041223</td> 
                    <td>Sarjana</td>
                    <td>Science Biotechnology</td>
                    <td>Universiti Teknologi Petronas</td>                                     
                    <td class="text-center">10/7/2021</td>
                    <td class="text-center">03/08/2024</td>
                </tr> 
                <tr>
                    <td>KPTBKOKUM960909105668</td>
                    <td>pertuturan</td>                                        
                    <td>Ling Kai Jie</td>
                    <td>960909105668</td>
                    <td>Doktor Falsafah</td>
                    <td>Social Science And Humanities</td>
                    <td>Universiti Teknologi MARA</td>
                    <td class="text-center">08/07/2022</td>
                    <td class="text-center">08/07/2024</td>
                </tr> 
                <tr>
                    <td>KPTBKOKUM950804082447</td>
                    <td>pertuturan</td>                                        
                    <td>Akmal Bin Kairuddin</td>
                    <td>950804082447</td>
                    <td>Doktor Falsafah</td>
                    <td>Creative Industries and Art Practice</td>
                    <td>Universiti Teknologi Kreatif Limkokwing</td>
                    <td class="text-center">07/07/2023</td>
                    <td class="text-center">18/07/2025</td>
                </tr>
                <tr>
                    <td>KPTBKOKUD021212050334</td>
                    <td>pertuturan</td>                                        
                    <td>Santishwaran A/L Paven</td>
                    <td>021212050334</td>
                    <td>Sarjana Muda</td>
                    <td>Computer Science (Computer Network and Security)</td>
                    <td>Universiti Teknologi Malaysia</td>
                    <td class="text-center">05/09/2021</td>
                    <td class="text-center">05/08/2025</td>
                </tr>
                <tr>
                    <td>KPTBKOKUP990201065225</td>
                    <td>Pendengaran</td>                                    
                    <td>Ezra Hanisah Binti Md Yunos</td>
                    <td>890201065225</td>
                    <td>Sarjana Muda</td>
                    <td>Computer Science (Graphics and Multimedia Software)</td>
                    <td>Universiti Teknologi Malaysia</td>
                    <td class="text-center">05/09/2020</td>
                    <td class="text-center">05/07/2024</td>
                </tr>
                <tr>
                    <td>KPTBKOKUD010305058473</td>
                    <td>fizikal</td>                                        
                    <td>Arshahad Bin Kairul Zaman</td>
                    <td>010305058473</td>
                    <td>Sarjana Muda</td>
                    <td>Industrial Mathematics</td>
                    <td>Universiti Teknologi MARA</td>
                    <td class="text-center">07/09/2021</td>
                    <td class="text-center">20/07/2025</td>
                </tr>
                <tr>
                    <td>KPTBKOKUB981004045253</td>
                    <td>Pembelajaran</td>
                    <td>Syed Abdul Kassim Hussain Yusof</td>
                    <td>981004045253</td>
                    <td>Sarjana Muda</td>
                    <td>Business Administration (Honours) Healthcare Management</td>
                    <td>Universiti Teknologi MARA</td>                                        
                    <td class="text-center">05/09/2022</td>
                    <td class="text-center">20/07/2025</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById("text").innerHtml = document.getElementById("text").innerHtml.toLowerCase()
    </script>
</body>
</html>