
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Login | BlogSphere</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 15px 45px rgba(15, 23, 42, .09);
        }

        .logo {
            text-align: center;
            font-size: 29px;
            font-weight: 800;
            color: #172554;
            margin-bottom: 10px;
        }

        .logo span {
            color: #2563eb;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 32px;
        }

        h2 {
            font-size: 22px;
            color: #172554;
            margin-bottom: 8px;
        }

        .description {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 19px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .login-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
        }

        .login-btn:hover {
            background: #1d4ed8;
        }

        .forgot-password-link {
            text-align: right;
            margin: -7px 0 16px;
            font-size: 13px;
        }

        .forgot-password-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 25px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 28px 22px;
            }
        }
    </style>
</head>

<body>

    <div class="login-card">

        <div class="logo">
            Blog<span>Sphere.</span>
        </div>

        <p class="subtitle">Blog Management System</p>

        <h2>Account Login</h2>
        <p class="description">Sign in to continue to your BlogSphere dashboard.</p>

        @if(session('status'))
            <div style="background:#dcfce7;color:#166534;padding:12px;border-radius:8px;margin-bottom:15px;font-size:13px;">{{ session('status') }}</div>
        @endif

        @if($errors->any())
            <div class="error" style="margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <div class="forgot-password-link">
                <a href="{{ route('password.request') }}">Forgot password?</a>
            </div>

            <button type="submit" class="login-btn">
                Sign In to Dashboard
            </button>

        </form>

        <div class="footer">
            © {{ date('Y') }} BlogSphere. All rights reserved.
        </div>

    </div>

</body>
</html>
