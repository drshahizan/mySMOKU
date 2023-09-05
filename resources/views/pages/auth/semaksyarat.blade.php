<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" id="kt_sign_up_form" action="{{ route('semaksyarat') }}" data-kt-redirect-url="{{ route('daftarlayak') }}" method="post">
    @csrf

            @if (session('message'))
                <div class="alert alert-success" style="color:black; text-align: center;">{{ session('message') }}</div>
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

<!-- institusi Dropdown -->
    <div class="fv-row mb-10">													
        <label class="form-label">Nama Pusat Pengajian</label>
        <select id="id_institusi" name="id_institusi" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true">
            <option value="">Pilih</option>
            @foreach ($ipt as $ipt)	
            <option value="{{ $ipt->idipt}}">{{ $ipt->namaipt}}</option> 
            @endforeach
        </select>
    </div>

    <div class="fv-row mb-10">
            <label class="form-label">Peringkat Pengajian</label>
            <select id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-lg form-select-solid"  data-control="select2" data-hide-search="true">
                <option value="">Pilih</option>
                @foreach ($kodperingkat as $kodperingkat)	
            <option value="{{ $kodperingkat->kodperingkat}}">{{ $kodperingkat->peringkat}}</option> 
            @endforeach
            </select>
    </div>


    <div class="fv-row mb-10">
        <label class="form-label">Nama Kursus</label>
        <select id='nama_kursus'  name='nama_kursus' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true">
            <option value="">Pilih</option>
        </select>
    </div>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){

        // institusi Change
        $('#id_institusi').change(function(){

             // institusi id
             var idipt = $(this).val();
             var kodperingkat = $(this).val();

             // Empty the dropdown
             $('#peringkat_pengajian').find('option').not(':first').remove();
             $('#nama_kursus').find('option').not(':first').remove();

             // AJAX request 
             $.ajax({
                 url: 'getPeringkat/'+idipt,
                 type: 'get',
                 dataType: 'json',
                 success: function(response){

                     var len = 0;
                     if(response['data'] != null){
                          len = response['data'].length;
                     }

                     if(len > 0){
                          // Read data and create <option >
                          for(var i=0; i<len; i++){

                               var idipt = response['data'][i].idipt;
                               var kodperingkat = response['data'][i].kodperingkat;
                               var peringkat = response['data'][i].peringkat;

                               var option = "<option value='"+kodperingkat+"'>"+peringkat+"</option>";

                               $("#peringkat_pengajian").append(option); 
                          }
                     }

                 }
             });

        });

        // peringkat Change
        $('#peringkat_pengajian').change(function(){

        // institusi id
        var idipt = $(id_institusi).val();
        var kodperingkat = $(this).val();

        // Empty the dropdown
       // $('#peringkat_pengajian').find('option').not(':first').remove();
        $('#nama_kursus').find('option').not(':first').remove();
        //alert(idipt);


        // AJAX request 
        $.ajax({
            url: 'getKursus/'+kodperingkat+'/'+idipt,
            type: 'get',
            dataType: 'json',
           
            success: function(response){

                var len = 0;
                if(response['data'] != null){
                    len = response['data'].length;
                }

                if(len > 0){
                    // Read data and create <option >
                    for(var i=0; i<len; i++){

                        var idipt = response['data'][i].idipt;
                        var kodperingkat = response['data'][i].kodperingkat;
                        var nama_kursus = response['data'][i].nama_kursus;

                        var option = "<option value='"+nama_kursus+"'>"+nama_kursus+"</option>";

                        $("#nama_kursus").append(option); 
                        
                    }
                }

            }
        });

        });



    });

    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
    </script>


        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            {{--<button type="submit"  class="btn btn-primary">
                Semak
            </button>--}}
            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Seterusnya'])
            </button>
        </div>
        <!--end::Submit button-->

        <!--begin::Sign in-->
        {{--<div class="text-gray-500 text-center fw-semibold fs-6">
            Mempunyai akaun?

            <a href="/login" class="link-primary fw-semibold">
                Log Masuk
            </a>
        </div>--}}
        <!--end::Sign in-->
    </form>
    <!--end::Form-->

</x-auth-layout>
