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
		<li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini Tuntutan</li>
		<!--end::Item-->
	</ul>
	<!--end::Breadcrumb-->
</div>
    <head>
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="assets/css/sekretariat.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9">
        <!-- CSS -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
        <!-- Default theme -->
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    </head>

    <body>
        <!-- Main body part  -->
        <div id="main-content">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <h1>Kemaskini Tuntutan</h1>
                        </div>
                        <hr>

                        <div class="card">
                            <div class="header">
                                <h2>Senarai Pelajar Yang Layak Tuntut<br><small>Sila klik pada ID tuntutan untuk kemaskini tuntutan</small></h2>
                            </div>
                            <div class="table-responsive">
                                <div class="body">
                                    <table id="sortTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%"><b>ID Tuntutan</b></th>
                                                <th style="width: 40%"><b>Nama</b></th>
                                                <th style="width: 15%"><b>Jenis Permohonan</b></th>
                                                <th style="width: 20%"><b>Jenis Tuntutan</b></th>
                                                <th style="width: 10%" class="text-center"><b>Tarikh Tuntutan</b></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/3/990404080221</a></td>
                                                <td>Santosh A/L Ariyaran</td>
                                                <td>BKOKU</td>
                                                <td>Wang Saku</td>
                                                <td class="text-center">07/02/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/5/970204052445</a></td>
                                                <td>Sarah Binti Yusri</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">05/03/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/3/980112105666</a></td>
                                                <td>Aishah Binti Samsudin</td>
                                                <td>BKOKU</td>
                                                <td>Wang Saku</td>
                                                <td class="text-center">02/03/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/4/970703041223</a></td>
                                                <td>Mohd Ali Bin Abu Kassim</td>
                                                <td>BKOKU</td>
                                                <td>Wang Saku</td>
                                                <td class="text-center">08/07/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/4/960909105668</a></td>
                                                <td>Ling Kai Jie</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">09/04/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/2/021212050334</a></td>
                                                <td>Santishwaran A/L Paven</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">05/06/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/3/001205034745</a></td>
                                                <td>Choo Mei Ling</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">07/06/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/6/890201065225</a></td>
                                                <td>Ezra Hanisah Binti Md Yunos</td>
                                                <td>BKOKU</td>
                                                <td>Wang Saku</td>
                                                <td class="text-center">19/02/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/5/981004045253</a></td>
                                                <td>Syed Abdul Kassim Hussain Yusof</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">25/05/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/5/940524032341</a></td>
                                                <td>Rahman Mohammed Arshahad Al-dhaqm</td>
                                                <td>BKOKU</td>
                                                <td>Wang Saku</td>
                                                <td class="text-center">09/07/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/4/950623035672</a></td>
                                                <td>Wan Nurul Syafiqah Binti Wan Sahak</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">09/08/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/6/930907030098</a></td>
                                                <td>Siti Aisyah Binti Ismail</td>
                                                <td>BKOKU</td>
                                                <td>Wang Saku</td>
                                                <td class="text-center">21/05/2023</td>
                                            </tr>
                                            <tr>
                                                <td><a href="{{ url('tuntutan/penyelaras/yuran-dan-wang-saku/maklumat-tuntutan') }}" title="">KPTBKOKU/5/950523098909</a></td>
                                                <td>Muhammad Aiman Bin Hamid</td>
                                                <td>BKOKU</td>
                                                <td>Yuran Pegajian dan Wang Saku</td>
                                                <td class="text-center">29/07/2023</td>
                                            </tr>
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
    <script>
        $('#sortTable').DataTable();
    </script>
</x-default-layout>
