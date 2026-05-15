<?php
declare(strict_types=1);

// Quotes SDK utility: prepare_body

class QuotesPrepareBody
{
    public static function call(QuotesContext $ctx): mixed
    {
        if ($ctx->op->input === 'data') {
            return ($ctx->utility->transform_request)($ctx);
        }
        return null;
    }
}
