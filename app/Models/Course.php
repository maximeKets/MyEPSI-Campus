<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'teacher', 'date', 'promotion', 'start_hours', 'end_hours', 'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
