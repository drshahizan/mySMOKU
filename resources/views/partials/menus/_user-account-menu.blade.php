<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            @php
                $nama = DB::table('smoku')->where('nokp', Auth::user()->nokp)->value('nama');
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
    <!--begin::Menu separator-->
    {{-- <div class="separator my-2"></div> --}}
    <!--end::Menu separator-->
    <!--begin::Menu item-->
    <!-- <div class="menu-item px-5"> -->
        <!-- <a href="#" class="menu-link px-5">My Profile</a> -->
    <!-- </div> -->
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <!-- <div class="menu-item px-5"> -->
        <!-- <a href="#" class="menu-link px-5"> -->
            <!-- <span class="menu-text">My Projects</span> -->
            <!-- <span class="menu-badge"> -->
                <!-- <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span> -->
            <!-- </span> -->
        <!-- </a> -->
    <!-- </div> -->
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <!-- <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0"> -->
        <!-- <a href="#" class="menu-link px-5">
            <span class="menu-title">My Subscription</span>
            <span class="menu-arrow"></span>
        </a> -->
        <!--begin::Menu sub-->
        <!-- <div class="menu-sub menu-sub-dropdown w-175px py-4"> -->
            <!--begin::Menu item-->
            <!-- <div class="menu-item px-3"> -->
                <!-- <a href="#" class="menu-link px-5">Referrals</a> -->
            <!-- </div> -->
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <!-- <div class="menu-item px-3"> -->
                <!-- <a href="#" class="menu-link px-5">Billing</a> -->
            <!-- </div> -->
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <!-- <div class="menu-item px-3"> -->
                <!-- <a href="#" class="menu-link px-5">Payments</a> -->
            <!-- </div> -->
            <!--end::Menu item-->
            <!--begin::Menu item-->
            <!-- <div class="menu-item px-3"> -->
                <!-- <a href="#" class="menu-link d-flex flex-stack px-5">Statements -->
                    <!-- <span class="ms-2 lh-0" data-bs-toggle="tooltip" title="View your statements">{!! getIcon('information-5', 'fs-5') !!}</span></a> -->
            <!-- </div> -->
            <!--end::Menu item-->
            <!--begin::Menu separator-->
            <!-- <div class="separator my-2"></div> -->
            <!--end::Menu separator-->
            
            <!--end::Menu item-->
        <!-- </div> -->
        <!--end::Menu sub-->
<!-- </div> -->
    <!--end::Menu item-->
    <!--begin::Menu item-->

    <!--end::Menu item-->
    <!--begin::Menu item-->
  
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
