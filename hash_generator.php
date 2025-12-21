<?php
$ip = $_SERVER['REMOTE_ADDR'];
if($ip != "86.88.212.179" AND $ip != "95.97.111.182"){
die ("Geen toegang");
}

$dsn = "mysql:host=localhost;dbname=onlineh_backupmanager;charset=utf8mb4";
$db_user = "onlineh_backupmanager";
$db_pass = "aXdfG92bjTDdjQ57bqWH";

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (Exception $e) {
    die("Database connectie mislukt: " . $e->getMessage());
}


require_once '/home/onlineh/secure/backup_crypto.php';

$generated = '';
$username  = '';

if (!empty($_POST['user_input'])) {
    $username  = trim($_POST['user_input']);
    $generated = encrypt_user($username);

    $stmt = $pdo->prepare("INSERT INTO one_time_tokens (token, username) VALUES (?, ?)");
    $stmt->execute([$generated, $username]);

    // URL waar dit gebruikt gaat worden
    $url = "https://onlinehoster.nl/backup_calendar.php?u=" . urlencode($generated);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>User Hash Generator</title>
<meta charset="UTF-8">
<style>
body { font-family: Arial; padding: 20px; }
input[type=text] { padding: 8px; width: 300px; }
button { padding: 8px 14px; background:#1a73e8; color:white; border:none; cursor:pointer; }
pre { background:#f3f3f3; padding:10px; margin-top:10px; }
</style>
</head>
<body>

<h2>🔐 User Hash Generator</h2>

<form method="post" autocomplete="off">

    <!-- Bitwarden/LastPass decoy veld -->
    <input type="text" style="display:none" autocomplete="off" tabindex="-1">

    <label>Voer een gebruiker in:</label><br>

    <input 
        type="text"
        name="user_input"
        id="user_input"
        placeholder="bijv. onlineh"
        autocomplete="off"
        autocapitalize="off"
        autocorrect="off"
        spellcheck="false"
        required
    >

    <br><br>
    <button type="submit">Genereer Hash</button>
</form>

<?php if ($generated): ?>

<h3>🔑 Hash voor gebruiker: <b><?= htmlspecialchars($username) ?></b></h3>

<p><b>Token (hash):</b></p>
<pre><?= htmlspecialchars($generated) ?></pre>

<p><b>Volledige URL:</b></p>
<pre><?= htmlspecialchars($url) ?></pre>

<?php endif; ?>

</body>
</html>
