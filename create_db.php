<?php

/**
 * Creates the MySQL database from .env (run once before php artisan migrate).
 * Usage: php create_db.php
 */

$envPath = __DIR__ . '/.env';
if (!is_file($envPath)) {
    echo ".env not found. Run: cp .env.example .env\n";
    exit(1);
}

$vars = [];
foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
    if (strpos(trim($line), '#') === 0) {
        continue;
    }
    if (strpos($line, '=') !== false) {
        [$name, $value] = explode('=', $line, 2);
        $vars[trim($name)] = trim($value, " \t\n\r\0\x0B\"'");
    }
}

$db = $vars['DB_DATABASE'] ?? 'laral';
$host = $vars['DB_HOST'] ?? '127.0.0.1';
$port = $vars['DB_PORT'] ?? '3306';
$user = $vars['DB_USERNAME'] ?? 'root';
$pass = $vars['DB_PASSWORD'] ?? '';

$dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . str_replace('`', '``', $db) . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database '$db' created (or already exists).\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
