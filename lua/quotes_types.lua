-- Typed models for the Quotes SDK (LuaLS annotations).
--
-- GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
-- params (op.<name>.points[].args.params[]). Field/param types come from the
-- canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
-- @voxgig/apidef VALID_CANON). Annotations only — no runtime effect. Do not
-- edit by hand.

---@class Owner
---@field github? string
---@field name? string

---@class OwnerLoadMatch
---@field github? string
---@field name? string

---@class Quote
---@field author? string
---@field id? number
---@field quote? string

---@class QuoteLoadMatch
---@field id? number
---@field number? number

---@class QuoteListMatch
---@field author? string
---@field id? number
---@field quote? string

local M = {}

return M
