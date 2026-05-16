<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIGMA')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-purple: #3f3d8f;
            --dark-purple: #2e2a85;
            --bg-light: #f4f5f9;
            --text-muted: #888888;
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            align-items: stretch;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 20px;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 25px 30px;
            font-size: 22px;
            font-weight: 800;
            color: #111827;
            letter-spacing: 1px;
        }

        .nav-menu {
            padding: 0 15px;
        }

        .nav-link-custom {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: var(--text-muted);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
        }

        .nav-link-custom i {
            margin-right: 15px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .nav-link-custom:hover {
            background-color: #f3f4f6;
            color: var(--primary-purple);
        }

        .nav-link-custom.active {
            background-color: #eff6ff;
            color: #2563eb;
            border-right: 4px solid #2563eb;
            border-radius: 8px 0 0 8px;
        }

        /* Gambar Mepet Di Bawah Menu Activity Log */
        .sidebar-illustration {
            width: 100%;
            max-width: 180px;
            display: block;
            margin: 25px auto 0 auto;
        }

        /* Sidebar Bagian Bawah */
        .sidebar-bottom {
            padding: 0 20px;
        }

        .user-profile-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            margin-bottom: 15px;
        }

        .user-info h6 {
            margin: 0;
            font-weight: 700;
            color: #111827;
            font-size: 14px;
        }

        .user-info span {
            font-size: 12px;
            color: var(--text-muted);
        }

        .btn-logout {
            color: #2563eb;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .top-navbar {
            background-color: var(--primary-purple);
            padding: 15px 40px;
            color: white;
            font-weight: 700;
            font-size: 18px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content-body {
            padding: 40px;
            flex: 1;
        }
    </style>
</head>
<body>

    <div class="wrapper">
        <div class="sidebar">
            <div>
                <div class="sidebar-brand">SIGMA</div>
                <div class="nav-menu">
                    
                    @if(Request::is('staff*'))
                        <a href="/staff/dashboard" class="nav-link-custom {{ Request::is('staff/dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-table-cells-large"></i> Dashboard
                        </a>
                        <a href="/staff/item-management" class="nav-link-custom {{ Request::is('staff/item-management') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i> Item Management
                        </a>
                        <a href="/staff/activity-log" class="nav-link-custom {{ Request::is('staff/activity-log') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-line"></i> Activity Log
                        </a>
                    @else
                        <a href="/dashboard" class="nav-link-custom {{ Request::is('dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-table-cells-large"></i> Dashboard
                        </a>
                        <a href="/admin/item-management" class="nav-link-custom {{ Request::is('*item-management*') ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-shopping"></i> Item Management
                        </a>
                        <a href="/admin/category-management" class="nav-link-custom {{ Request::is('*category-management*') ? 'active' : '' }}">
                            <i class="fa-solid fa-layer-group"></i> Category Management
                        </a>
                        <a href="/admin/staff-management" class="nav-link-custom {{ Request::is('*staff-management*') ? 'active' : '' }}">
                            <i class="fa-solid fa-users"></i> Staff Management
                        </a>
                        <a href="/admin/activity-log" class="nav-link-custom {{ Request::is('*activity-log*') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-line"></i> Activity Log
                        </a>
                    @endif
                </div>
                
                <img src="{{ asset('images/fotodbkiri.png') }}" class="sidebar-illustration" alt="Gudang Illustration">
            </div>

            <div class="sidebar-bottom">
                <div class="user-profile-section">
                    @if(Request::is('staff*'))
                        <div class="user-info">
                            <h6>Randi</h6>
                            <span>Staff<br>V1.0</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Randi&background=111827&color=fff" class="rounded-circle" style="width: 40px; height: 40px;" alt="Avatar Staff">
                    @else
                        <div class="user-info">
                            <h6>Chico</h6>
                            <span>Admin<br>V1.0</span>
                        </div>
                        <img src="https://ui-avatars.com/api/?name=Chico&background=3f3d8f&color=fff" class="rounded-circle" style="width: 40px; height: 40px;" alt="Avatar Admin">
                    @endif
                </div>

                <a href="/" class="btn-logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
                </a>
            </div>
        </div>

        <div class="main-content">
            <div class="top-navbar">
                @yield('header_title', 'Dashboard')
            </div>

            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>