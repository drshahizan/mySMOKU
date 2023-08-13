<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100"  action="{{ route('semaksyarat') }}" method="post">
    @csrf

            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
             @endif
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
															
            <label class="form-label required">Nama Pusat Pengajian</label>
            <select name="id_institusi" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
            @foreach ($ipt as $ipt)	
            <option></option> 
            <option value="{{ $ipt->idipt}}">
            {{ $ipt->namaipt}}
            </option> 
            @endforeach
            </select>
        
        </div>
        <!-- </div> -->

        <div class="fv-row mb-10">
            <label class="form-label required">Peringkat Pengajian</label>
            <select name="peringkat_pengajian" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
                @foreach ($peringkat as $peringkat)
                @if ($peringkat->kodperingkat != 1 )
                <option></option>
                <option value="{{ $peringkat->kodperingkat}}">{{ $peringkat->peringkat}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="fv-row mb-10">

            <label class="form-label required">Nama Kursus</label>
                    <select name="nama_kursus" class="form-select form-select-lg form-select-solid"  data-control="select2" data-placeholder="Pilih" data-allow-clear="true" data-hide-search="true">
                        @foreach ($kursus as $kursus)	    
                        <option></option>
                        <option value="{{ $kursus->nama_kursus}}"> 
                            {{ $kursus->nama_kursus}}
                        </option>
                        @endforeach
                    </select>
        </div>

       


        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit"  class="btn btn-primary">
                Seterusnya
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
