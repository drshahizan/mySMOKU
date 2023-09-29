<x-auth-layout>

@section('announcement')
    <h2>Hebahan</h2>
    <p>{!! $catatan !!}</p> 
@endsection

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
    @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Logo-->
            <img alt="Logo" src="{{ image('logos/1.1.png') }}" class="h-100px h-lg-90px"/>
            <br>
            <br>
            <br>
            <br>
            <img alt="Logo" src="{{ image('logos/3.1.svg') }}" class="h-100px h-lg-70px"/>
            <!--end::Logo-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-6">
                Log Masuk
            </div>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->
            @if (session('message'))
                <div class="alert alert-danger" style="color:black; text-align: center;">{{ session('message') }}</div>
            @endif

            @if(session('notifikasi'))
                <div class="alert alert-success" style="color:black; text-align: center;">
                    {{ session('notifikasi') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success" style="color:black; text-align: center;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger" style="color:black; text-align: center;">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Email-->
            <input type="text" placeholder="Masukkan No. Kad Pengenalan" name="no_kp" maxlength="12" autocomplete="off" class="form-control bg-transparent" value=""/>
            <!--end::Email-->
        </div>
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
