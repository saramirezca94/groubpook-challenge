<?php

namespace App\Connectors\Google\GeocodingApi;

use App\Traits\GoogleTrait;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class GeocodingApiConnectorManager
{
  use GoogleTrait;
  public function __construct(protected geocodingApiConnector $geocodingApiConnector)
  {
  }

  public function getAddressGeocodeData(string $address): array
  {
    try {
      $this->geocodingApiConnector->setAddress($address);

      $result = $this->geocodingApiConnector->makeGeocodeRequest();

      if(!$result['success']){
        throw new Exception($result['message']);
      }

      $decodedResponse = json_decode($result['response']->body());
      $responseStatus = $this->getResponseStatus($decodedResponse->status);

      return [
        'code' => $responseStatus['status'],
        'message' => $responseStatus['message'],
        'data' => $decodedResponse
      ];

    } catch (Exception $ex) {
      return [
        'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
        'message' => 'Internal server error',
        'data' => $decodedResponse
      ];
    }
  }
}
