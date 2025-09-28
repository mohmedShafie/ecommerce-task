<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="" class="app-brand-link">
            <span class="app-brand-logo demo">
                @if (isset($logo_image) && $logo_image->value)
                    <img src="{{ asset('storage/') }}/{{ $logo_image->value }}" alt="logo" width="50" height="50"
                        onerror="this.onerror=null;this.src='{{ asset('syndron/images') }}/duaya_logo.png'">
                @else
                    <img src="{{ asset('syndron/images') }}/duaya_logo.png" alt="logo" width="50"
                        height="50">
                @endif
            </span>
            <span class="app-brand-text demo menu-text fw-bold">
                {{ $company_name->value ?? 'task' }}
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto" id="sidebar-toggle">
            <i class="ti ti-menu-2 menu-toggle-icon ti-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('agency/home') || Request::is('agency/') ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">{{ trans('messages.Dashboard') }}</div>
            </a>
        </li>
    </ul>
</aside>
