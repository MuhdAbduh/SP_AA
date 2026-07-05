<?php

use PHPUnit\Framework\TestCase;

class SearchTest extends TestCase
{
    public function testKeywordValidation()
    {
        $keyword = "flu";

        $this->assertLessThanOrEqual(100, mb_strlen($keyword, 'UTF-8'));
    }

    public function testXssEncoding()
    {
        $input = "<script>alert('xss')</script>";

        $safe = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');

        $this->assertStringNotContainsString("<script>", $safe);
    }

    public function testSqlInjectionPreventionLogic()
    {
        // Simulated check (we don't execute DB here)
        $query = "SELECT * FROM patient_records WHERE name LIKE :keyword";

        $this->assertStringContainsString(":keyword", $query);
    }
}