<?php
declare(strict_types=1);

// Quotes SDK utility: make_context

require_once __DIR__ . '/../core/Context.php';

class QuotesMakeContext
{
    public static function call(array $ctxmap, ?QuotesContext $basectx): QuotesContext
    {
        return new QuotesContext($ctxmap, $basectx);
    }
}
