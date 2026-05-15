# Quotes SDK feature factory

from feature.base_feature import QuotesBaseFeature
from feature.test_feature import QuotesTestFeature


def _make_feature(name):
    features = {
        "base": lambda: QuotesBaseFeature(),
        "test": lambda: QuotesTestFeature(),
    }
    factory = features.get(name)
    if factory is not None:
        return factory()
    return features["base"]()
