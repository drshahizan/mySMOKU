<x-auth-layout>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form" data-kt-redirect-url="{{ route('login') }}" action="{{ route('register') }}">
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
                Semakan Kelayakan
            </h3>
        </div>
        <div class="fv-row mb-10">
			<label class="form-label required">Adakah anda penerima HLP?</label>	
			<div class="row mb-2" data-kt-buttons="true">
			<!--begin::Col-->
			<div class="col">
			<!--begin::Option-->
				<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4">
					<input type="radio" class="btn-check" name="ya" value="ya" />
							<span class="fw-bold fs-3">Ya</span></label><!--end::Option-->
																	</div>
																	<!--end::Col-->
																	<!--begin::Col-->
																	<div class="col">
																		<!--begin::Option-->
																		<label class="btn btn-outline btn-outline-dashed btn-active-light-primary w-100 p-4 active">
																			<input type="radio" class="btn-check" name="" checked="checked" value="tidak" />
																			<span class="fw-bold fs-3">Tidak</span>
																		</label>
																		<!--end::Option-->
																	</div>
																</div>
															
														</div>
        <!--begin::Heading-->

        <div class="text-center mb-11">
            <!--begin::Title-->
            <!-- <h1 class="text-dark fw-bolder mb-3" > -->
            <img alt="Logo" src="{{ image('logos/mqalogo.png') }}" class="h-100px h-lg-90px"/>
          
                
           
        </div>

        <!--begin::Input group--->
        <div class="fv-row mb-8">
            <!--begin::Name-->
            <input type="text" placeholder="Kad Pengenalan" name="name" autocomplete="off" class="form-control bg-transparent"/>
            <!--end::Name-->
        </div>

       


        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                @include('partials/general/_button-indicator', ['label' => 'Semakan'])
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
