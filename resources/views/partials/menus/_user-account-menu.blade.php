<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-300px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            @php
                $nama = Auth::user()->nama;
                $user = DB::table('users')->where('no_kp', Auth::user()->no_kp)->first();
                $tahap = DB::table('roles')->where('id',$user->tahap)->value('name');
                if($user->tahap == 2 || $user->tahap == 6){
                    $institusi = DB::table('bk_info_institusi')->where('id_institusi',$user->id_institusi)->value('nama_institusi');
                }
            @endphp
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle($nama) }}" style="color:#3d0066; background-color:#e2cfea">
                    {{ substr($nama,0,1) }}
                </div>
            </div>
            <!--end::Avatar-->

            <!--begin::Username-->
            <div class="d-flex flex-column">
                <div class="fw-bold d-flex align-items-center fs-5">{{$nama}}</div>
                <div class="fw-semibold text-muted fs-7">{{Auth::user()->email}}</div>
                <div class="fw-bold d-flex align-items-center fs-7">{{strtoupper($tahap)}}</div>
                @if($user->tahap == 2 || $user->tahap == 6)
                <div class="fw-bold d-flex align-items-center fs-7">{{strtoupper($institusi)}}</div>
                @endif
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    @php
        $user = DB::table('users')->where('no_kp',Auth::user()->no_kp)->first();
        if($user->tahap == 1 ){
            $smoku = DB::table('smoku')->where('no_kp',Auth::user()->no_kp)->first();
            $permohonan = DB::table('permohonan')->where('smoku_id',$smoku->id)->first();
        }
    @endphp
    <!--begin::Menu item-->
    @if($user->tahap == 1 && ($permohonan != null && $permohonan->status >= 2))
        <div class="menu-item px-5">
            <a href="{{ route('profil.pelajar') }}" class="menu-link px-5">Profil Diri</a>
        </div>
    @endif
    <div class="menu-item px-5">
        <a href="{{ route('tukar.katalaluan') }}" class="menu-link px-5">Tukar Kata Laluan</a>
    </div>
    <div class="separator my-2"></div>
    <div class="menu-item px-5">
        <a class="button-ajax menu-link px-5" href="#" data-action="{{ route('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true">
            Log Keluar
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->
