<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * GET /api/rooms
     * Returns paginated list of rooms with optional filters.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 15);

        $query = Room::with(['type', 'roomStatus']);

        // Filter by type_id
        if ($request->filled('type_id')) {
            $query->where('type_id', $request->input('type_id'));
        }

        // Filter by room_status_id
        if ($request->filled('room_status_id')) {
            $query->where('room_status_id', $request->input('room_status_id'));
        }

        // Search by room number
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('number', 'like', "%{$search}%");
        }

        $rooms = $query->paginate($perPage);

        return $this->success($rooms);
    }

    /**
     * GET /api/rooms/{id}
     * Returns a single room with relations.
     */
    public function show($id)
    {
        $room = Room::with(['type', 'roomStatus', 'images', 'facilities'])->find($id);

        if (!$room) {
            return $this->error('Room not found', null, 404);
        }

        return $this->success($room);
    }
}
