# Quotes SDK utility: make_context
require_relative '../core/context'
module QuotesUtilities
  MakeContext = ->(ctxmap, basectx) {
    QuotesContext.new(ctxmap, basectx)
  }
end
