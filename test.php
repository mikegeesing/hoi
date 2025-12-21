<?php
$allowed = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']);
if (!$allowed) {
	http_response_code(403);
	exit();
}
phpinfo();

