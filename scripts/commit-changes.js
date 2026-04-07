import { execSync } from 'child_process';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const projectRoot = path.join(__dirname, '..');

console.log('[v0] Committing dashboard enhancement changes...');

try {
  execSync('git add -A', { cwd: projectRoot, stdio: 'inherit' });
  
  const commitMessage = `feat: Enhance user and admin dashboards with circular gauge, daily records, and notifications

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

Co-authored-by: v0[bot] <v0[bot]@users.noreply.github.com>`;

  execSync(`git commit -m "${commitMessage.replace(/"/g, '\\"')}"`, { 
    cwd: projectRoot, 
    stdio: 'inherit' 
  });
  
  console.log('[v0] Commit completed successfully');
  process.exit(0);
} catch (error) {
  console.error('[v0] Commit failed:', error.message);
  process.exit(1);
}
