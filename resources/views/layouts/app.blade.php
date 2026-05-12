<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SIGMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --sigma-purple: #3f3d8f; --sigma-bg: #f8f9fc; }
        body { background-color: var(--sigma-bg); font-family: 'Inter', sans-serif; overflow-x: hidden; }
        .sidebar { width: 250px; height: 100vh; position: fixed; background: white; border-right: 1px solid #eee; z-index: 1000; display: flex; flex-direction: column; }
        .sidebar-brand { padding: 25px 25px 15px; font-weight: 900; font-size: 24px; color: #111; letter-spacing: 0.5px; }
        .nav-link { color: #555; padding: 12px 25px; display: flex; align-items: center; gap: 12px; transition: 0.2s; font-weight: 500; font-size: 15px; }
        .nav-link:hover { color: var(--sigma-purple); background: #f8f9fc; }
        .nav-link.active { color: var(--sigma-purple); background: #f4f4ff; border-right: 4px solid var(--sigma-purple); font-weight: 600; }
        .main-content { margin-left: 250px; min-height: 100vh; display: flex; flex-direction: column; }
        .top-header { background: var(--sigma-purple); color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">SIGMA</div>
        
        <div class="flex-grow-1 overflow-auto mt-2">
            <nav class="nav flex-column">
                
                @if(request()->is('staff*'))
                    <a class="nav-link {{ request()->is('staff/dashboard') ? 'active' : '' }}" href="/staff/dashboard">
                        <i class="fas fa-th-large" style="width: 20px; text-align: center;"></i> Dashboard
                    </a>
                    
                    <a class="nav-link {{ request()->is('staff/item-management') ? 'active' : '' }}" href="/staff/item-management">
                        <i class="fas fa-shopping-cart" style="width: 20px; text-align: center;"></i> Item Management
                    </a>
                    
                    <a class="nav-link {{ request()->is('staff/activity-log') ? 'active' : '' }}" href="/staff/activity-log">
                        <i class="fas fa-chart-line" style="width: 20px; text-align: center;"></i> Activity Log
                    </a>

                @else
                    <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                        <i class="fas fa-th-large" style="width: 20px; text-align: center;"></i> Dashboard
                    </a>
                    
                    <a class="nav-link {{ request()->is('category-detail') ? 'active' : '' }}" href="/category-detail">
                        <i class="fas fa-shopping-cart" style="width: 20px; text-align: center;"></i> Tambah barang
                    </a>
                    
                    <a class="nav-link {{ request()->is('category-management') ? 'active' : '' }}" href="/category-management">
                        <i class="fas fa-box" style="width: 20px; text-align: center;"></i> Category Management
                    </a>
                    
                    <a class="nav-link {{ request()->is('staff-management') ? 'active' : '' }}" href="/staff-management">
                        <i class="fas fa-users" style="width: 20px; text-align: center;"></i> Staff Management
                    </a>
                    
                    <a class="nav-link {{ request()->is('activity-log') ? 'active' : '' }}" href="/activity-log">
                        <i class="fas fa-chart-line" style="width: 20px; text-align: center;"></i> Activity Log
                    </a>
                @endif
            </nav>

            <div class="text-center mt-5 mb-3 px-3">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/online-shopping-and-logistics-3463999-2917719.png" class="img-fluid" alt="Illustration">
            </div>
        </div>

        <div class="p-4 border-top bg-white mt-auto">
            <div class="d-flex align-items-center gap-3">
                <img src="https://ui-avatars.com/api/?name={{ request()->is('staff*') ? 'S' : 'D' }}&background=111&color=fff" class="rounded-circle shadow-sm" width="45" height="45">
                <div>
                    <div class="fw-bold" style="font-size: 14px; color: #111;">{{ request()->is('staff*') ? 'STAFF' : 'DAFFA' }}</div>
                    <div class="text-muted" style="font-size: 11px;">{{ request()->is('staff*') ? 'Staff' : 'Administrator' }}<br>V1.0</div>
                </div>
            </div>
            <a href="/login" class="text-primary text-decoration-none mt-3 d-flex align-items-center gap-2" style="font-size: 13px; font-weight: 600;">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-header">
            <h5 class="m-0 fw-semibold tracking-wide">@yield('header_title', 'Dashboard')</h5>
            <a href="/login" class="text-white text-decoration-none small border border-light rounded px-3 py-1 bg-transparent transition d-flex align-items-center gap-2" style="opacity: 0.9;">
                <i class="fas fa-sign-out-alt"></i> Log Out
            </a>
        </div>
        
        <div class="p-5 bg-light flex-grow-1">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>