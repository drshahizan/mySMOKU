<x-default-layout>
    	<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Tuntutan</h1>
	<!--end::Title-->
	<!--begin::Breadcrumb-->
	<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
		<!--begin::Item-->
		<li class="breadcrumb-item text-muted">
			<a href="/" class="text-dark text-hover-primary" style="color:darkblue">Tuntutan</a>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item">
			<span class="bullet bg-gray-400 w-5px h-2px"></span>
		</li>
		<!--end::Item-->
		<!--begin::Item-->
		<li class="breadcrumb-item text-dark" style="color:darkblue">Keseluruhan</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
<br>
    <head>
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <!-- Page header section  -->
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h2>Senarai Keseluruhan Tuntutan</h2>
                        </div>
                        <hr>

                        <div class="row">
                        {{-- Small Card Section Level 1--}}
                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-info text-white rounded-circle"><i class="fa fa-bookmark" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black;">Hantar</span>
                                                <h4 class="mb-0 font-weight-medium">{{number_format(1090)}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-flex">
                                            <div class="icon-in-bg text-white rounded-circle" style="background-color: coral;"><i class="fa fa-users" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Saringan</span>
                                                <h4 class="mb-0 font-weight-medium">{{number_format(500)}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-primary text-white rounded-circle"><i class="fa fa-user-check" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Disokong</span>
                                                <h4 class="mb-0 font-weight-medium">{{number_format(2408)}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-warning text-white rounded-circle"><i class="fa fa-mail-reply" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Dikembalikan</span>
                                                <h4 class="mb-0 font-weight-medium">{{number_format(54)}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-success text-white rounded-circle"><i class="fa fa-check"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black;"> Layak</span>
                                                <h4 class="mb-0 font-weight-medium">{{number_format(1230)}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg bg-danger text-white rounded-circle"><i class="fa fa-times" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Tidak Layak</span>
                                                <h4 class="mb-0 font-weight-medium">{{number_format(25)}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-lg-2 col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="icon-in-bg text-white rounded-circle" style="background-color: brown"><i class="fa fa-warning" style="color: white"></i></div>
                                            <div class="ml-4">
                                                <span style="color: black"> Tidak Aktif</span>
                                                <h4 class="mb-0 font-weight-medium">195</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{-- End of Small card section --}}
                </div>

                {{-- Table section --}}
                <div class="row clearfix">
                    <!-- Page header2 section  -->
                    <div class="block-header">
                        <div class="row clearfix">
                            <div class="col-lg-4 col-md-12 col-sm-12">
                                <h2>Senarai Tuntutan</h2>
                            </div>
                            <hr>
                        </div>
                    </div>

                    {{-- Filter section --}}
                    <div class="row">
                        <div class="col-md-3">
                            {{-- <label style="color:black"><b>Tapis Status Permohonan</b> --}}
                            <select name="status" class="form-select">
                                <option value="">Semua Status Tuntutan</option>
                                <option value="Baru" {{Request::get('status') == 'Baru' ? 'selected':'' }} >Baru</option>
                                <option value="Saringan" {{Request::get('status') == 'Saringan' ? 'selected':'' }} >Saringan</option>
                                <option value="Disokong" {{Request::get('status') == 'Disokong' ? 'selected':'' }} >Disokong</option>
                                <option value="Layak" {{Request::get('status') == 'Layak' ? 'selected':'' }} >Layak</option>
                                <option value="Tidak Layak" {{Request::get('status') == 'Tidak Layak' ? 'selected':'' }} >Tidak Layak</option>
                                <option value="Dikembalikan" {{Request::get('status') == 'Dikembalikan' ? 'selected':'' }} >Dikembalikan</option>
                                <option value="Tidak Aktif" {{Request::get('status') == 'Tidak Aktif' ? 'selected':'' }} >Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="col-md-4 right">
                            <button type="submit" class="btn btn-primary" style="width: 15%;"><i class="fa fa-filter" style="font-size: 15px;"></i></button>
                        </div>
                    </div>
                    <br>

                    {{-- Table senarai --}}
                    <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <div class="body">      
                                <table id="sortTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="color: white; background-color:rgb(35, 58, 108);">
                                            <th style="width: 15%"><b>ID Tuntutan</b></th>                                        
                                            <th style="width: 35%"><b>Nama</b></th>
                                            <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                            <th style="width: 15%" class="text-center"><b>Tarikh Tuntutan</b></th> 
                                            <th class="text-center" style="width: 15%">Status Tuntutan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/2/990404080221</a></td>
                                            <td>Santosh A/L Ariyaran</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">07/02/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">Saringan</button></td>
                                        </tr>

                                        <tr data-status="Tidak Aktif">
                                            <td><a href="{{ url('maklumat-perbaharui') }}" title="">KPTBKOKU/3/970204052445</a></td>
                                            <td>Sarah Binti Yusri</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">05/03/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm">Tidak Layak</button></td>
                                        </tr>  

                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/980112105666</a></td>
                                            <td>Aishah Binti Samsudin</td>
                                            <td>BKOKU</td>                                       
                                            <td class="text-center">02/03/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Baru">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/990404080221</a></td>
                                            <td>Mohd Ali Bin Abu Kassim</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">27/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/960909105668</a></td>
                                            <td>Ling Kai Jie</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">09/04/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/950804082447</a></td>
                                            <td>Akmal Bin Kairuddin</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">27/4/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Tidak Layak">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/2/021212050334</a></td>
                                            <td>Santishwaran A/L Paven</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">05/06/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-danger btn-sm">Tidak Layak</button></td>
                                        </tr>

                                        <tr>
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/001205034745</a></td>
                                            <td>Choo Mei Ling</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">07/06/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">Saringan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Saringan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/890201065225</a></td>
                                            <td>Ezra Hanisah Binti Md Yunos</td>
                                            <td>BKOKU</td>                                    
                                            <td class="text-center">19/02/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:coral; color:white;">Saringan</button></td>
                                        </tr>
                                        
                                        <tr data-status="Layak">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/2/010305058473</a></td>
                                            <td>Arshahad Bin Kairul Zaman</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">26/05/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-success btn-sm">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/981004045253</a></td>
                                            <td>Syed Abdul Kassim Hussain Yusof</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">25/05/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/3/990201051446</a></td>
                                            <td>Shakira Mariam Aqilah Binti Syed Abdul Rahman</td>
                                            <td>BKOKU</td>                                        
                                            <td class="text-center">07/06/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm btn-success">Layak</button></td>
                                        </tr>
                                        
                                        <tr data-status="Baru">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/5/940524032341</a></td>
                                            <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                            <td>BKOKU</td>                                    
                                            <td class="text-center">09/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-info btn-sm">Baru</button></td>
                                        </tr>
                                        
                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/950623035672</a></td>
                                            <td>Wan Nurul Syafiqah Binti Wan Sahak</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">09/08/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/890907030098</a></td>
                                            <td>Siti Aisyah Binti Ismail</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">21/05/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>

                                        <tr data-status="Disokong">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/6/900623031672</a></td>
                                            <td>Wan Aminah Binti Hasan</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">19/04/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-sm" style="background-color:cornflowerblue; color:white;">Disokong</button></td>
                                        </tr>

                                        <tr data-status="Dikembalikan">
                                            <td><a href="{{ url('maklumat-pemohon') }}" title="">KPTBKOKU/4/950523098909</a></td>
                                            <td>Muhammad Aiman Bin Hamid</td>
                                            <td>BKOKU</td>
                                            <td class="text-center">09/07/2023</td>
                                            <td class="text-center"><button type="button" class="btn btn-warning btn-sm">Dikembalikan</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>   
        </div> 
    </body>
    <script>
        $('#sortTable').DataTable();
    </script>
</x-default-layout> 
