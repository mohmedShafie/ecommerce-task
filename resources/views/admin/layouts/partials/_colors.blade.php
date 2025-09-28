@php($agency_color = '#32968e')

<style>
    :root {
        --bs-primary: {{ $agency_color }} !important;
        --bs-primary-rgb: 50, 150, 142 !important;
    }

    /* Sidebar Menu Styles */
    .menu-item.open>.menu-link {
        background-color: rgba(115, 103, 240, 0.2) !important;
    }

    .menu-item.open>.menu-link .menu-icon {
        color: var(--bs-primary) !important;
    }

    .menu-sub {
        display: none;
        background-color: rgba(0, 0, 0, 0.05) !important;
    }

    .dark-style .menu-sub {
        background-color: rgba(255, 255, 255, 0.04) !important;
    }

    .menu-item.active>.menu-link {
        background-color: var(--bs-primary) !important;
        color: #fff !important;
    }

    /* bs-card-bg add this to dark mode color  and make this white color in the dark mode  bs-body-color   and this bs-heading-color */

    .menu-item.active>.menu-link .menu-icon {
        color: #fff !important;
    }

    .menu-item.active>.menu-link .menu-text {
        color: #fff !important;
    }

    /* ENHANCED SIDEBAR SCROLLING - MOUSE WHEEL PRIORITY */
    .layout-menu {
        height: 100vh !important;
        overflow: hidden !important;
        position: fixed !important;
        z-index: 1050 !important;
    }

    .menu-inner {
        height: calc(100vh - 80px) !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 0, 0, 0.4) transparent;
        /* Force scroll containment */
        overscroll-behavior: contain !important;
        scroll-behavior: smooth !important;
    }

    /* Enhanced scrollbar styling with better visibility */
    .menu-inner::-webkit-scrollbar {
        width: 8px !important;
    }

    .menu-inner::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.05) !important;
        border-radius: 4px !important;
    }

    .menu-inner::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.4) !important;
        border-radius: 4px !important;
        transition: background-color 0.3s ease !important;
    }

    .menu-inner::-webkit-scrollbar-thumb:hover {
        background-color: rgba(0, 0, 0, 0.7) !important;
    }

    /* Dark mode scrollbar enhancement */
    .dark-style .menu-inner::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.05) !important;
    }

    .dark-style .menu-inner::-webkit-scrollbar-thumb {
        background-color: rgba(255, 255, 255, 0.4) !important;
    }

    .dark-style .menu-inner::-webkit-scrollbar-thumb:hover {
        background-color: rgba(255, 255, 255, 0.7) !important;
    }

    /* Mobile Menu Styles */
    @media (max-width: 1199.98px) {
        .layout-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }

        body.layout-menu-expanded .layout-menu {
            transform: translateX(0);
        }

        .layout-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1040;
        }

        body.layout-menu-expanded .layout-overlay {
            display: block;
        }
    }

    /* Comprehensive Dark Mode Variables - ENHANCED COLORS */
    .dark-style {
        --bs-body-bg: #1a1b2e !important;
        --bs-body-color: #ffffff !important;
        --bs-border-color: #3a3b5e !important;
        --bs-card-bg: #252640 !important;
        --bs-navbar-bg: #252640 !important;
        --bs-menu-bg: #252640 !important;
        --bs-footer-bg: #252640 !important;
        --bs-text-muted: #b8b9d8 !important;
        --bs-heading-color: #e8e9ff !important;
        --bs-link-color: #8b7cf6 !important;
        --bs-link-hover-color: #a78bfa !important;
        --bs-badge-bg: #3a3b5e !important;
        --bs-badge-color: #b8b9d8 !important;
        --bs-progress-bg: #3a3b5e !important;
        --bs-table-bg: #252640 !important;
        --bs-table-color: #b8b9d8 !important;
        --bs-table-border-color: #3a3b5e !important;
        --bs-dropdown-bg: #252640 !important;
        --bs-dropdown-color: #b8b9d8 !important;
        --bs-dropdown-border-color: #3a3b5e !important;
        --bs-input-bg: #3a3b5e !important;
        --bs-input-border-color: #3a3b5e !important;
        --bs-input-color: #b8b9d8 !important;
        --bs-chart-bg: #252640 !important;
        --bs-chart-text: #b8b9d8 !important;
        --bs-chart-grid: #3a3b5e !important;
        --bs-modal-bg: #252640 !important;
        --bs-modal-border-color: #3a3b5e !important;
        --bs-tooltip-bg: #252640 !important;
        --bs-popover-bg: #252640 !important;
        --bs-list-group-bg: #252640 !important;
        --bs-list-group-border-color: #3a3b5e !important;
        --bs-pagination-bg: #252640 !important;
        --bs-pagination-border-color: #3a3b5e !important;
        --bs-alert-bg: #252640 !important;
        --bs-alert-border-color: #3a3b5e !important;
        --bs-card-label-primary-bg: rgba(139, 124, 246, 0.2) !important;
        --bs-card-label-success-bg: rgba(34, 197, 94, 0.2) !important;
        --bs-card-label-danger-bg: rgba(239, 68, 68, 0.2) !important;
        --bs-card-label-warning-bg: rgba(245, 158, 11, 0.2) !important;
        --bs-card-label-info-bg: rgba(6, 182, 212, 0.2) !important;
        --bs-card-label-secondary-bg: rgba(107, 114, 128, 0.2) !important;
        --bs-card-label-dark-bg: rgba(55, 65, 81, 0.2) !important;
        --bs-card-light-bg: #3a3b5e !important;
        --bs-card-primary-bg: #8b7cf6 !important;
        --bs-card-success-bg: #22c55e !important;
        --bs-card-danger-bg: #ef4444 !important;
        --bs-card-warning-bg: #f59e0b !important;
        --bs-card-info-bg: #06b6d4 !important;
    }

    /* Light Mode Variables - ENHANCED COLORS */
    .light-style {
        --bs-body-bg: #f8fafc !important;
        --bs-body-color: #1a202c !important;
        --bs-border-color: #cbd5e1 !important;
        --bs-card-bg: #ffffff !important;
        --bs-navbar-bg: #ffffff !important;
        --bs-menu-bg: #ffffff !important;
        --bs-footer-bg: #ffffff !important;
        --bs-text-muted: #4a5568 !important;
        --bs-heading-color: #0f1419 !important;
        --bs-link-color: #8b7cf6 !important;
        --bs-link-hover-color: #7c3aed !important;
        --bs-input-bg: #ffffff !important;
        --bs-input-border-color: #cbd5e1 !important;
        --bs-input-color: #1a202c !important;
        --bs-chart-bg: #ffffff !important;
        --bs-chart-text: #1a202c !important;
        --bs-chart-grid: #cbd5e1 !important;
        --bs-modal-bg: #ffffff !important;
        --bs-modal-border-color: #cbd5e1 !important;
        --bs-tooltip-bg: #ffffff !important;
        --bs-popover-bg: #ffffff !important;
        --bs-list-group-bg: #ffffff !important;
        --bs-list-group-border-color: #cbd5e1 !important;
        --bs-pagination-bg: #ffffff !important;
        --bs-pagination-border-color: #cbd5e1 !important;
        --bs-alert-bg: #ffffff !important;
        --bs-alert-border-color: #cbd5e1 !important;
        --bs-card-label-primary-bg: rgba(139, 124, 246, 0.15) !important;
        --bs-card-label-success-bg: rgba(34, 197, 94, 0.15) !important;
        --bs-card-label-danger-bg: rgba(239, 68, 68, 0.15) !important;
        --bs-card-label-warning-bg: rgba(245, 158, 11, 0.15) !important;
        --bs-card-label-info-bg: rgba(6, 182, 212, 0.15) !important;
        --bs-card-label-secondary-bg: rgba(107, 114, 128, 0.15) !important;
        --bs-card-label-dark-bg: rgba(55, 65, 81, 0.15) !important;
        --bs-card-light-bg: #f1f5f9 !important;
        --bs-card-primary-bg: #8b7cf6 !important;
        --bs-card-success-bg: #22c55e !important;
        --bs-card-danger-bg: #ef4444 !important;
        --bs-card-warning-bg: #f59e0b !important;
        --bs-card-info-bg: #06b6d4 !important;
    }

    /* Light Mode - Enhanced Font Weight and Boldness */
    .light-style body {
        font-weight: 500 !important;
    }

    .light-style h1,
    .light-style h2,
    .light-style h3,
    .light-style h4,
    .light-style h5,
    .light-style h6 {
        font-weight: 700 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style p {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    .light-style span {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    .light-style div {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    .light-style strong {
        font-weight: 700 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style b {
        font-weight: 700 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .fw-semibold {
        font-weight: 600 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .mb-0 {
        font-weight: 500 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .text-muted {
        font-weight: 500 !important;
        color: var(--bs-text-muted) !important;
    }

    .light-style .card {
        font-weight: 500 !important;
    }

    .light-style .card h1,
    .light-style .card h2,
    .light-style .card h3,
    .light-style .card h4,
    .light-style .card h5,
    .light-style .card h6 {
        font-weight: 700 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .card p,
    .light-style .card span,
    .light-style .card div {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    .light-style .card strong,
    .light-style .card b {
        font-weight: 700 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .card .fw-semibold {
        font-weight: 600 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .card .mb-0 {
        font-weight: 500 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .card .text-muted {
        font-weight: 500 !important;
        color: var(--bs-text-muted) !important;
    }

    /* Light Mode - Tables */
    .light-style .table {
        font-weight: 500 !important;
    }

    .light-style .table th {
        font-weight: 700 !important;
        color: var(--bs-heading-color) !important;
    }

    .light-style .table td {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    /* Light Mode - Forms */
    .light-style .form-control {
        font-weight: 500 !important;
        color: var(--bs-input-color) !important;
    }

    .light-style .form-label {
        font-weight: 600 !important;
        color: var(--bs-heading-color) !important;
    }

    /* Light Mode - Buttons */
    .light-style .btn {
        font-weight: 600 !important;
    }

    /* Light Mode - Navigation */
    .light-style .navbar-nav .nav-link {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    .light-style .menu-link {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    .light-style .menu-text {
        font-weight: 500 !important;
        color: var(--bs-body-color) !important;
    }

    /* Dark Mode - Body and Layout */
    .dark-style body {
        background-color: var(--bs-body-bg) !important;
        color: var(--bs-body-color) !important;
    }

    .dark-style .layout-wrapper {
        background-color: var(--bs-body-bg) !important;
    }

    .dark-style .content-wrapper {
        background-color: var(--bs-body-bg) !important;
    }

    .dark-style .container-fluid {
        background-color: var(--bs-body-bg) !important;
    }

    .dark-style .layout-page {
        background-color: var(--bs-body-bg) !important;
    }

    /* Dark Mode - Cards - ENHANCED */
    .dark-style .card {
        background-color: var(--bs-card-bg) !important;
        border-color: var(--bs-border-color) !important;
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card-header {
        background-color: var(--bs-card-bg) !important;
        border-bottom-color: var(--bs-border-color) !important;
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card-title {
        color: #e8e9ff !important;
    }

    .dark-style .card-body {
        background-color: var(--bs-card-bg) !important;
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card-footer {
        background-color: var(--bs-card-bg) !important;
        border-top-color: var(--bs-border-color) !important;
        --bs-card-bg: #252640 !important;
    }

    /* Dark Mode - All Text Elements in Cards */
    .dark-style .card h1,
    .dark-style .card h2,
    .dark-style .card h3,
    .dark-style .card h4,
    .dark-style .card h5,
    .dark-style .card h6 {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card p {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card span {
        color: #e8e9ff !important;
    }

    .dark-style .card div {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card small {
        color: #b8b9d8 !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card strong {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card b {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card em {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .card i {
        color: #e8e9ff !important;
        --bs-card-bg: #252640 !important;
    }

    /* Dark Mode - Specific Card Content Classes */
    .dark-style .content-left h1,
    .dark-style .content-left h2,
    .dark-style .content-left h3,
    .dark-style .content-left h4,
    .dark-style .content-left h5,
    .dark-style .content-left h6 {
        color: var(--bs-heading-color) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left p {
        color: var(--bs-body-color) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left span {
        color: var(--bs-body-color) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left div {
        color: var(--bs-body-color) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left small {
        color: var(--bs-text-muted) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .fw-semibold {
        color: var(--bs-heading-color) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .mb-0 {
        color: var(--bs-heading-color) !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .text-success {
        color: #22c55e !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .text-danger {
        color: #ef4444 !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .text-warning {
        color: #f59e0b !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .text-info {
        color: #06b6d4 !important;
        --bs-card-bg: #252640 !important;
    }

    .dark-style .content-left .text-muted {
        color: var(--bs-text-muted) !important;
    }

    /* Dark Mode - Flex Containers in Cards */
    .dark-style .d-flex h1,
    .dark-style .d-flex h2,
    .dark-style .d-flex h3,
    .dark-style .d-flex h4,
    .dark-style .d-flex h5,
    .dark-style .d-flex h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .d-flex p {
        color: var(--bs-body-color) !important;
    }

    .dark-style .d-flex span {
        color: var(--bs-body-color) !important;
    }

    .dark-style .d-flex div {
        color: var(--bs-body-color) !important;
    }

    .dark-style .d-flex small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .d-flex .fw-semibold {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .d-flex .mb-0 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .d-flex .text-success {
        color: #22c55e !important;
    }

    .dark-style .d-flex .text-danger {
        color: #ef4444 !important;
    }

    .dark-style .d-flex .text-warning {
        color: #f59e0b !important;
    }

    .dark-style .d-flex .text-info {
        color: #06b6d4 !important;
    }

    .dark-style .d-flex .text-muted {
        color: var(--bs-text-muted) !important;
    }

    /* Dark Mode - Tables */
    .dark-style .table {
        color: var(--bs-table-color) !important;
        background-color: var(--bs-table-bg) !important;
    }

    .dark-style .table th {
        color: var(--bs-heading-color) !important;
        border-bottom-color: var(--bs-table-border-color) !important;
        background-color: var(--bs-table-bg) !important;
    }

    .dark-style .table td {
        border-bottom-color: var(--bs-table-border-color) !important;
        background-color: var(--bs-table-bg) !important;
    }

    .dark-style .table-borderless td {
        border-color: transparent !important;
    }

    .dark-style .table-borderless th {
        border-color: transparent !important;
    }

    .dark-style .table-striped>tbody>tr:nth-of-type(odd)>td {
        background-color: rgba(58, 59, 94, 0.4) !important;
    }

    .dark-style .table-hover>tbody>tr:hover>td {
        background-color: rgba(139, 124, 246, 0.15) !important;
    }

    /* Dark Mode - Navbar */
    .dark-style .navbar {
        background-color: var(--bs-navbar-bg) !important;
        border-bottom-color: var(--bs-border-color) !important;
    }

    .dark-style .navbar-nav .nav-link {
        color: var(--bs-body-color) !important;
    }

    .dark-style .navbar-nav .nav-link:hover {
        color: var(--bs-link-hover-color) !important;
    }

    /* Dark Mode - Sidebar */
    .dark-style .layout-menu {
        background-color: var(--bs-menu-bg) !important;
        border-right-color: var(--bs-border-color) !important;
    }

    .dark-style .menu-link {
        color: var(--bs-body-color) !important;
    }

    .dark-style .menu-link:hover {
        background-color: rgba(139, 124, 246, 0.15) !important;
        color: var(--bs-link-color) !important;
    }

    .dark-style .menu-text {
        color: var(--bs-body-color) !important;
    }

    .dark-style .menu-icon {
        color: var(--bs-body-color) !important;
    }

    /* Dark Mode - Footer */
    .dark-style .footer {
        background-color: var(--bs-footer-bg) !important;
        border-top-color: var(--bs-border-color) !important;
        color: var(--bs-body-color) !important;
    }

    /* Dark Mode - Forms */
    .dark-style .form-control {
        background-color: var(--bs-input-bg) !important;
        border-color: var(--bs-input-border-color) !important;
        color: var(--bs-input-color) !important;
    }

    .dark-style .form-control:focus {
        background-color: var(--bs-input-bg) !important;
        border-color: var(--bs-primary) !important;
        color: var(--bs-input-color) !important;
        box-shadow: 0 0 0 0.2rem rgba(139, 124, 246, 0.3) !important;
    }

    .dark-style .form-label {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .form-select {
        background-color: var(--bs-input-bg) !important;
        border-color: var(--bs-input-border-color) !important;
        color: var(--bs-input-color) !important;
    }

    .dark-style .form-select:focus {
        background-color: var(--bs-input-bg) !important;
        border-color: var(--bs-primary) !important;
        color: var(--bs-input-color) !important;
    }

    .dark-style .form-text {
        color: var(--bs-text-muted) !important;
    }

    /* Dark Mode - Buttons */
    .dark-style .btn-secondary {
        background-color: #3a3b5e !important;
        border-color: #3a3b5e !important;
        color: var(--bs-body-color) !important;
    }

    .dark-style .btn-secondary:hover {
        background-color: #4a4b6e !important;
        border-color: #4a4b6e !important;
        color: var(--bs-body-color) !important;
    }

    .dark-style .btn-outline-secondary {
        color: var(--bs-body-color) !important;
        border-color: var(--bs-border-color) !important;
    }

    .dark-style .btn-outline-secondary:hover {
        background-color: var(--bs-border-color) !important;
        color: var(--bs-body-color) !important;
    }

    /* Dark Mode - Badges */
    .dark-style .badge.bg-label-primary {
        background-color: rgba(139, 124, 246, 0.2) !important;
        color: #8b7cf6 !important;
    }

    .dark-style .badge.bg-label-success {
        background-color: rgba(34, 197, 94, 0.2) !important;
        color: #22c55e !important;
    }

    .dark-style .badge.bg-label-danger {
        background-color: rgba(239, 68, 68, 0.2) !important;
        color: #ef4444 !important;
    }

    .dark-style .badge.bg-label-warning {
        background-color: rgba(245, 158, 11, 0.2) !important;
        color: #f59e0b !important;
    }

    .dark-style .badge.bg-label-info {
        background-color: rgba(6, 182, 212, 0.2) !important;
        color: #06b6d4 !important;
    }

    .dark-style .badge.bg-label-secondary {
        background-color: rgba(107, 114, 128, 0.2) !important;
        color: #6b7280 !important;
    }

    .dark-style .badge.bg-label-dark {
        background-color: rgba(55, 65, 81, 0.2) !important;
        color: #374151 !important;
    }

    /* Dark Mode - Card Label Backgrounds */
    .dark-style .card.bg-label-primary {
        background-color: var(--bs-card-label-primary-bg) !important;
        color: #8b7cf6 !important;
    }

    .dark-style .card.bg-label-success {
        background-color: var(--bs-card-label-success-bg) !important;
        color: #22c55e !important;
    }

    .dark-style .card.bg-label-danger {
        background-color: var(--bs-card-label-danger-bg) !important;
        color: #ef4444 !important;
    }

    .dark-style .card.bg-label-warning {
        background-color: var(--bs-card-label-warning-bg) !important;
        color: #f59e0b !important;
    }

    .dark-style .card.bg-label-info {
        background-color: var(--bs-card-label-info-bg) !important;
        color: #06b6d4 !important;
    }

    .dark-style .card.bg-label-secondary {
        background-color: var(--bs-card-label-secondary-bg) !important;
        color: #6b7280 !important;
    }

    .dark-style .card.bg-label-dark {
        background-color: var(--bs-card-label-dark-bg) !important;
        color: #374151 !important;
    }

    /* Dark Mode - Card Light Background */
    .dark-style .card.bg-light {
        background-color: var(--bs-card-light-bg) !important;
        color: var(--bs-body-color) !important;
    }

    .dark-style .card-header.bg-light {
        background-color: var(--bs-card-light-bg) !important;
        color: var(--bs-heading-color) !important;
    }

    /* Dark Mode - Card Background Colors */
    .dark-style .card.bg-primary {
        background-color: var(--bs-card-primary-bg) !important;
        color: #fff !important;
    }

    .dark-style .card.bg-success {
        background-color: var(--bs-card-success-bg) !important;
        color: #fff !important;
    }

    .dark-style .card.bg-danger {
        background-color: var(--bs-card-danger-bg) !important;
        color: #fff !important;
    }

    .dark-style .card.bg-warning {
        background-color: var(--bs-card-warning-bg) !important;
        color: #fff !important;
    }

    .dark-style .card.bg-info {
        background-color: var(--bs-card-info-bg) !important;
        color: #fff !important;
    }

    .dark-style .card-header.bg-primary {
        background-color: var(--bs-card-primary-bg) !important;
        color: #fff !important;
    }

    .dark-style .card-header.bg-success {
        background-color: var(--bs-card-success-bg) !important;
        color: #fff !important;
    }

    .dark-style .card-header.bg-danger {
        background-color: var(--bs-card-danger-bg) !important;
        color: #fff !important;
    }

    .dark-style .card-header.bg-warning {
        background-color: var(--bs-card-warning-bg) !important;
        color: #fff !important;
    }

    .dark-style .card-header.bg-info {
        background-color: var(--bs-card-info-bg) !important;
        color: #fff !important;
    }

    /* Dark Mode - Progress Bars */
    .dark-style .progress {
        background-color: var(--bs-progress-bg) !important;
    }

    /* Dark Mode - Text Colors */
    .dark-style .text-muted {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .text-primary {
        color: var(--bs-link-color) !important;
    }

    .dark-style .text-success {
        color: #22c55e !important;
    }

    .dark-style .text-danger {
        color: #ef4444 !important;
    }

    .dark-style .text-warning {
        color: #f59e0b !important;
    }

    .dark-style .text-info {
        color: #06b6d4 !important;
    }

    .dark-style .text-secondary {
        color: var(--bs-text-muted) !important;
    }

    /* Dark Mode - Dropdowns */
    .dark-style .dropdown-menu {
        background-color: var(--bs-dropdown-bg) !important;
        border-color: var(--bs-dropdown-border-color) !important;
    }

    .dark-style .dropdown-item {
        color: var(--bs-dropdown-color) !important;
    }

    .dark-style .dropdown-item:hover {
        background-color: rgba(139, 124, 246, 0.15) !important;
        color: var(--bs-link-color) !important;
    }

    .dark-style .dropdown-divider {
        border-color: var(--bs-border-color) !important;
    }

    /* Dark Mode - Charts */
    .dark-style .apexcharts-canvas {
        background-color: var(--bs-chart-bg) !important;
    }

    .dark-style .apexcharts-text {
        fill: var(--bs-chart-text) !important;
    }

    .dark-style .apexcharts-title-text {
        fill: var(--bs-heading-color) !important;
    }

    .dark-style .apexcharts-legend-text {
        color: var(--bs-chart-text) !important;
    }

    .dark-style .apexcharts-gridline {
        stroke: var(--bs-chart-grid) !important;
    }

    .dark-style .apexcharts-xaxis line,
    .dark-style .apexcharts-yaxis line {
        stroke: var(--bs-chart-grid) !important;
    }

    .dark-style .apexcharts-xaxis-label,
    .dark-style .apexcharts-yaxis-label {
        fill: var(--bs-chart-text) !important;
    }

    .dark-style .apexcharts-tooltip {
        background-color: var(--bs-chart-bg) !important;
        border-color: var(--bs-border-color) !important;
        color: var(--bs-chart-text) !important;
    }

    .dark-style .apexcharts-tooltip-title {
        background-color: var(--bs-border-color) !important;
        color: var(--bs-heading-color) !important;
    }

    /* Dark Mode - Modals */
    .dark-style .modal-content {
        background-color: var(--bs-modal-bg) !important;
        border-color: var(--bs-modal-border-color) !important;
    }

    .dark-style .modal-header {
        border-bottom-color: var(--bs-border-color) !important;
    }

    .dark-style .modal-footer {
        border-top-color: var(--bs-border-color) !important;
    }

    /* Dark Mode - Tooltips */
    .dark-style .tooltip-inner {
        background-color: var(--bs-tooltip-bg) !important;
        color: var(--bs-chart-text) !important;
    }

    /* Dark Mode - Popovers */
    .dark-style .popover {
        background-color: var(--bs-popover-bg) !important;
        border-color: var(--bs-border-color) !important;
    }

    .dark-style .popover-header {
        background-color: var(--bs-border-color) !important;
        border-bottom-color: var(--bs-border-color) !important;
        color: var(--bs-heading-color) !important;
    }

    /* Dark Mode - List Groups */
    .dark-style .list-group-item {
        background-color: var(--bs-list-group-bg) !important;
        border-color: var(--bs-list-group-border-color) !important;
        color: var(--bs-body-color) !important;
    }

    /* Dark Mode - Pagination */
    .dark-style .page-link {
        background-color: var(--bs-pagination-bg) !important;
        border-color: var(--bs-pagination-border-color) !important;
        color: var(--bs-body-color) !important;
    }

    .dark-style .page-link:hover {
        background-color: var(--bs-border-color) !important;
        color: var(--bs-body-color) !important;
    }

    .dark-style .page-item.active .page-link {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
        color: #fff !important;
    }

    /* Dark Mode - Alerts */
    .dark-style .alert {
        background-color: var(--bs-alert-bg) !important;
        border-color: var(--bs-alert-border-color) !important;
        color: var(--bs-body-color) !important;
    }

    /* Dark Mode - Avatar */
    .dark-style .avatar-initial {
        background-color: var(--bs-primary) !important;
        color: #fff !important;
    }

    /* Dark Mode - Utilities */
    .dark-style .border {
        border-color: var(--bs-border-color) !important;
    }

    .dark-style .border-top {
        border-top-color: var(--bs-border-color) !important;
    }

    .dark-style .border-bottom {
        border-bottom-color: var(--bs-border-color) !important;
    }

    .dark-style .border-start {
        border-left-color: var(--bs-border-color) !important;
    }

    .dark-style .border-end {
        border-right-color: var(--bs-border-color) !important;
    }

    /* Dark Mode - Shadows */
    .dark-style .shadow {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .dark-style .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    /* Custom Branding Colors */
    .btn-primary {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
    }

    .btn-primary:hover {
        background-color: #5e50ee !important;
        border-color: #5e50ee !important;
    }

    .page-item.active .page-link {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
    }

    .form-control:focus {
        border-color: var(--bs-primary) !important;
        box-shadow: 0 0 0 0.2rem rgba(139, 124, 246, 0.3) !important;
    }

    .bg-primary {
        background-color: var(--bs-primary) !important;
    }

    .text-primary {
        color: var(--bs-primary) !important;
    }

    .border-primary {
        border-color: var(--bs-primary) !important;
    }

    /* Additional Dark Mode Fixes */
    .dark-style .user-progress {
        color: var(--bs-body-color) !important;
    }

    /* Fix for all text elements */
    .dark-style h1,
    .dark-style h2,
    .dark-style h3,
    .dark-style h4,
    .dark-style h5,
    .dark-style h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style p {
        color: var(--bs-body-color) !important;
    }

    .dark-style span {
        color: var(--bs-body-color) !important;
    }

    .dark-style div {
        color: var(--bs-body-color) !important;
    }

    .dark-style small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style strong {
        color: var(--bs-heading-color) !important;
    }

    .dark-style b {
        color: var(--bs-heading-color) !important;
    }

    .dark-style em {
        color: var(--bs-body-color) !important;
    }

    .dark-style i {
        color: var(--bs-body-color) !important;
    }

    /* Fix for list items */
    .dark-style li {
        color: var(--bs-body-color) !important;
    }

    .dark-style li h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style li p {
        color: var(--bs-body-color) !important;
    }

    .dark-style li small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style li .mb-0 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style li .fw-semibold {
        color: var(--bs-heading-color) !important;
    }

    .dark-style li .text-success {
        color: #22c55e !important;
    }

    .dark-style li .text-danger {
        color: #ef4444 !important;
    }

    .dark-style li .text-warning {
        color: #f59e0b !important;
    }

    .dark-style li .text-info {
        color: #06b6d4 !important;
    }

    .dark-style li .text-muted {
        color: var(--bs-text-muted) !important;
    }

    /* Force all elements in cards to use dark colors */
    .dark-style .card * {
        color: inherit !important;
    }

    .dark-style .card h1,
    .dark-style .card h2,
    .dark-style .card h3,
    .dark-style .card h4,
    .dark-style .card h5,
    .dark-style .card h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .card p,
    .dark-style .card span,
    .dark-style .card div {
        color: var(--bs-body-color) !important;
    }

    .dark-style .card small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .card .text-success {
        color: #22c55e !important;
    }

    .dark-style .card .text-danger {
        color: #ef4444 !important;
    }

    .dark-style .card .text-warning {
        color: #f59e0b !important;
    }

    .dark-style .card .text-info {
        color: #06b6d4 !important;
    }

    .dark-style .card .text-primary {
        color: var(--bs-link-color) !important;
    }

    .dark-style .card .text-muted {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .card .fw-semibold {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .card .mb-0 {
        color: var(--bs-heading-color) !important;
    }

    /* Specific fixes for dashboard elements */
    .dark-style .card .content-left h1,
    .dark-style .card .content-left h2,
    .dark-style .card .content-left h3,
    .dark-style .card .content-left h4,
    .dark-style .card .content-left h5,
    .dark-style .card .content-left h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .card .content-left p,
    .dark-style .card .content-left span,
    .dark-style .card .content-left div {
        color: var(--bs-body-color) !important;
    }

    .dark-style .card .content-left small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .card .content-left .fw-semibold {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .card .content-left .mb-0 {
        color: var(--bs-heading-color) !important;
    }

    /* Fix for flex containers in cards */
    .dark-style .card .d-flex h1,
    .dark-style .card .d-flex h2,
    .dark-style .card .d-flex h3,
    .dark-style .card .d-flex h4,
    .dark-style .card .d-flex h5,
    .dark-style .card .d-flex h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .card .d-flex p,
    .dark-style .card .d-flex span,
    .dark-style .card .d-flex div {
        color: var(--bs-body-color) !important;
    }

    .dark-style .card .d-flex small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .card .d-flex .fw-semibold {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .card .d-flex .mb-0 {
        color: var(--bs-heading-color) !important;
    }

    /* Fix for all elements in the entire page */
    .dark-style * {
        color: inherit;
    }

    .dark-style h1,
    .dark-style h2,
    .dark-style h3,
    .dark-style h4,
    .dark-style h5,
    .dark-style h6 {
        color: var(--bs-heading-color) !important;
    }

    .dark-style p,
    .dark-style span,
    .dark-style div {
        color: var(--bs-body-color) !important;
    }

    .dark-style small {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .text-success {
        color: #22c55e !important;
    }

    .dark-style .text-danger {
        color: #ef4444 !important;
    }

    .dark-style .text-warning {
        color: #f59e0b !important;
    }

    .dark-style .text-info {
        color: #06b6d4 !important;
    }

    .dark-style .text-primary {
        color: var(--bs-link-color) !important;
    }

    .dark-style .text-muted {
        color: var(--bs-text-muted) !important;
    }

    .dark-style .fw-semibold {
        color: var(--bs-heading-color) !important;
    }

    .dark-style .mb-0 {
        color: var(--bs-heading-color) !important;
    }

    /* Product Info Dark Mode Styling */
    .dark-style .product-info {
        background-color: #1a1b2e !important;
        color: #b8b9d8 !important;
        border: 1px solid #3a3b5e !important;
    }

    .dark-style .product-info .text-muted {
        color: #8b9bb4 !important;
    }

    .dark-style .product-info strong {
        color: #e8e9ff !important;
    }

    .dark-style .product-info div {
        color: inherit !important;
    }

    .dark-style .product-info:hover {
        background-color: #252640 !important;
        border-color: #4a4b6e !important;
    }

    /* Additional dark mode fixes for product-related elements */
    .dark-style .matches-container {
        background-color: #1a1b2e !important;
        border: 1px solid #3a3b5e !important;
    }

    .dark-style .table-container {
        background-color: transparent !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.querySelector('#layout-menu');
        const menuInner = document.querySelector('.menu-inner');

        if (!sidebar || !menuInner) return;

        // Function to handle mouse wheel events on sidebar
        function handleSidebarWheel(e) {
            // Only proceed if the sidebar or its children are being scrolled
            if (!sidebar.contains(e.target)) return;

            e.preventDefault();
            e.stopPropagation();

            const delta = e.deltaY;
            const scrollAmount = 40;

            // Scroll the menu inner container
            menuInner.scrollTop += (delta > 0) ? scrollAmount : -scrollAmount;
        }

        // Add wheel event listener to the sidebar
        sidebar.addEventListener('wheel', handleSidebarWheel, {
            passive: false
        });

        // Ensure the sidebar scrolls smoothly
        menuInner.style.scrollBehavior = 'smooth';

        // Handle mouse enter/leave for better UX
        sidebar.addEventListener('mouseenter', function() {
            document.body.style.overflow = 'hidden';
        });

        sidebar.addEventListener('mouseleave', function() {
            document.body.style.overflow = '';
        });
    });
</script>
