<x-default-layout> 
<head>
   <link rel="stylesheet" href="/assets/css/saringan.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
   <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
	<!--begin::Content-->
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<!--begin::Content container-->
		<div id="kt_app_content_container" class="app-container container-xl" style="width:80%">
			<!--begin::Layout-->
			<div class="d-flex flex-column flex-lg-row">
				<!--begin::Content-->
				<div class="flex-lg-row-fluid mb-10 mb-lg-0 me-lg-7 me-xl-10">
					<!--begin::Card-->
					<div class="card">
						<!--begin::Card body-->
						<div class="card-body p-12">
							<!--begin::Form-->
							<form action="{{ route('save') }}" method="post" enctype="multipart/form-data">
								@csrf
								<!--begin::Wrapper-->
								<div class="d-flex flex-column align-items-start flex-xl-row">
									<!--begin::Input group-->
									<div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xl-2 me-4" data-bs-toggle="tooltip" data-bs-trigger="hover">
										<span class="fs-3 fw-bold text-gray-800">Lapor Diri Tamat Pengajian</span>
									</div>
								</div>
								<!--end::Top-->

								<br>

								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th colspan="2" class="text-center">Dokumen Lampiran Lapor Diri</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Salinan Ijazah (Surat Senat)</td>
											<td><input type="file" id="suratSenat" name="suratSenat"/></td>
										</tr>
										<tr>
											<td>Salinan Transkrip</td>
											<td><input type="file" id="transkrip" name="transkrip"/></td>
										</tr>
										<tr>
											<td colspan="2">
												<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp;
													Gunakan kemudahan <a href="https://compressjpeg.com/" target="_blank">di sini</a> untuk mengurangkan saiz fail sebelum memuat naik fail.</a>
												</div>
					
												<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; 
													Format fail yang boleh dimuat naik adalah format '.pdf', '.jpg', '.png' dan '.jpeg'
												</div>

												<div class="text-dark fw-semibold fs-6"><i class='fas fa-exclamation-triangle' style='color:orange'></i>&nbsp; 
													Saiz maksimum fail adalah 2 MB.
												</div>
											</td>
										</tr>
									</tbody>

									<thead>
										<tr>
											<th colspan="2" class="text-center">Pengakuan Pelajar</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td colspan="2">
												<input class="form-check-input" type="checkbox" style="height:18px; width:20px;" value="1" id="perakuan" name="perakuan"/>
												<b>Saya mengaku bahawa maklumat dan dokumen yang disertakan adalah betul dan benar dan bertanggungjawab ke atas maklumat dan dokumen tersebut. 
												Saya memahami bahawa saya boleh dikenakan tindakan sekiranya mana-mana maklumat dan/atau dokumen yang disertakan adalah tidak benar.</b>
											</td>
										</tr>
									</tbody>
								</table>

								<div class="d-flex flex-center mt-15">
									<button type="submit" class="btn btn-primary btn-sm">
										Simpan
									</button>
								</div>
							</form>
							<!--end::Form-->
						</div>
						<!--end::Card body-->
					</div>
					<!--end::Card-->
				</div>
				<!--end::Content-->
			</div>
			<!--end::Layout-->
		</div>
		<!--end::Content container-->
	</div>
	<!--end::Content-->

	<!--begin::Javascript-->
	<script>var hostUrl = "assets/";</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>
	<!--end::Global Javascript Bundle-->
	<!--begin::Vendors Javascript(used for this page only)-->
	<script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<!--end::Vendors Javascript-->
	<!--begin::Custom Javascript(used for this page only)-->
	<script src="assets/js/custom/apps/invoices/create.js"></script>
	<script src="assets/js/widgets.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>
	<script src="assets/js/custom/apps/chat/chat.js"></script>
	<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
	<script src="assets/js/custom/utilities/modals/create-app.js"></script>
	<script src="assets/js/custom/utilities/modals/users-search.js"></script>
	<!--end::Custom Javascript-->
	<!--end::Javascript-->
</body>
<!--end::Body-->

</x-default-layout> 