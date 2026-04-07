#!/bin/bash

cd /vercel/share/v0-project

echo "[v0] Staging all changes..."
git add -A

echo "[v0] Creating commit..."
git commit -m "feat: Enhance user and admin dashboards with circular gauge, daily records, and notifications

- Add circular water depth gauge with real-time updates
- Create daily records chart with filter functionality
- Implement top-right corner login notification system
- Add WaterDepthRecord and Notification models
- Create database migrations for water_depth_records and notifications tables
- Update routes with new API endpoints for sensor data and notifications
- Redesign user dashboard with modern UI and blue color scheme
- Enhance admin dashboard with water depth management section
- Integrate automatic notification creation on login (standard and MFA)
- Add responsive design supporting mobile and desktop views

Co-authored-by: v0[bot] <v0[bot]@users.noreply.github.com>"

echo "[v0] Commit completed successfully"
