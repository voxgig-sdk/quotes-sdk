<?php
declare(strict_types=1);

// Quotes SDK exists test

require_once __DIR__ . '/../quotes_sdk.php';

use PHPUnit\Framework\TestCase;

class ExistsTest extends TestCase
{
    public function test_create_test_sdk(): void
    {
        $testsdk = QuotesSDK::test(null, null);
        $this->assertNotNull($testsdk);
    }
}
