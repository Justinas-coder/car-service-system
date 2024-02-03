<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'vehicle_make_id' => $this->vehicle_make_id,
            'vehicle_model_id' => $this->vehicle_model_id,
            'year' => $this->year,
            'service_id' => $this->service_id,
            'status' => $this->status,
            'status_readable' => $this->status->title(),
            'total_price' => $this->total_price,
            'service' => $this->service,
            'order_date' => $this->created_at->format('Y-m-d')
        ];
    }
}
