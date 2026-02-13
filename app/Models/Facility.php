<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';
    public $timestamps = false;
    protected $guarded = [];

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'facility_room');
    }
}
