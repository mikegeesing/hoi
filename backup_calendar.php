<?php
require_once __DIR__ . '/backup_crypto.php';
require_once __DIR__ . '/backup_secret.php';

putenv("BORG_PASSPHRASE=" . BORG_PASSPHRASE);

// === TEMP BORGLIST DEBUG ===
$cmd = 'borg list /backups --short --bypass-lock 2>&1';
file_put_contents(
    '/tmp/debug_borg.txt',
    "CMD: $cmd\n\nOUTPUT:\n" . shell_exec($cmd)
);
// === EINDE DEBUG ===


$token = $_GET['u'] ?? '';
$USER = decrypt_user($token);

if ($USER === false) {
    die("Ongeldig token");
}

$USER = preg_replace('/[^a-zA-Z0-9_]/', '', $USER);


// Domeinen ophalen (alleen van deze user)
$domains_raw = shell_exec("sudo /usr/local/bin/get_domains_wrapper.sh " . escapeshellarg($USER));
$domains = array_filter(explode("\n", trim($domains_raw)));


function list_snapshots($repo) {
$out = shell_exec("borg list --lock-wait 0 --bypass-lock $repo --short 2>/dev/null");

    if (!$out) return [];

    $snaps = array_filter(explode("\n", trim($out)));
    $dates = [];

    // Match: server-YYYY-MM-DDTHH:MM:SS(.microseconds)
    foreach ($snaps as $snap) {
        if (preg_match('/server-(\d{4}-\d{2}-\d{2})T(\d{2}:\d{2}:\d{2})(\.\d+)?/', $snap, $m)) {
            $date = $m[1];
            $time = $m[2];
            $dates[$date][] = $time;
        }
    }

    return $dates;
}

$dates = list_snapshots("/backups");

$BACKUP_REPO = "/backups";
$snapshots = list_snapshots($BACKUP_REPO);

file_put_contents("/tmp/debug_calendar.log", "SNAPS:\n" . print_r($snapshots, true));

$dates = $snapshots;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Backups herstellen</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
.day{width:45px;height:45px;line-height:45px;text-align:center;margin:3px;border-radius:5px;cursor:pointer;}
.day.disabled{background:#eee;color:#999;}
.day.active{background:#0d6efd;color:white;}
</style>
</head>
<body class="p-4">

<h2>🔄 Backups herstellen voor gebruiker: <b><?= htmlspecialchars($USER) ?></b></h2>
<hr>

<?php
$year  = date("Y");
$month = date("m");
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
?>

<h4><?= date("F Y") ?></h4>

<div class="d-flex flex-wrap">
<?php for ($d=1; $d <= $daysInMonth; $d++):
    $date = sprintf("%04d-%02d-%02d", $year, $month, $d);
    $enabled = isset($dates[$date]);
?>
    <div class="day <?= $enabled ? "" : "disabled" ?>" data-date="<?= $date ?>">
        <?= $d ?>
    </div>
<?php endfor; ?>
</div>

<hr>

<form id="restoreForm">

    <input type="hidden" name="date" id="date">

    <div class="row">
        <div class="col-md-4">
            <label>Tijd</label>
<select name="snapshot" id="timeSelect" class="form-select"></select>

        </div>

        <div class="col-md-4">
            <label>Domein</label>
            <select name="domain" id="domainSelect" class="form-select" required>
                <option value="">-- kies --</option>
                <?php foreach ($domains as $d): ?>
                    <option value="<?= $d ?>"><?= $d ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label>Wat herstellen?</label>
            <select name="type" id="typeSelect" class="form-select">
                <option value="files">Website bestanden</option>
                <option value="database">Database</option>
            </select>
        </div>
    </div>

    <div class="row mt-3" id="dbRow" style="display:none;">
        <div class="col-md-6">
            <label>Kies database</label>
            <select name="database" id="dbSelect" class="form-select"></select>
        </div>
    </div>

    <button type="button" class="btn btn-primary mt-4" onclick="startRestore()">Start restore</button>

</form>

<!-- PROGRESS MODAL -->
<div class="modal fade" id="progressModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <h4>Restore bezig...</h4>
      <div class="progress mt-3">
        <div id="progressBar" class="progress-bar" role="progressbar" style="width:0%">0%</div>
      </div>
      <pre id="progressLog" class="mt-3" style="max-height:200px;overflow:auto;"></pre>
    </div>
  </div>
</div>

<script>
// Toggle database detectie
document.getElementById("typeSelect").addEventListener("change", function() {
    if (this.value === "database") {
        document.getElementById("dbRow").style.display = "block";

        let domain = document.getElementById("domainSelect").value;

        fetch("backup_scan_databases.php?domain=" + domain + "&u=<?= $token ?>")
        .then(r => r.json())
        .then(dbs => {
            let sel = document.getElementById("dbSelect");
            sel.innerHTML = "";
            dbs.forEach(db => {
                let opt = document.createElement("option");
                opt.value = db;
                opt.textContent = db;
                sel.appendChild(opt);
            });
        });

    } else {
        document.getElementById("dbRow").style.display = "none";
    }
});

// Datum kiezen → laadt tijden
document.querySelectorAll(".day").forEach(el => {
    if (el.classList.contains("disabled")) return;

    el.addEventListener("click", () => {
        document.querySelectorAll(".day").forEach(e=>e.classList.remove("active"));
        el.classList.add("active");

        let date = el.dataset.date;
        document.getElementById("date").value = date;

        fetch("backup_times.php?date=" + date)
            .then(r=>r.json())
            .then(times => {
                let sel = document.getElementById("timeSelect");
                sel.innerHTML = "";
                   times.forEach(row => {
                    let opt = document.createElement("option");
                    opt.value = row.snapshot;   // volledige naam inclusief microseconden
                    opt.textContent = row.time; // alleen HH:MM:SS tonen
                    sel.appendChild(opt);
                });
            });
    });
});

function startRestore() {
    const form = new FormData(document.getElementById("restoreForm"));
    form.append("u", "<?= $token ?>");

    // Open modal
    new bootstrap.Modal(document.getElementById('progressModal')).show();

    // Start restore
    fetch("backup_restore.php", {
        method: "POST",
        body: form
    });

    // Start polling
    pollProgress();
}

function pollProgress() {
    fetch("backup_restore.php?progress=1&u=<?= $token ?>")
    .then(r=>r.json())
    .then(data => {

        document.getElementById("progressBar").style.width = data.percent + "%";
        document.getElementById("progressBar").innerText = data.percent + "%";
        document.getElementById("progressLog").innerText = data.log;

        if (!data.done) {
            setTimeout(pollProgress, 500);
        }
    });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

