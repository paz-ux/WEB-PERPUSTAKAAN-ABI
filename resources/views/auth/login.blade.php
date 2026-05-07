<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PAZPUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
            0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.5; }
            33% { transform: translate(40px, -30px) scale(1.1); opacity: 0.7; }
            66% { transform: translate(-30px, 20px) scale(0.9); opacity: 0.4; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(147, 51, 234, 0.3); }
            to { box-shadow: 0 0 40px rgba(147, 51, 234, 0.6); }
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 25%, #0f0f23 50%, #1a1a2e 75%, #16213e 100%);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            position: relative;
            overflow: hidden;
        }

        /* Animated background orbs */
        .bg-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }

        .bg-orb-1 {
            width: 400px;
            height: 400px;
            background: rgba(147, 51, 234, 0.15);
            top: -100px;
            right: -100px;
            animation: floatOrb 8s ease-in-out infinite;
        }

        .bg-orb-2 {
            width: 350px;
            height: 350px;
            background: rgba(59, 130, 246, 0.12);
            bottom: -80px;
            left: -80px;
            animation: floatOrb 10s ease-in-out infinite reverse;
        }

        .bg-orb-3 {
            width: 200px;
            height: 200px;
            background: rgba(168, 85, 247, 0.1);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation: floatOrb 12s ease-in-out infinite;
            animation-delay: 3s;
        }

        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            margin: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border-radius: 28px;
            padding: 48px 40px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4), 0 0 40px rgba(124, 58, 237, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideUp 0.6s ease-out;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-logo .icon-wrapper {
            width: 76px;
            height: 76px;
            border-radius: 22px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 30px rgba(124, 58, 237, 0.5);
            animation: glow 3s ease-in-out infinite alternate;
        }

        .login-logo .icon-wrapper i {
            font-size: 34px;
            color: white;
        }

        .login-logo h1 {
            font-size: 26px;
            font-weight: 800;
            background: linear-gradient(135deg, #e879f9, #a855f7, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 6px;
            letter-spacing: -0.5px;
        }

        .login-logo p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 14px;
            font-weight: 400;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            font-weight: 600;
            color: rgba(255, 255, 255, 0.7);
            font-size: 13px;
            margin-bottom: 8px;
            display: block;
            letter-spacing: 0.3px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i.fa-envelope,
        .input-group-custom i.fa-lock {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(168, 85, 247, 0.5);
            font-size: 16px;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .input-group-custom input {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 14px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.07);
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
        }

        .input-group-custom input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .input-group-custom input:focus {
            outline: none;
            border-color: rgba(168, 85, 247, 0.5);
            box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.15);
            background: rgba(255, 255, 255, 0.1);
        }

        .input-group-custom input:focus ~ i.fa-envelope,
        .input-group-custom input:focus ~ i.fa-lock {
            color: #a855f7;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(168, 85, 247, 0.4);
            cursor: pointer;
            font-size: 16px;
            z-index: 2;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #a855f7;
        }

        .remember-row {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-row input[type="checkbox"] {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            accent-color: #7c3aed;
            margin-right: 10px;
            cursor: pointer;
        }

        .remember-row label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            margin: 0;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #7c3aed, #3b82f6);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.4);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(124, 58, 237, 0.6);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            border-radius: 14px;
            font-size: 13px;
            padding: 14px 18px;
            border: none;
            margin-bottom: 22px;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            color: #fca5a5;
            border: 1px solid rgba(239, 68, 68, 0.2);
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 36px 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated background orbs -->
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>

    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <div class="icon-wrapper" style="overflow: hidden; background: transparent; box-shadow: none;">
                    <img src="{{ asset('logo.png') }}" alt="Logo PAZPUS" style="width: 100%; height: 100%; object-fit: cover; border-radius: 22px; box-shadow: 0 8px 30px rgba(124, 58, 237, 0.5);" onerror="this.outerHTML='<div class=\'icon-wrapper\'><i class=\'fas fa-book\'></i></div>'">
                </div>
                <h1>PAZPUS</h1>
                <p>Masuk ke sistem PAZPUS</p>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-group-custom">
                        <input type="email" id="email" name="email" placeholder="Masukkan email anda" 
                            value="{{ old('email') }}" required autofocus>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group-custom">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
                        <i class="fas fa-lock"></i>
                        <button type="button" class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="remember-row">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
