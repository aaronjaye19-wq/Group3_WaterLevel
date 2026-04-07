<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Water Sensor Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            background: linear-gradient(135deg, #d4dfe8 0%, #e8eef5 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            padding: 50px 40px;
            border-radius: 20px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 
                0 20px 40px rgba(0,0,0,0.15),
                0 8px 16px rgba(0,0,0,0.1),
                inset 0 1px 2px rgba(255,255,255,0.9);
            max-width: 420px;
            width: 100%;
        }

        h1 {
            color: #1a3a5a;
            margin-bottom: 10px;
            text-align: center;
            font-size: 32px;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(255,255,255,0.5);
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 35px;
            font-size: 13px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #1a3a5a;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 10px;
            font-size: 14px;
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(245,245,245,0.95) 100%);
            transition: all 0.3s;
            box-shadow: 
                inset 0 2px 4px rgba(0,0,0,0.05),
                0 1px 2px rgba(0,0,0,0.05);
        }

        input:focus {
            outline: none;
            border-color: #2980b9;
            background: white;
            box-shadow: 
                inset 0 2px 4px rgba(0,0,0,0.05),
                0 0 0 4px rgba(41,128,185,0.1);
        }

        input::placeholder {
            color: #aaa;
        }

        .error-message {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 6px;
            display: block;
            font-weight: 500;
        }

        .errors { 
            margin-bottom: 20px;
            padding: 12px 16px;
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border: 1px solid rgba(231,76,60,0.2);
            border-radius: 10px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        .errors ul {
            list-style: none;
        }

        .errors li { 
            color: #c0392b;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 500;
        }

        .errors li:last-child {
            margin-bottom: 0;
        }

        .success {
            background: linear-gradient(135deg, #f1f8f4 0%, #c8e6c9 100%);
            border: 1px solid rgba(46,125,50,0.2);
            color: #1b5e20;
            padding: 14px 16px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(180deg, #2980b9 0%, #1f618d 100%);
            color: white;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            box-shadow: 
                0 4px 12px rgba(41,128,185,0.3),
                0 2px 4px rgba(0,0,0,0.1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        button:hover {
            background: linear-gradient(180deg, #3498db 0%, #2980b9 100%);
            transform: translateY(-2px);
            box-shadow: 
                0 6px 16px rgba(41,128,185,0.4),
                0 4px 8px rgba(0,0,0,0.15);
        }

        button:active {
            transform: translateY(0);
            box-shadow: 
                0 2px 8px rgba(41,128,185,0.3),
                0 1px 2px rgba(0,0,0,0.1);
        }

        .divider {
            text-align: center;
            margin: 30px 0 25px;
            position: relative;
            color: #999;
            font-size: 13px;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(0,0,0,0.1), transparent);
        }

        .divider span {
            position: relative;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            padding: 0 12px;
        }

        .links {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .links a {
            flex: 1;
            color: #2980b9;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            padding: 10px 12px;
            border: 1px solid rgba(41,128,185,0.2);
            border-radius: 8px;
            text-align: center;
            background: linear-gradient(180deg, rgba(255,255,255,0.8) 0%, rgba(245,245,245,0.8) 100%);
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .links a:hover {
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(250,250,250,0.95) 100%);
            border-color: #2980b9;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(41,128,185,0.15);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .register-link p {
            font-size: 13px;
            color: #666;
            margin-bottom: 0;
        }

        .register-link a {
            color: #2980b9;
            text-decoration: none;
            font-weight: 600;
            border: none;
            padding: 0;
            background: none;
            box-shadow: none;
            display: inline;
            width: auto;
            text-align: left;
        }

        .register-link a:hover {
            text-decoration: underline;
            border: none;
            background: none;
            transform: none;
            box-shadow: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 Login</h1>
        <p class="subtitle">Access your water sensor dashboard</p>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="your@email.com">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Sign In</button>
        </form>

        <div class="divider"><span>or</span></div>

        <div class="links">
            <a href="{{ route('forgot-password') }}">Forgot Password?</a>
            <a href="{{ route('register') }}">Create Account</a>
        </div>

        <div class="register-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up now</a></p>
        </div>
    </div>
</body>
</html>
