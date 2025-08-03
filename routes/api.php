<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all booked dates for the calendar
Route::get('/booked-dates', function (Request $request) {
    $bookings = \App\Models\Booking::whereNotNull('booking_date')
        ->select('id', 'booking_date as start', 'checkout_date as end', 'type')
        ->where('status', '!=', 'cancelled')
        ->get()
        ->map(function($booking) {
            return [
                'id' => $booking->id,
                'title' => 'Booked',
                'start' => $booking->start,
                'end' => $booking->checkout_date ? $booking->end : $booking->start,
                'allDay' => true,
                'backgroundColor' => $booking->type === 'room' ? '#EF4444' : '#3B82F6',
                'borderColor' => $booking->type === 'room' ? '#DC2626' : '#2563EB',
                'textColor' => 'white',
                'extendedProps' => [
                    'type' => $booking->type
                ]
            ];
        });

    return response()->json($bookings);
});
