<?php

namespace App\Connectors\Google\PlacesApi;

class ApiResponseFormatter
{
    public function formatFromPlacesApiResponse(object $body): array
    {
        $places = [];

        foreach ($body->results as $place) {
            $placeData = $this->formatPlace($place);
            array_push($places, $placeData);
        }
        return [
            'next_page_token' => $body->next_page_token,
            'places' => $places
        ];
    }

    public function formatFromPlaceDetailsResponse(object $body): array
    {
        $details = $body->result;

        return [
            'place_id' => $details->place_id,
            'google_maps_url' => $details->url ?? 'No google maps url',
            'website' => $details->website ?? 'No google maps url',
            'types' => $details->types,
            'formatted_address' => $details->formatted_address,
            'formatted_phone_number' => $details->international_phone_number,
            'business_status' => $details->business_status,
            'name' => $details->name,
            'ratings_count' => count($details->reviews)
        ];
    }

    private function formatPlace(object $place): array
    {
        return [
            'place_id' => $place->place_id,
            'name' => $place->name ?? 'No Name',
            'rating' => $place->rating ?? 'No Rating',
            'address' => $place->vicinity ?? 'No Address'
        ];
    }
}