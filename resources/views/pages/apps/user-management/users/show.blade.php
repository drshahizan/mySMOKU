<x-default-layout>

    <div class="d-flex flex-column flex-lg-row">

        <!--begin::Sidebar-->
        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
            <!--begin::Card-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card body-->
                <div class="card-body">
                    <!--begin::Summary-->
                    <!--begin::User Info-->
                    <div class="d-flex flex-center flex-column py-5">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-100px symbol-circle mb-7">
                            @if($user->profile_photo_url)
                                <img src="{{ $user->profile_photo_url }}" alt="image"/>
                            @else
                                <div class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?', $user->name) }}">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $user->name }}</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="mb-9">
                            @foreach($user->roles as $role)
                                <!--begin::Badge-->
                                <div class="badge badge-lg badge-light-primary d-inline">{{ ucwords($role->name) }}</div>
                                <!--begin::Badge-->
                            @endforeach
                        </div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <!--begin::Info heading-->
                        <div class="fw-bold mb-3">Assigned Tickets
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week.">
                                {!! getIcon('information','fs-7') !!}
                            </span>
                        </div>
                        <!--end::Info heading-->
                        <div class="d-flex flex-wrap flex-center">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-75px">243</span>
                                    {!! getIcon('arrow-up','fs-3 text-success') !!}
                                </div>
                                <div class="fw-semibold text-muted">Total</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">56</span>
                                    {!! getIcon('arrow-down','fs-3 text-danger') !!}
                                </div>
                                <div class="fw-semibold text-muted">Solved</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                <div class="fs-4 fw-bold text-gray-700">
                                    <span class="w-50px">188</span>
                                    {!! getIcon('arrow-up','fs-3 text-success') !!}
                                </div>
                                <div class="fw-semibold text-muted">Open</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User Info-->
                    <!--end::Summary-->
                    <!--begin::Details toggle-->
                    <div class="d-flex flex-stack fs-4 py-3">
                        <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                            <span class="ms-2 rotate-180">
                                {!! getIcon('down','fs-3') !!}
                            </span>
                        </div>
                        <span data-bs-toggle="tooltip" data-bs-trigger="hover" title="Edit customer details">
                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_update_details">Edit</a>
                        </span>
                    </div>
                    <!--end::Details toggle-->
                    <div class="separator"></div>
                    <!--begin::Details content-->
                    <div id="kt_user_view_details" class="collapse show">
                        <div class="pb-5 fs-6">
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Account ID</div>
                            <div class="text-gray-600">ID-{{ uniqid() }}</div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Email</div>
                            <div class="text-gray-600">
                                <a href="mailto:{{ $user->email }}" class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Address</div>
                            <div class="text-gray-600">101 Collin Street,
                                <br/>Melbourne 3000 VIC
                                <br/>Australia
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Language</div>
                            <div class="text-gray-600">
                                {{ Locale::getDisplayLanguage(app()->getLocale())  }}
                            </div>
                            <!--begin::Details item-->
                            <!--begin::Details item-->
                            <div class="fw-bold mt-5">Last Login</div>
                            <div class="text-gray-600">
                                {{ $user->last_login_at?->format('j M Y, g:i a') ?? 'Never login' }}
                            </div>
                            <!--begin::Details item-->
                        </div>
                    </div>
                    <!--end::Details content-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Connected Accounts-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Card header-->
                <div class="card-header border-0">
                    <div class="card-title">
                        <h3 class="fw-bold m-0">Connected Accounts</h3>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-2">
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-design-1 fs-2tx text-primary me-4"></i>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">By connecting an account, you hereby agree to our
                                    <a href="#" class="me-1">privacy policy</a>and
                                    <a href="#">terms of use</a>.
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--begin::Items-->
                    <div class="py-2">
                        <!--begin::Item-->
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <img src="{{ image('svg/brand-logos/google-icon.svg') }}" class="w-30px me-6" alt=""/>
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-5 text-dark text-hover-primary fw-bold">Google</a>
                                    <div class="fs-6 fw-semibold text-muted">Plan properly your workflow</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="google" type="checkbox" value="1" id="kt_modal_connected_accounts_google" checked="checked"/>
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_google"></span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Item-->
                        <div class="separator separator-dashed my-5"></div>
                        <!--begin::Item-->
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <img src="{{ image('svg/brand-logos/github.svg') }}" class="w-30px me-6" alt=""/>
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-5 text-dark text-hover-primary fw-bold">Github</a>
                                    <div class="fs-6 fw-semibold text-muted">Keep eye on on your Repositories</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="github" type="checkbox" value="1" id="kt_modal_connected_accounts_github" checked="checked"/>
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_github"></span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Item-->
                        <div class="separator separator-dashed my-5"></div>
                        <!--begin::Item-->
                        <div class="d-flex flex-stack">
                            <div class="d-flex">
                                <img src="{{ image('svg/brand-logos/slack-icon') }}.svg" class="w-30px me-6" alt=""/>
                                <div class="d-flex flex-column">
                                    <a href="#" class="fs-5 text-dark text-hover-primary fw-bold">Slack</a>
                                    <div class="fs-6 fw-semibold text-muted">Integrate Projects Discussions</div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <!--begin::Switch-->
                                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input" name="slack" type="checkbox" value="1" id="kt_modal_connected_accounts_slack"/>
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_slack"></span>
                                    <!--end::Label-->
                                </label>
                                <!--end::Switch-->
                            </div>
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Card body-->
                <!--begin::Card footer-->
                <div class="card-footer border-0 d-flex justify-content-center pt-0">
                    <button class="btn btn-sm btn-light-primary">Save Changes</button>
                </div>
                <!--end::Card footer-->
            </div>
            <!--end::Connected Accounts-->
        </div>
        <!--end::Sidebar-->

        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_overview_tab">Overview</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_overview_security">Security</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_user_view_overview_events_and_logs_tab">Events & Logs</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item ms-auto">
                    <!--begin::Action menu-->
                    <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
                        <i class="ki-duotone ki-down fs-2 me-0"></i></a>
                    <!--begin::Menu-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Payments</div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">Create invoice</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link flex-stack px-5">Create payments
                                <span class="ms-2" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference">
                                    <i class="ki-duotone ki-information fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                            <a href="#" class="menu-link px-5">
                                <span class="menu-title">Subscription</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <!--begin::Menu sub-->
                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-5">Apps</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-5">Billing</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-5">Statements</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3">
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input w-30px h-20px" type="checkbox" value="" name="notifications" checked="checked" id="kt_user_menu_notifications"/>
                                            <span class="form-check-label text-muted fs-6" for="kt_user_menu_notifications">Notifications</span>
                                        </label>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu sub-->
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu separator-->
                        <div class="separator my-3"></div>
                        <!--end::Menu separator-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Account</div>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link px-5">Reports</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5 my-1">
                            <a href="#" class="menu-link px-5">Account Settings</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-5">
                            <a href="#" class="menu-link text-danger px-5">Delete customer</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu-->
                    <!--end::Menu-->
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="kt_user_view_overview_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">User's Schedule</h2>
                                <div class="fs-6 fw-semibold text-muted">2 upcoming meetings</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_schedule">
                                    <i class="ki-duotone ki-brush fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Add Schedule
                                </button>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body p-9 pt-4">
                            <!--begin::Dates-->
                            <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2">
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_0">
                                        <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                        <span class="fs-6 fw-bolder">21</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary active" data-bs-toggle="tab" href="#kt_schedule_day_1">
                                        <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                        <span class="fs-6 fw-bolder">22</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_2">
                                        <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                        <span class="fs-6 fw-bolder">23</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_3">
                                        <span class="opacity-50 fs-7 fw-semibold">We</span>
                                        <span class="fs-6 fw-bolder">24</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_4">
                                        <span class="opacity-50 fs-7 fw-semibold">Th</span>
                                        <span class="fs-6 fw-bolder">25</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_5">
                                        <span class="opacity-50 fs-7 fw-semibold">Fr</span>
                                        <span class="fs-6 fw-bolder">26</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_6">
                                        <span class="opacity-50 fs-7 fw-semibold">Sa</span>
                                        <span class="fs-6 fw-bolder">27</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_7">
                                        <span class="opacity-50 fs-7 fw-semibold">Su</span>
                                        <span class="fs-6 fw-bolder">28</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_8">
                                        <span class="opacity-50 fs-7 fw-semibold">Mo</span>
                                        <span class="fs-6 fw-bolder">29</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_9">
                                        <span class="opacity-50 fs-7 fw-semibold">Tu</span>
                                        <span class="fs-6 fw-bolder">30</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                                <!--begin::Date-->
                                <li class="nav-item me-1">
                                    <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-40px me-2 py-4 btn-active-primary" data-bs-toggle="tab" href="#kt_schedule_day_10">
                                        <span class="opacity-50 fs-7 fw-semibold">We</span>
                                        <span class="fs-6 fw-bolder">31</span>
                                    </a>
                                </li>
                                <!--end::Date-->
                            </ul>
                            <!--end::Dates-->
                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Day-->
                                <div id="kt_schedule_day_0" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_1" class="tab-pane fade show active">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">12:00 - 13:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Caleb Donaldson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Mark Randall</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">10:00 - 11:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_2" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">16:30 - 17:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Mark Randall</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Caleb Donaldson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_3" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">12:00 - 13:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Michael Walters</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Bob Harris</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">12:00 - 13:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Caleb Donaldson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_4" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Naomi Hayabusa</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">16:30 - 17:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_5" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">10:00 - 11:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Caleb Donaldson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">10:00 - 11:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Naomi Hayabusa</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Bob Harris</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_6" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Sean Bean</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">16:30 - 17:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Weekly Team Stand-Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_7" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">16:30 - 17:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Karina Clarke</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Committee Review Approvals</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Kendell Trevor</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">12:00 - 13:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Mark Randall</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Development Team Capacity Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_8" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">10:00 - 11:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Michael Walters</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">9:00 - 10:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Lunch & Learn Catch Up</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_9" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">13:00 - 14:00
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Sales Pitch Proposal</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Caleb Donaldson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Dashboard UI/UX Design Review</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Yannis Gloverson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                                <!--begin::Day-->
                                <div id="kt_schedule_day_10" class="tab-pane fade show">
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">14:30 - 15:30
                                                <span class="fs-7 text-muted text-uppercase">pm</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Karina Clarke</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">10:00 - 11:00
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Team Backlog Grooming Session</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Peter Marcus</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Marketing Campaign Discussion</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Terry Robins</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">9 Degree Project Estimation Meeting</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">David Stevenson</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                    <!--begin::Time-->
                                    <div class="d-flex flex-stack position-relative mt-6">
                                        <!--begin::Bar-->
                                        <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>
                                        <!--end::Bar-->
                                        <!--begin::Info-->
                                        <div class="fw-semibold ms-5">
                                            <!--begin::Time-->
                                            <div class="fs-7 mb-1">11:00 - 11:45
                                                <span class="fs-7 text-muted text-uppercase">am</span>
                                            </div>
                                            <!--end::Time-->
                                            <!--begin::Title-->
                                            <a href="#" class="fs-5 fw-bold text-dark text-hover-primary mb-2">Creative Content Initiative</a>
                                            <!--end::Title-->
                                            <!--begin::User-->
                                            <div class="fs-7 text-muted">Lead by
                                                <a href="#">Bob Harris</a></div>
                                            <!--end::User-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Action-->
                                        <a href="#" class="btn btn-light bnt-active-light-primary btn-sm">View</a>
                                        <!--end::Action-->
                                    </div>
                                    <!--end::Time-->
                                </div>
                                <!--end::Day-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Tasks-->
                    <div class="card card-flush mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header mt-6">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">User's Tasks</h2>
                                <div class="fs-6 fw-semibold text-muted">Total 25 tasks in backlog</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_add_task">
                                    <i class="ki-duotone ki-add-files fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>Add Task
                                </button>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Details-->
                                <div class="fw-semibold ms-5">
                                    <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Create FureStibe branding logo</a>
                                    <!--begin::Info-->
                                    <div class="fs-7 text-muted">Due in 1 day
                                        <a href="#">Karina Clark</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-setting-3 fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>
                                <!--begin::Task menu-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Update Status</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="3">In Process</option>
                                                <option value="4">Rejected</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                                <span class="indicator-label">Apply</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Task menu-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Details-->
                                <div class="fw-semibold ms-5">
                                    <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Schedule a meeting with FireBear CTO John</a>
                                    <!--begin::Info-->
                                    <div class="fs-7 text-muted">Due in 3 days
                                        <a href="#">Rober Doe</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-setting-3 fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>
                                <!--begin::Task menu-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Update Status</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="3">In Process</option>
                                                <option value="4">Rejected</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                                <span class="indicator-label">Apply</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Task menu-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Details-->
                                <div class="fw-semibold ms-5">
                                    <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">9 Degree Project Estimation</a>
                                    <!--begin::Info-->
                                    <div class="fs-7 text-muted">Due in 1 week
                                        <a href="#">Neil Owen</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-setting-3 fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>
                                <!--begin::Task menu-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Update Status</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="3">In Process</option>
                                                <option value="4">Rejected</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                                <span class="indicator-label">Apply</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Task menu-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative mb-7">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Details-->
                                <div class="fw-semibold ms-5">
                                    <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Dashboard UI & UX for Leafr CRM</a>
                                    <!--begin::Info-->
                                    <div class="fs-7 text-muted">Due in 1 week
                                        <a href="#">Olivia Wild</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-setting-3 fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>
                                <!--begin::Task menu-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Update Status</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="3">In Process</option>
                                                <option value="4">Rejected</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                                <span class="indicator-label">Apply</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Task menu-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center position-relative">
                                <!--begin::Label-->
                                <div class="position-absolute top-0 start-0 rounded h-100 bg-secondary w-4px"></div>
                                <!--end::Label-->
                                <!--begin::Details-->
                                <div class="fw-semibold ms-5">
                                    <a href="#" class="fs-5 fw-bold text-dark text-hover-primary">Mivy App R&D, Meeting with clients</a>
                                    <!--begin::Info-->
                                    <div class="fs-7 text-muted">Due in 2 weeks
                                        <a href="#">Sean Bean</a></div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Details-->
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-setting-3 fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button>
                                <!--begin::Task menu-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" data-kt-menu-id="kt-users-tasks">
                                    <!--begin::Header-->
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bold">Update Status</div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Menu separator-->
                                    <div class="separator border-gray-200"></div>
                                    <!--end::Menu separator-->
                                    <!--begin::Form-->
                                    <form class="form px-7 py-5" data-kt-menu-id="kt-users-tasks-form">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fs-6 fw-semibold">Status:</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select class="form-select form-select-solid" name="task_status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-hide-search="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="3">In Process</option>
                                                <option value="4">Rejected</option>
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="button" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-users-update-task-status="reset">Reset</button>
                                            <button type="submit" class="btn btn-sm btn-primary" data-kt-users-update-task-status="submit">
                                                <span class="indicator-label">Apply</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Task menu-->
                                <!--end::Menu-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Tasks-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Profile</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                    <tr>
                                        <td>Email</td>
                                        <td>smith@kpmg.com</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                                <i class="ki-duotone ki-pencil fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                        <td>******</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                                <i class="ki-duotone ki-pencil fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>Administrator</td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                                <i class="ki-duotone ki-pencil fs-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2 class="mb-1">Two Step Authentication</h2>
                                <div class="fs-6 fw-semibold text-muted">Keep your account extra secure with a second authentication step.</div>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Add-->
                                <button type="button" class="btn btn-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-fingerprint-scanning fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>Add Authentication Step
                                </button>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_auth_app">Use authenticator app</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">Enable one-time password</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Add-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pb-5">
                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Content-->
                                <div class="d-flex flex-column">
                                    <span>SMS</span>
                                    <span class="text-muted fs-6">+61 412 345 678</span>
                                </div>
                                <!--end::Content-->
                                <!--begin::Action-->
                                <div class="d-flex justify-content-end align-items-center">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">
                                        <i class="ki-duotone ki-pencil fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" id="kt_users_delete_two_step">
                                        <i class="ki-duotone ki-trash fs-3">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Item-->
                            <!--begin:Separator-->
                            <div class="separator separator-dashed my-5"></div>
                            <!--end:Separator-->
                            <!--begin::Disclaimer-->
                            <div class="text-gray-600">If you lose your mobile device or security key, you can
                                <a href='#' class="me-1">generate a backup code</a>to sign in to your account.
                            </div>
                            <!--end::Disclaimer-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title flex-column">
                                <h2>Email Notifications</h2>
                                <div class="fs-6 fw-semibold text-muted">Choose what messages you’d like to receive for each of your accounts.</div>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Form-->
                            <form class="form" id="kt_users_email_notification_form">
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_0" type="checkbox" value="0" id="kt_modal_update_email_notification_0" checked='checked'/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_0">
                                            <div class="fw-bold">Successful Payments</div>
                                            <div class="text-gray-600">Receive a notification for every successful payment.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_1" type="checkbox" value="1" id="kt_modal_update_email_notification_1"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_1">
                                            <div class="fw-bold">Payouts</div>
                                            <div class="text-gray-600">Receive a notification for every initiated payout.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_2" type="checkbox" value="2" id="kt_modal_update_email_notification_2"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_2">
                                            <div class="fw-bold">Application fees</div>
                                            <div class="text-gray-600">Receive a notification each time you collect a fee from an account.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_3" type="checkbox" value="3" id="kt_modal_update_email_notification_3" checked='checked'/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_3">
                                            <div class="fw-bold">Disputes</div>
                                            <div class="text-gray-600">Receive a notification if a payment is disputed by a customer and for dispute resolutions.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_4" type="checkbox" value="4" id="kt_modal_update_email_notification_4" checked='checked'/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_4">
                                            <div class="fw-bold">Payment reviews</div>
                                            <div class="text-gray-600">Receive a notification if a payment is marked as an elevated risk.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_5" type="checkbox" value="5" id="kt_modal_update_email_notification_5"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_5">
                                            <div class="fw-bold">Mentions</div>
                                            <div class="text-gray-600">Receive a notification if a teammate mentions you in a note.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_6" type="checkbox" value="6" id="kt_modal_update_email_notification_6"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_6">
                                            <div class="fw-bold">Invoice Mispayments</div>
                                            <div class="text-gray-600">Receive a notification if a customer sends an incorrect amount to pay their invoice.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_7" type="checkbox" value="7" id="kt_modal_update_email_notification_7"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_7">
                                            <div class="fw-bold">Webhooks</div>
                                            <div class="text-gray-600">Receive notifications about consistently failing webhook endpoints.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <div class='separator separator-dashed my-5'></div>
                                <!--begin::Item-->
                                <div class="d-flex">
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input me-3" name="email_notification_8" type="checkbox" value="8" id="kt_modal_update_email_notification_8"/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="kt_modal_update_email_notification_8">
                                            <div class="fw-bold">Trial</div>
                                            <div class="text-gray-600">Receive helpful tips when you try out our products.</div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Item-->
                                <!--begin::Action buttons-->
                                <div class="d-flex justify-content-end align-items-center mt-12">
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-light me-5" id="kt_users_email_notification_cancel">Cancel</button>
                                    <!--end::Button-->
                                    <!--begin::Button-->
                                    <button type="button" class="btn btn-primary" id="kt_users_email_notification_submit">
                                        <span class="indicator-label">Save</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                                <!--begin::Action buttons-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Card footer-->
                        <!--end::Card footer-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Login Sessions</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Filter-->
                                <button type="button" class="btn btn-sm btn-flex btn-light-primary" id="kt_modal_sign_out_sesions">
                                    <i class="ki-duotone ki-entrance-right fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Sign out all sessions
                                </button>
                                <!--end::Filter-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                                    <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                    <tr class="text-start text-muted text-uppercase gs-0">
                                        <th class="min-w-100px">Location</th>
                                        <th>Device</th>
                                        <th>IP Address</th>
                                        <th class="min-w-125px">Time</th>
                                        <th class="min-w-70px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                    <tr>
                                        <td>Australia</td>
                                        <td>Chome - Windows</td>
                                        <td>207.15.36.350</td>
                                        <td>23 seconds ago</td>
                                        <td>Current session</td>
                                    </tr>
                                    <tr>
                                        <td>Australia</td>
                                        <td>Safari - iOS</td>
                                        <td>207.40.34.196</td>
                                        <td>3 days ago</td>
                                        <td>
                                            <a href="#" data-kt-users-sign-out="single_user">Sign out</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Australia</td>
                                        <td>Chrome - Windows</td>
                                        <td>207.36.32.201</td>
                                        <td>last week</td>
                                        <td>Expired</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Logs</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="ki-duotone ki-cloud-download fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Download Report
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-0">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5" id="kt_table_users_logs">
                                    <tbody>
                                    <tr>
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-success">200 OK</div>
                                        </td>
                                        <td>POST /v1/invoices/in_3821_6566/payment</td>
                                        <td class="pe-0 text-end min-w-200px">20 Dec 2023, 6:05 pm</td>
                                    </tr>
                                    <tr>
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-success">200 OK</div>
                                        </td>
                                        <td>POST /v1/invoices/in_8762_4848/payment</td>
                                        <td class="pe-0 text-end min-w-200px">15 Apr 2023, 10:10 pm</td>
                                    </tr>
                                    <tr>
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-warning">404 WRN</div>
                                        </td>
                                        <td>POST /v1/customer/c_6486a706b9af1/not_found</td>
                                        <td class="pe-0 text-end min-w-200px">20 Jun 2023, 8:43 pm</td>
                                    </tr>
                                    <tr>
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-warning">404 WRN</div>
                                        </td>
                                        <td>POST /v1/customer/c_6486a706b9af1/not_found</td>
                                        <td class="pe-0 text-end min-w-200px">25 Jul 2023, 5:30 pm</td>
                                    </tr>
                                    <tr>
                                        <td class="min-w-70px">
                                            <div class="badge badge-light-danger">500 ERR</div>
                                        </td>
                                        <td>POST /v1/invoice/in_2645_9278/invalid</td>
                                        <td class="pe-0 text-end min-w-200px">20 Dec 2023, 11:05 am</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Events</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <button type="button" class="btn btn-sm btn-light-primary">
                                    <i class="ki-duotone ki-cloud-download fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Download Report
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5" id="kt_table_customers_events">
                                <tbody>
                                <tr>
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Brian Cox</a>has made payment to
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary">#OLP-45690</a></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2023, 6:05 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#SEP-45656</a>status has changed from
                                        <span class="badge badge-light-warning me-1">Pending</span>
                                        to
                                        <span class="badge badge-light-info">In Progress</span>
                                    </td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2023, 10:30 am</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#SEP-45656</a>status has changed from
                                        <span class="badge badge-light-warning me-1">Pending</span>
                                        to
                                        <span class="badge badge-light-info">In Progress</span>
                                    </td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">10 Mar 2023, 10:10 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">15 Apr 2023, 11:30 am</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#DER-45645</a>status has changed from
                                        <span class="badge badge-light-info me-1">In Progress</span>
                                        to
                                        <span class="badge badge-light-primary">In Transit</span>
                                    </td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">19 Aug 2023, 9:23 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2023, 10:30 am</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Max Smith</a>has made payment to
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">10 Mar 2023, 6:43 am</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Emma Smith</a>has made payment to
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">15 Apr 2023, 5:20 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">
                                        <a href="#" class="text-gray-600 text-hover-primary me-1">Melody Macy</a>has made payment to
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a></td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2023, 5:30 pm</td>
                                </tr>
                                <tr>
                                    <td class="min-w-400px">Invoice
                                        <a href="#" class="fw-bold text-gray-900 text-hover-primary me-1">#DER-45645</a>status has changed from
                                        <span class="badge badge-light-info me-1">In Progress</span>
                                        to
                                        <span class="badge badge-light-primary">In Transit</span>
                                    </td>
                                    <td class="pe-0 text-gray-600 text-end min-w-200px">19 Aug 2023, 2:40 pm</td>
                                </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->

    </div>

</x-default-layout>