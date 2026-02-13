<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RestaurantBill;
use Illuminate\Http\Request;

class RestaurantBillController extends Controller
{
    public function index(Request $request)
    {
        $perPage = min((int) $request->input('per_page', 10), 100);

        $query = RestaurantBill::with(['transaction', 'user']);

        // Filters
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('transaction_id')) {
            $query->where('transaction_id', $request->input('transaction_id'));
        }

        $paginator = $query->orderByDesc('id')->paginate($perPage);

        return $this->success([
            'items' => $paginator->items(),
            'meta'  => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
            ],
        ]);
    }
}
