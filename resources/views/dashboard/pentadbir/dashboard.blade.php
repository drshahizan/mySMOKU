<x-default-layout>
    <!--begin::Page title-->
	<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
		<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Laman Utama</h1>
		<!--begin::Breadcrumb-->
		<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
			<li class="breadcrumb-item text-dark" style="color:darkblue">Laman Utama</li>
			<li class="breadcrumb-item">
				<span class="bullet bg-gray-400 w-5px h-2px"></span>
			</li>
			<li class="breadcrumb-item text-dark" style="color:darkblue">Paparan Pemuka</li>
		</ul>
		<!--end::Breadcrumb-->
	</div>
	<!--end::Page title-->

    <br>

    <!--begin::First Row-->
    <div class="card shadow-sm">
        <div class="card-header">
            <h2 class="card-title">
                <i class="bi bi-people-fill fs-2qx"></i>
                &nbsp;&nbsp;Jumlah Pengguna
            </h2>

            <div class="card-toolbar">
                <a href="{{ route('daftarpengguna')}}"class="btn btn-primary btn-sm"><i class="bi bi-person-video2 fs-4 me-2"></i> Lihat Semua</a>
            </div>
        </div>

        <div class="card-body">
           	<!--begin::Stats-->
               <div class="row">
                <!--begin::Col-->
                <div class="col">
                    @php
                        $count_penyelaras_bkoku = DB::table('users')->where('tahap', 2)->count();
                    @endphp
                    <div class="card card-border border-success flex-center min-w-175px my-3 p-6">
                        <span class="fs-6 fw-semibold pb-1 px-2">Penyelaras BKOKU IPT</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">
                            <span data-kt-countup="true" data-kt-countup-value="{{$count_penyelaras_bkoku}}">{{$count_penyelaras_bkoku}}</span>
                        </span>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    @php
                        $count_penyelaras_ppk = DB::table('users')->where('tahap', 6)->count();
                    @endphp
                    <div class="card card-border border-danger flex-center min-w-175px my-3 p-6">
                        <span class="fs-6 fw-semibold pb-1 px-2">Penyelaras PPK IPT</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">
                            <span data-kt-countup="true" data-kt-countup-value="{{$count_penyelaras_ppk}}">{{$count_penyelaras_ppk}}</span>
                        </span>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    @php
                        $count_sekretariat = DB::table('users')->where('tahap', 3)->count();
                    @endphp
                    <div class="card card-border border-warning flex-center min-w-175px my-3 p-6">
                        <span class="fs-6 fw-semibold pb-1 px-2">Sekretariat KPT</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">
                            <span data-kt-countup="true" data-kt-countup-value="{{$count_sekretariat}}">{{$count_sekretariat}}</span>
                        </span>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    @php
                        $count_pegawai = DB::table('users')->where('tahap', 4)->count();
                    @endphp
                    <div class="card card-border border-info flex-center min-w-175px my-3 p-6">
                        <span class="fs-6 fw-semibold pb-1 px-2">Pengawai Atasan KPT</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">
                            <span data-kt-countup="true" data-kt-countup-value="{{$count_pegawai}}">{{$count_pegawai}}</span>
                        </span>
                    </div>
                </div>
                <!--end::Col-->
            </div>
        </div>
    </div>

    <br>

    <!--begin::Second Row-->
    {{-- <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="card-title">Jumlah Pelajar  &nbsp; <i class="bi bi-people-fill  fs-2qx"></i></h3>

            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-primary">
                    Daftar
                </button>
            </div>
        </div>
        <div class="card-body">
           	<!--begin::Stats-->
               <div class="row">
                <!--begin::Col-->
                <div class="col">
                    <div class="card card-border border-info flex-center min-w-175px my-3 p-6">
                        <span class="fs-4 fw-semibold text-primary pb-1 px-2">Pelajar IPTA</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">$
                        <span data-kt-countup="true" data-kt-countup-value="63,240.00">0</span></span>
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col">
                    <div class="card card-border border-info flex-center min-w-175px my-3 p-6">
                        <span class="fs-4 fw-semibold text-primary pb-1 px-2">Pelajar IPTS</span>
                        <span class="fs-lg-2tx fw-bold d-flex justify-content-center">$
                        <span data-kt-countup="true" data-kt-countup-value="8,530.00">0</span></span>
                    </div>
                </div>
                <!--end::Col-->
            </div>
        </div>
    </div> --}}
</x-default-layout>
