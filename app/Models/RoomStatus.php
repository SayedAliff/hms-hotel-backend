<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomStatus extends Model
{
    protected $table = 'room_statuses';
    public $timestamps = false;
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class, 'room_status_id');
    }
}
