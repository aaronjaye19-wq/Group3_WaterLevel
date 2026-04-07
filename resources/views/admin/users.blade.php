<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Admin</title>
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
            margin-bottom: 35px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 36px;
            color: #1a3a5a;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 11px 20px;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 8px;
            background: linear-gradient(180deg, #2980b9 0%, #1f618d 100%);
            transition: all 0.3s;
            box-shadow: 0 4px 8px rgba(41,128,185,0.2);
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
        }

        .back-link:hover {
            background: linear-gradient(180deg, #3498db 0%, #2980b9 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(41,128,185,0.3);
        }

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

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
        }

        .table thead {
            background: linear-gradient(180deg, rgba(41,128,185,0.1) 0%, rgba(41,128,185,0.05) 100%);
            border-bottom: 2px solid rgba(41,128,185,0.2);
        }

        .table th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 700;
            font-size: 12px;
            color: #1a3a5a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
        }

        .table td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            font-size: 14px;
            color: #555;
        }

        .table tbody tr:hover {
            background: linear-gradient(90deg, rgba(41,128,185,0.08), rgba(52,152,219,0.05));
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-admin {
            background: linear-gradient(135deg, rgba(41,128,185,0.15), rgba(52,152,219,0.1));
            color: #1f618d;
            border: 1px solid rgba(41,128,185,0.2);
        }

        .badge-verified {
            background: linear-gradient(135deg, #f1f8f4 0%, #c8e6c9 100%);
            color: #1b5e20;
            border: 1px solid rgba(46,125,50,0.2);
        }

        .badge-mfa {
            background: linear-gradient(135deg, #f1f8f4 0%, #c8e6c9 100%);
            color: #1b5e20;
            border: 1px solid rgba(46,125,50,0.2);
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-btn {
            background: linear-gradient(180deg, #2980b9 0%, #1f618d 100%);
            color: white;
            padding: 6px 12px;
            border: 1px solid rgba(0,0,0,0.1);
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 700;
            transition: all 0.3s;
            white-space: nowrap;
            box-shadow: 0 2px 4px rgba(41,128,185,0.2);
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .action-btn:hover {
            background: linear-gradient(180deg, #3498db 0%, #2980b9 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(41,128,185,0.3);
        }

        .action-btn.danger {
            background: linear-gradient(180deg, #e74c3c 0%, #c0392b 100%);
            box-shadow: 0 2px 4px rgba(231,76,60,0.2);
        }

        .action-btn.danger:hover {
            background: linear-gradient(180deg, #ec7063 0%, #c0392b 100%);
            box-shadow: 0 4px 8px rgba(231,76,60,0.3);
        }

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

        .pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 35px;
        }

        .pagination a, .pagination strong, .pagination span {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
        }

        .pagination a {
            background: linear-gradient(180deg, rgba(255,255,255,0.8) 0%, rgba(245,245,245,0.8) 100%);
            border: 1px solid rgba(41,128,185,0.2);
            color: #2980b9;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover {
            background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(250,250,250,0.95) 100%);
            transform: translateY(-1px);
            box-shadow: 0 2px 6px rgba(41,128,185,0.2);
        }

        .pagination strong {
            background: linear-gradient(180deg, #2980b9 0%, #1f618d 100%);
            color: white;
            box-shadow: 0 2px 4px rgba(41,128,185,0.2);
        }

        .pagination span {
            color: #999;
        }

        .empty-state {
            text-align: center;
            color: #999;
            padding: 50px 30px;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>👥 User Management</h2>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="container">
        <div class="header">
            <h1>Manage Users</h1>
            <a href="{{ route('admin.dashboard') }}" class="back-link">← Back to Dashboard</a>
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

        <div class="section">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>MFA</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td><strong>{{ $user->name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_verified)
                                    <span class="badge badge-verified">✓ Verified</span>
                                @else
                                    <span style="color: #999; font-size: 12px; text-transform: uppercase;">Not Verified</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->is_admin)
                                    <span class="badge badge-admin">⚙️ Admin</span>
                                @else
                                    <span style="color: #999; font-size: 12px; text-transform: uppercase;">User</span>
                                @endif
                            </td>
                            <td>
                                @if ($user->mfa_enabled)
                                    <span class="badge badge-mfa">🔒 Enabled</span>
                                @else
                                    <span style="color: #999; font-size: 12px; text-transform: uppercase;">Disabled</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    <form action="{{ route('admin.toggle-admin', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="action-btn">
                                            {{ $user->is_admin ? 'Revoke Admin' : 'Grant Admin' }}
                                        </button>
                                    </form>

                                    @if ($user->mfa_enabled)
                                        <form action="{{ route('admin.disable-mfa', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="action-btn">Disable MFA</button>
                                        </form>
                                    @endif

                                    @if ($user->id !== auth()->id())
                                        <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            <button type="submit" class="action-btn danger">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty-state">
                                No users found in the system
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if ($users->hasPages())
                <div class="pagination">
                    @if ($users->onFirstPage())
                        <span>← Previous</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}">← Previous</a>
                    @endif

                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
                            <strong>{{ $page }}</strong>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}">Next →</a>
                    @else
                        <span>Next →</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</body>
</html>
