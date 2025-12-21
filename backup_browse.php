<?php
// backup_browse.php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

putenv("BORG_PASSPHRASE=" . BORG_PASSPHRASE);
putenv("BORG_DISPLAY_PASSPHRASE=0");

header('Content-Type: application/json');

$token    = $_GET['u'] ?? '';
$snapshot = $_GET['snapshot'] ?? '';
$domain   = $_GET['domain'] ?? '';
$path     = $_GET['path'] ?? '';

$USER = decrypt_user($token);
if ($USER === false) {
    http_response_code(403);
    echo json_encode(['error' => 'Ongeldig token']);
    exit;
}
$USER = preg_replace('/[^a-zA-Z0-9_]/', '', $USER);
$domain = preg_replace('/[^a-zA-Z0-9\.\-]/', '', $domain);  // domeinnaam mag punt en streep bevatten
// clean path: geen ../, geen absolute pad
$path = trim($path, "/");
if (strpos($path, '..') !== false) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid path']);
    exit;
}

$REPO = "/backups";
if (empty($snapshot) || empty($domain)) {
    http_response_code(400);
    echo json_encode(['error' => 'snapshot or domain missing']);
    exit;
}

// Stel in hoe jouw domein-root in de backuparchives is opgeslagen.
// Pas deze variabele aan indien anders:
$domain_subpath = "home/$USER/domains/$domain";
$base = $domain_subpath;
if ($path !== '') {
    $base .= '/' . $path;
}

// Gebruik borg list om folders/files binnen de snapshot te bekijken
$cmd = 'borg list ' . escapeshellarg("$REPO::$snapshot") . ' '
     . escapeshellarg($base) . ' --short --bypass-lock 2>&1';

$output = shell_exec($cmd);
if ($output === null) {
    http_response_code(500);
    echo json_encode(['error' => 'borg list failed']);
    exit;
}

$lines = array_filter(explode("\n", trim($output)));
$folders = [];
$files   = [];

foreach ($lines as $line) {
    // borg list --short geeft paden relatief aan $base, zonder / aan begin
    if (substr($line, -1) === '/') {
        $folders[] = rtrim($line, '/');
    } else {
        $files[] = $line;
    }
}

// Bepaal parent directory voor “..” link
$up = '';
if ($path !== '') {
    $parts = explode('/', $path);
    array_pop($parts);
    $up = implode('/', $parts);
}

echo json_encode([
    'path'    => $path,
    'up'      => $up,
    'folders' => $folders,
    'files'   => $files,
]);
exit;
