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
                    <div class="w-lg-500px">
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
            <div id="slideshow" class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ image('misc/oku2.jpeg') }})">       
                {{-- <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ image('misc/oku2.JPEG') }})"> --}}
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
            top: 65%;
            left: 20px;
            width: 95%;
            height: auto;
            background-color: rgba(255, 255, 255, 0.826); /* Semi-transparent white */
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            font-size: 20px;
        }

        #slideshow {
            position: relative;
            width: 100%;
            height: 100%;
            transition: background-image 1s ease-in-out;
        }
    </style>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
          const slideshow = document.getElementById('slideshow');
          const images = [
            '{{ image('misc/oku1.JPG') }}',
            '{{ image('misc/oku2.jpeg') }}',
            '{{ image('misc/oku3.JPG') }}',
            '{{ image('misc/oku4.JPG') }}',
            '{{ image('misc/oku5.JPG') }}',
            '{{ image('misc/oku6.jpeg') }}'
          ];
          let currentIndex = 0;
          const intervalTime = 3000; // Change image every 3 seconds
      
          function changeImage() {
            currentIndex = (currentIndex + 1) % images.length;
            slideshow.style.backgroundImage = `url(${images[currentIndex]})`;
          }
      
          setInterval(changeImage, intervalTime);
        });
      </script>
      
@endsection
