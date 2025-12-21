<?php
// GitHub Webhook Handler
$payload = file_get_contents('php://input');
$event = $_SERVER['HTTP_X_GITHUB_EVENT'] ?? '';

// Verify webhook signature (optional but recommended)
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$secret = getenv('GITHUB_WEBHOOK_SECRET') ?: '';

if ($secret && $signature) {
    $hash = 'sha256=' . hash_hmac('sha256', $payload, $secret);
    if (!hash_equals($hash, $signature)) {
        http_response_code(403);
        die('Signature verification failed');
    }
}

if ($event === 'push') {
    $data = json_decode($payload, true);
    $branch = basename($data['ref'] ?? '');
    
    // Execute git pull
    $output = shell_exec('cd /home/onlineh/domains/onlinehoster.nl/public_html && git pull origin ' . escapeshellarg($branch) . ' 2>&1');
    
    // Log the result
    file_put_contents('/var/log/github-webhook.log', date('[Y-m-d H:i:s] ') . "Branch: $branch\n" . $output . "\n\n", FILE_APPEND);
    
    http_response_code(200);
    echo json_encode(['status' => 'success', 'branch' => $branch]);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Not a push event']);
}
?>
