<x-default-layout>

    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Layout-->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Sidebar-->
            <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2 class="mb-0">{{ ucwords($role->name) }}</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Permissions-->
                        <div class="d-flex flex-column text-gray-600">
                            @foreach($role->permissions->shuffle()->take(5) as $permission)
                                <div class="d-flex align-items-center py-2">
                                    <span class="bullet bg-primary me-3"></span>
                                    {{ ucfirst($permission->name) }}
                                </div>
                            @endforeach
                            @if($role->permissions->count() > 5)
                                <div class="d-flex align-items-center py-2">
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
                    <div class="card-footer pt-0">
                        <button type="button" class="btn btn-light btn-active-primary" data-role-id="{{ $role->name }}" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Sidebar-->
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-10">
                <!--begin::Card-->
                <div class="card card-flush mb-6 mb-xl-9">
                    <!--begin::Card header-->
                    <div class="card-header pt-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2 class="d-flex align-items-center">Users Assigned
                                <span class="text-gray-600 fs-6 ms-1">({{ $role->users->count() }})</span>
                            </h2>
                        </div>
                        <!--end::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        {{ $dataTable->table() }}
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Layout-->
    </div>
    <!--end::Content container-->

    <!--begin::Modal-->
    <livewire:permission.role-modal></livewire:permission.role-modal>
    <!--end::Modal-->

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush

</x-default-layout>
