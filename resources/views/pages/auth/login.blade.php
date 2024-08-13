<x-auth-layout>
    @section('announcement')
        <h2 style="font-size: 30px; color:rgb(0, 46, 110)">Hebahan</h2>
        <p>{!! $catatan !!}</p> 
    @endsection

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="{{ route('dashboard') }}" action="{{ route('login') }}">
        @csrf
         <!--begin::Subtitle-->
         <div class="text-gray-500 fw-semibold fs-2">
            <a href="/" class="text-gray-500 fw-semibold fs-2"><i class="fa-solid fa-house"></i> 
                Laman Utama
            </a>
        </div>
        <!--end::Subtitle--->
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Logo-->
            <img alt="Logo" src="{{ image('logos/1.1.png') }}" class="h-100px h-lg-100px"/>
            <br>
            <br>
            <br>
            <br>
            <img alt="Logo" src="{{ image('logos/3.1.svg') }}" class="h-100px h-lg-100px"/>
            <!--end::Logo-->

            <!--begin::Subtitle-->
            <div class="text-gray-500 fw-semibold fs-4">
                Log Masuk
            </div>
            <!--end::Subtitle--->
        </div>
        <!--end::Heading-->

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

        <!--begin::Email-->
        <div class="fv-row mb-8">
            <input style="font-size: 20px" type="text" placeholder="Masukkan No. Kad Pengenalan" name="no_kp" maxlength="12" autocomplete="off" class="form-control bg-transparent" value=""/>
        </div>
        <!--end::Email-->

         <!--begin::Password-->
        <div class="fv-row mb-3">
            <input style="font-size: 20px" type="password" placeholder="Masukkan Kata Laluan" name="password" autocomplete="off" class="form-control bg-transparent" value=""/>
            <div style="position: absolute; right: 20px; top: 0; bottom: 0; display: flex; align-items: center; cursor: pointer;">
                <span id="togglePassword">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </span>
            </div>
        </div>
         <!--end::Password-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-stack flex-wrap gap-3 fs-2 fw-semibold mb-8">
            <div></div>
            {{-- <div class="checkbox-inline">
                <label class="checkbox checkbox-outline m-0 text-muted">
                    <input type="checkbox" name="remember" id="remember">
                    <span></span>
                    Ingat Saya
                </label>
            </div> --}}
            <!--begin::Link-->
            <a href="/forgot-password" class="link-primary">
                Lupa Kata Laluan ?
            </a>
            <!--end::Link-->
        </div>
        <!--end::Wrapper-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn" style="background-color: #3d0066; color: #ffffff; font-size: 20px">
                @include('partials/general/_button-indicator', ['label' => 'Log Masuk'])
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-2">
            Belum Mempunyai Akaun?
            <a href="/register" class="link-primary">
                Daftar
            </a>
        </div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        @if(session('berjaya'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya!',
                text: ' {!! session('berjaya') !!}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    
    <script>
        const passwordInput = document.querySelector('input[name="password"]');
        const toggleIcon = document.getElementById('toggleIcon');

        document.getElementById('togglePassword').addEventListener('click', function () {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        });
    </script>
</x-auth-layout>
