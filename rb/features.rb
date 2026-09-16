# Quotes SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/ratelimit_feature'
require_relative 'feature/retry_feature'
require_relative 'feature/test_feature'
require_relative 'feature/timeout_feature'


module QuotesFeatures
  def self.make_feature(name)
    case name
    when "base"
      QuotesBaseFeature.new
    when "ratelimit"
      QuotesRatelimitFeature.new
    when "retry"
      QuotesRetryFeature.new
    when "test"
      QuotesTestFeature.new
    when "timeout"
      QuotesTimeoutFeature.new
    else
      QuotesBaseFeature.new
    end
  end
end
