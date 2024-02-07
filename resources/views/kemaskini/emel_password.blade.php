<x-default-layout>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-xl-row justify-content-center">  
                <div class="flex-column flex-lg-row-auto w-100 w-xl-10px"></div>
                    <div class="flex-column flex-lg-row-auto w-100 w-xl-800px">  
                        <!--begin::Card-->
                        <div class="card mb-5 mb-xl-8">
                            <!--begin::Card header-->
                            <div class="card-header border-0 d-flex justify-content-center">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>Kemaskini Emel dan Kata Laluan</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!--begin::Card body-->
                            <div class="card-body pt-0 pb-5">
                                <!--begin::Form-->
                                <form action="{{route('hantar.emel.katalaluan')}}" method="POST">
                                @csrf
                                    @foreach($user as $user)
                                        <!--begin::Row-->
                                        <div class="row row-cols-1 row-cols-md-1">
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-5">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-semibold mb-2 required">No Kad Pengenalan</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <div class="position-relative mb-3">
                                                        <input min="12" class="form-control bg-transparent" type="text" placeholder="No Kad Pengenalan" id="no_ic" name="no_ic" value="{{ $user->no_kp }}" readonly/>
                                                    </div>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->

                                        <!--begin::Row-->
                                        <div class="row row-cols-1 row-cols-md-1">
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-5">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-semibold mb-2">
                                                        <span class="required">Emel</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip" title="Alamat emel mesti aktif.">
                                                            <i class="ki-duotone ki-information fs-7">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                                <span class="path3"></span>
                                                            </i>
                                                        </span>
                                                    </label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{ $user->email }}" required/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        
                                        <!--begin::Row-->
                                        <div class="row row-cols-1 row-cols-md-1">
                                            <!--begin::Col-->
                                            <div class="col">
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-5">
                                                    <!--begin::Label-->
                                                    <label class="fs-5 fw-semibold mb-2 required">Kata Laluan Baru</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-8" data-kt-password-meter="true">
                                                        <!--begin::Wrapper-->
                                                        <div class="mb-1">
                                                            <!--begin::Input wrapper-->
                                                            <div class="position-relative mb-3">
                                                                <input min="12" class="form-control bg-transparent" type="password" placeholder="Katalaluan" name="password" autocomplete="off" required/>
                                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                                </span>
                                                            </div>
                                                            <!--end::Input wrapper-->

                                                            <!--begin::Meter-->
                                                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                                            </div>
                                                            <!--end::Meter-->
                                                        </div>
                                                        <!--end::Wrapper-->

                                                        <!--begin::Hint-->
                                                        <div class="text-muted">
                                                            Gunakan 12 atau lebih aksara dengan gabungan huruf, nombor & simbol.
                                                        </div>
                                                        <!--end::Hint-->
                                                    </div>
                                                    <!--end::Input group--->

                                                    <!--end::Input group--->
                                                    <div class="fv-row mb-8" data-kt-password-meter="true">
                                                        <!--begin::Wrapper-->
                                                        <div class="mb-1">
                                                            <!--begin::Input wrapper-->
                                                            <div class="position-relative mb-3">
                                                                <!--begin::Repeat Password-->
                                                                <input placeholder="Pengesahan Katalaluan" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent" required/>
                                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                                </span>
                                                                <!--end::Repeat Password-->
                                                            </div>

                                                            <!--begin::Meter-->
                                                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                                            </div>
                                                            <!--end::Meter-->

                                                            <!--begin::Hint-->
                                                            <div class="text-muted">
                                                                Gunakan 12 atau lebih aksara dengan gabungan huruf, nombor, & simbol.
                                                            </div>
                                                            <!--end::Hint-->
                                                        </div>
                                                    </div>
                                                    <!--end::Input group--->
                                                </div>
                                                <!--end::Input group-->
                                            </div>
                                            <!--end::Col-->
                                        </div>
                                        <!--end::Row-->
                                        
                                        <!--end::Row-->
                                        <div class="d-flex flex-center">
                                            <!--begin::Button-->
                                            <button type="submit" id="kt_ecommerce_customer_profile_hantar" class="btn btn-light-primary">
                                                <span class="indicator-label">Simpan</span>
                                                <span class="indicator-progress">Sila tunggu...
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                        <!--end::Row-->
                                    @endforeach
                                </form>
                                <!--end::Form-->
                            </div>
                            <!--end::Card body-->
                        </div>    
                    </div>
            </div>
        <div>
    </div>

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
    </script>
</x-default-layout>