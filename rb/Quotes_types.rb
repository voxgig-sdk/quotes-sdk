# frozen_string_literal: true

# Typed models for the Quotes SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Member types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Ruby types are unenforced; these YARD
# annotations document the shapes. Do not edit by hand.

# Owner entity data model.
#
# @!attribute [rw] github
#   @return [String, nil]
#
# @!attribute [rw] name
#   @return [String, nil]
Owner = Struct.new(
  :github,
  :name,
  keyword_init: true
)

# Request payload for Owner#load.
#
# @!attribute [rw] github
#   @return [String, nil]
#
# @!attribute [rw] name
#   @return [String, nil]
OwnerLoadMatch = Struct.new(
  :github,
  :name,
  keyword_init: true
)

# Quote entity data model.
#
# @!attribute [rw] author
#   @return [String, nil]
#
# @!attribute [rw] id
#   @return [Integer, nil]
#
# @!attribute [rw] quote
#   @return [String, nil]
Quote = Struct.new(
  :author,
  :id,
  :quote,
  keyword_init: true
)

# Request payload for Quote#load.
#
# @!attribute [rw] id
#   @return [Integer, nil]
#
# @!attribute [rw] number
#   @return [Integer, nil]
QuoteLoadMatch = Struct.new(
  :id,
  :number,
  keyword_init: true
)

# Request payload for Quote#list.
#
# @!attribute [rw] author
#   @return [String, nil]
#
# @!attribute [rw] id
#   @return [Integer, nil]
#
# @!attribute [rw] quote
#   @return [String, nil]
QuoteListMatch = Struct.new(
  :author,
  :id,
  :quote,
  keyword_init: true
)

