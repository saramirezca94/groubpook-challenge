<?php

namespace App\Http\Controllers\ApiController\v1;

use App\Connectors\Google\GeocodingApi\GeocodingApiConnectorManager;
use App\Connectors\Google\PlacesApi\PlacesApiConnectorManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request};

class HotelController extends Controller
{

  public function __construct(protected GeocodingApiConnectorManager $geocodingApiConnectorManager, protected PlacesApiConnectorManager $placesApiConnectorManager)
  {
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
    ], $response['code']);
  }
}
