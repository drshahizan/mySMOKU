<div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Update Role</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-roles-modal-action="close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_update_role_form" class="form" action="#" wire:submit.prevent="submit">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                         data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">
                                <span class="required">Role name</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input class="form-control form-control-solid" placeholder="Enter a role name" name="name" wire:model.defer="name"/>
                            <!--end::Input-->
                            @error('name')
                            <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Permissions-->
                        <div class="fv-row">
                            <!--begin::Label-->
                            <label class="fs-5 fw-bold form-label mb-2">Role Permissions</label>
                            <!--end::Label-->
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5">
                                    <!--begin::Table body-->
                                    <tbody class="text-gray-600 fw-semibold">
                                    <!--begin::Table row-->
                                    <tr>
                                        <td class="text-gray-800">Administrator Access
                                            <span class="ms-1" data-bs-toggle="tooltip" title="Allows a full access to the system">
                                                {!! getIcon('information-5','text-gray-500 fs-6') !!}
                                            </span>
                                        </td>
                                        <td>
                                            <!--begin::Checkbox-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-9">
                                                <input class="form-check-input" type="checkbox" id="kt_roles_select_all" wire:model.defer="check_all" wire:change="checkAll" />
                                                <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                            </label>
                                            <!--end::Checkbox-->
                                        </td>
                                    </tr>
                                    <!--end::Table row-->
                                    @foreach($permissions_by_group as $group => $permissions)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Label-->
                                            <td class="text-gray-800">{{ ucwords($group) }}</td>
                                            <!--end::Label-->
                                            <!--begin::Input group-->
                                            @foreach($permissions as $permission)
                                                <td>
                                                    <!--begin::Wrapper-->
                                                    <div class="d-flex">
                                                        <!--begin::Checkbox-->
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <input class="form-check-input" type="checkbox" wire:model.defer="checked_permissions" value="{{ $permission->name }}"/>
                                                            <span class="form-check-label">{{ ucwords(Str::before($permission->name, ' ')) }}</span>
                                                        </label>
                                                        <!--end::Checkbox-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </td>
                                            @endforeach
                                            <!--end::Input group-->
                                        </tr>
                                        <!--end::Table row-->
                                    @endforeach
                                    <!--begin::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Permissions-->
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

@push('scripts')
    <script>
        const modal = document.querySelector('#kt_modal_update_role');

        modal.addEventListener('show.bs.modal', (e) => {
            Livewire.emit('modal.show.role_name', e.relatedTarget.getAttribute('data-role-id'));
        });
    </script>
@endpush