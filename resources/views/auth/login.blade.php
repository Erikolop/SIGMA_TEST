<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIGMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            height: 100vh; 
            background: #f9fafb; 
        }
        .login-box { 
            width: 100%; 
            max-width: 420px; 
            text-align: center; 
        }
        .form-group-custom {
            position: relative;
        }
        .form-group-custom i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .form-control { 
            background: #e5e7eb; 
            border: none; 
            border-radius: 12px; 
            padding: 14px 20px 14px 50px; 
            font-size: 14px;
        }
        .form-control::placeholder {
            color: #9ca3af;
        }
        .form-control:focus {
            background: #e5e7eb;
            box-shadow: 0 0 0 2px #3f3d8f;
        }
        .btn-login { 
            background: #2e2a85; 
            color: white; 
            border-radius: 25px; 
            padding: 14px; 
            width: 100%; 
            font-weight: bold; 
            margin-top: 25px; 
            border: none;
            transition: all 0.3s ease;
        }
        .btn-login:hover { 
            background: #1e1b5c; 
            color: white; 
            transform: translateY(-1px);
        }
        label {
            font-size: 12px;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="login-box p-4">
        <img src="{{ asset('images/logosigma.png') }}" class="img-fluid mb-3" style="max-height: 180px; width: auto;" alt="Logo SIGMA">
        
        <h3 class="fw-bold mb-4 text-uppercase" style="letter-spacing: 0.5px; color: #111827;">WELCOME TO SIGMA</h3>

        <form action="/login" method="POST" id="loginForm">
            @csrf 
            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">EMAIL ADDRESS</label>
                <div class="form-group-custom">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" name="email" id="emailInput" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" autofocus>
                </div>
            </div>
            
            <div class="text-start mb-3">
                <label class="fw-bold text-muted ms-2 mb-1">PASSWORD</label>
                <div class="form-group-custom">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" id="passwordInput" class="form-control" placeholder="••••••••">
                    <i class="fa-regular fa-eye" id="togglePassword" style="left: auto; right: 20px; cursor: pointer;"></i>
                </div>
            </div>
            
            <button type="submit" class="btn btn-login shadow-sm">Login</button>
        </form>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>