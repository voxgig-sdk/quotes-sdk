<?php
declare(strict_types=1);

// Quotes SDK utility: result_headers

class QuotesResultHeaders
{
    public static function call(QuotesContext $ctx): ?QuotesResult
    {
        $response = $ctx->response;
        $result = $ctx->result;
        if ($result) {
            if ($response && is_array($response->headers)) {
                $result->headers = $response->headers;
            } else {
                $result->headers = [];
            }
        }
        return $result;
    }
}
