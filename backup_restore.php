<?php
require_once __DIR__ . '/backup_crypto.php';
putenv("BORG_PASSPHRASE=" . BORG_PASSPHRASE);
require_once __DIR__ . '/backup_secret.php';

$token = $_REQUEST['u'] ?? '';
$USER  = decrypt_user($token);

if ($USER === false) {
    die("Unauthorized");
}

$USER = preg_replace('/[^a-zA-Z0-9_]/', '', $USER);

$PROGRESS_FILE = "/tmp/restore_" . $USER . ".log";
$LOCK_FILE     = "/tmp/restore_" . $USER . ".lock";

// =======================================================
// 1️⃣ PROGRESS POLLING ENDPOINT
// =======================================================
if (isset($_GET['progress']))
{
    if (!file_exists($PROGRESS_FILE)) {
        echo json_encode([
            "percent" => 0,
            "log"     => "",
            "done"    => false
        ]);
        exit;
    }

    $log = file_get_contents($PROGRESS_FILE);
    $percent = 0;

    // Zoek voortgang percentage in log
    if (preg_match('/(\d+)\%\s+done/', $log, $m)) {
        $percent = (int)$m[1];
    }

    $done = file_exists($LOCK_FILE) ? false : true;

    echo json_encode([
        "percent" => $percent,
        "log"     => $log,
        "done"    => $done
    ]);
    exit;
}


// =======================================================
// 2️⃣ START RESTORE
// =======================================================
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // Reset progress
    @unlink($PROGRESS_FILE);
    file_put_contents($PROGRESS_FILE, "Restore gestart...\n");

    // Maak LOCK aan (zolang restore loopt)
    file_put_contents($LOCK_FILE, "1");

    // Ontvang parameters
    $domain  = $_POST['domain'];
    $type    = $_POST['type'];
    $db      = $_POST['database'] ?? '';
    $snapshot = $_POST['snapshot']; // volledige correcte snapshotnaam

if (!$snapshot) {
    @unlink($LOCK_FILE);
    file_put_contents($PROGRESS_FILE, "ERROR: Snapshot missing\n", FILE_APPEND);
    exit("ERROR");
}

    // ================================================
    // SUDO WRAPPER AANROEP
    // ================================================
$cmd = "sudo /usr/local/bin/borg_restore_wrapper.sh "
         . escapeshellarg($USER) . " "
         . escapeshellarg($domain) . " "
         . escapeshellarg($type) . " "
         . escapeshellarg($snapshot) . " "
         . escapeshellarg($db) . " "
         . escapeshellarg(BORG_PASSPHRASE);

    // Start restore in background
    exec($cmd . " >/dev/null 2>&1 &");

    echo "OK";
    exit;
}

echo "Invalid request";
