<?php
declare(strict_types=1);

// Quotes SDK utility: result_body

class QuotesResultBody
{
    public static function call(QuotesContext $ctx): ?QuotesResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result && $response && $response->json_func && $response->body) {
            $result->body = ($response->json_func)();
        }
        return $result;
    }
}
