<?php

// Run Laravel migrations
chdir(__DIR__ . '/..');

// Load Laravel
require_once 'bootstrap/app.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

// Run migrations
$exitCode = $kernel->call('migrate', ['--force' => true]);

echo "\n[v0] Migrations completed with exit code: $exitCode\n";

exit($exitCode);
