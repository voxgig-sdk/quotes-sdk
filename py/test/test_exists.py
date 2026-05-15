# ProjectName SDK exists test

import pytest
from quotes_sdk import QuotesSDK


class TestExists:

    def test_should_create_test_sdk(self):
        testsdk = QuotesSDK.test(None, None)
        assert testsdk is not None
