<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

$token    = $_GET['u'] ?? '';
$snapshot = $_GET['snapshot'] ?? '';
$domain   = $_GET['domain'] ?? '';
$path     = trim($_GET['path'] ?? '', '/');

$USER = decrypt_user($token);
if (!$USER) die(json_encode(['error'=>'token']));

$cmd = "/usr/local/bin/borg-file-list.sh "
     . escapeshellarg($snapshot) . " "
     . escapeshellarg($USER) . " "
     . escapeshellarg($domain) . " "
     . escapeshellarg($path);

$out = shell_exec($cmd);
$lines = explode("\n", trim($out));

$dirs = [];
$files = [];

foreach ($lines as $l) {
    if (!$l) continue;
    if (substr($l, -1) == '/') $dirs[] = rtrim($l, '/');
    else $files[] = $l;
}

header("Content-Type: application/json");
echo json_encode([
    'dirs' => $dirs,
    'files'=> $files,
    'raw'=> $out
]);
