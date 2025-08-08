<!--begin::Card-->
{{-- <div class="card card-flush w-lg-650px py-5"> --}}
    <!--begin::Card body-->
    <div class="card-body py-15 py-lg-20">

        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ image('auth/bg7.jpg') }}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ image('auth/bg7-dark.jpg') }}');
            }
        </style>
        <!--end::Page bg image-->

        <img src="assets/media/auth/warning.png" alt="Warning" style="display: block; margin: 0 auto; width: 10%;">
        <!--begin::Title-->
        <h1 class="fw-bolder fs-2qx text-gray-900 mb-4">
            Tidak dibenarkan
        </h1>
        <!--end::Title-->

        <!--begin::Text-->
        <div class="fw-semibold fs-6 text-gray-500 mb-7">
            Maaf, anda tidak mempunyai kebenaran untuk mengakses halaman ini.
        </div>
        <!--end::Text-->

        <!--begin::Illustration-->
        <div class="mb-11">
            <img src="{{ image('auth/403-forbidden.jpg') }}" class="mw-100 mh-300px theme-light-show" alt=""/>
            <img src="{{ image('auth/403-forbidden.jpg') }}" class="mw-100 mh-300px theme-dark-show" alt=""/>
        </div>
        <!--end::Illustration-->

        <!--begin::Link-->
        <div class="mb-0">
            <a href="/" class="btn btn-sm btn-primary">Laman Utama</a>
        </div>
        <!--end::Link-->

    </div>
    <!--end::Card body-->
{{-- </div> --}}
<!--end::Card-->


