<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
        'title' => $this->title,
        'date' => $this->date,
        'promotion' => $this->promotion,
        'start_hours' => $this->start_hours,
        'end_hours' => $this->end_hours,
        'room_id' => $this->room_id,
    ];

    }
}
