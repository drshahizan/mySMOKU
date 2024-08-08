<x-default-layout>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">  
                <!--begin::Sidebar-->
			    <div class="flex-column flex-lg-row-auto w-100 w-xl-450px mb-10">  
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Profil</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Form-->
                            <!-- <form class="form" action="#" id="kt_ecommerce_customer_profile"> -->
                            <form action="{{route('simpan.profil')}}" method="POST" enctype="multipart/form-data">
                                <!--begin::Input group-->
                                @csrf
                                <div class="mb-7">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold mb-2">
                                        <span>Gambar Profil</span>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Jenis fail yang dibenarkan: png, jpg, jpeg.">
                                            <i class="ki-duotone ki-information fs-7">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </span>
                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Image input wrapper-->
                                    @foreach($user as $user)
                                    <div class="mt-1">
                                        <!--begin::Image input placeholder-->
                                        <style>.image-input-placeholder { background-image: url('/assets/media/svg/files/blank-image.svg'); } [data-bs-theme="dark"] .image-input-placeholder { background-image: url('/assets/media/svg/files/blank-image-dark.svg'); }</style>
                                        <!--end::Image input placeholder-->
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                            <!--begin::Preview existing avatar-->
                                            @if(Auth::user()->profile_photo_path !== null)
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('/assets/profile_photo_path/{{$user->profile_photo_path}}')"></div>
                                            @else
                                                <div class="image-input-wrapper w-125px h-125px" style="background-image: url('/assets/profile_photo_path/default.png')"></div>
                                            @endif
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Edit-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Kemaskini gambar">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <!--begin::Inputs-->                                    
                                                <input type="file" name="profile_photo_path" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Edit-->
                                            <!--begin::Cancel-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal gambar">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <!--end::Cancel-->
                                            <!--begin::Remove-->
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Padam gambar">
                                                <i class="ki-duotone ki-cross fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <!--end::Remove-->
                                        </div>
                                        @endforeach	
                                        <!--end::Image input-->
                                    </div>
                                    <!--end::Image input wrapper-->
                                </div>
                                <!--end::Input group-->
                                <!--end::Input group-->
                                <!--begin::Row-->
                                <div class="row row-cols-1 row-cols-md-1">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2 required">Nama</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid" placeholder="" name="nama" value="{{ $user->nama}}" />
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
                                                <span class="required">E-mel</span>
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
                                            <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="{{ $user->email}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                
                                <br>
                                
                                <!--end::Row-->
                                <div class="d-flex">
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_ecommerce_customer_profile_submit" class="btn btn-light-primary">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Sila tunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <div class="flex-column flex-lg-row-auto w-100 w-xl-10px"></div>
                <!--begin::Sidebar-->
			    <div class="flex-column flex-lg-row-auto w-100 w-xl-450px mb-10">  
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Tukar Kata Laluan</h2>
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
                            <!-- <form class="form" action="#" id="kt_ecommerce_customer_profile"> -->
                            <form action="{{route('simpan.katalaluan')}}" method="POST">
                            @csrf
                                <!--begin::Row-->
                                <div class="row row-cols-1 row-cols-md-1">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-5">
                                            <!--begin::Label-->
                                            <label class="fs-5 fw-semibold mb-2 required">Kata Laluan Lama</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="position-relative mb-3">
                                                <input min="12" class="form-control bg-transparent" type="password" placeholder="Katalaluan" id="password_old" name="password_old" autocomplete="off" value=""/>
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
                                            <label class="fs-5 fw-semibold mb-2 required">Kata Laluan Baru</label>
                                            <!--end::Label-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-8" data-kt-password-meter="true">
                                                <!--begin::Wrapper-->
                                                <div class="mb-1">
                                                    <!--begin::Input wrapper-->
                                                    <div class="position-relative mb-3">
                                                        <input min="12" class="form-control bg-transparent" type="password" placeholder="Katalaluan" name="password" autocomplete="off"/>

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
                                                        <input placeholder="Pengesahan Katalaluan" name="password_confirmation" type="password" autocomplete="off" class="form-control bg-transparent"/>
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
                                <div class="d-flex">
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_ecommerce_customer_profile_hantar" class="btn btn-light-primary">
                                        <span class="indicator-label">Simpan</span>
                                        <span class="indicator-progress">Sila tunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
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