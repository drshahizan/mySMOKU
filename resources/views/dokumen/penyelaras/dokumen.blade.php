<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Muat Naik Dokumen</h1>
	<!--end::Title-->
</div>
<br>
<!--end::Page title-->
<div class="table-responsive">
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xxl">
			<!--begin::Card-->
			<div class="card">
				<!--begin::Card header-->
				<div class="card-header border-0 pt-6">
					<!--begin::Card title-->
					<div class="card-title">
						<!--begin::Search-->
						<div class="d-flex align-items-center position-relative my-1">
							<i>
								<span class="path1"></span>
								<span class="path2"></span>
							</i>
						</div>
						<!--end::Search-->
					</div>
					<!--begin::Card title-->
				</div>
				<!--end::Card header-->
				<!--begin::Card body-->
				<div class="card-body pt-0">	
					<!--begin::Form-->
					<form class="form" action="" method="post" enctype="multipart/form-data">
						@csrf
					
						<!--begin::Table-->
						<table class="table table-row-dashed fs-6 gy-5">
							<thead>
								<tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
									<th class="text-center" style="width: 20%">Nama</th>
									<th class="text-center" style="width: 60%">Muat Naik Dokumen</th>
									<th class="text-center" style="width: 20%">Muat Turun Dokumen</th>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600" >
								@foreach ($dokumen as $item)
									<tr>
										<td class="text-gray-800">Dokumen satu&nbsp;<a href="/assets/contoh/bank.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
										<td class="fv-row"><input type="file" class="form-control form-control-sm" id="akaunBank" name="akaunBank"/></td>
										<td class="text-center">
											<a href="{{ asset('assets/dokumen/esp/dokumen1/' . $item->dokumen1) }}" target="_blank" class="btn btn-secondary btn-sm">
											Lihat
											<i class='fas fa-eye' style='font-size:10px; padding-left:20px;'></i>
										</td>
									</tr>
									<tr>
										<td class="text-gray-800">Dokumen dua&nbsp;<a href="/assets/contoh/tawaran.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
										<td class="fv-row"><input type="file" class="form-control form-control-sm" id="suratTawaran" name="suratTawaran"/></td>
										<td class="text-center">
											<a href="{{ asset('assets/dokumen/esp/dokumen2/' . $item->dokumen2) }}" target="_blank" class="btn btn-secondary btn-sm">
											Lihat
											<i class='fas fa-eye' style='font-size:10px; padding-left:20px;'></i>
										</td>
									</tr>
									<tr>
										<td class="text-gray-800">Dokumen tiga&nbsp;<a href="/assets/contoh/resit.pdf" target="_blank" data-bs-toggle="tooltip" title="CONTOH"><i class="fa-solid fa-circle-info"></i></a></td>
										<td class="fv-row"><input type="file" class="form-control form-control-sm" id="invoisResit" name="invoisResit"/></td>
										<td class="text-center">
											<a href="{{ asset('assets/dokumen/esp/dokumen3/' . $item->dokumen3) }}" target="_blank" class="btn btn-secondary btn-sm">
											Lihat
											<i class='fas fa-eye' style='font-size:10px; padding-left:20px;'></i>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<!--end::Table-->
					
						<br>
					
						<div class="modal-footer flex-center">
							<button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
								<span class="indicator-label">Hantar</span>
								<span class="indicator-progress">Sila tunggu...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
								</span>
							</button>
						</div>
					</form>
					
					<!--end::Form-->
				</div>
				<!--end::Card body-->
			</div>
			<!--end::Card-->	
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->
	
</div>

<!--begin::Javascript-->
<script>
	// tinymce.init({
	//   selector: '#catatan', // Replace with the ID or class of your textarea
	//   plugins: 'autolink lists link image charmap print preview',
	//   toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
	//   height: 300 // Set the height of the editor
	// });

	// var editorContent = tinymce.get('catatan').getContent();

</script>

<!--end::Javascript-->
	




</x-default-layout>