<?php

namespace App\Traits;

use App\Connectors\Google\Utils\ResponseCodes;

trait GoogleTrait
{
  public function getResponseStatus(string $status): array
  {
    $googleStatus = ResponseCodes::get();

    return $googleStatus[$status];
  }
}
