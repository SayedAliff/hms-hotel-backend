<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    /**
     * GET /api/types
     * Returns paginated list of room types.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $types = Type::paginate($perPage);

        return $this->success($types);
    }

    /**
     * GET /api/types/{id}
     * Returns a single type.
     */
    public function show($id)
    {
        $type = Type::find($id);

        if (!$type) {
            return $this->error('Type not found', null, 404);
        }

        return $this->success($type);
    }
}
