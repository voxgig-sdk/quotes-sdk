package voxgigquotessdk

import (
	"github.com/voxgig-sdk/quotes-sdk/go/core"
	"github.com/voxgig-sdk/quotes-sdk/go/entity"
	"github.com/voxgig-sdk/quotes-sdk/go/feature"
	_ "github.com/voxgig-sdk/quotes-sdk/go/utility"
)

// Type aliases preserve external API.
type QuotesSDK = core.QuotesSDK
type Context = core.Context
type Utility = core.Utility
type Feature = core.Feature
type Entity = core.Entity
type QuotesEntity = core.QuotesEntity
type FetcherFunc = core.FetcherFunc
type Spec = core.Spec
type Result = core.Result
type Response = core.Response
type Operation = core.Operation
type Control = core.Control
type QuotesError = core.QuotesError

// BaseFeature from feature package.
type BaseFeature = feature.BaseFeature

func init() {
	core.NewBaseFeatureFunc = func() core.Feature {
		return feature.NewBaseFeature()
	}
	core.NewTestFeatureFunc = func() core.Feature {
		return feature.NewTestFeature()
	}
	core.NewOwnerEntityFunc = func(client *core.QuotesSDK, entopts map[string]any) core.QuotesEntity {
		return entity.NewOwnerEntity(client, entopts)
	}
	core.NewQuoteEntityFunc = func(client *core.QuotesSDK, entopts map[string]any) core.QuotesEntity {
		return entity.NewQuoteEntity(client, entopts)
	}
}

// Constructor re-exports.
var NewQuotesSDK = core.NewQuotesSDK
var TestSDK = core.TestSDK
var NewContext = core.NewContext
var NewSpec = core.NewSpec
var NewResult = core.NewResult
var NewResponse = core.NewResponse
var NewOperation = core.NewOperation
var MakeConfig = core.MakeConfig
var NewBaseFeature = feature.NewBaseFeature
var NewTestFeature = feature.NewTestFeature
