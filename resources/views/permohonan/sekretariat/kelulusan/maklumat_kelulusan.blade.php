<x-default-layout> 
<head>
    <style>
        
        table, td, tr{
        border: none!important;
        padding:2px 8px!important;
        }
        td{
            vertical-align: top!important;
        }
        .space{
            width: 15%;
        }
    </style>
</head>
    
<body>
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
			<li class="breadcrumb-item text-dark" style="color:darkblue">Kelulusan</li>
			<!--end::Item-->
            <!--begin::Item-->
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<!--end::Item-->
			<!--begin::Item-->
			<li class="breadcrumb-item text-dark" style="color:darkblue">Keputusan Permohonan</li>
			<!--end::Item-->
		</ul>
	<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->

    <br>

    <!-- Main body part  -->
    <div id="main-content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body p-5">
                            <div class="row clearfix">
                                <div class="col-md-12 col-sm-12">
                                    <div class="header" style="background-color: #3d0066!important; padding:10px; width:100%;">
                                        <div class="nav-item vivify swoopInTop active text-white"><b>Rekod Keputusan Permohonan</b></div>
                                    </div>

                                    <br>

                                    <table class="maklumat">
                                            @php
                                                $nama = DB::table('smoku')->where('id', $permohonan['smoku_id'])->value('nama');
                                                $status = DB::table('bk_status')->where('kod_status',$permohonan['status'])->value('status');
                                            @endphp
                                            <tr>
                                                <td><strong>Nama </strong></td>
                                                <td><b>:</b></td>
                                                <td >{{$nama}}</td>
                                                <td class="space">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tarikh Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>{{$permohonan['created_at']->format('d/m/Y')}}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>ID Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>{{$permohonan->no_rujukan_permohonan}}</td>
                                                <td class="space">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Status Permohonan </strong></td>
                                                <td><b>:</b></td>
                                                <td>{{$status}}</td>
                                            </tr>
                                    </table>                               
                                </div>
                            </div>
                        
                            <hr><br>

                            <div class="col-md-6 col-sm-6">
                                <form action="{{ url('permohonan/sekretariat/hantar/keputusan/'.$permohonan->id) }}" method="POST" id="kelulusan">
                                    {{csrf_field()}}
                                    <table>
                                        <tr>
                                            <td><b>Bil. Mesyuarat</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="text" id="noMesyuarat" name="noMesyuarat" style="padding: 5px; width:150px;" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>Tarikh Mesyuarat</b></td>
                                            <td><b>:</b></td>
                                            <td><input type="date" id="tarikhMesyuarat" name="tarikhMesyuarat" style="padding: 5px; width:150px;" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>Keputusan</b></td>
                                            <td><b>:</b></td>
                                            <td>
                                                <select id="keputusan" name="keputusan" style="padding: 7px; width:150px;" onchange="select1()" oninvalid="this.setCustomValidity('Sila pilih keputusan dalam senarai')" oninput="setCustomValidity('')" required>
                                                    <option value="">Pilih Keputusan</option>
                                                    <option value="Lulus">Lulus</option>
                                                    <option value="Tidak Lulus">Tidak Lulus</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Catatan</b></td>
                                            <td><b>:</b></td>
                                            <td>
                                                <div id="catatan-container">
                                                    <div class="catatan-row">
                                                        <input type="text" id="catatan" name="catatan[]" style="padding: 5px; width:300px; margin-right:4px;">
                                                        <button type="button" class="add-catatan-button" onclick="addCatatanField(this)">+</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>

                                    <div class="submit mt-15 mb-10" style="text-align: right;">
                                        <button type="submit" id="submit" value="submit" class="btn btn-primary text-white">Hantar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>                                      
                </div>
            </div>
        </div>
    </div>  

    <!-- Javascript -->
    <script>
        // input validation
        var btn = document.getElementById('submit');
        btn.addEventListener('click', function() {
            if (document.getElementById('noMesyuarat').checked) {
                document.getElementById("noMesyuarat").required = false;
            }
            else{
                document.getElementById("noMesyuarat").required = true;
            }

            if (document.getElementById('tarikh').checked) {
                document.getElementById("tarikh").required = false;
            }
            else{
                document.getElementById("tarikh").required = true;
            }
            if (document.getElementById('keputusan').checked) {
                document.getElementById("keputusan").required = false;
            }
            else{
                document.getElementById("keputusan").required = true;
            }
        })      

        //add catatan
        function addCatatanField(button) {
            var catatanContainer = document.getElementById('catatan-container');
            var newCatatanRow = document.createElement('div');
            newCatatanRow.className = 'catatan-row';
            var newCatatanField = document.createElement('input');
            newCatatanField.type = 'text';
            newCatatanField.name = 'catatan[]';
            newCatatanField.style.padding = '5px';
            newCatatanField.style.width = '300px';
            newCatatanField.style.marginTop = '5px';
            newCatatanField.required = true;
            newCatatanRow.appendChild(newCatatanField);

            // Create a new remove button with spacing
            var removeCatatanButton = document.createElement('button');
            removeCatatanButton.textContent = '-';
            removeCatatanButton.onclick = function() { removeCatatanField(removeCatatanButton); };
            removeCatatanButton.style.marginLeft = '8px';
            removeCatatanButton.style.width = '24px';
            newCatatanRow.appendChild(removeCatatanButton);

            catatanContainer.appendChild(newCatatanRow);
        }

        function removeCatatanField(button) {
            var catatanContainer = document.getElementById('catatan-container');
            catatanContainer.removeChild(button.parentNode);
        }
    </script>

    <script src="assets/bundles/libscripts.bundle.js"></script>    
    <script src="assets/bundles/vendorscripts.bundle.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
</body>
</x-default-layout> 