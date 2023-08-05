<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" action="{{ route('register') }}" method="post">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">
                Daftar
            </h1>
            <!--end::Title-->
            <br>
            <br>
            <!--begin::Subtitle-->
            <h2 class="text-dark fw-bolder mb-3">
                Semakan Sistem Maklumat Orang Kurang Upaya (SMOKU)
            </h2>
            <!--end::Subtitle--->
        </div>
        <!--begin::Heading-->

        <div class="text-center mb-11">
            <!--begin::Title-->
            <!-- <h1 class="text-dark fw-bolder mb-3" > -->
            <img alt="Logo" src="{{ image('logos/logo.png') }}" class="h-100px h-lg-90px"/>
          
                
           
        </div>

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Name-->
            <input type="text" placeholder="No Kad Pengenalan" name="nokp" autocomplete="off" class="form-control bg-transparent"  value=""/>
            <!--end::Name-->
        </div>

       


        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit"  class="btn btn-primary">
                Semak
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">
            Mempunyai akaun?

            <a href="/login" class="link-primary fw-semibold">
                Log Masuk
            </a>
        </div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->

</x-auth-layout>
