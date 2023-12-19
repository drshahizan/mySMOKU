<x-default-layout>
    <head>
        <!-- MAIN CSS -->
        <link rel="stylesheet" href="/assets/css/saringan.css">

        <!-- Javascript -->
        <script src="https://cdn.tiny.cloud/1/v736541al0ntzh14edk63z19dzyqs1xn2bkc5em78rv1yeis/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    </head>

    <!--begin::Page title-->
    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
        <!--begin::Title-->
        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kemaskini</h1>
        <!--end::Title-->
        <!--begin::Breadcrumb-->
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Kemaskini</li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-400 w-5px h-2px"></span>
            </li>
            <!--end::Item-->
            <!--begin::Item-->
            <li class="breadcrumb-item text-dark" style="color:darkblue">Jumlah Peruntukan</li>
            <!--end::Item-->
        </ul>
    <!--end::Breadcrumb-->
    </div>
    <!--end::Page title-->

    <br>

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
                        <form id="dataForm" class="form" action="#" method="POST">
                            @csrf
                            <div class="row mb-10">
                                <!--begin::Input group-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-4 fw-semibold mb-2">Tarikh Mula</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="date" class="form-control form-control-solid" name="tarikh_mula" value="" required oninvalid="this.setCustomValidity('Masukkan tarikh mula.')" oninput="setCustomValidity('')"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-4 fw-semibold mb-2">Tarikh Tamat</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="date" class="form-control form-control-solid" name="tarikh_tamat" value="" required oninvalid="this.setCustomValidity('Masukkan tarikh tamat.')" oninput="setCustomValidity('')"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                
                                <!--begin::Input group-->
                                <div class="col-md-4 fv-row">
                                    <!--begin::Label-->
                                    <label class="fs-4 fw-semibold mb-2">Jumlah</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" name="jumlah" id="jumlah" value="" required oninvalid="this.setCustomValidity('Masukkan jumlah peruntukan.')" oninput="setCustomValidity('')"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            
                            <br>
                            <!--begin::action-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
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
                            <table class="table align-center table-row-dashed fs-6 gy-5" id="myTable">
                                <thead>
                                    <tr class="text-start align-center text-gray-400 fw-bold fs-7 gs-0">
                                        <th class="min-w-125px align-center">Program</th>
                                        <th class="min-w-125px align-center">Jenis</th>
                                        <th class="min-w-125px align-center">Semester</th>
                                        <th class="min-w-125px align-center">Jumlah</th>
                                        <th class="min-w-125px align-center">Tarikh Kemaskini</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    {{-- @foreach ($jumlah as $jumlah)
                                    <tr>
                                        <td>{{ $jumlah->program}}</td>
                                        <td>{{ $jumlah->jenis}}</td>
                                        <td>{{ $jumlah->semester}}</td>
                                        <td>RM {{ $jumlah->jumlah}}</td>
                                        <td>{{ $jumlah->updated_at->format('d/m/Y')}}</td>
        
                                    </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                        <div style="font-size: 11px;">Sila klik dua kali pada baris untuk mengemas kini maklumat bagi baris berkenaan.</div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->	
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->  
    </div>
</x-default-layout>