<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

putenv("BORG_PASSPHRASE=" . BORG_PASSPHRASE);

header('Content-Type: application/json');

// --- AUTHENTICATIE ---
$token = $_GET['u'] ?? '';
$date  = $_GET['date'] ?? '';

$USER = decrypt_user($token);
if (!$USER) {
    echo json_encode(['error' => 'Invalid token']);
    exit;
}

if (!$date || !preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $date)) {
    echo json_encode(['error' => 'Invalid date']);
    exit;
}

// --- Read all snapshots ---
$cmd = "borg list /backups --json 2>&1";
$out = shell_exec($cmd);

$data = json_decode($out, true);
if (!$data || empty($data['archives'])) {
    echo json_encode(['error' => 'No archives found']);
    exit;
}

$matches = [];

foreach ($data['archives'] as $a) {
    $snap  = $a['name'];               // bvb server-2025-12-06T02:03:16.421325
    $ts    = $a['time'];               // iso "2025-12-06T02:03:16.421325"

    // extract YYYY-MM-DD & time
    $d = substr($ts, 0, 10);
    $t = substr($ts, 11, 5); // HH:MM

    if ($d === $date) {
        $matches[] = [
            'snapshot' => $snap,
            'time'     => $t
        ];
    }
}

// sort ASC
usort($matches, function($a, $b){
    return strcmp($a['time'], $b['time']);
});

echo json_encode($matches);
exit;
