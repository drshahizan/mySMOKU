<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            @php
                $nama = DB::table('smoku')->join('users','users.nokp','=','smoku.nokp' )->value('smoku.nama');
            @endphp
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                @if(Auth::user()->profile_photo_path)
                    <img alt="Logo" src="{{ Auth::user()->profile_photo_path }}"/>
                @else
                    <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', Auth::user()->nokp) }}">
                    <!-- <div class="symbol-label fs-3"> -->
                        {{ substr(Auth::user()->nama,0,1) }}
                    </div>
                @endif
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">{{Auth::user()->nama}}</div>
                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
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
        <a class="button-ajax menu-link px-5" href="#" data-action="{{ route('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true">
            Log Keluar
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
