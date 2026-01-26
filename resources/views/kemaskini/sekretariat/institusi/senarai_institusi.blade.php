<x-default-layout>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Senarai Institusi</title>
    <!-- MAIN CSS -->
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Senarai Institusi</li>
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
                            <h2>Senarai Institusi<br><small>Sila semak maklumat institusi di <a href="https://www.mqa.gov.my/mqr/" target="_blank">pautan MQA</a></small></h2>
                        </div>
                        <!--end::Header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table id="sortTable1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th><b>ID Institusi</b></th>
                                            <th><b>Nama Institusi</b></th>
                                            <th><b>Nama Institusi BI</b></th>
                                            <th><b>Poskod</b></th>
                                            <th><b>Jenis Institusi</b></th>
                                            <th><b>Jenis Permohonan</b></th>
                                            <th><b>ID Induk</b></th>
                                            <th><b>Institusi ESP</b></th>
                                            <th><b>Kemaskini</b></th>
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

    <!--begin::Javascript-->
    <!-- Modal -->
    <div class="modal fade" id="kemaskiniModal" tabindex="-1" role="dialog" aria-labelledby="kemaskiniModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kemaskiniModalLabel">Kemaskini Institusi</h5>
                    <button type="button" class="close btn-modal-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="kemaskiniForm" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">ID Institusi</label>
                                <input type="text" id="modal_id_institusi" class="form-control" disabled>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Institusi</label>
                                <input type="text" name="nama_institusi" id="modal_nama_institusi" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Nama Institusi (BI)</label>
                                <input type="text" name="nama_institusi_bi" id="modal_nama_institusi_bi" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Poskod</label>
                                <input type="text" name="poskod" id="modal_poskod" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Institusi</label>
                                <select name="jenis_institusi" id="modal_jenis_institusi" class="form-select js-example-basic-single" data-placeholder="Pilih" required>
                                    <option value="">Pilih</option>
                                    <option value="IPTS">IPTS</option>
                                    <option value="UA">UA</option>
                                    <option value="KK">KK</option>
                                    <option value="KI">KI</option>
                                    <option value="P">P</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Jenis Permohonan</label>
                                <input type="text" name="jenis_permohonan" id="modal_jenis_permohonan" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">ID Induk</label>
                                <input type="text" name="id_induk" id="modal_id_induk" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Institusi ESP</label>
                                <input type="text" name="institusi_esp" id="modal_institusi_esp" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-modal-close" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#sortTable1').DataTable({
                ordering: true,
                order: [],
                ajax: {
                    url: '{{ route("kemaskini.getSenaraiInstitusi") }}',
                    dataSrc: ''
                },
                language: {
                    url: "/assets/lang/Malay.json"
                },
                columns: [
                    { data: 'id_institusi' },
                    { data: 'nama_institusi' },
                    { data: 'nama_institusi_bi' },
                    { data: 'poskod' },
                    { data: 'jenis_institusi' },
                    { data: 'jenis_permohonan' },
                    { data: 'id_induk' },
                    { data: 'institusi_esp' },
                    {
                        data: 'id_institusi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return '<button type="button" class="btn btn-sm btn-primary btn-kemaskini" ' +
                                'data-id="' + data + '" ' +
                                'data-nama="' + (row.nama_institusi || '') + '" ' +
                                'data-nama-bi="' + (row.nama_institusi_bi || '') + '" ' +
                                'data-poskod="' + (row.poskod || '') + '" ' +
                                'data-jenis="' + (row.jenis_institusi || '') + '" ' +
                                'data-permohonan="' + (row.jenis_permohonan || '') + '" ' +
                                'data-induk="' + (row.id_induk || '') + '" ' +
                                'data-esp="' + (row.institusi_esp || '') + '">' +
                                'Kemaskini</button>';
                        }
                    }
                ]
            });

            $('#sortTable1').on('click', '.btn-kemaskini', function() {
                var id = $(this).data('id');
                $('#modal_id_institusi').val(id);
                $('#modal_nama_institusi').val($(this).data('nama'));
                $('#modal_nama_institusi_bi').val($(this).data('nama-bi'));
                $('#modal_poskod').val($(this).data('poskod'));
                $('#modal_jenis_institusi').val($(this).data('jenis'));
                $('#modal_jenis_permohonan').val($(this).data('permohonan'));
                $('#modal_id_induk').val($(this).data('induk'));
                $('#modal_institusi_esp').val($(this).data('esp'));

                $('#kemaskiniForm').attr('action', '/kemaskini/sekretariat/institusi/' + id);
                $('#kemaskiniModal').modal('show');
            });

            $(document).on('click', '.btn-modal-close', function() {
                $('#kemaskiniModal').modal('hide');
            });

            $('#kemaskiniModal').on('shown.bs.modal', function() {
                $('#modal_jenis_institusi').select2({
                    dropdownParent: $('#kemaskiniModal'),
                    width: '100%'
                });
            });
        });
    </script>
    <!--end::Javascript-->
</body>
</x-default-layout>
