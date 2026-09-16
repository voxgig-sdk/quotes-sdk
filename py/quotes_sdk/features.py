# Quotes SDK feature factory

from quotes_sdk.feature.base_feature import QuotesBaseFeature
from quotes_sdk.feature.ratelimit_feature import QuotesRatelimitFeature
from quotes_sdk.feature.retry_feature import QuotesRetryFeature
from quotes_sdk.feature.test_feature import QuotesTestFeature
from quotes_sdk.feature.timeout_feature import QuotesTimeoutFeature


_FEATURES = {
    "base": lambda: QuotesBaseFeature(),
    "ratelimit": lambda: QuotesRatelimitFeature(),
    "retry": lambda: QuotesRetryFeature(),
    "test": lambda: QuotesTestFeature(),
    "timeout": lambda: QuotesTimeoutFeature(),
}


def _make_feature(name):
    factory = _FEATURES.get(name)
    if factory is not None:
        return factory()
    return _FEATURES["base"]()


# True when this SDK was generated with the named feature class - the
# constructor's tolerance for extend-carried features reads this (an
# active name with no generated class must not become a BaseFeature
# stray when an extend instance carries it).
def _has_feature(name):
    return name in _FEATURES
