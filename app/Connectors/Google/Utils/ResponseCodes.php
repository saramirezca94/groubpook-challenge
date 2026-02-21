<?php

namespace App\Connectors\Google\Utils;

use Symfony\Component\HttpFoundation\Response;

class ResponseCodes
{
  public static function get(): array
  {
    return [
      'OK' => ['status' => Response::HTTP_OK, 'message' => 'ok'],
      'ZERO_RESULTS' => ['status' => Response::HTTP_OK, 'message' => 'No Results'],
      'INVALID_REQUEST' => ['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Bad Request'],
      'OVER_QUERY_LIMIT' => ['status' => Response::HTTP_BAD_REQUEST, 'message' => 'Query Limit'],
      'REQUEST_DENIED' => ['status' => Response::HTTP_UNAUTHORIZED, 'message' => 'Request Denied'],
      'UNKNOWN_ERROR ' => ['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => 'Server Error']
    ];
  }
}
