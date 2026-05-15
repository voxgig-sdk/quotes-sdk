# Quotes SDK utility: feature_add
module QuotesUtilities
  FeatureAdd = ->(ctx, f) {
    ctx.client.features << f
  }
end
