# Quotes SDK

Fetch motivational quotes one at a time, in bulk, or at random

> TypeScript, Python, PHP, Golang, Ruby, Lua SDKs, a CLI, an interactive REPL, and an MCP server for AI agents — all generated from one OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).

## About Quotes API

The Motivational Spark Quotes API is a small public service that serves a curated collection of motivational quotes. It is built and maintained by [Subham Kumar Sinha](https://github.com/subhamsinhadev) and hosted on Vercel.

What you get from the API:

- `GET /quotes` returns the complete collection of quotes
- `GET /quotes/random` returns one random quote
- `GET /quotes/random/{n}` returns `n` random quotes (e.g. `/quotes/random/10`)
- `GET /quotes/{index}` returns a single quote by 1-based index
- `GET /owner` returns information about the creator

The service is read-only over HTTPS and has CORS enabled, so it can be called directly from browser clients. The freepublicapis.com directory lists no authentication or rate limit requirements.

## Try it

**TypeScript**
```bash
npm install quotes
```

**Python**
```bash
pip install quotes-sdk
```

**PHP**
```bash
composer require voxgig/quotes-sdk
```

**Golang**
```bash
go get github.com/voxgig-sdk/quotes-sdk/go
```

**Ruby**
```bash
gem install quotes-sdk
```

**Lua**
```bash
luarocks install quotes-sdk
```

## 30-second quickstart

### TypeScript

```ts
import { QuotesSDK } from 'quotes'

const client = new QuotesSDK({})

```

See the [TypeScript README](ts/README.md) for the
full guide, or scroll down for the same example in other languages.

## What's in the box

| Surface | Use it for | Path |
| --- | --- | --- |
| **SDK** (TypeScript, Python, PHP, Golang, Ruby, Lua) | App integration | `ts/` `py/` `php/` `go/` `rb/` `lua/` |
| **CLI** | Scripts, CI, ops, one-off API calls | `go-cli/` |
| **MCP server** | AI agents (Claude, Cursor, Cline) | `go-mcp/` |

## Use it from an AI agent (MCP)

The generated MCP server exposes every operation in this SDK as an
[MCP](https://modelcontextprotocol.io) tool that Claude, Cursor or Cline
can call directly. Build and register it:

```bash
cd go-mcp && go build -o quotes-mcp .
```

Then add it to your agent's MCP config (Claude Desktop, Cursor, etc.):

```json
{
  "mcpServers": {
    "quotes": {
      "command": "/abs/path/to/quotes-mcp"
    }
  }
}
```

## Entities

The API exposes 2 entities:

| Entity | Description | API path |
| --- | --- | --- |
| **Owner** | Metadata about the API creator, returned by `GET /owner`. | `/owner` |
| **Quote** | An individual motivational quote, exposed via `GET /quotes`, `GET /quotes/{index}`, `GET /quotes/random`, and `GET /quotes/random/{n}`. | `/quotes` |

Each entity supports the following operations where available: **load**,
**list**, **create**, **update**, and **remove**.

## Quickstart in other languages

### Python

```python
from quotes_sdk import QuotesSDK

client = QuotesSDK({})


# Load a specific owner
owner, err = client.Owner(None).load(
    {"id": "example_id"}, None
)
```

### PHP

```php
<?php
require_once 'quotes_sdk.php';

$client = new QuotesSDK([]);


// Load a specific owner
[$owner, $err] = $client->Owner(null)->load(
    ["id" => "example_id"], null
);
```

### Golang

```go
import sdk "github.com/voxgig-sdk/quotes-sdk/go"

client := sdk.NewQuotesSDK(map[string]any{})

```

### Ruby

```ruby
require_relative "Quotes_sdk"

client = QuotesSDK.new({})


# Load a specific owner
owner, err = client.Owner(nil).load(
  { "id" => "example_id" }, nil
)
```

### Lua

```lua
local sdk = require("quotes_sdk")

local client = sdk.new({})


-- Load a specific owner
local owner, err = client:Owner(nil):load(
  { id = "example_id" }, nil
)
```

## Unit testing in offline mode

Every SDK ships a test mode that swaps the HTTP transport for an
in-memory mock, so unit tests run offline.

### TypeScript

```ts
const client = QuotesSDK.test()
const result = await client.Owner().load({ id: 'test01' })
// result.ok === true, result.data contains mock data
```

### Python

```python
client = QuotesSDK.test(None, None)
result, err = client.Owner(None).load(
    {"id": "test01"}, None
)
```

### PHP

```php
$client = QuotesSDK::test(null, null);
[$result, $err] = $client->Owner(null)->load(
    ["id" => "test01"], null
);
```

### Golang

```go
client := sdk.TestSDK(nil, nil)
result, err := client.Owner(nil).Load(
    map[string]any{"id": "test01"}, nil,
)
```

### Ruby

```ruby
client = QuotesSDK.test(nil, nil)
result, err = client.Owner(nil).load(
  { "id" => "test01" }, nil
)
```

### Lua

```lua
local client = sdk.test(nil, nil)
local result, err = client:Owner(nil):load(
  { id = "test01" }, nil
)
```

## How it works

Every SDK call runs the same five-stage pipeline:

1. **Point** — resolve the API endpoint from the operation definition.
2. **Spec** — build the HTTP specification (URL, method, headers, body).
3. **Request** — send the HTTP request.
4. **Response** — receive and parse the response.
5. **Result** — extract the result data for the caller.

A feature hook fires at each stage (e.g. `PrePoint`, `PreSpec`,
`PreRequest`), so features can inspect or modify the pipeline without
forking the SDK.

### Features

| Feature | Purpose |
| --- | --- |
| **TestFeature** | In-memory mock transport for testing without a live server |

Pass custom features via the `extend` option at construction time.

### Direct and Prepare

For endpoints the entity model doesn't cover, use the low-level methods:

- **`direct(fetchargs)`** — build and send an HTTP request in one step.
- **`prepare(fetchargs)`** — build the request without sending it.

Both accept a map with `path`, `method`, `params`, `query`,
`headers`, and `body`. See the [How-to guides](#how-to-guides) below.

## How-to guides

### Make a direct API call

When the entity interface does not cover an endpoint, use `direct`:

**TypeScript:**
```ts
const result = await client.direct({
  path: '/api/resource/{id}',
  method: 'GET',
  params: { id: 'example' },
})
console.log(result.data)
```

**Python:**
```python
result, err = client.direct({
    "path": "/api/resource/{id}",
    "method": "GET",
    "params": {"id": "example"},
})
```

**PHP:**
```php
[$result, $err] = $client->direct([
    "path" => "/api/resource/{id}",
    "method" => "GET",
    "params" => ["id" => "example"],
]);
```

**Go:**
```go
result, err := client.Direct(map[string]any{
    "path":   "/api/resource/{id}",
    "method": "GET",
    "params": map[string]any{"id": "example"},
})
```

**Ruby:**
```ruby
result, err = client.direct({
  "path" => "/api/resource/{id}",
  "method" => "GET",
  "params" => { "id" => "example" },
})
```

**Lua:**
```lua
local result, err = client:direct({
  path = "/api/resource/{id}",
  method = "GET",
  params = { id = "example" },
})
```

## Per-language documentation

- [TypeScript](ts/README.md)
- [Python](py/README.md)
- [PHP](php/README.md)
- [Golang](go/README.md)
- [Ruby](rb/README.md)
- [Lua](lua/README.md)

## Using the Quotes API

- Upstream: [https://motivational-spark-api.vercel.app/api](https://motivational-spark-api.vercel.app/api)

---

Generated from the Quotes API OpenAPI spec by [@voxgig/sdkgen](https://github.com/voxgig/sdkgen).
