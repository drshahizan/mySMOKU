<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Cetak Senarai Pemohon</title>
    <link rel="stylesheet" href="assets/css/style.bundle.css">
    <link rel="stylesheet" href="assets/css/saringan.css">
</head>
<style>
    th,td{
        border: 1px solid black!important;
    }
    body{
        font-size: 11px!important;
    }
</style>
<body>
    <div style="margin: 10px;display: block;">
        <br>
        <h2 style="text-align: center">SENARAI SARINGAN PERMOHONAN</h2>
        <br>
        <table width="100%" style="border: 1px solid black!important;" id="sortTable" class="table table-striped table-hover dataTable js-exportable">
            <thead>
                <tr>
                    <th style="width: 17%"><b>ID Permohonan</b></th>                                        
                    <th style="width: 33%"><b>Nama</b></th>
                    <th style="width: 15%"><b>Jenis Permohonan</b></th>
                    <th style="width: 15%" class="text-center"><b>Tarikh Permohonan</b></th>
                    <th style="width: 15%" class="text-center"><b>Status Saringan</b></th>
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td>Ali Bin Abu</td>
                    <td><a href="{{ url('maklumat-pemohon'. $row['id_permohonan']) }}" title="">SARJANABKOKU000011</a></td>
                    <td>BKOKU</td>
                    <td>7/7/2023</td>
                    <td>Belum Disemak</td>
                </tr> --}}
                <tr>                                            
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPKB970204052445</a></td>
                    <td>Sarah Binti Yusri</td>
                    <td>PPK</td>                                        
                    <td class="text-center">5/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>                                            
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKUB980112105666</a></td>
                    <td>Aishah Binti Samsudin</td>
                    <td>BKOKU</td>                                       
                    <td class="text-center">2/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKUM970703041223</a></td>
                    <td>Santosh A/L Ariyaran</td>
                    <td>BKOKU</td>                                        
                    <td class="text-center">10/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKUM960909105668</a></td>
                    <td>Ling Kai Jie</td>
                    <td>BKOKU</td>                                        
                    <td class="text-center">9/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPKM950804082447</a></td>
                    <td>Akmal Bin Kairuddin</td>
                    <td>PPK</td>                                        
                    <td class="text-center">7/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPKD021212050334</a></td>
                    <td>Santishwaran A/L Paven</td>
                    <td>PPK</td>                                        
                    <td class="text-center">5/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKUP890201065225</a></td>
                    <td>Ezra Hanisah Binti Md Yunos</td>
                    <td>BKOKU</td>                                    
                    <td class="text-center">9/2/2023</td>
                    <td class="text-center">Disokong</td>
                </tr><tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPKD010305058473</a></td>
                    <td>Arshahad Bin Kairul Zaman</td>
                    <td>PPK</td>                                        
                    <td class="text-center">7/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTPPKB981004045253</a></td>
                    <td>Syed Abdul Kassim Hussain Yusof</td>
                    <td>PPK</td>                                        
                    <td class="text-center">5/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKUP940524032341</a></td>
                    <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                    <td>BKOKU</td>                                    
                    <td class="text-center">9/2/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>