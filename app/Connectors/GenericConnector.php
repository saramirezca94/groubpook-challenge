<?php

namespace App\Connectors;

use Illuminate\Http\Client\{ConnectionException, Response};
use Illuminate\Support\Facades\{Http, Log};

class GenericConnector
{
  public function makeGetRequest(string $url, array $params = []): array
  {
    try {
      $response = Http::get($url, $params);

      return [
        'success' => true,
        'response' => $response
      ];
    } catch (ConnectionException $e) {
      Log::error($e->getMessage());
      return [
        'success' => false,
        'message' => 'Error connecting to the API',
      ];
    }
  }
}
