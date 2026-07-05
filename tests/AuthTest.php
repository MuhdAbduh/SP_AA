<?php

use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testValidPassword()
    {
        $password = "test123";

        $hash = password_hash($password, PASSWORD_ARGON2ID);

        $this->assertTrue(password_verify($password, $hash));
    }

    public function testInvalidPassword()
    {
        $password = "test123";
        $wrong = "wrongpass";

        $hash = password_hash($password, PASSWORD_ARGON2ID);

        $this->assertFalse(password_verify($wrong, $hash));
    }

    public function testLengthValidation()
    {
        $input = str_repeat("a", 300);

        $this->assertTrue(mb_strlen($input, 'UTF-8') > 256);
    }
}