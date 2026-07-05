<?php

namespace SPAA;

class CryptoVault
{
    private string $key;

    public function __construct(string $key)
    {
        // AES-256 requires a 32-byte key
        $this->key = hash('sha256', $key, true);
    }

    /**
     * Encrypt plaintext using AES-256-GCM
     */
    public function encrypt(string $plaintext): string
    {
        $iv = random_bytes(12);          // 12-byte IV (recommended for GCM)
        $tag = '';

        $ciphertext = openssl_encrypt(
            $plaintext,
            'aes-256-gcm',
            $this->key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        if ($ciphertext === false) {
            throw new \Exception("Encryption failed.");
        }

        return json_encode([
            'iv' => base64_encode($iv),
            'ciphertext' => base64_encode($ciphertext),
            'tag' => base64_encode($tag)
        ]);
    }

    /**
     * Decrypt AES-256-GCM payload
     */
    public function decrypt(string $payload): string
    {
        $data = json_decode($payload, true);

        if (!$data) {
            throw new \Exception("Invalid payload.");
        }

        $iv = base64_decode($data['iv']);
        $ciphertext = base64_decode($data['ciphertext']);
        $tag = base64_decode($data['tag']);

        $plaintext = openssl_decrypt(
            $ciphertext,
            'aes-256-gcm',
            $this->key,
            OPENSSL_RAW_DATA,
            $iv,
            $tag
        );

        if ($plaintext === false) {
            throw new \Exception("Authentication failed.");
        }

        return $plaintext;
    }
}