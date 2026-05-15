# Quotes SDK utility registration
require_relative '../core/utility_type'
require_relative 'clean'
require_relative 'done'
require_relative 'make_error'
require_relative 'feature_add'
require_relative 'feature_hook'
require_relative 'feature_init'
require_relative 'fetcher'
require_relative 'make_fetch_def'
require_relative 'make_context'
require_relative 'make_options'
require_relative 'make_request'
require_relative 'make_response'
require_relative 'make_result'
require_relative 'make_point'
require_relative 'make_spec'
require_relative 'make_url'
require_relative 'param'
require_relative 'prepare_auth'
require_relative 'prepare_body'
require_relative 'prepare_headers'
require_relative 'prepare_method'
require_relative 'prepare_params'
require_relative 'prepare_path'
require_relative 'prepare_query'
require_relative 'result_basic'
require_relative 'result_body'
require_relative 'result_headers'
require_relative 'transform_request'
require_relative 'transform_response'

QuotesUtility.registrar = ->(u) {
  u.clean = QuotesUtilities::Clean
  u.done = QuotesUtilities::Done
  u.make_error = QuotesUtilities::MakeError
  u.feature_add = QuotesUtilities::FeatureAdd
  u.feature_hook = QuotesUtilities::FeatureHook
  u.feature_init = QuotesUtilities::FeatureInit
  u.fetcher = QuotesUtilities::Fetcher
  u.make_fetch_def = QuotesUtilities::MakeFetchDef
  u.make_context = QuotesUtilities::MakeContext
  u.make_options = QuotesUtilities::MakeOptions
  u.make_request = QuotesUtilities::MakeRequest
  u.make_response = QuotesUtilities::MakeResponse
  u.make_result = QuotesUtilities::MakeResult
  u.make_point = QuotesUtilities::MakePoint
  u.make_spec = QuotesUtilities::MakeSpec
  u.make_url = QuotesUtilities::MakeUrl
  u.param = QuotesUtilities::Param
  u.prepare_auth = QuotesUtilities::PrepareAuth
  u.prepare_body = QuotesUtilities::PrepareBody
  u.prepare_headers = QuotesUtilities::PrepareHeaders
  u.prepare_method = QuotesUtilities::PrepareMethod
  u.prepare_params = QuotesUtilities::PrepareParams
  u.prepare_path = QuotesUtilities::PreparePath
  u.prepare_query = QuotesUtilities::PrepareQuery
  u.result_basic = QuotesUtilities::ResultBasic
  u.result_body = QuotesUtilities::ResultBody
  u.result_headers = QuotesUtilities::ResultHeaders
  u.transform_request = QuotesUtilities::TransformRequest
  u.transform_response = QuotesUtilities::TransformResponse
}
