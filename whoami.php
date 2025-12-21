<?php
$allowed = in_array($_SERVER['REMOTE_ADDR'] ?? '', ['127.0.0.1', '::1']);
if (!$allowed) {
	http_response_code(403);
	exit();
}
echo "User: " . get_current_user();
echo "<br>UID: " . posix_geteuid();
echo "<br>Process owner: " . getmyuid();
