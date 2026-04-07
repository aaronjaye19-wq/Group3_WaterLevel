<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
            background: linear-gradient(135deg, #d4dfe8 0%, #e8eef5 100%);
            color: #333;
            min-height: 100vh;
        }

        /* Skeuomorphic Navbar */
        .navbar {
            background: linear-gradient(180deg, #4a4a4a 0%, #2a2a2a 50%, #1a1a1a 100%);
            color: white;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 
                0 8px 16px rgba(0,0,0,0.3),
                0 2px 4px rgba(0,0,0,0.2),
                inset 0 1px 0 rgba(255,255,255,0.1);
            border-bottom: 1px solid rgba(0,0,0,0.2);
        }

        .navbar h2 { 
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
        }

        .navbar .logout-btn {
            background: linear-gradient(180deg, #d84d4d 0%, #b83030 100%);
            color: white;
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            font-size: 13px;
            transition: all 0.3s;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .navbar .logout-btn:hover {
            background: linear-gradient(180deg, #f05555 0%, #c93030 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .header {
            margin-bottom: 45px;
        }

        .header h1 {
            font-size: 36px;
            margin-bottom: 8px;
            color: #1a3a5a;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .header p {
            color: #666;
            font-size: 15px;
        }

        /* Stats Grid */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-bottom: 45px;
        }

        .stat-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            padding: 28px;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 
                0 12px 24px rgba(0,0,0,0.12),
                0 4px 8px rgba(0,0,0,0.08),
                inset 0 1px 2px rgba(255,255,255,0.9);
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 
                0 16px 32px rgba(0,0,0,0.15),
                0 6px 12px rgba(0,0,0,0.1),
                inset 0 1px 2px rgba(255,255,255,0.9);
        }

        .stat-card h3 {
            color: #1a3a5a;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
        }

        .stat-card .number {
            font-size: 42px;
            font-weight: 800;
            color: #2980b9;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Sections */
        .section {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
            padding: 40px;
            border-radius: 16px;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 
                0 12px 24px rgba(0,0,0,0.12),
                0 4px 8px rgba(0,0,0,0.08),
                inset 0 1px 2px rgba(255,255,255,0.9);
        }

        .section h2 {
            font-size: 22px;
            margin-bottom: 28px;
            color: #1a3a5a;
            font-weight: 700;
            padding-bottom: 18px;
            border-bottom: 2px solid rgba(41,128,185,0.2);
            text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
        }

        .section p {
            margin-bottom: 16px;
            color: #555;
            line-height: 1.6;
        }

        .action-btn {
            background: linear-gradient(180deg, #2980b9 0%, #1f618d 100%);
            color: white;
            padding: 11px 20px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(41,128,185,0.2);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .action-btn:hover {
            background: linear-gradient(180deg, #3498db 0%, #2980b9 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(41,128,185,0.3);
        }

        .action-btn.danger {
            background: linear-gradient(180deg, #e74c3c 0%, #c0392b 100%);
            box-shadow: 0 4px 8px rgba(231,76,60,0.2);
        }

        .action-btn.danger:hover {
            background: linear-gradient(180deg, #ec7063 0%, #c0392b 100%);
            box-shadow: 0 6px 12px rgba(231,76,60,0.3);
        }

        /* Alerts */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            border: 1px solid;
            font-weight: 500;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);
        }

        .alert-success {
            background: linear-gradient(135deg, #f1f8f4 0%, #c8e6c9 100%);
            border-color: rgba(46,125,50,0.3);
            color: #1b5e20;
        }

        .alert-error {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            border-color: rgba(231,76,60,0.3);
            color: #c0392b;
        }

        /* Links */
        .link-btn {
            display: inline-block;
            color: #2980b9;
            text-decoration: none;
            font-weight: 600;
            margin-right: 12px;
            padding: 10px 16px;
            border: 1px solid rgba(41,128,185,0.2);
            border-radius: 8px;
            background: linear-gradient(180deg, rgba(255,255,255,0.8) 0%, rgba(245,245,245,0.8) 100%);
            transition: all 0.3s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .link-btn:hover {
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(250,250,250,0.95) 100%);
            border-color: #2980b9;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(41,128,185,0.15);
        }

        .desc-text {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>⚙️ Admin Dashboard</h2>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="header">
            <h1>System Overview</h1>
            <p>Welcome back, <strong>{{ auth()->user()->name }}</strong>. Manage your water sensor system here.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="stats">
            <div class="stat-card">
                <h3>👥 Total Users</h3>
                <div class="number">{{ $totalUsers }}</div>
            </div>
            <div class="stat-card">
                <h3>✅ Verified Users</h3>
                <div class="number">{{ $verifiedUsers }}</div>
            </div>
            <div class="stat-card">
                <h3>🔒 MFA Enabled</h3>
                <div class="number">{{ $mfaUsers }}</div>
            </div>
            <div class="stat-card">
                <h3>⚙️ Admins</h3>
                <div class="number">{{ $adminUsers }}</div>
            </div>
        </div>

        <div class="section">
            <h2>Quick Actions</h2>
            <p style="margin-bottom: 25px;">
                <a href="{{ route('admin.users') }}" class="link-btn">Manage Users</a>
            </p>
            <p class="desc-text">
                View and manage all users in the system. Toggle admin privileges, disable MFA, or remove users from the platform. Maintain complete control over user access and permissions.
            </p>
        </div>
    </div>
</body>
</html>
