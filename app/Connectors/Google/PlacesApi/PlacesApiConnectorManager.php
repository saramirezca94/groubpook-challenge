<?php

namespace App\Connectors\Google\PlacesApi;

use Exception;
use App\Connectors\Google\Utils\ResponseCodes;
use Symfony\Component\HttpFoundation\Response;
use App\Connectors\Google\PlacesApi\PlacesApiConnector;
use App\Connectors\Google\PlacesApi\ApiResponseFormatter;

class PlacesApiConnectorManager
{
    protected $placesApiConnector;
    protected $apiResponseFormatter;

    public function __construct(PlacesApiConnector $placesApiConnector, ApiResponseFormatter $apiResponseFormatter)
    {
        $this->placesApiConnector = $placesApiConnector;
        $this->apiResponseFormatter = $apiResponseFormatter;
    }

    public function getPlacesList(string $location): array
    {
        try {
            $this->placesApiConnector->setLocation($location);
            $this->placesApiConnector->setRadius('5000');
            $this->placesApiConnector->setType('lodging');
    
            $response = $this->placesApiConnector->makePlacesListRequest();
            $decodedResponse = json_decode($response->body());
            $responseStatus = $this->getResponseStatus($decodedResponse->status);
    
            $formattedResponse = $this->apiResponseFormatter->formatFromPlacesApiResponse($decodedResponse);

            return [
                'code' => $responseStatus['status'],
                'message' => $responseStatus['message'],
                'data' => $formattedResponse
            ];
    
        } catch (Exception $ex) {
            return [
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Internal server error',
                'data' => $decodedResponse
            ];
        }
    }

    public function getPlaceDetails(string $placeId): array
    {
        try {
            $this->placesApiConnector->setPlaceId($placeId);

            $response = $this->placesApiConnector->makePlaceDetailsRequest();
            $decodedResponse = json_decode($response->body());
            $responseStatus = $this->getResponseStatus($decodedResponse->status);    
            $formattedResponse = $this->apiResponseFormatter->formatFromPlaceDetailsResponse($decodedResponse);

            return [
                'code' => $responseStatus['status'],
                'message' => $responseStatus['message'],
                'data' => $formattedResponse
            ];
    
        } catch (Exception $ex) {
            return [
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => 'Internal server error',
                'data' => $decodedResponse
            ];
        }
    }

    private function getResponseStatus(string $status)
    {
        $googleStatus = ResponseCodes::get();

        return $googleStatus[$status];
    }

}