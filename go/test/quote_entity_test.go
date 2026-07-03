package sdktest

import (
	"encoding/json"
	"os"
	"path/filepath"
	"runtime"
	"strings"
	"testing"
	"time"

	sdk "github.com/voxgig-sdk/quotes-sdk/go"
	"github.com/voxgig-sdk/quotes-sdk/go/core"

	vs "github.com/voxgig-sdk/quotes-sdk/go/utility/struct"
)

func TestQuoteEntity(t *testing.T) {
	t.Run("instance", func(t *testing.T) {
		testsdk := sdk.TestSDK(nil, nil)
		ent := testsdk.Quote(nil)
		if ent == nil {
			t.Fatal("expected non-nil QuoteEntity")
		}
	})

	t.Run("basic", func(t *testing.T) {
		setup := quoteBasicSetup(nil)
		// Per-op sdk-test-control.json skip — basic test exercises a flow
		// with multiple ops; skipping any op skips the whole flow.
		_mode := "unit"
		if setup.live {
			_mode = "live"
		}
		for _, _op := range []string{"list", "load"} {
			if _shouldSkip, _reason := isControlSkipped("entityOp", "quote." + _op, _mode); _shouldSkip {
				if _reason == "" {
					_reason = "skipped via sdk-test-control.json"
				}
				t.Skip(_reason)
				return
			}
		}
		// The basic flow consumes synthetic IDs from the fixture. In live mode
		// without an *_ENTID env override, those IDs hit the live API and 4xx.
		if setup.syntheticOnly {
			t.Skip("live entity test uses synthetic IDs from fixture — set QUOTES_TEST_QUOTE_ENTID JSON to run live")
			return
		}
		client := setup.client

		// Bootstrap entity data from existing test data (no create step in flow).
		quoteRef01DataRaw := vs.Items(core.ToMapAny(vs.GetPath("existing.quote", setup.data)))
		var quoteRef01Data map[string]any
		if len(quoteRef01DataRaw) > 0 {
			quoteRef01Data = core.ToMapAny(quoteRef01DataRaw[0][1])
		}
		// Discard guards against Go's unused-var check when the flow's steps
		// happen not to consume the bootstrap data (e.g. list-only flows).
		_ = quoteRef01Data

		// LIST
		quoteRef01Ent := client.Quote(nil)
		quoteRef01Match := map[string]any{}

		quoteRef01ListResult, err := quoteRef01Ent.List(quoteRef01Match, nil)
		if err != nil {
			t.Fatalf("list failed: %v", err)
		}
		_, quoteRef01ListOk := quoteRef01ListResult.([]any)
		if !quoteRef01ListOk {
			t.Fatalf("expected list result to be an array, got %T", quoteRef01ListResult)
		}

		// LOAD
		quoteRef01MatchDt0 := map[string]any{
			"id": quoteRef01Data["id"],
		}
		quoteRef01DataDt0Loaded, err := quoteRef01Ent.Load(quoteRef01MatchDt0, nil)
		if err != nil {
			t.Fatalf("load failed: %v", err)
		}
		quoteRef01DataDt0LoadResult := core.ToMapAny(quoteRef01DataDt0Loaded)
		if quoteRef01DataDt0LoadResult == nil {
			t.Fatal("expected load result to be a map")
		}
		if quoteRef01DataDt0LoadResult["id"] != quoteRef01Data["id"] {
			t.Fatal("expected load result id to match")
		}

	})
}

func quoteBasicSetup(extra map[string]any) *entityTestSetup {
	loadEnvLocal()

	_, filename, _, _ := runtime.Caller(0)
	dir := filepath.Dir(filename)

	entityDataFile := filepath.Join(dir, "..", "..", ".sdk", "test", "entity", "quote", "QuoteTestData.json")

	entityDataSource, err := os.ReadFile(entityDataFile)
	if err != nil {
		panic("failed to read quote test data: " + err.Error())
	}

	var entityData map[string]any
	if err := json.Unmarshal(entityDataSource, &entityData); err != nil {
		panic("failed to parse quote test data: " + err.Error())
	}

	options := map[string]any{}
	options["entity"] = entityData["existing"]

	client := sdk.TestSDK(options, extra)

	// Generate idmap via transform, matching TS pattern.
	idmap := vs.Transform(
		[]any{"quote01", "quote02", "quote03", "random01", "random02", "random03"},
		map[string]any{
			"`$PACK`": []any{"", map[string]any{
				"`$KEY`": "`$COPY`",
				"`$VAL`": []any{"`$FORMAT`", "upper", "`$COPY`"},
			}},
		},
	)

	// Detect ENTID env override before envOverride consumes it. When live
	// mode is on without a real override, the basic test runs against synthetic
	// IDs from the fixture and 4xx's. Surface this so the test can skip.
	entidEnvRaw := os.Getenv("QUOTES_TEST_QUOTE_ENTID")
	idmapOverridden := entidEnvRaw != "" && strings.HasPrefix(strings.TrimSpace(entidEnvRaw), "{")

	env := envOverride(map[string]any{
		"QUOTES_TEST_QUOTE_ENTID": idmap,
		"QUOTES_TEST_LIVE":      "FALSE",
		"QUOTES_TEST_EXPLAIN":   "FALSE",
		"QUOTES_APIKEY":         "NONE",
	})

	idmapResolved := core.ToMapAny(env["QUOTES_TEST_QUOTE_ENTID"])
	if idmapResolved == nil {
		idmapResolved = core.ToMapAny(idmap)
	}

	if env["QUOTES_TEST_LIVE"] == "TRUE" {
		mergedOpts := vs.Merge([]any{
			map[string]any{
				"apikey": env["QUOTES_APIKEY"],
			},
			extra,
		})
		client = sdk.NewQuotesSDK(core.ToMapAny(mergedOpts))
	}

	live := env["QUOTES_TEST_LIVE"] == "TRUE"
	return &entityTestSetup{
		client:        client,
		data:          entityData,
		idmap:         idmapResolved,
		env:           env,
		explain:       env["QUOTES_TEST_EXPLAIN"] == "TRUE",
		live:          live,
		syntheticOnly: live && !idmapOverridden,
		now:           time.Now().UnixMilli(),
	}
}
