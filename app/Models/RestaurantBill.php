<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantBill extends Model
{
    protected $table = 'restaurant_bills';
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
