<?php
declare(strict_types=1);

// Quotes SDK utility registration

require_once __DIR__ . '/../core/UtilityType.php';
require_once __DIR__ . '/Clean.php';
require_once __DIR__ . '/Done.php';
require_once __DIR__ . '/MakeError.php';
require_once __DIR__ . '/FeatureAdd.php';
require_once __DIR__ . '/FeatureHook.php';
require_once __DIR__ . '/FeatureInit.php';
require_once __DIR__ . '/Fetcher.php';
require_once __DIR__ . '/MakeFetchDef.php';
require_once __DIR__ . '/MakeContext.php';
require_once __DIR__ . '/MakeOptions.php';
require_once __DIR__ . '/MakeRequest.php';
require_once __DIR__ . '/MakeResponse.php';
require_once __DIR__ . '/MakeResult.php';
require_once __DIR__ . '/MakePoint.php';
require_once __DIR__ . '/MakeSpec.php';
require_once __DIR__ . '/MakeUrl.php';
require_once __DIR__ . '/Param.php';
require_once __DIR__ . '/PrepareAuth.php';
require_once __DIR__ . '/PrepareBody.php';
require_once __DIR__ . '/PrepareHeaders.php';
require_once __DIR__ . '/PrepareMethod.php';
require_once __DIR__ . '/PrepareParams.php';
require_once __DIR__ . '/PreparePath.php';
require_once __DIR__ . '/PrepareQuery.php';
require_once __DIR__ . '/ResultBasic.php';
require_once __DIR__ . '/ResultBody.php';
require_once __DIR__ . '/ResultHeaders.php';
require_once __DIR__ . '/TransformRequest.php';
require_once __DIR__ . '/TransformResponse.php';

QuotesUtility::setRegistrar(function (QuotesUtility $u): void {
    $u->clean = [QuotesClean::class, 'call'];
    $u->done = [QuotesDone::class, 'call'];
    $u->make_error = [QuotesMakeError::class, 'call'];
    $u->feature_add = [QuotesFeatureAdd::class, 'call'];
    $u->feature_hook = [QuotesFeatureHook::class, 'call'];
    $u->feature_init = [QuotesFeatureInit::class, 'call'];
    $u->fetcher = [QuotesFetcher::class, 'call'];
    $u->make_fetch_def = [QuotesMakeFetchDef::class, 'call'];
    $u->make_context = [QuotesMakeContext::class, 'call'];
    $u->make_options = [QuotesMakeOptions::class, 'call'];
    $u->make_request = [QuotesMakeRequest::class, 'call'];
    $u->make_response = [QuotesMakeResponse::class, 'call'];
    $u->make_result = [QuotesMakeResult::class, 'call'];
    $u->make_point = [QuotesMakePoint::class, 'call'];
    $u->make_spec = [QuotesMakeSpec::class, 'call'];
    $u->make_url = [QuotesMakeUrl::class, 'call'];
    $u->param = [QuotesParam::class, 'call'];
    $u->prepare_auth = [QuotesPrepareAuth::class, 'call'];
    $u->prepare_body = [QuotesPrepareBody::class, 'call'];
    $u->prepare_headers = [QuotesPrepareHeaders::class, 'call'];
    $u->prepare_method = [QuotesPrepareMethod::class, 'call'];
    $u->prepare_params = [QuotesPrepareParams::class, 'call'];
    $u->prepare_path = [QuotesPreparePath::class, 'call'];
    $u->prepare_query = [QuotesPrepareQuery::class, 'call'];
    $u->result_basic = [QuotesResultBasic::class, 'call'];
    $u->result_body = [QuotesResultBody::class, 'call'];
    $u->result_headers = [QuotesResultHeaders::class, 'call'];
    $u->transform_request = [QuotesTransformRequest::class, 'call'];
    $u->transform_response = [QuotesTransformResponse::class, 'call'];
});
