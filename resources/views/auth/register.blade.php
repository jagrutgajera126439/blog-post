
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | BlogSphere</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: 'Inter', Arial, sans-serif;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .register-card {
            width: 100%;
            max-width: 440px;
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

        .logo span { color: #2563eb; }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 22px;
            color: #172554;
            margin-bottom: 8px;
        }

        .description {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 24px;
        }

        .form-group { margin-bottom: 18px; }

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

        .register-btn {
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

        .register-btn:hover { background: #1d4ed8; }

        .login-link {
            text-align: center;
            font-size: 13px;
            color: #64748b;
            margin-top: 22px;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 700;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 22px;
        }

        @media (max-width: 480px) {
            .register-card { padding: 28px 22px; }
        }
    </style>
</head>

<body>
    <div class="register-card">

        <div class="logo">Blog<span>Sphere.</span></div>
        <p class="subtitle">Blog Management System</p>

        <h2>Create Account</h2>
        <p class="description">
            Join BlogSphere and start creating your own blogs.
        </p>

        @if($errors->any())
            <div class="error" style="margin-bottom: 15px;">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       placeholder="Minimum 8 characters" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation"
                       name="password_confirmation"
                       placeholder="Confirm your password" required>
            </div>

            <button type="submit" class="register-btn">
                Create My Account
            </button>
        </form>

        <div class="login-link">
            Already have an account?
            <a href="{{ route('login') }}">Login</a>
        </div>

        <div class="footer">
            © {{ date('Y') }} BlogSphere. All rights reserved.
        </div>

    </div>
</body>
</html>
