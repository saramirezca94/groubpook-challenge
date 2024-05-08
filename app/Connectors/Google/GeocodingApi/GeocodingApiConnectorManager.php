<?php

namespace App\Connectors\Google\GeocodingApi;

use Exception;
use App\Connectors\Google\Utils\ResponseCodes;
use Symfony\Component\HttpFoundation\Response;

class GeocodingApiConnectorManager
{
    protected $geocodingApiConnector;

    public function __construct(geocodingApiConnector $geocodingApiConnector)
    {
        $this->geocodingApiConnector = $geocodingApiConnector;
    }

    public function getAddressGeocodeData(string $address): array
    {
        try {
            $this->geocodingApiConnector->setAddress($address);

            $response = $this->geocodingApiConnector->makeGeocodeRequest();
            $decodedResponse = json_decode($response->body());
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
    
    private function getResponseStatus(string $status)
    {
        $googleStatus = ResponseCodes::get();

        return $googleStatus[$status];
    }
}