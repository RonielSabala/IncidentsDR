<?php

declare(strict_types=1);
const BASE_PATH = __DIR__ . '/../';
require_once BASE_PATH . 'vendor/autoload.php';
require_once BASE_PATH . 'config/db.php';

function readSql(string $file): string
{
    $sql = file_get_contents($file);
    if ($sql === false || $sql === '') {
        exit("SQL file not found or not readable: {$file}");
    }

    return $sql;
}

$creationSql = readSql(__DIR__ . '/creation.sql');
$insertionsSql = readSql(__DIR__ . '/insertions.sql');

try {
    // Create tables
    $pdo = new \PDO("mysql:host={$host}", $user, $pass, [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    ]);

    $statements = array_filter(array_map('trim', explode(';', $creationSql)));
    foreach ($statements as $stmt) {
        if (!empty($stmt)) {
            $pdo->exec($stmt);
        }
    }

    // Use DB
    if (!empty($db)) {
        $pdo->exec("USE `{$db}`;");
    }

    // Insert data
    $insertStatements = array_filter(array_map('trim', explode(';', $insertionsSql)));
    foreach ($insertStatements as $stmt) {
        if (!empty($stmt)) {
            $pdo->exec($stmt);
        }
    }
} catch (\PDOException $e) {
    exit('Database error: ' . $e->getMessage());
}

echo "\033[32mDatabase installed successfully!\033[0m";
