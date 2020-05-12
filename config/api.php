<?php

return [

    /*
    |--------------------------------------------------------------------------
    | FourSquare
    |--------------------------------------------------------------------------
    |
    | Configuration for FourSquare API
    |
    */

    'foursquare_api_url' => env('FOURSQUARE_API_URL', ''),
    'foursquare_client_id' => env('FOURSQUARE_CLIENT_ID', ''),
    'foursquare_client_secrets' => env('FOURSQUARE_CLIENT_SECRET', ''),

    /*
    |--------------------------------------------------------------------------
    | OpenWeatherMap
    |--------------------------------------------------------------------------
    |
    | Configuration for OpenQeatherMap API
    |
    */

    'openweathermap_api_url' => env('OPENWEATHERMAP_API_URL', ''),
    'openweathermap_api_key' => env('OPENWEATHERMAP_API_KEY', ''),
    'openweathermap_icon_url' => env('MIX_OPENWEATHERMAP_ICON_URL', ''),
];
