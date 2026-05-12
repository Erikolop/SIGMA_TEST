<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIGMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; align-items: center; justify-content: center; height: 100vh; background: #fff; }
        .login-box { width: 100%; max-width: 400px; text-align: center; }
        .form-control { background: #f3f4f6; border: none; border-radius: 50px; padding: 12px 20px; }
        .btn-login { background: #3f3d8f; color: white; border-radius: 50px; padding: 12px; width: 100%; font-weight: bold; margin-top: 20px; }
        .btn-login:hover { background: #323075; color: white; }
    </style>
</head>
<body>
    <div class="login-box p-4">
        <img src="https://www.advotics.com/wp-content/uploads/2022/11/Sistem-Inventory-Cari-Tahu-Jenis-Manfaatnya-Bagi-Kegiatan-Usaha-01-300x162.png" class="img-fluid mb-4" style="height: 180px;">
        <h3 class="fw-bold mb-4">WELCOME TO SIGMA</h3>
        <form id="loginForm">
            <div class="text-start mb-3">
                <label class="small fw-bold text-muted ms-2 mb-1">USERNAME</label>
                <input type="text" id="usernameInput" class="form-control" placeholder="Enter your username (ketik 'staff' u/ Staff)">
            </div>
            <div class="text-start mb-4">
                <label class="small fw-bold text-muted ms-2 mb-1">PASSWORD</label>
                <input type="password" class="form-control" placeholder="••••••••">
            </div>
            <button type="button" class="btn btn-login shadow" onclick="handleLogin()">Login</button>
        </form>
    </div>

    <script>
        function handleLogin() {
            const username = document.getElementById('usernameInput').value.toLowerCase();
            
            if (username === 'staff') {
                window.location.href = '/staff/dashboard'; // Lari ke staff
            } else {
                window.location.href = '/dashboard'; // Default lari ke admin
            }
        }
    </script>
</body>
</html>