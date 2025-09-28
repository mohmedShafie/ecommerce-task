<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="light-style layout-navbar-fixed layout-menu-fixed"
    dir="{{ App::isLocale('ar') ? 'rtl' : 'ltr' }}" data-theme="theme-default"
    data-assets-path="{{ asset('vuexy-layout/dist/') }}" data-template="vertical-menu-template"
    style="overflow: scroll !important;"
    >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="pusher-key" content="{{ config('broadcasting.connections.pusher.key') }}" />
    <meta name="pusher-cluster" content="{{ config('broadcasting.connections.pusher.options.cluster') }}" />
    <meta name="user-type" content="admin" />
    <meta name="user-id" content="{{ auth()->guard('admin')->user()->id ?? '' }}" />
    <meta name="admin-id" content="{{ auth()->guard('admin')->user()->id ?? '' }}" />
    {{-- <meta name="notifications-url" content="{{ route('admin.database-notifications.get') }}" /> --}}
    {{-- <meta name="mark-read-url" content="{{ route('admin.notifications.mark-read', ':id') }}" />
    <meta name="mark-all-read-url" content="{{ route('admin.notifications.mark-all-read') }}" /> --}}
    <meta name="notification-sound" content="{{ asset('notification/notification.mp3') }}" />
    <meta http-equiv="Permissions-Policy" content="unload=*">

    <!-- Security Headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="SAMEORIGIN">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Referrer-Policy" content="strict-origin-when-cross-origin">

    <!-- Note: CSP should be set via HTTP headers in middleware, not meta tags -->

    <title>task | @yield('title')</title>

    @if (isset($logo_image) && $logo_image->value)
        <link rel="icon" href="{{ asset('storage/') }}/{{ $logo_image->value }}" type="image/png" />
    @else
        <link rel="icon" type="image/x-icon" href="{{ asset('syndron/images/task_logo.png') }}"
            style="width: 20px; height: 20px;" />
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    @if (App::isLocale('ar'))
        <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/css/rtl/core.css') }}"
            class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/css/rtl/theme-default.css') }}"
            class="template-customizer-theme-css" />
    @else
        <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/css/rtl/core.css') }}"
            class="template-customizer-core-css" />
        <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/css/rtl/theme-default.css') }}"
            class="template-customizer-theme-css" />
    @endif
    <link rel="stylesheet" href="{{ asset('vuexy-layout/assets/css/demo.css') }}" />

    <!-- Popper.js Fixes -->
    <link rel="stylesheet" href="{{ asset('css/popper-fixes.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('vuexy-layout/dist/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('vuexy-layout/dist/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/select2/select2.css') }}" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/sweetalert2/sweetalert2.css') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('vuexy-layout/dist/libs/toastr/toastr.css') }}" />

    <!-- Notification translations -->
    <script>
        // Initialize translations safely
        if (typeof window.translations === 'undefined') {
            window.translations = {};
        }

        // Merge notification translations
        Object.assign(window.translations, {
            'no_notifications': '{{ trans('messages.no_notifications') }}',
            'mark_all_as_read': '{{ trans('messages.mark_all_as_read') }}',
            'view_all_notifications': '{{ trans('messages.view_all_notifications') }}',
            'notifications': '{{ trans('messages.notifications') }}',
            'load_more': '{{ trans('messages.load_more') }}'
        });
    </script>

    <!-- Custom Notification Dropdown CSS -->
    <style>
        .notification-dropdown {
            width: 380px !important;
            max-height: 500px !important;
            padding: 0 !important;
            border: 1px solid #e9ecef;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.375rem;
        }

        .notification-dropdown .notification-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .notification-dropdown .notification-header h6 {
            font-size: 0.875rem;
            font-weight: 600;
            color: #495057;
        }

        .notification-dropdown .notification-header #mark-all-read {
            font-size: 0.75rem;
            color: #6c757d;
            cursor: pointer;
            transition: color 0.15s ease-in-out;
        }

        .notification-dropdown .notification-header #mark-all-read:hover {
            color: #007bff;
        }

        .notification-dropdown .notification-body {
            max-height: 350px;
            overflow-y: auto;
        }

        .notification-dropdown .header-notifications-list {
            padding: 0;
        }

        .notification-dropdown .header-notifications-list .dropdown-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f8f9fa;
            transition: background-color 0.15s ease-in-out;
        }

        .notification-dropdown .header-notifications-list .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .notification-dropdown .header-notifications-list .dropdown-item:last-child {
            border-bottom: none;
        }

        .notification-dropdown .notification-pagination {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .notification-dropdown .notification-footer {
            background-color: #f8f9fa;
        }

        .notification-dropdown .notification-footer a {
            color: #6c757d;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.15s ease-in-out;
        }

        .notification-dropdown .notification-footer a:hover {
            color: #007bff;
        }

        /* Notification read/unread styles */
        .dropdown-notifications-item.unread {
            background-color: #f8f9ff;
            border-left: 3px solid #007bff;
        }

        .dropdown-notifications-item.read {
            background-color: #ffffff;
            opacity: 0.8;
        }

        .dropdown-notifications-item.unread .fw-bold {
            font-weight: 600 !important;
        }

        .dropdown-notifications-item:hover {
            background-color: #f0f0f0 !important;
        }

        .notification-dropdown .notify {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.75rem;
        }

        .notification-dropdown .msg-name {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
            line-height: 1.2;
        }

        .notification-dropdown .msg-time {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .notification-dropdown .msg-info {
            font-size: 0.8125rem;
            color: #6c757d;
            margin-bottom: 0;
            line-height: 1.3;
        }

        .notification-dropdown .alert-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* RTL Support */
        [dir="rtl"] .notification-dropdown {
            text-align: right;
        }

        [dir="rtl"] .notification-dropdown .notify {
            margin-right: 0;
            margin-left: 0.75rem;
        }

        [dir="rtl"] .notification-dropdown .msg-time {
            float: left !important;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .notification-dropdown {
                width: 320px !important;
                max-height: 400px !important;
            }

            .notification-dropdown .notification-body {
                max-height: 250px;
            }
        }

        @media (max-width: 576px) {
            .notification-dropdown {
                width: 280px !important;
                left: auto !important;
                right: 0 !important;
            }
        }

        /* Fix dropdown positioning */
        .dropdown-large .dropdown-menu {
            margin-top: 0;
        }

        /* Ensure dropdown is above other elements */
        .notification-dropdown {
            z-index: 1050 !important;
        }

        /* Fix cursor pointer for clickable elements */
        .cursor-pointer {
            cursor: pointer;
        }

        /* Prevent dropdown from closing when clicking inside */
        .notification-dropdown {
            pointer-events: auto;
        }

        .notification-dropdown * {
            pointer-events: auto;
        }

        /* Ensure buttons inside dropdown work properly */
        .notification-dropdown .btn,
        .notification-dropdown a {
            pointer-events: auto;
        }

        /* Style for notification footer */
        .notification-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .notification-footer a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.15s ease-in-out;
        }

        .notification-footer a:hover {
            color: #0056b3;
            background-color: #e9ecef;
        }
    </style>
    <!-- Sidebar Collapse CSS -->
    <style>
        /* Mobile Menu Button */
        .mobile-menu-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1060;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            display: none;
            cursor: pointer;
        }

        @media (max-width: 1199.98px) {
            .mobile-menu-btn {
                display: block;
            }
        }

        /* Sidebar Collapse States */
        #layout-menu {
            transition: width 0.3s ease, transform 0.3s ease;
            width: 260px;
            position: fixed;
            height: 100vh;
            z-index: 1050;
        }

        /* Desktop Collapsed State */
        #layout-menu.collapsed {
            width: 78px;
        }

        #layout-menu.collapsed .app-brand-text,
        #layout-menu.collapsed .menu-header-text,
        #layout-menu.collapsed .menu-link > div:not(.menu-toggle-icon) {
            opacity: 0;
            visibility: hidden;
        }

        /* Ensure toggle button stays visible */
        #layout-menu.collapsed .layout-menu-toggle {
            opacity: 1;
            visibility: visible;
            display: block;
        }

        #layout-menu.collapsed .menu-item .menu-link {
            padding-left: 1.25rem;
            padding-right: 1.25rem;
        }

        #layout-menu.collapsed .menu-icon {
            margin-right: 0;
        }

        /* Mobile Hidden State */
        #layout-menu.mobile-hidden {
            transform: translateX(-100%);
        }

        #layout-menu.show {
            transform: translateX(0);
        }

        @media (max-width: 1199.98px) {
            .layout-page {
                margin-left: 0;
            }
        }

        /* Menu Content Scrolling */
        .menu-inner {
            height: calc(100vh - 120px);
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Sidebar Overlay for Mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1040;
            display: none;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }

        /* Menu Toggle Button */
        .layout-menu-toggle {
            cursor: pointer;
            padding: 0.5rem;
            display: flex !important;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        .layout-menu-toggle:hover {
            background-color: rgba(0,0,0,0.1);
        }

        .layout-menu-toggle .menu-toggle-icon {
            font-size: 1.25rem;
            color: #6c757d;
        }

        /* Responsive Design */
        @media (max-width: 1199.98px) {
            #layout-menu {
                transform: translateX(-100%);
            }

            #layout-menu.show {
                transform: translateX(0);
            }
        }

        /* Animation for menu items */
        .menu-item {
            transition: all 0.2s ease;
        }

        .menu-item:hover {
            transform: translateX(2px);
        }

        #layout-menu.collapsed .menu-item:hover {
            transform: none;
        }

        /* Fix for menu text visibility */
        #layout-menu.collapsed .menu-link > div {
            transition: opacity 0.3s ease;
        }

        #layout-menu:not(.collapsed) .menu-link > div {
            opacity: 1;
            visibility: visible;
        }
    </style>

    <!-- Template Configuration -->
    <script src="{{ asset('vuexy-layout/assets/js/config.js') }}"></script>
    <script src="{{ asset('vuexy-layout/dist/js/helpers.js') }}"></script>

    @stack('css_or_js')
    @include('admin.layouts.partials._colors')
</head>

<body>
    <!-- Mobile Menu Button -->
    <button type="button" class="mobile-menu-btn" id="mobile-menu-toggle" title="Open Menu">
        <i class="ti ti-menu-2"></i>
    </button>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.layouts.partials._sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('admin.layouts.partials._header')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-fluid flex-grow-1 container-p-y">
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    @include('admin.layouts.partials._footer')
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <script src="{{ asset('vuexy-layout/dist/libs/jquery/jquery.js') }}"
            onerror="console.warn('jQuery failed to load, using fallback')"></script>
    <script src="{{ asset('vuexy-layout/dist/libs/popper/popper.js') }}"
            onerror="console.warn('Popper failed to load, continuing...')"></script>
    <script src="{{ asset('vuexy-layout/dist/js/bootstrap.js') }}"
            onerror="console.warn('Bootstrap failed to load, using fallback')"></script>

    <!-- jQuery/Bootstrap Compatibility Fix -->
    <script>
        // Wait for DOM to ensure all scripts have loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Check if jQuery loaded properly
            if (typeof jQuery === 'undefined') {
                console.error('❌ jQuery failed to load properly');

                // Try to load jQuery from CDN as fallback
                const script = document.createElement('script');
                script.src = 'https://code.jquery.com/jquery-3.6.4.min.js';
                script.integrity = 'sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=';
                script.crossOrigin = 'anonymous';
                script.onload = function() {
                    console.log('✅ jQuery loaded from CDN fallback');
                    window.$ = window.jQuery = jQuery;
                    initializeLibraries();
                };
                script.onerror = function() {
                    console.error('❌ jQuery CDN fallback also failed');
                    createjQueryFallback();
                };
                document.head.appendChild(script);
            } else {
                // jQuery loaded successfully
                console.log('✅ jQuery loaded successfully');

                // Ensure global access
                if (typeof $ === 'undefined') {
                    window.$ = jQuery;
                }

                // Make sure jQuery is available globally
                window.$ = window.jQuery = jQuery;

                initializeLibraries();
            }
        });

        // Initialize libraries that depend on jQuery
        function initializeLibraries() {
            // Re-initialize any libraries that need jQuery
            if (window.$ && $.fn) {
                console.log('🔧 Initializing jQuery-dependent libraries');

                // Initialize Select2 if available
                if (typeof $.fn.select2 !== 'undefined') {
                    console.log('✅ Select2 available');
                } else if (window.Select2) {
                    console.log('✅ Select2 loaded as standalone');
                }

                // Initialize DataTables if available
                if (typeof $.fn.DataTable !== 'undefined') {
                    console.log('✅ DataTables available');
                }

                // Trigger custom event for other scripts
                $(document).trigger('jquery-ready');
            }
        }

        // Create minimal jQuery fallback
        function createjQueryFallback() {
            console.warn('⚠️ Creating minimal jQuery fallback');
            window.$ = window.jQuery = function(selector) {
                if (typeof selector === 'function') {
                    // Document ready
                    if (document.readyState === 'loading') {
                        document.addEventListener('DOMContentLoaded', selector);
                    } else {
                        selector();
                    }
                    return;
                }

                // Basic element selection
                const elements = typeof selector === 'string' ?
                    document.querySelectorAll(selector) :
                    [selector].filter(Boolean);

                return {
                    length: elements.length,
                    each: function(callback) {
                        elements.forEach(callback);
                        return this;
                    },
                    on: function(event, handler) {
                        elements.forEach(el => el.addEventListener(event, handler));
                        return this;
                    },
                    trigger: function(event) {
                        elements.forEach(el => {
                            const evt = new Event(event);
                            el.dispatchEvent(evt);
                        });
                        return this;
                    },
                    fn: {}
                };
            };

            // Add common jQuery methods
            $.fn = window.$.fn = {};
            $.noConflict = function() { return window.$; };
        }

        // Bootstrap fallback if not loaded
        if (typeof bootstrap === 'undefined') {
            console.warn('Bootstrap not loaded, creating minimal fallback');
            window.bootstrap = {
                Toast: function(element, config) {
                    return {
                        show: function() {
                            if (element) {
                                element.style.display = 'block';
                                element.style.opacity = '1';
                            }
                        },
                        hide: function() {
                            if (element) {
                                element.style.opacity = '0';
                                setTimeout(() => {
                                    element.style.display = 'none';
                                }, 300);
                            }
                        }
                    };
                }
            };
        }
    </script>

    <!-- Vendor Scripts with Error Handling -->
    <script src="{{ asset('vuexy-layout/dist/libs/perfect-scrollbar/perfect-scrollbar.js') }}"
            onerror="console.warn('Perfect Scrollbar failed to load')"></script>
    <script src="{{ asset('vuexy-layout/dist/libs/node-waves/node-waves.js') }}"
            onerror="console.warn('Node Waves failed to load')"></script>
    <script src="{{ asset('vuexy-layout/dist/libs/hammer/hammer.js') }}"
            onerror="console.warn('Hammer.js failed to load')"></script>
    <script src="{{ asset('vuexy-layout/dist/libs/i18n/i18n.js') }}"
            onerror="console.warn('i18n failed to load')"></script>

    <!-- Load typeahead after jQuery is ready -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for jQuery to be available before loading typeahead
            function loadTypeahead() {
                if (typeof $ !== 'undefined' && typeof jQuery !== 'undefined') {
                    const script = document.createElement('script');
                    script.src = "{{ asset('vuexy-layout/dist/libs/typeahead-js/typeahead.js') }}";
                    script.onerror = function() { console.warn('Typeahead failed to load'); };
                    script.onload = function() { console.log('✅ Typeahead loaded'); };
                    document.head.appendChild(script);
                } else {
                    // Retry after 100ms if jQuery not ready
                    setTimeout(loadTypeahead, 100);
                }
            }
            loadTypeahead();
        });
    </script>

    <script src="{{ asset('vuexy-layout/dist/js/menu.js') }}"
            onerror="console.warn('Menu script failed to load')"></script>

    <!-- Vendors JS (Non-jQuery dependent) -->
    <script src="{{ asset('vuexy-layout/dist/libs/apex-charts/apexcharts.js') }}"
            onerror="console.warn('ApexCharts failed to load')"></script>
    <script src="{{ asset('vuexy-layout/dist/libs/swiper/swiper.js') }}"
            onerror="console.warn('Swiper failed to load')"></script>

    <!-- jQuery-dependent scripts loaded conditionally -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load jQuery-dependent libraries only after jQuery is confirmed
            function loadJQueryDependents() {
                if (typeof $ !== 'undefined' && $.fn) {
                    console.log('🔧 Loading jQuery-dependent libraries...');

                    // Load DataTables
                    const dtScript = document.createElement('script');
                    dtScript.src = "{{ asset('vuexy-layout/dist/libs/datatables-bs5/datatables-bootstrap5.js') }}";
                    dtScript.onerror = function() { console.warn('DataTables failed to load'); };
                    dtScript.onload = function() { console.log('✅ DataTables loaded'); };
                    document.head.appendChild(dtScript);

                    // Load Select2
                    const s2Script = document.createElement('script');
                    s2Script.src = "{{ asset('vuexy-layout/dist/libs/select2/select2.js') }}";
                    s2Script.onerror = function() { console.warn('Select2 failed to load'); };
                    s2Script.onload = function() { console.log('✅ Select2 loaded'); };
                    document.head.appendChild(s2Script);

                    // Load Bootstrap Select
                    const bsScript = document.createElement('script');
                    bsScript.src = "{{ asset('vuexy-layout/dist/libs/bootstrap-select/bootstrap-select.js') }}";
                    bsScript.onerror = function() { console.warn('Bootstrap Select failed to load'); };
                    bsScript.onload = function() { console.log('✅ Bootstrap Select loaded'); };
                    document.head.appendChild(bsScript);

                } else {
                    console.warn('⚠️ jQuery not available, skipping jQuery-dependent libraries');
                }
            }

            // Wait for our jQuery fix to complete
            setTimeout(loadJQueryDependents, 500);

            // Also listen for jquery-ready event
            $(document).on('jquery-ready', loadJQueryDependents);
        });
    </script>

    <!-- Tagify JS (doesn't need jQuery) -->
    <script src="{{ asset('vuexy-layout/dist/libs/tagify/tagify.js') }}"
            onerror="console.warn('Tagify failed to load')"></script>

    <!-- SweetAlert2 JS -->
    <script src="{{ asset('vuexy-layout/dist/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        // Fallback for SweetAlert2 if local file fails to load
        if (typeof Swal === 'undefined') {
            // Create a mock Swal object to prevent errors
            window.Swal = {
                fire: function(options) {
                    if (typeof options === 'string') {
                        alert(options);
                    } else if (options && options.title) {
                        alert(options.title + (options.text ? '\n' + options.text : ''));
                    }
                    return Promise.resolve({ isConfirmed: true });
                },
                close: function() {},
                isVisible: function() { return false; }
            };
        }
    </script>

    <!-- Toastr JS -->
    <script src="{{ asset('vuexy-layout/dist/libs/toastr/toastr.js') }}"></script>
    <script>
        // Fallback for Toastr if local file fails to load
        if (typeof toastr === 'undefined') {
            // Create a mock toastr object to prevent errors
            window.toastr = {
                success: function(message) { console.log('SUCCESS:', message); },
                error: function(message) { console.log('ERROR:', message); },
                warning: function(message) { console.log('WARNING:', message); },
                info: function(message) { console.log('INFO:', message); }
            };
        }
    </script>

    <!-- Pusher JS with Fallback -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"
            onerror="console.warn('⚠️ Pusher failed to load from CDN')"></script>
    <script>
        // Pusher fallback check
        if (typeof Pusher === 'undefined') {
            console.warn('⚠️ Pusher not available - real-time notifications disabled');
            // Create mock Pusher to prevent errors
            window.Pusher = function() {
                return {
                    connection: { bind: function() {} },
                    subscribe: function() {
                        return { bind: function() {} };
                    },
                    disconnect: function() {}
                };
            };
        } else {
            console.log('✅ Pusher loaded successfully');
        }
    </script>

    <!-- Notification JS -->
    <script src="{{ asset('js/notifications.js') }}"
            onerror="console.warn('⚠️ Notifications script failed to load')"></script>


    {{-- <!-- Error Handling for JavaScript -->
    <script>
        // Polyfill for Element.closest() for older browsers
        if (!Element.prototype.closest) {
            Element.prototype.closest = function(s) {
                var el = this;
                do {
                    if (el.matches && el.matches(s)) return el;
                    el = el.parentElement || el.parentNode;
                } while (el !== null && el.nodeType === 1);
                return null;
            };
        }

        // Polyfill for Element.matches() for older browsers
        if (!Element.prototype.matches) {
            Element.prototype.matches = Element.prototype.matchesSelector ||
                                      Element.prototype.mozMatchesSelector ||
                                      Element.prototype.msMatchesSelector ||
                                      Element.prototype.oMatchesSelector ||
                                      Element.prototype.webkitMatchesSelector ||
                                      function(s) {
                                          var matches = (this.document || this.ownerDocument).querySelectorAll(s),
                                              i = matches.length;
                                          while (--i >= 0 && matches.item(i) !== this) {}
                                          return i > -1;
                                      };
        }

        // Global error handler to prevent page crashes
        window.addEventListener('error', function(e) {
            if (e.message && (
                e.message.includes('translations') ||
                e.message.includes('Identifier') ||
                e.message.includes('Uncaught SyntaxError') ||
                e.message.includes('unexpected token') ||
                e.message.includes('closest is not a function')
            )) {
                console.warn('JavaScript error handled:', e.message, e.filename, e.lineno);
                return true; // Prevent default error handling
            }
        });

        // Prevent duplicate script errors
        window.addEventListener('unhandledrejection', function(e) {
            console.warn('Promise rejection handled:', e.reason);
        });
    </script>

    <!-- Main Vuexy JS -->
    <script src="{{ asset('vuexy-layout/assets/js/main.js') }}" onerror="console.warn('Main.js failed to load, continuing...')"></script> --}}

    <!-- Custom JS -->
    <script src="{{ asset('js/global/main.js') }}" onerror="console.warn('Global main.js failed to load, continuing...')"></script>
    <script src="{{ asset('js/global/dark-mode.js') }}" onerror="console.warn('Dark mode.js failed to load, continuing...')"></script>
    <script src="{{ asset('js/global/post.js') }}" onerror="console.warn('Post.js failed to load, continuing...')"></script>

    <!-- Language and Messages JS -->
    <script src="{{ asset('js/global/messages.js') }}"></script>
    {{-- <script>
        Lang.setLocale("{{ app()->getLocale() }}")
    </script> --}}

    <!-- ================================ -->
    <!-- ENHANCED SIDEBAR SYSTEM JS -->
    <!-- ================================ -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // =========================
            // SIDEBAR SYSTEM VARIABLES
            // =========================
            const layoutMenu = document.getElementById('layout-menu');
            const menuContent = document.querySelector('.menu-inner');
            const menuToggle = document.querySelector('.layout-menu-toggle');
            const mobileMenuBtn = document.getElementById('mobile-menu-toggle');
            const layoutPage = document.querySelector('.layout-page');

            let isCollapsed = localStorage.getItem('sidebar-collapsed') === 'true';
            let isMobile = window.innerWidth < 1200;
            let perfectScrollbarInstance = null;

            // =========================
            // SIDEBAR INITIALIZATION
            // =========================
            function initializeSidebar() {
                if (!layoutMenu || !menuContent) return;
                const layoutContainer = document.querySelector('.layout-container');

                // Apply initial state
                if (isMobile) {
                    layoutMenu.classList.add('mobile-hidden');
                } else {
                    if (isCollapsed) {
                        layoutMenu.classList.add('collapsed');
                        if (layoutContainer) layoutContainer.classList.add('sidebar-collapsed');
                    }
                }

                // Create overlay for mobile
                createMobileOverlay();

                // Initialize scrolling
                initializeScrolling();

                // Initialize toggle functionality
                initializeToggle();

                // Initialize menu interactions
                initializeMenuInteractions();

            }

            // =========================
            // SCROLLING SYSTEM - DIRECT APPROACH
            // =========================
            function initializeScrolling() {
                if (!menuContent) return;

                // Force proper scrolling properties
                menuContent.style.overflowY = 'scroll';
                menuContent.style.overflowX = 'hidden';
                menuContent.style.height = '100%';
                menuContent.style.maxHeight = 'calc(100vh - 120px)';

                // DIRECT mouse wheel implementation - No Perfect Scrollbar interference
                const directWheelHandler = function(event) {
                    // Stop all event propagation
                    event.preventDefault();
                    event.stopPropagation();
                    event.stopImmediatePropagation();

                    // Get wheel delta - cross browser support
                    let delta = 0;
                    if (event.wheelDelta) {
                        delta = -event.wheelDelta / 120;
                    } else if (event.detail) {
                        delta = event.detail / 3;
                    } else if (event.deltaY) {
                        delta = event.deltaY / 100;
                    }

                    // Apply scroll directly
                    const scrollAmount = delta * 60; // 60px per wheel step
                    menuContent.scrollTop += scrollAmount;

                    return false;
                };

                // Remove any existing listeners to prevent conflicts
                const events = ['wheel', 'mousewheel', 'DOMMouseScroll'];
                events.forEach(event => {
                    menuContent.removeEventListener(event, directWheelHandler, true);
                    menuContent.removeEventListener(event, directWheelHandler, false);
                });

                // Add our direct wheel handlers with highest priority
                events.forEach(event => {
                    menuContent.addEventListener(event, directWheelHandler, {
                        passive: false,
                        capture: true
                    });
                });

                // Keyboard scrolling
                menuContent.addEventListener('keydown', function(e) {
                    switch(e.key) {
                        case 'ArrowUp':
                            e.preventDefault();
                            menuContent.scrollTop -= 40;
                            break;
                        case 'ArrowDown':
                            e.preventDefault();
                            menuContent.scrollTop += 40;
                            break;
                        case 'PageUp':
                            e.preventDefault();
                            menuContent.scrollTop -= menuContent.clientHeight;
                            break;
                        case 'PageDown':
                            e.preventDefault();
                            menuContent.scrollTop += menuContent.clientHeight;
                            break;
                    }
                });

                // Make sure element can receive focus for keyboard events
                menuContent.setAttribute('tabindex', '-1');
                menuContent.style.outline = 'none';

                // Disable Perfect Scrollbar completely to prevent conflicts
                if (window.PerfectScrollbar) {
                }

                // Touch scrolling for mobile
                initializeTouchScrolling();
            }

            // =========================
            // TOUCH SCROLLING
            // =========================
            function initializeTouchScrolling() {
                if (!menuContent) return;

                let startY = 0;
                let isScrolling = false;

                menuContent.addEventListener('touchstart', function(e) {
                    startY = e.touches[0].clientY;
                    isScrolling = true;
                }, { passive: true });

                menuContent.addEventListener('touchmove', function(e) {
                    if (!isScrolling) return;

                    const currentY = e.touches[0].clientY;
                    const deltaY = startY - currentY;

                    menuContent.scrollTop += deltaY;
                    startY = currentY;
                }, { passive: true });

                menuContent.addEventListener('touchend', function() {
                    isScrolling = false;
                }, { passive: true });
            }

            // =========================
            // TOGGLE FUNCTIONALITY
            // =========================
            function initializeToggle() {
                // Desktop toggle button with error handling
                if (menuToggle) {
                    // Remove any existing listeners first
                    menuToggle.replaceWith(menuToggle.cloneNode(true));
                    const freshMenuToggle = document.querySelector('.layout-menu-toggle');

                    freshMenuToggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        try {
                            if (isMobile) {
                                toggleMobileSidebar();
                            } else {
                                toggleDesktopSidebar();
                            }
                        } catch (error) {
                            console.error('Toggle error:', error);
                        }
                    });

                }

                // Mobile toggle button with error handling
                if (mobileMenuBtn) {
                    mobileMenuBtn.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        try {
                            toggleMobileSidebar();
                        } catch (error) {
                        }
                    });
                }

                // Keyboard shortcut (Ctrl + B)
                document.addEventListener('keydown', function(e) {
                    if (e.ctrlKey && e.key === 'b') {
                        e.preventDefault();
                        if (isMobile) {
                            toggleMobileSidebar();
                        } else {
                            toggleDesktopSidebar();
                        }
                    }
                });
            }

            function toggleDesktopSidebar() {
                try {
                    isCollapsed = !isCollapsed;
                    const layoutContainer = document.querySelector('.layout-container');
                    // Apply/remove collapsed class safely
                    if (isCollapsed) {
                        layoutMenu.classList.add('collapsed');
                        if (layoutContainer) layoutContainer.classList.add('sidebar-collapsed');
                    } else {
                        layoutMenu.classList.remove('collapsed');
                        if (layoutContainer) layoutContainer.classList.remove('sidebar-collapsed');
                    }

                    // Store state
                    localStorage.setItem('sidebar-collapsed', isCollapsed.toString());

                    // Force reflow to ensure changes take effect
                    layoutMenu.offsetHeight;

                    // Re-initialize everything after toggle to prevent issues
                    setTimeout(() => {
                        // Ensure scrolling still works after toggle
                        const menuEl = document.querySelector('.menu-content');
                        if (menuEl) {
                            // Force stable scrolling properties
                            menuEl.style.overflowY = 'scroll';
                            menuEl.style.overflowX = 'hidden';

                            // Re-apply anti-vibration properties
                            menuEl.style.transform = 'none';
                            menuEl.style.willChange = 'none';
                            menuEl.style.transition = 'none';

                            // Ensure element can receive events
                            menuEl.focus();

                            // Re-apply stable positioning to all child elements
                            const allMenuElements = menuEl.querySelectorAll('*');
                            allMenuElements.forEach(el => {
                                el.style.transform = 'none';
                                el.style.willChange = 'none';
                                el.style.transition = 'background-color 0s, color 0s';
                            });

                        }

                        // Update Perfect Scrollbar if it exists
                        if (perfectScrollbarInstance) {
                            perfectScrollbarInstance.update();
                        }
                    }, 350); // Wait for CSS transition to complete

                } catch (error) {
                    // Reset state on error
                    isCollapsed = !isCollapsed;
                }
            }

            function toggleMobileSidebar() {
                const isHidden = layoutMenu.classList.contains('mobile-hidden');
                const overlay = document.querySelector('.sidebar-overlay');

                if (isHidden) {
                    // Show sidebar
                    layoutMenu.classList.remove('mobile-hidden');
                    layoutMenu.classList.add('show');
                    if (overlay) overlay.classList.add('show');
                    document.body.style.overflow = 'hidden';
                } else {
                    // Hide sidebar
                    layoutMenu.classList.add('mobile-hidden');
                    layoutMenu.classList.remove('show');
                    if (overlay) overlay.classList.remove('show');
                    document.body.style.overflow = '';
                }
            }

            // =========================
            // MOBILE OVERLAY
            // =========================
            function createMobileOverlay() {
                // Remove existing overlay
                const existingOverlay = document.querySelector('.sidebar-overlay');
                if (existingOverlay) {
                    existingOverlay.remove();
                }

                // Create new overlay
                const overlay = document.createElement('div');
                overlay.className = 'sidebar-overlay';
                document.body.appendChild(overlay);

                // Click to close
                overlay.addEventListener('click', function() {
                    toggleMobileSidebar();
                });
            }

            // =========================
            // MENU INTERACTIONS
            // =========================
            function initializeMenuInteractions() {
                const menuItems = document.querySelectorAll('.menu-item .menu-link');

                menuItems.forEach(function(menuItem, index) {
                    // Add stagger animation delay
                    menuItem.parentElement.style.animationDelay = (index * 0.05) + 's';

                    // Enhanced click effects
                    menuItem.addEventListener('click', function(e) {
                        // Add click ripple effect
                        createRippleEffect(e, this);

                        // Auto-close mobile sidebar on navigation
                        if (isMobile && !layoutMenu.classList.contains('mobile-hidden')) {
                            setTimeout(() => toggleMobileSidebar(), 150);
                        }
                    });
                });
            }

            // =========================
            // RIPPLE EFFECT
            // =========================
            function createRippleEffect(event, element) {
                const ripple = document.createElement('span');
                const rect = element.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = event.clientX - rect.left - size / 2;
                const y = event.clientY - rect.top - size / 2;

                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.animation = 'ripple 0.6s ease-out';
                ripple.style.pointerEvents = 'none';

                element.style.position = 'relative';
                element.style.overflow = 'hidden';
                element.appendChild(ripple);

                setTimeout(() => {
                    if (ripple.parentNode) {
                        ripple.remove();
                    }
                }, 600);
            }

            // =========================
            // RESPONSIVE HANDLING
            // =========================
            function handleResize() {
                const newIsMobile = window.innerWidth < 1200;

                if (newIsMobile !== isMobile) {
                    isMobile = newIsMobile;

                    if (isMobile) {
                        // Switch to mobile mode
                        layoutMenu.classList.remove('collapsed');
                        layoutMenu.classList.add('mobile-hidden');
                        document.body.style.overflow = '';
                    } else {
                        // Switch to desktop mode
                        layoutMenu.classList.remove('mobile-hidden', 'show');
                        if (isCollapsed) {
                            layoutMenu.classList.add('collapsed');
                        }
                        const overlay = document.querySelector('.sidebar-overlay');
                        if (overlay) overlay.classList.remove('show');
                        document.body.style.overflow = '';
                    }

                    // Update Perfect Scrollbar
                    setTimeout(() => {
                        if (perfectScrollbarInstance) {
                            perfectScrollbarInstance.update();
                        }
                    }, 300);
                }
            }

            // =========================
            // EVENT LISTENERS
            // =========================
            window.addEventListener('resize', handleResize);
            window.addEventListener('orientationchange', function() {
                setTimeout(handleResize, 100);
            });

            // =========================
            // STABILITY ENFORCEMENT
            // =========================
            function enforceStability() {
                const menuEl = document.querySelector('.menu-content');
                const sidebarEl = document.getElementById('layout-menu');

                if (menuEl && sidebarEl) {
                    // Force stable properties on all elements
                    const allElements = sidebarEl.querySelectorAll('*');
                    allElements.forEach(el => {
                        if (el.style) {
                            el.style.transform = 'none';
                            el.style.willChange = 'auto';
                            if (!el.closest('.menu-content::-webkit-scrollbar')) {
                                el.style.transition = 'background-color 0s, color 0s, opacity 0s';
                            }
                        }
                    });

                    // Ensure scrolling properties remain stable
                    menuEl.style.overflowY = 'scroll';
                    menuEl.style.overflowX = 'hidden';
                    menuEl.style.transform = 'none';
                }
            }

            // Add periodic stability enforcement
            setInterval(enforceStability, 5000);

            // Add event listeners to enforce stability on interaction
            // Simpler approach: just enforce stability on sidebar element directly
            const sidebarElement = document.getElementById('layout-menu');
            if (sidebarElement) {
                sidebarElement.addEventListener('mouseenter', function() {
                    enforceStability();
                });

                sidebarElement.addEventListener('mouseleave', function() {
                    enforceStability();
                });
            }

            // =========================
            // INITIALIZE SYSTEM
            // =========================
            initializeSidebar();

            // =========================
            // SIMPLE FALLBACK TOGGLE
            // =========================
            // Add a simple fallback toggle that will always work
            document.addEventListener('click', function(e) {
                if (e.target.closest('.layout-menu-toggle')) {
                    e.preventDefault();
                    e.stopPropagation();

                    const menu = document.getElementById('layout-menu');
                    const container = document.querySelector('.layout-container');

                    if (menu.classList.contains('collapsed')) {
                        menu.classList.remove('collapsed');
                        if (container) container.classList.remove('sidebar-collapsed');
                        localStorage.setItem('sidebar-collapsed', 'false');
                    } else {
                        menu.classList.add('collapsed');
                        if (container) container.classList.add('sidebar-collapsed');
                        localStorage.setItem('sidebar-collapsed', 'true');
                    }
                }
            });

            // Add ripple animation CSS if not exists
            if (!document.querySelector('#ripple-animation')) {
                const style = document.createElement('style');
                style.id = 'ripple-animation';
                style.textContent = `
                    @keyframes ripple {
                        0% {
                            transform: scale(0);
                            opacity: 1;
                        }
                        100% {
                            transform: scale(2);
                            opacity: 0;
                        }
                    }
                `;
                document.head.appendChild(style);
            }

            // ERROR PREVENTION: Catch any JavaScript errors that might interfere
            window.addEventListener('error', function(e) {
                if (e.message && (e.message.includes('translations') || e.message.includes('Identifier'))) {
                    e.preventDefault();
                    return true;
                }
            });

            // SCROLL FIX: Final fallback to ensure scrolling works
            setTimeout(() => {
                const menuEl = document.querySelector('.menu-content');
                if (menuEl && menuEl.scrollHeight > menuEl.clientHeight) {
                    // Force stable scrolling properties
                    menuEl.style.overflowY = 'scroll';
                    menuEl.style.overflowX = 'hidden';
                    menuEl.style.scrollBehavior = 'auto'; // Remove smooth to prevent issues

                    // Force focus on the element to capture wheel events
                    menuEl.focus();

                    // Final wheel event handler as ultimate backup
                    const finalWheelHandler = function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        e.stopImmediatePropagation();

                        const delta = e.deltaY || e.detail * 3 || -e.wheelDelta / 120;
                        menuEl.scrollTop += delta * 50;

                        return false;
                    };

                    // Add final handler with highest priority
                    menuEl.addEventListener('wheel', finalWheelHandler, {
                        passive: false,
                        capture: true
                    });

                }
            }, 3000);
        });
    </script>

    @stack('script')

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif

    @stack('script_2')
</body>

</html>
