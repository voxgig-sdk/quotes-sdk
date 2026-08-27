<?php
declare(strict_types=1);

// Quotes SDK configuration

class QuotesConfig
{
    /** @var array<string,mixed>|null */
    private static ?array $shared_config = null;

    /**
     * Return the process-wide config, built once on first use. The SDK reads
     * the config on every request and never writes to it, so one instance is
     * shared by every client rather than rebuilt per client.
     *
     * PHP arrays are copy-on-write, so callers that do mutate the result get
     * their own copy and cannot disturb the shared one.
     */
    public static function shared_config(): array
    {
        if (self::$shared_config === null) {
            self::$shared_config = self::make_config();
        }
        return self::$shared_config;
    }

    /**
     * Build a fresh, fully materialised config array. Every call rebuilds the
     * whole structure, so prefer shared_config unless you need a private copy.
     */
    public static function make_config(): array
    {
        return [
            "main" => [
                "name" => "Quotes",
                "slug" => "quotes",
                "version" => "0.0.1",
                "target" => "php",
            ],
            "feature" => [
                "test" => [
          'options' => [
            'active' => false,
          ],
          'transport' => 'base',
        ],
            ],
            "options" => [
                "base" => "https://motivational-spark-api.vercel.app/api",
                "headers" => [
          'content-type' => 'application/json',
        ],
                "entity" => [
                    "owner" => [],
                    "quote" => [],
                ],
            ],
            "entity" => [
        'owner' => [
          'fields' => [
            [
              'name' => 'github',
              'short' => 'GitHub profile URL',
              'type' => '`$STRING`',
            ],
            [
              'name' => 'name',
              'short' => 'Name of the API owner',
              'type' => '`$STRING`',
            ],
          ],
          'name' => 'owner',
          'op' => [
            'load' => [
              'input' => 'data',
              'name' => 'load',
              'points' => [
                [
                  'args' => [],
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/owner',
                  'parts' => [
                    'owner',
                  ],
                  'select' => [],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                ],
              ],
            ],
          ],
          'relations' => [
            'ancestors' => [],
          ],
        ],
        'quote' => [
          'fields' => [
            [
              'name' => 'author',
              'short' => 'The author of the quote',
              'type' => '`$STRING`',
            ],
            [
              'name' => 'id',
              'short' => 'Unique identifier for the quote',
              'type' => '`$INTEGER`',
            ],
            [
              'name' => 'quote',
              'short' => 'The motivational quote text',
              'type' => '`$STRING`',
            ],
          ],
          'name' => 'quote',
          'op' => [
            'list' => [
              'input' => 'data',
              'name' => 'list',
              'points' => [
                [
                  'args' => [],
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/quotes',
                  'parts' => [
                    'quotes',
                  ],
                  'select' => [],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                ],
              ],
            ],
            'load' => [
              'input' => 'data',
              'name' => 'load',
              'points' => [
                [
                  'args' => [
                    'params' => [
                      [
                        'example' => 2,
                        'kind' => 'param',
                        'name' => 'id',
                        'orig' => 'index',
                        'reqd' => true,
                        'type' => '`$INTEGER`',
                      ],
                    ],
                  ],
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/quotes/{index}',
                  'parts' => [
                    'quotes',
                    '{id}',
                  ],
                  'rename' => [
                    'param' => [
                      'index' => 'id',
                    ],
                  ],
                  'select' => [
                    'exist' => [
                      'id',
                    ],
                  ],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                ],
                [
                  'args' => [
                    'params' => [
                      [
                        'example' => 3,
                        'kind' => 'param',
                        'name' => 'number',
                        'orig' => 'number',
                        'reqd' => true,
                        'type' => '`$INTEGER`',
                      ],
                    ],
                  ],
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/quotes/random/{number}',
                  'parts' => [
                    'quotes',
                    'random',
                    '{number}',
                  ],
                  'select' => [
                    'exist' => [
                      'number',
                    ],
                  ],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                ],
                [
                  'args' => [],
                  'kind' => 'http',
                  'method' => 'GET',
                  'orig' => '/quotes/random',
                  'parts' => [
                    'quotes',
                    'random',
                  ],
                  'select' => [
                    '$action' => 'random',
                  ],
                  'transform' => [
                    'req' => '`reqdata`',
                    'res' => '`body`',
                  ],
                ],
              ],
            ],
          ],
          'relations' => [
            'ancestors' => [
              [
                'random',
              ],
            ],
          ],
        ],
      ],
        ];
    }


    public static function make_feature(string $name)
    {
        require_once __DIR__ . '/features.php';
        return QuotesFeatures::make_feature($name);
    }
}
