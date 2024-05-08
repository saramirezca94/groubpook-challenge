<?php

namespace App\Connectors\Google\GeocodingApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class GeocodingApiConnector
{
    public function __construct()
    {
        $this->url = config('google.geocodingApi.url');
        $this->apiKey = config('google.geocodingApi.key');
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function makeGeocodeRequest(): Response
    {
        $url = "$this->url/json";
        $params = [
            'address' => $this->address,
            'key' => $this->apiKey
        ];
        $response = $this->makeGetRequest(url: $url, params: $params);

        return $response;
    }

    private function makeGetRequest(string $url, array $params = []): Response
    {
        return Http::get($url, $params);
    }
    
}