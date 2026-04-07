<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Water Sensor Dashboard</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Verdana, sans-serif;
        background: linear-gradient(135deg, #d4dfe8 0%, #e8eef5 100%);
        min-height: 100vh;
        padding: 20px;
    }

    /* Skeuomorphic Navbar */
    .navbar {
        background: linear-gradient(180deg, #4a4a4a 0%, #2a2a2a 50%, #1a1a1a 100%);
        color: white;
        padding: 15px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-radius: 12px;
        box-shadow: 
            0 8px 16px rgba(0,0,0,0.3),
            0 2px 4px rgba(0,0,0,0.2),
            inset 0 1px 0 rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.05);
    }

    .navbar h2 { 
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .navbar .nav-links {
        display: flex;
        gap: 12px;
    }

    .navbar .nav-links a {
        color: white;
        text-decoration: none;
        padding: 8px 14px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 13px;
        background: linear-gradient(180deg, rgba(255,255,255,0.15) 0%, rgba(0,0,0,0.1) 100%);
        border: 1px solid rgba(255,255,255,0.2);
        transition: all 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .navbar .nav-links a:hover {
        background: linear-gradient(180deg, rgba(255,255,255,0.25) 0%, rgba(0,0,0,0.05) 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .navbar .logout-btn {
        background: linear-gradient(180deg, #d84d4d 0%, #b83030 100%);
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        transition: all 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .navbar .logout-btn:hover {
        background: linear-gradient(180deg, #f05555 0%, #c93030 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .header {
        text-align: center;
        margin-bottom: 40px;
    }

    .header h1 {
        color: #1a3a5a;
        font-size: 36px;
        margin-bottom: 10px;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
    }

    /* Main Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Gauge Card */
    .gauge-card {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 
            0 12px 24px rgba(0,0,0,0.12),
            0 4px 8px rgba(0,0,0,0.08),
            inset 0 1px 2px rgba(255,255,255,0.9);
        border: 1px solid rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .gauge-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a3a5a;
        margin-bottom: 30px;
        text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
    }

    /* Circular Gauge */
    .gauge-wrapper {
        position: relative;
        width: 280px;
        height: 280px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .gauge-background {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #f0f0f0 0%, #e0e0e0 100%);
        box-shadow: 
            inset 0 4px 12px rgba(0,0,0,0.15),
            inset 0 -2px 4px rgba(255,255,255,0.8),
            0 4px 8px rgba(0,0,0,0.1);
        border: 3px solid rgba(0,0,0,0.1);
    }

    .gauge-progress {
        position: absolute;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: conic-gradient(
            from 225deg,
            #2980b9 0deg,
            #3498db 90deg,
            #5dade2 180deg,
            #aed6f1 270deg,
            #e8eef5 360deg
        );
        -webkit-mask-image: conic-gradient(
            from 225deg,
            black 0deg,
            black 0deg,
            transparent 360deg
        );
        mask-image: conic-gradient(
            from 225deg,
            black 0deg,
            black 0deg,
            transparent 360deg
        );
        transition: all 0.8s ease;
    }

    .gauge-center {
        position: absolute;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
        box-shadow: 
            inset 0 2px 6px rgba(0,0,0,0.1),
            0 2px 4px rgba(0,0,0,0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }

    .gauge-value {
        text-align: center;
    }

    .gauge-value .value-text {
        font-size: 48px;
        font-weight: 700;
        color: #2980b9;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .gauge-value .value-unit {
        font-size: 14px;
        color: #666;
        font-weight: 500;
        margin-top: 5px;
    }

    .gauge-label {
        font-size: 12px;
        color: #888;
        margin-top: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    /* Status Indicators */
    .status-panel {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        padding: 30px;
        border-radius: 20px;
        box-shadow: 
            0 12px 24px rgba(0,0,0,0.12),
            0 4px 8px rgba(0,0,0,0.08),
            inset 0 1px 2px rgba(255,255,255,0.9);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .status-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a3a5a;
        margin-bottom: 25px;
        text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
    }

    .status-lights {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .status-light {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 16px;
        background: linear-gradient(180deg, rgba(255,255,255,0.8) 0%, rgba(245,245,245,0.8) 100%);
        border-radius: 10px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .light-indicator {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(135deg, #999 0%, #777 100%);
        border: 2px solid rgba(0,0,0,0.2);
        box-shadow: 
            inset 0 2px 4px rgba(0,0,0,0.3),
            0 4px 8px rgba(0,0,0,0.2);
        position: relative;
        transition: all 0.3s ease;
    }

    .light-indicator::after {
        content: '';
        position: absolute;
        inset: 3px;
        border-radius: 50%;
        background: linear-gradient(135deg, #aaa 0%, #888 100%);
    }

    /* Light States */
    .light-indicator.green {
        background: linear-gradient(135deg, #27ae60 0%, #1e8449 100%);
        box-shadow: 
            inset 0 2px 4px rgba(0,0,0,0.3),
            0 4px 12px rgba(39,174,96,0.4);
    }

    .light-indicator.green::after {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    }

    .light-indicator.yellow {
        background: linear-gradient(135deg, #f39c12 0%, #d68910 100%);
        box-shadow: 
            inset 0 2px 4px rgba(0,0,0,0.3),
            0 4px 12px rgba(243,156,18,0.4);
    }

    .light-indicator.yellow::after {
        background: linear-gradient(135deg, #f1c40f 0%, #f39c12 100%);
    }

    .light-indicator.red {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        box-shadow: 
            inset 0 2px 4px rgba(0,0,0,0.3),
            0 4px 12px rgba(231,76,60,0.4);
    }

    .light-indicator.red::after {
        background: linear-gradient(135deg, #ec7063 0%, #e74c3c 100%);
    }

    .light-indicator.inactive {
        background: linear-gradient(135deg, #999 0%, #777 100%);
        box-shadow: 
            inset 0 2px 4px rgba(0,0,0,0.3),
            0 4px 8px rgba(0,0,0,0.2);
    }

    .light-indicator.inactive::after {
        background: linear-gradient(135deg, #aaa 0%, #888 100%);
    }

    .light-label {
        flex: 1;
    }

    .light-label .label-title {
        font-size: 14px;
        font-weight: 600;
        color: #1a3a5a;
    }

    .light-label .label-desc {
        font-size: 12px;
        color: #888;
        margin-top: 4px;
    }

    /* Charts Section */
    .charts-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 
            0 12px 24px rgba(0,0,0,0.12),
            0 4px 8px rgba(0,0,0,0.08),
            inset 0 1px 2px rgba(255,255,255,0.9);
        border: 1px solid rgba(0,0,0,0.05);
    }

    .charts-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .charts-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a3a5a;
        text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
    }

    .filter-controls {
        display: flex;
        gap: 10px;
    }

    .filter-btn {
        padding: 8px 16px;
        background: linear-gradient(180deg, rgba(255,255,255,0.8) 0%, rgba(245,245,245,0.8) 100%);
        border: 1px solid rgba(0,0,0,0.1);
        border-radius: 8px;
        cursor: pointer;
        font-size: 12px;
        font-weight: 600;
        color: #1a3a5a;
        transition: all 0.3s;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .filter-btn.active {
        background: linear-gradient(180deg, #2980b9 0%, #1f618d 100%);
        color: white;
        box-shadow: 0 4px 8px rgba(41,128,185,0.3);
    }

    .filter-btn:hover:not(.active) {
        background: linear-gradient(180deg, rgba(255,255,255,0.95) 0%, rgba(250,250,250,0.95) 100%);
        transform: translateY(-1px);
    }

    .chart-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.08);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        margin-top: 20px;
        min-height: 300px;
        position: relative;
    }

    .chart-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 14px;
    }

    /* Daily Record Data */
    .data-table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    .data-table thead {
        background: linear-gradient(180deg, rgba(41,128,185,0.1) 0%, rgba(41,128,185,0.05) 100%);
    }

    .data-table th {
        padding: 12px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #1a3a5a;
        border-bottom: 2px solid rgba(41,128,185,0.2);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .data-table td {
        padding: 12px;
        border-bottom: 1px solid rgba(0,0,0,0.05);
        font-size: 13px;
        color: #555;
    }

    .data-table tbody tr:hover {
        background: rgba(41,128,185,0.05);
    }

    @keyframes gaugeAnimation {
        0% {
            -webkit-mask-image: conic-gradient(from 225deg, black 0deg, black 0deg, transparent 360deg);
            mask-image: conic-gradient(from 225deg, black 0deg, black 0deg, transparent 360deg);
        }
        100% {
            -webkit-mask-image: conic-gradient(from 225deg, black 0deg, black var(--progress), transparent var(--progress));
            mask-image: conic-gradient(from 225deg, black 0deg, black var(--progress), transparent var(--progress));
        }
    }
</style>
</head>
<body>

<div class="navbar">
    <h2>💧 Water Sensor Dashboard</h2>
    <div class="nav-links">
        <a href="{{ route('mfa.setup') }}">{{ auth()->user()->mfa_enabled ? '🔒 MFA Enabled' : '⚠️ Enable MFA' }}</a>
        <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="header">
        <h1>Water Level Monitoring</h1>
    </div>

    <div class="dashboard-grid">
        <!-- Circular Gauge Card -->
        <div class="gauge-card">
            <div class="gauge-title">Current Water Depth</div>
            <div class="gauge-wrapper">
                <div class="gauge-background"></div>
                <div id="gaugeProgress" class="gauge-progress"></div>
                <div class="gauge-center">
                    <div class="gauge-value">
                        <div class="value-text"><span id="sensor">0</span>mm</div>
                        <div class="value-unit">Water Depth</div>
                    </div>
                </div>
            </div>
            <div class="gauge-label">Max Capacity: 390mm</div>
        </div>

        <!-- Status Indicators -->
        <div class="status-panel">
            <div class="status-title">System Status</div>
            <div class="status-lights">
                <div class="status-light">
                    <div id="light-green" class="light-indicator inactive"></div>
                    <div class="light-label">
                        <div class="label-title">Level Good</div>
                        <div class="label-desc">Above 100mm threshold</div>
                    </div>
                </div>
                <div class="status-light">
                    <div id="light-yellow" class="light-indicator inactive"></div>
                    <div class="light-label">
                        <div class="label-title">Level Warning</div>
                        <div class="label-desc">Above 250mm threshold</div>
                    </div>
                </div>
                <div class="status-light">
                    <div id="light-red" class="light-indicator inactive"></div>
                    <div class="light-label">
                        <div class="label-title">Level Critical</div>
                        <div class="label-desc">Above 330mm threshold</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-section">
        <div class="charts-header">
            <div class="charts-title">Daily Water Level Record</div>
            <div class="filter-controls">
                <button class="filter-btn active" data-filter="24h">Last 24h</button>
                <button class="filter-btn" data-filter="7d">Last 7 Days</button>
                <button class="filter-btn" data-filter="30d">Last 30 Days</button>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="waterChart" style="display: none;"></canvas>
            <div class="chart-placeholder">
                <svg width="300" height="200" viewBox="0 0 300 200" style="opacity: 0.3;">
                    <polyline points="10,150 50,120 90,100 130,80 170,70 210,85 250,110 290,140" 
                        stroke="currentColor" stroke-width="2" fill="none" style="stroke: #2980b9;"/>
                </svg>
            </div>
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Water Level (mm)</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
let previousHeight = 0;
let currentFilter = '24h';

// Filter buttons
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        currentFilter = this.dataset.filter;
        loadChartData();
    });
});

function setGaugeProgress(percentage) {
    const element = document.getElementById('gaugeProgress');
    const angle = (percentage / 100) * 270 + 225;
    const angleRad = (angle * Math.PI) / 180;
    element.style.setProperty('--progress', angle + 'deg');
    element.style.webkitMaskImage = `conic-gradient(from 225deg, black 0deg, black ${angle}deg, transparent ${angle}deg)`;
    element.style.maskImage = `conic-gradient(from 225deg, black 0deg, black ${angle}deg, transparent ${angle}deg)`;
}

async function fetchData() {
    try {
        const response = await fetch('/api/latest-sensor');
        const data = await response.json();

        const sensor = document.getElementById('sensor');
        const val = data.sensor;

        sensor.innerText = val;

        // Update gauge
        let heightPercent = Math.min(Math.max((val / 390) * 100, 0), 100);
        setGaugeProgress(heightPercent);

        // Update lights
        document.getElementById('light-green').className = 'light-indicator ' + (val >= 100 ? 'green' : 'inactive');
        document.getElementById('light-yellow').className = 'light-indicator ' + (val >= 250 ? 'yellow' : 'inactive');
        document.getElementById('light-red').className = 'light-indicator ' + (val >= 330 ? 'red' : 'inactive');

    } catch (err) {
        console.error("Error fetching sensor data:", err);
    }
}

async function loadChartData() {
    try {
        const response = await fetch(`/api/sensor-history?filter=${currentFilter}`);
        const data = await response.json();
        
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';

        if (data.length > 0) {
            data.slice(0, 10).forEach(record => {
                const row = tbody.insertRow();
                const time = new Date(record.created_at);
                const status = record.sensor >= 330 ? 'Critical' : record.sensor >= 250 ? 'Warning' : 'Good';
                
                row.innerHTML = `
                    <td>${time.toLocaleString()}</td>
                    <td>${record.sensor}mm</td>
                    <td><span style="color: ${status === 'Critical' ? '#e74c3c' : status === 'Warning' ? '#f39c12' : '#27ae60'};">${status}</span></td>
                `;
            });
        } else {
            tbody.innerHTML = '<tr><td colspan="3" style="text-align: center; color: #999;">No data available</td></tr>';
        }
    } catch (err) {
        console.error("Error loading chart data:", err);
    }
}

setInterval(fetchData, 1000);
loadChartData();
setInterval(() => loadChartData(), 5000);
fetchData();
</script>

</body>
</html>
