<?php
define('AES_KEY', hex2bin(getenv('AES_KEY_HEX'))); // Simpan key di env
define('CIPHER_AES', 'aes-256-cbc');

// Fungsi enkripsi
function encryptData($data) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(CIPHER_AES));
    $encrypted = openssl_encrypt($data, CIPHER_AES, AES_KEY, 0, $iv);
    return base64_encode($iv . $encrypted);
}

function encryptData2($data) {
    $encrypted = openssl_encrypt($data, CIPHER_AES, AES_KEY, 0);
    return base64_encode($encrypted);
}

// Fungsi dekripsi
function decryptData($encryptedData) {
    $decoded = base64_decode($encryptedData);
    $ivLength = openssl_cipher_iv_length(CIPHER_AES);
    if (strlen($decoded) < $ivLength) {
        return false;
    }
    $iv = substr($decoded, 0, $ivLength);
    $encrypted = substr($decoded, $ivLength);
    return openssl_decrypt($encrypted, CIPHER_AES, AES_KEY, 0, $iv);
}

function decryptData2($encryptedData) {
    $decoded = base64_decode($encryptedData);
    return openssl_decrypt($decoded, CIPHER_AES, AES_KEY, 0);
}

function secureEncrypt($data) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(CIPHER_AES));
    $encrypted = openssl_encrypt($data, CIPHER_AES, AES_KEY, 0, $iv);
    $cipherText = base64_encode($iv . $encrypted);

    // Hash dari hasil cipher text
    $hash = hash('sha256', $cipherText);

    // Gabungkan sebagai array json
    return base64_encode(json_encode([
        'data' => $cipherText,
        'hash' => $hash
    ]));
}

// Dekripsi + verifikasi SHA256
function secureDecrypt($input) {
    $decoded = json_decode(base64_decode($input), true);
    
    if (!isset($decoded['data']) || !isset($decoded['hash'])) {
        return false;
    }

    $cipherText = $decoded['data'];
    $expectedHash = $decoded['hash'];

    // Verifikasi hash integritas
    $actualHash = hash('sha256', $cipherText);
    if (!hash_equals($expectedHash, $actualHash)) {
        return false; // Data rusak atau dimodifikasi
    }

    // Lanjutkan dekripsi
    $cipherRaw = base64_decode($cipherText);
    $ivLength = openssl_cipher_iv_length(CIPHER_AES);
    $iv = substr($cipherRaw, 0, $ivLength);
    $encrypted = substr($cipherRaw, $ivLength);

    return openssl_decrypt($encrypted, CIPHER_AES, AES_KEY, 0, $iv);
}
?>