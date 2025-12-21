<?php
require_once __DIR__ . '/backup_crypto.php';

header("Content-Type: application/json");

$token  = $_GET['u']      ?? '';
$domain = $_GET['domain'] ?? '';

$USER = decrypt_user($token);

if ($USER === false) {
    echo json_encode([]);
    exit;
}

$USER = preg_replace('/[^a-zA-Z0-9_]/', '', $USER);

$root = "/home/$USER/domains/$domain/public_html";

if (!is_dir($root)) {
    echo json_encode([]);
    exit;
}

$dbs = [];

// ---------------------------------------------------------
// WordPress detectie
// ---------------------------------------------------------
$wp = "$root/wp-config.php";
if (file_exists($wp)) {
    $cfg = file_get_contents($wp);
    if (preg_match("/define\(\s*'DB_NAME',\s*'([^']+)'\s*\)/", $cfg, $m)) {
        $dbs[] = $m[1];
    }
}

// ---------------------------------------------------------
// Magento 2 detectie
// ---------------------------------------------------------
$magento = "$root/app/etc/env.php";
if (file_exists($magento)) {
    $arr = include $magento;
    if (!empty($arr['db']['connection']['default']['dbname'])) {
        $dbs[] = $arr['db']['connection']['default']['dbname'];
    }
}

// ---------------------------------------------------------
// PrestaShop detectie
// ---------------------------------------------------------
$ps = "$root/app/config/parameters.php";
if (file_exists($ps)) {
    $arr = include $ps;
    if (!empty($arr['parameters']['database_name'])) {
        $dbs[] = $arr['parameters']['database_name'];
    }
}

// ---------------------------------------------------------
// Joomla detectie
// ---------------------------------------------------------
$joomla = "$root/configuration.php";
if (file_exists($joomla)) {
    include $joomla;
    if (!empty($db)) {
        $dbs[] = $db;
    }
}

// ---------------------------------------------------------
// .env detectie (Laravel, Symfony, custom)
// ---------------------------------------------------------
$env = "$root/.env";
if (file_exists($env)) {
    $cfg = file_get_contents($env);
    if (preg_match('/DB_DATABASE=(.+)/', $cfg, $m)) {
        $dbs[] = trim($m[1]);
    }
}

// ---------------------------------------------------------
// Fallback: alle DB's die met <user>_ beginnen
// ---------------------------------------------------------
$mysql = shell_exec("mysql -e 'SHOW DATABASES;' 2>/dev/null");

foreach (explode("\n", trim($mysql)) as $db) {
    if (strpos($db, $USER . "_") === 0) {
        if (!in_array($db, $dbs)) {
            $dbs[] = $db;
        }
    }
}

echo json_encode($dbs);
