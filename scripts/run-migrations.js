import { execSync } from 'child_process';
import path from 'path';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const projectRoot = path.join(__dirname, '..');

console.log('[v0] Running Laravel migrations...');
console.log('[v0] Project root:', projectRoot);

try {
  const output = execSync('php artisan migrate --force', {
    cwd: projectRoot,
    encoding: 'utf-8',
    stdio: 'inherit'
  });
  
  console.log('[v0] Migrations completed successfully');
  process.exit(0);
} catch (error) {
  console.error('[v0] Migration failed:', error.message);
  process.exit(1);
}
