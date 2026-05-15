# Quotes SDK feature factory

require_relative 'feature/base_feature'
require_relative 'feature/test_feature'


module QuotesFeatures
  def self.make_feature(name)
    case name
    when "base"
      QuotesBaseFeature.new
    when "test"
      QuotesTestFeature.new
    else
      QuotesBaseFeature.new
    end
  end
end
