<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthController extends Controller
{
    public function health()
    {
        return $this->success([
            'status' => 'ok',
            'service' => 'hms-hotel-backend',
        ], 'OK');
    }
}
