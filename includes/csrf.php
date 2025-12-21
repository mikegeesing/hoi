<?php
/**
 * CSRF Protection Helper
 * Provides token generation and validation for forms
 * 
 * Usage:
 *   // In form:
 *   echo CSRF::getTokenInput();
 * 
 *   // On submit:
 *   if (!CSRF::validateToken($_POST['csrf_token'])) {
 *       die('Invalid CSRF token');
 *   }
 */

class CSRF {
    private static $tokenName = 'csrf_token';
    private static $sessionKey = 'csrf_tokens';
    
    /**
     * Initialize session if not started
     */
    private static function initSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION[self::$sessionKey])) {
            $_SESSION[self::$sessionKey] = [];
        }
    }
    
    /**
     * Generate a new CSRF token
     * @return string The generated token
     */
    public static function generateToken() {
        self::initSession();
        
        // Generate random token
        $token = bin2hex(random_bytes(32));
        
        // Store in session with timestamp
        $_SESSION[self::$sessionKey][$token] = time();
        
        // Clean old tokens (older than 1 hour)
        self::cleanOldTokens();
        
        return $token;
    }
    
    /**
     * Validate a CSRF token
     * @param string $token The token to validate
     * @return bool True if valid, false otherwise
     */
    public static function validateToken($token) {
        self::initSession();
        
        if (empty($token)) {
            return false;
        }
        
        // Check if token exists in session
        if (!isset($_SESSION[self::$sessionKey][$token])) {
            return false;
        }
        
        // Check if token is not expired (1 hour)
        $tokenTime = $_SESSION[self::$sessionKey][$token];
        if (time() - $tokenTime > 3600) {
            unset($_SESSION[self::$sessionKey][$token]);
            return false;
        }
        
        // Token is valid, remove it (one-time use)
        unset($_SESSION[self::$sessionKey][$token]);
        
        return true;
    }
    
    /**
     * Get HTML input field with CSRF token
     * @return string HTML input field
     */
    public static function getTokenInput() {
        $token = self::generateToken();
        return '<input type="hidden" name="' . self::$tokenName . '" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }
    
    /**
     * Get CSRF token value (for AJAX)
     * @return string The token value
     */
    public static function getToken() {
        return self::generateToken();
    }
    
    /**
     * Clean tokens older than 1 hour
     */
    private static function cleanOldTokens() {
        $now = time();
        foreach ($_SESSION[self::$sessionKey] as $token => $time) {
            if ($now - $time > 3600) {
                unset($_SESSION[self::$sessionKey][$token]);
            }
        }
    }
    
    /**
     * Verify token from request (works with GET/POST)
     * @param array $data Request data ($_POST or $_GET)
     * @return bool True if valid
     */
    public static function verifyRequest($data = null) {
        if ($data === null) {
            $data = $_REQUEST;
        }
        
        $token = isset($data[self::$tokenName]) ? $data[self::$tokenName] : '';
        return self::validateToken($token);
    }
    
    /**
     * Require valid token or die with error
     * @param string $message Error message to display
     */
    public static function requireToken($message = 'Invalid or expired security token. Please try again.') {
        if (!self::verifyRequest()) {
            http_response_code(403);
            die($message);
        }
    }
}

/**
 * Simple helper functions
 */
function csrf_token() {
    return CSRF::getToken();
}

function csrf_field() {
    return CSRF::getTokenInput();
}

function csrf_verify($data = null) {
    return CSRF::verifyRequest($data);
}
