<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
  public function toArray(Request $request): array
  {
    return [
      'place_id' => $this->resource->place_id,
      'name' => $this->resource->name ?? 'No Name',
      'rating' => $this->resource->rating ?? 'No Rating',
      'address' => $this->resource->vicinity ?? 'No Address',
    ];
  }
}
