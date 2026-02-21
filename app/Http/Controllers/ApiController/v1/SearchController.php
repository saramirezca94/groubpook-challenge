<?php

namespace App\Http\Controllers\ApiController\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Connectors\Google\GeocodingApi\GeocodingApiConnectorManager;

class SearchController extends Controller
{
  public function __construct(protected GeocodingApiConnectorManager $geocodingApiConnectorManager)
  {
  }

  public function __invoke(Request $request)
  {
    $address = $request->input('address');
    $response = $this->geocodingApiConnectorManager->getAddressGeocodeData($address);

    return response()->json([
      'message' => $response['message'],
      'data' => $response['data'],
    ], $response['code']);
  }
}
