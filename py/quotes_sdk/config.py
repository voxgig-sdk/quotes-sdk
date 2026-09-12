# Quotes SDK configuration


# The sekreto plugin DEFINITIONS the model selected per feature, imported
# above by name from the modules the catalogue's active `plugin.def`
# entries declare. Handed to each feature (secrets builds its Sekreto
# with them): a provider kind not listed here is unknown to that SDK.
FEATURE_PLUGINS = {
}


_shared_config = None


def shared_config():
    """Return the process-wide config, built once on first use.

    The SDK reads the config on every request and never writes to it, so one
    instance is shared by every client rather than rebuilt per client.

    The returned dict is shared: treat it as read-only. Callers that need to
    mutate should use make_config, which always returns a fresh copy.
    """
    global _shared_config
    if _shared_config is None:
        _shared_config = make_config()
    return _shared_config


def make_config():
    """Build a fresh, fully materialised config dict.

    Every call rebuilds the whole structure, so prefer shared_config unless
    you need a private copy you intend to mutate.
    """
    return {
        "main": {
            "name": "Quotes",
            "slug": "quotes",
            "version": "0.0.1",
            "target": "py",
        },
        "feature": {
            "test": {
        "options": {
          "active": False,
        },
        "transport": "base",
      },
        },
        "options": {
            "base": "https://motivational-spark-api.vercel.app/api",
            "headers": {
        "content-type": "application/json",
      },
            "entity": {
                "owner": {},
                "quote": {},
            },
        },
        "entity": {
      "owner": {
        "fields": [
          {
            "name": "github",
            "short": "GitHub profile URL",
            "type": "`$STRING`",
          },
          {
            "name": "name",
            "short": "Name of the API owner",
            "type": "`$STRING`",
          },
        ],
        "name": "owner",
        "op": {
          "load": {
            "input": "data",
            "name": "load",
            "points": [
              {
                "args": {},
                "kind": "http",
                "method": "GET",
                "orig": "/owner",
                "segments": [
                  {
                    "lit": "owner",
                  },
                ],
                "select": {},
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body`",
                },
                "parts": [
                  "owner",
                ],
              },
            ],
          },
        },
        "relations": {
          "ancestors": [],
        },
      },
      "quote": {
        "fields": [
          {
            "name": "author",
            "short": "The author of the quote",
            "type": "`$STRING`",
          },
          {
            "name": "id",
            "short": "Unique identifier for the quote",
            "type": "`$INTEGER`",
          },
          {
            "name": "quote",
            "short": "The motivational quote text",
            "type": "`$STRING`",
          },
        ],
        "id": {
          "field": "id",
          "name": "id",
        },
        "name": "quote",
        "op": {
          "list": {
            "input": "data",
            "name": "list",
            "points": [
              {
                "args": {},
                "kind": "http",
                "method": "GET",
                "orig": "/quotes",
                "segments": [
                  {
                    "lit": "quotes",
                  },
                ],
                "select": {},
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body`",
                },
                "parts": [
                  "quotes",
                ],
              },
            ],
          },
          "load": {
            "input": "data",
            "name": "load",
            "points": [
              {
                "args": {
                  "params": [
                    {
                      "example": 2,
                      "kind": "param",
                      "name": "id",
                      "orig": "index",
                      "reqd": True,
                      "type": "`$INTEGER`",
                    },
                  ],
                },
                "kind": "http",
                "method": "GET",
                "orig": "/quotes/{index}",
                "rename": {
                  "param": {
                    "index": "id",
                  },
                },
                "segments": [
                  {
                    "lit": "quotes",
                  },
                  {
                    "var": "id",
                  },
                ],
                "select": {
                  "exist": [
                    "id",
                  ],
                },
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body`",
                },
                "parts": [
                  "quotes",
                  "{id}",
                ],
              },
              {
                "args": {
                  "params": [
                    {
                      "example": 3,
                      "kind": "param",
                      "name": "number",
                      "orig": "number",
                      "reqd": True,
                      "type": "`$INTEGER`",
                    },
                  ],
                },
                "kind": "http",
                "method": "GET",
                "orig": "/quotes/random/{number}",
                "segments": [
                  {
                    "lit": "quotes",
                  },
                  {
                    "lit": "random",
                  },
                  {
                    "var": "number",
                  },
                ],
                "select": {
                  "exist": [
                    "number",
                  ],
                },
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body`",
                },
                "parts": [
                  "quotes",
                  "random",
                  "{number}",
                ],
              },
              {
                "args": {},
                "kind": "http",
                "method": "GET",
                "orig": "/quotes/random",
                "segments": [
                  {
                    "lit": "quotes",
                  },
                  {
                    "lit": "random",
                  },
                ],
                "select": {
                  "$action": "random",
                },
                "transform": {
                  "req": "`reqdata`",
                  "res": "`body`",
                },
                "parts": [
                  "quotes",
                  "random",
                ],
              },
            ],
          },
        },
        "relations": {
          "ancestors": [
            [
              "random",
            ],
          ],
        },
      },
    },
    }
