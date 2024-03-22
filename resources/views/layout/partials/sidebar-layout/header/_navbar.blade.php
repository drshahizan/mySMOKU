<!--begin::Navbar-->
<div class="app-navbar flex-shrink-0">
    <!--begin::Search-->
    {{-- <div class="app-navbar-item align-items-stretch ms-1 ms-md-3">
        <!-- @include(config('settings.KT_THEME_LAYOUT_DIR').'/partials/sidebar-layout/search/_dropdown') -->
    </div> --}}
    <!--end::Search-->
    <!--begin::Activities-->
	{{-- <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Drawer toggle-->
		<!-- <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" id="kt_activities_toggle">{!! getIcon('messages', 'fs-2') !!}</div> -->
        <!--end::Drawer toggle-->
    </div>
    <!--end::Activities-->
    <!--begin::Notifications-->
	<div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu- wrapper-->
		<div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">{!! getIcon('notification-status', 'fs-2') !!}</div>
        @include('partials/menus/_notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::Notifications-->
    <!--begin::Chat-->
	<div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
		<!-- <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px position-relative" id="kt_drawer_chat_toggle">{!! getIcon('message-text-2', 'fs-2') !!} 
		<span class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span></div> -->
        <!--end::Menu wrapper-->
    </div>
    <!--end::Chat-->
    <!--begin::My apps links-->
	<div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu wrapper-->
		<!-- <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-35px h-35px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">{!! getIcon('element-11', 'fs-2') !!}</div> -->
        @include('partials/menus/_my-apps-menu') 
        <!--end::Menu wrapper-->
    </div> --}}
    <!--end::My apps links-->
    <!--begin::User menu-->
	<div class="app-navbar-item ms-1 ms-md-4" id="kt_header_user_menu_toggle">
        @php
            $nama = DB::table('smoku')->where('no_kp', Auth::user()->no_kp)->value('nama');
            $fullname = Auth::user()->nama;
        @endphp
        <!--begin::Menu wrapper-->
        @if($fullname)
       
            <div class="cursor-pointer symbol  symbol-35px symbol-2by3 fs-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="font-weight: bold; color:#3d0066">
                <i class="ki-solid ki-menu" style="color: #3d0066;"></i>
                {{$fullname}}
            </div>
        @elseif($nama)
            <i class="ki-solid ki-menu" style="color: #3d0066;"></i>
            <div class="cursor-pointer symbol  symbol-35px symbol-2by3 fs-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="font-weight: bold; color:#3d0066">
                {{$nama}}
            </div>
        @else
            <i class="ki-solid ki-menu" style="color: #3d0066;"></i>
            <div class="cursor-pointer symbol  symbol-35px symbol-2by3 fs-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end" style="font-weight: bold; color:#3d0066">
                {{Auth::user()->email}}
            </div>
        @endif
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
