<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Water Sensor Dashboard</title>
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
            max-width: 480px;
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
            margin-bottom: 22px;
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

        input, textarea {
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
            font-family: inherit;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: #2980b9;
            background: white;
            box-shadow: 
                inset 0 2px 4px rgba(0,0,0,0.05),
                0 0 0 4px rgba(41,128,185,0.1);
        }

        input::placeholder, textarea::placeholder {
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
            margin-bottom: 25px;
            padding: 14px 16px;
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

        .link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        .link p {
            font-size: 13px;
            color: #666;
            margin: 0;
        }

        .link a {
            color: #2980b9;
            text-decoration: none;
            font-weight: 600;
        }

        .link a:hover {
            text-decoration: underline;
        }

        .password-info {
            font-size: 12px;
            color: #666;
            margin-top: 8px;
            padding: 10px 12px;
            background: linear-gradient(135deg, rgba(41,128,185,0.05) 0%, rgba(52,152,219,0.05) 100%);
            border-left: 3px solid #2980b9;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-info svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            color: #2980b9;
        }

        /* Top Right Alerts */
        .alert-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            max-width: 400px;
        }

        .alert-notification {
            background: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            border-left: 4px solid;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .alert-notification.success {
            border-left-color: #27ae60;
            background: linear-gradient(135deg, #f1f8f4 0%, #e8f5e9 100%);
        }

        .alert-notification.error {
            border-left-color: #e74c3c;
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
        }

        .alert-notification.success .alert-icon {
            color: #27ae60;
        }

        .alert-notification.error .alert-icon {
            color: #e74c3c;
        }

        .alert-icon {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-message {
            flex: 1;
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }

        .alert-notification.success .alert-message {
            color: #1b5e20;
        }

        .alert-notification.error .alert-message {
            color: #c0392b;
        }

        .alert-close {
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            font-size: 18px;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .alert-close:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="alert-container" id="alertContainer"></div>

    <div class="container">
        <h1>Create Account</h1>
        <p class="subtitle">Join the water sensor monitoring network</p>

        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

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
                <div class="password-info">
                    <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/></svg>
                    <span>Password should be at least 8 characters long</span>
                </div>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••">
            </div>

            <button type="submit">Create Account</button>
        </form>

        <div class="link">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
        </div>
    </div>

    <script>
        // Alert notification system
        function showAlert(message, type = 'success') {
            const container = document.getElementById('alertContainer');
            const alert = document.createElement('div');
            alert.className = `alert-notification ${type}`;
            
            const iconSvg = type === 'success' 
                ? '<svg class="alert-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/></svg>'
                : '<svg class="alert-icon" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/></svg>';
            
            alert.innerHTML = `
                ${iconSvg}
                <span class="alert-message">${message}</span>
                <button class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
            `;
            
            container.appendChild(alert);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (alert.parentElement) {
                    alert.style.animation = 'slideIn 0.3s ease reverse';
                    setTimeout(() => alert.remove(), 300);
                }
            }, 5000);
        }

        // Check for validation errors
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                showAlert("{{ $error }}", 'error');
            @endforeach
        @endif
    </script>
</body>
</html>
