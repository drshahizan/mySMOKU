<x-default-layout> 
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
            <li class="breadcrumb-item text-dark" style="color:darkblue">Tuntutan Baharu</li>
            <!--end::Item-->
        </ul>
        <!--end::Breadcrumb-->
    </div>

    <head>
    
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/assets/css/saringan.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    
    </head>
           
    <br>
    @if (session('message'))
        <div class="alert alert-success" style="color:black; text-align: center;">{{ session('message') }}</div>
    @endif
    
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
                            <h2>Senarai Tuntutan Baharu</h2>
                            <!--begin::Search-->
                            {{-- <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="hidden" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Customers" />
                            </div> --}}
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                           
                            
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px">Permohonan ID</th>
                                        <th class="min-w-125px">Nama</th>
                                        <th class="min-w-125px">Nama Kursus</th>
                                        <th class="min-w-125px">Tempoh penajaan</th>
                                       
                                        <th class="w-10px pe-2">Status</th>
                                        <th class="w-10px pe-2">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    
                                    <tr>
                                        <td>P/1/020202015888</td>
                                        <td>Nurul Atiqah Binti Hashim</td>
                                        <td>Sijil Kemahiran Hotel Dan Katering</td>
                                        <td>21/9/2022 - 22/9/2024</td>
                                        <td>Aktif</td>
                                        <td>
                                            
                                            <!--begin::Toolbar-->
                                            <div class="d-flex">
                                                <!--begin::Edit-->
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
                                                        <i class="ki-duotone bi bi-pencil fs-3"></i>
                                                    </span>
                                                </a>
                                                <!--end::Edit-->
                                              
                                            </div>
                                            <!--end::Toolbar-->
                                            
                                        </td>
                                       
                                            
                                            
                                            
                                        </td>
                                        <!--begin::Modal - Customers - Edit-->
                                            <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
                                                <!--begin::Modal dialog-->
                                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                                    <!--begin::Modal content-->
                                                    <div class="modal-content">
                                                        <!--begin::Modal header-->
                                                        <div class="modal-header">
                                                            <!--begin::Modal title-->
                                                            <h2>Keputusan Peperiksaan Baru</h2>
                                                            <!--end::Modal title-->
                                                            <!--begin::Close-->
                                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                                <i class="ki-duotone ki-cross fs-1">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </div>
                                                            <!--end::Close-->
                                                        </div>
                                                        <!--end::Modal header-->
                                                        <!--begin::Modal body-->
                                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                            <!--begin::Form-->
                                                            <form class="form" id="kt_modal_new_card_form" action="" method="post">
                                                                @csrf
                                                                <!--begin::Scroll-->
                                                                
                                                                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2">Sesi Pengajian</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" class="form-control form-control-solid" placeholder="" name="" value="2023/2024" />
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2">Semester</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <select name="status" id="status" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
                                                                            <option value="1" >2</option>
                                                                            <option value="2" >3</option>
                                                                            <option value="2" >4</option>
                                                                        </select>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row mb-7">
                                                                        <!--begin::Label-->
                                                                        <label class="fs-6 fw-semibold mb-2">Salinan Keputusan Pengajian</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="file" class="form-control form-control-sm" id="" name="salinan_keputusan"/></td>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    
                                                                    <div class="col-6" id="divelaun">
                                                                        <input class="form-check-input" type="checkbox" value="1" id="wang_saku"  name="wang_saku" onclick="return false" checked/>
                                                                        <label class="fs-6 fw-semibold form-label">
                                                                            Tuntut Elaun Wang Saku
                                                                        </label>
                                                                    </div>     
                                                                </div>
                                                                <!--end::Scroll-->
                                                                
                                                                <!--begin::Actions-->
                                                                <div class="text-center pt-15">
                                                                    {{--<button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>--}}
                                                                    <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                                                        <span class="indicator-label">Hantar</span>
                                                                        <span class="indicator-progress">Sila tunggu...
                                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                    </button>
                                                                </div>
                                                                <!--end::Actions-->
                                                            </form>
                                                            <!--end::Form-->
                                                        </div>
                                                        <!--end::Modal body-->
                                                    </div>
                                                    <!--end::Modal content-->
                                                </div>
                                                <!--end::Modal dialog-->
                                            </div>
                                        <!--end::Modal - Customers - Edit-->
                                    </tr>
                                  

                                    
                                        <tr>
                                        <td>P/1/021010147896</td>
                                        <td>Ariana Binti Mahadir</td>
                                        <td>Sijil Kemahiran Rekabentuk Fesyen Dan Pakaian</td>
                                        <td>18/1/2022 - 17/1/2024</td>
                                        <td>Aktif</td>
                                        <td>
                                            
                                            <!--begin::Toolbar-->
                                            <div class="d-flex">
                                                <!--begin::Edit-->
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_card">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit">
                                                        <i class="ki-duotone bi bi-pencil fs-3"></i>
                                                    </span>
                                                </a>
                                                <!--end::Edit-->
                                              
                                            </div>
                                            <!--end::Toolbar-->
                                            
                                        </td>
                                        <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header">
                                                        <!--begin::Modal title-->
                                                        <h2>Keputusan Peperiksaan Baru</h2>
                                                        <!--end::Modal title-->
                                                        <!--begin::Close-->
                                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                            <i class="ki-duotone ki-cross fs-1">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--end::Modal header-->
                                                    <!--begin::Modal body-->
                                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                                        <!--begin::Form-->
                                                        <form class="form" id="kt_modal_new_card_form" action="" method="post">
                                                            @csrf
                                                            <!--begin::Scroll-->
                                                            
                                                            <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Sesi Pengajian</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control form-control-solid" placeholder="" name="" value="2023/2024" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Semester</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <select name="status" id="status" class="form-select form-select-solid" data-control="select2" data-placeholder="Pilih">
                                                                        <option value="1" >2</option>
                                                                        <option value="2" >3</option>
                                                                        <option value="2" >4</option>
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-6 fw-semibold mb-2">Salinan Keputusan Pengajian</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="file" class="form-control form-control-sm" id="" name="salinan_keputusan"/></td>
                                                                    <!--end::Input-->
                                                                </div>
                                                                
                                                                <div class="col-6" id="divelaun">
                                                                    <input class="form-check-input" type="checkbox" value="1" id="wang_saku"  name="wang_saku" onclick="return false" checked/>
                                                                    <label class="fs-6 fw-semibold form-label">
                                                                        Tuntut Elaun Wang Saku
                                                                    </label>
                                                                </div>     
                                                            </div>
                                                            <!--end::Scroll-->
                                                            
                                                            <!--begin::Actions-->
                                                            <div class="text-center pt-15">
                                                                {{--<button type="reset" id="kt_modal_new_card_cancel" class="btn btn-light me-3">Discard</button>--}}
                                                                <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                                                    <span class="indicator-label">Hantar</span>
                                                                    <span class="indicator-progress">Sila tunggu...
                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                            </div>
                                                            <!--end::Actions-->
                                                        </form>
                                                        <!--end::Form-->
                                                    </div>
                                                    <!--end::Modal body-->
                                                </div>
                                                <!--end::Modal content-->
                                            </div>
                                            <!--end::Modal dialog-->
                                        </div>
                                    </tr>


                                    <tr>
                                        <td>P/1/020810015901</td>
                                        <td>Mohd Syafiq Bin Amiluddin</td>
                                        <td>Sijil Kemahiran Rekabentuk Grafik</td>
                                        <td>18/1/2021 - 17/1/2023</td>
                                        <td>Selesai Pengajian</td>
                                        <td>
                                            
                                            <!--begin::Toolbar-->
                                            <div class="d-flex">
                                                <!--begin::Edit-->
                                                <a href="#" class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#">
                                                    <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Tamat Pengajian">
                                                        <i class="ki-duotone bi bi-pencil fs-3"></i>
                                                    </span>
                                                </a>
                                                <!--end::Edit-->
                                              
                                            </div>
                                            <!--end::Toolbar-->
                                            
                                        </td>
                                </tbody>
                            </table>
                        </div>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
                <!--begin::Modals-->
                
               
                <!--end::Modals-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
        
    </div>
    
    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/custom/apps/customers/list/export.js"></script>
    <script src="assets/js/custom/apps/customers/list/list.js"></script>
    <script src="assets/js/custom/apps/customers/add.js"></script>
    <script src="assets/js/custom/utilities/modals/new-card.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
        
    
    
    
    
    </x-default-layout>