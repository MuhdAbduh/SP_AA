<?php

namespace SPAATests;

use PHPUnit\Framework\TestCase;
use SPAA\CryptoVault;

class CryptoVaultTest extends TestCase
{
    public function testEncryptionAndDecryption()
    {
        $vault = new CryptoVault("MyVeryStrongSecretKey");

        $message = "Patient Record";

        $encrypted = $vault->encrypt($message);

        $decrypted = $vault->decrypt($encrypted);

        $this->assertEquals($message, $decrypted);
    }

    public function testTamperedCiphertextThrowsException()
    {
        $vault = new CryptoVault("MyVeryStrongSecretKey");

        $encrypted = $vault->encrypt("Sensitive Data");

        $payload = json_decode($encrypted, true);

        // Tamper ciphertext
        $payload['ciphertext'] = base64_encode("HACKED");

        $tampered = json_encode($payload);

        $this->expectException(\Exception::class);

        $vault->decrypt($tampered);
    }
}