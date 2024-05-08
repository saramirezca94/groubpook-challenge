<?php

return [
    'placesApi' => [
        'key' => env('GOOGLE_PLACES_API_KEY'),
        'url' => env('GOOGLE_PLACES_API_URL')
    ],
    'geocodingApi' => [
        'key' => env('GOOGLE_GEOCODING_API_KEY'),
        'url' => env('GOOGLE_GEOCODING_API_URL')
    ]
];