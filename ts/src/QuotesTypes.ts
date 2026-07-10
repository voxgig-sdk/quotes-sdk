// Typed models for the Quotes SDK.
//
// GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
// params (op.<name>.points[].args.params[]). Field/param types come from the
// canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
// @voxgig/apidef VALID_CANON). Do not edit by hand.

export interface Owner {
  github?: string
  name?: string
}

export interface OwnerLoadMatch {
  github?: string
  name?: string
}

export interface Quote {
  author?: string
  id?: number
  quote?: string
}

export interface QuoteLoadMatch {
  id?: number
  number?: number
}

export interface QuoteListMatch {
  author?: string
  id?: number
  quote?: string
}

