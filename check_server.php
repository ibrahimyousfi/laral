<?php
/**
 * Server check script. Run: php check_server.php
 * Delete this file after use (security).
 */

header('Content-Type: text/plain; charset=utf-8');

$baseDir = __DIR__;
$report = [];

// 1. PHP
$report[] = '=== PHP ===';
$report[] = 'Version: ' . PHP_VERSION;
$report[] = 'pdo_mysql: ' . (extension_loaded('pdo_mysql') ? 'yes' : 'NO');
$report[] = '';

// 2. Paths
$report[] = '=== Paths ===';
$report[] = 'Base: ' . $baseDir;
$report[] = '.env exists: ' . (file_exists($baseDir . '/.env') ? 'yes' : 'NO');
$report[] = 'artisan exists: ' . (file_exists($baseDir . '/artisan') ? 'yes' : 'NO');
$report[] = '';

// 3. .env DB vars (values hidden)
if (file_exists($baseDir . '/.env')) {
    $env = file_get_contents($baseDir . '/.env');
    $report[] = '=== .env DB (keys only) ===';
    foreach (['DB_CONNECTION', 'DB_HOST', 'DB_PORT', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD'] as $key) {
        $has = preg_match('/^' . $key . '=(.*)$/m', $env, $m) ? 'set' : 'MISSING';
        $report[] = $key . ': ' . $has;
    }
    $report[] = '';
}

// 4. Direct DB connection (read .env manually)
$report[] = '=== MySQL connection ===';
$dbHost = '127.0.0.1';
$dbName = '';
$dbUser = '';
$dbPass = '';
if (file_exists($baseDir . '/.env')) {
    $lines = file($baseDir . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') === false || strpos(trim($line), '#') === 0) continue;
        list($k, $v) = explode('=', $line, 2);
        $k = trim($k);
        $v = trim($v, " \t\"'");
        if ($k === 'DB_HOST') $dbHost = $v;
        if ($k === 'DB_DATABASE') $dbName = $v;
        if ($k === 'DB_USERNAME') $dbUser = $v;
        if ($k === 'DB_PASSWORD') $dbPass = $v;
    }
}
if ($dbName && $dbUser !== '') {
    try {
        $pdo = new PDO(
            "mysql:host=" . $dbHost . ";dbname=" . $dbName . ";charset=utf8mb4",
            $dbUser,
            $dbPass,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        $report[] = 'PDO connection: OK';
        $report[] = 'Database: ' . $dbName;
    } catch (Throwable $e) {
        $report[] = 'PDO connection: FAIL';
        $report[] = 'Error: ' . $e->getMessage();
    }
} else {
    $report[] = 'PDO: skipped (DB_DATABASE or DB_USERNAME missing in .env)';
}
$report[] = '';

// 5. Laravel bootstrap (no DB in boot)
$report[] = '=== Laravel bootstrap ===';
if (file_exists($baseDir . '/vendor/autoload.php')) {
    try {
        require $baseDir . '/vendor/autoload.php';
        $app = require_once $baseDir . '/bootstrap/app.php';
        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
        $report[] = 'Laravel bootstrap: OK';
        try {
            $name = DB::connection()->getDatabaseName();
            $report[] = 'Laravel DB::connection(): OK (' . $name . ')';
        } catch (Throwable $e) {
            $report[] = 'Laravel DB::connection(): FAIL - ' . $e->getMessage();
        }
    } catch (Throwable $e) {
        $report[] = 'Laravel bootstrap: FAIL';
        $report[] = 'Error: ' . $e->getMessage();
    }
} else {
    $report[] = 'Laravel: vendor/autoload.php not found (run composer install)';
}
$report[] = '';

// 6. Storage writable
$report[] = '=== Permissions ===';
$report[] = 'storage writable: ' . (is_writable($baseDir . '/storage') ? 'yes' : 'NO');
$report[] = 'bootstrap/cache writable: ' . (is_writable($baseDir . '/bootstrap/cache') ? 'yes' : 'NO');

echo implode("\n", $report);
