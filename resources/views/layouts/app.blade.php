<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Informasi Perpustakaan - STMIK El Rahma Yogyakarta">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Perpustakaan Digital</title>

    {{-- Google Fonts: Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5.3 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Custom Styles --}}
    <style>
        /* ============================================
           DESIGN TOKENS & CSS VARIABLES
        ============================================ */
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed: 70px;

            /* Color Palette */
            --primary-50:  #eff6ff;
            --primary-100: #dbeafe;
            --primary-200: #bfdbfe;
            --primary-500: #3b82f6;
            --primary-600: #2563eb;
            --primary-700: #1d4ed8;

            --sidebar-bg:       #0f1b35;
            --sidebar-bg-2:     #162040;
            --sidebar-accent:   #1e3a5f;
            --sidebar-hover:    #243d6a;
            --sidebar-active:   #2563eb;
            --sidebar-text:     #94a3b8;
            --sidebar-text-hov: #e2e8f0;
            --sidebar-text-act: #ffffff;

            --topbar-bg:   #ffffff;
            --topbar-h:    64px;
            --content-bg:  #f1f5f9;

            --card-bg:     #ffffff;
            --card-border: #e2e8f0;
            --card-shadow: 0 1px 3px 0 rgb(0 0 0 / .07), 0 1px 2px -1px rgb(0 0 0 / .07);
            --card-shadow-hov: 0 10px 25px -5px rgb(0 0 0 / .1), 0 8px 10px -6px rgb(0 0 0 / .07);

            --text-primary:   #0f172a;
            --text-secondary: #475569;
            --text-muted:     #94a3b8;

            --success: #10b981;
            --warning: #f59e0b;
            --danger:  #ef4444;
            --info:    #06b6d4;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 20px;

            --transition: all .2s cubic-bezier(.4,0,.2,1);
        }

        /* ============================================
           GLOBAL RESET
        ============================================ */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            font-size: 14px;
            background: var(--content-bg);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ============================================
           SIDEBAR
        ============================================ */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, var(--sidebar-bg-2) 100%);
            border-right: 1px solid rgba(255,255,255,.05);
            display: flex;
            flex-direction: column;
            z-index: 1040;
            transition: var(--transition);
            overflow: hidden;
        }

        /* Brand / Logo */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            text-decoration: none;
            min-height: var(--topbar-h);
            flex-shrink: 0;
        }

        .sidebar-brand-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-700));
            border-radius: var(--radius-sm);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; color: #fff;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(37,99,235,.4);
        }

        .sidebar-brand-text {
            display: flex; flex-direction: column;
        }
        .sidebar-brand-title {
            font-size: 13px; font-weight: 700;
            color: #ffffff; letter-spacing: .02em;
            line-height: 1.2; white-space: nowrap;
        }
        .sidebar-brand-sub {
            font-size: 10px; color: var(--sidebar-text);
            letter-spacing: .04em; text-transform: uppercase;
            white-space: nowrap;
        }

        /* Nav section label */
        .nav-section-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--sidebar-text);
            padding: 16px 20px 6px;
            opacity: .6;
        }

        /* Nav items */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 8px 12px 16px;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 12px;
            border-radius: var(--radius-sm);
            color: var(--sidebar-text);
            text-decoration: none;
            font-weight: 500;
            font-size: 13.5px;
            transition: var(--transition);
            white-space: nowrap;
            position: relative;
            margin-bottom: 2px;
        }

        .nav-item-link i {
            font-size: 17px;
            flex-shrink: 0;
            width: 22px;
            text-align: center;
            transition: var(--transition);
        }

        .nav-item-link:hover {
            background: var(--sidebar-hover);
            color: var(--sidebar-text-hov);
        }
        .nav-item-link:hover i { transform: translateX(2px); }

        .nav-item-link.active {
            background: linear-gradient(135deg, var(--sidebar-active), #1d4ed8);
            color: var(--sidebar-text-act);
            box-shadow: 0 4px 12px rgba(37,99,235,.35);
        }
        .nav-item-link.active::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%;
            background: #93c5fd;
            border-radius: 0 3px 3px 0;
            margin-left: -12px;
        }

        /* Badge in nav */
        .nav-badge {
            margin-left: auto;
            background: rgba(255,255,255,.15);
            color: #e2e8f0;
            font-size: 10px;
            font-weight: 600;
            padding: 2px 7px;
            border-radius: 20px;
            transition: var(--transition);
        }
        .nav-item-link.active .nav-badge {
            background: rgba(255,255,255,.25);
            color: #fff;
        }

        /* Sidebar footer */
        .sidebar-footer {
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,.08);
            flex-shrink: 0;
        }
        .sidebar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 8px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
        }
        .sidebar-user:hover { background: var(--sidebar-hover); }
        .sidebar-user-avatar {
            width: 34px; height: 34px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; color: #fff; font-weight: 600;
            flex-shrink: 0;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name {
            font-size: 13px; font-weight: 600;
            color: #e2e8f0; line-height: 1.2;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role {
            font-size: 11px; color: var(--sidebar-text);
        }

        /* ============================================
           MAIN WRAPPER
        ============================================ */
        #main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
        }

        /* ============================================
           TOPBAR
        ============================================ */
        #topbar {
            position: sticky; top: 0; z-index: 1030;
            height: var(--topbar-h);
            background: var(--topbar-bg);
            border-bottom: 1px solid var(--card-border);
            display: flex; align-items: center;
            padding: 0 24px;
            gap: 16px;
            box-shadow: 0 1px 3px rgb(0 0 0 / .06);
        }

        .topbar-toggle {
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border: none; background: transparent;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            font-size: 18px;
        }
        .topbar-toggle:hover {
            background: var(--primary-50);
            color: var(--primary-600);
        }

        .topbar-breadcrumb {
            flex: 1;
            display: flex; align-items: center; gap: 8px;
        }
        .topbar-page-title {
            font-size: 15px; font-weight: 600;
            color: var(--text-primary);
        }
        .topbar-breadcrumb .separator {
            color: var(--text-muted); font-size: 12px;
        }
        .topbar-breadcrumb .bc-item {
            font-size: 13px; color: var(--text-secondary);
        }

        .topbar-actions {
            display: flex; align-items: center; gap: 8px;
        }

        .topbar-btn {
            width: 36px; height: 36px;
            display: flex; align-items: center; justify-content: center;
            border: none; background: transparent;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            font-size: 17px;
            position: relative;
        }
        .topbar-btn:hover {
            background: var(--primary-50);
            color: var(--primary-600);
        }

        .topbar-notif-badge {
            position: absolute; top: 5px; right: 5px;
            width: 8px; height: 8px;
            background: var(--danger);
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .topbar-divider {
            width: 1px; height: 24px;
            background: var(--card-border);
        }

        .topbar-user {
            display: flex; align-items: center; gap: 10px;
            padding: 4px 8px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: var(--transition);
            border: none; background: transparent;
        }
        .topbar-user:hover { background: var(--primary-50); }
        .topbar-user-avatar {
            width: 32px; height: 32px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; color: #fff; font-weight: 700;
        }
        .topbar-user-name {
            font-size: 13px; font-weight: 600;
            color: var(--text-primary);
        }

        /* ============================================
           PAGE CONTENT
        ============================================ */
        #page-content {
            flex: 1;
            padding: 24px;
        }

        /* Page header inside content */
        .page-header {
            display: flex; align-items: flex-start;
            justify-content: space-between; gap: 16px;
            margin-bottom: 24px;
        }
        .page-header-left {}
        .page-title {
            font-size: 22px; font-weight: 700;
            color: var(--text-primary); line-height: 1.2;
            margin: 0 0 4px;
        }
        .page-subtitle {
            font-size: 13px; color: var(--text-secondary); margin: 0;
        }
        .page-header-actions {
            display: flex; align-items: center; gap: 8px; flex-shrink: 0;
        }

        /* ============================================
           STAT CARDS (Dashboard)
        ============================================ */
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            padding: 22px 24px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--stat-color, var(--primary-500));
        }
        .stat-card:hover {
            box-shadow: var(--card-shadow-hov);
            transform: translateY(-2px);
        }

        .stat-card-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 14px;
        }
        .stat-card-label {
            font-size: 12px; font-weight: 600;
            text-transform: uppercase; letter-spacing: .06em;
            color: var(--text-secondary);
        }
        .stat-card-icon {
            width: 42px; height: 42px;
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
            background: var(--stat-icon-bg, var(--primary-50));
            color: var(--stat-color, var(--primary-500));
        }
        .stat-card-value {
            font-size: 30px; font-weight: 800;
            color: var(--text-primary); line-height: 1;
            margin-bottom: 6px;
        }
        .stat-card-meta {
            font-size: 12px; color: var(--text-muted);
            display: flex; align-items: center; gap: 4px;
        }
        .stat-card-meta .trend-up   { color: var(--success); }
        .stat-card-meta .trend-down { color: var(--danger); }

        /* ============================================
           CONTENT CARD
        ============================================ */
        .content-card {
            background: var(--card-bg);
            border: 1px solid var(--card-border);
            border-radius: var(--radius-lg);
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }

        .content-card-header {
            display: flex; align-items: center;
            justify-content: space-between; gap: 12px;
            padding: 18px 24px;
            border-bottom: 1px solid var(--card-border);
            background: #fafbfc;
        }
        .content-card-title {
            font-size: 15px; font-weight: 700;
            color: var(--text-primary); margin: 0;
            display: flex; align-items: center; gap: 8px;
        }
        .content-card-title i {
            font-size: 16px; color: var(--primary-500);
        }
        .content-card-body { padding: 24px; }
        .content-card-body.p-0 { padding: 0; }

        /* ============================================
           TABLE STYLES
        ============================================ */
        .table-custom {
            width: 100%; margin: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-custom thead th {
            padding: 11px 16px;
            font-size: 11px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .07em;
            color: var(--text-secondary);
            background: #f8fafc;
            border-bottom: 2px solid var(--card-border);
            white-space: nowrap;
        }
        .table-custom tbody tr {
            transition: var(--transition);
        }
        .table-custom tbody tr:hover {
            background: var(--primary-50);
        }
        .table-custom tbody td {
            padding: 13px 16px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13.5px;
            color: var(--text-primary);
            vertical-align: middle;
        }
        .table-custom tbody tr:last-child td {
            border-bottom: none;
        }

        /* Row number badge */
        .row-number {
            display: inline-flex; align-items: center; justify-content: center;
            width: 26px; height: 26px;
            background: var(--primary-50);
            color: var(--primary-600);
            border-radius: 6px;
            font-size: 12px; font-weight: 700;
        }

        /* ============================================
           BADGES / STATUS
        ============================================ */
        .badge-status {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .badge-status::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: currentColor;
        }
        .badge-dipinjam   { background: #fef3c7; color: #92400e; }
        .badge-kembali    { background: #d1fae5; color: #065f46; }
        .badge-stok-ok    { background: #dbeafe; color: #1e40af; }
        .badge-stok-habis { background: #fee2e2; color: #991b1b; }

        /* ============================================
           BUTTONS
        ============================================ */
        .btn {
            border-radius: var(--radius-sm) !important;
            font-weight: 600 !important;
            font-size: 13px !important;
            transition: var(--transition) !important;
            display: inline-flex; align-items: center; gap: 6px;
            flex-shrink: 0 !important;
        }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500), var(--primary-700)) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(37,99,235,.3) !important;
        }
        .btn-primary:hover {
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 16px rgba(37,99,235,.4) !important;
        }
        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(16,185,129,.3) !important;
        }
        .btn-success:hover { transform: translateY(-1px) !important; }

        .btn-sm { padding: 6px 12px !important; font-size: 12px !important; }

        .btn-icon {
            width: 32px; height: 32px;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: var(--radius-sm) !important;
            padding: 0 !important;
            border: none !important;
            font-size: 14px !important;
            transition: var(--transition) !important;
        }
        .btn-icon-edit   { background: #eff6ff; color: #2563eb; }
        .btn-icon-delete { background: #fff5f5; color: #e53e3e; }
        .btn-icon-view   { background: #f0fdf4; color: #16a34a; }
        .btn-icon-edit:hover   { background: #2563eb; color: #fff; }
        .btn-icon-delete:hover { background: #e53e3e; color: #fff; }
        .btn-icon-view:hover   { background: #16a34a; color: #fff; }

        /* ============================================
           SEARCH & FILTER BAR
        ============================================ */
        .search-bar {
            position: relative;
        }
        .search-bar .form-control {
            padding-left: 38px !important;
            border-radius: var(--radius-sm) !important;
            border: 1.5px solid var(--card-border) !important;
            font-size: 13px !important;
            background: #f8fafc;
            transition: var(--transition) !important;
        }
        .search-bar .form-control:focus {
            border-color: var(--primary-500) !important;
            background: #fff !important;
            box-shadow: 0 0 0 3px rgba(59,130,246,.12) !important;
        }
        .search-bar .search-icon {
            position: absolute; left: 12px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted); font-size: 15px;
            pointer-events: none;
            z-index: 5;
        }

        /* ============================================
           FORMS
        ============================================ */
        .form-label {
            font-size: 13px; font-weight: 600;
            color: var(--text-primary); margin-bottom: 6px;
        }
        .form-control, .form-select {
            border-radius: var(--radius-sm) !important;
            border: 1.5px solid var(--card-border) !important;
            font-size: 13.5px !important;
            padding: 9px 13px !important;
            color: var(--text-primary) !important;
            transition: var(--transition) !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-500) !important;
            box-shadow: 0 0 0 3px rgba(59,130,246,.12) !important;
        }
        .form-control.is-invalid {
            border-color: var(--danger) !important;
        }
        .invalid-feedback { font-size: 12px; }

        /* ============================================
           ALERTS
        ============================================ */
        .alert {
            border-radius: var(--radius-md) !important;
            border: none !important;
            font-size: 13.5px !important;
            display: flex; align-items: center; gap: 10px;
        }
        .alert-success { background: #d1fae5; color: #065f46; }
        .alert-danger   { background: #fee2e2; color: #991b1b; }
        .alert-warning  { background: #fef3c7; color: #92400e; }
        .alert-info     { background: #e0f2fe; color: #0c4a6e; }

        /* ============================================
           EMPTY STATE
        ============================================ */
        .empty-state {
            text-align: center; padding: 60px 20px;
        }
        .empty-state-icon {
            width: 72px; height: 72px;
            background: var(--primary-50);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 30px; color: var(--primary-500);
            margin: 0 auto 16px;
        }
        .empty-state-title {
            font-size: 16px; font-weight: 700;
            color: var(--text-primary); margin-bottom: 6px;
        }
        .empty-state-text {
            font-size: 13px; color: var(--text-secondary);
            max-width: 280px; margin: 0 auto 20px;
        }

        /* ============================================
           PAGINATION
        ============================================ */
        .pagination {
            gap: 4px;
        }
        .page-link {
            border-radius: var(--radius-sm) !important;
            border: 1px solid var(--card-border) !important;
            color: var(--text-secondary) !important;
            font-size: 13px !important; font-weight: 500 !important;
            padding: 6px 12px !important;
            transition: var(--transition) !important;
        }
        .page-link:hover {
            background: var(--primary-50) !important;
            color: var(--primary-600) !important;
            border-color: var(--primary-200) !important;
        }
        .page-item.active .page-link {
            background: var(--primary-600) !important;
            border-color: var(--primary-600) !important;
            color: #fff !important;
        }

        /* ============================================
           MODAL
        ============================================ */
        .modal-content {
            border-radius: var(--radius-lg) !important;
            border: none !important;
            box-shadow: 0 25px 50px -12px rgb(0 0 0 / .25) !important;
        }
        .modal-header {
            border-bottom: 1px solid var(--card-border) !important;
            padding: 18px 24px !important;
        }
        .modal-title {
            font-size: 15px !important; font-weight: 700 !important;
        }
        .modal-body { padding: 24px !important; }
        .modal-footer {
            padding: 16px 24px !important;
            border-top: 1px solid var(--card-border) !important;
        }

        /* ============================================
           TOAST NOTIFICATIONS
        ============================================ */
        .toast-container-custom {
            position: fixed; top: 20px; right: 20px;
            z-index: 9999;
        }

        /* ============================================
           LOADING OVERLAY
        ============================================ */
        .page-loader {
            position: fixed; inset: 0;
            background: rgba(15,27,53,.7);
            display: flex; align-items: center; justify-content: center;
            z-index: 9999;
            opacity: 0; pointer-events: none;
            transition: opacity .3s;
        }
        .page-loader.show {
            opacity: 1; pointer-events: auto;
        }

        /* ============================================
           SIDEBAR TOGGLE (Mobile)
        ============================================ */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 1039;
        }

        /* ============================================
           RESPONSIVE & TOGGLE
        ============================================ */
        @media (min-width: 993px) {
            #sidebar.sidebar-collapsed {
                transform: translateX(-100%);
            }
            #main-wrapper.sidebar-collapsed {
                margin-left: 0;
            }
        }

        @media (max-width: 992px) {
            #sidebar {
                transform: translateX(-100%);
            }
            #sidebar.sidebar-open {
                transform: translateX(0);
            }
            .sidebar-overlay { display: block; opacity: 0; pointer-events: none; }
            .sidebar-overlay.show { opacity: 1; pointer-events: auto; }
            #main-wrapper { margin-left: 0; }
        }

        @media (max-width: 576px) {
            #page-content { padding: 16px; }
            
            /* Make page header stack on mobile */
            .page-header {
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
            }
            .page-header-actions {
                width: 100%;
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .page-title { font-size: 18px; }
            
            /* Make content card header stack on mobile */
            .content-card-header {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }
            
            /* Make the form inside card header stack vertically */
            .content-card-header form {
                width: 100%;
                flex-direction: column;
                align-items: stretch;
                gap: 8px !important;
            }
            .search-bar, .search-bar .form-control {
                width: 100% !important;
            }
            .content-card-header form .form-select,
            .content-card-header form .btn {
                width: 100%;
                justify-content: center;
            }
        }

        /* ============================================
           SCROLL ANIMATION
        ============================================ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeInUp .35s ease forwards;
        }
        .delay-1 { animation-delay: .05s; }
        .delay-2 { animation-delay: .10s; }
        .delay-3 { animation-delay: .15s; }
        .delay-4 { animation-delay: .20s; }

        /* ============================================
           COVER IMAGE
        ============================================ */
        .book-cover {
            width: 44px; height: 58px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid var(--card-border);
            box-shadow: 2px 2px 6px rgb(0 0 0 / .12);
        }
        .book-cover-placeholder {
            width: 44px; height: 58px;
            background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            color: #6366f1; font-size: 18px;
        }

        /* ============================================
           EXTRA UTILITIES
        ============================================ */
        .fw-600  { font-weight: 600; }
        .fw-700  { font-weight: 700; }
        .text-xs { font-size: 11px; }
        .text-sm { font-size: 13px; }
        .gap-6   { gap: 6px; }
        .rounded-custom { border-radius: var(--radius-md); }
    </style>

    @yield('styles')
</head>
<body>

{{-- ============================
     SIDEBAR
============================== --}}
<nav id="sidebar">

    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <i class="bi bi-journal-bookmark-fill"></i>
        </div>
        <div class="sidebar-brand-text">
            <span class="sidebar-brand-title">Perpustakaan</span>
            <span class="sidebar-brand-sub">Digital Library</span>
        </div>
    </a>

    {{-- Navigation --}}
    <div class="sidebar-nav">

        <div class="nav-section-label">Menu Utama</div>

        <a href="{{ route('dashboard') }}"
           class="nav-item-link {{ Request::routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <div class="nav-section-label" style="margin-top:8px;">Pengelolaan Data</div>

        <a href="{{ route('buku.index') }}"
           class="nav-item-link {{ Request::routeIs('buku.*') ? 'active' : '' }}">
            <i class="bi bi-book-fill"></i>
            <span>Data Buku</span>
        </a>

        <a href="{{ route('anggota.index') }}"
           class="nav-item-link {{ Request::routeIs('anggota.*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Data Anggota</span>
        </a>

        <div class="nav-section-label" style="margin-top:8px;">Transaksi</div>

        <a href="{{ route('peminjaman.index') }}"
           class="nav-item-link {{ Request::routeIs('peminjaman.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i>
            <span>Peminjaman</span>
        </a>

    </div>

    {{-- Footer user info --}}
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-user-avatar">A</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">Admin Perpustakaan</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
            <i class="bi bi-three-dots-vertical" style="color:var(--sidebar-text);font-size:14px;"></i>
        </div>
    </div>
</nav>

{{-- Overlay for mobile --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ============================
     MAIN WRAPPER
============================== --}}
<div id="main-wrapper">

    {{-- TOP BAR --}}
    <header id="topbar">
        {{-- Toggle button --}}
        <button class="topbar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>

        {{-- Breadcrumb --}}
        <div class="topbar-breadcrumb">
            <span class="topbar-page-title">@yield('page-title', 'Dashboard')</span>
        </div>

        {{-- Actions --}}
        <div class="topbar-actions">
            {{-- Notification bell --}}
            @php
                $bukuHabis = \App\Models\Buku::where('stok', '<=', 0)->get();
                $stokHabis = $bukuHabis->count();
            @endphp
            <div class="dropdown">
                <button class="topbar-btn" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                    @if($stokHabis > 0)
                        <span class="topbar-notif-badge"></span>
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" style="width: 280px; max-height: 350px; overflow-y: auto;">
                    <li>
                        <h6 class="dropdown-header">
                            Notifikasi Stok Habis
                            @if($stokHabis > 0)
                                <span class="badge bg-danger ms-1">{{ $stokHabis }}</span>
                            @endif
                        </h6>
                    </li>
                    @if($stokHabis > 0)
                        @foreach($bukuHabis as $buku)
                            <li>
                                <a class="dropdown-item d-flex flex-column py-2" href="{{ route('buku.index', ['search' => $buku->kode_buku]) }}">
                                    <strong style="font-size: 13px; white-space: normal;">{{ $buku->judul }}</strong>
                                    <span class="text-muted" style="font-size: 11px;"><i class="bi bi-exclamation-circle text-danger"></i> Stok telah habis</span>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li>
                            <div class="dropdown-item text-muted text-center py-3" style="font-size: 13px;">
                                <i class="bi bi-check-circle text-success" style="font-size: 20px; display: block; margin-bottom: 5px;"></i>
                                Semua buku tersedia.
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="topbar-divider"></div>

            {{-- User info --}}
            <button class="topbar-user">
                <div class="topbar-user-avatar">A</div>
                <span class="topbar-user-name">Admin</span>
                <i class="bi bi-chevron-down" style="font-size:11px;color:var(--text-muted);"></i>
            </button>
        </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main id="page-content">

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Stok habis warning (Level 3) --}}
        @if(isset($stokHabis) && $stokHabis > 0 && Request::routeIs('dashboard'))
            <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                <strong>Perhatian!</strong> Terdapat <strong>{{ $stokHabis }} buku</strong> yang stoknya sudah habis.
                <a href="{{ route('buku.index') }}" class="alert-link">Kelola Data Buku →</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')

    </main>

    {{-- FOOTER --}}
    <footer style="padding:16px 24px;border-top:1px solid var(--card-border);background:#fff;">
        <div style="display:flex;align-items:center;justify-content:center;gap:12px;">
            <span style="font-size:12px;color:var(--text-muted);">
                &copy; {{ date('Y') }} Sistem Informasi Perpustakaan — STMIK El Rahma Yogyakarta
            </span>
        </div>
    </footer>

</div><!-- /#main-wrapper -->

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Chart.js (for dashboard) --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>

<script>
    // ========== SIDEBAR TOGGLE ==========
    const sidebar        = document.getElementById('sidebar');
    const sidebarToggle  = document.getElementById('sidebarToggle');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mainWrapper    = document.getElementById('main-wrapper');

    function openSidebarMobile() {
        sidebar.classList.add('sidebar-open');
        sidebarOverlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    function closeSidebarMobile() {
        sidebar.classList.remove('sidebar-open');
        sidebarOverlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    sidebarToggle.addEventListener('click', () => {
        if (window.innerWidth <= 992) {
            if (sidebar.classList.contains('sidebar-open')) {
                closeSidebarMobile();
            } else {
                openSidebarMobile();
            }
        } else {
            sidebar.classList.toggle('sidebar-collapsed');
            mainWrapper.classList.toggle('sidebar-collapsed');
        }
    });
    sidebarOverlay.addEventListener('click', closeSidebarMobile);

    // ========== BOOTSTRAP TOOLTIPS ==========
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
        new bootstrap.Tooltip(el, { trigger: 'hover' });
    });

    // ========== AUTO-DISMISS ALERTS ==========
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(a => {
            const bsAlert = bootstrap.Alert.getOrCreateInstance(a);
            bsAlert.close();
        });
    }, 5000);

    // ========== DELETE CONFIRM ==========
    document.querySelectorAll('.btn-delete-confirm').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const msg = this.dataset.message || 'Yakin ingin menghapus data ini?';
            if (!confirm(msg)) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>

@yield('scripts')
</body>
</html>
