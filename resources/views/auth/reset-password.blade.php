<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | BlogSphere</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; padding: 20px; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: #172554; font-family: Inter, Arial, sans-serif; }
        .card { width: 100%; max-width: 440px; padding: 38px; background: #fff; border-radius: 18px; box-shadow: 0 15px 45px rgba(15,23,42,.09); }
        .logo { margin-bottom: 10px; text-align: center; font-size: 29px; font-weight: 800; }
        .logo span { color: #2563eb; }
        h1 { margin: 22px 0 8px; font-size: 22px; }
        .description { margin: 0 0 24px; color: #64748b; font-size: 14px; line-height: 1.6; }
        .field { margin-bottom: 17px; }
        label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; }
        input { width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; }
        input:focus { outline: 3px solid #dbeafe; border-color: #2563eb; }
        .message { margin: 0 0 16px; padding: 12px; border-radius: 8px; background: #fee2e2; color: #991b1b; font-size: 13px; }
        button { width: 100%; margin-top: 4px; padding: 14px; border: 0; border-radius: 8px; background: #2563eb; color: #fff; font-size: 15px; font-weight: 700; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        .back { margin-top: 20px; text-align: center; font-size: 13px; }
        a { color: #2563eb; font-weight: 600; text-decoration: none; }
        @media (max-width: 480px) { .card { padding: 28px 22px; } }
    </style>
</head>
<body>
    <main class="card">
        <div class="logo">Blog<span>Sphere.</span></div>
        <h1>Set a new password</h1>
        <p class="description">Choose a new password with at least 8 characters.</p>

        @if($errors->any())
            <div class="message" role="alert">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="field">
                <label for="email">Email address</label>
                <input id="email" type="email" name="email" value="{{ old('email', $email) }}" autocomplete="email" required autofocus>
            </div>

            <div class="field">
                <label for="password">New password</label>
                <input id="password" type="password" name="password" autocomplete="new-password" required>
            </div>

            <div class="field">
                <label for="password_confirmation">Confirm new password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password" required>
            </div>

            <button type="submit">Reset password</button>
        </form>

        <div class="back"><a href="{{ route('login') }}">Back to login</a></div>
    </main>
</body>
</html>