<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard - SIGMA</title>
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

        /* Sidebar Illustration (Mepet di bawah menu) */
        .sidebar-illustration {
            width: 100%;
            max-width: 180px;
            display: block;
            margin: 25px auto 0 auto; /* Kasih jarak atas sedikit dari Activity Log */
        }

        /* Sidebar Bottom Info */
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

        /* Main Content Styling */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .top-navbar {
            background-color: var(--primary-purple);
            padding: 15px 40px;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .content-body {
            padding: 40px;
        }

        /* Card Styling */
        .stat-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 25px;
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            position: relative;
            height: 100%;
        }

        .stat-card.total-items {
            border-left: 5px solid #2563eb;
        }

        .stat-card.low-stock {
            border-left: 5px solid #b45309;
        }

        .stat-card .card-title-custom {
            font-size: 11px;
            font-weight: 700;
            color: var(--text-muted);
            text-uppercase: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-card .card-value {
            font-size: 36px;
            font-weight: 800;
            color: #111827;
            margin-top: 5px;
        }

        .stat-card .card-icon {
            position: absolute;
            top: 25px;
            right: 25px;
            color: #9ca3af;
            font-size: 18px;
        }

        /* Banner Orange */
        .banner-manage {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 16px;
            padding: 35px;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(217, 119, 6, 0.2);
            margin-top: 30px;
        }

        .banner-manage h4 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 22px;
        }

        .btn-manage-action {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 8px 24px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: background 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-manage-action:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        /* Table Styling */
        .table-container {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 30px;
            margin-top: 40px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .table-container h5 {
            font-weight: 700;
            color: #1e1b4b;
            margin-bottom: 25px;
        }

        .custom-table th {
            font-size: 11px;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid #f3f4f6;
            padding: 15px 10px;
        }

        .custom-table td {
            font-size: 14px;
            padding: 20px 10px;
            vertical-align: middle;
            border-bottom: 1px solid #f3f4f6;
            color: #4b5563;
        }

        .custom-table tr:last-child td {
            border-bottom: none;
        }

        .fw-bold-dark {
            font-weight: 700;
            color: #111827;
        }

        .text-danger-custom {
            color: #dc2626;
            font-weight: 700;
        }

        .text-warning-custom {
            color: #d97706;
            font-weight: 700;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-brand">SIGMA</div>
            <div class="nav-menu">
                <a href="/staff/dashboard" class="nav-link-custom active">
                    <i class="fa-solid fa-table-cells-large"></i> Dashboard
                </a>
                <a href="/staff/item-management" class="nav-link-custom">
                    <i class="fa-solid fa-cart-shopping"></i> Item Management
                </a>
                <a href="/staff/activity-log" class="nav-link-custom">
                    <i class="fa-solid fa-chart-line"></i> Activity Log
                </a>
            </div>
            
            <img src="{{ asset('images/fotodbkiri.png') }}" class="sidebar-illustration" alt="Gudang Illustration">
        </div>

        <div class="sidebar-bottom">
            <div class="user-profile-section">
                <div class="user-info">
                    <h6>Randi</h6>
                    <span>Staff<br>V1.0</span>
                </div>
                <img src="https://ui-avatars.com/api/?name=Randi&background=111827&color=fff" class="rounded-circle" style="width: 40px; height: 40px;" alt="Avatar Randi">
            </div>

            <a href="/" class="btn-logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-navbar">
            Dashboard
        </div>

        <div class="content-body">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card total-items">
                        <span class="card-title-custom">Total Items</span>
                        <div class="card-value">100</div>
                        <i class="fa-regular fa-clipboard card-icon"></i>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card low-stock">
                        <span class="card-title-custom">Low Stock</span>
                        <div class="card-value">12</div>
                        <i class="fa-solid fa-triangle-exclamation card-icon"></i>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="banner-manage">
                        <h4>Item Management</h4>
                        <a href="/staff/item-management" class="btn-manage-action">Manage Your Item</a>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <h5>Current Stock Status</h5>
                <div class="table-responsive">
                    <table class="table custom-table mb-0">
                        <thead>
                            <tr>
                                <th style="width: 25%">Item ID</th>
                                <th style="width: 30%">Name</th>
                                <th style="width: 25%">Category</th>
                                <th style="width: 20%">Stock Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>item_223</td>
                                <td class="fw-bold-dark">Kayu Jati</td>
                                <td>Furniture</td>
                                <td class="fw-bold-dark">452</td>
                            </tr>
                            <tr>
                                <td>item_226</td>
                                <td class="fw-bold-dark">Kabel</td>
                                <td>Elektronik</td>
                                <td class="text-warning-custom">2000</td>
                            </tr>
                            <tr>
                                <td>item_220</td>
                                <td class="fw-bold-dark">Kaca</td>
                                <td>Optik</td>
                                <td class="text-danger-custom">0</td>
                            </tr>
                            <tr>
                                <td>item_229</td>
                                <td class="fw-bold-dark">Cat</td>
                                <td>Material</td>
                                <td class="fw-bold-dark">1,024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</body>
</html>