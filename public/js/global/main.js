/**
 * Custom Main JS for Salamtak
 */

'use strict';

// Fix Popper.js margin style error
if (typeof window.Popper !== 'undefined') {
    // Override default Popper.js behavior to prevent margin style errors
    const originalCreatePopper = window.Popper.createPopper;
    window.Popper.createPopper = function(reference, popper, options) {
        // Ensure proper offset configuration
        if (!options.modifiers) {
            options.modifiers = [];
        }

        // Add or update offset modifier
        const offsetModifier = options.modifiers.find(m => m.name === 'offset');
        if (offsetModifier) {
            // Update existing offset modifier
            offsetModifier.options = {
                ...offsetModifier.options,
                offset: offsetModifier.options.offset || [0, 0]
            };
        } else {
            // Add new offset modifier
            options.modifiers.push({
                name: 'offset',
                options: {
                    offset: [0, 0]
                }
            });
        }

        // Add or update preventOverflow modifier with padding
        const preventOverflowModifier = options.modifiers.find(m => m.name === 'preventOverflow');
        if (preventOverflowModifier) {
            preventOverflowModifier.options = {
                ...preventOverflowModifier.options,
                padding: preventOverflowModifier.options.padding || 0
            };
        } else {
            options.modifiers.push({
                name: 'preventOverflow',
                options: {
                    padding: 0
                }
            });
        }

        // Add or update flip modifier with padding
        const flipModifier = options.modifiers.find(m => m.name === 'flip');
        if (flipModifier) {
            flipModifier.options = {
                ...flipModifier.options,
                padding: flipModifier.options.padding || 0
            };
        } else {
            options.modifiers.push({
                name: 'flip',
                options: {
                    padding: 0
                }
            });
        }

        return originalCreatePopper(reference, popper, options);
    };
}

// Configure Bootstrap to use proper Popper.js settings
if (typeof bootstrap !== 'undefined') {
    // Override Bootstrap's default popper config
    const originalGetPopperConfig = bootstrap.Tooltip.prototype._getPopperConfig;
    if (originalGetPopperConfig) {
        bootstrap.Tooltip.prototype._getPopperConfig = function(placement) {
            const config = originalGetPopperConfig.call(this, placement);
            return {
                ...config,
                modifiers: [
                    ...config.modifiers,
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 8]
                        }
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 8
                        }
                    },
                    {
                        name: 'flip',
                        options: {
                            padding: 8
                        }
                    }
                ]
            };
        };
    }

    // Override Bootstrap Dropdown's popper config
    const originalDropdownGetPopperConfig = bootstrap.Dropdown.prototype._getPopperConfig;
    if (originalDropdownGetPopperConfig) {
        bootstrap.Dropdown.prototype._getPopperConfig = function() {
            const config = originalDropdownGetPopperConfig.call(this);
            return {
                ...config,
                modifiers: [
                    ...config.modifiers,
                    {
                        name: 'offset',
                        options: {
                            offset: [0, 2]
                        }
                    },
                    {
                        name: 'preventOverflow',
                        options: {
                            padding: 8
                        }
                    },
                    {
                        name: 'flip',
                        options: {
                            padding: 8
                        }
                    }
                ]
            };
        };
    }
}

// Salamtak Admin Panel - Custom Main JS
$(document).ready(function() {
    console.log('Salamtak Admin Panel initialized');

    // Initialize sidebar dropdown functionality
    initializeSidebarDropdowns();

    // Initialize tooltips
    initializeTooltips();

    // Initialize perfect scrollbar for sidebar
    initializePerfectScrollbar();

    // Initialize mobile menu toggle
    initializeMobileMenu();

    // Initialize Select2
    setSelect2();
});

// Sidebar Dropdown Functionality
function initializeSidebarDropdowns() {
    // Handle menu toggle clicks
    $('.menu-toggle').on('click', function(e) {
        e.preventDefault();

        const $menuItem = $(this).closest('.menu-item');
        const $menuSub = $menuItem.find('.menu-sub');

        // Close other open menus
        $('.menu-item').not($menuItem).removeClass('open');
        $('.menu-sub').not($menuSub).slideUp(300);

        // Toggle current menu
        $menuItem.toggleClass('open');
        $menuSub.slideToggle(300);
    });

    // Handle menu link clicks (for non-toggle items)
    $('.menu-link:not(.menu-toggle)').on('click', function() {
        // Remove active class from all menu items
        $('.menu-item').removeClass('active');

        // Add active class to current menu item and its parent
        const $menuItem = $(this).closest('.menu-item');
        $menuItem.addClass('active');
        $menuItem.parents('.menu-item').addClass('active');
    });
}

// Initialize Tooltips
function initializeTooltips() {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            popperConfig: function (defaultBsPopperConfig) {
                return {
                    ...defaultBsPopperConfig,
                    modifiers: [
                        ...defaultBsPopperConfig.modifiers,
                        {
                            name: 'offset',
                            options: {
                                offset: [0, 8]
                            }
                        },
                        {
                            name: 'preventOverflow',
                            options: {
                                padding: 8
                            }
                        },
                        {
                            name: 'flip',
                            options: {
                                padding: 8
                            }
                        }
                    ]
                };
            }
        });
    });
}

// Initialize Perfect Scrollbar for Sidebar
function initializePerfectScrollbar() {
    const sidebar = document.querySelector('.layout-menu');
    if (sidebar) {
        new PerfectScrollbar(sidebar, {
            wheelPropagation: false
        });
    }
}

// Initialize Mobile Menu Toggle
function initializeMobileMenu() {
    $('.layout-menu-toggle').on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('layout-menu-expanded');
    });

    // Close menu when clicking outside on mobile
    $(document).on('click', function(e) {
        if ($(window).width() < 1200) {
            if (!$(e.target).closest('.layout-menu, .layout-menu-toggle').length) {
                $('body').removeClass('layout-menu-expanded');
            }
        }
    });
}

// Initialize Select2 for forms
function setSelect2() {
    if (typeof $.fn.select2 !== 'undefined') {
        // Initialize Select2 for elements with .select2 class (Vuexy approach)
        $('.select2').each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: $this.data('placeholder') || 'Select value',
                dropdownParent: $this.parent(),
                theme: 'bootstrap-5',
                width: '100%'
            });
        });

        // Initialize Select2 for form-select elements with multiple attribute
        $('.form-select[multiple]').each(function () {
            var $this = $(this);
            $this.wrap('<div class="position-relative"></div>').select2({
                placeholder: $this.data('placeholder') || 'Select options',
                dropdownParent: $this.parent(),
                theme: 'bootstrap-5',
                width: '100%',
                allowClear: true
            });
        });

        console.log('Select2 initialized successfully using Vuexy approach');
    } else {
        console.error('Select2 is not loaded!');
    }
}

// Initialize DataTables if present
function initializeDataTables() {
    if (typeof $.fn.DataTable !== 'undefined') {
        $('.datatable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/en-GB.json'
            }
        });
    }
}

// Initialize ApexCharts if present
function initializeCharts() {
    if (typeof ApexCharts !== 'undefined') {
        console.log('ApexCharts available for chart initialization');
    }
}

// Export functions for global use
window.SalamtakAdmin = {
    initializeSidebarDropdowns,
    initializeTooltips,
    initializePerfectScrollbar,
    initializeMobileMenu,
    initializeDataTables,
    initializeCharts
};


function langName(name)
{
    let lang = Lang.getLocale()
    return name+'_'+lang;
}
