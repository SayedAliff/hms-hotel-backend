<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;
use App\Http\Controllers\Api\RoomStatusApiController;
use App\Http\Controllers\Api\TypeController;
use App\Http\Controllers\Api\RoomController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded and all of them will be assigned to the "api"
| middleware group. Make something great!
|
*/

// ============================================================================
// HEALTH CHECK ENDPOINTS
// ============================================================================

// Canonical v1 health endpoint
Route::get('/v1/system/health', [HealthController::class, 'health']);

// Alias for frontend compatibility
Route::get('/health', [HealthController::class, 'health']);

// ============================================================================
// CANONICAL V1 API ROUTES
// ============================================================================

Route::prefix('v1')->group(function () {

    // Room statuses
    Route::get('/room-statuses', [RoomStatusApiController::class, 'index']);
    Route::post('/room-statuses', [RoomStatusApiController::class, 'update']);

    // Types
    Route::get('/types', [TypeController::class, 'index']);
    Route::get('/types/{id}', [TypeController::class, 'show']);

    // Rooms
    Route::get('/rooms', [RoomController::class, 'index']);
    Route::get('/rooms/{id}', [RoomController::class, 'show']);

    // -------------------------------------------------------------------------
    // PLACEHOLDER ROUTES (return 501 Not Implemented)
    // -------------------------------------------------------------------------

    // Customers
    Route::get('/customers', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
    Route::get('/customers/{id}', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));

    // Transactions
    Route::get('/transactions', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
    Route::get('/transactions/{id}', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));

    // Payments
    Route::get('/payments', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
    Route::get('/payments/{id}', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));

    // Restaurant bills
    Route::get('/restaurant-bills', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
    Route::get('/restaurant-bills/{id}', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
});

// ============================================================================
// FRONTEND COMPATIBILITY ALIASES (non-versioned /api/... paths)
// ============================================================================

// Room statuses (used by frontend room-status-dashboard.js)
Route::get('/room-statuses', [RoomStatusApiController::class, 'index']);
Route::post('/room-statuses', [RoomStatusApiController::class, 'update']);

// Types
Route::get('/types', [TypeController::class, 'index']);
Route::get('/types/{id}', [TypeController::class, 'show']);

// Rooms
Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

// Placeholder aliases for future endpoints
Route::get('/customers', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
Route::get('/transactions', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
Route::get('/payments', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));
Route::get('/restaurant-bills', fn() => response()->json(['success' => false, 'message' => 'Not implemented'], 501));