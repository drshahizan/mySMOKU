<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100"  action="{{ route('semaksyarat') }}" method="post">
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
            <h3 class="text-dark fw-bolder mb-3">
                Semakan Kelayakan Syarat Daftar Pengguna
            </h3>
        </div>
       
        <div class="fv-row mb-10">
        
			<label class="form-label required">Adakah anda penerima Hadiah Latihan Persekutuan?</label>	
			<div class="row mb-2" data-kt-buttons="true">
			<!--begin::Col-->
			<div class="col">
			<!--begin::Option-->
				<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
					<input type="radio" class="btn-check" name="terimHLP" value="ya" />
							<span class="fw-bold fs-3">Ya</span></label><!--end::Option-->
								</div>
							<div class="col">
							<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
					<input type="radio" class="btn-check" name="terimHLP" checked="checked" value="tidak" />
						<span class="fw-bold fs-3">Tidak</span></label>
						</div>
				    </div>
															
				</div>


                <div class="fv-row mb-10">
			<label class="form-label required">Adakah anda penerima Cuti Belajar Bergaji Penuh?</label>	
			<div class="row mb-2" data-kt-buttons="true">
			<!--begin::Col-->
			<div class="col">
			<!--begin::Option-->
				<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
					<input type="radio" class="btn-check" name="cuti" value="ya" />
							<span class="fw-bold fs-3">Ya</span></label><!--end::Option-->
								</div>
							<div class="col">
							<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
					<input type="radio" class="btn-check" name="cuti" checked="checked" value="tidak" />
						<span class="fw-bold fs-3">Tidak</span></label>
						</div>
				    </div>
															
				</div>
  
                <div class="text-center mb-11">
            <h2 class="text-dark fw-bolder mb-3">
                Semakan Sistem Maklumat Orang Kurang Upaya (SMOKU)
            </h2>
        </div>
        <div class="text-center mb-11">
            <img alt="Logo" src="{{ image('logos/mqalogo.png') }}" class="h-100px h-lg-90px"/>
        </div>

        <div class="fv-row mb-10">
		@csrf														
            <label class="form-label required">Nama Pusat Pengajian</label>
            <select name="id_institusi" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
            <option></option>
            <option value="1">Universiti Malaysia Sabah</option>
            <option value="2">Universiti Kebangsaan Malaysia</option>
            <option value="3">Universiti Malaya</option>
            <option value="4">Universiti Putra Malaysia</option>
            <option value="5">Universiti Teknikal Malaysia Melaka</option>
            <option value="6">Universiti Sains Malaysia</option>
            <option value="7">Universiti Pertahanan Nasional Malaysia</option>
            <option value="8">Universiti Tun Hussein Onn Malaysia</option>
            <option value="9">Universiti Malaysia Kelantan</option>
            <option value="10">Univeristi Utara Malaysia</option>
            </select>

        </div>
        <!-- </div> -->

        <div class="fv-row mb-10">
            <label class="form-label required">Peringkat Pengajian</label>
            <select name="peringkat_pengajian" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
                <option></option>
                <option value="1">Sijil Asas / Sijil</option>
                <option value="2">Diploma</option>
                <option value="3">Sarjana Muda</option>
                <option value="4">Diploma Lepasan Ijazah</option>
                <option value="5">Sarjana</option>
                <option value="6">PhD</option>
            </select>
        </div>
        <div class="fv-row mb-10">

            <label class="form-label required">Nama Kursus</label>
                    <select name="nama_kursus" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
                        <option></option>
                        <option value="1">Komputer Sains</option>
                        <option value="2">C Corporation</option>
                        <option value="3">Sole Proprietorship</option>
                        <option value="4">Non-profit</option>
                        <option value="5">Limited Liability</option>
                        <option value="6">General Partnership</option>
                    </select>
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
