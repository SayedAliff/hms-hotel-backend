<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HealthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Health check endpoint (canonical and alias)
Route::get('/health', [HealthController::class, 'health']); // /api/health
Route::get('/v1/system/health', [HealthController::class, 'health']); // /api/v1/system/health

// Canonical v1 API routes
Route::prefix('v1')->group(function () {
    
    // Types management
    Route::prefix('types')->group(function () {
        // Route::get('/', 'TypeController@index');         // GET /api/v1/types
        // Route::post('/', 'TypeController@store');        // POST /api/v1/types
        // Route::get('/{id}', 'TypeController@show');      // GET /api/v1/types/{id}
        // Route::put('/{id}', 'TypeController@update');    // PUT /api/v1/types/{id}
        // Route::delete('/{id}', 'TypeController@destroy'); // DELETE /api/v1/types/{id}
    });
    
    // Room statuses management
    Route::prefix('room-statuses')->group(function () {
        // Route::get('/', 'RoomStatusController@index');         // GET /api/v1/room-statuses
        // Route::post('/', 'RoomStatusController@store');        // POST /api/v1/room-statuses
        // Route::get('/{id}', 'RoomStatusController@show');      // GET /api/v1/room-statuses/{id}
        // Route::put('/{id}', 'RoomStatusController@update');    // PUT /api/v1/room-statuses/{id}
        // Route::delete('/{id}', 'RoomStatusController@destroy'); // DELETE /api/v1/room-statuses/{id}
    });
    
    // Rooms management
    Route::prefix('rooms')->group(function () {
        // Route::get('/', 'RoomController@index');         // GET /api/v1/rooms
        // Route::post('/', 'RoomController@store');        // POST /api/v1/rooms
        // Route::get('/{id}', 'RoomController@show');      // GET /api/v1/rooms/{id}
        // Route::put('/{id}', 'RoomController@update');    // PUT /api/v1/rooms/{id}
        // Route::delete('/{id}', 'RoomController@destroy'); // DELETE /api/v1/rooms/{id}
    });
    
    // Customers management
    Route::prefix('customers')->group(function () {
        // Route::get('/', 'CustomerController@index');         // GET /api/v1/customers
        // Route::post('/', 'CustomerController@store');        // POST /api/v1/customers
        // Route::get('/{id}', 'CustomerController@show');      // GET /api/v1/customers/{id}
        // Route::put('/{id}', 'CustomerController@update');    // PUT /api/v1/customers/{id}
        // Route::delete('/{id}', 'CustomerController@destroy'); // DELETE /api/v1/customers/{id}
    });
    
    // Transactions management
    Route::prefix('transactions')->group(function () {
        // Route::get('/', 'TransactionController@index');         // GET /api/v1/transactions
        // Route::post('/', 'TransactionController@store');        // POST /api/v1/transactions
        // Route::get('/{id}', 'TransactionController@show');      // GET /api/v1/transactions/{id}
        // Route::put('/{id}', 'TransactionController@update');    // PUT /api/v1/transactions/{id}
        // Route::delete('/{id}', 'TransactionController@destroy'); // DELETE /api/v1/transactions/{id}
    });
    
    // Payments management
    Route::prefix('payments')->group(function () {
        // Route::get('/', 'PaymentController@index');         // GET /api/v1/payments
        // Route::post('/', 'PaymentController@store');        // POST /api/v1/payments
        // Route::get('/{id}', 'PaymentController@show');      // GET /api/v1/payments/{id}
        // Route::put('/{id}', 'PaymentController@update');    // PUT /api/v1/payments/{id}
        // Route::delete('/{id}', 'PaymentController@destroy'); // DELETE /api/v1/payments/{id}
    });
    
    // Restaurant bills management
    Route::prefix('restaurant-bills')->group(function () {
        // Route::get('/', 'RestaurantBillController@index');         // GET /api/v1/restaurant-bills
        // Route::post('/', 'RestaurantBillController@store');        // POST /api/v1/restaurant-bills
        // Route::get('/{id}', 'RestaurantBillController@show');      // GET /api/v1/restaurant-bills/{id}
        // Route::put('/{id}', 'RestaurantBillController@update');    // PUT /api/v1/restaurant-bills/{id}
        // Route::delete('/{id}', 'RestaurantBillController@destroy'); // DELETE /api/v1/restaurant-bills/{id}
    });
    
    // Placeholder for returning 501 Not Implemented for undefined routes
    Route::fallback(function () {
        return response()->json([
            'message' => 'Endpoint not implemented yet',
            'status' => 501
        ], 501);
    });
});

// Alias: /api/types, /api/room-statuses, etc. (for frontend compatibility)
Route::get('/types', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/room-statuses', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/rooms', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/rooms/{id}', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/customers', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/transactions', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/payments', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });
Route::get('/restaurant-bills', function() { return response()->json(['message'=>'Not implemented','status'=>501],501); });