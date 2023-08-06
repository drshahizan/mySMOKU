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
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">SARJANABKOKU000011</a></td>
                    <td>Mohd Ali Bin Abu Kassim</td>
                    <td>BKOKU</td>
                    <td class="text-center">7/7/2023</td>
                    <td class="text-center">Belum Disemak</td>
                </tr>
                <tr>                                            
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK000021</a></td>
                    <td>Sarah Binti Yusri</td>
                    <td>PPK</td>                                        
                    <td class="text-center">5/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>                                            
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">PHDBKOKU000021</a></td>
                    <td>Aishah Binti Samsudin</td>
                    <td>BKOKU</td>                                        
                    <td class="text-center">2/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">DIPBKOKU000021</a></td>
                    <td>Santosh A/L Ariyaran</td>
                    <td>BKOKU</td>                                        
                    <td class="text-center">10/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">SARJANABKOKU000021</a></td>
                    <td>Ling Kai Jie</td>
                    <td>BKOKU</td>                                        
                    <td class="text-center">9/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr> <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK40021</a></td>
                    <td>Akmal Bin Kairuddin</td>
                    <td>PPK</td>                                        
                    <td class="text-center">7/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK60021</a></td>
                    <td>Santishwaran A/L Paven</td>
                    <td>PPK</td>                                        
                    <td class="text-center">5/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">DIPLOMABKOKU002011</a></td>
                    <td>Choo Mei Ling</td>
                    <td>BKOKU</td>
                    <td class="text-center">7/6/2023</td>
                    <td class="text-center">Dikembalikan</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">PHDBKOKU000011</a></td>
                    <td>Ezra Hanisah Binti Md Yunos</td>
                    <td>BKOKU</td>                                    
                    <td class="text-center">9/2/2023</td>
                    <td class="text-center">Disokong</td>
                </tr><tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK40021</a></td>
                    <td>Akmal Bin Kairuddin</td>
                    <td>PPK</td>                                        
                    <td class="text-center">7/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">KKPPK60021</a></td>
                    <td>Syed Abdul Kassim Hussain Yusof</td>
                    <td>PPK</td>                                        
                    <td class="text-center">5/7/2023</td>
                    <td class="text-center">Disokong</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">DIPLOMABKOKU002011</a></td>
                    <td>Shakira Mariam Aqilah Binti Syed Abdul Rahman</td>
                    <td>BKOKU</td>                                        
                    <td class="text-center">7/6/2023</td>
                    <td class="text-center">Dikembalikan</td>
                </tr>
                <tr>
                    <td><a href="{{ url('maklumat-pemohon') }}" title="">PHDBKOKU000011</a></td>
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