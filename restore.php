<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

$token    = $_GET['u'] ?? '';
$snapshot = $_GET['snapshot'] ?? '';
$domain   = $_GET['domain'] ?? '';
$path     = $_GET['path'] ?? '';

$USER = decrypt_user($token);
if (!$USER) die("Ongeldig token");

$cmd = "/usr/local/bin/borg-restore.sh "
     . escapeshellarg($snapshot) . " "
     . escapeshellarg($USER) . " "
     . escapeshellarg($domain) . " "
     . escapeshellarg($path);

$out = shell_exec($cmd);

echo "<h2>Hersteld:</h2>";
echo "<pre>$out</pre>";
echo "<a href='backup_browser.php?u=$token&snapshot=$snapshot&domain=$domain'>Terug</a>";
