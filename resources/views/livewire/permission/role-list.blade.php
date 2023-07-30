<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
    @foreach($roles as $role)
        <!--begin::Col-->
        <div class="col-md-4">
            <!--begin::Card-->
            <div class="card card-flush h-md-100">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>{{ ucwords($role->name) }}</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-1">
                    <!--begin::Users-->
                    <div class="fw-bold text-gray-600 mb-5">Total users with this role: {{ $role->users->count() }}</div>
                    <!--end::Users-->
                    <!--begin::Permissions-->
                    <div class="d-flex flex-column text-gray-600">
                        @foreach($role->permissions->shuffle()->take(5) ?? [] as $permission)
                            <div class="d-flex align-items-center py-2">
                                <span class="bullet bg-primary me-3"></span>{{ ucfirst($permission->name) }}</div>
                        @endforeach
                        @if($role->permissions->count() > 5)
                            <div class='d-flex align-items-center py-2'>
                                <span class='bullet bg-primary me-3'></span>
                                <em>and {{ $role->permissions->count()-5 }} more...</em>
                            </div>
                        @endif
                        @if($role->permissions->count() ===0)
                            <div class="d-flex align-items-center py-2">
                                <span class='bullet bg-primary me-3'></span>
                                <em>No permissions given...</em>
                            </div>
                        @endif
                    </div>
                    <!--end::Permissions-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer flex-wrap pt-0">
                    <a href="{{ route('user-management.roles.show', $role) }}" class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                    <button type="button" class="btn btn-light btn-active-light-primary my-1" data-role-id="{{ $role->name }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Col-->
    @endforeach

    <!--begin::Add new card-->
    <div class="ol-md-4">
        <!--begin::Card-->
        <div class="card h-md-100">
            <!--begin::Card body-->
            <div class="card-body d-flex flex-center">
                <!--begin::Button-->
                <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                    <!--begin::Illustration-->
                    <img src="{{ image('illustrations/sketchy-1/4.png') }}" alt="" class="mw-100 mh-150px mb-7"/>
                    <!--end::Illustration-->
                    <!--begin::Label-->
                    <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                    <!--end::Label-->
                </button>
                <!--begin::Button-->
            </div>
            <!--begin::Card body-->
        </div>
        <!--begin::Card-->
    </div>
    <!--begin::Add new card-->
</div>
