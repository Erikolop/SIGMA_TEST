<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIGMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { display: flex; align-items: center; justify-content: center; min-height: 100vh; background: #f9fafb; }
        .register-box { width: 100%; max-width: 420px; }
        .form-group-custom { position: relative; }
        .form-group-custom i { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; }
        .form-control { background: #e5e7eb; border: none; border-radius: 12px; padding: 14px 20px 14px 50px; font-size: 14px; }
        .form-control::placeholder { color: #9ca3af; }
        .form-control:focus { background: #e5e7eb; box-shadow: 0 0 0 2px #3f3d8f; }
        .btn-register { background: #2e2a85; color: white; border-radius: 25px; padding: 14px; width: 100%; font-weight: bold; margin-top: 20px; border: none; transition: all 0.3s ease; }
        .btn-register:hover { background: #1e1b5c; color: white; transform: translateY(-1px); }
        label { font-size: 12px; letter-spacing: 0.5px; }
    </style>
</head>
<body>
    <div class="register-box p-4">
        <div class="text-center mb-4">
            <img src="{{ asset('images/logosigma.png') }}" class="img-fluid mb-3" style="max-height: 120px; width: auto;" alt="Logo SIGMA">
            <h3 class="fw-bold text-uppercase" style="letter-spacing: 0.5px; color: #111827;">CREATE ACCOUNT</h3>
        </div>

        @if($errors->any())
            <div class="alert alert-danger" style="border-radius: 12px; font-size: 13px;">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">FULL NAME</label>
                <div class="form-group-custom">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">EMAIL ADDRESS</label>
                <div class="form-group-custom">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="Contoh: user@gmail.com" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">ROLE</label>
                <div class="form-group-custom">
                    <i class="fa-solid fa-shield-halved"></i>
                    <select name="role" class="form-control" style="padding-left: 50px;" required>
                        <option value="Staff" {{ old('role') == 'Staff' ? 'selected' : '' }}>Staff</option>
                        <option value="Admin" {{ old('role') == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            </div>

            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">PASSWORD</label>
                <div class="form-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" required minlength="6">
                </div>
            </div>

            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">CONFIRM PASSWORD</label>
                <div class="form-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn btn-register shadow-sm">Register</button>
        </form>

        <div class="text-center mt-3">
            <small class="text-muted">Sudah punya akun? <a href="{{ route('login') }}" style="color: #3f3d8f; font-weight: 600;">Login di sini</a></small>
        </div>
    </div>
</body>
</html>
