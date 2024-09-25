<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use \Illuminate\Database\Eloquent\Relations\HasOne;
class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", 'number', 'description', 'is_available', 'floor_id'
    ];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function infos()
    {
        return $this->hasMany(Info::class);
    }

}
