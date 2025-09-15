<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key
    |--------------------------------------------------------------------------
    |
    | Your OpenAI API key. You can obtain this from your OpenAI account.
    |
    */

    'api_key' => env('OPENAI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Organization (Optional)
    |--------------------------------------------------------------------------
    |
    | If you belong to multiple organizations, you can set an organization ID.
    |
    */

    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Base URI (Optional)
    |--------------------------------------------------------------------------
    |
    | If you're using a proxy or a self-hosted version of OpenAI-compatible API.
    |
    */

    'base_uri' => env('OPENAI_BASE_URI', 'https://api.openai.com/v1'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout (Optional)
    |--------------------------------------------------------------------------
    |
    | Timeout for requests in seconds.
    |
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),

];
