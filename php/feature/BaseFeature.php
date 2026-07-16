<?php
declare(strict_types=1);

// Quotes SDK base feature

class QuotesBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    // Positions this feature when added via the client `extend` option:
    // "__before__" / "__after__" / "__replace__" name an already-added
    // feature (mirrors the ts feature `_options`). Declared so setting it
    // on an extension instance avoids the dynamic-property deprecation.
    public ?array $_options = null;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(QuotesContext $ctx, array $options): void {}
    public function PostConstruct(QuotesContext $ctx): void {}
    public function PostConstructEntity(QuotesContext $ctx): void {}
    public function SetData(QuotesContext $ctx): void {}
    public function GetData(QuotesContext $ctx): void {}
    public function GetMatch(QuotesContext $ctx): void {}
    public function SetMatch(QuotesContext $ctx): void {}
    public function PrePoint(QuotesContext $ctx): void {}
    public function PreSpec(QuotesContext $ctx): void {}
    public function PreRequest(QuotesContext $ctx): void {}
    public function PreResponse(QuotesContext $ctx): void {}
    public function PreResult(QuotesContext $ctx): void {}
    public function PreDone(QuotesContext $ctx): void {}
    public function PreUnexpected(QuotesContext $ctx): void {}
}
