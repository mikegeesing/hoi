<?php
require_once __DIR__ . '/backup_crypto.php';

$token    = $_GET['u'] ?? '';
$snapshot = $_GET['snapshot'] ?? '';
$domain   = $_GET['domain'] ?? '';
$path     = trim($_GET['path'] ?? '', '/');

$USER = decrypt_user($token);
if (!$USER) die("Ongeldig token");

?>
<!DOCTYPE html>
<html lang="nl">
<head>
<meta charset="UTF-8">
<title>Backup browser – <?php echo htmlspecialchars($domain); ?></title>
<style>
body{font-family:Arial;padding:25px;}
.item{padding:6px;border-bottom:1px solid #eee;cursor:pointer;}
.folder{font-weight:bold;color:#c79100;}
.file{color:#444;}
</style>
</head>
<body>
<h2><?php echo $snapshot; ?> – <?php echo $domain; ?></h2>

<div id="fileList"></div>

<script>
function load(path="") {
    fetch("backup_browser_list.php?u=<?php echo $token; ?>&snapshot=<?php echo $snapshot; ?>&domain=<?php echo $domain; ?>&path="+encodeURIComponent(path))
    .then(r=>r.json())
    .then(data=>{
        let div=document.getElementById("fileList");
        div.innerHTML="";
        if (path !== "") {
            let up = path.split("/"); up.pop(); up = up.join("/");
            div.innerHTML += "<div class='item folder' onclick=\"load('"+up+"')\">.. (terug)</div>";
        }
        data.dirs.forEach(d=>{
            div.innerHTML += "<div class='item folder' onclick=\"load('"+(path?path+'/':'')+d+"\')\">"+d+"</div>";
        });
        data.files.forEach(f=>{
            div.innerHTML += "<div class='item file'>"+f+" <button onclick=\"restore('"+(path?path+'/':'')+f+"')\">Herstel</button></div>";
        });
    });
}

function restore(p){
    if(!confirm("Bestand herstellen: "+p+" ?")) return;
    window.location="restore.php?u=<?php echo $token; ?>&snapshot=<?php echo $snapshot; ?>&domain=<?php echo $domain; ?>&path="+encodeURIComponent(p);
}

load("");
</script>
</body>
</html>
