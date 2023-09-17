<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            @php
                $nama = DB::table('smoku')->where('no_kp', Auth::user()->no_kp)->value('nama');
                $nama2 = Auth::user()->nama;
            @endphp
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                @if($nama2)
                    <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-primary text-primary', $nama2) }}">
                        {{ substr($nama2,0,1) }}
                    </div>
                @elseif($nama)
                    <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-primary text-primary', $nama) }}">
                        {{ substr($nama,0,1) }}
                    </div>
                @else
                    <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-primary text-primary', Auth::user()->email) }}">
                        {{ substr(Auth::user()->email,0,1) }}
                    </div>
                @endif
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                @if($nama2)
                    <div class="fw-bold d-flex align-items-center fs-5">{{$nama2}}</div>
                @else
                    <div class="fw-bold d-flex align-items-center fs-5">{{$nama}}</div>
                @endif
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="{{ route('profil-diri') }}" class="menu-link px-5">Profil Diri</a>
    </div>
    <div class="separator my-2"></div>
    <div class="menu-item px-5">
        <a class="button-ajax menu-link px-5" href="#" data-action="{{ route('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true">
            Log Keluar
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
