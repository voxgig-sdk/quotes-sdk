<?php
declare(strict_types=1);

// Quotes SDK utility: feature_add

class QuotesFeatureAdd
{
    public static function call(QuotesContext $ctx, mixed $f): void
    {
        $ctx->client->features[] = $f;
    }
}
