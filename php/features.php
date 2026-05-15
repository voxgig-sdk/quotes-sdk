<?php
declare(strict_types=1);

// Quotes SDK feature factory

require_once __DIR__ . '/feature/BaseFeature.php';
require_once __DIR__ . '/feature/TestFeature.php';


class QuotesFeatures
{
    public static function make_feature(string $name)
    {
        switch ($name) {
            case "base":
                return new QuotesBaseFeature();
            case "test":
                return new QuotesTestFeature();
            default:
                return new QuotesBaseFeature();
        }
    }
}
