<?php

namespace App\Connectors\Google\PlacesApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PlacesApiConnector
{
    protected $url;
    protected $apiKey;
    protected $location;
    protected $radius;
    protected $type;
    protected $placeId;

    public function __construct()
    {
        $this->url = config('google.placesApi.url');
        $this->apiKey = config('google.placesApi.key');
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function setRadius(string $radius): void
    {
        $this->radius = $radius;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setPlaceId(string $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function makePlacesListRequest(): Response
    {
        $url = "$this->url/nearbysearch/json";
        $params = [
            'location' => $this->location,
            'radius' => $this->radius,
            'type' => $this->type,
            'key' => $this->apiKey
        ];
        $response = $this->makeGetRequest(url: $url, params: $params);

        return $response;
    }

    public function makePlaceDetailsRequest(): Response
    {
        $url = "$this->url/details/json";
        $params = [
            'place_id' => $this->placeId,
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