<?php
/**
 * Health Check Endpoint
 * Monitors system health for uptime monitoring services
 * 
 * Usage: https://onlinehoster.nl/health.php
 * Returns JSON with status and checks
 */

header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');

$checks = [];
$overallStatus = 'healthy';

// 1. Check filesystem write permissions
try {
    $testFile = __DIR__ . '/.health_check_test';
    if (@file_put_contents($testFile, 'test')) {
        @unlink($testFile);
        $checks['filesystem'] = [
            'status' => 'ok',
            'message' => 'Filesystem is writable'
        ];
    } else {
        $checks['filesystem'] = [
            'status' => 'error',
            'message' => 'Filesystem is not writable'
        ];
        $overallStatus = 'unhealthy';
    }
} catch (Exception $e) {
    $checks['filesystem'] = [
        'status' => 'error',
        'message' => 'Filesystem check failed: ' . $e->getMessage()
    ];
    $overallStatus = 'unhealthy';
}

// 2. Check database connection (if config exists)
if (file_exists(__DIR__ . '/configuration.php')) {
    try {
        require_once __DIR__ . '/configuration.php';
        
        if (defined('DB_HOST') && defined('DB_USERNAME') && defined('DB_PASSWORD') && defined('DB_NAME')) {
            $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            
            if ($mysqli->connect_error) {
                $checks['database'] = [
                    'status' => 'error',
                    'message' => 'Database connection failed'
                ];
                $overallStatus = 'unhealthy';
            } else {
                $checks['database'] = [
                    'status' => 'ok',
                    'message' => 'Database connection successful'
                ];
                $mysqli->close();
            }
        } else {
            $checks['database'] = [
                'status' => 'warning',
                'message' => 'Database credentials not configured'
            ];
        }
    } catch (Exception $e) {
        $checks['database'] = [
            'status' => 'error',
            'message' => 'Database check failed: ' . $e->getMessage()
        ];
        $overallStatus = 'unhealthy';
    }
} else {
    $checks['database'] = [
        'status' => 'skipped',
        'message' => 'Configuration file not found'
    ];
}

// 3. Check required directories
$requiredDirs = [
    'templates' => __DIR__ . '/templates',
    'templates_c' => __DIR__ . '/templates_c',
];

$dirStatus = 'ok';
$dirMessages = [];

foreach ($requiredDirs as $name => $path) {
    if (!is_dir($path)) {
        $dirStatus = 'error';
        $dirMessages[] = "$name directory missing";
        $overallStatus = 'unhealthy';
    } elseif (!is_writable($path)) {
        $dirStatus = 'warning';
        $dirMessages[] = "$name directory not writable";
    }
}

$checks['directories'] = [
    'status' => $dirStatus,
    'message' => empty($dirMessages) ? 'All directories present and writable' : implode(', ', $dirMessages)
];

// 4. Check PHP version
$phpVersion = phpversion();
$checks['php'] = [
    'status' => version_compare($phpVersion, '7.2.0', '>=') ? 'ok' : 'warning',
    'message' => "PHP version $phpVersion",
    'version' => $phpVersion
];

// 5. Check disk space
$diskFree = disk_free_space(__DIR__);
$diskTotal = disk_total_space(__DIR__);
$diskUsedPercent = (1 - ($diskFree / $diskTotal)) * 100;

$checks['disk_space'] = [
    'status' => $diskUsedPercent < 90 ? 'ok' : 'warning',
    'message' => sprintf('%.1f%% used', $diskUsedPercent),
    'free_gb' => round($diskFree / 1024 / 1024 / 1024, 2),
    'total_gb' => round($diskTotal / 1024 / 1024 / 1024, 2)
];

// 6. Check memory
$memoryLimit = ini_get('memory_limit');
$checks['memory'] = [
    'status' => 'ok',
    'message' => "Memory limit: $memoryLimit",
    'limit' => $memoryLimit
];

// 7. Check critical PHP extensions
$requiredExtensions = ['mysqli', 'curl', 'json', 'mbstring'];
$missingExtensions = [];

foreach ($requiredExtensions as $ext) {
    if (!extension_loaded($ext)) {
        $missingExtensions[] = $ext;
    }
}

$checks['php_extensions'] = [
    'status' => empty($missingExtensions) ? 'ok' : 'error',
    'message' => empty($missingExtensions) ? 'All required extensions loaded' : 'Missing: ' . implode(', ', $missingExtensions)
];

if (!empty($missingExtensions)) {
    $overallStatus = 'unhealthy';
}

// 8. Check if webhook is accessible
$webhookPath = __DIR__ . '/webhook.php';
$checks['webhook'] = [
    'status' => file_exists($webhookPath) ? 'ok' : 'warning',
    'message' => file_exists($webhookPath) ? 'Webhook handler exists' : 'Webhook handler not found'
];

// Build response
$response = [
    'status' => $overallStatus,
    'timestamp' => date('c'),
    'server_time' => time(),
    'hostname' => gethostname(),
    'checks' => $checks,
    'uptime' => function_exists('sys_getloadavg') ? sys_getloadavg() : null
];

// Set HTTP status code
http_response_code($overallStatus === 'healthy' ? 200 : 503);

// Output JSON
echo json_encode($response, JSON_PRETTY_PRINT);
