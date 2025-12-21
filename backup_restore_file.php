<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

$token    = $_POST['u'] ?? '';
$snapshot = $_POST['snapshot'] ?? '';
$domain   = $_POST['domain'] ?? '';
$file     = $_POST['file'] ?? '';

$USER = decrypt_user($token);
if (!$USER) die("Ongeldig token");

$USER   = preg_replace('/[^a-zA-Z0-9_]/','',$USER);
$domain = preg_replace('/[^a-zA-Z0-9.\-]/','',$domain);
$file   = trim($file,"/");

$cmd = "sudo /usr/local/bin/borg_restore_file_wrapper.sh "
    . escapeshellarg($USER) . " "
    . escapeshellarg($domain) . " "
    . escapeshellarg($file) . " "
    . escapeshellarg($snapshot)
    . " 2>&1";

$output = shell_exec($cmd);

$target = "/home/$USER/domains/$domain/$file";

if (file_exists($target)) {
    echo "Bestand hersteld: $target\n\nOutput:\n$output";
} else {
    echo "❌ Bestand niet hersteld.\nCommand:\n$cmd\n\nOutput:\n$output";
}
