<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management - Staff</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-purple: #3f3d8f;
            --dark-navy: #0b093b;
            --bg-light: #f4f5f9;
            --text-muted: #888888;
        }
        body { background-color: var(--bg-light); font-family: 'Segoe UI', sans-serif; overflow-x: hidden; }
        
        /* Sidebar Styling */
        .sidebar { width: 260px; height: 100vh; position: fixed; top: 0; left: 0; background-color: #ffffff; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; justify-content: space-between; padding-bottom: 20px; z-index: 100; }
        .sidebar-brand { padding: 25px 30px; font-size: 22px; font-weight: 800; color: #111827; }
        .nav-menu { padding: 0 15px; }
        .nav-link-custom { display: flex; align-items: center; padding: 14px 20px; color: var(--text-muted); text-decoration: none; font-weight: 600; font-size: 14px; border-radius: 8px; margin-bottom: 8px; transition: all 0.2s ease; }
        .nav-link-custom i { margin-right: 15px; font-size: 18px; width: 20px; text-align: center; }
        .nav-link-custom:hover { background-color: #f3f4f6; color: var(--primary-purple); }
        .nav-link-custom.active { background-color: #eff6ff; color: #2563eb; border-right: 4px solid #2563eb; border-radius: 8px 0 0 8px; }
        .sidebar-illustration { width: 100%; max-width: 180px; display: block; margin: 25px auto 0 auto; }
        
        /* Sidebar Bottom */
        .sidebar-bottom { padding: 0 20px; }
        .user-profile-section { display: flex; align-items: center; justify-content: space-between; padding-top: 15px; border-top: 1px solid #e5e7eb; margin-bottom: 15px; }
        .user-info h6 { margin: 0; font-weight: 700; color: #111827; font-size: 14px; }
        .user-info span { font-size: 12px; color: var(--text-muted); }
        .btn-logout { color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 600; display: flex; align-items: center; gap: 8px; }
        
        /* Main Content */
        .main-content { margin-left: 260px; min-height: 100vh; }
        .top-navbar { background-color: var(--primary-purple); padding: 15px 40px; color: white; font-weight: 700; font-size: 18px; text-align: center; letter-spacing: 0.5px; }
        .content-body { padding: 40px; }
        
        /* Table Controls & Styling */
        .search-input { background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 8px 16px; font-size: 14px; width: 280px; }
        .btn-catat { background-color: var(--dark-navy); color: white; border-radius: 8px; padding: 10px 24px; font-weight: 700; font-size: 14px; border: none; transition: background 0.2s; }
        .btn-catat:hover { background-color: #151259; color: white; }
        
        .table-container { background-color: #ffffff; border-radius: 16px; padding: 30px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); }
        .custom-table th { font-size: 12px; font-weight: 700; color: #111827; text-transform: uppercase; border-bottom: 2px solid #f3f4f6; padding: 15px 10px; }
        .custom-table td { font-size: 14px; padding: 18px 10px; border-bottom: 1px solid #f3f4f6; color: #4b5563; }
        
        /* Modal Custom Style matching Figma */
        .modal-content-custom { border-radius: 20px; border: none; padding: 25px; }
        .modal-title-custom { color: #3b82f6; font-weight: 700; letter-spacing: 0.5px; font-size: 24px; text-transform: uppercase; }
        .modal-subtitle-custom { color: #9ca3af; font-size: 12px; font-style: italic; margin-top: -5px; display: block; }
        .form-label-custom { font-size: 11px; font-weight: 700; color: #6b7280; letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 8px; }
        .form-control-custom { border: 2px solid #d1d5db; border-radius: 8px; padding: 12px 16px; font-size: 14px; color: #1f2937; }
        .form-control-custom::placeholder { color: #9ca3af; font-style: italic; }
        .form-control-custom:focus { border-color: #3b82f6; box-shadow: none; }
        .btn-tambah-link { color: #3b82f6; text-decoration: underline; font-weight: 600; font-size: 14px; background: none; border: none; padding: 0; }
        .btn-kirim { background-color: #2563eb; color: white; border-radius: 8px; padding: 14px; font-weight: 700; width: 160px; font-size: 14px; border: none; letter-spacing: 0.5px; text-transform: uppercase; }
        .btn-kirim:hover { background-color: #1d4ed8; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-brand">SIGMA</div>
            <div class="nav-menu">
                <a href="/staff/dashboard" class="nav-link-custom">
                    <i class="fa-solid fa-table-cells-large"></i> Dashboard
                </a>
                <a href="/staff/item-management" class="nav-link-custom active">
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
                <img src="https://ui-avatars.com/api/?name=Randi&background=111827&color=fff" class="rounded-circle" style="width: 40px; height: 40px;" alt="Avatar">
            </div>
            <a href="/" class="btn-logout">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Log Out
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="top-navbar">Item Management</div>
        
        <div class="content-body">
            
            <div id="notifSuksesStaff" class="alert alert-success alert-dismissible fade show d-none mb-3 shadow-sm" role="alert" style="border-radius: 8px; font-size: 14px; max-width: 350px; background-color: #d1e7dd; border-color: #badbcc; color: #0f5132; font-weight: 600;">
                <i class="fa-solid fa-circle-check me-2"></i> Item berhasil ditambahkan
                <button type="button" class="btn-close" style="padding: 1rem 1rem; font-size: 10px;" onclick="tutupNotifStaff()"></button>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="position-relative">
                    <input type="text" class="search-input" placeholder="Search">
                </div>
                <button type="button" class="btn btn-catat shadow-sm" data-bs-toggle="modal" data-bs-target="#formInventarisModal">
                    Catat Transaksi
                </button>
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table custom-table mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="width: 30%">Nama Item</th>
                                <th style="width: 30%">Category Item</th>
                                <th style="width: 25%">Stock Item</th>
                                <th style="width: 15%" class="text-center">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="fw-bold text-dark">Oli Mesin</th>
                                <td>Spare Part Leopard</td>
                                <td>0</td>
                                <td class="text-center"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                            </tr>
                            <tr>
                                <th class="fw-bold text-dark">Uranium-235</th>
                                <td>Bahan Nuklir</td>
                                <td>25</td>
                                <td class="text-center"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                            </tr>
                            <tr>
                                <th class="fw-bold text-dark">Iphone 15</th>
                                <td>Elektronik</td>
                                <td>40</td>
                                <td class="text-center"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                            </tr>
                            <tr>
                                <th class="fw-bold text-dark">Pelor 5.56mm</th>
                                <td>Persenjataan ABRI</td>
                                <td>60</td>
                                <td class="text-center"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                            </tr>
                            <tr>
                                <th class="fw-bold text-dark">Router Starlink</th>
                                <td>Elektronik</td>
                                <td>30</td>
                                <td class="text-center"><button class="btn btn-link text-dark p-0"><i class="fa-solid fa-pen"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formInventarisModal" tabindex="-1" aria-labelledby="formInventarisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-custom">
                <div class="text-center mb-4 position-relative">
                    <h4 class="modal-title-custom m-0" id="formInventarisModalLabel">Formulir Inventaris Produk</h4>
                    <span class="modal-subtitle-custom">SIGMA</span>
                    <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form id="formTambahBarangStaff" onsubmit="prosesTambahStaff(event)">
                    <div class="mb-4">
                        <label class="form-label form-label-custom">Nama Produk</label>
                        <input type="text" class="form-control form-control-custom w-100" required placeholder="Contoh: Meja Kerja Kayu Jati">
                    </div>

                    <div class="mb-4">
                        <label class="form-label form-label-custom">Jumlah Unit</label>
                        <input type="number" class="form-control form-control-custom w-100" required placeholder="0" min="1">
                    </div>

                    <div class="mb-4">
                        <label class="form-label form-label-custom">Tipe Kelola</label>
                        <input type="text" class="form-control form-control-custom w-100" required placeholder="Contoh: Keluar atau Masuk">
                    </div>

                    <div class="text-center mb-4">
                        <button type="button" class="btn-tambah-link">+ Tambah Produk Lainnya</button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn-kirim shadow-sm">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function prosesTambahStaff(event) {
            event.preventDefault(); // Mengunci form agar tidak refresh/error

            // Sembunyikan pop-up formulir
            var modalElemen = document.getElementById('formInventarisModal');
            var modalInstance = bootstrap.Modal.getInstance(modalElemen);
            modalInstance.hide();

            // Munculkan alert hijau manis tepat di atas kolom search
            var notif = document.getElementById('notifSuksesStaff');
            notif.classList.remove('d-none');

            // Bersihkan form isi agar kembali suci
            document.getElementById('formTambahBarangStaff').reset();
        }

        function tutupNotifStaff() {
            var notif = document.getElementById('notifSuksesStaff');
            notif.classList.add('d-none');
        }
    </script>
</body>
</html>