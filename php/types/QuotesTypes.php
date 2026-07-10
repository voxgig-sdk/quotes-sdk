<?php
declare(strict_types=1);

// Typed models for the Quotes SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
// params (op.<name>.points[].args.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.
//
// These are documentation-grade value objects (PHP 8 typed properties),
// registered on the composer classmap autoload. The SDK boundary exchanges
// assoc-arrays; these classes name the shapes for tooling and typed callers.

/** Owner entity data model. */
class Owner
{
    public ?string $github = null;
    public ?string $name = null;
}

/** Request payload for Owner#load. */
class OwnerLoadMatch
{
    public ?string $github = null;
    public ?string $name = null;
}

/** Quote entity data model. */
class Quote
{
    public ?string $author = null;
    public ?int $id = null;
    public ?string $quote = null;
}

/** Request payload for Quote#load. */
class QuoteLoadMatch
{
    public ?int $id = null;
    public ?int $number = null;
}

/** Request payload for Quote#list. */
class QuoteListMatch
{
    public ?string $author = null;
    public ?int $id = null;
    public ?string $quote = null;
}

