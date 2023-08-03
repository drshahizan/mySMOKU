<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <!-- <h1 class="text-dark fw-bolder mb-3" > -->
            <img alt="Logo" src="{{ image('logos/1.1.png') }}" class="h-100px h-lg-90px"/>
            <br>
            <br>
            <img alt="Logo" src="{{ image('logos/3.1.svg') }}" class="h-100px h-lg-70px"/>
                
            <!-- </h1> -->
            <!--end::Title-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">
                Log Masuk ke Akaun Anda
            </div>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->

        <!--begin::Login options-->
        <!-- <div class="row g-3 mb-9"> -->
            <!--begin::Col-->
            <!-- <div class="col-md-6"> -->
                <!--begin::Google link--->
                <!-- <a href="{{ url('/auth/redirect/google') }}?redirect_uri={{ url()->current() }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="{{ image('svg/brand-logos/google-icon.svg') }}" class="h-15px me-3"/>
                    Sign in with Google
                </a> -->
                <!--end::Google link--->
            <!-- </div> -->
            <!--end::Col-->

            <!--begin::Col-->
            <!-- <div class="col-md-6"> -->
                <!--begin::Google link--->
                <!-- <a href="{{ url('/auth/redirect/apple') }}?redirect_uri={{ url()->current() }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                    <img alt="Logo" src="{{ image('svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3"/>
                    <img alt="Logo" src="{{ image('svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-15px me-3"/>
                    Sign in with Apple
                </a> -->
                <!--end::Google link--->
            <!-- </div> -->
            <!--end::Col-->
        <!-- </div> -->
        <!--end::Login options-->

        <!--begin::Separator-->
        <!-- <div class="separator separator-content my-14">
            <span class="w-125px text-gray-500 fw-semibold fs-7">Log Masuk ke Akaun Anda</span>
        </div> -->
        <!--end::Separator-->

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Masukkan no. Kad Pengenalan" name="email" autocomplete="off" class="form-control bg-transparent" value=""/>
            <!--end::Email-->
        </div>

        <!--end::Input group--->
        <div class="fv-row mb-3">
            <!--begin::Password-->
            <input type="password" placeholder="Masukkan Kata Laluan" name="password" autocomplete="off" class="form-control bg-transparent" value=""/>
            <!--end::Password-->
        </div>
        <!--end::Input group--->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
            <div></div>

            <!--begin::Link-->
            <a href="/forgot-password" class="link-primary">
                Lupa Kata Laluan ?
            </a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Log Masuk'])
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Belum Mempunyai Akaun?

            <a href="/register" class="link-primary">
                Daftar
            </a>
        </div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->

</x-auth-layout>
