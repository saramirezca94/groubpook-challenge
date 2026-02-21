<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlacesListResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'next_page_token' => $this->resource->next_page_token ?? null,
      'places' => PlaceResource::collection(collect($this->resource->results)),
    ];
  }
}
