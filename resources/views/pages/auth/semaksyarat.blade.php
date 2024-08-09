<x-auth-layout>
    
@section('announcement')
    <h2 style="font-size: 30px; color:rgb(0, 46, 110)">Hebahan</h2>
    <p>{!! $catatan !!}</p> 
@endsection      

    <!--begin::Form-->
    <form class="form w-100" id="kt_semak_form" action="{{ route('semaksyarat') }}" data-kt-redirect-url="{{ route('daftarlayak') }}" method="post">
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
            <h3 class="text-dark fw-bolder mb-3" style="font-size: 20px">
                Semakan Kelayakan Syarat Daftar Pengguna
            </h3>
        </div>
       
        {{-- <div class="fv-row mb-10">
			<label class="form-label required">Adakah anda penerima Hadiah Latihan Persekutuan?</label>	
			<div class="row mb-2" data-kt-buttons="true">
                <div class="col">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                    <input type="radio" class="btn-check" name="terimHLP" value="ya" />
                    <span class="fw-bold fs-3">Ya</span></label>
                </div>
                <div class="col">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                    <input type="radio" class="btn-check" name="terimHLP" checked="checked" value="tidak" />
                    <span class="fw-bold fs-3">Tidak</span></label>
                </div>
			</div>
		</div> --}}

        <div class="fv-row mb-10">
			<label style="font-size: 20px" class="form-label required">Adakah anda penerima Cuti Belajar Bergaji Penuh?</label>	
			<div class="row mb-2" data-kt-buttons="true">
                <div class="col">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
                    <input type="radio" class="btn-check" name="cuti" value="ya" />
                    <span class="fw-bold fs-3">Ya</span></label>
                </div>
                <div class="col">
                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
                    <input type="radio" class="btn-check" name="cuti" checked="checked" value="tidak" />
                    <span class="fw-bold fs-3">Tidak</span></label>
                </div>
			</div>
		</div>
  
        <div class="text-center mb-11">
            <h2 style="font-size: 20px" class="text-dark fw-bolder mb-3">
                Semakan Agensi Kelayakan Malaysia (MQA)
            </h2>
        </div>
        <div class="text-center mb-11">
            <img alt="Logo" src="{{ image('logos/mqalogo.png') }}" class="h-100px h-lg-100px"/>
        </div>

        <!-- institusi Dropdown -->
        <div class="fv-row mb-10">													
            <label style="font-size: 20px" class="form-label">Nama Pusat Pengajian</label>
            <select style="font-size: 20px" id="id_institusi" name="id_institusi" class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" required>
                <option value="">Pilih</option>
                @foreach ($ipt as $ipt)	
                <option value="{{ $ipt->id_institusi}}">{{ strtoupper($ipt->nama_institusi)}}</option> 
                @endforeach
            </select>
        </div>

        <div class="fv-row mb-10">
            <label style="font-size: 20px" class="form-label">Peringkat Pengajian</label>
            <select style="font-size: 20px" id="peringkat_pengajian" name="peringkat_pengajian" class="form-select form-select-lg form-select-solid"  data-control="select2" data-hide-search="true" required>
                <option value="">Pilih</option>
                @foreach ($kod_peringkat as $kod_peringkat)	
                <option value="{{ $kod_peringkat->kod_peringkat}}">{{ $kod_peringkat->peringkat}}</option> 
                @endforeach
            </select>
        </div>

        <div class="fv-row mb-10">
            <label style="font-size: 20px" class="form-label">Nama Kursus</label>
            <select style="font-size: 20px" id='nama_kursus'  name='nama_kursus' class="form-select form-select-lg form-select-solid js-example-basic-single"  data-control="select2" data-hide-search="true" required>
                <option value="">Pilih</option>
            </select>
        </div>

        <!-- Script -->
        {{-- <script src="assets/js/custom/authentication/semak/general.js"></script> --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script type='text/javascript'>
        $(document).ready(function(){

            // institusi Change
            $('#id_institusi').change(function(){

                // institusi id
                var id_institusi = $(this).val();
                var kod_peringkat = $(this).val();
                

                // Empty the dropdown
                $('#peringkat_pengajian').find('option').not(':first').remove();
                $('#nama_kursus').find('option').not(':first').remove();

                // AJAX request 
                $.ajax({
                    url: 'getPeringkat/'+id_institusi,
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

                                var id_institusi = response['data'][i].id_institusi;
                                var kod_peringkat = response['data'][i].kod_peringkat;
                                var peringkat = response['data'][i].peringkat;

                                var option = "<option value='"+kod_peringkat+"'>"+peringkat+"</option>";

                                $("#peringkat_pengajian").append(option); 
                            }
                        }

                    }
                });

            });

            // peringkat Change
            $('#peringkat_pengajian').change(function(){

                // institusi id
                var id_ins = $(id_institusi).val();
                var kod_peringkat = $(this).val();

                // Empty the dropdown
                // $('#peringkat_pengajian').find('option').not(':first').remove();
                $('#nama_kursus').find('option').not(':first').remove();
                //alert(idipt);

                // AJAX request 
                $.ajax({
                    url: 'getKursus/'+kod_peringkat+'/'+id_ins,
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

                                var id_ins = response['data'][i].id_institusi;
                                var kod_peringkat = response['data'][i].kod_peringkat;
                                var nama_kursus = response['data'][i].nama_kursus;
                                var kod_nec = response['data'][i].kod_nec;
                                var bidang = response['data'][i].bidang.toUpperCase();
                                var uppercaseValue  = response['data'][i].nama_kursus.toUpperCase();

                                var option = "<option value='"+nama_kursus+"'>"+uppercaseValue+" - "+kod_nec+" ( "+bidang+" )</option>";

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
            <button type="submit" id="kt_semak_submit" class="btn" style="background-color: #3d0066; color: #ffffff; font-size: 20px">
                @include('partials/general/_button-indicator', ['label' => 'Seterusnya'])
            </button>
        </div>
        
    </form>
    <!--end::Form-->

</x-auth-layout>
