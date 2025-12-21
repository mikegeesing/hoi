<?php
$hex = getenv('BACKUP_SECRET_KEY_HEX');
$pass = getenv('BORG_PASSPHRASE');
if (!$hex || !$pass) {
	http_response_code(500);
	exit('Backup secrets not configured');
}
define('BACKUP_SECRET_KEY', hex2bin($hex));
define('BORG_PASSPHRASE', $pass);
