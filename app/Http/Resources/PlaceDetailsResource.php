<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceDetailsResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    $details = $this->resource->result;

    return [
      'place_id' => $details->place_id,
      'google_maps_url' => $details->url ?? 'No google maps url',
      'website' => $details->website ?? 'No website',
      'types' => $details->types,
      'formatted_address' => $details->formatted_address,
      'formatted_phone_number' => $details->international_phone_number,
      'business_status' => $details->business_status,
      'name' => $details->name,
      'ratings_count' => count($details->reviews),
    ];
  }
}
