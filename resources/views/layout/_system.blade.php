@extends('layout.master')

@section('content')

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center text-center p-10">
                <!--begin::Card-->
                <div class="card card-flush w-lg-650px py-5">
                    <!--begin::Card body-->
                    <div class="card-body py-15 py-lg-20">
                        {{ $slot }}
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Root-->

@endsection
