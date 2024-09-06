<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHoursResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'starting_time'=>$this->resource->StartingTime,
            'ending_time'=>$this->resource->EndingTime,
            'status'=>$this->resource->status,
            'doctor'=>$this->resource->doctor->name,
            'day'=>$this->resource->day->title
        ];
    }
}
