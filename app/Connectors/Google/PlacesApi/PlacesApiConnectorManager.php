<?php

namespace App\Connectors\Google\PlacesApi;

use App\Http\Resources\{PlaceDetailsResource, PlacesListResource};
use App\Traits\GoogleTrait;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PlacesApiConnectorManager
{
  use GoogleTrait;

  public function __construct(protected PlacesApiConnector $placesApiConnector)
  {
  }

  public function getPlacesList(string $location): array
  {
    try {
      $this->placesApiConnector->setLocation($location);
      $this->placesApiConnector->setRadius('5000');
      $this->placesApiConnector->setType('lodging');

      $result = $this->placesApiConnector->makePlacesListRequest();

      if (!$result['success']) {
        throw new Exception($result['message']);
      }

      $decodedResponse = json_decode($result['response']->body());
      $responseStatus = $this->getResponseStatus($decodedResponse->status);

      return [
        'code' => $responseStatus['status'],
        'message' => $responseStatus['message'],
        'data' => new PlacesListResource($decodedResponse),
      ];

    } catch (Exception $ex) {
      return [
        'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
        'message' => 'Internal server error',
        'data' => $ex->getMessage(),
      ];
    }
  }

  public function getPlaceDetails(string $placeId): array
  {
    try {
      $this->placesApiConnector->setPlaceId($placeId);

      $result = $this->placesApiConnector->makePlaceDetailsRequest();

      if (!$result['success']) {
        throw new Exception($result['message']);
      }

      $decodedResponse = json_decode($result['response']->body());
      $responseStatus = $this->getResponseStatus($decodedResponse->status);

      return [
        'code' => $responseStatus['status'],
        'message' => $responseStatus['message'],
        'data' => new PlaceDetailsResource($decodedResponse),
      ];

    } catch (Exception $ex) {
      return [
        'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
        'message' => 'Internal server error',
        'data' => $ex->getMessage(),
      ];
    }
  }
}
