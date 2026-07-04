# Typed models for the Quotes SDK.
#
# GENERATED from the API model: main.kit.entity.<e>.fields[] and per-op
# params (op.<name>.points[].args.params[]). Field/param types come from the
# canonical type sentinels via @voxgig/sdkgen canonToType (source of truth:
# @voxgig/apidef VALID_CANON). Do not edit by hand.

from __future__ import annotations

from dataclasses import dataclass
from typing import Optional, Any


@dataclass
class Owner:
    github: Optional[str] = None
    name: Optional[str] = None


@dataclass
class OwnerLoadMatch:
    github: Optional[str] = None
    name: Optional[str] = None


@dataclass
class Quote:
    author: Optional[str] = None
    id: Optional[int] = None
    quote: Optional[str] = None


@dataclass
class QuoteLoadMatch:
    id: int
    number: int


@dataclass
class QuoteListMatch:
    author: Optional[str] = None
    id: Optional[int] = None
    quote: Optional[str] = None

