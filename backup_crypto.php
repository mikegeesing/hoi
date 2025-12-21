<?php

require_once __DIR__ . '/backup_secret.php';

/**
 * Maak een URL-veilige token van een username
 */
function encrypt_user(string $username): string
{
    $key    = BACKUP_SECRET_KEY;
    $cipher = 'aes-256-gcm';

    $iv = random_bytes(12); // aanbevolen voor GCM (12 bytes)

    $ciphertext = openssl_encrypt(
        $username,
        $cipher,
        $key,
        OPENSSL_RAW_DATA,
        $iv,
        $tag // 16-byte authentication tag
    );

    // IV (12) + TAG (16) + DATA
    $payload = $iv . $tag . $ciphertext;

    // URL-safe base64 (geen + / =)
    return rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');
}

/**
 * Haal de username terug uit de token
 */
function decrypt_user(string $hash): string|false
{
    $key    = BACKUP_SECRET_KEY;
    $cipher = 'aes-256-gcm';

    // terug naar normale base64
    $decoded = base64_decode(strtr($hash, '-_', '+/'));

    if ($decoded === false || strlen($decoded) < 28) {
        return false;
    }

    $iv         = substr($decoded, 0, 12);
    $tag        = substr($decoded, 12, 16);
    $ciphertext = substr($decoded, 28);

    return openssl_decrypt(
        $ciphertext,
        $cipher,
        $key,
        OPENSSL_RAW_DATA,
        $iv,
        $tag
    );
}
