<!--begin::Card-->
<div class="card card-flush w-lg-650px py-5">
    <!--begin::Card body-->
    <div class="card-body py-15 py-lg-20">

        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('{{ image('auth/bg1.jpg') }}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ image('auth/bg1-dark.jpg') }}');
            }
        </style>
        <!--end::Page bg image-->

        <!--begin::Title-->
        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">
            Oops!
        </h1>
        <!--end::Title-->

        <!--begin::Text-->
        <div class="fw-semibold fs-6 text-gray-500 mb-7">
            We can't find that page.
        </div>
        <!--end::Text-->

        <!--begin::Illustration-->
        <div class="mb-3">
            <img src="{{ image('auth/404-error.png') }}" class="mw-100 mh-300px theme-light-show" alt=""/>
            <img src="{{ image('auth/404-error-dark.png') }}" class="mw-100 mh-300px theme-dark-show" alt=""/>
        </div>
        <!--end::Illustration-->

        <!--begin::Link-->
        <div class="mb-0">
            <a href="/" class="btn btn-sm btn-primary">Return Home</a>
        </div>
        <!--end::Link-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
