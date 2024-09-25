<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class Info extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'room_id'];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
