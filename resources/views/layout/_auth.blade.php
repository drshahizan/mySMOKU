@extends('layout.master')

@section('content')

    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-600px">
                        <!--begin::Page-->
                        {{ $slot }}
                        <!--end::Page-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Body-->

            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ image('misc/oku1.JPG') }})">
                {{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: linear-gradient(rgba(207, 13, 59, 0), rgba(76, 114, 148, 0.75) 100.57%), url({{ image('misc/oku1.jpg') }})"> --}}
    
                <!--begin::Wrapper-->
                <div>
                    <!-- Announcement Content -->
                    <div class="announcement-box">
                        @yield('announcement')
                    </div>
                </div>
                <!--end::Wrapper-->
                
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::App-->
    <style>
        .announcement-box {
            position: relative;
            top: 75%;
            left: 20px;
            width: 95%;
            height: auto;
            background-color: rgba(255, 255, 255, 0.826); /* Background color with 80% opacity (adjust as needed) */
            padding: 20px; /* Padding around the content inside the box */
            border-radius: 10px; /* Optional: Rounded corners for the box */
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2); /* Optional: Box shadow for a subtle depth effect */
            font-size: 25px; /* Adjust the font size as needed */
        }
    </style>
    

@endsection
