<nav class="layout-navbar container-fluid navbar navbar-expand-xxl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Language -->
            <li class="nav-item dropdown-language dropdown me-2 me-xl-0">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    @if (session()->has('locale') && session()->get('locale') == 'en')
                        <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                    @else
                        <i class="fi fi-eg fis rounded-circle me-1 fs-3"></i>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ url('admin/lang/en') }}" data-language="en">
                            <i class="fi fi-us fis rounded-circle me-1 fs-3"></i>
                            <span class="align-middle">English</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ url('admin/lang/ar') }}" data-language="ar">
                            <i class="fi fi-eg fis rounded-circle me-1 fs-3"></i>
                            <span class="align-middle">العربية</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Language -->

            <!-- Dark Mode Toggle -->
            <li class="nav-item me-2 me-xl-0">
                <a class="nav-link hide-arrow" href="javascript:void(0);" id="darkModeToggle"
                    style="display: flex; align-items: center; padding: 0.5rem; border-radius: 0.375rem; transition: all 0.3s ease;">
                    <i class="ti ti-moon ti-md" id="darkModeIcon" style="font-size: 1.25rem; color: #697a8d;"></i>
                </a>
            </li>
            <!--/ Dark Mode Toggle -->

            <!-- Notification -->
            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
                    data-bs-auto-close="outside" aria-expanded="false">
                    <i class="ti ti-bell ti-md"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications" id="notification-count">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end py-0 notification-dropdown">
                    <li class="dropdown-menu-header border-bottom notification-header">
                        <div class="dropdown-header d-flex align-items-center py-3">
                            <h6 class="mb-0 me-auto">{{ trans('messages.notifications') }}</h6>
                            <a href="javascript:void(0)" class="text-body cursor-pointer" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="{{ trans('messages.mark_all_as_read') }}"
                                onclick="markAllNotificationsAsRead()" id="mark-all-read">
                                <i class="ti ti-mail-opened fs-4"></i>
                            </a>
                        </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container notification-body">
                        <ul class="list-group list-group-flush header-notifications-list" id="notifications-list">
                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar">
                                            <span class="avatar-initial rounded-circle bg-label-info">
                                                <i class="ti ti-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ trans('messages.loading') }}...</h6>
                                        <p class="mb-0">{{ trans('messages.please_wait') }}</p>
                                        <small class="text-muted">{{ trans('messages.just_now') }}</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top notification-footer">
                        <a href=""
                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                            {{ trans('messages.view_all_notifications') }}
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ Notification -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (auth('admin')->user() && auth('admin')->user()?->photo)
                            <img src="{{ asset('storage') }}/{{ auth('admin')->user()?->photo ?? '' }}"
                                alt="user avatar" class="h-250 rounded-circle" />
                        @else
                            <img src="{{ asset('vuexy-layout/assets/img/avatars/1.png') }}" alt="user avatar"
                                class="h-auto rounded-circle" />
                        @endif
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="">
                            <i class="ti ti-user-circle me-2 ti-sm"></i>
                            <span class="align-middle">{{ trans('messages.profile') }}</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{route('admin.logout')}}">
                            <i class="ti ti-logout me-2 ti-sm"></i>
                            <span class="align-middle">{{ trans('messages.logout') }}</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
