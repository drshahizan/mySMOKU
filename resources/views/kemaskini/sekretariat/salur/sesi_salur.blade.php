<x-default-layout> 
<head>

<!-- MAIN CSS -->
<link rel="stylesheet" href="/assets/css/saringan.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

</head>
<!--begin::Page title-->
<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
	<!--begin::Title-->
	<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Set Sesi Salur</h1>
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
					<form class="form" id="sesi" onsubmit="return validateForm()" action="{{ route('sekretariat.simpan.sesi') }}" method="post">
						@csrf
						
						<div class="row mb-10">
                            <label for="sesi" class="col-sm-2 col-form-label">Sesi Salur :</label>
                            <div class="col-sm-4">
                                <input type="text" id="sesi" 
                                    class="form-control form-control-solid"
                                    placeholder="F1 24/25"
                                    name="sesi" required
                                    oninvalid="this.setCustomValidity('Masukkan sesi salur.')"
                                    oninput="setCustomValidity('')" />
                            </div>
                        </div>

						<br>
						<!--begin::action-->
						<div class="modal-footer flex-center">
							<!--begin::Button-->
							<button type="submit" class="btn btn-primary">
								<span class="indicator-label">Simpan</span>
								<span class="indicator-progress">Sila tunggu...
								<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
							</button>
							<!--end::Button-->
						</div>
						<!--end::action-->
					</form>
					<!--end::Form-->
				</div>
				<!--end::Card body-->
				<!--begin::Card body-->
				<div class="card-body pt-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table table-row-dashed fs-6 gy-5" id="kt_sesi_table">
                            <thead>
                                <tr>
                                    <th>Bil.</th>
                                    <th>Sesi</th>
                                    <th>Sekretariat</th>
                                    <th>Tarikh Kemaskini</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($sesi as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}.</td>
                                        <td>{{ $item->sesi }}</td>
                                        <td>{{ $item->user->nama ?? '-' }}</td>
                                        <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
					</div>
					<!--end::Table-->
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
    $(document).ready(function() {
        var table = $('#kt_sesi_table').DataTable({
            ordering: true, // Enable manual sorting
            order: [], // Disable initial sorting
            columnDefs: [
                {
                    "targets": 'no-sort',
                    "orderable": false
                }
            ],
            language: {
                url: "/assets/lang/Malay.json"
            }
        });

        
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script>
		// Check if there is a flash message
		@if(session('success'))
			Swal.fire({
				icon: 'success',
				title: 'Berjaya!',
				text: ' {!! session('success') !!}',
				confirmButtonText: 'OK'
			});
		@endif

	</script>

<!--end::Javascript-->

</x-default-layout>