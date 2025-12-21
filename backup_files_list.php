<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

header("Content-Type: application/json");

putenv("BORG_PASSPHRASE=" . BORG_PASSPHRASE);

// Validate input
$token     = $_GET['u'] ?? '';
$snapshot  = $_GET['snapshot'] ?? '';
$path      = $_GET['path'] ?? '/';

$USER = decrypt_user($token);

if (!$USER) {
    echo json_encode(["error" => "Invalid token"]);
    exit;
}

if (!$snapshot) {
    echo json_encode(["error" => "Missing snapshot"]);
    exit;
}

// Normalize path
$path = ltrim($path, "/");

// BASE in archive = home/<USER>/
$archive_base = "home/$USER/";

// Full archive path
$archive_path = $archive_base . $path;

// Build command
$cmd = "sudo -n env BORG_PASSPHRASE='" . BORG_PASSPHRASE . "' "
     . "borg list '/backups::{$snapshot}' '{$archive_path}' "
     . "--bypass-lock 2>&1";

// Debug (optional):
// file_put_contents("/tmp/debug_list.txt", $cmd);

$out = shell_exec($cmd);

if (!$out) {
    echo json_encode(["dirs" => [], "files" => []]);
    exit;
}

// Parse output
$lines = array_filter(array_map('trim', explode("\n", $out)));
$dirs = [];
$files = [];

foreach ($lines as $line) {
    if (!str_contains($line, $archive_path)) continue;

    $clean = trim(substr($line, strlen($archive_path)));

    if ($clean === "") continue;

    if (str_ends_with($clean, "/")) {
        $dirs[] = rtrim($clean, "/");
    } else {
        $files[] = $clean;
    }
}

echo json_encode([
    "user"   => $USER,
    "path"   => "/$path",
    "dirs"   => $dirs,
    "files"  => $files
]);
