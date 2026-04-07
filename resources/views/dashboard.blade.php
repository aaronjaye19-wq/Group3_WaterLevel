<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Water Level Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        background: #f0f2f5;
        color: #333;
    }

    /* Notification Container */
    .notifications {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        max-width: 400px;
    }

    .notification-item {
        background: white;
        border-left: 4px solid #2980b9;
        padding: 16px;
        margin-bottom: 12px;
        border-radius: 6px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease-out;
    }

    .notification-item.success {
        border-left-color: #27ae60;
    }

    .notification-item.error {
        border-left-color: #e74c3c;
    }

    .notification-item.info {
        border-left-color: #3498db;
    }

    .notification-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .notification-message {
        font-size: 14px;
        color: #333;
    }

    .notification-close {
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        font-size: 18px;
        padding: 0;
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

    /* Navbar */
    .navbar {
        background: white;
        border-bottom: 1px solid #e0e0e0;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar h1 {
        font-size: 24px;
        color: #2980b9;
        margin: 0;
    }

    .navbar-right {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .mfa-link {
        color: #2980b9;
        text-decoration: none;
        font-size: 14px;
        padding: 8px 12px;
        border-radius: 4px;
        transition: background 0.2s;
    }

    .mfa-link:hover {
        background: #f0f2f5;
    }

    .logout-btn {
        background: #2980b9;
        color: white;
        border: none;
        padding: 10px 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: background 0.2s;
    }

    .logout-btn:hover {
        background: #1e5f96;
    }

    /* Main Container */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 20px;
    }

    .dashboard-header {
        margin-bottom: 40px;
    }

    .dashboard-header h2 {
        font-size: 28px;
        color: #1a3a5a;
        margin-bottom: 8px;
    }

    .dashboard-header p {
        color: #666;
        font-size: 14px;
    }

    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 30px;
        margin-bottom: 40px;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Water Depth Card */
    .card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        border: 1px solid #e0e0e0;
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
    }

    /* Circular Gauge */
    .gauge-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .circular-gauge {
        position: relative;
        width: 240px;
        height: 240px;
        margin: 0 auto;
    }

    .gauge-circle {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(
            #2980b9 0deg,
            #4da7db 90deg,
            #e0e0e0 90deg,
            #e0e0e0 360deg
        );
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gauge-inner {
        position: absolute;
        top: 12px;
        left: 12px;
        right: 12px;
        bottom: 12px;
        border-radius: 50%;
        background: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .gauge-value {
        font-size: 42px;
        font-weight: 700;
        color: #2980b9;
    }

    .gauge-unit {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
    }

    .gauge-stats {
        width: 100%;
        display: flex;
        justify-content: space-around;
        gap: 20px;
    }

    .stat {
        text-align: center;
    }

    .stat-label {
        font-size: 12px;
        color: #999;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 18px;
        font-weight: 600;
        color: #2980b9;
    }

    /* Daily Records Section */
    .daily-records-card {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .filter-controls {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 8px 16px;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        background: white;
        color: #333;
        cursor: pointer;
        font-size: 13px;
        transition: all 0.2s;
    }

    .filter-btn.active {
        background: #2980b9;
        color: white;
        border-color: #2980b9;
    }

    .filter-btn:hover {
        border-color: #2980b9;
    }

    /* Chart Container */
    .chart-container {
        position: relative;
        height: 300px;
        margin: 20px 0;
    }

    .chart-canvas {
        width: 100%;
        height: 100%;
    }

    /* Records Table */
    .records-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 14px;
    }

    .records-table thead {
        background: #f5f5f5;
    }

    .records-table th {
        padding: 12px;
        text-align: left;
        font-weight: 600;
        color: #666;
        border-bottom: 1px solid #e0e0e0;
    }

    .records-table td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
    }

    .records-table tbody tr:hover {
        background: #f9f9f9;
    }

    .status-badge {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 3px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-normal {
        background: #e8f5e9;
        color: #2e7d32;
    }

    .status-warning {
        background: #fff3e0;
        color: #e65100;
    }

    .status-critical {
        background: #ffebee;
        color: #c62828;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding: 20px;
        }

        .dashboard-grid {
            gap: 20px;
        }

        .card {
            padding: 20px;
        }

        .circular-gauge {
            width: 200px;
            height: 200px;
        }

        .gauge-value {
            font-size: 32px;
        }

        .filter-controls {
            gap: 8px;
        }

        .filter-btn {
            padding: 6px 12px;
            font-size: 12px;
        }

        .records-table {
            font-size: 12px;
        }

        .records-table th,
        .records-table td {
            padding: 8px;
        }
    }
</style>
</head>
<body>

<div id="notifications" class="notifications"></div>

<div class="navbar">
    <h1>Water Level Monitoring System</h1>
    <div class="navbar-right">
        <a href="{{ route('mfa.setup') }}" class="mfa-link">
            {{ auth()->user()->mfa_enabled ? '🔒 MFA Enabled' : '⚠️ Enable MFA' }}
        </a>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="dashboard-header">
        <h2>Welcome back, {{ auth()->user()->name }}!</h2>
        <p>Monitor your water depth and daily records</p>
    </div>

    <div class="dashboard-grid">
        <!-- Water Depth Gauge Card -->
        <div class="card">
            <div class="card-title">Water Depth</div>
            <div class="gauge-container">
                <div class="circular-gauge">
                    <div class="gauge-circle" id="gaugeCircle">
                        <div class="gauge-inner">
                            <div class="gauge-value" id="gaugeValue">0</div>
                            <div class="gauge-unit">Millimeter</div>
                        </div>
                    </div>
                </div>
                <div class="gauge-stats">
                    <div class="stat">
                        <div class="stat-label">Change 24h</div>
                        <div class="stat-value" id="change24h">-45 mm</div>
                    </div>
                    <div class="stat">
                        <div class="stat-label">Maximum 24h</div>
                        <div class="stat-value" id="maximum24h">320 mm</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daily Records Card -->
        <div class="card daily-records-card">
            <div class="card-title">Daily Records</div>
            
            <div class="filter-controls">
                <button class="filter-btn active" data-filter="7days">Last 7 Days</button>
                <button class="filter-btn" data-filter="30days">Last 30 Days</button>
                <button class="filter-btn" data-filter="custom">Custom Range</button>
            </div>

            <div class="chart-container">
                <canvas id="recordsChart" class="chart-canvas"></canvas>
            </div>

            <table class="records-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Water Level</th>
                        <th>Change</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="recordsTableBody">
                    <!-- Populated by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let currentFilter = '7days';
let allRecords = [];

// Notification System
function showNotification(message, type = 'success') {
    const container = document.getElementById('notifications');
    const notification = document.createElement('div');
    notification.className = `notification-item ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <div class="notification-message">${message}</div>
            <button class="notification-close" onclick="this.parentElement.parentElement.remove()">×</button>
        </div>
    `;
    container.appendChild(notification);

    setTimeout(() => {
        notification.remove();
    }, 5000);
}

// Load notifications from API
async function loadNotifications() {
    try {
        const response = await fetch('/api/notifications');
        const data = await response.json();
        if (data.notifications && data.notifications.length > 0) {
            data.notifications.forEach(notification => {
                showNotification(notification.message, 'info');
            });
        }
    } catch (err) {
        console.error('Error loading notifications:', err);
    }
}

// Fetch sensor data and update gauge
async function fetchSensorData() {
    try {
        const response = await fetch('/api/latest-sensor');
        const data = await response.json();
        const value = data.sensor || 0;

        document.getElementById('gaugeValue').textContent = value;
        updateGaugePercentage(value);
    } catch (err) {
        console.error('Error fetching sensor data:', err);
    }
}

// Update gauge circle based on value (0-390 mapped to 0-100%)
function updateGaugePercentage(value) {
    const percentage = Math.min(Math.max((value / 390) * 100, 0), 100);
    const angle = (percentage / 100) * 360;
    const gaugeCircle = document.getElementById('gaugeCircle');
    gaugeCircle.style.background = `conic-gradient(
        #2980b9 0deg,
        #4da7db ${angle}deg,
        #e0e0e0 ${angle}deg,
        #e0e0e0 360deg
    )`;
}

// Fetch daily records
async function fetchDailyRecords() {
    try {
        let startDate, endDate;
        const today = new Date();

        if (currentFilter === '7days') {
            startDate = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
        } else if (currentFilter === '30days') {
            startDate = new Date(today.getTime() - 30 * 24 * 60 * 60 * 1000);
        } else {
            startDate = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
        }

        const startStr = startDate.toISOString().split('T')[0];
        const endStr = today.toISOString().split('T')[0];

        const response = await fetch(`/api/daily-records?start_date=${startStr}&end_date=${endStr}`);
        allRecords = await response.json();

        updateRecordsTable();
        updateChart();
    } catch (err) {
        console.error('Error fetching daily records:', err);
    }
}

// Update records table
function updateRecordsTable() {
    const tbody = document.getElementById('recordsTableBody');
    tbody.innerHTML = '';

    allRecords.reverse().forEach(record => {
        const status = record.water_level < 100 ? 'normal' : record.water_level < 250 ? 'warning' : 'critical';
        const statusClass = `status-${status}`;
        const statusText = status.charAt(0).toUpperCase() + status.slice(1);

        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${record.date}</td>
            <td>${record.water_level} mm</td>
            <td>${record.change_24h !== null ? record.change_24h + ' mm' : 'N/A'}</td>
            <td><span class="status-badge ${statusClass}">${statusText}</span></td>
        `;
        tbody.appendChild(row);
    });
}

// Update chart
function updateChart() {
    const canvas = document.getElementById('recordsChart');
    const ctx = canvas.getContext('2d');

    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    if (allRecords.length === 0) {
        ctx.fillStyle = '#999';
        ctx.font = '14px sans-serif';
        ctx.textAlign = 'center';
        ctx.fillText('No data available', canvas.width / 2, canvas.height / 2);
        return;
    }

    // Simple line chart
    const padding = 50;
    const width = canvas.width - padding * 2;
    const height = canvas.height - padding * 2;
    const maxValue = Math.max(...allRecords.map(r => r.water_level)) || 1;
    const pointSpacing = width / (allRecords.length - 1 || 1);

    // Draw grid
    ctx.strokeStyle = '#e0e0e0';
    ctx.lineWidth = 1;
    for (let i = 0; i <= 5; i++) {
        const y = padding + (height / 5) * i;
        ctx.beginPath();
        ctx.moveTo(padding, y);
        ctx.lineTo(canvas.width - padding, y);
        ctx.stroke();
    }

    // Draw line
    ctx.strokeStyle = '#2980b9';
    ctx.lineWidth = 2;
    ctx.beginPath();

    allRecords.forEach((record, index) => {
        const x = padding + index * pointSpacing;
        const y = padding + height - (record.water_level / maxValue) * height;
        if (index === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    });
    ctx.stroke();

    // Draw points
    ctx.fillStyle = '#2980b9';
    allRecords.forEach((record, index) => {
        const x = padding + index * pointSpacing;
        const y = padding + height - (record.water_level / maxValue) * height;
        ctx.beginPath();
        ctx.arc(x, y, 4, 0, Math.PI * 2);
        ctx.fill();
    });

    // Draw axes
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 1;
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, canvas.height - padding);
    ctx.lineTo(canvas.width - padding, canvas.height - padding);
    ctx.stroke();

    // Draw labels
    ctx.fillStyle = '#666';
    ctx.font = '12px sans-serif';
    ctx.textAlign = 'center';
    allRecords.forEach((record, index) => {
        if (index % Math.ceil(allRecords.length / 5) === 0 || allRecords.length <= 5) {
            const x = padding + index * pointSpacing;
            const date = new Date(record.date);
            const label = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
            ctx.fillText(label, x, canvas.height - padding + 20);
        }
    });
}

// Filter button handlers
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        currentFilter = btn.dataset.filter;
        fetchDailyRecords();
    });
});

// Resize canvas to fit container
function resizeCanvas() {
    const canvas = document.getElementById('recordsChart');
    const container = canvas.parentElement;
    canvas.width = container.clientWidth;
    canvas.height = container.clientHeight;
    updateChart();
}

window.addEventListener('resize', resizeCanvas);

// Initialize
loadNotifications();
fetchSensorData();
fetchDailyRecords();
resizeCanvas();

// Update data every minute
setInterval(fetchSensorData, 60000);
setInterval(fetchDailyRecords, 300000); // 5 minutes
</script>

</body>
</html>
