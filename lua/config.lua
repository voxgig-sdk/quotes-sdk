-- Quotes SDK configuration

-- Build a fresh, fully materialised config table. Every call rebuilds the
-- whole structure, so prefer require("config_shared") unless you need a
-- private copy you intend to mutate.
local function make_config()
  return {
    main = {
      name = "Quotes",
      slug = "quotes",
      version = "0.0.1",
      target = "lua",
    },
    feature = {
      ["test"] = {
        ["options"] = {
          ["active"] = false,
        },
        ["transport"] = "base",
      },
    },
    options = {
      base = "https://motivational-spark-api.vercel.app/api",
      headers = {
        ["content-type"] = "application/json",
      },
      entity = {
        ["owner"] = {},
        ["quote"] = {},
      },
    },
    entity = {
      ["owner"] = {
        ["fields"] = {
          {
            ["name"] = "github",
            ["short"] = "GitHub profile URL",
            ["type"] = "`$STRING`",
          },
          {
            ["name"] = "name",
            ["short"] = "Name of the API owner",
            ["type"] = "`$STRING`",
          },
        },
        ["name"] = "owner",
        ["op"] = {
          ["load"] = {
            ["input"] = "data",
            ["name"] = "load",
            ["points"] = {
              {
                ["args"] = {},
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/owner",
                ["segments"] = {
                  {
                    ["lit"] = "owner",
                  },
                },
                ["select"] = {},
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body`",
                },
                ["parts"] = {
                  "owner",
                },
              },
            },
          },
        },
        ["relations"] = {
          ["ancestors"] = {},
        },
      },
      ["quote"] = {
        ["fields"] = {
          {
            ["name"] = "author",
            ["short"] = "The author of the quote",
            ["type"] = "`$STRING`",
          },
          {
            ["name"] = "id",
            ["short"] = "Unique identifier for the quote",
            ["type"] = "`$INTEGER`",
          },
          {
            ["name"] = "quote",
            ["short"] = "The motivational quote text",
            ["type"] = "`$STRING`",
          },
        },
        ["id"] = {
          ["field"] = "id",
          ["name"] = "id",
        },
        ["name"] = "quote",
        ["op"] = {
          ["list"] = {
            ["input"] = "data",
            ["name"] = "list",
            ["points"] = {
              {
                ["args"] = {},
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/quotes",
                ["segments"] = {
                  {
                    ["lit"] = "quotes",
                  },
                },
                ["select"] = {},
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body`",
                },
                ["parts"] = {
                  "quotes",
                },
              },
            },
          },
          ["load"] = {
            ["input"] = "data",
            ["name"] = "load",
            ["points"] = {
              {
                ["args"] = {
                  ["params"] = {
                    {
                      ["example"] = 2,
                      ["kind"] = "param",
                      ["name"] = "id",
                      ["orig"] = "index",
                      ["reqd"] = true,
                      ["type"] = "`$INTEGER`",
                    },
                  },
                },
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/quotes/{index}",
                ["rename"] = {
                  ["param"] = {
                    ["index"] = "id",
                  },
                },
                ["segments"] = {
                  {
                    ["lit"] = "quotes",
                  },
                  {
                    ["var"] = "id",
                  },
                },
                ["select"] = {
                  ["exist"] = {
                    "id",
                  },
                },
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body`",
                },
                ["parts"] = {
                  "quotes",
                  "{id}",
                },
              },
              {
                ["args"] = {
                  ["params"] = {
                    {
                      ["example"] = 3,
                      ["kind"] = "param",
                      ["name"] = "number",
                      ["orig"] = "number",
                      ["reqd"] = true,
                      ["type"] = "`$INTEGER`",
                    },
                  },
                },
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/quotes/random/{number}",
                ["segments"] = {
                  {
                    ["lit"] = "quotes",
                  },
                  {
                    ["lit"] = "random",
                  },
                  {
                    ["var"] = "number",
                  },
                },
                ["select"] = {
                  ["exist"] = {
                    "number",
                  },
                },
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body`",
                },
                ["parts"] = {
                  "quotes",
                  "random",
                  "{number}",
                },
              },
              {
                ["args"] = {},
                ["kind"] = "http",
                ["method"] = "GET",
                ["orig"] = "/quotes/random",
                ["segments"] = {
                  {
                    ["lit"] = "quotes",
                  },
                  {
                    ["lit"] = "random",
                  },
                },
                ["select"] = {
                  ["$action"] = "random",
                },
                ["transform"] = {
                  ["req"] = "`reqdata`",
                  ["res"] = "`body`",
                },
                ["parts"] = {
                  "quotes",
                  "random",
                },
              },
            },
          },
        },
        ["relations"] = {
          ["ancestors"] = {
            {
              "random",
            },
          },
        },
      },
    },
  }
end


local function make_feature(name)
  local features = require("features")
  local factory = features[name]
  if factory ~= nil then
    return factory()
  end
  return features.base()
end


-- Attach make_feature to the SDK class
local function setup_sdk(SDK)
  SDK._make_feature = make_feature
end


return make_config
