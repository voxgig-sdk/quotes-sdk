<?php
declare(strict_types=1);

// Quotes SDK log feature

require_once __DIR__ . '/BaseFeature.php';

class QuotesLogFeature extends QuotesBaseFeature
{
    private mixed $client;
    private ?array $options;
    private mixed $logger;

    public function __construct()
    {
        parent::__construct();
        $this->version = '0.0.1';
        $this->name = 'log';
        $this->active = true;
        $this->client = null;
        $this->options = null;
        $this->logger = null;
    }

    public function init(QuotesContext $ctx, array $options): void
    {
        $this->client = $ctx->client;
        $this->options = $options;
        $this->active = ($options['active'] ?? null) === true;

        if ($this->active) {
            if (isset($options['logger'])) {
                $this->logger = $options['logger'];
            } else {
                $this->logger = STDERR;
            }
        }
    }

    private function _loghook(string $hook, QuotesContext $ctx, string $level = 'info'): void
    {
        if (!$this->logger) {
            return;
        }
        $opname = $ctx->op ? $ctx->op->name : '';
        $msg = "hook={$hook} op={$opname}";
        if (is_resource($this->logger)) {
            fwrite($this->logger, "[" . strtoupper($level) . "] {$msg}\n");
        } elseif (is_callable($this->logger)) {
            ($this->logger)("[" . strtoupper($level) . "] {$msg}");
        }
    }

    public function PostConstruct(QuotesContext $ctx): void { $this->_loghook('PostConstruct', $ctx); }
    public function PostConstructEntity(QuotesContext $ctx): void { $this->_loghook('PostConstructEntity', $ctx); }
    public function SetData(QuotesContext $ctx): void { $this->_loghook('SetData', $ctx); }
    public function GetData(QuotesContext $ctx): void { $this->_loghook('GetData', $ctx); }
    public function SetMatch(QuotesContext $ctx): void { $this->_loghook('SetMatch', $ctx); }
    public function GetMatch(QuotesContext $ctx): void { $this->_loghook('GetMatch', $ctx); }
    public function PrePoint(QuotesContext $ctx): void { $this->_loghook('PrePoint', $ctx); }
    public function PreSpec(QuotesContext $ctx): void { $this->_loghook('PreSpec', $ctx); }
    public function PreRequest(QuotesContext $ctx): void { $this->_loghook('PreRequest', $ctx); }
    public function PreResponse(QuotesContext $ctx): void { $this->_loghook('PreResponse', $ctx); }
    public function PreResult(QuotesContext $ctx): void { $this->_loghook('PreResult', $ctx); }
}
