package core

var UtilityRegistrar func(u *Utility)

var NewBaseFeatureFunc func() Feature

var NewTestFeatureFunc func() Feature

var NewOwnerEntityFunc func(client *QuotesSDK, entopts map[string]any) QuotesEntity

var NewQuoteEntityFunc func(client *QuotesSDK, entopts map[string]any) QuotesEntity

