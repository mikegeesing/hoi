<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

$token = $_GET['u'] ?? '';
$USER = decrypt_user($token);

if (!$USER) die("Ongeldig token");

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Bestanden herstellen – <?=htmlspecialchars($USER)?></title>
<style>
body { font-family: Arial; padding:20px; }
.item { cursor:pointer; padding:4px; }
.item:hover { background:#eee; }
.folder { font-weight:bold; color:#c79100; }
.file { color:#444; }
</style>
</head>
<body>

<h1>📁 Bestanden herstellen – <?=htmlspecialchars($USER)?></h1>

<select id="snapshot"></select>

<pre id="path">/</pre>

<div id="list"></div>

<script>
const token = "<?= $token ?>";

function loadSnapshots() {
    fetch("backup_times.php?u=" + token)
    .then(r => r.json())
    .then(snaps => {
        let s = document.getElementById("snapshot");
        snaps.forEach(v => {
            let o = document.createElement("option");
            o.value = v.snapshot;
            o.textContent = v.snapshot;
            s.appendChild(o);
        });
        loadPath("/");
    });
}

function loadPath(p) {
    let snap = document.getElementById("snapshot").value;
    document.getElementById("path").innerText = p;

    fetch("backup_files_list.php?u=" + token + "&snapshot=" + snap + "&path=" + p)
    .then(r=>r.json())
    .then(data => {
        let out = "";
        data.dirs.forEach(d => {
            out += `<div class='item folder' onclick="loadPath('${p}${d}/')">${d}/</div>`;
        });
        data.files.forEach(f => {
            out += `<div class='item file'>${f}</div>`;
        });
        document.getElementById("list").innerHTML = out;
    });
}

document.getElementById("snapshot").onchange = () => loadPath("/");
loadSnapshots();
</script>

</body>
</html>
