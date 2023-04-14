<?php

return [
    'coin'         => env('BITGO_COIN', 'tbtc'),
    'api_url'      => env('BITGO_API_URL', 'https://test.bitgo.com/api/v2'),
    'express_host' => env('BITGO_EXPRESS_HOST', 'localhost'),
    'express_port' => env('BITGO_EXPRESS_PORT', '3080'),
    'access_token' => env('BITGO_ACCESS_TOKEN', ''),
];
