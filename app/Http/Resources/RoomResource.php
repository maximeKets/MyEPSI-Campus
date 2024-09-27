<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'name' => $this->name,
            "number" => $this->number,
            'floor_id' => $this->floor_id,
            'infos' => InfoResource::collection($this->whenLoaded('infos')),
            "courses" => CourseResource::collection($this->whenLoaded('courses')),
        ];    }
}
