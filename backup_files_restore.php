<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

$token = $_POST['u'] ?? '';
$USER  = decrypt_user($token);
if (!$USER) die("Invalid token");

$snap = $_POST['snapshot'];
$path = $_POST['path'];

$cmd = "sudo /usr/local/bin/borg_file_restore_wrapper.sh "
     . escapeshellarg($USER)." "
     . escapeshellarg($snap)." "
     . escapeshellarg($path);

exec($cmd, $o, $e);

echo "Bestand hersteld.";
