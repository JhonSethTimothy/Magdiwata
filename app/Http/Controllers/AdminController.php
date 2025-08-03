<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Booking::query();

        // Filtering
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('booking_date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('booking_date', '<=', $request->date_to);
        }

        // Sorting
        $sort = $request->get('sort', 'booking_date');
        $direction = $request->get('direction', 'desc');
        $allowedSorts = ['name', 'email', 'type', 'selection', 'booking_date'];
        if (!in_array($sort, $allowedSorts)) $sort = 'booking_date';
        if (!in_array($direction, ['asc', 'desc'])) $direction = 'desc';
        $query->orderBy($sort, $direction);

        // Pagination
        $bookings = $query->paginate(10)->appends($request->except('page'));

        // Automatically update status to 'completed' if current date/time is past check_out_date and check_out_time
        foreach ($bookings as $booking) {
            $checkOutDateTime = null;
            if ($booking->check_out_date) {
                $checkOutDateTime = $booking->check_out_date;
                if ($booking->check_out_time) {
                    $checkOutDateTime = \Carbon\Carbon::parse($booking->check_out_date->format('Y-m-d') . ' ' . $booking->check_out_time->format('H:i:s'));
                }
            }
            if ($checkOutDateTime && $checkOutDateTime->lt(now()) && $booking->status !== 'completed') {
                $booking->status = 'completed';
                $booking->save();
            }
        }

        $totalBookings = \App\Models\Booking::count();
        $roomBookings = \App\Models\Booking::where('type', 'room')->count();
        $activityBookings = \App\Models\Booking::where('type', 'activity')->count();

        return view('dashboard', compact('bookings', 'totalBookings', 'roomBookings', 'activityBookings', 'sort', 'direction'));
    }

    public function markCompleted(\App\Models\Booking $booking)
    {
        if ($booking->status !== 'completed') {
            $booking->status = 'completed';
            $booking->save();
        }
        return redirect()->route('dashboard')->with('success', 'Booking marked as completed.');
    }

    /**
     * Update the status of a booking.
     *
     * @param  \App\Models\Booking  $booking
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(\App\Models\Booking $booking, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled,completed',
        ]);

        $previousStatus = $booking->status;
        $newStatus = $request->status;
        
        // Additional validation based on current status
        if ($booking->status === 'cancelled' && $newStatus !== 'cancelled') {
            return back()->with('error', 'Cannot change status of a cancelled booking.');
        }
        
        if ($booking->status === 'completed' && $newStatus !== 'completed') {
            return back()->with('error', 'Cannot change status of a completed booking.');
        }

        // Update the status
        $booking->status = $newStatus;
        $booking->save();

        // Log the status change (you can implement this if needed)
        // \Log::info("Booking #{$booking->id} status changed from {$previousStatus} to {$newStatus}");

        $message = "Booking has been " . $newStatus . " successfully.";
        
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $newStatus,
                'status_display' => ucfirst($newStatus)
            ]);
        }
        
        return back()->with('success', $message);
    }

    /**
     * Reschedule a booking.
     *
     * @param  \App\Models\Booking  $booking
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reschedule(\App\Models\Booking $booking, Request $request)
    {
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after_or_equal:booking_date',
            'check_in_time' => 'required|date_format:H:i',
            'check_out_time' => 'required|date_format:H:i',
        ]);

        // Check if the booking can be rescheduled
        if ($booking->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot reschedule a cancelled booking.'
            ], 422);
        }

        if ($booking->status === 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot reschedule a completed booking.'
            ], 422);
        }

        // Validate check-out date/time is after check-in date/time
        $checkInDateTime = new \DateTime($request->booking_date . ' ' . $request->check_in_time);
        $checkOutDateTime = new \DateTime($request->check_out_date . ' ' . $request->check_out_time);
        
        if ($checkOutDateTime <= $checkInDateTime) {
            return response()->json([
                'success' => false,
                'message' => 'Check-out date and time must be after check-in date and time.'
            ], 422);
        }

        // Save the previous dates for reference (you might want to log this)
        $previousData = [
            'booking_date' => $booking->booking_date,
            'check_out_date' => $booking->check_out_date,
            'check_in_time' => $booking->check_in_time,
            'check_out_time' => $booking->check_out_time,
        ];
        
        // Update the booking dates and times
        $booking->booking_date = $request->booking_date;
        $booking->check_out_date = $request->check_out_date;
        $booking->check_in_time = $request->check_in_time;
        $booking->check_out_time = $request->check_out_time;
        $booking->status = 'rescheduled';
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Booking has been rescheduled successfully.',
            'dates' => [
                'booking_date' => $booking->booking_date->format('Y-m-d'),
                'check_out_date' => $booking->check_out_date ? $booking->check_out_date->format('Y-m-d') : null,
                'check_in_time' => $booking->check_in_time,
                'check_out_time' => $booking->check_out_time,
            ],
            'status' => $booking->status,
            'status_display' => ucfirst($booking->status)
        ]);
    }

    /**
     * Update check-in/check-out time for a booking
     */
    public function updateTimes(Booking $booking, Request $request)
    {
        $request->validate([
            'check_in_time' => 'required|date_format:H:i',
            'check_out_time' => 'required|date_format:H:i|after:check_in_time',
        ]);

        // Check if the booking can be updated
        if ($booking->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update times for a cancelled booking.'
            ], 422);
        }

        if ($booking->status === 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update times for a completed booking.'
            ], 422);
        }

        // Update the times
        $booking->check_in_time = $request->check_in_time;
        $booking->check_out_time = $request->check_out_time;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Booking times updated successfully.',
            'times' => [
                'check_in_time' => $booking->check_in_time,
                'check_out_time' => $booking->check_out_time,
                'formatted_check_in' => date('h:i A', strtotime($booking->check_in_time)),
                'formatted_check_out' => date('h:i A', strtotime($booking->check_out_time)),
            ]
        ]);
    }

    /**
     * Check and update booking status based on current time
     */
    public function checkBookingStatus(Booking $booking)
    {
        if ($booking->status === 'completed' || $booking->status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Booking is already ' . $booking->status,
                'status' => $booking->status
            ]);
        }

        $now = now();
        $checkOutTime = null;
        
        if ($booking->check_out_date && $booking->check_out_time) {
            $checkOutTime = \Carbon\Carbon::parse($booking->check_out_date->format('Y-m-d') . ' ' . $booking->check_out_time->format('H:i:s'));
        }

        if ($checkOutTime && $checkOutTime->lt($now)) {
            $booking->status = 'completed';
            $booking->save();

            return response()->json([
                'success' => true,
                'message' => 'Booking status updated to completed.',
                'status' => 'completed',
                'status_display' => 'Completed'
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Booking is still active.',
            'status' => $booking->status,
            'status_display' => ucfirst($booking->status)
        ]);
    }
}
