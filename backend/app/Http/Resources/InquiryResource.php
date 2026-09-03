<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InquiryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'property_id' => $this->property_id,
            'client_id' => $this->client_id,
            'message' => $this->message,
            'status' => $this->status,
            'created_at' => $this->created_at?->toISOString(),
            'property' => new PropertyResource($this->whenLoaded('property')),
        ];
    }
}
