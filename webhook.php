<?php
// GitHub Webhook Handler with Rate Limiting & Security
error_reporting(E_ALL);
ini_set('display_errors', 0);

define('LOG_FILE', '/var/log/github-webhook.log');
define('RATE_LIMIT_FILE', '/tmp/github-webhook-rate-limit');
define('RATE_LIMIT_THRESHOLD', 60); // seconds
define('MAX_REQUESTS_PER_MINUTE', 10);

// Log function
function webhook_log($message) {
    file_put_contents(LOG_FILE, date('[Y-m-d H:i:s] ') . $message . "\n", FILE_APPEND);
}

// Rate limiting check
function check_rate_limit() {
    $remote_ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $rate_key = $remote_ip;
    
    if (file_exists(RATE_LIMIT_FILE)) {
        $data = json_decode(file_get_contents(RATE_LIMIT_FILE), true) ?? [];
        $current_time = time();
        
        // Clean old entries
        foreach ($data as $key => $entry) {
            if ($current_time - $entry['time'] > 60) {
                unset($data[$key]);
            }
        }
        
        if (isset($data[$rate_key]) && count($data[$rate_key]) >= MAX_REQUESTS_PER_MINUTE) {
            return false;
        }
        
        $data[$rate_key][] = ['time' => $current_time];
        file_put_contents(RATE_LIMIT_FILE, json_encode($data));
    } else {
        $data = [$rate_key => [['time' => time()]]];
        file_put_contents(RATE_LIMIT_FILE, json_encode($data));
    }
    
    return true;
}

// Rate limit check
if (!check_rate_limit()) {
    http_response_code(429);
    webhook_log("Rate limit exceeded from {$_SERVER['REMOTE_ADDR']}");
    die(json_encode(['status' => 'error', 'message' => 'Rate limit exceeded']));
}

$payload = file_get_contents('php://input');
$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';

// Verify webhook signature (recommended - set via environment variable)
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$secret = getenv('GITHUB_WEBHOOK_SECRET') ?: '';

if ($secret) {
    if (!$signature) {
        http_response_code(403);
        webhook_log("Webhook rejected: Missing signature header");
        die(json_encode(['status' => 'error', 'message' => 'Missing signature']));
    }
    
    $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
    if (!hash_equals($hash, $signature)) {
        http_response_code(403);
        webhook_log("Webhook rejected: Invalid signature from {$_SERVER['REMOTE_ADDR']}");
        die(json_encode(['status' => 'error', 'message' => 'Invalid signature']));
    }
}

if ($event === 'push') {
    $data = json_decode($payload, true);
    $branch = basename($data['ref'] ?? '');
    $pusher = $data['pusher']['name'] ?? 'unknown';
    
    // Only pull from specific branch
    if ($branch !== 'onlinehoofdsite') {
        http_response_code(200);
        webhook_log("Ignored push to branch: $branch (pusher: $pusher)");
        die(json_encode(['status' => 'ignored', 'branch' => $branch]));
    }
    
    webhook_log("Processing push to $branch by $pusher");
    
    // Execute git pull
    $output = shell_exec('cd /home/onlineh/domains/onlinehoster.nl/public_html && git pull origin ' . escapeshellarg($branch) . ' 2>&1');
    
    webhook_log("Git pull result:\n$output");
    
    http_response_code(200);
    echo json_encode(['status' => 'success', 'branch' => $branch, 'pusher' => $pusher]);
} else {
    http_response_code(400);
    webhook_log("Ignored event type: $event");
    echo json_encode(['status' => 'ignored', 'message' => 'Not a push event']);
}
?>
