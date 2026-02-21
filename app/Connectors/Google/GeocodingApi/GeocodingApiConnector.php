<?php

namespace App\Connectors\Google\GeocodingApi;

use App\Connectors\GenericConnector;

class GeocodingApiConnector extends GenericConnector
{
  protected string $url;
  protected string $apiKey;
  protected string $address;
  public function __construct()
  {
    $this->url = config('google.geocodingApi.url');
    $this->apiKey = config('google.geocodingApi.key');
  }

  public function setAddress(string $address): void
  {
    $this->address = $address;
  }

  public function makeGeocodeRequest(): array
  {
    $url = "$this->url/json";
    $params = [
      'address' => $this->address,
      'key' => $this->apiKey
    ];

    return $this->makeGetRequest(url: $url, params: $params);
  }
}
