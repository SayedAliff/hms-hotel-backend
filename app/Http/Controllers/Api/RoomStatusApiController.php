<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\RoomStatus;
use Illuminate\Http\Request;

class RoomStatusApiController extends Controller
{
    /**
     * GET /api/room-statuses?date=YYYY-MM-DD
     * Returns computed room statuses based on current room_status_id.
     */
    public function index(Request $request)
    {
        $date = $request->input('date', now()->toDateString());

        // Get all rooms with their status
        $rooms = Room::with('roomStatus')->get();

        $statuses = [];

        foreach ($rooms as $room) {
            $statusKey = $this->computeStatusKey($room->roomStatus);
            $statuses[(string) $room->id] = $statusKey;
        }

        return $this->success([
            'date' => $date,
            'statuses' => $statuses,
        ]);
    }

    /**
     * POST /api/room-statuses
     * Update a room's status.
     */
    public function update(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'status_key' => 'required|string|in:booked,normal_checkout',
        ]);

        $room = Room::findOrFail($request->input('room_id'));
        $statusKey = $request->input('status_key');

        if ($statusKey === 'booked') {
            // Find status with code "O" (Occupied)
            $occupiedStatus = RoomStatus::where('code', 'O')
                ->orWhere('code', 'OC')
                ->orWhere('code', 'OD')
                ->first();

            if (!$occupiedStatus) {
                return $this->error('No occupied status code found in room_statuses table', null, 422);
            }

            $room->room_status_id = $occupiedStatus->id;
        } elseif ($statusKey === 'normal_checkout') {
            // Find status with code "V" (Vacant)
            $vacantStatus = RoomStatus::where('code', 'V')->first();

            if (!$vacantStatus) {
                return $this->error('No vacant status code found in room_statuses table', null, 422);
            }

            $room->room_status_id = $vacantStatus->id;
        }

        $room->save();
        $room->load('roomStatus', 'type');

        return $this->success([
            'room' => $room,
            'status_key' => $statusKey,
        ], 'Room status updated successfully');
    }

    /**
     * Compute status key from RoomStatus model.
     * If status indicates occupied => 'booked', else => 'normal_checkout'
     */
    private function computeStatusKey(?RoomStatus $status): string
    {
        if (!$status) {
            return 'normal_checkout';
        }

        $code = strtoupper($status->code ?? '');
        $name = strtolower($status->name ?? '');

        // Check for occupied codes
        if (in_array($code, ['O', 'OC', 'OD'])) {
            return 'booked';
        }

        // Check if name contains 'occupied'
        if (str_contains($name, 'occupied')) {
            return 'booked';
        }

        return 'normal_checkout';
    }
}
