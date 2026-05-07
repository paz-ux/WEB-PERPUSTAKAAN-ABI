<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        @keyframes floatOrb {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -20px) scale(1.05); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }

        body {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f0f23 50%, #1a1a2e 75%, #16213e 100%);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            min-height: 100vh;
            color: #e2e8f0;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 260px;
            background: rgba(15, 15, 35, 0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-right: 1px solid rgba(147, 51, 234, 0.15);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            padding: 0;
            z-index: 100;
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.3);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(124, 58, 237, 0.08) 0%, rgba(59, 130, 246, 0.04) 50%, rgba(15, 15, 35, 0) 100%);
            pointer-events: none;
            z-index: 0;
        }

        .sidebar-header {
            padding: 28px 24px 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            position: relative;
            z-index: 1;
        }

        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: white;
            font-weight: 800;
            font-size: 19px;
            letter-spacing: -0.3px;
        }

        .sidebar-logo .logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .sidebar-logo:hover .logo-icon {
            transform: scale(1.08) rotate(-5deg);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.6);
        }

        .sidebar-logo .logo-text {
            background: linear-gradient(135deg, #e879f9, #a855f7, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar-menu {
            list-style: none;
            padding: 16px 12px;
            position: relative;
            z-index: 1;
        }

        .sidebar-menu .menu-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(168, 85, 247, 0.6);
            padding: 12px 16px 8px;
            margin-top: 8px;
        }

        .sidebar-menu li {
            margin: 2px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 16px;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-menu a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #a855f7, #3b82f6);
            border-radius: 0 4px 4px 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-menu a:hover {
            background: rgba(147, 51, 234, 0.12);
            color: rgba(255, 255, 255, 0.95);
            transform: translateX(4px);
        }

        .sidebar-menu a:hover::before {
            opacity: 1;
        }

        .sidebar-menu a.active {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.2), rgba(59, 130, 246, 0.15));
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.15);
        }

        .sidebar-menu a.active::before {
            opacity: 1;
        }

        .sidebar-menu a.active i {
            color: #a855f7;
        }

        .sidebar-menu i {
            width: 20px;
            text-align: center;
            font-size: 16px;
            transition: color 0.3s ease;
        }

        .sidebar-menu a:hover i {
            color: #c084fc;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: 260px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ===== TOP NAVBAR ===== */
        .navbar-top {
            background: rgba(15, 15, 35, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            padding: 0 32px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .navbar-title {
            font-size: 22px;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff 0%, #c4b5fd 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.3px;
        }

        .navbar-profile {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-dropdown {
            position: relative;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            padding: 6px 12px;
            border-radius: 14px;
            transition: all 0.3s ease;
        }

        .profile-dropdown:hover {
            background: rgba(147, 51, 234, 0.1);
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            border: 2px solid rgba(168, 85, 247, 0.4);
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-name {
            font-weight: 600;
            color: #f1f5f9;
            font-size: 14px;
        }

        .profile-role {
            font-size: 11px;
            color: #a78bfa;
            font-weight: 500;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: 60px;
            right: 0;
            background: rgba(20, 20, 45, 0.95);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(147, 51, 234, 0.2);
            border-radius: 16px;
            min-width: 240px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4), 0 0 30px rgba(124, 58, 237, 0.1);
            display: none;
            z-index: 1000;
            overflow: hidden;
        }

        .dropdown-menu-custom.show {
            display: block;
            animation: dropdownFade 0.25s ease-out;
        }

        @keyframes dropdownFade {
            from { opacity: 0; transform: translateY(-10px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .dropdown-user-info {
            padding: 18px;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.15), rgba(59, 130, 246, 0.1));
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            text-align: center;
        }

        .dropdown-user-info .user-name {
            font-weight: 700;
            color: #f1f5f9;
            font-size: 14px;
        }

        .dropdown-user-info .user-email {
            font-size: 12px;
            color: #a78bfa;
        }

        .dropdown-menu-custom a,
        .dropdown-menu-custom button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 18px;
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            font-size: 14px;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
        }

        .dropdown-menu-custom a:last-child,
        .dropdown-menu-custom form:last-child button {
            border-bottom: none;
        }

        .dropdown-menu-custom a:hover,
        .dropdown-menu-custom button:hover {
            background: rgba(147, 51, 234, 0.12);
            color: #e9d5ff;
            padding-left: 22px;
        }

        .dropdown-menu-custom i {
            width: 18px;
            text-align: center;
            color: #a855f7;
            font-size: 15px;
        }

        .dropdown-menu-custom .logout-btn {
            color: #f87171;
        }

        .dropdown-menu-custom .logout-btn i {
            color: #f87171;
        }

        .dropdown-menu-custom .logout-btn:hover {
            background: rgba(239, 68, 68, 0.12);
            color: #fca5a5;
        }

        /* ===== CONTENT AREA ===== */
        .content {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
            position: relative;
        }

        /* Floating orbs background */
        .content::before,
        .content::after {
            content: '';
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        .content::before {
            width: 300px;
            height: 300px;
            background: rgba(147, 51, 234, 0.06);
            filter: blur(80px);
            top: 10%;
            right: -5%;
            animation: floatOrb 12s ease-in-out infinite;
        }

        .content::after {
            width: 250px;
            height: 250px;
            background: rgba(59, 130, 246, 0.05);
            filter: blur(80px);
            bottom: 10%;
            left: 5%;
            animation: floatOrb 15s ease-in-out infinite reverse;
        }

        .content > * {
            position: relative;
            z-index: 1;
        }

        .page-header {
            margin-bottom: 28px;
        }

        .page-title {
            font-size: 28px;
            font-weight: 800;
            color: #f1f5f9;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            color: #a78bfa;
            font-size: 14px;
            font-weight: 500;
        }

        /* ===== CARDS ===== */
        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            color: #e2e8f0;
        }

        .card-header {
            border: none;
            padding: 18px 24px;
        }

        .card-body {
            padding: 24px;
        }

        .bg-gradient-blue-green {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.5), rgba(59, 130, 246, 0.5)) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        }

        /* ===== TABLES ===== */
        .table {
            color: #d1d5db;
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255, 255, 255, 0.03);
            --bs-table-hover-bg: rgba(147, 51, 234, 0.08);
            --bs-table-border-color: rgba(255, 255, 255, 0.06);
        }

        .table thead {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table thead th {
            background: rgba(124, 58, 237, 0.1);
            color: #c4b5fd;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 14px 16px;
            border: none;
        }

        .table-light {
            --bs-table-bg: rgba(124, 58, 237, 0.1) !important;
            --bs-table-color: #c4b5fd !important;
        }

        .table-light th {
            color: #c4b5fd !important;
            background: rgba(124, 58, 237, 0.1) !important;
        }

        .table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.04);
            vertical-align: middle;
        }

        .table-dark {
            --bs-table-bg: rgba(124, 58, 237, 0.15) !important;
            --bs-table-color: #e9d5ff !important;
        }

        /* ===== FORM ELEMENTS ===== */
        .form-label {
            font-weight: 600;
            color: #d1d5db;
            margin-bottom: 8px;
            font-size: 13px;
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            padding: 12px 16px;
            color: #f1f5f9;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(168, 85, 247, 0.5);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.15);
            color: #f1f5f9;
        }

        .form-select option {
            background: #1a1a2e;
            color: #f1f5f9;
        }

        .form-text {
            color: rgba(167, 139, 250, 0.6) !important;
        }

        .invalid-feedback {
            color: #f87171;
        }

        .is-invalid {
            border-color: rgba(248, 113, 113, 0.5) !important;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            border: none;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(124, 58, 237, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9, #2563eb);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(124, 58, 237, 0.5);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 12px;
            color: #d1d5db;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #f1f5f9;
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706, #dc2626);
            transform: translateY(-2px);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-2px);
        }

        .btn-outline-danger {
            border-color: rgba(248, 113, 113, 0.4);
            color: #f87171;
        }

        .btn-outline-danger:hover {
            background: rgba(239, 68, 68, 0.15);
            border-color: #f87171;
            color: #fca5a5;
        }

        /* ===== ALERTS ===== */
        .alert {
            border-radius: 14px;
            border: none;
            backdrop-filter: blur(12px);
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.15);
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        .alert .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* ===== BADGES ===== */
        .badge.bg-danger {
            background: rgba(239, 68, 68, 0.2) !important;
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.3);
            font-weight: 600;
        }

        .badge.bg-warning {
            background: rgba(245, 158, 11, 0.2) !important;
            color: #fcd34d;
            border: 1px solid rgba(245, 158, 11, 0.3);
            font-weight: 600;
        }

        .badge.bg-success {
            background: rgba(34, 197, 94, 0.2) !important;
            color: #86efac;
            border: 1px solid rgba(34, 197, 94, 0.3);
            font-weight: 600;
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 300px;
            text-align: center;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 16px;
            padding: 40px;
            border: 2px dashed rgba(147, 51, 234, 0.15);
        }

        .empty-state i {
            font-size: 56px;
            color: rgba(168, 85, 247, 0.3);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            color: #d1d5db;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .empty-state p {
            color: #9ca3af;
            font-size: 14px;
        }

        /* ===== PAGINATION ===== */
        .pagination .page-link {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #c4b5fd;
            border-radius: 8px;
            margin: 0 2px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: rgba(147, 51, 234, 0.2);
            border-color: rgba(147, 51, 234, 0.3);
            color: #e9d5ff;
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 12px rgba(124, 58, 237, 0.3);
        }

        .pagination .page-item.disabled .page-link {
            background: rgba(255, 255, 255, 0.02);
            color: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.04);
        }

        /* ===== AVATAR SMALL ===== */
        .avatar-small {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
            box-shadow: 0 4px 10px rgba(124, 58, 237, 0.2);
        }

        /* ===== MISC ===== */
        .text-primary {
            color: #a855f7 !important;
        }

        .text-success {
            color: #4ade80 !important;
        }

        .text-danger {
            color: #f87171 !important;
        }

        .text-muted {
            color: #9ca3af !important;
        }

        .text-warning {
            color: #fbbf24 !important;
        }

        .text-info {
            color: #38bdf8 !important;
        }

        hr {
            border-color: rgba(255, 255, 255, 0.08);
            opacity: 1;
        }

        a.text-primary:hover {
            color: #c084fc !important;
        }

        /* ===== LIST ITEMS ===== */
        .list-unstyled li {
            margin-bottom: 12px;
            font-size: 14px;
            color: #d1d5db;
        }

        .list-unstyled li strong {
            color: #f1f5f9;
        }

        /* ===== SCROLLBAR ===== */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(168, 85, 247, 0.3);
            border-radius: 4px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(168, 85, 247, 0.5);
        }

        /* ===== CUSTOM TOOLTIPS ===== */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: calc(100% + 8px);
            left: 50%;
            transform: translateX(-50%) translateY(6px);
            background: rgba(15, 15, 35, 0.95);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            color: #e9d5ff;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.3px;
            padding: 6px 12px;
            border-radius: 8px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(168, 85, 247, 0.3);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4), 0 0 15px rgba(147, 51, 234, 0.15);
            z-index: 9999;
        }

        [data-tooltip]::before {
            content: '';
            position: absolute;
            bottom: calc(100% + 2px);
            left: 50%;
            transform: translateX(-50%) translateY(6px);
            border: 5px solid transparent;
            border-top-color: rgba(168, 85, 247, 0.3);
            pointer-events: none;
            opacity: 0;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 9999;
        }

        [data-tooltip]:hover::after {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        [data-tooltip]:hover::before {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 999;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .navbar-top {
                padding: 0 16px;
            }

            .content {
                padding: 20px;
            }

            .page-title {
                font-size: 22px;
            }

            [data-tooltip]::after,
            [data-tooltip]::before {
                display: none;
            }
        }
    </style>
    @yield('extra_css')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="#" class="sidebar-logo">
                    <div class="logo-icon" style="overflow: hidden;">
                        <img src="{{ asset('logo.png') }}" alt="Logo PAZPUS" style="width: 100%; height: 100%; object-fit: cover; border-radius: 14px;" onerror="this.outerHTML='<div style=\'display:flex;align-items:center;justify-content:center;width:100%;height:100%;background:linear-gradient(135deg, #7c3aed, #3b82f6);\'><i class=\'fas fa-book\' style=\'color:white;font-size:20px;\'></i></div>'">
                    </div>
                    <span class="logo-text">PAZPUS</span>
                </a>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-label">Menu Utama</li>
                <li>
                    <a href="{{ url('/dashboard') }}" class="@if(request()->is('dashboard')) active @endif">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/perpustakaan/cari-rak') }}" class="@if(request()->is('perpustakaan/cari-rak*')) active @endif">
                        <i class="fas fa-search-location"></i>
                        <span>Cari Rak Buku</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/perpustakaan/siswa') }}" class="@if(request()->is('perpustakaan/siswa*')) active @endif">
                        <i class="fas fa-user-graduate"></i>
                        <span>Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/perpustakaan/buku') }}" class="@if(request()->is('perpustakaan/buku*')) active @endif">
                        <i class="fas fa-book-open"></i>
                        <span>Buku</span>
                    </a>
                </li>
                <li class="menu-label">Transaksi</li>
                <li>
                    <a href="{{ url('/perpustakaan/peminjaman') }}" class="@if(request()->is('perpustakaan/peminjaman*')) active @endif">
                        <i class="fas fa-exchange-alt"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li class="menu-label">Laporan</li>
                <li>
                    <a href="{{ url('/perpustakaan/laporan/histori-denda') }}" class="@if(request()->is('perpustakaan/laporan/histori-denda*') || request()->is('perpustakaan/laporan/denda-siswa*')) active @endif">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Histori Denda</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/perpustakaan/laporan/denda-bulanan') }}" class="@if(request()->is('perpustakaan/laporan/denda-bulanan*')) active @endif">
                        <i class="fas fa-chart-bar"></i>
                        <span>Rekap Denda</span>
                    </a>
                </li>
                <li class="menu-label">Sistem</li>
                <li>
                    <a href="{{ url('/perpustakaan/user') }}" class="@if(request()->is('perpustakaan/user*')) active @endif">
                        <i class="fas fa-users"></i>
                        <span>User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/perpustakaan/pengaturan') }}" class="@if(request()->is('perpustakaan/pengaturan*')) active @endif">
                        <i class="fas fa-cog"></i>
                        <span>Pengaturan Denda</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navigation -->
            <nav class="navbar-top">
                <h1 class="navbar-title">@yield('judul', 'Dashboard')</h1>
                
                <div class="navbar-profile">
                    <div class="profile-dropdown" id="profileDropdown">
                        <div class="avatar">
                            @if(Auth::check() && Auth::user()->foto)
                                <img src="{{ asset('uploads/profile/' . Auth::user()->foto) }}" alt="Foto">
                            @else
                                <i class="fas fa-user"></i>
                            @endif
                        </div>
                        <div>
                            <div class="profile-name">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</div>
                            <div class="profile-role">{{ Auth::check() ? ucfirst(Auth::user()->role ?? 'admin') : 'Admin' }}</div>
                        </div>
                        <i class="fas fa-chevron-down" style="font-size: 11px; color: #a78bfa;"></i>

                        <div class="dropdown-menu-custom" id="dropdownMenu">
                            @if(Auth::check())
                            <div class="dropdown-user-info">
                                <div class="user-name">{{ Auth::user()->name }}</div>
                                <div class="user-email">{{ Auth::user()->email }}</div>
                            </div>
                            @endif
                            <a href="{{ route('profile.show') }}">
                                <i class="fas fa-user-cog"></i>
                                Profile Setting
                            </a>
                            <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="button" class="logout-btn" onclick="confirmLogout()">
                                    <i class="fas fa-sign-out-alt"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Content Area -->
            <div class="content">
                @yield('content')

                <!-- Default Empty Content -->
               
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Profile Dropdown Toggle
        const profileDropdown = document.getElementById('profileDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');

        profileDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileDropdown.contains(e.target)) {
                dropdownMenu.classList.remove('show');
            }
        });

        // Set active menu item berdasarkan URL atau klik
        const menuItems = document.querySelectorAll('.sidebar-menu a');
        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // Hapus class active dari semua item
                menuItems.forEach(i => i.classList.remove('active'));
                // Tambahkan class active ke item yang diklik
                this.classList.add('active');
            });
        });

        // Logout Confirmation
        function confirmLogout() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: 'Anda akan keluar dari sistem PAZPUS',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: '<i class="fas fa-sign-out-alt"></i> Ya, Logout',
                cancelButtonText: '<i class="fas fa-times"></i> Batal',
                background: '#1a1a2e',
                color: '#f1f5f9',
                customClass: {
                    popup: 'swal-dark-popup',
                    title: 'swal-dark-title',
                    confirmButton: 'swal-confirm-btn',
                    cancelButton: 'swal-cancel-btn'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logoutForm').submit();
                }
            });
        }
    </script>
    @yield('extra_js')
</body>
</html>
