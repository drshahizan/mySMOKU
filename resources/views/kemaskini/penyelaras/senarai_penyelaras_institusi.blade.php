<x-default-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Penyelaras Institusi</title>
    <!-- Include Bootstrap CSS and Select2 CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    
</head>

<body>
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-muted">
                <a href="/" class="text-dark text-hover-primary" style="color:darkblue">Kemaskini</a>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Penyelaras Institusi</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>  
    <br>

    <div id="main-content">
        <div class="container-fluid">
            <!--begin::Content-->
            <div class="block-header">
                <!--begin::Content container-->
                <div class="row clearfix">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Header-->
                        <div class="header">
                            <h2>Senarai Penyelaras Institusi<br><small>Sila klik pada ikon pensil di kolum "Tindakan" untuk memaparkan profil diri bagi penyelaras tersebut.</small></h2>
                        </div>
                        <!--end::Header-->
                        <!--begin::Card title-->
                        <div class="card-title">
                        <div class="d-flex justify-content-end my-2">
                            <button type="button" class="btn btn-primary fw-semibold" data-toggle="modal" data-target="#kt_modal_add_customer">
                                Tambah Pengguna
                            </button>
                        </div>
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <input type="hidden" data-kt-subscription-table-filter="search" >
                        </div>
                        <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar" style="margin-bottom: 0px!important; margin-top: 10px!important;">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-between" style="margin-left: 20px;" data-kt-subscription-table-toolbar="base">
                                <!--begin::Filter-->
                                <!--begin::Content-->
                                <div data-kt-subscription-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="row mb-0">
                                        <div class="col-md-8 fv-row">
                                            <select id="institusiDropdown" name="institusi" class="form-select custom-width-select js-example-basic-single">
                                                <option value="">Pilih Institusi Pengajian</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2 fv-row none-container"> </div>

                                        <div class="col-md-2 fv-row">
                                            <!--begin::Actions-->
                                            <button type="submit" class="btn btn-primary fw-semibold" data-kt-menu-dismiss="true" data-kt-subscription-table-filter="filter" onclick="applyFilter()">
                                                <i class="ki-duotone ki-filter fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                            <!--end::Actions-->
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Content-->
                                <!--end::Filter-->
                            </div>
                            
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->
                            <div class="d-flex justify-content-end align-items-center d-none" data-kt-subscription-table-toolbar="selected">
                                <div class="fw-bold me-5">
                                <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected</div>
                                <button type="button" class="btn btn-danger" data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                            </div>
                            <!--end::Group actions-->
                        </div>
                        <!--end::Card toolbar-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table id="sortTable1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>Nama</b></th>                                        
                                            <th><b>No. Kad Pengenalan</b></th>
                                            <th><b>E-mel</b></th>
                                            <th><b>Institusi</b></th>
                                            <th><b>Peranan</b></th>
                                            <th><b>Tarikh Daftar</b></th>
                                            <th><b>Status</b></th>
                                            <th><b>Tindakan</b></th>
                                        </tr>
                                    </thead>
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
    </div>
  
    <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <form class="form" action="{{ route('penyelaras.kemaskini.penyelaras') }}" id="kt_modal_add_customer_form" method="post" data-kt-redirect="{{ route('daftarpengguna') }}">
                    @csrf
                    <input type="hidden" name="status" value="1">
                    <div class="modal-header" id="kt_modal_add_customer_header">
                        <h2 class="fw-bold">Tambah Pengguna</h2>
                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary" data-dismiss="modal" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>
                    <div class="modal-body py-10 px-lg-17">
                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Nama</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="nama" value="" oninput="this.value = this.value.toUpperCase(); this.setCustomValidity('')" oninvalid="this.setCustomValidity('Sila isi')" required />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Emel</label>
                                <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Sila isi')" required />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
                                <input type="text" maxlength="12" class="form-control form-control-solid" placeholder="" name="no_kp" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Sila isi')" required />
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Peranan</label>
                                <select name="tahap" id="pilihtahap" aria-label="Pilih" data-placeholder="Pilih" data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold basic-search" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Sila isi')" required>
                                    <option value="">Pilih</option>
                                    @foreach ($tahap as $t)
                                        @if(in_array((int) $t->id, [2, 6], true))
                                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
                                <select name="id_institusi" id="institusi_add" data-placeholder="Pilih" class="form-select form-select-solid basic-search" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Sila isi')" required>
                                    <option value="">Pilih</option>
                                    @foreach($institusiPengajian as $iptadd)
                                        <option value="{{ $iptadd->id_institusi }}">{{ strtoupper($iptadd->nama_institusi) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="div_jawatan_add" class="fv-row mb-7">
                                <label class="fs-6 fw-semibold mb-2">Jawatan</label>
                                <input type="text" name="jawatan" id="edit_jawatan_add" class="form-control form-control-solid" oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Sila isi')" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer flex-center">
                        <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3" data-dismiss="modal" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                            <span class="indicator-label">Hantar</span>
                            <span class="indicator-progress">Tunggu sebentar...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Kemaskini Maklumat</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal" data-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form id="editUserForm" method="POST" action="{{ route('penyelaras.kemaskini.penyelaras') }}">
                        @csrf

                        <input type="hidden" name="id_institusi" id="id_institusi">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Nama</label>
                            <input type="text" class="form-control form-control-solid" name="nama" id="edit_nama">
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">E-mel</label>
                            <input type="email" class="form-control form-control-solid" name="email" id="edit_email">
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">No. Kad Pengenalan</label>
                            <input type="text" class="form-control form-control-solid" name="no_kp" id="edit_no_kp">
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Peranan</label>
                            <select name="tahap" id="edit_tahap" class="form-select form-select-solid basic-search">
                                @foreach($tahap as $t)
                                    @if(in_array((int) $t->id, [2, 6], true))
                                        <option value="{{ $t->id }}">{{ strtoupper($t->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div id="div_institusi" class="fv-row mb-7" style="display: none;">
                            <label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
                            <select name="edit_institusi_ipt" id="edit_institusi_ipt" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
                                @foreach($institusiPengajian as $ipt)
                                    <option value="{{ $ipt->id_institusi }}">{{ strtoupper($ipt->nama_institusi) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="div_id_institusippk" class="fv-row mb-7" style="display: none;">
                            <label class="fs-6 fw-semibold mb-2">Nama Pusat Pengajian</label>
                            <select name="edit_institusi_ppk" id="edit_institusi_ppk" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
                                @foreach($institusiPengajian as $item)
                                    <option value="{{ $item->id_institusi }}">{{ strtoupper($item->nama_institusi) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="div_jawatan" class="fv-row mb-7" style="display: none;">
                            <label class="fs-6 fw-semibold mb-2">Jawatan</label>
                            <input type="text" name="jawatan" id="edit_jawatan" class="form-control form-control-solid">
                        </div>

                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold mb-2">Status</label>
                            <select name="status" id="edit_status" data-placeholder="Pilih" class="form-select form-select-solid basic-search">
                                <option value="1">AKTIF</option>
                                <option value="0">TIDAK AKTIF</option>
                            </select>
                        </div>

                        <div class="text-center pt-15">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Sila tunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!--begin::Javascript-->
    <style>
        .custom-width-select {
            width: 400px !important; /* Important to override other styles */
        }
        .form-select {
                margin-left: 10px !important; 
        }
    </style>

    <script>
        var datatable1;

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
            $('#kt_modal_add_customer .basic-search').select2({
                dropdownParent: $('#kt_modal_add_customer')
            });
            $('#editUserModal .basic-search').select2({
                dropdownParent: $('#editUserModal')
            });

            var institusiList = @json($institusiPengajian);
            updateInstitusiDropdown(institusiList);

            datatable1 = $('#sortTable1').DataTable({
                ordering: true,
                order: [],
                columnDefs: [
                    { orderable: false, targets: [7] }
                ],
                ajax: {
                    url: '{{ route("penyelaras.getSenaraiPenyelaras") }}',
                    dataSrc: ''
                },
                language: {
                    url: "/assets/lang/Malay.json"
                },
                columns: [
                    {
                        data: 'nama',
                        render: function(data, type) {
                            var conjunctions_lower = ['bin', 'binti'];
                            var conjunctions_upper = ['A/L', 'A/P'];

                            var words = data.split(' ');

                            for (var i = 0; i < words.length; i++) {
                                var word = words[i];

                                if (word.startsWith("'")) {
                                    words[i] = "'" + word.charAt(1).toUpperCase() + word.slice(2).toLowerCase();
                                } else if (conjunctions_lower.includes(word.toLowerCase())) {
                                    words[i] = word.toLowerCase();
                                } else if (conjunctions_upper.includes(word.toUpperCase())) {
                                    words[i] = word.toUpperCase();
                                } else {
                                    words[i] = word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                                }
                            }

                            return words.join(' ');
                        }
                    },
                    { data: 'no_kp' },
                    { data: 'email' },
                    { data: 'institusi' },
                    {
                        data: 'peranan',
                        render: function(data, type, row) {
                            if (parseInt(row.tahap) === 2) {
                                return 'Penyelaras BKOKU';
                            }
                            if (parseInt(row.tahap) === 6) {
                                return 'Penyelaras PPK';
                            }
                            return data || '-';
                        }
                    },
                    {
                        data: 'created_at',
                        render: function(data, type) {
                            if (type === 'display' || type === 'filter') {
                                return formatTarikhDaftar(data);
                            }
                            return data;
                        }
                    },
                    {
                        data: 'status',
                        render: function (data) {
                            if (parseInt(data) === 1) {
                                return '<div class="badge badge-light-success fw-bold">Aktif</div>';
                            }
                            return '<div class="badge badge-light-danger fw-bold">Tidak Aktif</div>';
                        },
                        className: 'text-center'
                    },
                    {
                        data: 'no_kp',
                        render: function (data, type, row) {
                            return `
                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3"
                                        title="Kemaskini Profil"
                                        onclick='openEditModal(${JSON.stringify(row)})'>
                                    <i class="ki-solid ki-pencil text-dark fs-2"></i>
                                </button>
                            `;
                        },
                        orderable: false,
                        searchable: false,
                        className: 'text-center'
                    }
                ]
            });
        });

        function updateInstitusiDropdown(institusiList) {
            $('#institusiDropdown').empty();
            $('#institusiDropdown').append('<option value="">Pilih Institusi Pengajian</option>');

            for (var i = 0; i < institusiList.length; i++) {
                $('#institusiDropdown').append('<option value="' + institusiList[i].nama_institusi + '">' + institusiList[i].nama_institusi + '</option>');
            }
        }

        function applyFilter() {
            if (!datatable1) {
                return;
            }

            var selectedInstitusi = $('[name="institusi"]').val() || '';
            datatable1.column(3).search(selectedInstitusi).draw();
            datatable1.page(0).draw(false);
        }

        function openEditModal(user) {
            document.getElementById('edit_no_kp').value = user.no_kp;
            document.getElementById('edit_nama').value = user.nama;
            document.getElementById('edit_email').value = user.email;
            document.getElementById('edit_tahap').value = user.tahap;
            document.getElementById('id_institusi').value = user.id_institusi;
            document.getElementById('edit_status').value = user.status;
            document.getElementById('edit_jawatan').value = user.jawatan ?? '';

            $('#edit_institusi_ipt').val('').trigger('change');
            $('#edit_institusi_ppk').val('').trigger('change');
            $('#edit_status').val(user.status).trigger('change');

            if (user.tahap == 2 && user.id_institusi) {
                $('#edit_institusi_ipt').val(user.id_institusi).trigger('change');
            } else if (user.tahap == 6 && user.id_institusi) {
                $('#edit_institusi_ppk').val(user.id_institusi).trigger('change');
            }

            updateVisibility(user.tahap);
            $('#edit_tahap').trigger('change');

            showModalById('editUserModal');
        }

        function updateVisibility(tahap) {
            var divInstitusi = document.getElementById('div_institusi');
            var divInstitusiPPK = document.getElementById('div_id_institusippk');
            var divJawatan = document.getElementById('div_jawatan');

            divInstitusi.style.display = 'none';
            divInstitusiPPK.style.display = 'none';
            divJawatan.style.display = 'none';

            switch (parseInt(tahap)) {
                case 2:
                    divInstitusi.style.display = 'block';
                    divJawatan.style.display = 'block';
                    break;
                case 6:
                    divInstitusiPPK.style.display = 'block';
                    divJawatan.style.display = 'block';
                    break;
                case 3:
                case 4:
                case 5:
                    divJawatan.style.display = 'block';
                    break;
            }
        }

        document.getElementById('edit_tahap').addEventListener('change', function () {
            updateVisibility(this.value);
        });

        $('#kt_modal_add_customer').on('hidden.bs.modal', function () {
            $('#pilihtahap').val('').trigger('change');
            $('#institusi_add').val('').trigger('change');
        });

        function formatTarikhDaftar(data) {
            if (!data) {
                return '-';
            }

            var date = new Date(data);
            if (isNaN(date.getTime())) {
                return '-';
            }

            var year = date.getFullYear();
            var month = ('0' + (date.getMonth() + 1)).slice(-2);
            var day = ('0' + date.getDate()).slice(-2);

            return day + '/' + month + '/' + year;
        }

        function showModalById(modalId) {
            var modalElement = document.getElementById(modalId);
            if (window.bootstrap && typeof bootstrap.Modal === 'function') {
                var modal = new bootstrap.Modal(modalElement);
                modal.show();
                return;
            }

            if (window.jQuery && typeof $(modalElement).modal === 'function') {
                $(modalElement).modal('show');
            }
        }
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: ' {!! session('success') !!}',
                confirmButtonText: 'OK'
            });
        @endif
        @if(session('failed'))
            Swal.fire({
                icon: 'error',
                title: 'Tidak Berjaya!',
                text: ' {!! session('failed') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

<!--end::Javascript--> 

  

</body>

</x-default-layout>
