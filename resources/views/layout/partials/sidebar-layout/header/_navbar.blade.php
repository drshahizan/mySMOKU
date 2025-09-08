<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::User menu-->
	<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        @php
            // get fullname from user or smoku
            $fullname = Auth::user()->nama 
                ?? DB::table('smoku')->where('no_kp', Auth::user()->no_kp)->value('nama');

            // fallback to email if no name
            if (!$fullname) {
                $fullname = Auth::user()->email;
            }
        @endphp

        <!--begin::Menu wrapper-->
        <div class="cursor-pointer symbol symbol-35px symbol-2by3 fs-5" 
             data-kt-menu-trigger="{default: 'click', lg: 'hover'}" 
             data-kt-menu-attach="parent" 
             data-kt-menu-placement="bottom-end" 
             style="font-weight: bold; color:#3d0066">

            <i class="ki-solid ki-menu me-2" style="color: #3d0066;"></i>

            <!-- Full name on desktop -->
            <span class="d-none d-lg-inline">{{ $fullname }}</span>

            <!-- First name on mobile -->
            <span class="d-lg-none">
                {{ strtok($fullname, ' ') }}
            </span>
        </div>

        @include('partials/menus/_user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->

    <!--begin::Header menu toggle-->
	<div class="app-navbar-item d-lg-none ms-2 me-n2" title="Show header menu">
		<!-- <div class="btn btn-flex btn-icon btn-active-color-primary w-30px h-30px" id="kt_app_header_menu_toggle">{!! getIcon('element-4', 'fs-1') !!}</div> -->
    </div> 
    <!--end::Header menu toggle-->
</div>
<!--end::Navbar-->
