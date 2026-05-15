# Quotes SDK utility: make_context

from core.context import QuotesContext


def make_context_util(ctxmap, basectx):
    return QuotesContext(ctxmap, basectx)
