<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Pim service details
    |--------------------------------------------------------------------------
    |
    | The following details can be found in akeneo, please either create a
    | new connection or use an existing one.
    |
    */
    'client_id' => env('AUTH0_PIM_API_CLIENT_ID'),
    'client_secret' => env('AUTH0_PIM_API_CLIENT_SECRET'),
    'audience_base' => env('AUTH0_PIM_API_AUDIENCE_BASE'),
    'audience_api_endpoint' => sprintf(
        '%s/%s',
        rtrim(env('AUTH0_PIM_API_AUDIENCE_BASE'), '/'),
        ltrim(env('AUTH0_PIM_API_ENDPOINT'), '/')
    ),
    'audience_auth_endpoint' => sprintf(
        '%s/%s',
        rtrim(env('AUTH0_PIM_API_AUDIENCE_BASE'), '/'),
        ltrim(env('AUTH0_PIM_AUTH_ENDPOINT'), '/')
    ),
    'grant_type' => env('AUTH0_PIM_API_GRANT_TYPE'),
    'base' => env('GSV_PIM_API'),
    'lang' => explode(',', env('GSV_PIM_API', 'da_DK, en_US')) ?? [],
    'webhook' => [
        'secret' => env('WEBHOOK_SECRET')
    ]
];
