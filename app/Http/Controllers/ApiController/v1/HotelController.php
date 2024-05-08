<?php

namespace App\Http\Controllers\ApiController\v1;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Connectors\Google\PlacesApi\PlacesApiConnectorManager;
use App\Connectors\Google\GeocodingApi\GeocodingApiConnectorManager;

class HotelController extends Controller
{
    protected $placesApiConnectorManager;
    protected $geocodingApiConnectorManager;

    public function __construct(PlacesApiConnectorManager $placesApiConnectorManager, GeocodingApiConnectorManager $geocodingApiConnectorManager)
    {
        $this->placesApiConnectorManager = $placesApiConnectorManager;
        $this->geocodingApiConnectorManager = $geocodingApiConnectorManager;
    }

    public function index(Request $request): JsonResponse
    {
        $location = $request->input('location');
        $response = $this->placesApiConnectorManager->getPlacesList($location);
        
        return response()->json([
            'message' => $response['message'],
            'data' => $response['data'],              
        ], $response['code']);
    }

    public function show(string $id): JsonResponse
    {
        $response = $this->placesApiConnectorManager->getPlaceDetails($id);
        return response()->json([
            'message' => $response['message'],
            'data' => $response['data'],              
        ], $response['code']);;
    }
}
