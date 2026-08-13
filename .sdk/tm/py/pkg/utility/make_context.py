# Quotes SDK utility: make_context

from projectname_sdk.core.context import QuotesContext


def make_context_util(ctxmap, basectx):
    return QuotesContext(ctxmap, basectx)
