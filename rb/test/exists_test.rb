# Quotes SDK exists test

require "minitest/autorun"
require_relative "../Quotes_sdk"

class ExistsTest < Minitest::Test
  def test_create_test_sdk
    testsdk = QuotesSDK.test(nil, nil)
    assert !testsdk.nil?
  end
end
