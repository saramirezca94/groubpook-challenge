<?php

namespace App\Connectors\Google\PlacesApi;

use App\Connectors\GenericConnector;

class PlacesApiConnector extends GenericConnector
{
  protected string $url;
  protected string $apiKey;
  protected string $location;
  protected string $radius;
  protected string $type;
  protected string $placeId;

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

  public function makePlacesListRequest(): array
  {
    $url = "$this->url/nearbysearch/json";
    $params = [
      'location' => $this->location,
      'radius' => $this->radius,
      'type' => $this->type,
      'key' => $this->apiKey
    ];

    return $this->makeGetRequest(url: $url, params: $params);
  }

  public function makePlaceDetailsRequest(): array
  {
    $url = "$this->url/details/json";
    $params = [
      'place_id' => $this->placeId,
      'key' => $this->apiKey
    ];
    return $this->makeGetRequest(url: $url, params: $params);
  }
}
